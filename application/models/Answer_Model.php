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
        $query = $CI->db->get();
        $row   = $query->row();
        if ($row) {
            $thatAnswer = new Answer(
                $row->ID,
                $row->ProblemID,
                $row->UserID,
                $row->LanguageCode,
                $row->SourceCode,
                $row->InputData,
                $row->OutputData,
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
     * @return AnswerList
     */
    public static function getAnswerList()
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('answer.*');
        $CI->db->from('answer');
        $query  = $CI->db->get();
        $result = $query->result();

        $thisAnswerList = new AnswerList();

        foreach ($result as $row) {
            $thatAnswer = new Answer(
                $row->ID,
                $row->ProblemID,
                $row->UserID,
                $row->LanguageCode,
                $row->SourceCode,
                $row->InputData,
                $row->OutputData,
                $row->UsedTime,
                $row->UsedMemory,
                $row->StatusCode,
                $row->Info,
                $row->SubmitTime,
                $row->MarkedTime
            );
            $thisAnswerList->addAnswer($thatAnswer);
        }

        return $thisAnswerList;
    }

    /**
     * @param int $UserID
     * @return AnswerList
     */
    public static function getAnswerListByUserID($UserID)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('answer.*');
        $CI->db->from('answer');
        $CI->db->where('answer.UserID', $UserID);
        $query  = $CI->db->get();
        $result = $query->result();

        $thisAnswerList = new AnswerList();

        foreach ($result as $row) {
            $thatAnswer = new Answer(
                $row->ID,
                $row->ProblemID,
                $row->UserID,
                $row->LanguageCode,
                $row->SourceCode,
                $row->InputData,
                $row->OutputData,
                $row->UsedTime,
                $row->UsedMemory,
                $row->StatusCode,
                $row->Info,
                $row->SubmitTime,
                $row->MarkedTime
            );
            $thisAnswerList->addAnswer($thatAnswer);
        }

        return $thisAnswerList;
    }


    /**
     * @param int $ProblemID
     * @return AnswerList
     */
    public static function getAnswerListByProblemID($ProblemID)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('answer.*');
        $CI->db->from('answer');
        $CI->db->where('answer.ProblemID', $ProblemID);
        $query  = $CI->db->get();
        $result = $query->result();

        $thisAnswerList = new AnswerList();

        foreach ($result as $row) {
            $thatAnswer = new Answer(
                $row->ID,
                $row->ProblemID,
                $row->UserID,
                $row->LanguageCode,
                $row->SourceCode,
                $row->InputData,
                $row->OutputData,
                $row->UsedTime,
                $row->UsedMemory,
                $row->StatusCode,
                $row->Info,
                $row->SubmitTime,
                $row->MarkedTime
            );
            $thisAnswerList->addAnswer($thatAnswer);
        }

        return $thisAnswerList;
    }

    /**
     * @param array $ProblemIDArray
     * @return AnswerList
     */
    public static function getAnswerListByProblemIDArray($ProblemIDArray)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('answer.*');
        $CI->db->from('answer');
        $CI->db->where('answer.ProblemID');
        foreach ($ProblemIDArray as $thisProblemID) {
            $CI->db->or_where('answer.ProblemID', $thisProblemID);
        }
        $query  = $CI->db->get();
        $result = $query->result();

        $thisAnswerList = new AnswerList();

        foreach ($result as $row) {
            $thatAnswer = new Answer(
                $row->ID,
                $row->ProblemID,
                $row->UserID,
                $row->LanguageCode,
                $row->SourceCode,
                $row->InputData,
                $row->OutputData,
                $row->UsedTime,
                $row->UsedMemory,
                $row->StatusCode,
                $row->Info,
                $row->SubmitTime,
                $row->MarkedTime
            );
            $thisAnswerList->addAnswer($thatAnswer);
        }

        return $thisAnswerList;
    }

    /**
     * @param int $Page
     * @param int $Limit
     * @return AnswerList
     */
    public static function getAnswerListByPageAndLimit($Page, $Limit)
    {
        /** @var CI $CI */
        $CI =& get_instance();
        $CI->db->select('answer.*');
        $CI->db->from('answer');
        $CI->db->limit($Limit, ($Page - 1) * $Limit);
        $query  = $CI->db->get();
        $result = $query->result();

        $thisAnswerList = new AnswerList();

        foreach ($result as $row) {
            $thatAnswer = new Answer(
                $row->ID,
                $row->ProblemID,
                $row->UserID,
                $row->LanguageCode,
                $row->SourceCode,
                $row->InputData,
                $row->OutputData,
                $row->UsedTime,
                $row->UsedMemory,
                $row->StatusCode,
                $row->Info,
                $row->SubmitTime,
                $row->MarkedTime
            );
            $thisAnswerList->addAnswer($thatAnswer);
        }

        return $thisAnswerList;
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
            'InputData'    => $thatAnswer->getInputData(),
            'OutputData'   => $thatAnswer->getOutputData(),
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
            'InputData'    => $thatAnswer->getInputData(),
            'OutputData'   => $thatAnswer->getOutputData(),
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