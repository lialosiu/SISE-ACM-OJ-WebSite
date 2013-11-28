<div id="content">
    <form method="post" action="<?php echo base_url('api/createGroup'); ?>">
        <div>
            <h1 class="text-primary text-center"><b>新建用户组</b></h1>
        </div>

        <hr/>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="GroupName" class="hide">用户组名</label>用户组名</h3>
                    </div>
                    <div class="panel-body">
                        <input type="text" id="GroupName" name="GroupName" class="form-control" required/>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <button class="btn btn-primary" type="submit">确认提交</button>
        </div>
    </form>
</div>