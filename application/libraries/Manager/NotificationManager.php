<?php

/**
 * Class NotificationManager
 */
class NotificationManager
{

    /**
     * @param string $Title
     * @param string $Content
     * @throws Exception
     * @return Notification
     */
    public static function createNotification($Title, $Content)
    {
        $thatNotification = new Notification(
            0,
            $Title,
            $Content
        );

        $thatNotification = Notification_Model::addNotification($thatNotification);

        //检查新建结果
        if ($thatNotification) {
            return $thatNotification;
        } else {
            throw new Exception("数据库查询失败");
        }
    }

    /**
     * @param Notification $thatNotification
     * @return \Notification
     */
    public static function updateNotification($thatNotification)
    {
        return Notification_Model::updateNotification($thatNotification);
    }

    /**
     * @param Notification $thatNotification
     * @return bool
     */
    public static function deleteNotification($thatNotification)
    {
        return Notification_Model::deleteNotification($thatNotification);
    }

    /**
     * @param int $ID
     * @return Notification
     */
    public static function getNotificationByID($ID = 0)
    {
        return Notification_Model::getNotificationByID($ID);
    }

    /**
     * @return NotificationList
     */
    public static function getNotificationList()
    {
        return Notification_Model::getNotificationList();
    }


    /**
     * @return string
     */
    public static function getNotificationListAsJson()
    {
        $thatNotificationList = Notification_Model::getNotificationList();

        $thatNotificationListDataArray = [];
        foreach ($thatNotificationList->getNotificationArray() as $thisNotification) {
            /** @var Notification $thisNotification */
            $thatNotificationListDataArray[] = ['ID' => $thisNotification->getID(), 'Title' => $thisNotification->getTitle(), 'Content' => $thisNotification->getContent()];
        }
        return json_encode($thatNotificationListDataArray);
    }

}