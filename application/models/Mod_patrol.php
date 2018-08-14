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
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        return $this->db->get('patrol_staff')->result_array();
    }

    public function get_patrol_for_csv()
    {
        $this->db->where('year', $this->session->userdata('year'));

        $res = $this->db->get('patrol_staff')->result_array();

        for ($i=0; $i < count($res); $i++) { 
            # code...
            $patrol = $this->db->where('member_code', $res[$i]['patrol_staff_code'])->get('staff_member')->row_array();
            $arr[] = array(
                'year'=>$patrol['year'],
                'member_code'=>$patrol['member_code'],
                'member_name'=>$patrol['member_name'],
                'member_unit'=>$patrol['member_unit'],
                'member_phone'=>$patrol['member_phone'],
                'member_title'=>$patrol['member_title'],
            );
        }
        return $arr;
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

    public function insert_2_district_task($sn, $data)
    {
        $this->db->insert('district_task', $data);

        return true;
    }

    public function add_once($data)
    {
        $this->db->insert('patrol_staff', $data);

        return true;
    }

        public function remove_patrol_staff($sn)
    {
        $this->db->where('sn', $sn);
        $this->db->delete('patrol_staff');

        return true;
    }
}

/* End of file Mod_exam_area.php */
