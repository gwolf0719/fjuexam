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
        // $this->load->model('mod_exam_datetime');
        // $year = $this->session->userdata('year');

        // if ($this->mod_exam_datetime->chk_once($year)) {
        //     $datetime_info = $this->mod_exam_datetime->get_once($year);
        // } else {
        //     $datetime_info = array(
        //         'day_1' => '1911' + $this->session->userdata('year').'年7月1日',
        //         'day_2' => '1911' + $this->session->userdata('year').'年7月2日',
        //         'day_3' => '1911' + $this->session->userdata('year').'年7月3日',
        //         'course_1_start' => '08:40',
        //         'course_1_end' => '10:00',
        //         'course_2_start' => '10:50',
        //         'course_2_end' => '12:00',
        //         'course_3_start' => '14:00',
        //         'course_3_end' => '15:20',
        //         'course_4_start' => '16:01',
        //         'course_4_end' => '17:30',
        //         'pre_1' => '08:25',
        //         'pre_2' => '10:45',
        //         'pre_3' => '13:55',
        //         'pre_4' => '16:05',
        //     );
        // }
        $data = array(
            'title' => '考試日期與時間',
            'path' => 'voice/test_day_time',
            'path_text' => ' > 指考主選單 > 考程設定 > 考試日期與時間',
            // 'datetime_info' => $datetime_info,
        );
        $this->load->view('layout', $data);
    }
    









}
