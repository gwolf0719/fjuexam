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

function room_use_day($start,$end,$part){
    $year  = $this->session->userdata("year");
    // 取得每日考科
    $day = array();
    // for($i=1;$i<=3;$i++){
    //     foreach ($this->db->select('subject')->where('year',$year)->where('day',$i)->get('exam_course')->result_array() as $key => $value) {
    //         # code...
    //         if($value['subject'] != "subject_00"){
    //             $day[$i][] = $value['subject'];
    //         }
    //     }
    // }
    // 確認每一天
    $res = array();
        $where = array(
            'part'=>$part,
            'field <='=>$end,
            'field >='=>$start
        );
        // foreach($day[$i] as $k=>$v){
        //     $where[$v] = 0;
        // }
        $section = array(
            'part'=>$part,
            'field <='=>$end,
            'field >='=>$start                
        );
        
        $sub1 = $this->db->where($where)->get('voice_exam_area')->result_array();
        $sub2 = $this->db->where($section)->get('voice_exam_area')->result_array();
        if(count($sub1) == count($sub2)){
            $res[] = false;
        }else{
            $res[] = true;
        }
   
    
    return $res;
}





}

?>