<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_voice_area extends CI_Model {

    // 多筆輸入
    function insert_batch($datas){
        $this->db->where('year', $this->session->userdata('year'))->truncate('voice_area_main');
        $this->db->insert_batch('voice_area_main', $datas);
    }
  
    //把資料丟到陣列
    function voice_where_voice_area_main()
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        return $this->db->get('voice_area_main')->result_array();
    }
    public function get_part($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->select('part,class');

        return $this->db->get('voice_exam_area')->result_array();
    }
    // 取得單一考場單一場次的人數
    function get_count_num($field,$block_name){
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $this->db->where('field',$field);
        $this->db->where('block_name',$block_name);
        $row = $this->db->get('voice_exam_area')->row_array();
        // print_r($row);
        $count = 0;
        if( $row['count_num'] != ""){
            $count =  $row['count_num'];
        }
        return $count;
    }


   

}

/* End of file Mod_voice_area.php */
