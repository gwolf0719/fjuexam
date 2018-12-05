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
        $this->load->model('mod_exam_area');
        $this->load->model('mod_voice_exam_datetime');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $part = $this->mod_exam_area->get_part('2501');
        $part1 = $this->mod_voice_trial->get_trial_list('2501');
        $part2 = $this->mod_voice_trial->get_trial_list('2502');
        $part3 = $this->mod_voice_trial->get_trial_list('2503');
        if ($this->mod_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '07/01',
                'day_2' => '07/02',
                'day_3' => '07/03',
            );
        }
        $data = array(
            'title' => '管卷人員指派',
            'path' => 'designated/d_2',
            'path_text' => ' > 指考主選單 > 試場人員指派 > 管卷人員指派',
            'part' => $part,
            'part1' => $part1,
            'part2' => $part2,
            'part3' => $part3,
            'datetime_info' => $datetime_info,
        );
        $this->load->view('voice_layout', $data);
    }



}

?>