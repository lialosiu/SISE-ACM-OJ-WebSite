<div id="header" style="background: #fff url(<?php echo base_url('public/images/header-banner.jpg'); ?>) no-repeat center; background-size: contain;">
    <div id="header-title">
        <span>SISE ACM-ICPC Online Judge<?php if (isset($CurrentUser) && $CurrentUser->isAdministrator()) echo ' - 管理员权限'; ?></span>
    </div>
    <?php $this->load->view('home/header-nav'); ?>
</div>