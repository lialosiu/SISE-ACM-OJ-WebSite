<?php
/**
 * @var User $CurrentUser
 * @var User $thatUser
 */
?>
<div id="content">
    <?php if (isset ($thatUser)) : ?>
        <?php /** @var AnswerList $thatAnswerList */
        $thatAnswerList = $thatUser->getAnswerList(); ?>
        <div class="text-center">
            <h2>
                <span><small>个人信息</small></span>
                <span class="text-success">·<?php echo $thatUser->getID(); ?>·</span>
            </h2>

            <hr>

            <h1>
                <span><small><?php echo $thatUser->getGroup()->getGroupName(); ?></small></span>
                <span class="text-primary"><b><?php echo $thatUser->getUsername(); ?></b></span>
            </h1>
        </div>

        <hr>

        <div class="text-center">
            <p>
                <span class="label label-primary">Submit: <?php echo $thatAnswerList->getCountSubmit(); ?></span>
                <span class="label label-success">AC: <?php echo $thatAnswerList->getCountAccepted(); ?></span>
                <span class="label label-warning">PE: <?php echo $thatAnswerList->getCountPresentationError(); ?></span>
                <span class="label label-default">WA: <?php echo $thatAnswerList->getCountWrongAnswer(); ?></span>
                <span class="label label-default">CE: <?php echo $thatAnswerList->getCountCompileError(); ?></span>
                <span class="label label-default">RE: <?php echo $thatAnswerList->getCountRuntimeError(); ?></span>
                <span class="label label-default">TLE: <?php echo $thatAnswerList->getCountTimeLimitExceeded(); ?></span>
                <span class="label label-default">MLE: <?php echo $thatAnswerList->getCountMemoryLimitExceeded(); ?></span>
                <span class="label label-default">OLE: <?php echo $thatAnswerList->getCountOutputLimitExceeded(); ?></span>
                <span class="label label-default">SE: <?php echo $thatAnswerList->getCountSystemError(); ?></span>
            </p>
        </div>

        <hr>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">ID</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatUser->getID(); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">用户名</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatUser->getUsername(); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">昵称</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatUser->getNickname(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">最后登录IP</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatUser->getLastLoginIP(); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">最后登录时间</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatUser->getLastLoginTime(); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">最后活动IP</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatUser->getLastActivityIP(); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">最后活动时间</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $thatUser->getLastActivityTime(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <?php if (isset($CurrentUser)): ?>
                <?php if ($CurrentUser->getID() == $thatUser->getID() || $CurrentUser->isAdministrator()): ?>
                    <a class="btn btn-primary" href="<?php echo base_url('home/editUser/' . $thatUser->getID()); ?>">修改用户信息</a>
                    <?php if ($CurrentUser->isAdministrator()): ?>
                        <a class="btn btn-primary" href="<?php echo base_url('home/deleteUser/' . $thatUser->getID()); ?>">删除用户</a>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>

    <?php endif; ?>
</div>