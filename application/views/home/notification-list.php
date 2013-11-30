<?php
/**
 * @var NotificationList $thatNotificationList
 * @var Notification $thisNotification
 */
?>
<script>
    $(document).ready(function () {
        $('table#notification-list').dataTable();
    });
</script>
<div id="content">
    <div class="panel panel-default">
        <table id="notification-list" class="table table-condensed">
            <thead>
            <tr>
                <th>标题</th>
                <th>内容</th>
                <?php if (isset($CurrentUser) && $CurrentUser->isAdministrator()): ?>
                    <th>管理</th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php if (isset ($thatNotificationList)) : ?>
                <?php foreach ($thatNotificationList->getNotificationArray() as $thisNotification) : ?>
                    <?php if (!$thisNotification) continue; ?>
                    <tr>
                        <td><?php echo $thisNotification->getTitle(); ?></td>
                        <td><?php echo $thisNotification->getContent(); ?></td>
                        <?php if (isset($CurrentUser) && $CurrentUser->isAdministrator()): ?>
                            <td>
                                <a class="btn btn-primary btn-xs" href="<?php echo base_url('home/editNotification/' . $thisNotification->getID()); ?>">编辑</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (isset($CurrentUser) && $CurrentUser->isAdministrator()): ?>
        <div>
            <a class="btn btn-primary" href="<?php echo base_url('home/addNotification'); ?>">添加通知</a>
        </div>
    <?php endif; ?>
</div>