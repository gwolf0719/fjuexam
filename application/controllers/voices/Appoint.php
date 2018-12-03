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
        $this->load->view('layout',$data);
    }

    public function appoint_d1()
    {
        $this->load->model('mod_voice_part_info');
        $this->load->model('mod_voice_trial');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $part1 = $this->mod_voice_trial->get_list('2501');
        $part2 = $this->mod_voice_trial->get_list('2502');
        $part3 = $this->mod_voice_trial->get_list('2503');
        $data = array(
            'title' => '監試人員指派',
            'path' => 'voice/appoint_d1',
            'path_text' => ' > 指考主選單 > 試場人員指派 > 監試人員指派',
            'part1' => $part1,
            'part2' => $part2,
            'part3' => $part3,
        );

        $this->load->view('layout', $data);
    }



}

?>