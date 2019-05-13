<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_voice_test_pay extends CI_Model
{
    public function chk_once($year, $ladder)
    {
        $this->db->where('year', $year);
        $this->db->where('ladder', $ladder);
        if ($this->db->count_all_results('voice_test_pay') == 0) {
            return false;
        } else {
            return true;
        }

    }
    public function get_once($year, $ladder)
    {
        $this->db->where('year', $year);
        $this->db->where('ladder', $ladder);
        return $this->db->get('voice_test_pay')->row_array();
    }

    public function update_once($year, $ladder, $data)
    {
        $this->db->where('year', $year);
        $this->db->where('ladder', $ladder);
        $this->db->update('voice_test_pay', $data);

        $fee = $this->get_once($year, $ladder);

        
        // 監視人員更新
        $assign = $this->db->where('year', $year)->where('ladder', $ladder)->where('supervisor_1!=', '')->get('voice_trial_assign')->result_array();
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
            $this->db->update('voice_trial_assign', $data);
        }

        // 管卷人員更新
        $trial = $this->db->where('year', $year)->where('ladder', $ladder)->get('voice_trial_staff')->result_array();
        foreach ($trial as $key => $value) {
            $data = array(
                'salary' => $fee['pay_2'],
                'salary_total' => $value['count'] * $fee['pay_2'],
                'total' => $value['count'] * $fee['pay_2'],
            );
            $this->db->where('sn', $value['sn']);
            $this->db->update('voice_trial_staff', $data);
        }

        // 巡場人員更新
        $patrol = $this->db->where('year', $year)->where('ladder', $ladder)->get('voice_patrol_staff')->result_array();
        foreach ($patrol as $key => $value) {
            $data = array(
                'salary' => $fee['pay_2'],
                'salary_total' => $value['count'] * $fee['pay_2'],
                'total' => $value['count'] * $fee['pay_2'],
            );
            $this->db->where('sn', $value['sn']);
            $this->db->update('voice_patrol_staff', $data);
        }






    }

    public function add_once($data)
    {
        $this->db->insert('voice_test_pay', $data);
    }



}
?>