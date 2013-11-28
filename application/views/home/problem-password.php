<?php
/**
 * @var Problem $thatProblem
 */
?>
<div id="content">
    <?php if (isset ($thatProblem)) : ?>

        <form method="post">
            <input type="hidden" name="ID" value="<?php echo $thatProblem->getID(); ?>"/>

            <div class="text-center">
                <h1>
                    <span><small>需要密码</small></span>
                    <span class="text-success">·<?php echo $thatProblem->getID(); ?>·</span>
                    <span class="text-primary"><b><?php echo $thatProblem->getTitle(); ?></b></span>
                </h1>
            </div>

            <hr>

            <div>
                <div class="panel <?php echo isset($alertDanger) ? 'panel-danger' : 'panel-primary'; ?>">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="Password" class="hide">密码</label><?php echo isset($alertDanger) ? $alertDanger : '密码'; ?></h3>
                    </div>
                    <div class="panel-body">
                        <input id="Password" name="Password" type="password" class="form-control"/>
                    </div>
                </div>
            </div>

            <div>
                <button class="btn btn-primary" type="submit">提交</button>
            </div>
        </form>
    <?php endif; ?>
</div>