<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_voice_part_info extends CI_Model
{
    public function import($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('ladder', $this->session->userdata('ladder'));
        $this->db->delete('voice_area_main');
        $this->db->insert_batch('voice_area_main', $datas);
    }

    public function year_get_list()
    {
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('ladder', $this->session->userdata('ladder'));
        return $this->db->get('voice_area_main')->result_array();
    }

    public function get_list($part = '',$block_name = '')
    {
        
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('ladder', $this->session->userdata('ladder'));
        if ($part != '') {
            $this->db->where('part', $part);
        }
        if ($block_name != '') {
            $this->db->where('block_name', $block_name);
        }

        return $this->db->get('voice_area_main')->result_array();
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('voice_exam_area')->row_array();
    }

    
    public function update_once($field, $data)
    {
         $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('ladder', $this->session->userdata('ladder'));
        $this->db->where('field', $field);
        $this->db->update('voice_area_main', $data);
        return true;
    }

    public function update_floor($data)
    {
        $this->db->where('sn',$data['sn']);
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('part',$data['part']);
        $this->db->where('field>=', $data['start']);
        $this->db->where('field<=', $data['end']);
        $res = $this->db->get('voice_area_main')->result_array();
       
        $this->db->update('voice_area_main',$data);
        return true;
    }    
}

/* End of file Mod_exam_area.php */
