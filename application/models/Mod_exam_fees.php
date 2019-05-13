<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_exam_fees extends CI_Model
{
    public function chk_once($year)
    {
        $this->db->where('year', $year);
        if ($this->db->count_all_results('exam_fees') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_once($year)
    {
        $this->db->where('year', $year);

        return $this->db->get('exam_fees')->row_array();
    }

    public function update_once($year, $data)
    {
        $this->db->where('year', $year);
        $this->db->update('exam_fees', $data);


        $fee = $this->get_once($year, $ladder);
        
        // 監視人員更新
        $assign = $this->db->where('year', $year)->where('supervisor_1!=', '')->get('trial_assign')->result_array();
        foreach ($assign as $key => $value) {
            $data = array(
                'first_member_salary_section' => $fee['pay_2'],
                'first_member_section_salary_total' => $value['first_member_day_count'] * $fee['pay_2'],
                'first_member_section_total' => $value['first_member_day_count'] * $fee['pay_2'],
                'second_member_salary_section' => $fee['pay_2'],
                'second_member_section_salary_total' => $value['second_member_day_count'] * $fee['pay_2'],
                'second_member_section_total' => $value['second_member_day_count'] * $fee['pay_2'],
            );
            $this->db->where('sn', $value['sn']);
            $this->db->update('trial_assign', $data);
        }
        // 管卷人員更新
        $trial = $this->db->where('year', $year)->get('trial_staff')->result_array();
        foreach ($trial as $key => $value) {
            $data = array(
                'salary' => $fee['pay_2'],
                'salary_total' => $value['count'] * $fee['pay_2'],
                'total' => $value['count'] * $fee['pay_2'],
            );
            $this->db->where('sn', $value['sn']);
            $this->db->update('trial_staff', $data);
        }
        // 巡場人員更新
        $patrol = $this->db->where('year', $year)->get('patrol_staff')->result_array();
        foreach ($patrol as $key => $value) {
            $data = array(
                'salary' => $fee['pay_2'],
                'salary_total' => $value['count'] * $fee['pay_2'],
                'total' => $value['count'] * $fee['pay_2'],
            );
            $this->db->where('sn', $value['sn']);
            $this->db->update('patrol_staff', $data);
        }





    }

    public function add_once($data)
    {
        $this->db->insert('exam_fees', $data);
    }
}


/* End of file Mod_exam_area.php */