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
    }

    public function add_once($data)
    {
        $this->db->insert('ability_exam_fees', $data);
    }
}


/* End of file Mod_exam_area.php */
