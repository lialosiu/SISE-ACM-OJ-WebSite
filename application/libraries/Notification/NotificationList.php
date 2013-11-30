<?php

class NotificationList
{

    /**
     * @var array
     */
    private $NotificationArray = [];

    /**
     * @param Notification $thatNotification
     */
    public function addNotification($thatNotification)
    {
        if (!array_key_exists($thatNotification->getID(), $this->NotificationArray)) {
            $this->NotificationArray[$thatNotification->getID()] = $thatNotification;
        }
    }

    /**
     * @param Notification $thatNotification
     */
    public function removeNotification($thatNotification)
    {
        if (array_key_exists($thatNotification->getID(), $this->NotificationArray)) {
            unset($this->NotificationArray[$thatNotification->getID()]);
        }
    }

    /**
     * @param int $ID
     * @return Notification
     */
    public function getNotificationByID($ID)
    {
        if (array_key_exists($ID, $this->NotificationArray)) {
            return $this->NotificationArray[$ID];
        }
        return null;
    }

    /**
     * @return array
     */
    public function getNotificationArray()
    {
        return $this->NotificationArray;
    }

}