<?php
class Answer_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param int $ID
     * @return Answer
     */
    public static function getAnswerByID($ID)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('answer.*');
        $CI->db->from('answer');
        $CI->db->where('answer.ID', $ID);
        $CI->db->order_by('answer.ID', 'desc');
        $query = $CI->db->get();
        $row   = $query->row();
        if ($row) {
            $thatAnswer = new Answer(
                $row->ID,
                $row->ProblemID,
                $row->UserID,
                $row->LanguageCode,
                $row->SourceCode,
                $row->UsedTime,
                $row->UsedMemory,
                $row->StatusCode,
                $row->Info,
                $row->SubmitTime,
                $row->MarkedTime
            );
            return $thatAnswer;
        } else
            return null;
    }


    /**
     * @param int $Page
     * @param int $Limit
     * @return AnswerList
     */
    public static function getAnswerList($Page = 0, $Limit = 0)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $thatAnswerList = new AnswerList($CI->db->count_all('answer'));

        $CI->db->select('answer.*');
        $CI->db->from('answer');
        $CI->db->order_by('answer.ID', 'desc');
        if ($Page > 0 && $Limit > 0) $CI->db->limit($Limit, ($Page - 1) * $Limit);
        $query  = $CI->db->get();
        $result = $query->result();
        foreach ($result as $row) {
            $thatAnswer = new Answer(
                $row->ID,
                $row->ProblemID,
                $row->UserID,
                $row->LanguageCode,
                $row->SourceCode,
                $row->UsedTime,
                $row->UsedMemory,
                $row->StatusCode,
                $row->Info,
                $row->SubmitTime,
                $row->MarkedTime
            );
            $thatAnswerList->addAnswer($thatAnswer);
        }

        return $thatAnswerList;
    }

    /**
     * @param int $UserID
     * @param int $Page
     * @param int $Limit
     * @return AnswerList
     */
    public static function getAnswerListByUserID($UserID, $Page = 0, $Limit = 0)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->from('answer');
        $CI->db->where('answer.UserID', $UserID);
        $countWithFilter = $CI->db->count_all_results();

        $thatAnswerList = new AnswerList($countWithFilter);

        $CI->db->select('answer.*');
        $CI->db->from('answer');
        $CI->db->where('answer.UserID', $UserID);
        $CI->db->order_by('answer.ID', 'desc');
        if ($Page > 0 && $Limit > 0) $CI->db->limit($Limit, ($Page - 1) * $Limit);
        $query  = $CI->db->get();
        $result = $query->result();
        foreach ($result as $row) {
            $thatAnswer = new Answer(
                $row->ID,
                $row->ProblemID,
                $row->UserID,
                $row->LanguageCode,
                $row->SourceCode,
                $row->UsedTime,
                $row->UsedMemory,
                $row->StatusCode,
                $row->Info,
                $row->SubmitTime,
                $row->MarkedTime
            );
            $thatAnswerList->addAnswer($thatAnswer);
        }

        return $thatAnswerList;
    }


    /**
     * @param int $ProblemID
     * @param int $Page
     * @param int $Limit
     * @return AnswerList
     */
    public static function getAnswerListByProblemID($ProblemID, $Page = 0, $Limit = 0)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->from('answer');
        $CI->db->where('answer.ProblemID', $ProblemID);
        $countWithFilter = $CI->db->count_all_results();

        $thatAnswerList = new AnswerList($countWithFilter);

        $CI->db->select('answer.*');
        $CI->db->from('answer');
        $CI->db->where('answer.ProblemID', $ProblemID);
        $CI->db->order_by('answer.ID', 'desc');
        if ($Page > 0 && $Limit > 0) $CI->db->limit($Limit, ($Page - 1) * $Limit);
        $query  = $CI->db->get();
        $result = $query->result();

        foreach ($result as $row) {
            $thatAnswer = new Answer(
                $row->ID,
                $row->ProblemID,
                $row->UserID,
                $row->LanguageCode,
                $row->SourceCode,
                $row->UsedTime,
                $row->UsedMemory,
                $row->StatusCode,
                $row->Info,
                $row->SubmitTime,
                $row->MarkedTime
            );
            $thatAnswerList->addAnswer($thatAnswer);
        }

        return $thatAnswerList;
    }

    /**
     * @param array $ProblemIDArray
     * @param int $Page
     * @param int $Limit
     * @return AnswerList
     */
    public static function getAnswerListByProblemIDArray($ProblemIDArray, $Page = 0, $Limit = 0)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->from('answer');
        foreach ($ProblemIDArray as $thisProblemID) {
            $CI->db->or_where('answer.ProblemID', $thisProblemID);
        }
        $countWithFilter = $CI->db->count_all_results();

        $thatAnswerList = new AnswerList($countWithFilter);

        $CI->db->select('answer.*');
        $CI->db->from('answer');
        foreach ($ProblemIDArray as $thisProblemID) {
            $CI->db->or_where('answer.ProblemID', $thisProblemID);
        }
        $CI->db->order_by('answer.ID', 'desc');
        if ($Page > 0 && $Limit > 0) $CI->db->limit($Limit, ($Page - 1) * $Limit);
        $query  = $CI->db->get();
        $result = $query->result();

        foreach ($result as $row) {
            $thatAnswer = new Answer(
                $row->ID,
                $row->ProblemID,
                $row->UserID,
                $row->LanguageCode,
                $row->SourceCode,
                $row->UsedTime,
                $row->UsedMemory,
                $row->StatusCode,
                $row->Info,
                $row->SubmitTime,
                $row->MarkedTime
            );
            $thatAnswerList->addAnswer($thatAnswer);
        }

        return $thatAnswerList;
    }

    /**
     * @param Answer $thatAnswer
     * @return Answer
     */
    public static function addAnswer($thatAnswer)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $insertResult = $CI->db->insert('answer', array(
            'ProblemID'    => $thatAnswer->getProblemID(),
            'UserID'       => $thatAnswer->getUserID(),
            'LanguageCode' => $thatAnswer->getLanguageCode(),
            'SourceCode'   => $thatAnswer->getSourceCode(),
            'UsedTime'     => $thatAnswer->getUsedTime(),
            'UsedMemory'   => $thatAnswer->getUsedMemory(),
            'StatusCode'   => $thatAnswer->getStatusCode(),
            'Info'         => $thatAnswer->getInfo(),
            'SubmitTime'   => $thatAnswer->getSubmitTime(),
            'MarkedTime'   => $thatAnswer->getMarkedTime(),
        ));
        if ($insertResult)
            return self::getAnswerByID($CI->db->insert_id());
        else
            return null;
    }


    /**
     * @param Answer $thatAnswer
     * @return Answer
     */
    public static function updateAnswer($thatAnswer)
    {
        /** @var CI $CI */
        $CI =& get_instance();

        $CI->db->where('ID', $thatAnswer->getID());
        $insertResult = $CI->db->update('answer', array(
            'ProblemID'    => $thatAnswer->getProblemID(),
            'UserID'       => $thatAnswer->getUserID(),
            'LanguageCode' => $thatAnswer->getLanguageCode(),
            'SourceCode'   => $thatAnswer->getSourceCode(),
            'UsedTime'     => $thatAnswer->getUsedTime(),
            'UsedMemory'   => $thatAnswer->getUsedMemory(),
            'StatusCode'   => $thatAnswer->getStatusCode(),
            'Info'         => $thatAnswer->getInfo(),
            'SubmitTime'   => $thatAnswer->getSubmitTime(),
            'MarkedTime'   => $thatAnswer->getMarkedTime(),
        ));
        if ($insertResult)
            return self::getAnswerByID($thatAnswer->getID());
        else
            return null;
    }

    /**
     * @param Answer $thatAnswer
     * @return bool
     */
    public static function deleteAnswer($thatAnswer)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->where('ID', $thatAnswer->getID());
        $deleteResult = $CI->db->delete('answer');
        if ($deleteResult)
            return true;
        else
            return false;
    }

}