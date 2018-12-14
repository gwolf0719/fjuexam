<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Console extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('subject_ability/mod_area');
    }
    

    public function index()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '學測主選單',
            'path' => 'subject_ability/index',
            'path_text' => ' > 學測主選單',
        );
        $this->load->view('layout', $data);
    }


    /**
     * a資料匯入作業.
     */
    public function a()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '資料匯入作業',
            'path' => 'subject_ability/a',
            'path_text' => ' > 學測主選單 > 資料匯入作業',
        );
        $this->load->view('layout', $data);
    }

}

/* End of file Console.php */
