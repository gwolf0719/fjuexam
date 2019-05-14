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


        $fee = $this->get_once($year);
        
        // 監視人員更新
        $assign = $this->db->where('year', $year)->where('supervisor_1!=', '')->get('trial_assign')->result_array();
        foreach ($assign as $key => $value) {

            if ($value['first_member_order_meal'] == 'Y') {
                $lunch_total1 = $value['first_member_day_count'] * $fee['lunch_fee'];
            } else {
                $lunch_total1 = 0;
            }
            if ($value['second_member_order_meal'] == 'Y') {
                $lunch_total2 = $value['second_member_day_count'] * $fee['lunch_fee'];
            } else {
                $lunch_total2 = 0;
            }

            $data = array(
                // 第一人
                'first_member_salary_section' => $fee['salary_section'],
                'first_member_section_salary_total' => $value['first_member_day_count'] * $fee['salary_section'],
                'first_member_lunch_price' => $fee['lunch_fee'],
                'first_member_section_lunch_total' => $lunch_total1,
                'first_member_section_total' => $value['first_member_day_count'] * $fee['salary_section'] - $lunch_total1,
                // 第二人
                'second_member_salary_section' => $fee['salary_section'],
                'second_member_section_salary_total' => $value['second_member_day_count'] * $fee['salary_section'],
                'second_member_lunch_price' => $fee['lunch_fee'],
                'second_member_section_lunch_total' => $lunch_total2,
                'second_member_section_total' => $value['second_member_day_count'] * $fee['salary_section'] - $lunch_total2,
            );
            $this->db->where('sn', $value['sn']);
            $this->db->update('trial_assign', $data);
        }
        // 管卷人員更新
        $trial = $this->db->where('year', $year)->get('trial_staff')->result_array();
        foreach ($trial as $key => $value) {


            $day = explode(",", $value['do_date']);
            $day = count($day);


            if ($value['lunch_total'] == 0) {
                $lunch_total = 0;
            } else {
                $lunch_total = $day * $fee['lunch_fee'];
            }

            $data = array(
                'salary' => $fee['salary_section'],
                'salary_total' => $value['count'] * $fee['salary_section'],
                'lunch_price' => $fee['lunch_fee'],
                'lunch_total' => $lunch_total,
                'total' => $value['count'] * $fee['salary_section'] - $lunch_total,
            );
            $this->db->where('sn', $value['sn']);
            $this->db->update('trial_staff', $data);
        }
        // 巡場人員更新
        $patrol = $this->db->where('year', $year)->get('patrol_staff')->result_array();
        foreach ($patrol as $key => $value) {


            if ($value['lunch_total'] == 0) {
                $lunch_total = 0;
            } else {
                $lunch_total = $value['count'] * $fee['salary_section'];
            }

            $data = array(
                'salary' => $fee['salary_section'],
                'salary_total' => $value['section'] * $fee['salary_section'],
                'lunch_price' => $fee['lunch_fee'],
                'salary_total' => $lunch_total,
                'total' => $value['section'] * $fee['salary_section'] - $lunch_total,
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