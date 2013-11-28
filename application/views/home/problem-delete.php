<?php
/**
 * @var Problem $thatProblem
 */
?>
<div id="content">
    <?php if (isset ($thatProblem)) : ?>
        <?php $thisAnswerList = $thatProblem->getAnswerList(); ?>
        <form method="post" action="<?php echo base_url('api/deleteProblem'); ?>">
            <input type="hidden" name="ID" value="<?php echo $thatProblem->getID(); ?>"/>

            <div class="text-center">
                <h2>
                    <span><small>删除问题</small></span>
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

            <div>
                <button class="btn btn-danger" type="submit">确认删除</button>
            </div>
        </form>
    <?php endif; ?>
</div>