<?php

class Group_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @param int $ID
     * @return Group
     */
    public static function getGroupByID($ID)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->select('group.*');
        $CI->db->from('group');
        $CI->db->where('group.ID', $ID);
        $query = $CI->db->get();
        $row   = $query->row();
        if ($row) {
            $thatGroup = new Group(
                $row->ID,
                $row->GroupName
            );
            return $thatGroup;
        } else
            return null;
    }

    /**
     * @return GroupList
     */
    public static function getGroupList()
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('group.*');
        $CI->db->from('group');

        $query  = $CI->db->get();
        $result = $query->result();

        $thisGroupList = new GroupList();

        foreach ($result as $row) {
            $thatGroup = new Group(
                $row->ID,
                $row->GroupName
            );

            $thisGroupList->addGroup($thatGroup);
        }
        return $thisGroupList;
    }

    /**
     * @param int $Page
     * @param int $Limit
     * @return GroupList
     */
    public static function getGroupListByPageAndLimit($Page, $Limit)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('group.*');
        $CI->db->from('group');
        $CI->db->limit($Limit, ($Page - 1) * $Limit);

        $query  = $CI->db->get();
        $result = $query->result();

        $thisGroupList = new GroupList();

        foreach ($result as $row) {
            $thatGroup = new Group(
                $row->ID,
                $row->GroupName
            );

            $thisGroupList->addGroup($thatGroup);
        }
        return $thisGroupList;
    }

    /**
     * @param Group $thatGroup
     * @return Group
     */
    public static function addGroup($thatGroup)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $insertResult = $CI->db->insert('group', array(
            'GroupName' => $thatGroup->getGroupName(),
        ));
        if ($insertResult)
            return Group_Model::getGroupByID($CI->db->insert_id());
        else
            return null;
    }

    /**
     * @param Group $thatGroup
     * @return Group
     */
    public static function updateGroup($thatGroup)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->where('ID', $thatGroup->getID());

        $updateResult = $CI->db->update('group', array(
            'GroupName' => $thatGroup->getGroupName(),
        ));
        if ($updateResult)
            return Group_Model::getGroupByID($thatGroup->getID());
        else
            return null;
    }


    /**
     * @param Group $thatGroup
     * @return bool
     */
    public static function deleteGroup($thatGroup)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->where('ID', $thatGroup->getID());
        $deleteResult = $CI->db->delete('group');
        if ($deleteResult)
            return true;
        else
            return false;
    }


}