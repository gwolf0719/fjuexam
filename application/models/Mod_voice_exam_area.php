<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_voice_exam_area extends CI_Model
{
    public function import($data_1)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('ladder', $this->session->userdata('ladder'));
        $this->db->truncate('voice_exam_area');
        $this->db->insert_batch('voice_exam_area', $data_1);
    }

    public function year_get_list($part='')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if($part != ''){
            $this->db->where('part', $part);
        }

        return $this->db->get('voice_exam_area')->result_array();
    }

    public function year_get_member_count_list($part='')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if($part != ''){
            $this->db->where('part', $part);
        }

        $res = $this->db->get('voice_exam_area')->result_array();
        $number1 = 0;
 
       
            # code...
            $number1 += $res[$i]['subject_01'];
      
            $arr = array(
                'number1'=> $number1,
               
            );
        
        return $arr;
    }

    public function year_school_name($part='')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if($part != ''){
            $this->db->where('part', $part);
        }

        $school = $this->db->get('voice_exam_area')->row_array();
     
        return $school;
    }   
    
    public function year_addr_name($part='')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if($part != ''){
            $this->db->where('part', $part);
        }

        $addr = $this->db->get('vocice_part_info')->row_array();
        
        return $addr['addr'];
    }       

    public function get_min_start($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->select_min('field');

        return $this->db->get('voice_exam_area')->row_array();
    }

    public function get_max_end($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->select_max('field');

        return $this->db->get('voice_exam_area')->row_array();
    }

    public function get_max_filed($start, $end)
    {
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('field >=', $start);
        $this->db->where('field <=', $end);

        $data = $this->db->get('voice_exam_area')->result_array();
        foreach ($data as $k => $v) {
            //取出該區間沒有巡堂得值;
            $no = array_count_values($v);
        }

        return $count = 10 - $no[0];
    }

    public function get_part($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('ladder', $this->session->userdata('ladder'));
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->select('part,field,block_name');

        return $this->db->get('voice_exam_area')->result_array();
    }

    public function get_part_block($part = '',$time)
    {
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('ladder', $this->session->userdata('ladder'));
        if ($part != ''&& $time != '') {
            $this->db->where('part', $part);
            $this->db->where('block_name',$time);
        }
        $this->db->select('part,block_name,field');

        return $this->db->get('voice_exam_area')->result_array();
    }


}

/* End of file Mod_exam_area.php */
?>