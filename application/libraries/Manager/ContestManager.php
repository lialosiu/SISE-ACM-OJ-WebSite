<?php

/**
 * Class ContestManager
 */
class ContestManager
{

    /**
     * @param string $Title
     * @param string $StartTime
     * @param string $EndTime
     * @param string $Password
     * @param array $PermissibleUsersIDArray
     * @param array $PermissibleGroupsIDArray
     * @param string $Status
     * @throws Exception
     * @return Contest
     */
    public static function createContest($Title, $StartTime, $EndTime, $Password = '', $PermissibleUsersIDArray = [], $PermissibleGroupsIDArray = [], $Status = '')
    {
        $thatContest = new Contest(
            0,
            $Title,
            $StartTime,
            $EndTime,
            $Password ? do_hash($Password) : '',
            $PermissibleUsersIDArray,
            $PermissibleUsersIDArray,
            $Status
        );

        //新建问题
        $thatContest = Contest_Model::addContest($thatContest);

        //检查新建结果
        if ($thatContest) {
            return $thatContest;
        } else {
            throw new Exception("数据库查询失败");
        }
    }

    /**
     * @param Contest $thatContest
     * @return \Contest
     */
    public static function updateContest($thatContest)
    {
        return Contest_Model::updateContest($thatContest);
    }

    /**
     * @param Integer $ID
     * @return Contest
     */
    public static function getContestByID($ID)
    {
        if ($ID == 0) {
            return new Contest(0, "非比赛题");
        }
        return Contest_Model::getContestByID($ID);
    }

    /**
     * @return Contest
     */
    public static function getContestList()
    {
        return Contest_Model::getContestList();
    }

    /**
     * @param Integer $Page
     * @param Integer $Limit
     * @return Array
     */
    public static function getContestListByPageAndLimit($Page, $Limit)
    {
        return Contest_Model::getContestListByPageAndLimit($Page, $Limit);
    }

}