<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_exam_datetime extends CI_Model
{
    public function chk_once($year)
    {
        $this->db->where('year', $year);
        if ($this->db->count_all_results('exam_datetime') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_once($year)
    {
        $this->db->where('year', $year);

        return $this->db->get('exam_datetime')->row_array();
    }

    public function update_once($year, $data)
    {
        $this->db->where('year', $year);
        $this->db->update('exam_datetime', $data);
    }

    public function add_once($data)
    {
        $this->db->insert('exam_datetime', $data);
    }

    /**
     * 清除當年考試課程表.
     */
    public function clean_course($year)
    {
        $this->db->where('year', $year);
        $this->db->delete('exam_course');
    }

    public function setting_course($year, $data)
    {
        foreach ($data as $k => $v) {
            $new_data = array(
                'year' => $year,
                'course' => $k,
                'course_name' => $v,
            );
            $this->db->insert('exam_course', $new_data);
        }
    }

    public function chk_course($year)
    {
        $this->db->where('year', $year);
        if ($this->db->count_all_results('exam_course') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_course($year)
    {
        $this->db->where('year', $year);
        $res = array();
        foreach ($this->db->get('exam_course')->result_array() as $key => $value) {
            // code...
            $res[$value['course']] = $value['course_name'];
        }

        return $res;
    }
}

/* End of file Mod_exam_datetime.php */
