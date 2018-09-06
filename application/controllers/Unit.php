<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{
    public function room_use_day1()
    {
        $this->load->model('mod_exam_datetime');
        $res = $this->mod_exam_datetime->room_use_day("220140","220172",'2501');
        echo json_encode($res);
        // echo $this->db->last_query();
    }

    public function room_use_day2()
    {
        $this->load->model('mod_exam_datetime');
        $res = $this->mod_exam_datetime->room_use_day("210114","292502",'2502');
        echo json_encode($res);
        // echo $this->db->last_query();
    }    

    public function get_once_day_section_test()
    {
        $this->load->model('mod_exam_datetime');
        $res = $this->mod_exam_datetime->get_once_day_section_test('2', '210119', '210120');
        echo json_encode($res);
    }

    public function get_day_section()
    {
        $this->load->model('mod_exam_datetime');
        $res = $this->mod_exam_datetime->get_day_section('210119', '210120');
        echo json_encode($res);
    }

    public function get_list_for_csv()
    {
        $this->load->model('mod_trial');
        $res = $this->mod_trial->get_list_for_csv();
        echo json_encode($res);
    }

    function get_supervisor_member_count(){
        $this->load->model('mod_trial');
        $res = $this->mod_trial->get_supervisor_member_count('2501');
        echo json_encode($res);

    }
}

/* End of file Unit.php */
