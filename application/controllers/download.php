<?php

class download extends CI_Controller
{
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
        $this->load->helper('directory');
        $this->load->view('home/html-header', ['SoftwareNameList' => directory_map('public/software')]);
        $this->load->view('home/header');
        $this->load->view('home/download');
        $this->load->view('home/footer');
        $this->load->view('home/html-footer');
    }
}