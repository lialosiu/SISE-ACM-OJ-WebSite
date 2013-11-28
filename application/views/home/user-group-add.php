<?php
/**
 * @var GroupList $thatGroupList
 * @var Group $thisGroup
 */
?>

<div id="content">
    <form method="post" action="<?php echo base_url('api/createAGroupUser'); ?>">
        <div>
            <h1 class="text-primary text-center"><b>批量新建用户</b></h1>
        </div>

        <hr/>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="UsernamePre" class="hide">用户名前缀</label>用户名前缀</h3>
                    </div>
                    <div class="panel-body">
                        <input type="text" id="UsernamePre" name="UsernamePre" class="form-control" required/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="StartNumber" class="hide">起始值</label>起始值</h3>
                    </div>
                    <div class="panel-body">
                        <input type="number" id="StartNumber" name="StartNumber" class="form-control" required/>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="EndNumber" class="hide">结束值</label>结束值</h3>
                    </div>
                    <div class="panel-body">
                        <input type="number" id="EndNumber" name="EndNumber" class="form-control" required/>
                    </div>
                </div>
            </div>
        </div>

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
                                    <input type="radio" name="GroupID" value="<?php echo $thisGroup->getID(); ?>"> <?php echo $thisGroup->getGroupName(); ?>
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