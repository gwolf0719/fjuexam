<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_voice_job_list extends CI_Model
{

    function insert_member($data)
    {
          $this->db->insert_batch('voice_job_list', $data);
    }


    function voice_where_voice_position()
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        return $this->db->get('voice_job_list')->result_array();
    }
    public function get_job_list($year, $test_partition)
    {
        $this->db->where('year', $year);
        $this->db->where('test_partition', $test_partition);
        $this->db->select('job');

        return $this->db->get('voice_job_list')->result_array();
    }

    function voice_where_voice_area($test_partition)
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('test_partition',$test_partition);
        return $this->db->get('voice_job_list')->result_array();
    }


    // function voice_where_voice_area2()
    // {
    //     $this->db->where('year',$this->session->userdata('year'));
    //     $this->db->where('test_partition','1');
    //     return $this->db->get('voice_job_list')->result_array();
    // }

    public function get_part_for_once($part)
    {
        return $this->db->where('area', $part)->get('voice_job_list')->row_array();
    }
    /**
     * 建立新職務.
     */
     public function add_job($year,$test_partition,$area, $job, $trial_start, $trial_end)
     {
         $data = array(
             'year' => $year,
             'ladder'=>$this->session->userdata('ladder'),
             'test_partition'=>$test_partition,
             'area' => $area,
             'job' => $job,
             'trial_start' => $trial_start,
             'trial_end' => $trial_end,
         );
         $this->db->insert('voice_job_list', $data);
     }
     public function add_job_b2($year,$area, $job, $trial_start, $trial_end)
     {
         $data = array(
             'year' => $year,
             'ladder'=>$this->session->userdata('ladder'),
             'test_partition'=>'1',
             'area' => $area,
             'job' => $job,
             'trial_start' => $trial_start,
             'trial_end' => $trial_end,
         );
         $this->db->insert('voice_job_list', $data);
     }
     public function add_job_b3($year,$area, $job, $trial_start, $trial_end)
     {
         $data = array(
             'year' => $year,
             'ladder'=>$this->session->userdata('ladder'),
             'test_partition'=>'2',
             'area' => $area,
             'job' => $job,
             'trial_start' => $trial_start,
             'trial_end' => $trial_end,
         );
         $this->db->insert('voice_job_list', $data);
     }
     public function add_job_b4($year,$area, $job, $trial_start, $trial_end)
     {
         $data = array(
             'year' => $year,
             'ladder'=>$this->session->userdata('ladder'),
             'test_partition'=>'3',
             'area' => $area,
             'job' => $job,
             'trial_start' => $trial_start,
             'trial_end' => $trial_end,
         );
         $this->db->insert('voice_job_list', $data);
     }

     public function get_once($sn)
     {
         return $this->db->where('sn', $sn)->get('voice_job_list')->row_array();
     }

    // 用代號取得完整資料
    public function get_once_info($job_code)
    {
        $this->db->where('member_code', $job_code);

        return $this->db->get('voice_import_member')->row_array();
    }


    // 取得姓名
    public function get_member_info()
    {
        $this->db->distinct();
        $this->db->select('member_code,member_name');

        $data = $this->db->get('voice_import_member')->result_array();
        // echo $this->db->last_query();
        return $data;
    }

    


     public function update_once($sn,$data)
     {

        $this->db->where('sn',$sn);
        $this->db->update('voice_job_list',$data);
        return true;
     }

     public function remove_once($sn)
     {
         $this->db->where('sn',$sn);
         $this->db->delete('voice_job_list');
         
         return true;
     }
     
    public function get_list($test_partition = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($test_partition !== '') {
            $this->db->where('test_partition', $test_partition);
        }
        $this->db->order_by('sn', 'asc');
        
         $list =  $this->db->get('voice_job_list')->result_array();
    
         return $list;
    }







}

?>
