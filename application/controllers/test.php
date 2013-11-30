<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller
{
    public function index()
    {
        $this->input->post('ID');
        $this->load->library('upload', ['upload_path' => 'D:/ProblemStdData/', 'allowed_types' => '*', 'encrypt_name' => true]);

        var_dump($this->input->post());
        $this->upload->do_upload('file1');
        echo $this->upload->display_errors();
        var_dump($this->upload->data());
        $this->upload->do_upload('file2');
        echo $this->upload->display_errors();
        var_dump($this->upload->data());
    }

}