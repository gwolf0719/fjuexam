<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_voice_job_list extends CI_Model
{

    function insert_member($data)
    {
          $this->db->insert_batch('voice_job_list', $data);
    }


    function voice_where_voice_position()
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        return $this->db->get('voice_job_list')->result_array();
    }

    function voice_where_voice_area1()
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('test_partition','0');
        return $this->db->get('voice_job_list')->result_array();
    }

    function voice_where_voice_area2()
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('test_partition','1');
        return $this->db->get('voice_job_list')->result_array();
    }
    function voice_where_voice_area3()
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('test_partition','2');
        return $this->db->get('voice_job_list')->result_array();
    }
    function voice_where_voice_area4()
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('test_partition','3');
        return $this->db->get('voice_job_list')->result_array();
    }







}

?>
