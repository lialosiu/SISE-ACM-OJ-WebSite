<?php

/**
 * Class AnswerList
 */
class AnswerList
{
    /**
     * @var array
     */
    private $AnswerArray = [];

    /**
     * @var int
     */
    private $CountWithFilter = 0;

    /**
     * @var int
     */
    private $CountSubmit = 0;

    /**
     * @var int
     */
    private $CountUnknownStatus = 0;

    /**
     * @var int
     */
    private $CountSystemError = 0;

    /**
     * @var int
     */
    private $CountPending = 0;

    /**
     * @var int
     */
    private $CountCompiling = 0;

    /**
     * @var int
     */
    private $CountRunning = 0;

    /**
     * @var int
     */
    private $CountAccepted = 0;

    /**
     * @var int
     */
    private $CountPresentationError = 0;

    /**
     * @var int
     */
    private $CountWrongAnswer = 0;

    /**
     * @var int
     */
    private $CountRuntimeError = 0;

    /**
     * @var int
     */
    private $CountCompileError = 0;

    /**
     * @var int
     */
    private $CountTimeLimitExceeded = 0;

    /**
     * @var int
     */
    private $CountMemoryLimitExceeded = 0;

    /**
     * @var int
     */
    private $CountOutputLimitExceeded = 0;

    /**
     * @param int $CountWithFilter
     */
    function __construct($CountWithFilter = 0)
    {
        $this->CountWithFilter = $CountWithFilter;
    }

    /**
     * @param Answer $thatAnswer
     */
    public function addAnswer($thatAnswer)
    {
        if (!array_key_exists($thatAnswer->getID(), $this->AnswerArray)) {
            $this->AnswerArray[$thatAnswer->getID()] = $thatAnswer;
            $this->CountSubmit++;
            switch ($thatAnswer->getStatusCode()) {
                case _StatusCode_SystemError:
                    $this->CountSystemError++;
                    break;
                case _StatusCode_UnknownStatus:
                    $this->CountUnknownStatus++;
                    break;
                case _StatusCode_Pending:
                    $this->CountPending++;
                    break;
                case _StatusCode_Compiling:
                    $this->CountCompiling++;
                    break;
                case _StatusCode_Running:
                    $this->CountRunning++;
                    break;
                case _StatusCode_Accepted:
                    $this->CountAccepted++;
                    break;
                case _StatusCode_PresentationError:
                    $this->CountPresentationError++;
                    break;
                case _StatusCode_WrongAnswer:
                    $this->CountWrongAnswer++;
                    break;
                case _StatusCode_TimeLimitExceeded:
                    $this->CountTimeLimitExceeded++;
                    break;
                case _StatusCode_MemoryLimitExceeded:
                    $this->CountMemoryLimitExceeded++;
                    break;
                case _StatusCode_OutputLimitExceeded:
                    $this->CountOutputLimitExceeded++;
                    break;
                case _StatusCode_RuntimeError:
                    $this->CountRuntimeError++;
                    break;
                case _StatusCode_CompileError:
                    $this->CountCompileError++;
                    break;
                default:
                    $this->CountUnknownStatus++;
                    break;
            }
        }
    }

    /**
     * @param Answer $thatAnswer
     */
    public function removeAnswer($thatAnswer)
    {
        if (array_key_exists($thatAnswer->getID(), $this->AnswerArray)) {
            unset($this->AnswerArray[$thatAnswer->getID()]);
        }
    }

    /**
     * @param int $ID
     * @return Answer
     */
    public function getAnswerByID($ID)
    {
        if (array_key_exists($ID, $this->AnswerArray)) {
            return $this->AnswerArray[$ID];
        }
        return null;
    }

    /**
     * @return array
     */
    public function getAnswerArray()
    {
        return $this->AnswerArray;
    }

    /**
     * @return int
     */
    public function getCountWrongAnswer()
    {
        return $this->CountWrongAnswer;
    }

    /**
     * @return int
     */
    public function getCountAccepted()
    {
        return $this->CountAccepted;
    }

    /**
     * @return int
     */
    public function getCountCompileError()
    {
        return $this->CountCompileError;
    }

    /**
     * @return int
     */
    public function getCountCompiling()
    {
        return $this->CountCompiling;
    }

    /**
     * @return int
     */
    public function getCountMemoryLimitExceeded()
    {
        return $this->CountMemoryLimitExceeded;
    }

    /**
     * @return int
     */
    public function getCountOutputLimitExceeded()
    {
        return $this->CountOutputLimitExceeded;
    }

    /**
     * @return int
     */
    public function getCountPending()
    {
        return $this->CountPending;
    }

    /**
     * @return int
     */
    public function getCountPresentationError()
    {
        return $this->CountPresentationError;
    }

    /**
     * @return int
     */
    public function getCountRunning()
    {
        return $this->CountRunning;
    }

    /**
     * @return int
     */
    public function getCountRuntimeError()
    {
        return $this->CountRuntimeError;
    }

    /**
     * @return int
     */
    public function getCountSubmit()
    {
        return $this->CountSubmit;
    }

    /**
     * @return int
     */
    public function getCountSystemError()
    {
        return $this->CountSystemError;
    }

    /**
     * @return int
     */
    public function getCountTimeLimitExceeded()
    {
        return $this->CountTimeLimitExceeded;
    }

    /**
     * @return int
     */
    public function getCountUnknownStatus()
    {
        return $this->CountUnknownStatus;
    }

    /**
     * @return int
     */
    public function getCountWithFilter()
    {
        return $this->CountWithFilter;
    }

    /**
     * @return UserList
     */
    public function getUserList(){
        $thatAnswerIDArray = [];
        foreach ($this->AnswerArray as $thisAnswer)
        {
            /** @var Answer $thisAnswer */
            $thatAnswerIDArray[] = $thisAnswer->getUserID();
        }
        return UserManager::getUserListByUserIDArray($thatAnswerIDArray);
    }

}