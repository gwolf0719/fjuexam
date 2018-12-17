<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_voice_job_list extends CI_Model
{

    function insert_member($data)
    {

        $where= array(
            'year'=>$this->session->userdata('year'),
            "ladder"=>$this->session->userdata('ladder'),
            'test_partition'=>$this->input->post('test_partition')
        );
        $this->db->where($where);
        $this->db->delete('voice_job_list');
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
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $this->db->where('test_partition',$test_partition);
        return $this->db->get('voice_job_list')->result_array();

    }


    // function voice_where_voice_area2()
    // {
    //     $this->db->where('year',$this->session->userdata('year'));
    //     $this->db->where('test_partition','1');
    //     return $this->db->get('voice_job_list')->result_array();
    // }

    public function get_part_for_once($test_partition)
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        return $this->db->where('test_partition', $test_partition)->get('voice_job_list')->row_array();
    }
    /**
     * 建立新職務.
     */
     public function add_job($test_partition, $job, $trial_start, $trial_end)
     {
         $data = array(
             'year' => $this->session->userdata('year'),
             'ladder'=>$this->session->userdata('ladder'),
             'test_partition'=>$test_partition,
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

    public function get_all_assign_member_list()
    {
        //取出試務人員
        $this->db->where('year', $this->session->userdata('year'));
        $res = $this->db->get('voice_job_list')->result_array();

        //取出監試人員
        $this->db->select('*');
        $this->db->from('voice_exam_area');
        $this->db->join('voice_trial_assign', 'voice_exam_area.sn = voice_trial_assign.sn');
        $this->db->where("voice_exam_area.year",$_SESSION['year']);
        $year = $this->session->userdata('year');
        $sub = $this->db->get()->result_array();

        //取出管卷人員
        $this->db->where('year', $this->session->userdata('year'));
        $trial_staff = $this->db->get('voice_trial_staff')->result_array();    
        
        //取出巡場人員
        $this->db->where('year', $this->session->userdata('year'));

        $patrol = $this->db->get('voice_patrol_staff')->result_array();

        for ($i=0; $i < count($res); $i++) {
            # code...
            $member_unit = $this->db->where('member_code', $res[$i]['job_code'])->select('member_unit')->get('voice_import_member')->row_array();
            if ($res[$i]['job_code'] != "") {
                $arr[] = array(
                    'job_code' => $res[$i]['job_code'],
                    'job' => $res[$i]['job'],
                    'name' => $res[$i]['name'],
                    'job_title' => $res[$i]['job_title'],
                    'member_unit'=>$member_unit['member_unit'],
                    'do_date' => $res[$i]['do_date']
                );
            }
        }
        for ($i=0; $i < count($sub); $i++) {
            # code...
            $supervisor_1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('voice_import_member')->row_array();
            if($sub[$i]['trial_staff_code_1'] != ""){
                $arr[] = array(
                    'job_code' => $sub[$i]['trial_staff_code_1'],
                    'job' => '監試人員',
                    'name' => $sub[$i]['supervisor_1'],
                    'job_title' => $supervisor_1['member_title'],
                    'member_unit'=>$supervisor_1['member_unit'],
                    'do_date' => $sub[$i]['first_member_do_date']
                );
            }
        }    

        for ($i=0; $i < count($sub); $i++) {
            # code...
            $supervisor_2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('voice_import_member')->row_array();
            if($sub[$i]['trial_staff_code_2'] != ""){
                $arr[] = array(
                    'job_code' => $sub[$i]['trial_staff_code_2'],
                    'job' => '監試人員',
                    'name' => $sub[$i]['supervisor_2'],
                    'job_title' => $supervisor_2['member_title'],
                    'member_unit'=>$supervisor_2['member_unit'],
                    'do_date' => $sub[$i]['second_member_do_date']
                );
            }
        }      
        
        for ($i=0; $i < count($trial_staff); $i++) {
            # code...
            $trial_staff_member = $this->db->where('member_code', $trial_staff[$i]['trial_staff_code'])->get('voice_import_member')->row_array();
            if($trial_staff[$i]['trial_staff_code'] != ""){
                $arr[] = array(
                    'job_code' => $trial_staff[$i]['trial_staff_code'],
                    'job' => '管卷人員',
                    'name' => $trial_staff[$i]['trial_staff_name'],
                    'job_title' => $trial_staff_member['member_title'],
                    'member_unit'=>$trial_staff_member['member_unit'],
                    'do_date' => $trial_staff[$i]['do_date']
                );
            }
        }    
        
        for ($i=0; $i < count($patrol); $i++) {
            # code...
            $patrol_member = $this->db->where('member_code', $patrol[$i]['patrol_staff_code'])->get('voice_import_member')->row_array();
            if($patrol[$i]['patrol_staff_code'] != ""){
                $arr[] = array(
                    'job_code' => $patrol[$i]['patrol_staff_code'],
                    'job' => '巡場人員',
                    'name' => $patrol[$i]['patrol_staff_name'],
                    'job_title' => $patrol_member['member_title'],
                    'member_unit'=>$patrol_member['member_unit'],
                    'do_date' => $patrol[$i]['do_date']
                );
            }
        }            
        return $arr;
    }







}

?>
