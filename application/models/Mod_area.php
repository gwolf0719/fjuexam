<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_area extends CI_Model
{
    public function import($area)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('area_main');
        $this->db->insert_batch('area_main', $area);
    }

    public function year_get_list()
    {
        return $this->db->where('year', $this->session->userdata('year'))->get('area_main')->result_array();
    }

    public function chk_once($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('area_main') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_list($year = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($year != '') {
            $this->db->where('year', $year);
        }

        return $this->db->get('area_main')->result_array();
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('area_main')->row_array();
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('area_main', $data);

        return true;
    }

    public function add_once($data)
    {
        $this->db->insert('area_main', $data);

        return true;
    }

    /**
     * TODO:檢查A是否匯入完整
     */
    function check_a1(){

        // A1
        $this->db->where('year',$this->session->userdata('year'));
        $count1 = $this->db->count_all_results('exam_area');
        if($count1>0){$count1=1;}
        // A2
        $this->db->where('year',$this->session->userdata('year'));
        $count2 = $this->db->count_all_results('school_unit');
        if($count2>0){$count2=1;}
        // A3
        $this->db->where('year',$this->session->userdata('year'));
        $count3 = $this->db->count_all_results('staff_member');
        if($count3>0){$count3=1;}
        // A4
        $this->db->where('year',$this->session->userdata('year'));
        $count4 = $this->db->count_all_results('district_task');
        if($count4>0){$count4=1;}

        $count=$count1+$count2+$count3+$count4;


        if($count<4){
            return 'no';
        }else if($count==4){
            return 'yes';
        }
    }

    /**
     * TODO:檢查F是否匯入完整
     */
    function check_f(){
        // F1
        $this->db->where('year',$this->session->userdata('year'));
        $count1 = $this->db->count_all_results('ability_exam_datetime');
        if($count1>0){$count1=1;}
        // F2
        $this->db->where('year',$this->session->userdata('year'));
        $count2 = $this->db->count_all_results('ability_exam_course');
        if($count2>0){$count2=1;}
        // F4
        $this->db->where('year',$this->session->userdata('year'));
        $count3 = $this->db->count_all_results('ability_exam_fees');
        if($count3>0){$count3=1;}
        
        $count=$count1+$count2+$count3;
        if($count<3){
            return 'no';
        }else if($count==3){
            return 'yes';
        }
    }


   




}

/* End of file Mod_exam_area.php */
