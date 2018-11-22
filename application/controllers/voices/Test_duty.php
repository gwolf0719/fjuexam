<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_duty extends CI_Controller {

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
    public function duty_b1()
    {
        $this->load->model('mod_voice_test_pay');
        $this->load->model('mod_voice_job_list');
        $this->load->model('mod_voice_exam_datetime');
        $year = $this->session->userdata('year');
        $job = $this->mod_voice_job_list->get_job_list($year,'考區');
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
            'title' => '考區任務編組主選單',
            'path' => 'voice/duty_b1',
            'path_text' => ' > 考區任務編組主選單',
            'datalist'=> $this->mod_voice_job_list->voice_where_voice_area1(),
            'fees_info' =>$fees_info,
            'job'=>$job,
            'datatime_info'=>$datatime_info,
        );
        $this->load->view('layout', $data);
    }






}
?>