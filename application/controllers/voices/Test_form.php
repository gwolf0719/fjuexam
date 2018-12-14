<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Test_form extends CI_Controller
{

    public function index()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '製作報表',
            'path' => 'voice/form_e',
            'path_text' => ' > 製作報表',
        );
        $this->load->view('voice_layout', $data);
    }

    public function e_1()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '名單 / 資料 / 統計表',
            'path' => 'voice/form_e1',
            'path_text' => ' > 製作報表 > 名單 / 資料 / 統計表',
        );
        $this->load->view('voice_layout', $data);
    }




}

?>