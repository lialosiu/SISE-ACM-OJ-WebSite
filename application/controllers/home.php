<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $CurrentUser = UserManager::getCurrentUserBySession();

        $this->load->view('home/html-header', [
            'CurrentUser' => $CurrentUser
        ]);
        $this->load->view('home/header');
        $this->load->view('home/homepage');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function listUser()
    {
        $CurrentUser   = UserManager::getCurrentUserBySession();
        $thatGroupList = GroupManager::getGroupList();

        $showingGroupID = $this->input->get('g');
        $thatUserList   = null;
        if (isset($showingGroupID) && is_numeric($showingGroupID)) $thatUserList = UserManager::getUserListByGroupID($showingGroupID);
        else $thatUserList = UserManager::getUserList();

        $this->load->view('home/html-header', [
            'CurrentUser'    => $CurrentUser,
            'thatUserList'   => $thatUserList,
            'thatGroupList'  => $thatGroupList,
            'showingGroupID' => $showingGroupID
        ]);
        $this->load->view('home/header');
        $this->load->view('home/user-list');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function showUser($ID = 0)
    {
        $CurrentUser = UserManager::getCurrentUserBySession();
        $thatUser    = UserManager::getUserByID($ID);

        $this->load->view('home/html-header', [
            'CurrentUser' => $CurrentUser,
            'thatUser'    => $thatUser
        ]);
        $this->load->view('home/header');

        if ($thatUser->getID() === 0) {
            $this->load->view('home/alert-show', ['alertDanger' => '用户不存在']);
        } else {
            $this->load->view('home/user-show');
        }

        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function editUser($ID = 0)
    {
        $CurrentUser = UserManager::getCurrentUserBySession();
        $thatUser    = UserManager::getUserByID($ID);

        //检查权限
        if (!$CurrentUser->isAdministrator() || $thatUser->getID() != $ID) {
            show_404();
        }

        $this->load->view('home/html-header', [
            'CurrentUser' => $CurrentUser,
            'thatUser'    => $thatUser
        ]);
        $this->load->view('home/header');

        if ($thatUser->getID() === 0) {
            $this->load->view('home/alert-show', ['alertDanger' => '用户不存在']);
        } else {
            $this->load->view('home/user-edit');
        }

        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function createAGroupUser()
    {
        $CurrentUser   = UserManager::getCurrentUserBySession();
        $thatGroupList = GroupManager::getGroupList();

        //检查权限
        if (!$CurrentUser->isAdministrator()) {
            show_404();
        }

        $this->load->view('home/html-header', [
            'CurrentUser'   => $CurrentUser,
            'thatGroupList' => $thatGroupList,
        ]);
        $this->load->view('home/header');

        $this->load->view('home/user-group-add');

        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function createGroup()
    {
        $CurrentUser = UserManager::getCurrentUserBySession();

        //检查权限
        if (!$CurrentUser->isAdministrator()) {
            show_404();
        }

        $this->load->view('home/html-header', [
            'CurrentUser' => $CurrentUser,
        ]);
        $this->load->view('home/header');

        $this->load->view('home/group-add');

        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function listProblem()
    {
        $CurrentUser     = UserManager::getCurrentUserBySession();
        $thatProblemList = ProblemManager::getProblemList();

        $this->load->view('home/html-header', [
            'CurrentUser'     => $CurrentUser,
            'thatProblemList' => $thatProblemList
        ]);
        $this->load->view('home/header');
        $this->load->view('home/problem-list');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function showProblem($ID = 0)
    {
        $CurrentUser = UserManager::getCurrentUserBySession();
        $thatProblem = ProblemManager::getProblemByID($ID);

        $this->load->view('home/html-header', [
            'CurrentUser' => $CurrentUser,
            'thatProblem' => $thatProblem
        ]);
        $this->load->view('home/header');

        //检查权限
        if ($thatProblem->getPasswordHashed() &&
            !in_array($CurrentUser->getID(), $thatProblem->getPermissibleUsersIDArray()) &&
            !in_array($CurrentUser->getGroupID(), $thatProblem->getPermissibleGroupsIDArray()) &&
            !$CurrentUser->isAdministrator()
        ) {
            if ($this->input->post('Password') === false) {
                $this->load->view('home/problem-password');
            } else if ($this->input->post('Password') && do_hash($this->input->post('Password')) !== $thatProblem->getPasswordHashed()) {
                $this->load->view('home/problem-password', ['alertDanger' => '密码错误']);
            } else {
                $this->load->view('home/problem-show');
            }
        } else {
            $this->load->view('home/problem-show');
        }

        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function answerProblem($ID = 0)
    {
        $CurrentUser = UserManager::getCurrentUserBySession();
        $thatProblem = ProblemManager::getProblemByID($ID);

        $this->load->view('home/html-header', [
            'CurrentUser' => $CurrentUser,
            'thatProblem' => $thatProblem
        ]);
        $this->load->view('home/header');
        $this->load->view('home/problem-answer');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function addProblem()
    {
        $CurrentUser     = UserManager::getCurrentUserBySession();
        $thatGroupList   = GroupManager::getGroupList();
        $thatContestList = ContestManager::getContestList();

        $addToContestID = $this->input->get('c');
        if (!$addToContestID || !is_numeric($addToContestID)) $addToContestID = 0;

        //检查权限
        if (!$CurrentUser->isAdministrator()) {
            show_404();
        }

        $this->load->view('home/html-header', [
            'CurrentUser'     => $CurrentUser,
            'thatGroupList'   => $thatGroupList,
            'thatContestList' => $thatContestList,
            'addToContestID'  => $addToContestID
        ]);
        $this->load->view('home/header');
        $this->load->view('home/problem-add');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function editProblem($ID = 0)
    {
        $CurrentUser     = UserManager::getCurrentUserBySession();
        $thatProblem     = ProblemManager::getProblemByID($ID);
        $thatGroupList   = GroupManager::getGroupList();
        $thatContestList = ContestManager::getContestList();

        //检查权限
        if (!$CurrentUser->isAdministrator()) {
            show_404();
        }

        $this->load->view('home/html-header', [
            'CurrentUser'     => $CurrentUser,
            'thatProblem'     => $thatProblem,
            'thatGroupList'   => $thatGroupList,
            'thatContestList' => $thatContestList
        ]);
        $this->load->view('home/header');
        $this->load->view('home/problem-edit');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function deleteProblem($ID = 0)
    {
        $CurrentUser = UserManager::getCurrentUserBySession();
        $thatProblem = ProblemManager::getProblemByID($ID);

        //检查权限
        if (!$CurrentUser->isAdministrator()) {
            show_404();
        }

        $this->load->view('home/html-header', [
            'CurrentUser' => $CurrentUser,
            'thatProblem' => $thatProblem
        ]);
        $this->load->view('home/header');
        $this->load->view('home/problem-delete');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function listContest()
    {
        $CurrentUser     = UserManager::getCurrentUserBySession();
        $thatContestList = ContestManager::getContestList();

        $this->load->view('home/html-header', [
            'CurrentUser'     => $CurrentUser,
            'thatContestList' => $thatContestList
        ]);
        $this->load->view('home/header');
        $this->load->view('home/contest-list');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function showContest($ID = 0)
    {
        $CurrentUser = UserManager::getCurrentUserBySession();
        $thatContest = ContestManager::getContestByID($ID);

        $this->load->view('home/html-header', [
            'CurrentUser' => $CurrentUser,
            'thatContest' => $thatContest
        ]);
        $this->load->view('home/header');

        //检查权限
        if ($CurrentUser->isAdministrator() || !$thatContest->getPasswordHashed()) {
            $this->load->view('home/contest-show');
        } else if ($thatContest->isRunning()) {
            if (in_array($CurrentUser->getID(), $thatContest->getPermissibleUsersIDArray()) || in_array($CurrentUser->getGroupID(), $thatContest->getPermissibleGroupsIDArray())) {
                $this->load->view('home/contest-show');
            } else if ($this->input->post('Password')) {
                if (do_hash($this->input->post('Password')) === $thatContest->getPasswordHashed()) {
                    $this->load->view('home/contest-show');
                } else {
                    $this->load->view('home/contest-password', ['alertDanger' => '密码错误']);
                }
            } else {
                $this->load->view('home/contest-password');
            }
        } else {
            $this->load->view('home/alert-show', ['alertWarning' => '非比赛时间']);
        }

        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function addContest()
    {
        $CurrentUser   = UserManager::getCurrentUserBySession();
        $thatGroupList = GroupManager::getGroupList();

        //检查权限
        if (!$CurrentUser->isAdministrator()) {
            show_404();
        }

        $this->load->view('home/html-header', [
            'CurrentUser'   => $CurrentUser,
            'thatGroupList' => $thatGroupList
        ]);
        $this->load->view('home/header');
        $this->load->view('home/contest-add');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function editContest($ID = 0)
    {
        $CurrentUser = UserManager::getCurrentUserBySession();

        //检查权限
        if (!$CurrentUser->isAdministrator()) {
            show_404();
        }

        //检查参数
        if ($ID === 0 || !is_numeric($ID)) {
            show_404();
        }

        $thatGroupList = GroupManager::getGroupList();
        $thatContest   = ContestManager::getContestByID($ID);

        $this->load->view('home/html-header', [
            'CurrentUser'   => $CurrentUser,
            'thatGroupList' => $thatGroupList,
            'thatContest'   => $thatContest
        ]);
        $this->load->view('home/header');
        $this->load->view('home/contest-edit');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function rankContest($ID)
    {
        $CurrentUser  = UserManager::getCurrentUserBySession();
        $thatContest  = ContestManager::getContestByID($ID);
        $thatRankData = Rank::byContestID($ID);

        $this->load->view('home/html-header', [
            'CurrentUser'  => $CurrentUser,
            'thatContest'  => $thatContest,
            'thatRankData' => $thatRankData
        ]);

        $this->load->view('home/header');
        $this->load->view('home/contest-rank');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }


    public function listAnswer()
    {
        $CurrentUser    = UserManager::getCurrentUserBySession();
        $thatAnswerList = AnswerManager::getAnswerList();

        $this->load->view('home/html-header', [
            'CurrentUser'    => $CurrentUser,
            'thatAnswerList' => $thatAnswerList
        ]);
        $this->load->view('home/header');
        $this->load->view('home/answer-list');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function showAnswer($ID = 0)
    {
        $CurrentUser = UserManager::getCurrentUserBySession();
        $thatAnswer  = AnswerManager::getAnswerByID($ID);

        if (!$thatAnswer) show_404();

        $thatProblem = $thatAnswer->getProblem();

        $this->load->view('home/html-header', [
            'CurrentUser' => $CurrentUser,
            'thatAnswer'  => $thatAnswer,
            'thatProblem' => $thatProblem
        ]);
        $this->load->view('home/header');

        //检查权限
        if (($thatAnswer->getUserID() !== $CurrentUser->getID() && !$CurrentUser->isAdministrator())) {
            $this->load->view('home/alert-danger', ['alertDanger' => '无权限']);
        } else {
            $this->load->view('home/answer-show');
        }

        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function rank()
    {
        $CurrentUser  = UserManager::getCurrentUserBySession();
        $thatRankData = Rank::all();

        $this->load->view('home/html-header', [
            'CurrentUser'  => $CurrentUser,
            'thatRankData' => $thatRankData
        ]);
        $this->load->view('home/header');
        $this->load->view('home/rank');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }


}