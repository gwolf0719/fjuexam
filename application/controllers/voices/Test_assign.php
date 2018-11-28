<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_assign extends CI_Controller {


    public function index()
    {
        // $this->load->model('mod_voice_assign');
        $this->mod_user->chk_status();
        $data = array(
            'title'=> '試場分配',
            'path'=> 'voice/test_assign_index',
            'path_text'=> '英聽主選單 > 試場分配',
            // 'datalist'=> $this->mod_voice_assign->get_list(),
        );

         $this->load->view('layout', $data);

    }






}


?>