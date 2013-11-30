<?php

/**
 * Class Notification
 */
class Notification
{
    /**
     * @var int
     */
    private $ID;
    /**
     * @var string
     */
    private $Title;
    /**
     * @var string
     */
    private $Content;

    function __construct($ID = 0, $Title = '', $Content = '')
    {
        $this->ID      = $ID;
        $this->Title   = $Title;
        $this->Content = $Content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->Content;
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
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @param string $Content
     */
    public function setContent($Content)
    {
        $this->Content = $Content;
    }

    /**
     * @param string $Title
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
    }


}