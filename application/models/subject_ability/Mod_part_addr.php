<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_part_addr extends CI_Model
{


    public function chk_once($year)
    {
        $this->db->where('year', $year);
        if ($this->db->count_all_results('part_addr') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_once($year)
    {
        $this->db->where('year', $year);

        return $this->db->get('part_addr')->row_array();
    }

    public function update_once($year, $data)
    {
        $this->db->where('year', $year);
        $this->db->update('part_addr', $data);
    }

    public function add_once($data)
    {
        $this->db->insert('part_addr', $data);
    }
}

/* End of file Mod_exam_area.php */
