<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intro extends CI_Controller {

    public function index()
    {
        $this->load->model('mod_voice_area');
        $this->mod_user->chk_status();
        $a=$this->mod_voice_area->check_a1();
        $b=$this->mod_voice_area->check_f();
        // print_r($a);
        // print_r($b);

        $data = array(
            'title' => '英聽主選單',
            'path' => 'voice/index',
            'path_text' => ' > 英聽主選單',
            'a1_check'=>$this->mod_voice_area->check_a1(),
            'f_check'=>$this->mod_voice_area->check_f(),
        );
        $this->load->view('voice/voice_layout', $data);
    }


}

/* End of file Import.php */
