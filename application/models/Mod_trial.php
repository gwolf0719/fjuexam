<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_trial extends CI_Model
{
    public function import($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('trial_assign');
        $this->db->insert_batch('trial_assign', $datas);
    }

    public function import_trial($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('trial_staff');
        $this->db->insert_batch('trial_staff', $datas);
    }

    public function year_get_list()
    {
        return $this->db->where('year', $this->session->userdata('year'))->get('trial_assign')->result_array();
    }

    public function chk_once($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('trial_assign') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function chk_trial($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('trial_staff') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_list($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');

        return $this->db->get()->result_array();
    }

    public function get_trial_list($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('trial_staff', 'part_info.sn = trial_staff.sn');

        return $this->db->get()->result_array();
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('trial_assign')->row_array();
    }

    public function get_once_trial($sn)
    {
        return $this->db->where('sn', $sn)->get('trial_staff')->row_array();
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('trial_assign', $data);

        return true;
    }

    public function update_trial($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('trial_staff', $data);

        return true;
    }

    public function add_once($data)
    {
        $this->db->insert('trial_assign', $data);

        return true;
    }

    public function get_once_assign($sn)
    {
        return $this->db->where('sn', $sn)->get('trial_assign')->row_array();
    }

    public function add_trial($data)
    {
        $this->db->insert('trial_staff', $data);

        return true;
    }

    public function get_min_field($part)
    {
        $this->db->where('part', $part);
        $this->db->order_by('field', 'asc');
        $this->db->select('field');

        return $this->db->get('part_info')->row_array();
    }

    public function get_max_field($part)
    {
        $this->db->where('part', $part);
        $this->db->order_by('field', 'desc');
        $this->db->select('field');

        return $this->db->get('part_info')->row_array();
    }
}

/* End of file Mod_exam_area.php */
