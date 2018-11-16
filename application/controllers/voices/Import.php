<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
*資料匯入
*/
class Import extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->mod_user->chk_status();
    }
    

    /**
     * a資料匯入作業.
     */
    public function index()
    {
        $data = array(
            'title' => '資料匯入作業',
            'path' => 'voice/intro_import',
            'path_text' => ' > 英聽主選單 > 資料匯入作業',
        );
        $this->load->view('voice/layout', $data);
    }

    /**
     * a1 考區試場資料
     */
    function test_area(){
        
        $datalist = array();
        $data = array(
            'title' => '考區試場資料',
            'path' => 'voice/import_test_area',
            'path_text' => ' > 英聽主選單 > 資料匯入作業 > 考區試場資料',
            "datalist"=>$datalist
        );
        $this->load->view('voice/layout', $data);
    }
    /**
     * a3 工作人員資料
     */
    function staff_member(){
        
        $datalist = array();
        $data = array(
            'title' => '考區試場資料',
            'path' => 'voice/import_test_area',
            'path_text' => ' > 英聽主選單 > 資料匯入作業 > 考區試場資料',
            "datalist"=>$datalist
        );
        $this->load->view('voice/layout', $data);
    }
    function a4(){

    }



}

/* End of file Import.php */
