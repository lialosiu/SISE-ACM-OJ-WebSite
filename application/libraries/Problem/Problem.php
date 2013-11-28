<?php

/**
 * Class Problem
 */
class Problem
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
    private $ProblemDescription = '';

    /**
     * @var string
     */
    private $InputDescription = '';

    /**
     * @var string
     */
    private $OutputDescription = '';

    /**
     * @var string
     */
    private $SampleInput = '';

    /**
     * @var string
     */
    private $SampleOutput = '';

    /**
     * @var string
     */
    private $Author = '';

    /**
     * @var string
     */
    private $Source = '';

    /**
     * @var string
     */
    private $Recommend = '';

    /**
     * @var int
     */
    private $TimeLimitNormal = 0;

    /**
     * @var int
     */
    private $TimeLimitJava = 0;

    /**
     * @var int
     */
    private $MemoryLimitNormal = 0;

    /**
     * @var int
     */
    private $MemoryLimitJava = 0;

    /**
     * @var string
     */
    private $StandardInput = '';

    /**
     * @var string
     */
    private $StandardOutput = '';

    /**
     * @var string
     */
    private $AddDateTime = '2000-01-01 00:00:00';

    /**
     * @var int
     */
    private $AddUserID = 0;

    /**
     * @var string
     */
    private $LastEditDateTime = '2000-01-01 00:00:00';

    /**
     * @var int
     */
    private $LastEditUserID = 0;

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
     * @var int
     */
    private $ContestID = 0;

    /**
     * @param int $ID
     * @param string $Title
     * @param string $ProblemDescription
     * @param string $InputDescription
     * @param string $OutputDescription
     * @param string $SampleInput
     * @param string $SampleOutput
     * @param string $Author
     * @param string $Source
     * @param string $Recommend
     * @param int $TimeLimitNormal
     * @param int $TimeLimitJava
     * @param int $MemoryLimitNormal
     * @param int $MemoryLimitJava
     * @param string $StandardInput
     * @param string $StandardOutput
     * @param string $AddDateTime
     * @param int $AddUserID
     * @param string $LastEditDateTime
     * @param int $LastEditUserID
     * @param string $PasswordHashed
     * @param array $PermissibleUsersIDArray
     * @param array $PermissibleGroupsIDArray
     * @param int $ContestID
     */
    function __construct(
        $ID = 0,
        $Title = '',
        $ProblemDescription = '',
        $InputDescription = '',
        $OutputDescription = '',
        $SampleInput = '',
        $SampleOutput = '',
        $Author = '',
        $Source = '',
        $Recommend = '',
        $TimeLimitNormal = 0,
        $TimeLimitJava = 0,
        $MemoryLimitNormal = 0,
        $MemoryLimitJava = 0,
        $StandardInput = '',
        $StandardOutput = '',
        $AddDateTime = '2000-01-01 00:00:00',
        $AddUserID = 0,
        $LastEditDateTime = '2000-01-01 00:00:00',
        $LastEditUserID = 0,
        $PasswordHashed = '',
        $PermissibleUsersIDArray = [],
        $PermissibleGroupsIDArray = [],
        $ContestID = 0
    )
    {
        $this->ID                       = $ID;
        $this->Title                    = $Title;
        $this->ProblemDescription       = $ProblemDescription;
        $this->InputDescription         = $InputDescription;
        $this->OutputDescription        = $OutputDescription;
        $this->SampleInput              = $SampleInput;
        $this->SampleOutput             = $SampleOutput;
        $this->Author                   = $Author;
        $this->Source                   = $Source;
        $this->Recommend                = $Recommend;
        $this->PasswordHashed           = $PasswordHashed;
        $this->TimeLimitNormal          = $TimeLimitNormal;
        $this->TimeLimitJava            = $TimeLimitJava;
        $this->MemoryLimitNormal        = $MemoryLimitNormal;
        $this->MemoryLimitJava          = $MemoryLimitJava;
        $this->StandardInput            = $StandardInput;
        $this->StandardOutput           = $StandardOutput;
        $this->AddDateTime              = $AddDateTime;
        $this->AddUserID                = $AddUserID;
        $this->LastEditDateTime         = $LastEditDateTime;
        $this->LastEditUserID           = $LastEditUserID;
        $this->PermissibleGroupsIDArray = $PermissibleGroupsIDArray;
        $this->PermissibleUsersIDArray  = $PermissibleUsersIDArray;
        $this->ContestID                = $ContestID;
    }

    /**
     * @return string
     */
    public function getAddDateTime()
    {
        return $this->AddDateTime;
    }

    /**
     * @return int
     */
    public function getAddUserID()
    {
        return $this->AddUserID;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->Author;
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
    public function getInputDescription()
    {
        return $this->InputDescription;
    }

    /**
     * @return string
     */
    public function getLastEditDateTime()
    {
        return $this->LastEditDateTime;
    }

    /**
     * @return int
     */
    public function getLastEditUserID()
    {
        return $this->LastEditUserID;
    }

    /**
     * @return int
     */
    public function getMemoryLimitJava()
    {
        return $this->MemoryLimitJava;
    }

    /**
     * @return int
     */
    public function getMemoryLimitNormal()
    {
        return $this->MemoryLimitNormal;
    }

    /**
     * @return string
     */
    public function getOutputDescription()
    {
        return $this->OutputDescription;
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
    public function getProblemDescription()
    {
        return $this->ProblemDescription;
    }

    /**
     * @return string
     */
    public function getRecommend()
    {
        return $this->Recommend;
    }

    /**
     * @return string
     */
    public function getSampleInput()
    {
        return $this->SampleInput;
    }

    /**
     * @return string
     */
    public function getSampleOutput()
    {
        return $this->SampleOutput;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->Source;
    }

    /**
     * @return string
     */
    public function getStandardInput()
    {
        return $this->StandardInput;
    }

    /**
     * @return string
     */
    public function getStandardOutput()
    {
        return $this->StandardOutput;
    }

    /**
     * @return int
     */
    public function getTimeLimitJava()
    {
        return $this->TimeLimitJava;
    }

    /**
     * @return int
     */
    public function getTimeLimitNormal()
    {
        return $this->TimeLimitNormal;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @return int
     */
    public function getContestID()
    {
        return $this->ContestID;
    }

    /**
     * @param string $Author
     */
    public function setAuthor($Author)
    {
        $this->Author = $Author;
    }

    /**
     * @param string $InputDescription
     */
    public function setInputDescription($InputDescription)
    {
        $this->InputDescription = $InputDescription;
    }

    /**
     * @param string $LastEditDateTime
     */
    public function setLastEditDateTime($LastEditDateTime)
    {
        $this->LastEditDateTime = $LastEditDateTime;
    }

    /**
     * @param int $LastEditUserID
     */
    public function setLastEditUserID($LastEditUserID)
    {
        $this->LastEditUserID = $LastEditUserID;
    }

    /**
     * @param int $MemoryLimitJava
     */
    public function setMemoryLimitJava($MemoryLimitJava)
    {
        $this->MemoryLimitJava = $MemoryLimitJava;
    }

    /**
     * @param int $MemoryLimitNormal
     */
    public function setMemoryLimitNormal($MemoryLimitNormal)
    {
        $this->MemoryLimitNormal = $MemoryLimitNormal;
    }

    /**
     * @param string $OutputDescription
     */
    public function setOutputDescription($OutputDescription)
    {
        $this->OutputDescription = $OutputDescription;
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
     * @param string $ProblemDescription
     */
    public function setProblemDescription($ProblemDescription)
    {
        $this->ProblemDescription = $ProblemDescription;
    }

    /**
     * @param string $Recommend
     */
    public function setRecommend($Recommend)
    {
        $this->Recommend = $Recommend;
    }

    /**
     * @param string $SampleInput
     */
    public function setSampleInput($SampleInput)
    {
        $this->SampleInput = $SampleInput;
    }

    /**
     * @param string $SampleOutput
     */
    public function setSampleOutput($SampleOutput)
    {
        $this->SampleOutput = $SampleOutput;
    }

    /**
     * @param string $Source
     */
    public function setSource($Source)
    {
        $this->Source = $Source;
    }

    /**
     * @param string $StandardInput
     */
    public function setStandardInput($StandardInput)
    {
        $this->StandardInput = $StandardInput;
    }

    /**
     * @param string $StandardOutput
     */
    public function setStandardOutput($StandardOutput)
    {
        $this->StandardOutput = $StandardOutput;
    }

    /**
     * @param int $TimeLimitJava
     */
    public function setTimeLimitJava($TimeLimitJava)
    {
        $this->TimeLimitJava = $TimeLimitJava;
    }

    /**
     * @param int $TimeLimitNormal
     */
    public function setTimeLimitNormal($TimeLimitNormal)
    {
        $this->TimeLimitNormal = $TimeLimitNormal;
    }

    /**
     * @param string $Title
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
    }

    /**
     * @param int $ContestID
     */
    public function setContestID($ContestID)
    {
        $this->ContestID = $ContestID;
    }

    /**
     * @return User
     */
    public function getAddUser()
    {
        return UserManager::getUserByID($this->AddUserID);
    }

    /**
     * @return User
     */
    public function getLastEditUser()
    {
        return UserManager::getUserByID($this->LastEditUserID);
    }

    /**
     * @return AnswerList
     */
    public function getAnswerList()
    {
        return AnswerManager::getAnswerListByProblemID($this->ID);
    }

    /**
     * @return Contest
     */
    public function getContest(){
        return ContestManager::getContestByID($this->ID);
    }
}