<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_exam_area extends CI_Model
{
    public function import($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('exam_area');
        $this->db->insert_batch('exam_area', $datas);
    }

    public function year_get_list()
    {
        return $this->db->where('year', $this->session->userdata('year'))->get('exam_area')->result_array();
    }

    public function get_min_start($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->select_min('field');

        return $this->db->get('exam_area')->row_array();
    }

    public function get_max_end($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->select_max('field');

        return $this->db->get('exam_area')->row_array();
    }
}

/* End of file Mod_exam_area.php */
