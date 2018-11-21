<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**任務編組 */
class Test_setting extends CI_Controller {

    public function index()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '考程設定',
            'path' => 'voice/testing_setting',
            'path_text' => ' > 考程設定',
        );
        $this->load->view('layout', $data);
    }

    public function test_day_time()
    {
        $this->mod_user->chk_status();
        $this->load->model('mod_voice_exam_datetime');
        $year = $this->session->userdata('year');

        if ($this->mod_voice_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_voice_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '1911' + $this->session->userdata('year').'年10月20日',
                'course_1_start' => '11:20',
                'course_1_end' => '12:00',
                'course_2_start' => '14:20',
                'course_2_end' => '15:00',
                'pre_1' => '11:00',
                'pre_2' => '14:00',
            );
        }
        $data = array(
            'title' => '考試日期與時間',
            'path' => 'voice/test_day_time',
            'path_text' => ' > 指考主選單 > 考程設定 > 考試日期與時間',
            'datetime_info' => $datetime_info,
        );
        $this->load->view('layout', $data);
    }
    public function test_subjects()
    {
        $this->mod_user->chk_status();




        $data = array(
            'title' => '考試科目',
            'path' => 'voice/test_subjects',
            'path_text' => ' > 指考主選單 > 考程設定 > 考試科目',
            // 'datetime_info' => $datetime_info,

        );
    }

    
    









}
