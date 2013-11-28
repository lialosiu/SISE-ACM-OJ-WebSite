<?php

/**
 * Class UserList
 */
class UserList
{

    /**
     * @var array
     */
    private $UserArray = [];

    /**
     * @param User $thatUser
     */
    public function addUser($thatUser)
    {
        if (!array_key_exists($thatUser->getID(), $this->UserArray)) {
            $this->UserArray[$thatUser->getID()] = $thatUser;
        }
    }

    /**
     * @param User $thatUser
     */
    public function removeUser($thatUser)
    {
        if (array_key_exists($thatUser->getID(), $this->UserArray)) {
            unset($this->UserArray[$thatUser->getID()]);
        }
    }

    /**
     * @param int $ID
     * @return User
     */
    public function getUserByID($ID)
    {
        if (array_key_exists($ID, $this->UserArray)) {
            return $this->UserArray[$ID];
        }
        return null;
    }

    /**
     * @return array
     */
    public function getUserArray()
    {
        return $this->UserArray;
    }

}