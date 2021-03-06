<?php
/**
 * @var ProblemList $thatProblemList
 * @var Problem $thisProblem
 * @var User $thisUser
 * @var AnswerList $thisAnswerList
 */
?>
<script>
    $(document).ready(function () {
        $('table#problem-list').dataTable();
    });
</script>
<div id="content">
    <div class="panel panel-default">
        <table id="problem-list" class="table table-condensed">
            <thead>
            <tr>
                <th>ID</th>
                <th>标题</th>
                <th>权限</th>
                <th>通过率(AC数/提交数)</th>
                <?php if (isset($CurrentUser) && $CurrentUser->isAdministrator()): ?>
                    <th>管理</th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php if (isset ($thatProblemList)) : ?>
                <?php foreach ($thatProblemList->getProblemArray() as $thisProblem) : ?>
                    <?php if (!$thisProblem) continue; ?>
                    <?php $thisAnswerList = $thisProblem->getAnswerList(); ?>
                    <tr onclick="location.href='<?php echo base_url('home/showProblem/' . $thisProblem->getID()); ?>'">
                        <td><?php echo $thisProblem->getID(); ?></td>
                        <td><?php echo $thisProblem->getTitle(); ?></td>
                        <td><?php echo($thisProblem->getPasswordHashed() ? 'Private' : 'Public'); ?></td>
                        <td><?php echo $thisAnswerList->getCountSubmit() == 0 ? '无数据' : (round($thisAnswerList->getCountAccepted() / $thisAnswerList->getCountSubmit() * 100, 2) . '% ' . '(' . $thisAnswerList->getCountAccepted() . '/' . $thisAnswerList->getCountSubmit() . ')'); ?></td>
                        <?php if (isset($CurrentUser) && $CurrentUser->isAdministrator()): ?>
                            <td>
                                <a class="btn btn-primary btn-xs" href="<?php echo base_url('api/recheckProblem/' . $thisProblem->getID()); ?>">重判</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (isset($CurrentUser) && $CurrentUser->isAdministrator()): ?>
        <div>
            <a class="btn btn-primary" href="<?php echo base_url('home/addProblem'); ?>">添加问题</a>
        </div>
    <?php endif; ?>
</div>