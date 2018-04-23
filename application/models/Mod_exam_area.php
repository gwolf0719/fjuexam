<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_exam_area extends CI_Model {

    function import($datas){
        // 先清除當年資料
        $this->db->where("year",$this->session->userdata("year"))->delete("exam_area");
        $this->db->insert_batch("exam_area",$datas);
    }
    function year_get_list(){
        return $this->db->where("year",$this->session->userdata("year"))->get("exam_area")->result_array();
    }

}

/* End of file Mod_exam_area.php */
