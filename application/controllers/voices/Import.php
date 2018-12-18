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
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        
        $datalist = array();

  
       

        $data = array(
            'title' => '考區試場資料',
            'path' => 'voice/import_test_area',
            'path_text' => ' > 英聽主選單 > 資料匯入作業 > 考區試場資料',
            "datalist"=> $this->mod_voice_area->voice_where_voice_area_main()
        );
        $this->load->view('voice/voice_layout', $data);
    }

    public function school_data()
    {
        $this->load->model('mod_school_unit');
        $this->mod_user->chk_status();
        if (isset($_FILES['file'])) { // 如果有接收到上傳檔案資料
            // print_r($_FILES);
            $file = $_FILES['file']['tmp_name'];
            $file_name = './tmp/'.time().'.csv';
            copy($file, $file_name);
            $file = fopen($file_name, 'r');
            $datas = array();
            fgetcsv($file);
            while (!feof($file)) {
                $data = fgetcsv($file);
                // print_r($data);
                $datas[] = array(
                     'sn' => uniqid(),
                     'year' => $this->session->userdata('year'),
                     'department' => $data[0],
                     'code' => $data[1],
                     'company_name_01' => $data[2],
                     'company_name_02' => $data[3],
                 );
                // print_r($datas);
            }
            // echo json_encode($datas);

            $this->mod_school_unit->import($datas);
            fclose($file);
            unlink($file_name);
            //  print_r(fgetcsv($file));
            redirect('voice/school_data');
        } else {
            $data = array(
                'title' => '本校單位資料',
                'path' => 'voice/school_data',
                'path_text' => ' > 指考主選單 > 資料匯入作業 > 本校單位資料',
                'datalist' => $this->mod_school_unit->year_get_list(),
            );
            $this->load->view('voice/voice_layout', $data);
        }
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
            "datalist"=>$this->mod_voice_staff->voice_where_voice_import_staff_member()
        );
        $this->load->view('voice/voice_layout', $data);
    }
    /**
     * a4 職務資料
     */
    function position(){

        $this->load->model('mod_voice_job_list');
        $test_partition =  $this->input->get('area');
        $datalist = array();
        $datalist1 = array();
        $datalist2 = array();
        $datalist3 = array();
        $datalist4 = array();
        $data = array(
            'title' => '職務資料',
            'path' => 'voice/import_position',
            'path_text' => ' > 英聽主選單 > 資料匯入作業 > 職務資料',
            "datalist"=>$this->mod_voice_job_list->voice_where_voice_position(),
            'datalist1'=>$this->mod_voice_job_list->voice_where_voice_area(0),
            'datalist2'=>$this->mod_voice_job_list->voice_where_voice_area(1),
            'datalist3'=>$this->mod_voice_job_list->voice_where_voice_area(2),
            'datalist4'=>$this->mod_voice_job_list->voice_where_voice_area(3)
        );
        $this->load->view('voice/voice_layout', $data);
    }



}

/* End of file Import.php */
