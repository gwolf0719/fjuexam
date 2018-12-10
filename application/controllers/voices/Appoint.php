<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appoint extends CI_Controller {


    public function index()
    {
        $this->load->model('mod_voice_part_info');
        $this->mod_user->chk_status();
        $data = array(
            'title'=>'試場人員指派',
            'path'=>'voice/appoint_d',
             'path_text'=> '> 英聽主選單 > 試場人員指派',
             'datalist' => $this->mod_voice_part_info->get_list(),


        );
        $this->load->view('voice_layout',$data);
    }

    public function appoint_d1()
    {
        $this->load->model('mod_voice_part_info');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_datetime');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $part1 = $this->mod_voice_trial->get_list('2501');
        $part2 = $this->mod_voice_trial->get_list('2502');
        $part3 = $this->mod_voice_trial->get_list('2503');

        if($this->mod_voice_exam_datetime->chk_once($year)){
            $datatime_info = $this->mod_voice_exam_datetime->get_once($year);
        }else{
            $datatime_info = array(
                'day' => '10/20',
            );
        }
        $data = array(
            'title' => '監試人員指派',
            'path' => 'voice/appoint_d1',
            'path_text' => ' > 英聽主選單 > 試場人員指派 > 監試人員指派',
            'part1' => $part1,
            'part2' => $part2,
            'part3' => $part3,
            'datatime_info'=>$datatime_info,
        );

        $this->load->view('voice_layout', $data);
    }
    
    public function appoint_d2()
    {
        $this->load->model('mod_voice_part_info');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        $this->load->model('mod_voice_exam_datetime');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $part = $this->mod_voice_exam_area->get_part_block('2501','上午場');
        $part_aftermoon = $this->mod_voice_exam_area->get_part_block('2501','下午場');
        $part1 = $this->mod_voice_trial->get_trial_list('2501');
        $part2 = $this->mod_voice_trial->get_trial_list('2502');
        $part3 = $this->mod_voice_trial->get_trial_list('2503');
        if ($this->mod_voice_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_voice_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day' => '10/22',
            );
        }
        $data = array(
            'title' => '管卷人員指派',
            'path' => 'voice/appoint_d2',
            'path_text' => ' > 英聽主選單 > 試場人員指派 > 管卷人員指派',
            'part' => $part,
            'part_aftermoon'=>$part_aftermoon,
            'part1' => $part1,
            'part2' => $part2,
            'part3' => $part3,
            'datetime_info' => $datetime_info,
        );
        $this->load->view('voice_layout', $data);
    }
    public function appoint_d3()
    {
        $this->load->model('mod_voice_patrol');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        $this->load->model('mod_voice_exam_datetime');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $part = $this->mod_voice_exam_area->get_part_block('2501','上午場');
        $part_aftermoon = $this->mod_voice_exam_area->get_part_block('2501','下午場');
        $part1 = $this->mod_voice_patrol->get_patrol_list('2501');
        $part2 = $this->mod_voice_patrol->get_patrol_list('2502');
        $part3 = $this->mod_voice_patrol->get_patrol_list('2503');
        if ($this->mod_voice_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_voice_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day' => '10/22',
            );
        }
        $data = array(
            'title' => '巡場人員指派',
            'path' => 'voice/appoint_d3',
            'path_text' => ' > 英聽主選單 > 試場人員指派 > 巡場人員指派',
            'part' => $part,
            'part_aftermoon'=>$part_aftermoon,
            'part1' => $part1,
            'part2' => $part2,
            'part3' => $part3,
            'datetime_info' => $datetime_info,
        );
        $this->load->view('voice_layout', $data);
    }
    public function appoint_d4()
    {
        $this->load->model('mod_voice_part_info');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_datetime');
        $this->load->model('mod_voice_test_pay');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $part1 = $this->mod_voice_trial->get_list('2501');
        $part2 = $this->mod_voice_trial->get_list('2502');
        $part3 = $this->mod_voice_trial->get_list('2503');
        if ($this->mod_voice_test_pay->chk_once($year)) {
            $fees_info = $this->mod_voice_test_pay->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '0',
                'salary_section' => '0',
            );
        }
        if ($this->mod_voice_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_voice_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day' => '10/22',
            );
        }
        $data = array(
            'title' => '監試人員列表',
            'path' => 'voice/appoint_d4',
            'path_text' => ' > 英聽主選單 > 試場人員指派 > 監試人員列表',
            'part1' => $part1,
            'part2' => $part2,
            'part3' => $part3,
            'fees_info' => $fees_info,
            'datetime_info' => $datetime_info,
        );
        $this->load->view('voice_layout', $data);
    }

    public function appoint_d5()
    {
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_datetime');
        $this->load->model('mod_voice_test_pay');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $part1 = $this->mod_voice_trial->get_trial_list('2501');
        $part2 = $this->mod_voice_trial->get_trial_list('2502');
        $part3 = $this->mod_voice_trial->get_trial_list('2503');
        if ($this->mod_voice_test_pay->chk_once($year)) {
            $fees_info = $this->mod_voice_test_pay->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '0',
                'salary_section' => '0',
            );
        }
        if ($this->mod_voice_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_voice_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day' => '10/22',
            );
        }
        $data = array(
            'title' => '管卷人員列表',
            'path' => 'voice/appoint_d5',
            'path_text' => ' > 英聽主選單 > 試場人員指派 > 管卷人員列表',
            'part1' => $part1,
            'part2' => $part2,
            'part3' => $part3,
            'fees_info' => $fees_info,
            'datetime_info' => $datetime_info,
        );
        $this->load->view('voice_layout', $data);
    }

    public function appoint_d6()
    {
        $this->load->model('mod_voice_patrol');
        $this->load->model('mod_voice_exam_datetime');
        $this->load->model('mod_voice_test_pay');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $part1 = $this->mod_voice_patrol->get_patrol_list('2501');
        $part2 = $this->mod_voice_patrol->get_patrol_list('2502');
        $part3 = $this->mod_voice_patrol->get_patrol_list('2503');
        if ($this->mod_voice_test_pay->chk_once($year)) {
            $fees_info = $this->mod_voice_test_pay->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '0',
                'salary_section' => '0',
            );
        }
        if ($this->mod_voice_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_voice_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day' => '10/22',
            );
        }
        $data = array(
            'title' => '巡場人員列表',
            'path' => 'voice/appoint_d6',
            'path_text' => ' > 英聽主選單 > 試場人員指派 > 巡場人員列表',
            'part1' => $part1,
            'part2' => $part2,
            'part3' => $part3,
            'fees_info' => $fees_info,
            'datetime_info' => $datetime_info,
        );
        $this->load->view('voice_layout', $data);
    }






}

?>