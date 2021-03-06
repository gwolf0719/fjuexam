<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_part extends CI_Model
{
    public function import($area)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('part_main');
        $this->db->insert_batch('part_main', $area);
    }

    public function year_get_list()
    {
        return $this->db->where('year', $this->session->userdata('year'))->get('part_main')->result_array();
    }

    public function chk_once($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('part_main') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_list($year = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($year != '') {
            $this->db->where('year', $year);
        }

        return $this->db->get('part_main')->result_array();
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('part_main')->row_array();
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('part_main', $data);

        return true;
    }

    public function add_once($data)
    {
        $this->db->insert('part_main', $data);

        return true;
    }
}

/* End of file Mod_exam_area.php */
