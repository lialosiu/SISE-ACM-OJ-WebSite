<?php
/**
 * @var Problem $thatProblem
 * @var GroupList $thatGroupList
 * @var Group $thisGroup
 * @var ContestList $thatContestList
 * @var Contest $thisContest
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
<?php if (isset ($thatProblem)) : ?>
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url('api/editProblem'); ?>">
    <input type="hidden" name="ID" value="<?php echo $thatProblem->getID(); ?>"/>

    <div class="text-center">
        <h1>
            <span><small>修改问题</small></span>
            <span class="text-success">·<?php echo $thatProblem->getID(); ?>·</span>
            <span class="text-primary"><b><?php echo $thatProblem->getTitle(); ?></b></span>
        </h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><label for="Title" class="hide">标题</label>标题</h3>
                </div>
                <div class="panel-body">
                    <input id="Title" name="Title" class="form-control" type="text" value="<?php echo $thatProblem->getTitle(); ?>" required/>
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
                        <input id="TimeLimitNormal" name="TimeLimitNormal" class="form-control" type="text" value="<?php echo $thatProblem->getTimeLimitNormal(); ?>" required/>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="TimeLimitJava" class="hide">时间限制 - Java （毫秒）</label>时间限制 - Java （毫秒）</h3>
                    </div>
                    <div class="panel-body">
                        <input id="TimeLimitJava" name="TimeLimitJava" class="form-control" type="text" value="<?php echo $thatProblem->getTimeLimitJava(); ?>" required/>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="MemoryLimitNormal" class="hide">内存限制 - 标准 （毫秒）</label>内存限制 - 标准 （KB）</h3>
                    </div>
                    <div class="panel-body">
                        <input id="MemoryLimitNormal" name="MemoryLimitNormal" class="form-control" type="text" value="<?php echo $thatProblem->getMemoryLimitNormal(); ?>" required/>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="MemoryLimitJava" class="hide">内存限制 - Java （毫秒）</label>内存限制 - Java （KB）</h3>
                    </div>
                    <div class="panel-body">
                        <input id="MemoryLimitJava" name="MemoryLimitJava" class="form-control" type="text" value="<?php echo $thatProblem->getMemoryLimitJava(); ?>" required/>
                    </div>
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
                <textarea id="ProblemDescription" name="ProblemDescription" class="form-control" rows="10"
                          style="resize: vertical;"><?php echo $thatProblem->getProblemDescription(); ?></textarea>
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
                    <textarea id="InputDescription" name="InputDescription" class="form-control" rows="5"
                              style="resize: vertical;"><?php echo $thatProblem->getInputDescription(); ?></textarea>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><label for="OutputDescription" class="hide">输出说明</label>输出说明</h3>
                </div>
                <div class="panel-body">
                    <textarea id="OutputDescription" name="OutputDescription" class="form-control" rows="5"
                              style="resize: vertical;"><?php echo $thatProblem->getOutputDescription(); ?></textarea>
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
                    <textarea id="SampleInput" name="SampleInput" class="form-control" rows="5"
                              style="resize: vertical;"><?php echo $thatProblem->getSampleInput(); ?></textarea>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><label for="SampleOutput" class="hide">输出样例</label>输出样例</h3>
                </div>
                <div class="panel-body">
                    <textarea id="SampleOutput" name="SampleOutput" class="form-control" rows="5"
                              style="resize: vertical;"><?php echo $thatProblem->getSampleOutput(); ?></textarea>
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
                    <a class='btn btn-primary' href='javascript:' style="position: relative;display: block;">
                        上传标准输入文件...
                        <input type="file" id="StandardInput" name="StandardInputFile" onchange='$("#StandardInput-SelectedFileInfo").html($(this).val());' style="position: absolute;top: 0;bottom: 0;left: 0;right: 0;opacity: 0;"/>
                    </a>
                    <pre id="StandardInput-SelectedFileInfo"><?php echo $thatProblem->getStandardInput();?></pre>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><label for="StandardOutput" class="hide">标准输出</label>标准输出</h3>
                </div>
                <div class="panel-body">
                    <a class='btn btn-primary' href='javascript:' style="position: relative;display: block;">
                        上传标准输出文件...
                        <input type="file" id="StandardOutput" name="StandardOutputFile" onchange='$("#StandardOutput-SelectedFileInfo").html($(this).val());' style="position: absolute;top: 0;bottom: 0;left: 0;right: 0;opacity: 0;"/>
                    </a>
                    <pre id="StandardOutput-SelectedFileInfo"><?php echo $thatProblem->getStandardOutput();?></pre>
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
                    <input id="Author" name="Author" type="text" class="form-control" value="<?php echo $thatProblem->getAuthor(); ?>"/>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><label for="Source" class="hide">来源</label>来源</h3>
                </div>
                <div class="panel-body">
                    <input id="Source" name="Source" type="text" class="form-control" value="<?php echo $thatProblem->getSource(); ?>"/>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><label for="Recommend" class="hide">注释</label>注释</h3>
                </div>
                <div class="panel-body">
                    <input id="Recommend" name="Recommend" type="text" class="form-control" value="<?php echo $thatProblem->getRecommend(); ?>"/>
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
                                <input type="checkbox" name="PermissibleGroupsIDArray[]" value="<?php echo $thisGroup->getID(); ?>"/> <?php echo $thisGroup->getGroupName(); ?>
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
                        <input type="radio" name="Contest" value="0" <?php if ($thatProblem->getContestID() == 0) echo 'checked'; ?>> 非比赛题
                    </label>
                    <?php if (isset($thatContestList)): ?>
                        <?php foreach ($thatContestList->getContestArray() as $thisContest) : ?>
                            <label class="radio-inline">
                                <input type="radio" name="Contest"
                                       value="<?php echo $thisContest->getID(); ?>" <?php if ($thatProblem->getContestID() == $thisContest->getID()) echo 'checked'; ?>> <?php echo $thisContest->getTitle(); ?>
                            </label>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div>
        <button class=" btn btn-primary" type="submit">提交修改</button>
    </div>
    </form>
<?php endif; ?>
</div>