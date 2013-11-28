<?php

class Contest_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param int $ID
     * @return contest
     */
    public static function getContestByID($ID)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('contest.*');
        $CI->db->from('contest');
        $CI->db->where('contest.id', $ID);

        $query = $CI->db->get();
        $row   = $query->row();
        if ($row) {
            $thatContest = new Contest(
                $row->ID,
                $row->Title,
                $row->StartTime,
                $row->EndTime,
                $row->PasswordHashed,
                json_decode($row->PermissibleUsersIDJSON),
                json_decode($row->PermissibleGroupsIDJSON)
            );
            return $thatContest;
        } else
            return null;
    }


    /**
     * @return contest
     */
    public static function getContestList()
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('contest.*');
        $CI->db->from('contest');
        $query  = $CI->db->get();
        $result = $query->result();

        $thatContestList = new ContestList();

        foreach ($result as $row) {
            $thatContest = new Contest(
                $row->ID,
                $row->Title,
                $row->StartTime,
                $row->EndTime,
                $row->PasswordHashed,
                json_decode($row->PermissibleUsersIDJSON),
                json_decode($row->PermissibleGroupsIDJSON)
            );
            $thatContestList->addContest($thatContest);
        }
        return $thatContestList;
    }


    /**
     * @param int $Page
     * @param int $Limit
     * @return contest
     */
    public static function getContestListByPageAndLimit($Page, $Limit)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('contest.*');
        $CI->db->from('contest');
        $CI->db->limit($Limit, ($Page - 1) * $Limit);
        $query  = $CI->db->get();
        $result = $query->result();

        $thatContestList = new ContestList();

        foreach ($result as $row) {
            $thatContest = new Contest(
                $row->ID,
                $row->Title,
                $row->StartTime,
                $row->EndTime,
                $row->PasswordHashed,
                json_decode($row->PermissibleUsersIDJSON),
                json_decode($row->PermissibleGroupsIDJSON)
            );
            $thatContestList->addContest($thatContest);
        }
        return $thatContestList;
    }

    /**
     * @param Contest $thatContest
     * @return Contest
     */
    public static function addContest($thatContest)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $insertResult = $CI->db->insert('contest', array(
            'Title'                   => $thatContest->getTitle(),
            'StartTime'               => $thatContest->getStartTime(),
            'EndTime'                 => $thatContest->getEndTime(),
            'PasswordHashed'          => $thatContest->getPasswordHashed(),
            'PermissibleUsersIDJSON'  => json_encode($thatContest->getPermissibleUsersIDArray()),
            'PermissibleGroupsIDJSON' => json_encode($thatContest->getPermissibleGroupsIDArray())
        ));
        if ($insertResult)
            return self::getContestByID($CI->db->insert_id());
        else
            return null;
    }

    /**
     * @param Contest $thatContest
     * @return Contest
     */
    public static function updateContest($thatContest)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->where('ID', $thatContest->getID());

        $updateResult = $CI->db->update('contest', array(
            'Title'                   => $thatContest->getTitle(),
            'StartTime'               => $thatContest->getStartTime(),
            'EndTime'                 => $thatContest->getEndTime(),
            'PasswordHashed'          => $thatContest->getPasswordHashed(),
            'PermissibleUsersIDJSON'  => json_encode($thatContest->getPermissibleUsersIDArray()),
            'PermissibleGroupsIDJSON' => json_encode($thatContest->getPermissibleGroupsIDArray())
        ));
        if ($updateResult)
            return self::getContestByID($thatContest->getID());
        else
            return null;
    }

    /**
     * @param Contest $thatContest
     * @return bool
     */
    public static function deleteProblem($thatContest)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->where('ID', $thatContest->getID());
        $deleteResult = $CI->db->delete('contest');

        if ($deleteResult)
            return true;
        else
            return false;
    }


}