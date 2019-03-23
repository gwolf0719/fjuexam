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
    public function remove_district_task()
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
        $this->db->where('year', $this->session->userdata('year'))->update('district_task',$datas);
    }
    public function remove_trial_assign()
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
        $this->db->where('year', $this->session->userdata('year'))->update('trial_assign',$datas);
    }
    public function remove_trial_staff()
    {   
        // $data = array('supervisor_1','supervisor_1_code','supervisor_2','supervisor_2_code','trial_staff_code_1','trial_staff_code_2','first_member_do_date','first_member_day_count',
        // 'first_member_salary_section','first_member_section_salary_total','first_member_section_total','second_member_do_date','second_member_day_count',
        // 'second_member_salary_section','second_member_section_salary_total','second_member_section_total','note');

        // $datas = array(
        //     'allocation_code' =>'', 
        //     'trial_staff_code' =>'', 
        //     'trial_staff_name' =>'', 
        //     'first_start' =>'', 
        //     'first_end' =>'', 
        //     'first_section' =>'', 
        //     'second_start' =>'', 
        //     'second_end' =>'', 
        //     'second_section' =>'', 
        //     'do_date' =>'', 
        //     'calculation' =>'', 
        //     'count' =>'', 
        //     'salary' =>'', 
        //     'salary_total' =>'', 
        //     'total' =>'', 
        //     'note' =>'', 
        
        // );
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->delete('trial_staff');
        // $this->db->where('year', $this->session->userdata('year'))->where('ladder', $this->session->userdata('ladder'))->truncate('voice_trial_staff');
        // $this->db->where('year', $this->session->userdata('year'))->where('ladder', $this->session->userdata('ladder'))->update('voice_trial_staff',$datas);
    }
    public function remove_patrol_staff()
    {   
        // $data = array('supervisor_1','supervisor_1_code','supervisor_2','supervisor_2_code','trial_staff_code_1','trial_staff_code_2','first_member_do_date','first_member_day_count',
        // 'first_member_salary_section','first_member_section_salary_total','first_member_section_total','second_member_do_date','second_member_day_count',
        // 'second_member_salary_section','second_member_section_salary_total','second_member_section_total','note');

        // $datas = array(
        //     'allocation_code' =>'', 
        //     'patrol_staff_code' =>'', 
        //     'patrol_staff_name' =>'', 
        //     'start' =>'', 
        //     'end' =>'', 
        //     'first_section' =>'', 
        //     'second_start' =>'', 
        //     'second_end' =>'', 
        //     'second_section' =>'', 
        //     'do_date' =>'', 
        //     'calculation' =>'', 
        //     'count' =>'', 
        //     'salary' =>'', 
        //     'salary_total' =>'', 
        //     'total' =>'', 
        //     'note' =>'', 
        
        // );
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->delete('patrol_staff');
        // $this->db->where('year', $this->session->userdata('year'))->where('ladder', $this->session->userdata('ladder'))->truncate('voice_patrol_staff');

        // $this->db->where('year', $this->session->userdata('year'))->where('ladder', $this->session->userdata('ladder'))->update('voice_patrol_staff',$datas);
    }
}

/* End of file Mod_exam_area.php */
