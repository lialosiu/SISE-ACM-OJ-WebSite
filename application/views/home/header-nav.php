<?php
/**
 * @var User $CurrentUser
 */
?>
<div id="header-nav" class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav nav-pills navbar-left">
        <li <?php if ($this->router->fetch_method() === 'index') echo 'class="active"' ?>><a href="<?php echo base_url(); ?>">首页</a></li>
        <li <?php if ($this->router->fetch_method() === 'listProblem') echo 'class="active"' ?>><a href="<?php echo base_url('home/listProblem'); ?>">问题集</a></li>
        <li <?php if ($this->router->fetch_method() === 'listContest') echo 'class="active"' ?>><a href="<?php echo base_url('home/listContest'); ?>">比赛</a></li>
        <li <?php if ($this->router->fetch_method() === 'listAnswer') echo 'class="active"' ?>><a href="<?php echo base_url('home/listAnswer'); ?>">判题状态</a></li>
        <li <?php if ($this->router->fetch_method() === 'rank') echo 'class="active"' ?>><a href="<?php echo base_url('home/rank'); ?>">排行榜</a></li>
        <?php if (isset($CurrentUser) && $CurrentUser->isAdministrator())  : ?>
            <li <?php if ($this->router->fetch_method() === 'listUser') echo 'class="active"' ?>><a href="<?php echo base_url('home/listUser'); ?>">用户管理</a></li>
        <?php endif; ?>
    </ul>
    <ul id="header-nav-user" class="nav nav-pills navbar-right">
        <li class="dropdown">
            <?php if (isset($CurrentUser) && $CurrentUser->getID() !== 0)  : ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="current-user-name"><?php echo $CurrentUser->getNickname(); ?></span> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="logged-in"><a href="<?php echo base_url('home/showUser/' . $CurrentUser->getID()); ?>">个人信息</a></li>
                    <li class="logged-in"><a href="<?php echo base_url('login'); ?>">切换用户</a></li>
                    <li class="logged-in"><a href="<?php echo base_url('logout'); ?>">登出</a></li>
                </ul>
            <?php else : ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="current-user-name">未登录</span> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="logged-out"><a href="<?php echo base_url('register'); ?>">注册</a></li>
                    <li class="logged-out"><a href="<?php echo base_url('login'); ?>">登录</a></li>
                </ul>
            <?php endif; ?>
        </li>
    </ul>
</div>