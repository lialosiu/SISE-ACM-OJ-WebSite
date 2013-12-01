<?php

class Rank
{
    public static function all()
    {
        $RankData = [];

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

                foreach ($thatAnswerList->getAnswerArray() as $thisAnswer) {
                    /** @var Answer $thisAnswer */
                    if ($thisAnswer->getUserID() === $thisUser->getID()) {
                        if ($thisProblem->getID() === $thisAnswer->getProblemID()) {
                            $thisUserData['CountSubmit']++;
                            $thisProblemData['CountSubmit']++;
                            if ($thisAnswer->getStatusCode() == _StatusCode_Accepted) {
                                $thisProblemData['Accepted'] = true;
                            }
                        } else {
                            continue;
                        }
                    } else {
                        continue;
                    }
                }

                if ($thisProblemData['Accepted'] == true) {
                    $thisUserData['CountAccepted']++;
                }

                $thisUserData['Problem'][] = $thisProblemData;
            }

            $RankData[] = $thisUserData;
        }

        function sort_by_CountAccepted($a, $b)
        {
            if ($a['CountAccepted'] < $b['CountAccepted']) {
                return true;
            } else {
                return false;
            }
        }

        usort($RankData, "sort_by_CountAccepted");

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

                foreach ($thatAnswerList->getAnswerArray() as $thisAnswer) {
                    /** @var Answer $thisAnswer */
                    if ($thisAnswer->getUserID() === $thisUser->getID()) {
                        if ($thisProblem->getID() === $thisAnswer->getProblemID()) {
                            $thisUserData['CountSubmit']++;
                            $thisProblemData['CountSubmit']++;
                            if ($thisAnswer->getStatusCode() == _StatusCode_Accepted) {
                                $thisProblemData['Accepted']         = true;
                                $thisProblemData['AcceptedUsedTime'] = ceil((strtotime($thisAnswer->getSubmitTime()) - strtotime($thatContest->getStartTime())) / 60);
                            }
                        } else {
                            continue;
                        }
                    } else {
                        continue;
                    }
                }

                if ($thisProblemData['Accepted'] == true) {
                    $thisUserData['CountAccepted']++;
                    $thisUserData['UsedTime'] += $thisProblemData['AcceptedUsedTime'];
                    $thisUserData['UsedTime'] += ($thisProblemData['CountSubmit'] - 1) * 20;
                }

                $thisUserData['Problem'][] = $thisProblemData;
            }

            $RankData[] = $thisUserData;
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