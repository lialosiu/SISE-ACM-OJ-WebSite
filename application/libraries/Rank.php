<?php

class Rank
{
    public static function all()
    {
        $RankData = [];

        /** @var CI $CI */
        $CI =& get_instance();

        $thatProblemList = ProblemManager::getProblemList();
        $thatAnswerList  = $thatProblemList->getAnswerList();
        $thatUserList    = $thatAnswerList->getUserList();

        foreach ($thatUserList->getUserArray() as $thisUser) {
            /** @var User $thisUser */;
            $thisUserData = [
                'ID'            => $thisUser->getID(),
                'Username'      => $thisUser->getUsername(),
                'Nickname'      => $thisUser->getNickname(),
                'Problem'       => [],
                'CountSubmit'   => 0,
                'CountAccepted' => 0,
            ];
            foreach ($thatProblemList->getProblemArray() as $thisProblem) {
                /** @var Problem $thisProblem */;
                $thisProblemData = [
                    'ID'          => $thisProblem->getID(),
                    'CountSubmit' => 0,
                    'Accepted'    => false,
                ];

                $thisUserData['Problem'][$thisProblem->getID()] = $thisProblemData;
            }

            $RankData[$thisUser->getID()] = $thisUserData;
        }

        foreach ($thatAnswerList->getAnswerArray() as $thisAnswer) {
            /** @var Answer $thisAnswer */
            if (!isset($RankData[$thisAnswer->getUserID()])) continue;
            $thisUserData = $RankData[$thisAnswer->getUserID()];
            if (!isset($thisUserData['Problem'][$thisAnswer->getProblemID()])) continue;
            $thisProblemData = $thisUserData['Problem'][$thisAnswer->getProblemID()];

            $thisUserData['CountSubmit']++;
            $thisProblemData['CountSubmit']++;
            if ($thisAnswer->getStatusCode() == _StatusCode_Accepted) {
                if ($thisProblemData['Accepted'] == false) {
                    $thisUserData['CountAccepted']++;
                    $thisProblemData['Accepted'] = true;
                }
            }

            $thisUserData['Problem'][$thisAnswer->getProblemID()] = $thisProblemData;
            $RankData[$thisAnswer->getUserID()]                   = $thisUserData;
        }

        function sort_by_CountAccepted_CountSubmit($a, $b)
        {
            if ($a['CountAccepted'] < $b['CountAccepted']) {
                return true;
            } else if ($a['CountAccepted'] == $b['CountAccepted']) {
                if ($a['CountSubmit'] > $b['CountSubmit']) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        usort($RankData, "sort_by_CountAccepted_CountSubmit");

        return $RankData;
    }

    public static function byContestID($ContestID)
    {
        $RankData = [];

        $thatContest     = ContestManager::getContestByID($ContestID);
        $thatProblemList = $thatContest->getProblemList();
        $thatAnswerList  = $thatProblemList->getAnswerList();
        $thatUserList    = $thatAnswerList->getUserList();

        foreach ($thatUserList->getUserArray() as $thisUser) {
            /** @var User $thisUser */;
            $thisUserData = [
                'ID'            => $thisUser->getID(),
                'Username'      => $thisUser->getUsername(),
                'Nickname'      => $thisUser->getNickname(),
                'Problem'       => [],
                'CountSubmit'   => 0,
                'CountAccepted' => 0,
                'UsedTime'      => 0
            ];
            foreach ($thatProblemList->getProblemArray() as $thisProblem) {
                /** @var Problem $thisProblem */;
                $thisProblemData = [
                    'ID'               => $thisProblem->getID(),
                    'CountSubmit'      => 0,
                    'Accepted'         => false,
                    'AcceptedUsedTime' => 0
                ];

                $thisUserData['Problem'][$thisProblem->getID()] = $thisProblemData;
            }

            $RankData[$thisUser->getID()] = $thisUserData;
        }

        foreach ($thatAnswerList->getAnswerArray() as $thisAnswer) {
            /** @var Answer $thisAnswer */
            if (!isset($RankData[$thisAnswer->getUserID()])) continue;
            $thisUserData = $RankData[$thisAnswer->getUserID()];
            if (!isset($thisUserData['Problem'][$thisAnswer->getProblemID()])) continue;
            $thisProblemData = $thisUserData['Problem'][$thisAnswer->getProblemID()];

            $thisUserData['CountSubmit']++;
            $thisProblemData['CountSubmit']++;
            if ($thisAnswer->getStatusCode() == _StatusCode_Accepted) {
                if ($thisProblemData['Accepted'] == false) {
                    $thisProblemData['Accepted']         = true;
                    $thisProblemData['AcceptedUsedTime'] = ceil((strtotime($thisAnswer->getSubmitTime()) - strtotime($thatContest->getStartTime())) / 60);
                    $thisUserData['CountAccepted']++;
                    $thisUserData['UsedTime'] += $thisProblemData['AcceptedUsedTime'];
                    $thisUserData['UsedTime'] += ($thisProblemData['CountSubmit'] - 1) * 20;
                } else {
                    $thisUserData['UsedTime'] += 20;
                    if (ceil((strtotime($thisAnswer->getSubmitTime()) - strtotime($thatContest->getStartTime())) / 60) < $thisProblemData['AcceptedUsedTime'])
                        $thisProblemData['AcceptedUsedTime'] = ceil((strtotime($thisAnswer->getSubmitTime()) - strtotime($thatContest->getStartTime())) / 60);
                }
            } else if ($thisProblemData['Accepted'] == true) {
                $thisUserData['UsedTime'] += 20;
            }

            $thisUserData['Problem'][$thisAnswer->getProblemID()] = $thisProblemData;
            $RankData[$thisAnswer->getUserID()]                   = $thisUserData;
        }

        function sort_by_CountAccepted($a, $b)
        {
            if ($a['CountAccepted'] < $b['CountAccepted']) {
                return true;
            } else if ($a['CountAccepted'] == $b['CountAccepted']) {
                if ($a['UsedTime'] > $b['UsedTime']) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        usort($RankData, "sort_by_CountAccepted");

        return $RankData;
    }

}