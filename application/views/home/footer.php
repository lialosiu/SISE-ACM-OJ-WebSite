<?php
/**
 * @var NotificationList $thatNotificationList
 * @var Notification $thisNotification
 */
?>
<div id="footer">
    <div id="footer-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <span>Copyright © 2013 SISE ACM-ICPC Team. All rights reserved. Powered by <a href="http://lialosiu.com" target="_blank">Lialosiu</a></span>
            </div>
            <?php if (isset($thatNotificationList)): ?>
                <?php $i = 1; ?>
                <?php foreach ($thatNotificationList->getNotificationArray() as $thisNotification): ?>
                    <div class="item" style="background-color: rgba(<?php echo rand(50, 255); ?>,<?php echo rand(50, 255); ?>,<?php echo rand(50, 255); ?>,0.6);">
                        <span style="white-space: nowrap"><?php echo $thisNotification->getContent(); ?></span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <a class="left carousel-control" href="#footer-carousel" data-slide="prev"></a>
        <a class="right carousel-control" href="#footer-carousel" data-slide="next"></a>
    </div>
</div>
<style>
    body {
        margin-bottom: 50px;
    }
</style>