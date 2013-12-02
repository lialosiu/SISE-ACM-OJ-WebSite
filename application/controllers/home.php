<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    /** @var User $CurrentUser */
    private $CurrentUser;

    public function __construct()
    {
        parent::__construct();
        $this->CurrentUser    = UserManager::getCurrentUserBySession();
        $thatNotificationList = NotificationManager::getNotificationList();
        $this->load->view('vars', [
            'CurrentUser'          => $this->CurrentUser,
            'thatNotificationList' => $thatNotificationList,
        ]);
    }

    public function index()
    {
        $this->load->view('home/html-header');
        $this->load->view('home/header');
        $this->load->view('home/homepage');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function listUser()
    {
        $thatGroupList = GroupManager::getGroupList();

        $showingGroupID = $this->input->get('g');
        $thatUserList   = null;
        if (isset($showingGroupID) && is_numeric($showingGroupID)) $thatUserList = UserManager::getUserListByGroupID($showingGroupID);
        else $thatUserList = UserManager::getUserList();

        $this->load->view('home/html-header', [
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
        $thatUser = UserManager::getUserByID($ID);

        $this->load->view('home/html-header', [
            'thatUser' => $thatUser
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
        $thatGroupList = GroupManager::getGroupList();
        $thatUser      = UserManager::getUserByID($ID);

        //检查权限
        if (!$this->CurrentUser->isAdministrator() && $this->CurrentUser->getID() != $ID) {
            show_404();
        }

        $this->load->view('home/html-header', [
            'thatUser'      => $thatUser,
            'thatGroupList' => $thatGroupList
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
        $thatGroupList = GroupManager::getGroupList();

        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        $this->load->view('home/html-header', [
            'thatGroupList' => $thatGroupList,
        ]);
        $this->load->view('home/header');

        $this->load->view('home/user-group-add');

        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function createGroup()
    {
        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        $this->load->view('home/html-header');
        $this->load->view('home/header');
        $this->load->view('home/group-add');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function listProblem()
    {
        $thatProblemList = ProblemManager::getProblemList();

        $this->load->view('home/html-header', [
            'thatProblemList' => $thatProblemList
        ]);
        $this->load->view('home/header');
        $this->load->view('home/problem-list');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function showProblem($ID = 0)
    {
        $thatProblem = ProblemManager::getProblemByID($ID);

        $this->load->view('home/html-header', [
            'thatProblem' => $thatProblem
        ]);
        $this->load->view('home/header');

        //检查权限
        if ($thatProblem->getPasswordHashed() &&
            !in_array($this->CurrentUser->getID(), $thatProblem->getPermissibleUsersIDArray()) &&
            !in_array($this->CurrentUser->getGroupID(), $thatProblem->getPermissibleGroupsIDArray()) &&
            !$this->CurrentUser->isAdministrator()
        ) {
            if ($this->input->post('Password') === false) {
                $this->load->view('home/problem-password');
            } else if ($this->input->post('Password') && do_hash($this->input->post('Password')) === $thatProblem->getPasswordHashed()) {
                $this->load->view('home/problem-show');
            } else {
                $this->load->view('home/problem-password', ['alertDanger' => '密码错误']);
            }
        } else {
            $this->load->view('home/problem-show');
        }

        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function answerProblem($ID = 0)
    {
        $thatProblem = ProblemManager::getProblemByID($ID);

        $this->load->view('home/html-header', [
            'thatProblem' => $thatProblem
        ]);
        $this->load->view('home/header');
        $this->load->view('home/problem-answer');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function addProblem()
    {
        $thatGroupList   = GroupManager::getGroupList();
        $thatContestList = ContestManager::getContestList();

        $addToContestID = $this->input->get('c');
        if (!$addToContestID || !is_numeric($addToContestID)) $addToContestID = 0;

        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        $this->load->view('home/html-header', [
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
        $thatProblem     = ProblemManager::getProblemByID($ID);
        $thatGroupList   = GroupManager::getGroupList();
        $thatContestList = ContestManager::getContestList();

        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        $this->load->view('home/html-header', [
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
        $thatProblem = ProblemManager::getProblemByID($ID);

        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        $this->load->view('home/html-header', [
            'thatProblem' => $thatProblem
        ]);
        $this->load->view('home/header');
        $this->load->view('home/problem-delete');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function listContest()
    {
        $thatContestList = ContestManager::getContestList();

        $this->load->view('home/html-header', [
            'thatContestList' => $thatContestList
        ]);
        $this->load->view('home/header');
        $this->load->view('home/contest-list');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function showContest($ID = 0)
    {
        $thatContest = ContestManager::getContestByID($ID);

        $this->load->view('home/html-header', [
            'thatContest' => $thatContest
        ]);
        $this->load->view('home/header');

        //检查权限
        if ($this->CurrentUser->isAdministrator() || !$thatContest->getPasswordHashed()) {
            $this->load->view('home/contest-show');
        } else if ($thatContest->isRunning()) {
            if (in_array($this->CurrentUser->getID(), $thatContest->getPermissibleUsersIDArray()) || in_array($this->CurrentUser->getGroupID(), $thatContest->getPermissibleGroupsIDArray())) {
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
        $thatGroupList = GroupManager::getGroupList();

        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        $this->load->view('home/html-header', [
            'thatGroupList' => $thatGroupList
        ]);
        $this->load->view('home/header');
        $this->load->view('home/contest-add');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function editContest($ID = 0)
    {
        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        //检查参数
        if ($ID === 0 || !is_numeric($ID)) {
            show_404();
        }

        $thatGroupList = GroupManager::getGroupList();
        $thatContest   = ContestManager::getContestByID($ID);

        $this->load->view('home/html-header', [
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
        $thatContest  = ContestManager::getContestByID($ID);
        $thatRankData = Rank::byContestID($ID);

        $this->load->view('home/html-header', [
            'thatContest'  => $thatContest,
            'thatRankData' => $thatRankData
        ]);

        $this->load->view('home/header');
        $this->load->view('home/contest-rank');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function listAnswer($Page = 1, $Limit = _DefaultRowLimit_)
    {
        if (!is_numeric($Page) || !is_numeric($Limit) || !$Page > 0 || !$Limit > 0) {
            $Page  = 1;
            $Limit = _DefaultRowLimit_;
        }

        $thatAnswerList = AnswerManager::getAnswerList($Page, $Limit);

        $this->load->library('pagination');
        $this->pagination->initialize([
            'base_url'   => base_url('home/listAnswer'),
            'total_rows' => $thatAnswerList->getCountWithFilter(),
            'per_page'   => $Limit,
        ]);

        $this->load->view('home/html-header', [
            'thatAnswerList'     => $thatAnswerList,
            'thatPaginationHtml' => $this->pagination->create_links()
        ]);
        $this->load->view('home/header');
        $this->load->view('home/answer-list');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function listAnswerInContest($ContestID = 0, $Page = 1, $Limit = _DefaultRowLimit_)
    {
        if (!is_numeric($ContestID) || !$ContestID > 0) {
            show_404();
        }

        if (!is_numeric($Page) || !is_numeric($Limit) || !$Page > 0 || !$Limit > 0) {
            $Page  = 1;
            $Limit = _DefaultRowLimit_;
        }

        $thatContest = ContestManager::getContestByID($ContestID);
        if (!$thatContest) {
            show_404();
        }

        $thatProblemIDArray = [];
        foreach ($thatContest->getProblemList()->getProblemArray() as $thisProblem) {
            /** @var Problem $thisProblem */
            $thatProblemIDArray[] = $thisProblem->getID();
        }
        $thatAnswerList = AnswerManager::getAnswerListByProblemIDArray($thatProblemIDArray, $Page, $Limit);
        $this->load->library('pagination');
        $this->pagination->initialize([
            'base_url'   => base_url('home/listAnswerInContest/' . $thatContest->getID()),
            'total_rows' => $thatAnswerList->getCountWithFilter(),
            'per_page'   => $Limit,
        ]);

        $this->load->view('home/html-header', [
            'thatAnswerList'     => $thatAnswerList,
            'thatPaginationHtml' => $this->pagination->create_links()
        ]);
        $this->load->view('home/header');
        $this->load->view('home/answer-list');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function showAnswer($ID = 0)
    {
        $thatAnswer = AnswerManager::getAnswerByID($ID);

        if (!$thatAnswer) show_404();

        $thatProblem = $thatAnswer->getProblem();

        $this->load->view('home/html-header', [
            'thatAnswer'  => $thatAnswer,
            'thatProblem' => $thatProblem
        ]);
        $this->load->view('home/header');

        //检查权限
        if (($thatAnswer->getUserID() !== $this->CurrentUser->getID() && !$this->CurrentUser->isAdministrator())) {
            $this->load->view('home/alert-danger', ['alertDanger' => '无权限']);
        } else {
            $this->load->view('home/answer-show');
        }

        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function rank()
    {
        $thatRankData = Rank::all();

        $this->load->view('home/html-header', [
            'thatRankData' => $thatRankData
        ]);
        $this->load->view('home/header');
        $this->load->view('home/rank');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function listNotification()
    {
        $this->load->view('home/html-header');
        $this->load->view('home/header');
        $this->load->view('home/notification-list');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

    public function addNotification()
    {
        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        $this->load->view('home/html-header');
        $this->load->view('home/header');
        $this->load->view('home/notification-add');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }


    public function editNotification($ID = 0)
    {
        $thatNotification = NotificationManager::getNotificationByID($ID);

        if (!$thatNotification) show_404();

        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        $this->load->view('home/html-header', [
            'thatNotification' => $thatNotification,
        ]);
        $this->load->view('home/header');
        $this->load->view('home/notification-edit');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }

}