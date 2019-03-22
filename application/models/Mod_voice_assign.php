<?php
define('BASEPATH') OR exit('No direct script access allowed');

class Mod_voice_assign extends CI_Controller{
    

    public function get_list($part = '')
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        if($part != ''){

            $this->db->where('area_id',$part);
        }
        return $this->db->get('voice_area_main')->result_array();


    }
    
    public function get_once_assign($sn)
    {
        return $this->db->where('sn', $sn)->get('voice_trial_assign')->row_array();
    }


}



?>