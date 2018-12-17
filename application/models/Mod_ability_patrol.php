<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_ability_patrol extends CI_Model
{
    public function import($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('ability_patrol_staff');
        $this->db->insert_batch('ability_patrol_staff', $datas);
    }

    public function year_get_list()
    {
        return $this->db->where('year', $this->session->userdata('year'))->get('ability_patrol_staff')->result_array();
    }

    public function chk_once($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('ability_patrol_staff') == 0) {
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

        return $this->db->get('ability_patrol_staff')->result_array();
    }

    public function get_trial_staff_for_csv()
    {
        $this->db->where('year', $this->session->userdata('year'));

        $res = $this->db->get('ability_trial_staff')->result_array();
        for ($i=0; $i < count($res); $i++) { 
            # code...
            $patrol = $this->db->where('member_code', $res[$i]['trial_staff_code'])->get('ability_staff_member')->row_array();
            switch ($res[$i]['part']) {
                case '2501':
                    $part = '第一分區';
                    break;
                case '2502':
                    $part = '第二分區';
                    break;
                case '2503':
                    $part = '第三分區';
                    break;                    
            }            
            $arr[] = array(
                'year'=>$patrol['year'],
                'job'=>'分區管卷人員',
                'area'=>$part,
                'member_code'=>$res[$i]['allocation_code'],
                'member_name'=>$patrol['member_name'],
                'member_unit'=>$patrol['member_unit'],
                'member_phone'=>$patrol['member_phone'],
                'member_title'=>$patrol['member_title'],
                'do_date'=>$res[$i]['do_date']
            );
        }
        return $arr;
    }    

    public function get_patrol_for_csv()
    {
        $this->db->where('year', $this->session->userdata('year'));

        $res = $this->db->get('ability_patrol_staff')->result_array();
        for ($i=0; $i < count($res); $i++) { 
            # code...
            $patrol = $this->db->where('member_code', $res[$i]['patrol_staff_code'])->get('ability_staff_member')->row_array();
            switch ($res[$i]['part']) {
                case '2501':
                    $part = '第一分區';
                    break;
                case '2502':
                    $part = '第二分區';
                    break;
                case '2503':
                    $part = '第三分區';
                    break;                    
            }
            $arr[] = array(
                'year'=>$patrol['year'],
                'job'=>'分區巡場人員',
                'area'=>$part,
                'member_code'=>$res[$i]['allocation_code'],
                'member_name'=>$patrol['member_name'],
                'member_unit'=>$patrol['member_unit'],
                'member_phone'=>$patrol['member_phone'],
                'member_title'=>$patrol['member_title'],
                'do_date'=>$res[$i]['do_date']
            );
        }
        return $arr;
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('ability_patrol_staff')->row_array();
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('ability_patrol_staff', $data);

        return true;
    }

    public function insert_2_district_task($sn, $data)
    {
        $this->db->insert('ability_district_task', $data);

        return true;
    }

    public function add_once($data)
    {
        $this->db->insert('ability_patrol_staff', $data);
        return true;
    }

        public function remove_patrol_staff($sn)
    {
        $this->db->where('sn', $sn);
        $this->db->delete('ability_patrol_staff');

        return true;
    }
}

/* End of file Mod_exam_area.php */
