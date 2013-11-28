<?php

class ProblemList
{

    /**
     * @var array
     */
    private $ProblemArray = [];

    /**
     * @param Problem $thatProblem
     */
    public function addProblem($thatProblem)
    {
        if (!array_key_exists($thatProblem->getID(), $this->ProblemArray)) {
            $this->ProblemArray[$thatProblem->getID()] = $thatProblem;
        }
    }

    /**
     * @param Problem $thatProblem
     */
    public function removeProblem($thatProblem)
    {
        if (array_key_exists($thatProblem->getID(), $this->ProblemArray)) {
            unset($this->ProblemArray[$thatProblem->getID()]);
        }
    }

    /**
     * @param int $ID
     * @return Problem
     */
    public function getProblemByID($ID)
    {
        if (array_key_exists($ID, $this->ProblemArray)) {
            return $this->ProblemArray[$ID];
        }
        return null;
    }

    /**
     * @return array
     */
    public function getProblemArray()
    {
        return $this->ProblemArray;
    }

    /**
     * @return AnswerList
     */
    public function getAnswerList()
    {
        $thatProblemIDArray = [];
        foreach ($this->ProblemArray as $thisProblem) {
            /** @var Problem $thisProblem */
            $thatProblemIDArray[] = $thisProblem->getID();
        }
        return AnswerManager::getAnswerListByProblemIDArray($thatProblemIDArray);
    }

}