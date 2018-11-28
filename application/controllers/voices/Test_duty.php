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
        $this->load->view('layout', $data);
    }
    function duty($block){
        $block = urldecode($block);
        $year = $this->session->userdata('year');
        $job = $this->mod_voice_job_list->get_job_list($year,$block);
        if ($this->mod_voice_test_pay->chk_once($year)) {
            $fees_info = $this->mod_voice_test_pay->get_once($year);
        } else {
            $fees_info = array(
                'pay_1' => '0',
                'pay_2' => '0',
            );
        }
        if($this->mod_voice_exam_datetime->chk_once($year)){
            $datatime_info = $this->mod_voice_exam_datetime->get_once($year);
        }else{
            $datatime_info = array(
                'day' => '10/20',
            );
        }

        $datalist = array();
        
        $this->mod_user->chk_status();
        $data = array(
            'title'=> $block.'任務編組主選單',
            'path'=> 'voice/duty_b1',
            'path_text'=>' > '.$block.'任務編組主選單',
            'datalist'=> $this->mod_voice_job_list->voice_where_voice_area1(),
            'fees_info'=>$fees_info,
            'job'=>$job,
            'datatime_info'=>$datatime_info,
        );
        $this->load->view('layout', $data);
    }
    // public function duty_b1()
    // {
        
    //     $year = $this->session->userdata('year');
    //     $job = $this->mod_voice_job_list->get_job_list($year,'考區');
    //     if ($this->mod_voice_test_pay->chk_once($year)) {
    //         $fees_info = $this->mod_voice_test_pay->get_once($year);
    //     } else {
    //         $fees_info = array(
    //             'pay_1' => '0',
    //             'pay_2' => '0',
              
    //         );
    //     }
    //     if($this->mod_voice_exam_datetime->chk_once($year)){
    //         $datatime_info = $this->mod_voice_exam_datetime->get_once($year);
    //     }else{
    //         $datatime_info = array(
    //             'day' => '10/20',
    //         );
    //     }

    //     $datalist = array();
        
    //     $this->mod_user->chk_status();
    //     $data = array(
    //         'title'=> '考區任務編組主選單',
    //         'path'=> 'voice/duty_b1',
    //         'path_text'=>' > 考區任務編組主選單',
    //         'datalist'=> $this->mod_voice_job_list->voice_where_voice_area1(),
    //         'fees_info'=>$fees_info,
    //         'job'=>$job,
    //         'datatime_info'=>$datatime_info,
    //     );
    //     $this->load->view('layout', $data);
    // }
    // public function duty_b2()
    // {
        
    //     $year = $this->session->userdata('year');
    //     $job = $this->mod_voice_job_list->get_job_list($year,'第一分區');
    //     if ($this->mod_voice_test_pay->chk_once($year)) {
    //         $fees_info = $this->mod_voice_test_pay->get_once($year);
    //     } else {
    //         $fees_info = array(
    //             'pay_1' => '0',
    //             'pay_2' => '0',
              
    //         );
    //     }
    //     if($this->mod_voice_exam_datetime->chk_once($year)){
    //         $datatime_info = $this->mod_voice_exam_datetime->get_once($year);
    //     }else{
    //         $datatime_info = array(
    //             'day' => '10/20',
    //         );
    //     }

    //     $datalist = array();
        
    //     $this->mod_user->chk_status();
    //     $data = array(
    //         'title'=> '考區任務編組主選單',
    //         'path'=> 'voice/duty_b2',
    //         'path_text'=>' > 考區任務編組主選單',
    //         'datalist'=> $this->mod_voice_job_list->voice_where_voice_area2(),
    //         'fees_info'=>$fees_info,
    //         'job'=>$job,
    //         'datatime_info'=>$datatime_info,
    //     );
    //     $this->load->view('layout', $data);
    // }
    // public function duty_b3()
    // {
        
    //     $year = $this->session->userdata('year');
    //     $job = $this->mod_voice_job_list->get_job_list($year,'第二分區');
    //     if ($this->mod_voice_test_pay->chk_once($year)) {
    //         $fees_info = $this->mod_voice_test_pay->get_once($year);
    //     } else {
    //         $fees_info = array(
    //             'pay_1' => '0',
    //             'pay_2' => '0',
              
    //         );
    //     }
    //     if($this->mod_voice_exam_datetime->chk_once($year)){
    //         $datatime_info = $this->mod_voice_exam_datetime->get_once($year);
    //     }else{
    //         $datatime_info = array(
    //             'day' => '10/20',
    //         );
    //     }

    //     $datalist = array();
        
    //     $this->mod_user->chk_status();
    //     $data = array(
    //         'title'=> '考區任務編組主選單',
    //         'path'=> 'voice/duty_b3',
    //         'path_text'=>' > 考區任務編組主選單',
    //         'datalist'=> $this->mod_voice_job_list->voice_where_voice_area3(),
    //         'fees_info'=>$fees_info,
    //         'job'=>$job,
    //         'datatime_info'=>$datatime_info,
    //     );
    //     $this->load->view('layout', $data);
    // }
    // public function duty_b4()
    // {
       
    //     $year = $this->session->userdata('year');
    //     $job = $this->mod_voice_job_list->get_job_list($year,'第三分區');
    //     if ($this->mod_voice_test_pay->chk_once($year)) {
    //         $fees_info = $this->mod_voice_test_pay->get_once($year);
    //     } else {
    //         $fees_info = array(
    //             'pay_1' => '0',
    //             'pay_2' => '0',
              
    //         );
    //     }
    //     if($this->mod_voice_exam_datetime->chk_once($year)){
    //         $datatime_info = $this->mod_voice_exam_datetime->get_once($year);
    //     }else{
    //         $datatime_info = array(
    //             'day' => '10/20',
    //         );
    //     }

    //     $datalist = array();
        
    //     $this->mod_user->chk_status();
    //     $data = array(
    //         'title'=> '考區任務編組主選單',
    //         'path'=> 'voice/duty_b4',
    //         'path_text'=>' > 考區任務編組主選單',
    //         'datalist'=> $this->mod_voice_job_list->voice_where_voice_area4(),
    //         'fees_info'=>$fees_info,
    //         'job'=>$job,
    //         'datatime_info'=>$datatime_info,
    //     );
    //     $this->load->view('layout', $data);
    // }
    
    /**
     * 預覽任務編組表
     */
    public function duty_b5()
    {
        $this->load->model('mod_voice_test_pay');
        $this->load->model('mod_voice_job_list');
        $this->load->model('mod_voice_exam_datetime');
        $this->mod_user->chk_status();
        $data = array(
            'title' => '預覽任務編組表',
            'path' => 'voice/duty_b5',
            'path_text' => ' > 指考主選單 > 考區任務編組 > 預覽任務編組表',
            'all' => $this->mod_voice_job_list->get_list(),
            'b1' => $this->mod_voice_job_list->get_list('考區'),
            'b2' => $this->mod_voice_job_list->get_list('第一分區'),
            'b3' => $this->mod_voice_job_list->get_list('第二分區'),
            'b4' => $this->mod_voice_job_list->get_list('第三分區'),
        );
        $this->load->view('layout', $data);
    }

  
    
    






}
?>