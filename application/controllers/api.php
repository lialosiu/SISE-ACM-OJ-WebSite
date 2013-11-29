<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller
{
    private $CurrentUser;

    public function __construct()
    {
        parent::__construct();
        $this->CurrentUser = UserManager::getCurrentUserBySession();
    }

    public function index()
    {
        show_404();
    }

    public function register()
    {
        //检查有无post提交Username、Password1、Password2
        if ($this->input->post('Username') && $this->input->post('Password1') && $this->input->post('Password2')) {
            //有post提交Username、Password1、Password2

            if (strlen($this->input->post('Username')) < 3) {
                die('用户名太短');
            }

            //检查两次输入的密码是否匹配
            if ($this->input->post('Password1') === $this->input->post('Password2')) {
                //两次输入的密码匹配
                $username = $this->input->post('Username');
                $password = $this->input->post('Password1');

                //用户注册
                try {
                    UserManager::register($username, $password);
                } catch (Exception $ex) {
                    die($ex->getMessage());
                }

                //不是ajax请求，跳转到登录页面
                if (!$this->input->is_ajax_request()) redirect(base_url('login'));

            } else {
                //两次输入的密码不匹配
                if (!$this->input->is_ajax_request()) redirect(base_url('register'));
            }
        } else {
            //无post提交Username、Password1、Password2
            UserManager::logout();

            //不是ajax请求，跳转
            if (!$this->input->is_ajax_request()) redirect(base_url());
        }
    }

    public function createAGroupUser()
    {
        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        //检查参数
        if (
            $this->input->post('UsernamePre') === false ||
            $this->input->post('StartNumber') === false ||
            $this->input->post('EndNumber') === false ||
            $this->input->post('GroupID') === false ||
            !is_numeric($this->input->post('StartNumber')) ||
            !is_numeric($this->input->post('EndNumber')) ||
            !is_numeric($this->input->post('GroupID'))
        ) {
            show_404();
        }

        if (strlen($this->input->post('UsernamePre')) < 2) {
            die('用户名前缀太短');
        }

        if (is_numeric($this->input->post('StartNumber')) > is_numeric($this->input->post('EndNumber'))) {
            die('大小反了→_→');
        }

        $newUserData = [];

        for ($i = $this->input->post('StartNumber'); $i <= $this->input->post('EndNumber'); $i++) {
            $username = $this->input->post('UsernamePre') . str_pad($i, strlen($this->input->post('EndNumber')), "0", STR_PAD_LEFT);
            $password = sprintf('%05d', rand(0, 99999));

            //用户注册
            $thatUser = UserManager::addUser($username, $password, $this->input->post('GroupID'));

            $newUserData[] = ['ID' => $thatUser->getID(), 'Username' => $thatUser->getUsername(), 'Password' => $password];
        }

        var_dump($newUserData);
    }

    public function createGroup()
    {
        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        //检查参数
        if (
            $this->input->post('GroupName') === false
        ) {
            show_404();
        }

        if (strlen($this->input->post('GroupName')) < 2) {
            die('组名太短');
        }

        GroupManager::createGroup($this->input->post('GroupName'));

        //不是ajax请求，跳转
        if (!$this->input->is_ajax_request()) redirect(base_url('home/listUser'));
    }

    public function login()
    {
        //检查有无post提交Username与Password
        if ($this->input->post('Username') && $this->input->post('Password')) {
            //有post提交Username与Password

            $username = $this->input->post('Username');
            $password = $this->input->post('Password');

            try {
                UserManager::login($username, $password);
            } catch (Exception $ex) {
                die($ex->getMessage());
            }

            //不是ajax请求，跳转回首页
            if (!$this->input->is_ajax_request()) redirect(base_url());
        } else {
            //无post提交Username与Password

            UserManager::logout();

            //不是ajax请求，跳转
            if (!$this->input->is_ajax_request()) redirect(base_url());
        }
    }

    public function logout()
    {
        UserManager::logout();

        //不是ajax请求，跳转
        if (!$this->input->is_ajax_request()) redirect(base_url());
    }

    public function answerProblem()
    {
        //检查权限
        if ($this->CurrentUser->getID() == 0) {
            if (!$this->input->is_ajax_request()) redirect(base_url('login'));
            exit;
        }

        //检查表单合法性
        if ($this->input->post('ID') === false ||
            $this->input->post('LanguageCode') === false ||
            $this->input->post('SourceCode') === false ||
            !is_numeric($this->input->post('ID'))
        ) {
            //表单非法
            show_404();
        }

        $CurrentUser  = $this->CurrentUser;
        $thatProblem  = ProblemManager::getProblemByID($this->input->post('ID'));
        $LanguageCode = $this->input->post('LanguageCode');
        $SourceCode   = $this->input->post('SourceCode');

        AnswerManager::createAnswer($thatProblem, $CurrentUser, $LanguageCode, $SourceCode);

        ACMAnswerCheckerConnector::CheckPendingAnswer();

        //不是ajax请求，跳转
        if (!$this->input->is_ajax_request()) redirect(base_url('home/listAnswer/'));
    }

    public function addProblem()
    {
        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        //检查参数
        if (
            $this->input->post('Title') === false ||
            $this->input->post('ProblemDescription') === false ||
            $this->input->post('InputDescription') === false ||
            $this->input->post('OutputDescription') === false ||
            $this->input->post('SampleInput') === false ||
            $this->input->post('SampleOutput') === false ||
            $this->input->post('Author') === false ||
            $this->input->post('Source') === false ||
            $this->input->post('Recommend') === false ||
            $this->input->post('TimeLimitNormal') === false ||
            $this->input->post('TimeLimitJava') === false ||
            $this->input->post('MemoryLimitNormal') === false ||
            $this->input->post('MemoryLimitJava') === false ||
            $this->input->post('StandardInput') === false ||
            $this->input->post('StandardOutput') === false ||
            $this->input->post('Password') === false ||
            $this->input->post('Contest') === false
        ) {
            show_404();
        }

        $thatProblem = ProblemManager::createProblem(
            $this->CurrentUser,
            $this->input->post('Title'),
            $this->input->post('ProblemDescription'),
            $this->input->post('InputDescription'),
            $this->input->post('OutputDescription'),
            $this->input->post('SampleInput'),
            $this->input->post('SampleOutput'),
            $this->input->post('Author'),
            $this->input->post('Source'),
            $this->input->post('Recommend'),
            $this->input->post('TimeLimitNormal'),
            $this->input->post('TimeLimitJava'),
            $this->input->post('MemoryLimitNormal'),
            $this->input->post('MemoryLimitJava'),
            $this->input->post('StandardInput'),
            $this->input->post('StandardOutput'),
            $this->input->post('Password'),
            [],
            $this->input->post('PermissibleGroupsIDArray') ? $this->input->post('PermissibleGroupsIDArray') : [],
            $this->input->post('Contest')
        );

        if ($this->input->post('Contest') && $this->input->post('Contest') !== 0) {
            $thatContest = ContestManager::getContestByID($this->input->post('Contest'));
            $thatProblem->setPasswordHashed($thatContest->getPasswordHashed());
            $thatProblem->setPermissibleUsersIDArray($thatContest->getPermissibleUsersIDArray());
            $thatProblem->setPermissibleGroupsIDArray($thatContest->getPermissibleGroupsIDArray());
            ProblemManager::updateProblem($thatProblem);
        }

        //不是ajax请求，跳转
        if (!$this->input->is_ajax_request()) redirect(base_url('home/listProblem/' . $this->input->post('ID')));
    }

    public function editProblem()
    {
        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        //检查参数
        if (
            $this->input->post('ID') === false ||
            $this->input->post('Title') === false ||
            $this->input->post('ProblemDescription') === false ||
            $this->input->post('InputDescription') === false ||
            $this->input->post('OutputDescription') === false ||
            $this->input->post('SampleInput') === false ||
            $this->input->post('SampleOutput') === false ||
            $this->input->post('Author') === false ||
            $this->input->post('Source') === false ||
            $this->input->post('Recommend') === false ||
            $this->input->post('TimeLimitNormal') === false ||
            $this->input->post('TimeLimitJava') === false ||
            $this->input->post('MemoryLimitNormal') === false ||
            $this->input->post('MemoryLimitJava') === false ||
            $this->input->post('StandardInput') === false ||
            $this->input->post('StandardOutput') === false ||
            $this->input->post('Password') === false ||
            $this->input->post('Contest') === false ||
            !is_numeric($this->input->post('ID'))
        ) {
            show_404();
        }

        $thatProblem = ProblemManager::getProblemByID($this->input->post('ID'));

        $thatProblem->setTitle($this->input->post('Title'));
        $thatProblem->setProblemDescription($this->input->post('ProblemDescription'));
        $thatProblem->setInputDescription($this->input->post('InputDescription'));
        $thatProblem->setOutputDescription($this->input->post('OutputDescription'));
        $thatProblem->setSampleInput($this->input->post('SampleInput'));
        $thatProblem->setSampleOutput($this->input->post('SampleOutput'));
        $thatProblem->setAuthor($this->input->post('Author'));
        $thatProblem->setSource($this->input->post('Source'));
        $thatProblem->setRecommend($this->input->post('Recommend'));
        $thatProblem->setTimeLimitNormal($this->input->post('TimeLimitNormal'));
        $thatProblem->setTimeLimitJava($this->input->post('TimeLimitJava'));
        $thatProblem->setMemoryLimitNormal($this->input->post('MemoryLimitNormal'));
        $thatProblem->setMemoryLimitJava($this->input->post('MemoryLimitJava'));
        $thatProblem->setStandardInput($this->input->post('StandardInput'));
        $thatProblem->setStandardOutput($this->input->post('StandardOutput'));

        if ($this->input->post('Password'))
            $thatProblem->setPasswordHashed(do_hash($this->input->post('Password')));
        else
            $thatProblem->setPasswordHashed('');

        $thatProblem->setLastEditUserID($this->CurrentUser->getID());
        $thatProblem->setLastEditDateTime(date("Y-m-d H:i:s", time()));

        $thatProblem->setPermissibleGroupsIDArray($this->input->post('PermissibleGroupsIDArray') ? $this->input->post('PermissibleGroupsIDArray') : []);

        $thatProblem->setContestID($this->input->post('Contest'));

        if ($this->input->post('Contest') && $this->input->post('Contest') !== 0) {
            $thatContest = ContestManager::getContestByID($this->input->post('Contest'));
            $thatProblem->setPasswordHashed($thatContest->getPasswordHashed());
            $thatProblem->setPermissibleUsersIDArray($thatContest->getPermissibleUsersIDArray());
            $thatProblem->setPermissibleGroupsIDArray($thatContest->getPermissibleGroupsIDArray());
        }

        ProblemManager::updateProblem($thatProblem);

        /** @var Answer $thisAnswer */
        foreach ($thatProblem->getAnswerList()->getAnswerArray() as $thisAnswer) {
            $thisAnswer->setStatusToPending();
            AnswerManager::updateAnswer($thisAnswer);
        }

        //不是ajax请求，跳转
        if (!$this->input->is_ajax_request()) redirect(base_url('home/showProblem/' . $this->input->post('ID')));
    }

    public function deleteProblem()
    {
        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        //检查参数
        if (
            $this->input->post('ID') === false ||
            !is_numeric($this->input->post('ID'))
        ) {
            show_404();
        }

        $thatProblem = ProblemManager::getProblemByID($this->input->post('ID'));

        foreach ($thatProblem->getAnswerList()->getAnswerArray() as $thisAnswer) {
            /** @var Answer $thisAnswer */
            AnswerManager::deleteAnswer($thisAnswer);
        }

        ProblemManager::deleteProblem($thatProblem);

        //不是ajax请求，跳转
        if (!$this->input->is_ajax_request()) redirect(base_url('home/listProblem'));
    }

    public function addContest()
    {
        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        //检查参数
        if (
            $this->input->post('Title') === false ||
            $this->input->post('StartTime') === false ||
            $this->input->post('EndTime') === false ||
            $this->input->post('Password') === false ||
            $this->input->post('PermissibleGroupsIDArray') === false
        ) {
            show_404();
        }

        ContestManager::createContest(
            $this->input->post('Title'),
            date("Y-m-d H:i:s", strtotime($this->input->post('StartTime'))),
            date("Y-m-d H:i:s", strtotime($this->input->post('EndTime'))),
            $this->input->post('Password'),
            $this->input->post('PermissibleUsersIDArray') ? $this->input->post('PermissibleUsersIDArray') : [],
            $this->input->post('PermissibleGroupsIDArray') ? $this->input->post('PermissibleGroupsIDArray') : []
        );

        //不是ajax请求，跳转
        if (!$this->input->is_ajax_request()) redirect(base_url('home/listContest'));
    }

    public function editContest()
    {
        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        //检查参数
        if (
            $this->input->post('Title') === false ||
            $this->input->post('StartTime') === false ||
            $this->input->post('EndTime') === false ||
            $this->input->post('Password') === false ||
            $this->input->post('PermissibleGroupsIDArray') === false ||
            !is_numeric($this->input->post('ID')) ||
            $this->input->post('ID') == 0
        ) {
            show_404();
        }

        $thatContest = ContestManager::getContestByID($this->input->post('ID'));

        $thatContest->setTitle($this->input->post('Title'));
        $thatContest->setStartTime(date("Y-m-d H:i:s", strtotime($this->input->post('StartTime'))));
        $thatContest->setEndTime(date("Y-m-d H:i:s", strtotime($this->input->post('EndTime'))));

        if ($this->input->post('Password'))
            $thatContest->setPasswordHashed(do_hash($this->input->post('Password')));
        else
            $thatContest->setPasswordHashed('');

        $thatContest->setPermissibleGroupsIDArray($this->input->post('PermissibleGroupsIDArray'));

        $thatContest = ContestManager::updateContest($thatContest);

        foreach ($thatContest->getProblemList()->getProblemArray() as $thisProblem) {
            /** @var Problem $thisProblem */
            $thisProblem->setPasswordHashed($thatContest->getPasswordHashed());
            $thisProblem->setPermissibleUsersIDArray($thatContest->getPermissibleUsersIDArray());
            $thisProblem->setPermissibleGroupsIDArray($thatContest->getPermissibleGroupsIDArray());
            ProblemManager::updateProblem($thisProblem);
        }

        //不是ajax请求，跳转
        if (!$this->input->is_ajax_request()) redirect(base_url('home/listContest'));
    }

    public function recheckAnswer($AnswerID = 0)
    {
        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        //检查参数
        if (
            !is_numeric($AnswerID) ||
            $AnswerID == 0
        ) {
            show_404();
        }

        $thatAnswer = AnswerManager::getAnswerByID($AnswerID);

        $thatAnswer->setStatusToPending();

        AnswerManager::updateAnswer($thatAnswer);

        ACMAnswerCheckerConnector::CheckPendingAnswer();

        //不是ajax请求，跳转
        if (!$this->input->is_ajax_request()) redirect(base_url('home/listAnswer'));
    }

    public function recheckProblem($ProblemID = 0)
    {
        //检查权限
        if (!$this->CurrentUser->isAdministrator()) {
            show_404();
        }

        //检查参数
        if (
            !is_numeric($ProblemID) ||
            $ProblemID == 0
        ) {
            show_404();
        }

        $thatProblem = ProblemManager::getProblemByID($ProblemID);

        var_dump($thatProblem->getAnswerList());

        foreach ($thatProblem->getAnswerList()->getAnswerArray() as $thisAnswer) {
            /** @var Answer $thisAnswer */
            $thisAnswer->setStatusToPending();
            AnswerManager::updateAnswer($thisAnswer);
        }

        ACMAnswerCheckerConnector::CheckPendingAnswer();

        //不是ajax请求，跳转
        if (!$this->input->is_ajax_request()) redirect(base_url('home/listAnswer'));
    }

    public function getRankDataAsJSONByContestID($ContestID)
    {
        if (!$ContestID || !is_numeric($ContestID)) {
            show_404();
        }

        $thatContest = ContestManager::getContestByID($ContestID);

        if ($thatContest) {
            //检查权限
            if ($this->CurrentUser->isAdministrator() || $thatContest->isRankTime()) {
                exit(json_encode(Rank::byContestID($ContestID)));
            } else {
                exit;
            }
        } else {
            show_404();
        }
    }

}