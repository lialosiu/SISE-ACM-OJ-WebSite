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
            '',
            '',
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
     * @return AnswerList
     */
    public static function getAnswerList()
    {
        return Answer_Model::getAnswerList();
    }

    /**
     * @param int $ProblemID
     * @return AnswerList
     */
    public static function getAnswerListByProblemID($ProblemID)
    {
        return Answer_Model::getAnswerListByProblemID($ProblemID);
    }

    /**
     * @param array $ProblemIDArray
     * @return AnswerList
     */
    public static function getAnswerListByProblemIDArray($ProblemIDArray)
    {
        return Answer_Model::getAnswerListByProblemIDArray($ProblemIDArray);
    }

    /**
     * @param int $UserID
     * @return AnswerList
     */
    public static function getAnswerListByUserID($UserID)
    {
        return Answer_Model::getAnswerListByUserID($UserID);
    }

    /**
     * @param int $Page
     * @param int $Limit
     * @return AnswerList
     */
    public static function getAnswerListByPageAndLimit($Page, $Limit)
    {
        return Answer_Model::getAnswerListByPageAndLimit($Page, $Limit);
    }

}