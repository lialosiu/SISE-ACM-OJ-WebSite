<?php

class Notification_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param int $ID
     * @return Notification
     */
    public static function getNotificationByID($ID)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->select('notification.*');
        $CI->db->from('notification');
        $CI->db->where('notification.ID', $ID);
        $query = $CI->db->get();
        $row   = $query->row();
        if ($row) {
            $thatNotification = new Notification(
                $row->ID,
                $row->Title,
                $row->Content
            );
            return $thatNotification;
        } else
            return null;
    }

    /**
     * @return NotificationList
     */
    public static function getNotificationList()
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('notification.*');
        $CI->db->from('notification');

        $query  = $CI->db->get();
        $result = $query->result();

        $thisNotificationList = new NotificationList();

        foreach ($result as $row) {
            $thatNotification = new Notification(
                $row->ID,
                $row->Title,
                $row->Content
            );

            $thisNotificationList->addNotification($thatNotification);
        }
        return $thisNotificationList;
    }

    /**
     * @param Notification $thatNotification
     * @return Notification
     */
    public static function addNotification($thatNotification)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $insertResult = $CI->db->insert('notification', array(
            'Title'   => $thatNotification->getTitle(),
            'Content' => $thatNotification->getContent(),
        ));
        if ($insertResult)
            return self::getNotificationByID($CI->db->insert_id());
        else
            return null;
    }

    /**
     * @param Notification $thatNotification
     * @return Notification
     */
    public static function updateNotification($thatNotification)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->where('ID', $thatNotification->getID());

        $updateResult = $CI->db->update('notification', array(
            'Title'   => $thatNotification->getTitle(),
            'Content' => $thatNotification->getContent(),
        ));
        if ($updateResult)
            return self::getNotificationByID($thatNotification->getID());
        else
            return null;
    }


    /**
     * @param Notification $thatNotification
     * @return bool
     */
    public static function deleteNotification($thatNotification)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->where('ID', $thatNotification->getID());
        $deleteResult = $CI->db->delete('notification');
        if ($deleteResult)
            return true;
        else
            return false;
    }


}