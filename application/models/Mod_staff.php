<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_staff extends CI_Model
{
    public function import($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('staff_member');
        $this->db->insert_batch('staff_member', $datas);
    }

    public function chk_once($member_code)
    {
        $this->db->where('member_code', $member_code);
        if ($this->db->count_all_results('staff_member') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function year_get_list()
    {
        return $this->db->where('year', $this->session->userdata('year'))->get('staff_member')->result_array();
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('staff_member')->row_array();
    }

    public function get_staff_member($code)
    {
        return $this->db->where('member_code', $code)->get('staff_member')->row_array();
    }

    public function add_once($data)
    {
        $data['year'] = $this->session->userdata('year');
        $this->db->insert('staff_member', $data);

        return true;
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('staff_member', $data);

        return true;
    }

    public function remove_once($sn)
    {
        $this->db->where('sn', $sn);
        $this->db->delete('staff_member');

        return true;
    }
}

/* End of file Mod_exam_area.php */
