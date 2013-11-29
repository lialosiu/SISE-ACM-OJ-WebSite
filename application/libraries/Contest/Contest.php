<?php

/**
 * Class Contest
 */
class Contest
{
    /**
     * @var int
     */
    private $ID = 0;
    /**
     * @var string
     */
    private $Title = '';
    /**
     * @var string
     */
    private $StartTime = '2000-01-01 00:00:00';
    /**
     * @var string
     */
    private $EndTime = '2000-01-01 00:00:00';
    /**
     * @var string
     */
    private $PasswordHashed = '';
    /**
     * @var array
     */
    private $PermissibleUsersIDArray = [];
    /**
     * @var array
     */
    private $PermissibleGroupsIDArray = [];

    /**
     * @param $ID
     * @param $Title
     * @param $StartTime
     * @param $EndTime
     * @param $PasswordHashed
     * @param $PermissibleUsersIDArray
     * @param $PermissibleGroupsIDArray
     */
    function __construct(
        $ID = 0,
        $Title = '',
        $StartTime = '2000-01-01 00:00:00',
        $EndTime = '2000-01-01 00:00:00',
        $PasswordHashed = '',
        $PermissibleUsersIDArray = [],
        $PermissibleGroupsIDArray = []
    )
    {
        $this->ID                       = $ID;
        $this->Title                    = $Title;
        $this->StartTime                = $StartTime;
        $this->EndTime                  = $EndTime;
        $this->PasswordHashed           = $PasswordHashed;
        $this->PermissibleUsersIDArray  = $PermissibleUsersIDArray;
        $this->PermissibleGroupsIDArray = $PermissibleGroupsIDArray;
    }

    /**
     * @return string
     */
    public function getEndTime()
    {
        return $this->EndTime;
    }

    /**
     * @return int
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @return string
     */
    public function getPasswordHashed()
    {
        return $this->PasswordHashed;
    }

    /**
     * @return array
     */
    public function getPermissibleGroupsIDArray()
    {
        return $this->PermissibleGroupsIDArray;
    }

    /**
     * @return array
     */
    public function getPermissibleUsersIDArray()
    {
        return $this->PermissibleUsersIDArray;
    }

    /**
     * @return string
     */
    public function getStartTime()
    {
        return $this->StartTime;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @param string $EndTime
     */
    public function setEndTime($EndTime)
    {
        $this->EndTime = $EndTime;
    }

    /**
     * @param string $PasswordHashed
     */
    public function setPasswordHashed($PasswordHashed)
    {
        $this->PasswordHashed = $PasswordHashed;
    }

    /**
     * @param array $PermissibleGroupsIDArray
     */
    public function setPermissibleGroupsIDArray($PermissibleGroupsIDArray)
    {
        $this->PermissibleGroupsIDArray = $PermissibleGroupsIDArray;
    }

    /**
     * @param array $PermissibleUsersIDArray
     */
    public function setPermissibleUsersIDArray($PermissibleUsersIDArray)
    {
        $this->PermissibleUsersIDArray = $PermissibleUsersIDArray;
    }

    /**
     * @param string $StartTime
     */
    public function setStartTime($StartTime)
    {
        $this->StartTime = $StartTime;
    }

    /**
     * @param string $Title
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
    }

    /**
     * @return bool
     */
    public function isRunning()
    {
        if (strtotime($this->StartTime) < time() && time() < strtotime($this->EndTime)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function isRankTime()
    {
        if (time() < (strtotime($this->EndTime) - (60 * 60)) || strtotime($this->EndTime) < time()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        if (time() < strtotime($this->StartTime)) {
            return '未开始';
        } else if (strtotime($this->StartTime) < time() && time() < strtotime($this->EndTime)) {
            return '进行中';
        } else if (strtotime($this->EndTime) < time()) {
            return '已结束';
        } else {
            return '发生错误';
        }
    }

    /**
     * @return ProblemList
     */
    public function getProblemList()
    {
        return ProblemManager::getProblemListByContestID($this->ID);
    }

}