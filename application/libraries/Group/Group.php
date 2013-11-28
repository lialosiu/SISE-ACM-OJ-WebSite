<?php

/**
 * Class Group
 */
class Group
{
    /**
     * @var int
     */
    private $ID = 0;
    /**
     * @var string
     */
    private $GroupName = '';

    function __construct($ID = 0, $GroupName = '')
    {
        $this->ID        = $ID;
        $this->GroupName = $GroupName;
    }

    /**
     * @return string
     */
    public function getGroupName()
    {
        return $this->GroupName;
    }

    /**
     * @return int
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param string $GroupName
     */
    public function setGroupName($GroupName)
    {
        $this->GroupName = $GroupName;
    }


}