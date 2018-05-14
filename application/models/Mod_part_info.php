<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_part_info extends CI_Model
{
    public function import($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('part_info');
        $this->db->insert_batch('part_info', $datas);
    }

    public function year_get_list()
    {
        return $this->db->where('year', $this->session->userdata('year'))->get('part_info')->result_array();
    }

    public function get_list($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        return $this->db->get('part_info')->result_array();
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('part_info')->row_array();
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('part_info', $data);

        return true;
    }
}

/* End of file Mod_exam_area.php */
