<?php

class GroupList
{

    /**
     * @var array
     */
    private $GroupArray = [];

    /**
     * @param Group $thatGroup
     */
    public function addGroup($thatGroup)
    {
        if (!array_key_exists($thatGroup->getID(), $this->GroupArray)) {
            $this->GroupArray[$thatGroup->getID()] = $thatGroup;
        }
    }

    /**
     * @param Group $thatGroup
     */
    public function removeGroup($thatGroup)
    {
        if (array_key_exists($thatGroup->getID(), $this->GroupArray)) {
            unset($this->GroupArray[$thatGroup->getID()]);
        }
    }

    /**
     * @param int $ID
     * @return Group
     */
    public function getGroupByID($ID)
    {
        if (array_key_exists($ID, $this->GroupArray)) {
            return $this->GroupArray[$ID];
        }
        return null;
    }

    /**
     * @return array
     */
    public function getGroupArray()
    {
        return $this->GroupArray;
    }

}