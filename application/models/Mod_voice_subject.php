<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_voice_subject extends CI_Model
{

    function chk_once($year,$ladder)
    {
        $this->db->where('year',$year);
        $this->db->where('ladder',$ladder);
        if ($this->db->count_all_results('voice_subject')==0) {
            return false ;
        }else {
            return true ;
        }
    
    }

    function get_once($year,$ladder)
    {
        $this->db->where('year',$year);
        $this->db->where('ladder',$ladder);
        return $this->db->get('voice_subject')->row_array();
    }

    function update_once($year,$ladder,$data)
    {
        $this->db->where('year',$year);
        $this->db->where('ladder',$ladder);
        $this->db->update('voice_subject',$data);
    }

    function add_once($data)
    {
        $this->db->insert('voice_subject',$data);
    }







}

?>