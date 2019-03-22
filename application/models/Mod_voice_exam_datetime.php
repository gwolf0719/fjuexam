<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Mod_voice_exam_datetime extends CI_Model
{

function chk_once($year,$ladder)
{
    $this->db->where('year',$year);
    $this->db->where('ladder',$ladder);
    if ($this->db->count_all_results('voice_exam_datetime')==0) {
        return false ;
    }else {
        return true ;
    }

}

function get_once($year,$ladder)
{
    $this->db->where('year',$year);
    $this->db->where('ladder',$ladder);
    return $this->db->get('voice_exam_datetime')->row_array();
}

function update_once($year,$ladder,$data)
{
    $this->db->where('year',$year);
    $this->db->where('ladder',$ladder);
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

 public function get_day_section($start, $end)
    {
        $year = $this->session->userdata('year');
        // 取得每日考科
        $day = array();
        // for ($i = 1; $i <= 3; ++$i) {
        //     foreach ($this->db->select('subject')->where('year', $year)->where('day', $i)->get('exam_course')->result_array() as $key => $value) {
        //         // code...
        //         // if ($value['subject'] != 'subject_00') {
        //         $day[$i][] = $value['subject'];
        //         // }
        //     }
        // }
        $count = 0;
        $where = array();
        // for ($i = 1; $i <= 3; ++$i) {
            foreach ($day[$i] as $k => $v) {
                // if ($v != "subject_00") {
                    $where = array(
                        'year' => $year,
                        'field <=' => $end,
                        'field >=' => $start,
                        $v.'!=' => 0,
                    );
                    if ($this->db->where($where)->count_all_results('exam_area') != 0) {
                        $count = $count + 1;
                    }
                // }
            }
        // }

        return $count;
    }
  /**
     * 清除當年考試課程表.
     */
     public function clean_course($year)
     {
         $this->db->where('year', $year);
         $this->db->delete('voice_subject');
     }

     public function setting_course($year, $data)
     {
         $new_data = array();
         foreach ($data as $k => $v) {
             $new_data[$k] = $v;
             $new_data[$k]['year'] = $year;
         }
 
         $this->db->insert_batch('voice_subject', $new_data);
     }


public function get_once_day_section($uses_day, $start, $end)
{
    $year = $this->session->userdata('year');
    //先取得當天考試科目
    $day = array();
    foreach ($this->db->select('subject_1')->where('year',$this->session->userdata('year'))->where('ladder',$this->session->userdata('ladder'))->where('day', $uses_day)->get('exam_course')->result_array() as $key => $value) {
        // code...
        // if ($value['subject'] != 'subject_00') {
        $day[$uses_day][] = $value['subject'];
        // }
    }

    //將試場的值送入搜尋

    $count = 0;
    $where = array();
    foreach ($day[$uses_day] as $k => $v) {
        if ($v != "subject_00") {
            $where = array(
            'year' => $year,
            'field <=' => $end,
            'field >=' => $start,
            $v.'!=' => 0,
        );

            if ($this->db->where($where)->where('year',$this->session->userdata('year'))->where('ladder',$this->session->userdata('ladder'))->count_all_results('exam_area') != 0) {
                $count = $count + 1;
            }
        }
    }

    return $count;
}

public function get_course($year,$ladder)
{
    $this->db->where('year', $year);
    $this->db->where('ladder',$ladder);

    return $this->db->get('voice_subject')->result_array();
}

public function chk_course($year,$ladder)
{
    $this->db->where('year', $year);
    $this->db->where('ladder',$ladder);

    if ($this->db->count_all_results('voice_subject') == 0) {
        return false;
    } else {
        return true;
    }
}





}

?>