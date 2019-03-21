<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_duty extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('mod_voice_test_pay');
        $this->load->model('mod_voice_job_list');
        $this->load->model('mod_voice_exam_datetime');
    }
    

    public function index()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '考區任務編組主選單',
            'path' => 'voice/test_member_duty_index',
            'path_text' => ' > 考區任務編組主選單',
        );
        $this->load->view('voice_layout', $data);
    }
    function duty($block){
        $block = urldecode($block);
        
        switch ($block) {
            case '考區':
                $test_partition = 0;
                break;
            case '第一分區':
                $test_partition = 1;
                break;
            case '第二分區':
                $test_partition = 2;
                break;
            case '第三分區':
                $test_partition = 3;
                break;
               
        }
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');
        $job = $this->mod_voice_job_list->get_job_list($year,$test_partition);
        $fees_info = $this->mod_voice_test_pay->get_once($year,$ladder);
        $datatime_info = $this->mod_voice_exam_datetime->get_once($year,$ladder);
        

        $datalist = array();
        
        $this->mod_user->chk_status();
        $data = array(
            'title'=> $block.'任務編組主選單',
            'path'=> 'voice/duty_b1',
            'path_text'=>' > 英聽主選單 > 考區任務編組 >'.$block.'任務編組主選單',
            'datalist'=> $this->mod_voice_job_list->voice_where_voice_area($test_partition),
            'fees_info'=>$fees_info,
            'job'=>$job,
            'datatime_info'=>$datatime_info,
            'test_partition'=>$test_partition,
            'block'=> $test_partition,

        );
        $this->load->view('voice_layout', $data);
    }

    /**
     * 預覽任務編組表
     */
    public function duty_b5()
    {
        $this->load->model('mod_voice_job_list');
        $this->mod_user->chk_status();
        $data = array(
            'title' => '預覽任務編組表',
            'path' => 'voice/duty_b5',
            'path_text' => ' > 英聽主選單 > 考區任務編組 > 預覽任務編組表',
            'all' => $this->mod_voice_job_list->get_list(),
            'b1' => $this->mod_voice_job_list->get_list(0),
            'b2' => $this->mod_voice_job_list->get_list(1),
            'b3' => $this->mod_voice_job_list->get_list(2),
            'b4' => $this->mod_voice_job_list->get_list(3),
        );
        $this->load->view('voice_layout', $data);
    }

  
    
    






}
?>