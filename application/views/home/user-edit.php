<?php
/**
 * @var User $CurrentUser
 * @var User $thatUser
 * @var GroupList $thatGroupList
 * @var Group $thisGroup
 */
?>
<div id="content">
    <?php if (isset ($thatUser)) : ?>
        <form method="post" action="<?php echo base_url('api/editUser'); ?>">
            <input type="hidden" name="ID" value="<?php echo $thatUser->getID(); ?>"/>

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

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><label for="Username" class="hide">用户名</label>用户名</h3>
                        </div>
                        <div class="panel-body">
                            <input id="Username" name="Username" class="form-control" type="text" value="<?php echo $thatUser->getUsername(); ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><label for="Nickname" class="hide">昵称</label>昵称</h3>
                        </div>
                        <div class="panel-body">
                            <input id="Nickname" name="Nickname" class="form-control" type="text" value="<?php echo $thatUser->getNickname(); ?>" required/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><label for="OldPassword" class="hide">旧密码</label>旧密码</h3>
                        </div>
                        <div class="panel-body">
                            <input id="OldPassword" name="OldPassword" class="form-control" type="password" required <?php if ($CurrentUser->isAdministrator()) echo 'disabled' ?>/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><label for="NewPassword1" class="hide">新密码</label>新密码</h3>
                        </div>
                        <div class="panel-body">
                            <input id="NewPassword1" name="NewPassword1" class="form-control" type="password"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><label for="NewPassword2" class="hide">重复新密码</label>重复新密码</h3>
                        </div>
                        <div class="panel-body">
                            <input id="NewPassword2" name="NewPassword2" class="form-control" type="password"/>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($CurrentUser->isAdministrator()): ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">归宿用户组</h3>
                            </div>
                            <div class="panel-body">
                                <?php if (isset($thatGroupList)): ?>
                                    <?php foreach ($thatGroupList->getGroupArray() as $thisGroup) : ?>
                                        <label class="radio-inline">
                                            <input type="radio" name="GroupID" value="<?php echo $thisGroup->getID(); ?>"
                                                <?php if ($thatUser->getGroupID() == $thisGroup->getID()) echo 'checked'; ?>> <?php echo $thisGroup->getGroupName(); ?>
                                        </label>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div>
                <button class="btn btn-primary" type="submit">确认提交</button>
            </div>
        </form>
    <?php endif; ?>
</div>