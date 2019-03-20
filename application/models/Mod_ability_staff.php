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
        return $this->db->where('member_code', $code)->get('ability_staff_member')->row_array();
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
            'job_code' =>'', 
            'job_title' =>'', 
            'name' =>'', 
            'trial_start' =>'', 
            'trial_end' =>'', 
            'number' =>'', 
            'phone' =>'', 
            'note' =>'', 
            'status' =>'', 
            'do_date' =>'', 
            'day_count' =>'', 
            'one_day_salary' =>'', 
            'salary_total' =>'', 
            'total' =>'', 
        );
        $this->db->where('year', $this->session->userdata('year'))->update('ability_district_task',$datas);
    }

    public function remove_ability_trial_assign()
    {   
        // $data = array('supervisor_1','supervisor_1_code','supervisor_2','supervisor_2_code','trial_staff_code_1','trial_staff_code_2','first_member_do_date','first_member_day_count',
        // 'first_member_salary_section','first_member_section_salary_total','first_member_section_total','second_member_do_date','second_member_day_count',
        // 'second_member_salary_section','second_member_section_salary_total','second_member_section_total','note');
        $datas = array(
            'supervisor_1' =>'', 
            'supervisor_1_code' =>'', 
            'supervisor_2' =>'', 
            'supervisor_2_code' =>'', 
            'trial_staff_code_1' =>'', 
            'trial_staff_code_2' =>'', 
            'first_member_do_date' =>'', 
            'first_member_day_count' =>'', 
            'first_member_salary_section' =>'', 
            'first_member_section_salary_total' =>'', 
            'first_member_section_total' =>'', 
            'second_member_do_date' =>'', 
            'second_member_day_count' =>'', 
            'second_member_salary_section' =>'', 
            'second_member_section_salary_total' =>'', 
            'note' =>'', 
        );
        $this->db->where('year', $this->session->userdata('year'))->update('ability_trial_assign',$datas);
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
