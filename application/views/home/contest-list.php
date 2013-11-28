<?php
/**
 * @var ContestList $thatContestList
 * @var Contest $thisContest
 * @var User $thisUser
 */
?>
<script>
    $(document).ready(function () {
        $('table#contest-list').dataTable({
            "oLanguage"      : {
                "sLengthMenu"  : "每页显示 _MENU_ 条结果",
                "sZeroRecords" : "无数据",
                "sInfo"        : "_START_ ~ _END_ (共 _TOTAL_ 条) ",
                "sInfoEmpty"   : "无数据",
                "sInfoFiltered": "(从 _MAX_ 条中过滤)",
                "sSearch"      : "搜索：",
                "oPaginate"    : {
                    "sFirst"   : "<<",
                    "sPrevious": "<",
                    "sNext"    : ">",
                    "sLast"    : ">>"
                }
            },
            "sPaginationType": "full_numbers"
        });
    });
</script>
<div id="content">
    <div class="panel panel-default">
        <table id="contest-list" class="table table-condensed">
            <thead>
            <tr>
                <th>ID</th>
                <th>标题</th>
                <th>开始时间</th>
                <th>结束时间</th>
                <th>权限</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset ($thatContestList)) : ?>
                <?php foreach ($thatContestList->getContestArray() as $thisContest) : ?>
                    <tr onclick="location.href='<?php echo base_url('home/showContest/' . $thisContest->getID()); ?>'">
                        <td><?php echo $thisContest->getID(); ?></td>
                        <td><?php echo $thisContest->getTitle(); ?></td>
                        <td><?php echo $thisContest->getStartTime(); ?></td>
                        <td><?php echo $thisContest->getEndTime(); ?></td>
                        <td><?php echo($thisContest->getPasswordHashed() ? 'Private' : 'Public'); ?></td>
                        <td><?php echo $thisContest->getStatus(); ?></td>
                        <td><a href="<?php echo base_url('home/rankContest/' . $thisContest->getID()); ?>">Rank</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (isset($CurrentUser) && $CurrentUser->isAdministrator()): ?>
        <div>
            <a class="btn btn-primary" href="<?php echo base_url('home/addContest'); ?>">添加比赛</a>
        </div>
    <?php endif; ?>
</div>