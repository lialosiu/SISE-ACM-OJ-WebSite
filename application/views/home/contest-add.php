<?php
/**
 * @var GroupList $thatGroupList
 * @var Group $thisGroup
 */
?>

<div id="content">
    <form method="post" action="<?php echo base_url('api/addContest'); ?>">
        <div>
            <h1 class="text-primary text-center"><b>添加新比赛</b></h1>
        </div>

        <hr/>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="Title" class="hide">标题</label>标题</h3>
                    </div>
                    <div class="panel-body">
                        <input type="text" id="Title" name="Title" class="form-control" required/>
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
                        <input type="datetime-local" id="StartTime" name="StartTime" class="form-control" required/>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="EndTime" class="hide">结束时间</label>结束时间</h3>
                    </div>
                    <div class="panel-body">
                        <input type="datetime-local" id="EndTime" name="EndTime" class="form-control" required/>
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
                                    <input type="checkbox" name="PermissibleGroupsIDArray[]" value="<?php echo $thisGroup->getID(); ?>"> <?php echo $thisGroup->getGroupName(); ?>
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