<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_exam_datetime extends CI_Model
{
    /**
     * 由試場起迄號得知使用日期
     * start 開始考場 end 結束考場
     * res 陣列 1=>第一天,2=>第二天,3=>第三天 
     * true 有
     * flase 沒有
     */
    function room_use_day($start,$end){
        $year  = $this->session->userdata("year");
        // 取得每日考科
        $day = array();
        for($i=1;$i<=3;$i++){
            foreach ($this->db->select('subject')->where('year',$year)->where('day',$i)->get('exam_course')->result_array() as $key => $value) {
                # code...
                if($value['subject'] != "subject_00"){
                    $day[$i][] = $value['subject'];
                }
            }
        }
        // 確認每一天
        $res = array();

        for($i=1;$i<=3;$i++){
            $where = array(
                'field <='=>$end,
                'field >='=>$start
            );
            foreach($day[$i] as $k=>$v){
                $where[$v] = 0;
            }
            if($this->db->where($where)->count_all_results('exam_area') == 0){
                $res[$i] = true;    
            }else{
                $res[$i] = false;
            }
        }
        
        
        return $res;
    }

    public function chk_once($year)
    {
        $this->db->where('year', $year);
        if ($this->db->count_all_results('exam_datetime') == 0) {
            return false;
        } else {
            return true;
        }
    }
    public function get_once($year)
    {
        $this->db->where('year', $year);
        return $this->db->get('exam_datetime')->row_array();
    }
    public function update_once($year, $data)
    {
        $this->db->where('year', $year);
        $this->db->update('exam_datetime', $data);
    }
    public function add_once($data)
    {
        $this->db->insert('exam_datetime', $data);
    }
    /**
     * 清除當年考試課程表.
     */
    public function clean_course($year)
    {
        $this->db->where('year', $year);
        $this->db->delete('exam_course');
    }
    public function setting_course($year, $data)
    {
        
        $new_data = array();
        foreach ($data as $k => $v) {
            
            $new_data[$k] = $v;
            $new_data[$k]['year'] = $year;
        }
        
        $this->db->insert_batch("exam_course",$new_data);
    }
    public function chk_course($year)
    {
        $this->db->where('year', $year);
        if ($this->db->count_all_results('exam_course') == 0) {
            return false;
        } else {
            return true;
        }
    }
    public function get_course($year)
    {
        $this->db->where('year', $year);
        
        
        return $this->db->get('exam_course')->result_array();
    }
}
/* End of file Mod_exam_datetime.php */