<?php
/**
 * @var Problem $thatProblem
 */
?>
<div id="content">
    <?php if (isset ($thatProblem)) : ?>
        <form method="post" action="<?php echo base_url('api/answerProblem'); ?>">
            <input type="hidden" name="ID" value="<?php echo $thatProblem->getID(); ?>"/>

            <div class="text-center">
                <h1>
                    <span><small>提交解答</small></span>
                    <span class="text-success">·<?php echo $thatProblem->getID(); ?>·</span>
                    <span class="text-primary"><b><?php echo $thatProblem->getTitle(); ?></b></span>
                </h1>
            </div>

            <hr>

            <div class="row">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="Language" class="hide">语言</label>语言</h3>
                    </div>
                    <div class="panel-body">
                        <select id="Language" name="LanguageCode" class="form-control">
                            <option value="1">C (GCC [-O2 -Wall -lm --static -std=c99 -DONLINE_JUDGE])</option>
                            <option value="2">C++ (G++ [-O2 -Wall -lm --static -DONLINE_JUDGE])</option>
                            <option value="3">Java (JDK 1.7 [-J-Xms32m -J-Xmx256m])</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="SourceCode" class="hide">程序源代码</label>程序源代码</h3>
                    </div>
                    <div class="panel-body">
                        <textarea id="SourceCode" name="SourceCode" class="form-control" rows="20" style="resize: vertical;"></textarea>
                    </div>
                </div>
            </div>

            <div>
                <button class="btn btn-primary" type="submit">提交</button>
            </div>

        </form>
    <?php endif; ?>
</div>