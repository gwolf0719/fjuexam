<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Mod_voice_exam_datetime extends CI_Model
{

function chk_once($year)
{
    $this->db->where('year',$year);
    if ($this->db->count_all_results('voice_exam_datetime')==0) {
        return false ;
    }else {
        return true ;
    }

}

function get_once($year)
{
    $this->db->where('year',$year);
    return $this->db->get('voice_exam_datetime')->row_array();
}

function update_once($year,$data)
{
    $this->db->where('year',$year);
    $this->db->update('voice_exam_datetime',$data);
}

function add_once($data)
{
    $this->db->insert('voice_exam_datetime',$data);
}





}

?>