<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_voice_test_pay extends CI_Model
{
    public function chk_once($year)
    {
        $this->db->where('year',$year);
        if ($this->db->count_all_results('voice_test_pay')==0) {
            return false ;
        }else {
            return true ;
        }
    
    }
    public function get_once($year)
    {
        $this->db->where('year', $year);

        return $this->db->get('voice_test_pay')->row_array();
    }

    public function update_once($year, $data)
    {
        $this->db->where('year', $year);
        $this->db->update('voice_test_pay', $data);
    }

    public function add_once($data)
    {
        $this->db->insert('voice_test_pay', $data);
    }



}
?>