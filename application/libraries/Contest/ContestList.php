<?php

class ContestList {

    /**
     * @var array
     */
    private $ContestArray = [];

    /**
     * @param Contest $thatContest
     */
    public function addContest($thatContest)
    {
        if (!array_key_exists($thatContest->getID(), $this->ContestArray)) {
            $this->ContestArray[$thatContest->getID()] = $thatContest;
        }
    }

    /**
     * @param Contest $thatContest
     */
    public function removeContest($thatContest)
    {
        if (array_key_exists($thatContest->getID(), $this->ContestArray)) {
            unset($this->ContestArray[$thatContest->getID()]);
        }
    }

    /**
     * @param int $ID
     * @return Contest
     */
    public function getContestByID($ID)
    {
        if (array_key_exists($ID, $this->ContestArray)) {
            return $this->ContestArray[$ID];
        }
        return null;
    }

    /**
     * @return array
     */
    public function getContestArray()
    {
        return $this->ContestArray;
    }
}