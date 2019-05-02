<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_ability_staff extends CI_Model
{
    public function import($datas)
    {
        // 先清除當年資料
        // $this->db->where('year', $this->session->userdata('year'))->delete('ability_staff_member');
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->delete('ability_staff_member');
        $this->db->insert_batch('ability_staff_member', $datas);
    }

    public function chk_once($member_code)
    {
        $this->db->where('member_code', $member_code);
        if ($this->db->count_all_results('ability_staff_member') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function year_get_list()
    {
        return $this->db->where('year', $this->session->userdata('year'))->get('ability_staff_member')->result_array();
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('ability_staff_member')->row_array();
    }

    public function get_staff_member($code)
    {
        return $this->db->where('year', $this->session->userdata('year'))->where('member_code', $code)->get('ability_staff_member')->row_array();
    }

    public function add_once($data)
    {
        $data['year'] = $this->session->userdata('year');
        $this->db->insert('ability_staff_member', $data);

        return true;
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('ability_staff_member', $data);

         // 更新監考人員資料
        // 1
        $res2 = $this->db->where('year', $this->session->userdata('year'))->where('supervisor_1_code', $data['member_code'])->get('ability_trial_assign')->row_array();

        switch ($data['order_meal']) {
            case 'Y':
                $lunch_total = $res2['first_member_day_count'] * $res2['first_member_lunch_price'];
                break;
            default:
                $lunch_total = 0;
                break;
        }
        $assign = array(
            'first_member_order_meal' => $data['order_meal'],
            'first_member_meal' => $data['meal'],
            'first_member_section_lunch_total' => $lunch_total,
            'first_member_section_total' => $res2['first_member_section_salary_total'] - $lunch_total,
        );
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('supervisor_1_code', $data['member_code']);
        $this->db->update('ability_trial_assign', $assign);


        // 2
        $res3 = $this->db->where('year', $this->session->userdata('year'))->where('supervisor_2_code', $data['member_code'])->get('ability_trial_assign')->row_array();

        switch ($data['order_meal']) {
            case 'Y':
                $lunch_total = $res3['second_member_day_count'] * $res3['second_member_lunch_price'];
                break;
            default:
                $lunch_total = 0;
                break;
        }
        $assign = array(
            'second_member_order_meal' => $data['order_meal'],
            'second_member_meal' => $data['meal'],
            'second_member_section_lunch_total' => $lunch_total,
            'second_member_section_total' => $res3['second_member_section_salary_total'] - $lunch_total,
        );
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('supervisor_2_code', $data['member_code']);
        $this->db->update('ability_trial_assign', $assign);





          // 更新管卷人員資料
        $res1 = $this->db->where('year', $this->session->userdata('year'))->where('trial_staff_code', $data['member_code'])->get('ability_trial_staff')->row_array();
        $day = 0;
        if ($res1['first_section'] != 0) {
            $day = $day + 1;
        }
        if ($res1['second_section'] != 0) {
            $day = $day + 1;
        }
        if ($res1['third_section'] != 0) {
            $day = $day + 1;
        }
        switch ($data['order_meal']) {
            case 'Y':
                $lunch_total = $day * $res1['lunch_price'];
                break;
            default:
                $lunch_total = 0;
                break;
        }
        $trail = array(
            'order_meal' => $data['order_meal'],
            'meal' => $data['meal'],
            'lunch_total' => $lunch_total,
            'total' => $res1['salary_total'] - $lunch_total,
        );
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('trial_staff_code', $data['member_code']);
        $this->db->update('ability_trial_staff', $trail);



        
        // 更新巡場人員資料
        $res5 = $this->db->where('year', $this->session->userdata('year'))->where('patrol_staff_code', $data['member_code'])->get('ability_patrol_staff')->row_array();

        switch ($data['order_meal']) {
            case 'Y':
                $lunch_total = $res5['count'] * $res5['lunch_price'];
                break;
            default:
                $lunch_total = 0;
                break;
        }
        $trail = array(
            'order_meal' => $data['order_meal'],
            'meal' => $data['meal'],
            'lunch_total' => $lunch_total,
            'total' => $res5['salary_total'] - $lunch_total,
        );
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('patrol_staff_code', $data['member_code']);
        $this->db->update('ability_patrol_staff', $trail);




         // 更新b員資料
        $res6 = $this->db->where('year', $this->session->userdata('year'))->where('job_code', $data['member_code'])->get('ability_district_task')->row_array();

        switch ($data['order_meal']) {
            case 'Y':
                $lunch_total = $res6['day_count'] * $res6['lunch_price'];
                break;
            default:
                $lunch_total = 0;
                break;
        }
        $b = array(
            'order_meal' => $data['order_meal'],
            'meal' => $data['meal'],
            'lunch_total' => $lunch_total,
            'total' => $res6['salary_total'] - $lunch_total,
        );
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('job_code', $data['member_code']);
        $this->db->update('ability_district_task', $b);

















        return true;
    }

    public function remove_once($sn)
    {
        $this->db->where('sn', $sn);
        $this->db->delete('ability_staff_member');

        return true;
    }

    public function remove_ability_district_task()
    {   
        // $data = array('job_code','job_title','name','trial_start','trial_end','number','phone','note','status',
        // 'do_date','day_count','one_day_salary','salary_total','total');
        $datas = array(
            'job_code' => '',
            'job_title' => '',
            'name' => '',
            'number' => '',
            'phone' => '',
            'note' => '',
            'status' => '',
            'do_date' => '',
            'day_count' => '',
            'one_day_salary' => '',
            'salary_total' => '',
            'total' => '',
        );
        $this->db->where('year', $this->session->userdata('year'))->update('ability_district_task', $datas);
    }

    public function remove_ability_trial_assign()
    {   
        // $data = array('supervisor_1','supervisor_1_code','supervisor_2','supervisor_2_code','trial_staff_code_1','trial_staff_code_2','first_member_do_date','first_member_day_count',
        // 'first_member_salary_section','first_member_section_salary_total','first_member_section_total','second_member_do_date','second_member_day_count',
        // 'second_member_salary_section','second_member_section_salary_total','second_member_section_total','note');
        $datas = array(
            'supervisor_1' => '',
            'supervisor_1_code' => '',
            'supervisor_2' => '',
            'supervisor_2_code' => '',
            'trial_staff_code_1' => '',
            'trial_staff_code_2' => '',
            'first_member_do_date' => '',
            'first_member_day_count' => '',
            'first_member_salary_section' => '',
            'first_member_section_salary_total' => '',
            'first_member_section_total' => '',
            'second_member_do_date' => '',
            'second_member_day_count' => '',
            'second_member_salary_section' => '',
            'second_member_section_salary_total' => '',
            'note' => '',
        );
        $this->db->where('year', $this->session->userdata('year'))->update('ability_trial_assign', $datas);
    }

    public function remove_ability_trial_staff()
    {   
        // $this->db->where('year', $this->session->userdata('year'))->truncate('ability_trial_staff');
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->delete('ability_trial_staff');
        // $r=$this->db->last_query('ability_exam_area');
        // print_r($r);
    }
    public function remove_ability_patrol_staff()
    {   
        // $this->db->where('year', $this->session->userdata('year'))->truncate('ability_trial_staff');
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->delete('ability_patrol_staff');
        // $r=$this->db->last_query('ability_exam_area');
        // print_r($r);
    }
}

/* End of file Mod_exam_area.php */