<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**任務編組 */
class Test_setting extends CI_Controller {
    public function index()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '考程設定',
            'path' => 'voice/testing_setting_index',
            'path_text' => ' > 考程設定',
        );
        $this->load->view('voice_layout', $data);
    }
    /*
    f1頁面
    */ 
    public function test_day_time()
    {
        $this->mod_user->chk_status();
        $this->load->model('mod_voice_exam_datetime');
        $ladder = $this->session->userdata('ladder');
        $year = $this->session->userdata('year');
        if ($this->mod_voice_exam_datetime->chk_once($year,$ladder)) {
            $datetime_info = $this->mod_voice_exam_datetime->get_once($year,$ladder);
        } else {
            $datetime_info = array(
                'day' => '',
                'course_1_start' => '',
                'course_1_end' => '',
                'course_2_start' => '',
                'course_2_end' => '',
                'pre_1' => '',
                'pre_2' => '',
            );
        }
        $data = array(
            'title' => '考試日期與時間',
            'path' => 'voice/test_day_time',
            'path_text' => ' > 指考主選單 > 考程設定 > 考試日期與時間',
            'datetime_info' => $datetime_info,
        );
        $this->load->view('voice_layout', $data);
    }
    /*
    ** 考試科目
    */
    public function test_subjects()
    {
        $this->mod_user->chk_status();
        $this->load->model('mod_voice_exam_datetime');
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');
        if ($this->mod_voice_exam_datetime->chk_once($year,$ladder)) {
            $datetime_info = $this->mod_voice_exam_datetime->get_once($year,$ladder);
        } else {
            $datetime_info = array(
                'day' => ''
            );
         
         }
        $data_subject = array(
            'subject_1' => '英聽',
            'subject_2' => '英聽',
        );
        $data = array(
            'title' => '考試科目',
            'path' => 'voice/test_subjects',
            'path_text' => ' > 指考主選單 > 考程設定 > 考試科目',
            'datetime_info' => $datetime_info,
            'data_subject' =>$data_subject,
        );
        $this->load->view('voice_layout',$data);
    }
    public function test_pay()
    {
        $this->mod_user->chk_status();
        $this->load->model('mod_voice_test_pay');
        $year = $this->session->userdata('year');
        if ($this->mod_voice_test_pay->chk_once($year)) {
            $data_pay = $this->mod_voice_test_pay->get_once($year);
        } else {
            $data_pay = array(
                'pay_1' => '0',
                'pay_2' => '0',
               
            );
        }
       
        $data = array(
            'title' => '考試科目',
            'path' => 'voice/test_pay',
            'path_text' => ' > 指考主選單 > 考程設定 > 考試科目',
            'data_pay'=>$data_pay,
        );
        $this->load->view('voice_layout',$data);
    }
    
    
}