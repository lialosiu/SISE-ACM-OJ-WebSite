<?php
/**
 * @var Problem $thatProblem
 * @var AnswerList $thisAnswerList
 */
?>
<div id="content">
    <?php if (isset ($thatProblem)) : ?>
        <?php $thisAnswerList = $thatProblem->getAnswerList(); ?>
        <div class="text-center">
            <h2>
                <span><small>问题</small></span>
                <span class="text-success">·<?php echo $thatProblem->getID(); ?>·</span>
            </h2>

            <hr>

            <h1>
                <span class="text-primary"><b><?php echo $thatProblem->getTitle(); ?></b></span>
            </h1>


            <hr>

            <p>
                <span class="label label-primary">时间限制: <?php echo $thatProblem->getTimeLimitJava(); ?>/<?php echo $thatProblem->getTimeLimitNormal(); ?> MS (Java/Others)</span>
                <span class="label label-primary">内存限制: <?php echo $thatProblem->getMemoryLimitJava(); ?>/<?php echo $thatProblem->getMemoryLimitNormal(); ?> K (Java/Others)</span>
            </p>
        </div>

        <div class="text-center">
            <p>
                <span class="label label-info">Submit: <?php echo $thisAnswerList->getCountSubmit(); ?></span>
                <span class="label label-info">AC: <?php echo $thisAnswerList->getCountAccepted(); ?></span>
                <span class="label label-info">PE: <?php echo $thisAnswerList->getCountPresentationError(); ?></span>
                <span class="label label-info">WA: <?php echo $thisAnswerList->getCountWrongAnswer(); ?></span>
                <span class="label label-info">CE: <?php echo $thisAnswerList->getCountCompileError(); ?></span>
                <span class="label label-info">RE: <?php echo $thisAnswerList->getCountRuntimeError(); ?></span>
                <span class="label label-info">TLE: <?php echo $thisAnswerList->getCountTimeLimitExceeded(); ?></span>
                <span class="label label-info">MLE: <?php echo $thisAnswerList->getCountMemoryLimitExceeded(); ?></span>
                <span class="label label-info">OLE: <?php echo $thisAnswerList->getCountOutputLimitExceeded(); ?></span>
                <span class="label label-info">SE: <?php echo $thisAnswerList->getCountSystemError(); ?></span>
            </p>
        </div>

        <hr>

        <div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">问题描述</h3>
                </div>
                <div class="panel-body">
                    <?php echo $thatProblem->getProblemDescription(); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">输入说明</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatProblem->getInputDescription(); ?>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">输出说明</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatProblem->getOutputDescription(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">输入样例</h3>
                    </div>
                    <div class="panel-body">
                        <pre><?php echo htmlspecialchars($thatProblem->getSampleInput()); ?></pre>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">输出样例</h3>
                    </div>
                    <div class="panel-body">
                        <pre><?php echo htmlspecialchars($thatProblem->getSampleOutput()); ?></pre>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">作者</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatProblem->getAuthor(); ?>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">来源</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatProblem->getSource(); ?>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">注释</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatProblem->getRecommend(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <?php if (isset($CurrentUser) && $CurrentUser->isAdministrator()): ?>
                <a class="btn btn-primary" href="<?php echo base_url('home/editProblem/' . $thatProblem->getID()); ?>">修改问题</a>
                <a class="btn btn-primary" href="<?php echo base_url('home/deleteProblem/' . $thatProblem->getID()); ?>">删除问题</a>
            <?php endif; ?>
            <a class="btn btn-primary" href="<?php echo base_url('home/answerProblem/' . $thatProblem->getID()); ?>">提交解答</a>
        </div>

    <?php endif; ?>
</div>