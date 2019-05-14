<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_ability_exam_fees extends CI_Model
{
    public function chk_once($year)
    {
        $this->db->where('year', $year);
        if ($this->db->count_all_results('ability_exam_fees') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_once($year)
    {
        $this->db->where('year', $year);

        return $this->db->get('ability_exam_fees')->row_array();
    }

    public function update_once($year, $data)
    {
        $this->db->where('year', $year);
        $this->db->update('ability_exam_fees', $data);




        $fee = $this->get_once($year);
        
        // 監視人員更新
        $assign = $this->db->where('year', $year)->where('supervisor_1!=', '')->get('ability_trial_assign')->result_array();
        foreach ($assign as $key => $value) {
            $data = array(
                'first_member_salary_section' => $fee['salary_section'],
                'first_member_section_salary_total' => $value['first_member_day_count'] * $fee['salary_section'],
                'first_member_section_total' => $value['first_member_day_count'] * $fee['salary_section'],
                'second_member_salary_section' => $fee['salary_section'],
                'second_member_section_salary_total' => $value['second_member_day_count'] * $fee['salary_section'],
                'second_member_section_total' => $value['second_member_day_count'] * $fee['salary_section'],
            );
            $this->db->where('sn', $value['sn']);
            $this->db->update('ability_trial_assign', $data);
        }
        // 管卷人員更新
        $trial = $this->db->where('year', $year)->get('ability_trial_staff')->result_array();
        foreach ($trial as $key => $value) {
            $data = array(
                'salary' => $fee['salary_section'],
                'salary_total' => $value['count'] * $fee['salary_section'],
                'total' => $value['count'] * $fee['salary_section'],
            );
            $this->db->where('sn', $value['sn']);
            $this->db->update('ability_trial_staff', $data);
        }
        // 巡場人員更新
        $patrol = $this->db->where('year', $year)->get('ability_patrol_staff')->result_array();
        foreach ($patrol as $key => $value) {
            $data = array(
                'salary' => $fee['salary_section'],
                'salary_total' => $value['count'] * $fee['salary_section'],
                'total' => $value['count'] * $fee['salary_section'],
            );
            $this->db->where('sn', $value['sn']);
            $this->db->update('ability_patrol_staff', $data);
        }











    }

    public function add_once($data)
    {
        $this->db->insert('ability_exam_fees', $data);
    }
}


/* End of file Mod_exam_area.php */