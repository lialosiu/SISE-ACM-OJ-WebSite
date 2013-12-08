<script>
    var serverTime = <?php echo time();?>;
    var offset;
    $(document).ready(function () {
        serverTime = new Date(serverTime * 1000);
        offset = new Date() - serverTime;
        setInterval("updateServerTime()", 1000);
    });
    function updateServerTime() {
        $('#server-time').html(date2NowTimeString(new Date(new Date() + offset)));
    }
    function date2NowTimeString(d) {
        function p(s) {
            return s < 10 ? '0' + s : s;
        }

        return p(d.getFullYear()) + '-' + p(d.getMonth()+1) + '-' + p(d.getDate()) + ' ' + p(d.getHours()) + ':' + p(d.getMinutes()) + ':' + p(d.getSeconds());
    }
</script>
<div id="header" style="background: #fff url(<?php echo base_url('public/images/header-banner.jpg'); ?>) no-repeat center; background-size: contain;">
    <div id="header-title">
        <span>SISE ACM-ICPC Online Judge<?php if (isset($CurrentUser) && $CurrentUser->isAdministrator()) echo ' - 管理员权限'; ?></span>
        <span style="float: right">服务器时间 <span id="server-time"><?php echo date("Y-m-d H:i:s", time()); ?></span></span>
    </div>
    <?php $this->load->view('home/header-nav'); ?>
</div>