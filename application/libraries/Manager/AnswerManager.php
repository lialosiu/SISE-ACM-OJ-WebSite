<?php

class AnswerManager
{

    /**
     * @param Problem $Problem
     * @param User $User
     * @param int $LanguageCode
     * @param string $SourceCode
     * @return Answer
     * @throws Exception
     */
    public static function createAnswer($Problem, $User, $LanguageCode, $SourceCode)
    {
        $thatAnswer = new Answer(
            0,
            $Problem->getID(),
            $User->getID(),
            $LanguageCode,
            $SourceCode,
            0,
            0,
            _StatusCode_Pending,
            '',
            date("Y-m-d H:i:s", time()),
            '2000-01-01 00:00:00'
        );

        $thatAnswer = Answer_Model::addAnswer($thatAnswer);

        //检查新建结果
        if ($thatAnswer) {
            return $thatAnswer;
        } else {
            throw new Exception("数据库查询失败");
        }
    }

    /**
     * @param Answer $thatAnswer
     * @return Answer
     */
    public static function updateAnswer($thatAnswer)
    {
        return Answer_Model::updateAnswer($thatAnswer);
    }

    /**
     * @param int $ID
     * @return Answer
     */
    public static function getAnswerByID($ID)
    {
        return Answer_Model::getAnswerByID($ID);
    }

    /**
     * @param int $Page
     * @param int $Limit
     * @return AnswerList
     */
    public static function getAnswerList($Page = 0, $Limit = 0)
    {
        return Answer_Model::getAnswerList($Page, $Limit);
    }

    /**
     * @param int $ProblemID
     * @param int $Page
     * @param int $Limit
     * @return AnswerList
     */
    public static function getAnswerListByProblemID($ProblemID, $Page = 0, $Limit = 0)
    {
        return Answer_Model::getAnswerListByProblemID($ProblemID, $Page, $Limit);
    }

    /**
     * @param array $ProblemIDArray
     * @param int $Page
     * @param int $Limit
     * @return AnswerList
     */
    public static function getAnswerListByProblemIDArray($ProblemIDArray, $Page = 0, $Limit = 0)
    {
        return Answer_Model::getAnswerListByProblemIDArray($ProblemIDArray, $Page, $Limit);
    }

    /**
     * @param int $UserID
     * @param int $Page
     * @param int $Limit
     * @return AnswerList
     */
    public static function getAnswerListByUserID($UserID, $Page = 0, $Limit = 0)
    {
        return Answer_Model::getAnswerListByUserID($UserID, $Page, $Limit);
    }

    /**
     * @param $StatusCode
     * @param int $Page
     * @param int $Limit
     * @return AnswerList
     */
    public static function getAnswerListByStatusCode($StatusCode, $Page = 0, $Limit = 0)
    {
        return Answer_Model::getAnswerListByStatusCode($StatusCode, $Page, $Limit);
    }

    /**
     * @param Answer $thatAnswer
     * @return bool
     */
    public static function deleteAnswer($thatAnswer)
    {
        return Answer_Model::deleteAnswer($thatAnswer);
    }

}