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
        $this->load->model('mod_voice_area');
        
        $datalist = array();
        $data = array(
            'title' => '考區試場資料',
            'path' => 'voice/import_test_area',
            'path_text' => ' > 英聽主選單 > 資料匯入作業 > 考區試場資料',
            "datalist"=> $this->mod_voice_area->voice_where_voice_area_main()
        );
        $this->load->view('voice/layout', $data);
    }
    /**
     * a3 工作人員資料
     */
    function staff_member(){
        
        $this->load->model('mod_voice_staff');
        $datalist = array();
        $data = array(
            'title' => '考區試場資料',
            'path' => 'voice/import_staff_member',
            'path_text' => ' > 英聽主選單 > 資料匯入作業 > 考區試場資料',
            "datalist"=>$this->mod_voice_staff-> voice_where_voice_import_staff_member()
        );
        $this->load->view('voice/layout', $data);
    }
    /**
     * a4 職務資料
     */
    function position(){
        // $this->load->model('Mod_voice_postiton_lsit');
        $datalist = array();
        $data = array(
            'title' => '職務資料',
            'path' => 'voice/import_position',
            'path_text' => ' > 英聽主選單 > 資料匯入作業 > 職務資料',
            "datalist"=>$datalist
        );
        $this->load->view('voice/layout', $data);
    }



}

/* End of file Import.php */
