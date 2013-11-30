<?php

class Answer
{
    /**
     * @var int
     */
    private $ID = 0;
    /**
     * @var int
     */
    private $ProblemID = 0;
    /**
     * @var int
     */
    private $UserID = 0;
    /**
     * @var int
     */
    private $LanguageCode = 0;
    /**
     * @var string
     */
    private $Language = '';
    /**
     * @var string
     */
    private $SourceCode = '';
    /**
     * @var int
     */
    private $UsedTime = 0;
    /**
     * @var int
     */
    private $UsedMemory = 0;
    /**
     * @var int
     */
    private $StatusCode = 0;
    /**
     * @var string
     */
    private $Status = '';
    /**
     * @var string
     */
    private $Info = '';
    /**
     * @var string
     */
    private $SubmitTime = '2000-01-01 00:00:00';
    /**
     * @var string
     */
    private $MarkedTime = '2000-01-01 00:00:00';

    function __construct(
        $ID = 0,
        $ProblemID = 0,
        $UserID = 0,
        $LanguageCode = 0,
        $SourceCode = '',
        $UsedTime = 0,
        $UsedMemory = 0,
        $StatusCode = 0,
        $Info = '',
        $SubmitTime = '2000-01-01 00:00:00',
        $MarkedTime = '2000-01-01 00:00:00'
    )
    {
        $this->ID         = $ID;
        $this->ProblemID  = $ProblemID;
        $this->UserID     = $UserID;
        $this->SourceCode = $SourceCode;
        $this->UsedTime   = $UsedTime;
        $this->UsedMemory = $UsedMemory;
        $this->Info       = $Info;
        $this->SubmitTime = $SubmitTime;
        $this->MarkedTime = $MarkedTime;

        $this->LanguageCode = $LanguageCode;
        switch ($LanguageCode) {
            case _LanguageCode_C:
                $this->Language = 'C';
                break;
            case _LanguageCode_CPP:
                $this->Language = 'C++';
                break;
            case _LanguageCode_Java:
                $this->Language = 'Java';
                break;
            case _LanguageCode_UnknownLanguage:
            default:
                $this->Language = 'Unknown';
                break;
        }

        $this->StatusCode = $StatusCode;
        switch ($StatusCode) {
            case _StatusCode_SystemError:
                $this->Status = "System Error";
                break;
            case _StatusCode_UnknownStatus:
                $this->Status = "Unknown Status";
                break;
            case _StatusCode_Pending:
                $this->Status = "Pending";
                break;
            case _StatusCode_Compiling:
                $this->Status = "Compiling";
                break;
            case _StatusCode_Running:
                $this->Status = "Running";
                break;
            case _StatusCode_Accepted:
                $this->Status = "Accepted";
                break;
            case _StatusCode_PresentationError:
                $this->Status = "Presentation Error";
                break;
            case _StatusCode_WrongAnswer:
                $this->Status = "Wrong Answer";
                break;
            case _StatusCode_TimeLimitExceeded:
                $this->Status = "Time Limit Exceeded";
                break;
            case _StatusCode_MemoryLimitExceeded:
                $this->Status = "Memory Limit Exceeded";
                break;
            case _StatusCode_OutputLimitExceeded:
                $this->Status = "Output Limit Exceeded";
                break;
            case _StatusCode_RuntimeError:
                $this->Status = "Runtime Error";
                break;
            case _StatusCode_CompileError:
                $this->Status = "Compile Error";
                break;
            default:
                $this->Status = "Unknown Status";
                break;
        }
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
    public function getLanguage()
    {
        return $this->Language;
    }

    /**
     * @return int
     */
    public function getLanguageCode()
    {
        return $this->LanguageCode;
    }

    /**
     * @return string
     */
    public function getMarkedTime()
    {
        return $this->MarkedTime;
    }

    /**
     * @return int
     */
    public function getProblemID()
    {
        return $this->ProblemID;
    }

    /**
     * @return string
     */
    public function getSourceCode()
    {
        return $this->SourceCode;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->StatusCode;
    }

    /**
     * @return string
     */
    public function getSubmitTime()
    {
        return $this->SubmitTime;
    }

    /**
     * @return int
     */
    public function getUsedMemory()
    {
        return $this->UsedMemory;
    }

    /**
     * @return int
     */
    public function getUsedTime()
    {
        return $this->UsedTime;
    }

    /**
     * @return int
     */
    public function getUserID()
    {
        return $this->UserID;
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->Info;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return User_Model::getUserByID($this->getUserID());
    }

    /**
     * @return Problem
     */
    public function getProblem()
    {
        return ProblemManager::getProblemByID($this->ProblemID);
    }

    public function setStatusToPending()
    {
        $this->StatusCode = _StatusCode_Pending;
        $this->Status     = 'Pending';
    }

}