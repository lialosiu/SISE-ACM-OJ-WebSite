<?php

/**
 * Class GroupManager
 */
class GroupManager
{

    /**
     * @param string $GroupName
     * @throws Exception
     * @return Group
     */
    public static function createGroup($GroupName)
    {
        $thatGroup = new Group(
            0,
            $GroupName
        );

        $thatGroup = Group_Model::addGroup($thatGroup);

        //检查新建结果
        if ($thatGroup) {
            return $thatGroup;
        } else {
            throw new Exception("数据库查询失败");
        }
    }

    /**
     * @param Group $thatGroup
     * @return \Group
     */
    public static function updateGroup($thatGroup)
    {
        return Group_Model::updateGroup($thatGroup);
    }

    /**
     * @param int $ID
     * @return Group
     */
    public static function getGroupByID($ID = 0)
    {
        switch ($ID) {
            case -1:
                return new Group(-1, "系统管理员");
            case 0 :
                return new Group(0, "未分组");
            default:
                return Group_Model::getGroupByID($ID);
        }

    }

    /**
     * @return GroupList
     */
    public static function getGroupList()
    {
        $thisGroupList = Group_Model::getGroupList();
        $thisGroupList->addGroup(new Group(-1, "系统管理员"));
        $thisGroupList->addGroup(new Group(0, "未分组"));
        return $thisGroupList;
    }

    /**
     * @param int $Page
     * @param int $Limit
     * @return GroupList
     */
    public static function getGroupListByPageAndLimit($Page, $Limit)
    {
        $thisGroupList = Group_Model::getGroupListByPageAndLimit($Page, $Limit);
        $thisGroupList->addGroup(new Group(-1, "系统管理员"));
        $thisGroupList->addGroup(new Group(0, "未分组"));
        return $thisGroupList;
    }
}