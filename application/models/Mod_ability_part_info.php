<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_ability_part_info extends CI_Model
{
    public function import($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('ability_part_info');
        $this->db->insert_batch('ability_part_info', $datas);
    }

    public function year_get_list()
    {
        return $this->db->where('year', $this->session->userdata('year'))->get('ability_part_info')->result_array();
    }

    public function get_list($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        return $this->db->get('ability_part_info')->result_array();
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('ability_part_info')->row_array();
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('ability_part_info', $data);

        return true;
    }

    public function update_floor($data)
    {
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('part',$data['part']);
        $this->db->where('field>=', $data['start']);
        $this->db->where('field<=', $data['end']);
        $res = $this->db->get('ability_part_info')->result_array();
        
        for ($i=0; $i < count($res); $i++) { 
            # code...
            $arr[] = array(
                'sn'=>$res[$i]['sn'],
                'floor'=>$data['floor'],
                'note'=>$data['note'],
            );
        }
        $this->db->update_batch('ability_part_info', $arr, 'sn');
        return true;
    }    
}

/* End of file Mod_exam_area.php */
