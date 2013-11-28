<?php

class ProblemManager
{

    /**
     * @param User $CurrentUser
     * @param string $Title
     * @param string $ProblemDescription
     * @param string $InputDescription
     * @param string $OutputDescription
     * @param string $SampleInput
     * @param string $SampleOutput
     * @param string $Author
     * @param string $Source
     * @param string $Recommend
     * @param int $TimeLimitNormal
     * @param int $TimeLimitJava
     * @param int $MemoryLimitNormal
     * @param int $MemoryLimitJava
     * @param string $StandardInput
     * @param string $StandardOutput
     * @param string $Password
     * @param array $PermissibleUsersIDArray
     * @param array $PermissibleGroupsIDArray
     * @param int $ContestID
     * @throws Exception
     * @return Problem
     */
    public static function createProblem(
        $CurrentUser,
        $Title,
        $ProblemDescription,
        $InputDescription,
        $OutputDescription,
        $SampleInput,
        $SampleOutput,
        $Author,
        $Source,
        $Recommend,
        $TimeLimitNormal,
        $TimeLimitJava,
        $MemoryLimitNormal,
        $MemoryLimitJava,
        $StandardInput,
        $StandardOutput,
        $Password,
        $PermissibleUsersIDArray = [],
        $PermissibleGroupsIDArray = [],
        $ContestID = 0
    )
    {
        $_NowDateTime = date("Y-m-d H:i:s", time());

        $thatProblem = new Problem(
            0,
            $Title,
            $ProblemDescription,
            $InputDescription,
            $OutputDescription,
            $SampleInput,
            $SampleOutput,
            $Author,
            $Source,
            $Recommend,
            $TimeLimitNormal,
            $TimeLimitJava,
            $MemoryLimitNormal,
            $MemoryLimitJava,
            $StandardInput,
            $StandardOutput,
            $_NowDateTime,
            $CurrentUser->getID(),
            $_NowDateTime,
            $CurrentUser->getID(),
            $Password ? do_hash($Password) : '',
            $PermissibleUsersIDArray,
            $PermissibleGroupsIDArray,
            $ContestID
        );

        //新建问题
        $thatProblem = Problem_Model::addProblem($thatProblem);

        //检查新建结果
        if ($thatProblem) {
            //新建完成
            return $thatProblem;
        } else {
            //数据库查询失败
            throw new Exception("数据库查询失败");
        }
    }

    /**
     * @param Problem $thatProblem
     * @return \Problem
     */
    public static function updateProblem($thatProblem)
    {
        return Problem_Model::updateProblem($thatProblem);
    }

    /**
     * @param Problem $thatProblem
     * @return bool
     * @throws Exception
     */
    public static function deleteProblem($thatProblem)
    {
        //删除问题
        $deleteProblemResult = Problem_Model::deleteProblem($thatProblem);

        //检查结果
        if ($deleteProblemResult !== false) {
            return true;
        } else {
            //数据库查询失败
            throw new Exception("数据库查询失败");
        }
    }

    /**
     * @param Integer $ID
     * @return Problem
     */
    public static function getProblemByID($ID)
    {
        return Problem_Model::getProblemByID($ID);
    }

    /**
     * @param Integer $ID
     * @return ProblemList
     */
    public static function getProblemListByContestID($ID)
    {
        return Problem_Model::getProblemListByContestID($ID);
    }

    /**
     * @return ProblemList
     */
    public static function getProblemList()
    {
        return Problem_Model::getProblemList();
    }

    /**
     * @param Integer $Page
     * @param Integer $Limit
     * @return ProblemList
     */
    public static function getProblemListByPageAndLimit($Page, $Limit)
    {
        return Problem_Model::getProblemListByPageAndLimit($Page, $Limit);
    }
}