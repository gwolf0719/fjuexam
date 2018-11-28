<?php
define('BASEPATH') OR exit('No direct script access allowed');

class Mod_voice_assign extends CI_Controller{
    

    public function get_list($part = '')
    {
        $this->db->where('year',$this->session->userdata('year'));
        if($part != ''){

            $this->db->where('area_id',$part);
        }
        return $this->db->get('voice_area_main')->result_array();

    }


}



?>