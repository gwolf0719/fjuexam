<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Voice  extends CI_Controller
{
    public function index()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title'=>'英聽主選單',
            'path'=>'voice/index',
            'path_text'=>'英聽主選單',

        );
        $this->load->view('layout',$data);
        
    }



    
    
}

















































?>