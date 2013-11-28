<div id="content">
    <div class="panel panel-default">
        <table id="rank-list" class="table table-condensed table-bordered">
            <thead>
            <tr>
                <th>Rank</th>
                <th>用户名</th>
                <th>用户昵称</th>
                <th>AC数</th>
                <th>提交数</th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($thatRankData)): ?>
                <?php foreach ($thatRankData as $key => $thisRankData_Row) : ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $thisRankData_Row['Username']; ?></td>
                        <td><?php echo $thisRankData_Row['Nickname']; ?></td>
                        <td><?php echo $thisRankData_Row['CountAccepted']; ?></td>
                        <td><?php echo $thisRankData_Row['CountSubmit']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>