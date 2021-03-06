<?php
/**
 * @var Contest $thatContest
 * @var Problem $thisProblem
 * @var array   $thatRankData
 */
?>
<?php if (isset($thatContest)): ?>
    <script>
        var Interval_getRankData = setInterval("getRankData()", 2000);
        function getRankData() {
            $.ajax({
                url    : '<?php echo base_url('api/getRankDataAsJSONByContestID/'.$thatContest->getID())?>',
                type   : "post",
                data   : {},
                success: function (data) {
                    if (data)
                        displayRankData($.parseJSON(data));
                    else {
                        clearInterval(Interval_getRankData);
                        $('table#rank-list>tbody').html('<h2 class="alert alert-info text-center">已封榜</h2>');
                    }
                },
                error  : function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus);
                    clearInterval(Interval_getRankData);
                }
            });
        }
        function displayRankData(RankData) {
            var HTML = '';
            $.each(RankData, function (Rank, thisUserData) {
                HTML += '<tr>';
                HTML += '<td>' + (Rank + 1) + '</td>';
                HTML += '<td><a href="' + base_url('home/showUser/') + thisUserData['ID'] + '">' + thisUserData['Username'] + '</a></td>';
                HTML += '<td><a href="' + base_url('home/showUser/') + thisUserData['ID'] + '">' + thisUserData['Nickname'] + '</a></td>';
                HTML += '<td>' + thisUserData['CountAccepted'] + '</td>';
                HTML += '<td>' + thisUserData['UsedTime'] + '</td>';
                $.each(thisUserData['Problem'], function (ProblemID, thisProblemData) {
                    if (thisProblemData['CountSubmit'] != 0)
                        HTML += '<td' + (thisProblemData['Accepted'] ? ' class="accepted"' : ' class="submitted"') + '>' + thisProblemData['CountSubmit'] + '/' + thisProblemData['AcceptedUsedTime'] + '</td>';
                    else
                        HTML += '<td></td>'
                });
                HTML += '</tr>';
            });
            $('table#rank-list>tbody').html(HTML);
        }
    </script>
<?php endif; ?>
<div id="content">
    <div class="panel panel-default">
        <table id="rank-list" class="table table-condensed table-bordered">
            <thead>
            <tr>
                <th>Rank</th>
                <th>用户名</th>
                <th>用户昵称</th>
                <th>AC数</th>
                <th>所用时间</th>
                <?php if (isset($thatContest)): ?>
                    <?php $i = 'A'; ?>
                    <?php foreach ($thatContest->getProblemList()->getProblemArray() as $thisProblem) : ?>
                        <?php if (!$thisProblem) continue; ?>
                        <th><a href="<?php echo base_url('home/showProblem/' . $thisProblem->getID()); ?>"><?php echo $i++; ?></a></th>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($thatRankData) && $thatContest->isRankTime()): ?>
                <?php foreach ($thatRankData as $key => $thisRankData_Row) : ?>
                    <?php if ($thisRankData_Row['CountSubmit'] == 0) continue; ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><a href="<?php echo base_url('home/showUser/' . $thisRankData_Row['ID']); ?>"><?php echo $thisRankData_Row['Username']; ?></a></td>
                        <td><a href="<?php echo base_url('home/showUser/' . $thisRankData_Row['ID']); ?>"><?php echo $thisRankData_Row['Nickname']; ?></a></td>
                        <td><?php echo $thisRankData_Row['CountAccepted']; ?></td>
                        <td><?php echo $thisRankData_Row['UsedTime']; ?></td>

                        <?php foreach ($thisRankData_Row['Problem'] as $thisProblemData) : ?>
                            <?php if ($thisProblemData['CountSubmit'] != 0) : ?>
                                <td <?php echo $thisProblemData['Accepted'] ? 'class="accepted"' : 'class="submitted"'; ?>>
                                    <?php echo $thisProblemData['CountSubmit']; ?>/<?php echo $thisProblemData['AcceptedUsedTime']; ?>
                                </td>
                            <?php else: ?>
                                <td></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>