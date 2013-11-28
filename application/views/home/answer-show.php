<?php
/**
 * @var Problem $thatProblem
 * @var Answer $thatAnswer
 */
?>
<div id="content">
    <?php if (isset($thatAnswer)): ?>
        <div class="text-center">
            <h2>
                <span><small>判题编号</small></span>
                <span class="text-success">·<?php echo $thatAnswer->getID(); ?>·</span>
                <span><small>问题</small></span>
                <span class="text-success">·<?php echo $thatProblem->getID(); ?>·</span>
            </h2>

            <hr>

            <h1>
                <span class="text-primary"><b><?php echo $thatProblem->getTitle(); ?></b></span>
                <span class="text-warning"><b>@<?php echo $thatAnswer->getUser()->getNickname(); ?></b></span>
            </h1>

            <hr>

            <p>
                <span class="label label-primary">时间限制: <?php echo $thatProblem->getTimeLimitJava(); ?>/<?php echo $thatProblem->getTimeLimitNormal(); ?> MS (Java/Others)</span>
                <span class="label label-primary">内存限制: <?php echo $thatProblem->getMemoryLimitJava(); ?>/<?php echo $thatProblem->getMemoryLimitNormal(); ?> K (Java/Others)</span>
            </p>
        </div>

    <?php /** @var AnswerList $thisAnswerList */
    $thisAnswerList = $thatProblem->getAnswerList(); ?>

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


        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-2 col-lg-1">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">语言</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatAnswer->getLanguage(); ?>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">运行时间(MS)</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatAnswer->getUsedTime(); ?>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">使用内存(K)</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatAnswer->getUsedMemory(); ?>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-2 col-lg-3">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">结果</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatAnswer->getStatus(); ?>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">提交时间</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatAnswer->getSubmitTime(); ?>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">判题时间</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatAnswer->getMarkedTime(); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php if ($thatAnswer->getInfo()): ?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">详细信息</h3>
                    </div>
                    <div class="panel-body">
                        <pre class="brush: plain"><?php echo htmlspecialchars($thatAnswer->getInfo()); ?></pre>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">源代码</h3>
                </div>
                <div class="panel-body">
                    <pre <?php switch ($thatAnswer->getLanguageCode()) {
                        case _LanguageCode_C:
                        case _LanguageCode_CPP:
                            echo 'class="brush: cpp"';
                            break;
                        case _LanguageCode_Java:
                            echo 'class="brush: java"';
                            break;
                        case _LanguageCode_UnknownLanguage:
                        default:
                            echo 'class="brush: plain"';
                            break;
                    } ?>><?php echo htmlspecialchars($thatAnswer->getSourceCode()); ?></pre>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">输入数据</h3>
                    </div>
                    <div class="panel-body">
                        <pre class="brush: plain"><?php echo htmlspecialchars($thatAnswer->getInputData()); ?></pre>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">输出数据</h3>
                    </div>
                    <div class="panel-body">
                        <pre class="brush: plain"><?php echo htmlspecialchars($thatAnswer->getOutputData()); ?></pre>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">标准输出</h3>
                    </div>
                    <div class="panel-body">
                        <pre class="brush: plain"><?php echo htmlspecialchars($thatProblem->getStandardOutput()); ?></pre>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>