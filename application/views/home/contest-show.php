<?php
/**
 * @var User $CurrentUser
 * @var Contest $thatContest
 * @var Problem $thisProblem
 */
?>
<script>
    $(document).ready(function () {
        $('table#problem-list').dataTable({
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
    <?php if (isset($thatContest)): ?>
        <?php $thatProblemList = $thatContest->getProblemList(); ?>
        <div class="text-center">
            <h1>
                <span><small>比赛</small></span>
                <span class="text-success">·<?php echo $thatContest->getID(); ?>·</span>
                <span class="text-primary"><b><?php echo $thatContest->getTitle(); ?></b></span>
            </h1>

            <hr>

            <h3>
                <span class="label label-success">开始时间: <?php echo $thatContest->getStartTime(); ?></span>
                <span class="label label-danger">结束时间: <?php echo $thatContest->getEndTime(); ?></span>
                <a class="btn btn-info" href="<?php echo base_url('home/listAnswer?c=' . $thatContest->getID()); ?>">判题状态</a>
            </h3>
        </div>

        <hr>

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
                <a class="btn btn-primary" href="<?php echo base_url('home/addProblem?c=' . $thatContest->getID()); ?>">添加问题</a>
                <a class="btn btn-primary" href="<?php echo base_url('home/editContest/' . $thatContest->getID()); ?>">修改比赛</a>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>