<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_patrol extends CI_Model
{
    public function import($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('patrol_staff');
        $this->db->insert_batch('patrol_staff', $datas);
    }

    public function year_get_list()
    {
        return $this->db->where('year', $this->session->userdata('year'))->get('patrol_staff')->result_array();
    }

    public function chk_once($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('patrol_staff') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_patrol_list($part = '')
    {
        if ($part != '') {
            $this->db->where('part', $part);
        }

        return $this->db->get('patrol_staff')->result_array();
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('patrol_staff')->row_array();
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('patrol_staff', $data);

        return true;
    }

    public function add_once($data)
    {
        $this->db->insert('patrol_staff', $data);

        return true;
    }
}

/* End of file Mod_exam_area.php */
