<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_voice_area extends CI_Model {

    // 清空
    function clean_voice_area_main(){
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $this->db->delete('voice_area_main');
        return true;
    }
    // 多筆輸入
    function insert_batch($data){
        $this->db->insert_batch('voice_area_main', $data);
    }

}

/* End of file Mod_voice_area.php */
