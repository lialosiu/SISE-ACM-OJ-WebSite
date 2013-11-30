<?php
/**
 * @var Notification $thatNotification
 */
?>
<div id="content">
    <form method="post" action="<?php echo base_url('api/editNotification'); ?>">
        <input type="hidden" name="ID" value="<?php echo $thatNotification->getID(); ?>"/>

        <div>
            <h1 class="text-primary text-center"><b>修改通知</b></h1>
        </div>

        <hr/>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="Title" class="hide">标题</label>标题</h3>
                    </div>
                    <div class="panel-body">
                        <input type="text" id="Title" name="Title" class="form-control" value="<?php echo $thatNotification->getTitle(); ?>" required/>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><label for="Content" class="hide">内容</label>内容</h3>
                        </div>
                        <div class="panel-body">
                            <textarea id="Content" name="Content" class="form-control" rows="10" style="resize: vertical;"><?php echo $thatNotification->getContent(); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <button class="btn btn-primary" type="submit">确认提交</button>
            </div>
    </form>
</div>