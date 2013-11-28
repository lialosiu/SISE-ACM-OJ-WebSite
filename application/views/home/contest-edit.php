<?php
/**
 * @var GroupList $thatGroupList
 * @var Group $thisGroup
 * @var Contest $thatContest
 */
?>

<div id="content">
    <form method="post" action="<?php echo base_url('api/editContest'); ?>">
        <input type="hidden" name="ID" value="<?php echo $thatContest->getID(); ?>"/>

        <div class="text-center">
            <h1>
                <span><small>编辑比赛</small></span>
                <span class="text-success">·<?php echo $thatContest->getID(); ?>·</span>
            </h1>
        </div>

        <hr/>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="Title" class="hide">标题</label>标题</h3>
                    </div>
                    <div class="panel-body">
                        <input id="Title" name="Title" class="form-control" type="text" value="<?php echo $thatContest->getTitle(); ?>" required/>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="StartTime" class="hide">开始时间</label>开始时间</h3>
                    </div>
                    <div class="panel-body">
                        <input type="text" id="StartTime" name="StartTime" class="form-control" value="<?php echo $thatContest->getStartTime() ?>" pattern="^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$"
                               placeholder="Y-m-d H:i:s" required/>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="EndTime" class="hide">结束时间</label>结束时间</h3>
                    </div>
                    <div class="panel-body">
                        <input type="text" id="EndTime" name="EndTime" class="form-control" value="<?php echo $thatContest->getEndTime() ?>" pattern="^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$"
                               placeholder="Y-m-d H:i:s" required/>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="Password" class="hide">密码</label>密码</h3>
                    </div>
                    <div class="panel-body">
                        <input id="Password" name="Password" type="password" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">授权组</h3>
                    </div>
                    <div class="panel-body">
                        <?php if (isset($thatGroupList)): ?>
                            <?php foreach ($thatGroupList->getGroupArray() as $thisGroup) : ?>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="PermissibleGroupsIDArray[]"
                                           value="<?php echo $thisGroup->getID(); ?>" <?php echo in_array($thisGroup->getID(), $thatContest->getPermissibleGroupsIDArray()) ? 'checked' : '' ?> > <?php echo $thisGroup->getGroupName(); ?>
                                </label>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <button class="btn btn-primary" type="submit">确认提交</button>
        </div>
    </form>
</div>