<?php
/**
 * @var GroupList $thatGroupList
 * @var Group $thisGroup
 * @var ContestList $thatContestList
 * @var Contest $thisContest
 * @var int $addToContestID
 */
?>

<script>
    $(document).ready(function () {
        tinymce.init({
            selector: 'textarea#ProblemDescription,textarea#InputDescription,textarea#OutputDescription',
            plugins : 'autolink autoresize link charmap code fullscreen image paste table visualblocks visualchars',
            toolbar : "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
            language: 'zh_CN'
        });
    });
</script>

<div id="content">
<form method="post" action="<?php echo base_url('api/addProblem'); ?>">
<div>
    <h1 class="text-primary text-center"><b>添加新问题</b></h1>
</div>

<hr/>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><label for="Title" class="hide">标题</label>标题</h3>
            </div>
            <div class="panel-body">
                <input id="Title" name="Title" class="form-control" type="text" required/>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><label for="TimeLimitNormal" class="hide">时间限制 - 标准 （毫秒）</label>时间限制 - 标准 （毫秒）</h3>
            </div>
            <div class="panel-body">
                <input id="TimeLimitNormal" name="TimeLimitNormal" class="form-control" type="text" required"/>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><label for="TimeLimitJava" class="hide">时间限制 - Java （毫秒）</label>时间限制 - Java （毫秒）</h3>
            </div>
            <div class="panel-body">
                <input id="TimeLimitJava" name="TimeLimitJava" class="form-control" type="text" required/>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><label for="MemoryLimitNormal" class="hide">内存限制 - 标准 （毫秒）</label>内存限制 - 标准 （KB）</h3>
            </div>
            <div class="panel-body">
                <input id="MemoryLimitNormal" name="MemoryLimitNormal" class="form-control" type="text" required/>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><label for="MemoryLimitJava" class="hide">内存限制 - Java （毫秒）</label>内存限制 - Java （KB）</h3>
            </div>
            <div class="panel-body">
                <input id="MemoryLimitJava" name="MemoryLimitJava" class="form-control" type="text" required/>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><label for="ProblemDescription" class="hide">问题描述</label>问题描述</h3>
        </div>
        <div class="panel-body">
            <textarea id="ProblemDescription" name="ProblemDescription" class="form-control" rows="10" style="resize: vertical;"></textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><label for="InputDescription" class="hide">输入说明</label>输入说明</h3>
            </div>
            <div class="panel-body">
                <textarea id="InputDescription" name="InputDescription" class="form-control" rows="5" style="resize: vertical;"></textarea>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><label for="OutputDescription" class="hide">输出说明</label>输出说明</h3>
            </div>
            <div class="panel-body">
                <textarea id="OutputDescription" name="OutputDescription" class="form-control" rows="5" style="resize: vertical;"></textarea>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><label for="SampleInput" class="hide">输入样例</label>输入样例</h3>
            </div>
            <div class="panel-body">
                <textarea id="SampleInput" name="SampleInput" class="form-control" rows="5" style="resize: vertical;"></textarea>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><label for="SampleOutput" class="hide">输出样例</label>输出样例</h3>
            </div>
            <div class="panel-body">
                <textarea id="SampleOutput" name="SampleOutput" class="form-control" rows="5" style="resize: vertical;"></textarea>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><label for="StandardInput" class="hide">标准输入</label>标准输入</h3>
            </div>
            <div class="panel-body">
                <textarea id="StandardInput" name="StandardInput" class="form-control" rows="5"
                          style="resize: vertical;"></textarea>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><label for="StandardOutput" class="hide">标准输出</label>标准输出</h3>
            </div>
            <div class="panel-body">
                <textarea id="StandardOutput" name="StandardOutput" class="form-control" rows="5"
                          style="resize: vertical;"></textarea>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><label for="Author" class="hide">作者</label>作者</h3>
            </div>
            <div class="panel-body">
                <input id="Author" name="Author" type="text" class="form-control"/>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><label for="Source" class="hide">来源</label>来源</h3>
            </div>
            <div class="panel-body">
                <input id="Source" name="Source" type="text" class="form-control"/>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><label for="Recommend" class="hide">注释</label>注释</h3>
            </div>
            <div class="panel-body">
                <input id="Recommend" name="Recommend" type="text" class="form-control"/>
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

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">比赛</h3>
            </div>
            <div class="panel-body">
                <label class="radio-inline">
                    <input type="radio" name="Contest" value="0" <?php if ($addToContestID == 0) echo 'checked'; ?>> 非比赛题
                </label>
                <?php if (isset($thatContestList)): ?>
                    <?php foreach ($thatContestList->getContestArray() as $thisContest) : ?>
                        <label class="radio-inline">
                            <input type="radio" name="Contest" value="<?php echo $thisContest->getID(); ?>" <?php if ($addToContestID == $thisContest->getID()) echo 'checked'; ?>> <?php echo $thisContest->getTitle(); ?>
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