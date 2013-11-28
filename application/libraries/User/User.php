<?php

/**
 * Class User
 */
class User
{
    /**
     * @var int
     */
    protected $ID = 0;
    /**
     * @var string
     */
    protected $Username = '';
    /**
     * @var string
     */
    protected $PasswordHashed = '';
    /**
     * @var string
     */
    protected $Salt = '';
    /**
     * @var string
     */
    protected $Nickname = '';
    /**
     * @var int
     */
    protected $GroupID = 0;
    /**
     * @var string
     */
    protected $LastActivityIP = '';
    /**
     * @var string
     */
    protected $LastActivityTime = '2000-01-01 00:00:00';
    /**
     * @var string
     */
    protected $LastLoginIP = '';
    /**
     * @var string
     */
    protected $LastLoginTime = '2000-01-01 00:00:00';

    /**
     * @param int $ID
     * @param string $Username
     * @param string $Nickname
     * @param string $PasswordHashed
     * @param string $Salt
     * @param int $GroupID
     * @param string $LastActivityIP
     * @param string $LastActivityTime
     * @param string $LastLoginIP
     * @param string $LastLoginTime
     */
    function __construct(
        $ID = 0,
        $Username = "Guest",
        $Nickname = "Guest",
        $PasswordHashed = '',
        $Salt = '',
        $GroupID = 0,
        $LastActivityIP = '',
        $LastActivityTime = '2000-01-01 00:00:00',
        $LastLoginIP = '',
        $LastLoginTime = '2000-01-01 00:00:00'
    )
    {
        $this->ID               = $ID;
        $this->Username         = $Username;
        $this->Nickname         = $Nickname;
        $this->PasswordHashed   = $PasswordHashed;
        $this->Salt             = $Salt;
        $this->GroupID          = $GroupID;
        $this->LastActivityIP   = $LastActivityIP;
        $this->LastActivityTime = $LastActivityTime;
        $this->LastLoginIP      = $LastLoginIP;
        $this->LastLoginTime    = $LastLoginTime;
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
    public function getLastActivityIP()
    {
        return $this->LastActivityIP;
    }

    /**
     * @return string
     */
    public function getLastActivityTime()
    {
        return $this->LastActivityTime;
    }

    /**
     * @return string
     */
    public function getLastLoginIP()
    {
        return $this->LastLoginIP;
    }

    /**
     * @return string
     */
    public function getLastLoginTime()
    {
        return $this->LastLoginTime;
    }

    /**
     * @return string
     */
    public function getNickname()
    {
        return $this->Nickname;
    }

    /**
     * @return string
     */
    public function getPasswordHashed()
    {
        return $this->PasswordHashed;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->Salt;
    }

    /**
     * @return int
     */
    public function getGroupID()
    {
        return $this->GroupID;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->Username;
    }

    /**
     * @param string $LastActivityIP
     */
    public function setLastActivityIP($LastActivityIP)
    {
        $this->LastActivityIP = $LastActivityIP;
    }

    /**
     * @param string $LastActivityTime
     */
    public function setLastActivityTime($LastActivityTime)
    {
        $this->LastActivityTime = $LastActivityTime;
    }

    /**
     * @param string $LastLoginIP
     */
    public function setLastLoginIP($LastLoginIP)
    {
        $this->LastLoginIP = $LastLoginIP;
    }

    /**
     * @param string $LastLoginTime
     */
    public function setLastLoginTime($LastLoginTime)
    {
        $this->LastLoginTime = $LastLoginTime;
    }

    /**
     * @param string $Nickname
     */
    public function setNickname($Nickname)
    {
        $this->Nickname = $Nickname;
    }

    /**
     * @param string $PasswordHashed
     */
    public function setPasswordHashed($PasswordHashed)
    {
        $this->PasswordHashed = $PasswordHashed;
    }

    /**
     * @param int $GroupID
     */
    public function setGroupID($GroupID)
    {
        $this->GroupID = $GroupID;
    }

    /**
     * @param string $Username
     */
    public function setUsername($Username)
    {
        $this->Username = $Username;
    }

    /**
     * @return \AnswerList
     */
    public function getAnswerList()
    {
        return AnswerManager::getAnswerListByUserID($this->ID);
    }

    /**
     * @return bool
     */
    public function isAdministrator()
    {
        if ($this->GroupID == -1)
            return true;
        else
            return false;
    }

    /**
     * @return Group
     */
    public function getGroup()
    {
        return GroupManager::getGroupByID($this->GroupID);
    }

}