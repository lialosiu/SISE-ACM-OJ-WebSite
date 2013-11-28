<?php
class Problem_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param int $ID
     * @return Problem
     */
    public static function getProblemByID($ID)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->select('problem.*');
        $CI->db->from('problem');
        $CI->db->where('problem.ID', $ID);
        $query = $CI->db->get();
        $row   = $query->row();
        if ($row) {
            $thatProblem = new Problem(
                $row->ID,
                $row->Title,
                $row->ProblemDescription,
                $row->InputDescription,
                $row->OutputDescription,
                $row->SampleInput,
                $row->SampleOutput,
                $row->Author,
                $row->Source,
                $row->Recommend,
                $row->TimeLimitNormal,
                $row->TimeLimitJava,
                $row->MemoryLimitNormal,
                $row->MemoryLimitJava,
                $row->StandardInput,
                $row->StandardOutput,
                $row->AddDateTime,
                $row->AddUserID,
                $row->LastEditDateTime,
                $row->LastEditUserID,
                $row->PasswordHashed,
                json_decode($row->PermissibleUsersIDJSON),
                json_decode($row->PermissibleGroupsIDJSON),
                $row->ContestID
            );
            return $thatProblem;
        } else
            return null;
    }

    /**
     * @param int $ContestID
     * @return ProblemList
     */
    public static function getProblemListByContestID($ContestID)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('problem.*');
        $CI->db->from('problem');
        $CI->db->where('problem.ContestID', $ContestID);
        $query  = $CI->db->get();
        $result = $query->result();

        $thisProblemList = new ProblemList();

        foreach ($result as $row) {
            $thatProblem = new Problem(
                $row->ID,
                $row->Title,
                $row->ProblemDescription,
                $row->InputDescription,
                $row->OutputDescription,
                $row->SampleInput,
                $row->SampleOutput,
                $row->Author,
                $row->Source,
                $row->Recommend,
                $row->TimeLimitNormal,
                $row->TimeLimitJava,
                $row->MemoryLimitNormal,
                $row->MemoryLimitJava,
                $row->StandardInput,
                $row->StandardOutput,
                $row->AddDateTime,
                $row->AddUserID,
                $row->LastEditDateTime,
                $row->LastEditUserID,
                $row->PasswordHashed,
                json_decode($row->PermissibleUsersIDJSON),
                json_decode($row->PermissibleGroupsIDJSON),
                $row->ContestID
            );
            $thisProblemList->addProblem($thatProblem);
        }
        return $thisProblemList;
    }

    /**
     * @return ProblemList
     */
    public static function getProblemList()
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('problem.*');
        $CI->db->from('problem');
        $query  = $CI->db->get();
        $result = $query->result();

        $thisProblemList = new ProblemList();

        foreach ($result as $row) {
            $thatProblem = new Problem(
                $row->ID,
                $row->Title,
                $row->ProblemDescription,
                $row->InputDescription,
                $row->OutputDescription,
                $row->SampleInput,
                $row->SampleOutput,
                $row->Author,
                $row->Source,
                $row->Recommend,
                $row->TimeLimitNormal,
                $row->TimeLimitJava,
                $row->MemoryLimitNormal,
                $row->MemoryLimitJava,
                $row->StandardInput,
                $row->StandardOutput,
                $row->AddDateTime,
                $row->AddUserID,
                $row->LastEditDateTime,
                $row->LastEditUserID,
                $row->PasswordHashed,
                json_decode($row->PermissibleUsersIDJSON),
                json_decode($row->PermissibleGroupsIDJSON),
                $row->ContestID
            );
            $thisProblemList->addProblem($thatProblem);
        }
        return $thisProblemList;
    }

    /**
     * @param int $Page
     * @param int $Limit
     * @return ProblemList
     */
    public static function getProblemListByPageAndLimit($Page, $Limit)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('problem.*');
        $CI->db->from('problem');
        $CI->db->limit($Limit, ($Page - 1) * $Limit);
        $query  = $CI->db->get();
        $result = $query->result();

        $thisProblemList = new ProblemList();

        foreach ($result as $row) {
            $thatProblem = new Problem(
                $row->ID,
                $row->Title,
                $row->ProblemDescription,
                $row->InputDescription,
                $row->OutputDescription,
                $row->SampleInput,
                $row->SampleOutput,
                $row->Author,
                $row->Source,
                $row->Recommend,
                $row->TimeLimitNormal,
                $row->TimeLimitJava,
                $row->MemoryLimitNormal,
                $row->MemoryLimitJava,
                $row->StandardInput,
                $row->StandardOutput,
                $row->AddDateTime,
                $row->AddUserID,
                $row->LastEditDateTime,
                $row->LastEditUserID,
                $row->PasswordHashed,
                json_decode($row->PermissibleUsersIDJSON),
                json_decode($row->PermissibleGroupsIDJSON),
                $row->ContestID
            );
            $thisProblemList->addProblem($thatProblem);
        }
        return $thisProblemList;
    }

    /**
     * @param Problem $thatProblem
     * @return Problem
     */
    public static function addProblem($thatProblem)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $insertResult = $CI->db->insert('problem', array(
            'Title'                   => $thatProblem->getTitle(),
            'ProblemDescription'      => $thatProblem->getProblemDescription(),
            'InputDescription'        => $thatProblem->getInputDescription(),
            'OutputDescription'       => $thatProblem->getOutputDescription(),
            'SampleInput'             => $thatProblem->getSampleInput(),
            'SampleOutput'            => $thatProblem->getSampleOutput(),
            'Author'                  => $thatProblem->getAuthor(),
            'Source'                  => $thatProblem->getSource(),
            'Recommend'               => $thatProblem->getRecommend(),

            'TimeLimitNormal'         => $thatProblem->getTimeLimitNormal(),
            'TimeLimitJava'           => $thatProblem->getTimeLimitJava(),
            'MemoryLimitNormal'       => $thatProblem->getMemoryLimitNormal(),
            'MemoryLimitJava'         => $thatProblem->getMemoryLimitJava(),

            'StandardInput'           => $thatProblem->getStandardInput(),
            'StandardOutput'          => $thatProblem->getStandardOutput(),

            'AddDateTime'             => $thatProblem->getAddDateTime(),
            'AddUserID'               => $thatProblem->getAddUserID(),
            'LastEditDateTime'        => $thatProblem->getLastEditDateTime(),
            'LastEditUserID'          => $thatProblem->getLastEditUserID(),

            'PasswordHashed'          => $thatProblem->getPasswordHashed(),

            'PermissibleUsersIDJSON'  => json_encode($thatProblem->getPermissibleUsersIDArray()),
            'PermissibleGroupsIDJSON' => json_encode($thatProblem->getPermissibleGroupsIDArray()),

            'ContestID'               => $thatProblem->getContestID()
        ));
        if ($insertResult)
            return Problem_Model::getProblemByID($CI->db->insert_id());
        else
            return null;
    }

    /**
     * @param Problem $thatProblem
     * @return Problem
     */
    public static function updateProblem($thatProblem)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->where('ID', $thatProblem->getID());
        $updateResult = $CI->db->update('problem', array(
            'Title'                   => $thatProblem->getTitle(),
            'ProblemDescription'      => $thatProblem->getProblemDescription(),
            'InputDescription'        => $thatProblem->getInputDescription(),
            'OutputDescription'       => $thatProblem->getOutputDescription(),
            'SampleInput'             => $thatProblem->getSampleInput(),
            'SampleOutput'            => $thatProblem->getSampleOutput(),
            'Author'                  => $thatProblem->getAuthor(),
            'Source'                  => $thatProblem->getSource(),
            'Recommend'               => $thatProblem->getRecommend(),

            'TimeLimitNormal'         => $thatProblem->getTimeLimitNormal(),
            'TimeLimitJava'           => $thatProblem->getTimeLimitJava(),
            'MemoryLimitNormal'       => $thatProblem->getMemoryLimitNormal(),
            'MemoryLimitJava'         => $thatProblem->getMemoryLimitJava(),

            'StandardInput'           => $thatProblem->getStandardInput(),
            'StandardOutput'          => $thatProblem->getStandardOutput(),

            'AddDateTime'             => $thatProblem->getAddDateTime(),
            'AddUserID'               => $thatProblem->getAddUserID(),
            'LastEditDateTime'        => $thatProblem->getLastEditDateTime(),
            'LastEditUserID'          => $thatProblem->getLastEditUserID(),

            'PasswordHashed'          => $thatProblem->getPasswordHashed(),

            'PermissibleUsersIDJSON'  => json_encode($thatProblem->getPermissibleUsersIDArray()),
            'PermissibleGroupsIDJSON' => json_encode($thatProblem->getPermissibleGroupsIDArray()),

            'ContestID'               => $thatProblem->getContestID()
        ));
        if ($updateResult)
            return Problem_Model::getProblemByID($thatProblem->getID());
        else
            return null;
    }

    /**
     * @param Problem $thatProblem
     * @return bool
     */
    public static function deleteProblem($thatProblem)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->where('ID', $thatProblem->getID());
        $deleteResult = $CI->db->delete('problem');

        if ($deleteResult)
            return true;
        else
            return false;
    }

}
