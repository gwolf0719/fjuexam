<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_ability_exam_area extends CI_Model
{
    public function import($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->truncate('ability_exam_area');
        $this->db->insert_batch('ability_exam_area', $datas);
    }

    public function year_get_list($part='')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if($part != ''){
            $this->db->where('part', $part);
        }

        return $this->db->get('ability_exam_area')->result_array();
    }

    public function year_get_member_count_list($part='')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if($part != ''){
            $this->db->where('part', $part);
        }

        $res = $this->db->get('ability_exam_area')->result_array();
        $number1 = 0;
        $number2 = 0;
        $number3 = 0;
        $number4 = 0;
        $number5 = 0;
        $number6 = 0;
        $number7 = 0;
        $number8 = 0;
        $number9 = 0;
        $number10 = 0;
        for ($i=0; $i < count($res); $i++) { 
            # code...
            $number1 += $res[$i]['subject_01'];
            $number2 += $res[$i]['subject_02'];
            $number3 += $res[$i]['subject_03'];
            $number4 += $res[$i]['subject_04'];
            $number5 += $res[$i]['subject_05'];
            $number6 += $res[$i]['subject_06'];
            $number7 += $res[$i]['subject_07'];
            $number8 += $res[$i]['subject_08'];
            $number9 += $res[$i]['subject_09'];
            $number10 += $res[$i]['subject_10'];
            $arr = array(
                'number1'=> $number1,
                'number2'=> $number2,
                'number3'=> $number3,
                'number4'=> $number4,
                'number5'=> $number5,
                'number6'=> $number6,
                'number7'=> $number7,
                'number8'=> $number8,
                'number9'=> $number9,
                'number10'=> $number10,
            );
        }
        return $arr;
    }

    public function year_school_name($part='')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if($part != ''){
            $this->db->where('part', $part);
        }

        $school = $this->db->get('ability_exam_area')->row_array();
        return $school['part_name'];
    }   
    
    public function year_addr_name($part='')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if($part != ''){
            $this->db->where('part', $part);
        }

        $addr = $this->db->get('ability_part_info')->row_array();
        print_r($addr);
        return $addr['addr'];
    }       

    public function get_min_start($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->select_min('field');

        return $this->db->get('ability_exam_area')->row_array();
    }

    public function get_max_end($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->select_max('field');

        return $this->db->get('ability_exam_area')->row_array();
    }

    public function get_max_filed($start, $end)
    {
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('field >=', $start);
        $this->db->where('field <=', $end);

        $data = $this->db->get('ability_exam_area')->result_array();
        foreach ($data as $k => $v) {
            //取出該區間沒有巡堂得值;
            $no = array_count_values($v);
        }

        return $count = 10 - $no[0];
    }

    public function get_part($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->select('part,field');

        return $this->db->get('ability_exam_area')->result_array();
    }
}

/* End of file Mod_exam_area.php */
