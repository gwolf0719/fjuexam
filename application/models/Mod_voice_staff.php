<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_voice_staff extends CI_Model
{

      //工作人員寫入
    function insert_job($data)
    {
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $this->db->delete('voice_import_member');
        $this->db->insert_batch('voice_import_member', $data);
    }
    public function remove_voice_job_list()
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
        $this->db->where('year', $this->session->userdata('year'))->where('ladder', $this->session->userdata('ladder'))->update('voice_job_list',$datas);
    }
    public function remove_voice_trial_assign()
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
        $this->db->where('year', $this->session->userdata('year'))->where('ladder', $this->session->userdata('ladder'))->update('voice_trial_assign',$datas);
    }
    public function remove_voice_trial_staff()
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
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $this->db->delete('voice_trial_staff');
        // $this->db->where('year', $this->session->userdata('year'))->where('ladder', $this->session->userdata('ladder'))->truncate('voice_trial_staff');
        // $this->db->where('year', $this->session->userdata('year'))->where('ladder', $this->session->userdata('ladder'))->update('voice_trial_staff',$datas);
    }
    public function remove_voice_patrol_staff()
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
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $this->db->delete('voice_patrol_staff');
        // $this->db->where('year', $this->session->userdata('year'))->where('ladder', $this->session->userdata('ladder'))->truncate('voice_patrol_staff');

        // $this->db->where('year', $this->session->userdata('year'))->where('ladder', $this->session->userdata('ladder'))->update('voice_patrol_staff',$datas);
    }

    function voice_where_voice_import_staff_member()
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        return $this->db->get('voice_import_member')->result_array();
    }

    function voice_get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('voice_import_member')->row_array();
    }


     function voice_chk_once($member_code)
    {
        $this->db->where('member_code', $member_code);
        if ($this->db->count_all_results('voice_import_member') == 0) {
            return false;
        } else {
            return true;
        }
    }

    function voice_add_once($data)
    {
       $data['year'] = $this->session->userdata('year');
       $this->db->insert('voice_import_member',$data);

       return true;
    }

    function voice_update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('voice_import_member', $data);

        return true;
    }
    function voice_remove_once($sn)
    {
        $this->db->where('sn', $sn);
        $this->db->delete('voice_import_member');

        return true;
    }
    
    public function get_staff_member($code)
    {
        return $this->db->where('member_code', $code)->get('voice_import_member')->row_array();
    }

    


}
?>