<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_voice_trial extends CI_Model
{
    // public function get_field()
    // {
    //    $this->db->where('field');
    //    return true
    // }


    
    public function get_list($part = '')
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $this->db->where('block_name','上午場');
        if($part!=""){
            $this->db->where('part',$part);
        }
        $res = array();
        foreach ($this->db->get('voice_area_main')->result_array() as $key => $value) {
            # code...
            $res[$key]=$value;
            $res[$key]['trial_staff_code_1'] = '';
            $res[$key]['supervisor_1'] = '';
            $res[$key]['supervisor_1_code'] = '';
            $res[$key]['trial_staff_code_2'] = '';
            $res[$key]['supervisor_2'] = '';
            $res[$key]['supervisor_2_code'] = '';
            $res[$key]['note'] = '';
            $res[$key]['assign_sn'] = '';
            $assign = array();
            $this->db->where('year',$this->session->userdata('year'));
            $this->db->where('ladder',$this->session->userdata('ladder'));
            if($part!=""){
                $this->db->where('part',$part);
                $this->db->where('field',$value['field']);
            }
            $this->db->select('sn,field,trial_staff_code_1,supervisor_1,supervisor_1_code,trial_staff_code_2,supervisor_2,supervisor_2_code,note,block_name');
            $assign = $this->db->get('voice_trial_assign')->result_array();
            // 整合 block_name
            $block_name = array();
            $assign_sn = array();
            foreach($assign as $kb=>$kv){
                $block_name[] = $kv['block_name'] ;
                $assign_sn[] = $kv['sn'] ;
            }
            
            $res[$key]['assign_sn'] = implode(",",$assign_sn);
            $res[$key]['block_name'] = implode(",",$block_name);        
            $res[$key]['field'] = $assign[0]['field'];            
            $res[$key]['trial_staff_code_1'] = $assign[0]['trial_staff_code_1'];
            $res[$key]['supervisor_1'] = $assign[0]['supervisor_1'];
            $res[$key]['supervisor_1_code'] = $assign[0]['supervisor_1_code'];
            $res[$key]['trial_staff_code_2'] = $assign[0]['trial_staff_code_2'];
            $res[$key]['supervisor_2'] = $assign[0]['supervisor_2'];
            $res[$key]['supervisor_2_code'] = $assign[0]['supervisor_2_code'];
            $res[$key]['note'] = $assign[0]['note'];
        }
        
        return $res;

    }

    public function get_trial_list($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        return $this->db->get('voice_trial_staff')->result_array();
    }

    public function import($datas)
    {
        $this->db->where('year', $this->session->userdata('year'))->truncate('voice_trial_assign');
        $this->db->insert_batch('voice_trial_assign',$datas);

    }

    public function update_once($year,$ladder,$field,$part,$data)
    {
        $this->db->where('year', $year);
        $this->db->where('ladder', $ladder);
        $this->db->where('field', $field);
        $this->db->where('part', $part);
        
    
        $this->db->update('voice_trial_assign',$data);

        return true;
    }
    public function get_once_trial_by_code($trial_staff_code)
    {
        return $this->db->where('member_code', $trial_staff_code)->get('voice_import_member')->row_array();
    }  

    public function get_once_trial($sn)
    {
        return $this->db->where('sn', $sn)->get('voice_trial_staff')->row_array();
    }

    
    public function get_once_assign($sn)
    {
        return $this->db->where('sn', $sn)->get('voice_trial_assign')->row_array();
    }

    public function chk_once($year,$ladder,$field,$part)
    {
        $this->db->where('year', $year);
        $this->db->where('ladder', $ladder);
        $this->db->where('field', $field);
        $this->db->where('part', $part);

        if ($this->db->count_all_results('voice_trial_assign') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function add_trial($data)
    {
        
        $this->db->insert('voice_trial_staff', $data);

        return true;
    }
    public function update_trial($sn, $data)
    {
       
        $this->db->where('sn', $sn);
        $this->db->update('voice_trial_staff', $data);

        return true;
    }

      /**
     * 檢查監試人員是否指派過
     */
     public function chk_trial_assigned($trial_staff_code){
        $this->db->where('supervisor_1_code',$trial_staff_code);
        $this->db->or_where('supervisor_2_code',$trial_staff_code);
        if($this->db->count_all_results('voice_trial_assign') == 0){
            return false;
        }else{
            return true;
        }
    }
    public function chk_trial($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('voice_trial_staff') == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 檢查管卷人員試場是否重複
     */
    function chk_trial_staff_field($data){
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $this->db->where('part',$data['part']);
        $this->db->where('first_start',$data['first_start']);
        $this->db->where('first_end',$data['first_end']);
        $this->db->where('second_start',$data['second_start']);
        $this->db->where('second_end',$data['second_end']);
        if($this->db->count_all_results('voice_trial_staff') == 0){
            return false;
        }else{
            return true;
        }
    }

    public function remove_trial_staff($sn)
    {
        $this->db->where('sn', $sn);
        $this->db->delete('voice_trial_staff');

        return true;
    }


    public function chk_part_list($part, $area ,$year, $ladder)
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('voice_area_main.part',$part);
            $this->db->where('voice_area_main.year',$year);
            $this->db->where('voice_area_main.ladder',$ladder);
        }
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        
        // $this->db->where('first_member_do_date !=', "");
        // $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();


        function even($var)
        {
            return($var['year'] == $_SESSION['year']);
        }

        $sub =  array_filter($res, "even");

        sort($sub);


        if (!empty($sub)) {
            return true;
        } else {
            return false;
        }
    }

    //
    function get_distinct_voice_area($part){
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->distinct();
        $this->db->select('field');
        $area = $this->db->get('voice_area_main')->result_array();
        // print_r($area['field']);
        $res = array();
        foreach($area as $k=>$v){
            $this->db->where('year',$this->session->userdata('year'));
            $this->db->where('ladder',$this->session->userdata('ladder'));
            if ($part != '') {
                $this->db->where('part', $part);
            }
            $this->db->where('field',$v['field']);
            $class= 0;
            $block_array=array();
            $block_name="";
            foreach($this->db->get('voice_area_main')->result_array() as $k2=>$v2){
                // echo '1';
                $class=$class+1;
                // $last_query = $this->db->last_query();
                $block_array[] = $v2['block_name'];
            }
            // echo $this->db->last_query();
            $block_name=implode(",",$block_array);
            $res[$k] = $v;
            $res[$k]['block_name'] = $block_name;
            // $res[$k]['last_query'] = $last_query;    
            $res[$k]['class'] = $class;
        }

        return $res;

    }
/**
     * 監試及試務人員 > 監試人員
     */
    public function get_list_for_pdf($part = '')
    {
        $areas =  $this->get_distinct_voice_area($part);
        $res = array();
        foreach($areas as $k=>$v){
            $this->db->where('year',$this->session->userdata('year'));
            $this->db->where('ladder',$this->session->userdata('ladder'));
            $this->db->where('field',$v['field']);
            $res[$k] = $this->db->get('voice_trial_assign')->row_array();
            $res[$k]['field'] = $v['field'];
            $res[$k]['class'] = $v['class'];
            $res[$k]['block_name'] = $v['block_name'];
            $res[$k]['do_date'] = $res[$k]['first_member_do_date'];
             // 預先宣告要有設定人的才找資料
                if($res[$k]['supervisor_1_code'] != ""){
                    $supervisor1 = $this->db->where('member_code', $res[$k]['supervisor_1_code'])->get('voice_import_member')->row_array();
                    $res[$k]['supervisor_1_unit'] = $supervisor1['member_unit'];
                    $res[$k]['supervisor_1_phone'] =  $supervisor1['member_phone'];
                }else{
                    $res[$k]['supervisor_1_unit'] = '';
                    $res[$k]['supervisor_1_phone'] = '';
                }
                
                if($res[$k]['supervisor_2_code'] != ""){
                    $supervisor2 = $this->db->where('member_code', $res[$k]['supervisor_2_code'])->get('voice_import_member')->row_array();
                    // print_r($supervisor2);
                    $res[$k]['supervisor_2_unit'] = $supervisor2['member_unit'];
                    $res[$k]['supervisor_2_phone'] = $supervisor2['member_phone'];
                }else{
                    $res[$k]['supervisor_2_unit'] = '';
                    $res[$k]['supervisor_2_phone'] = '';                    
                }
        }
        return $res;
        // print_r($res);
        // $this->db->select('*');
        // if ($part != '') {
        //     $this->db->where('voice_area_main.part', $part);
        // }
        // $this->db->from('voice_area_main');
        // $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        
        // // $this->db->where('first_member_do_date !=', "");
        // $year = $this->session->userdata('year');

        // $res = $this->db->get()->result_array();
        // if(!empty($res)){
        //     function even($var)
        //     {
        //         return($var['year'] == $_SESSION['year']);
        //     }

        //     $sub =  array_filter($res, "even");
        //     // print_r($sub);
        //     sort($sub);


        //     for ($i=0; $i < count($sub); $i++) {
        //         # code...
        //         // 預先宣告要有設定人的才找資料
        //         if($sub[$i]['supervisor_1_code'] != ""){
        //             $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('voice_import_member')->row_array();
        //         }else{
        //             $supervisor1['member_unit'] = '';
        //             $supervisor1['member_phone'] = '';
        //         }
                
        //         if($sub[$i]['supervisor_2_code'] != ""){
        //             $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('voice_import_member')->row_array();
        //         }else{
        //             $supervisor2['member_unit'] = '';
        //             $supervisor2['member_phone'] = '';
        //         }
                
        //         $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('voice_patrol_staff')->row_array();
        //         $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('voice_exam_area')->row_array();
        //         $trial = $this->db->get('voice_trial_staff')->result_array();
        //         // $trial_staff = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('trial_staff')->row_array();
        //         // print_r($trial_staff);

        //         if($sub[$i]['first_member_salary_section'] == ""){
        //             $first_member_salary_section = 0;
        //         }else{
        //             $first_member_salary_section = $sub[$i]['first_member_salary_section'];
        //         }
        //         if($sub[$i]['second_member_salary_section'] == ""){
        //             $second_member_salary_section = 0;
        //         }else{
        //             $second_member_salary_section = $sub[$i]['second_member_salary_section'];
        //         }            
        //         $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
        //         $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
        //         $arr[] = array(
                   
        //             'sn'=>$sub[$i]['sn'],
        //             'field' => $sub[$i]['field'],
        //             'class' => $sub[$i]['class'],
        //             'part' => $sub[$i]['part'],
        //             'do_date' => $sub[$i]['first_member_do_date'],
        //             'first_member_salary_section'=> $first_member_salary_section,
        //             'first_member_section_salary_total'=>$sub[$i]['first_member_section_salary_total'],
        //             'supervisor_1'=>$sub[$i]['supervisor_1'],
        //             'supervisor_1_unit' => $supervisor1['member_unit'] ,
        //             'supervisor_1_phone' => $supervisor1['member_phone'],
        //             'second_member_salary_section'=>$second_member_salary_section,
        //             'second_member_section_salary_total'=>$sub[$i]['second_member_section_salary_total'],
        //             'supervisor_2'=>$sub[$i]['supervisor_2'],
        //             'supervisor_2_unit' => $supervisor2['member_unit'] ,
        //             'supervisor_2_phone' => $supervisor2['member_phone'],
        //             // 'floor' =>$sub[$i]['floor'],
        //             // 'number'=>$sub[$i]['count_num'],
        //             // 'start'=>$sub[$i]['start'],
        //             // 'end'=>$sub[$i]['end'],
        //             // 'allocation_code'=>$patrol['allocation_code'],
        //             // 'patrol'=>$patrol['patrol_staff_name'],
        //             // 'subject_01'=>$course['subject_01'],
        //         );
        //     }
        //     return $arr;
        // }else{
        //     return false;
        // }
    }

    public function e_2_1_2($part='')
    {
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('ladder', $this->session->userdata('ladder'));
        if($part != ''){
            $this->db->where('part', $part);
        }

        $res = $this->db->get('voice_trial_staff')->result_array();
        if (!empty($res)) {
            for ($i=0; $i < count($res); $i++) {
                # code...
                $member = $this->db->where('member_code', $res[$i]['trial_staff_code'])->get('voice_import_member')->row_array();
                // $trial = $this->db->where('part',$part)->where('year',$_SESSION['year'])->get('trial_staff')->row_array();
                $do_date = explode(",", $res[$i]['do_date']);
                for ($d=0; $d < count($do_date); $d++) {

                    $arr[$do_date[$d]][] = array(
                        'job_code' => $res[$i]['trial_staff_code'],
                        'job' => '管卷人員',
                        // 'job_title' => $res[$i]['job_title'],
                        'name' => $res[$i]['trial_staff_name'],
                        'member_unit'=>$member['member_unit'],
                        'note' => $res[$i]['note'],
                    );
                }
            }
            return $arr;
        }else{
            return false;
        }
    }  


    public function e_2_1_3($part='')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if($part != ''){
            $this->db->where('part', $part);
        }

        $res = $this->db->get('voice_patrol_staff')->result_array();
        if (!empty($res)) {
            for ($i=0; $i < count($res); $i++) {
                # code...
                $member = $this->db->where('member_code', $res[$i]['patrol_staff_code'])->get('voice_import_member')->row_array();
                // $trial = $this->db->where('part',$part)->where('year',$_SESSION['year'])->get('trial_staff')->row_array();
                $do_date = explode(",", $res[$i]['do_date']);
                for ($d=0; $d < count($do_date); $d++) {

                    $arr[$do_date[$d]][] = array(
                        'job_code' => $res[$i]['patrol_staff_code'],
                        'job' => '巡場人員',
                        // 'job_title' => $res[$i]['job_title'],
                        'name' => $res[$i]['patrol_staff_name'],
                        'member_unit'=>$member['member_unit'],
                        'note' => $res[$i]['note'],
                    );
                }
            }
            return $arr;
        }else{
            return false;
        }
    }  

    // 監試人員執行任務簽到表 匯出專用

    public function get_date_for_trial_list($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('voice_trial_assign.part', $part);
        }
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        
        // $this->db->where('first_member_do_date =', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();
        
        function even($var)
        {
            return($var['year'] == $_SESSION['year']);
        }

        $sub =  array_filter($res, "even");
        sort($sub);

        // print_r($sub);

        if (!empty($sub)) {
            for ($i=0; $i < count($sub); $i++) {
                # code...
                // 預先宣告要有設定人的才找資料
                if($sub[$i]['supervisor_1_code'] != ""){
                    $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('voice_import_member')->row_array();
                }else{
                    $supervisor1['member_unit'] = '';
                    $supervisor1['member_phone'] = '';
                }
                
                if($sub[$i]['supervisor_2_code'] != ""){
                    $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('voice_import_member')->row_array();
                }else{
                    $supervisor2['member_unit'] = '';
                    $supervisor2['member_phone'] = '';
                }
                
                
                $do_date = explode(",", $sub[$i]['first_member_do_date']);
                
                for ($d=0; $d < count($do_date); $d++) {
                    $arr[$do_date[$d]][] = array(
                        'sn'=>$sub[$i]['sn'],
                        'field' => $sub[$i]['field'],
                        'test_section' => $sub[$i]['class'],
                        'part' => $sub[$i]['part'],
                        'supervisor_1'=>$sub[$i]['supervisor_1'],
                        'supervisor_1_unit' => $supervisor1['member_unit'] ,
                        'supervisor_1_phone' => $supervisor1['member_phone'],
                        'supervisor_2'=>$sub[$i]['supervisor_2'],
                        'supervisor_2_unit' => $supervisor2['member_unit'] ,
                        'supervisor_2_phone' => $supervisor2['member_phone'],
                        'floor' =>$sub[$i]['floor'],
                        'number'=>$sub[$i]['count_num'],
                        'start'=>$sub[$i]['start'],
                        'end'=>$sub[$i]['end'],
                    );
                }
            }
            return $arr;
        } else {
            return false;
        }
    }

    public function get_once_date_of_voucher1($part = '')
    {
        // 找到管眷人員
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('ladder', $this->session->userdata('ladder'));
        $this->db->where('part',$part);
        $res = array();
        foreach($this->db->get('voice_trial_staff')->result_array() as $k=>$v){
            if($v['first_end'] != ""){
                $res[$k]= $v;
                $this->db->where('year', $this->session->userdata('year'));
                $this->db->where('ladder', $this->session->userdata('ladder'));
            
                
                $this->db->where('field <='.$v['first_end']);
                $this->db->where('field >='.$v['first_start']);
                $this->db->distinct();
                $this->db->select('field,supervisor_1,supervisor_1_code,supervisor_2,supervisor_2_code');
                $trial = array();
                foreach($this->db->get('voice_trial_assign')->result_array() as $kt=>$vt){
                    $res[$k]['trial'][$kt]= $vt;
                    $this->db->where('year', $this->session->userdata('year'));
                    $this->db->where('ladder', $this->session->userdata('ladder'));
                    
                    $this->db->where('field',$vt['field']);
                    $block_name = '';
                    $b_array = array();
                    foreach($this->db->get('voice_trial_assign')->result_array() as $kb=>$vb){
                        $b_array[]=$vb['block_name'];
                    }
                    $block_name = implode(',',$b_array);
                    $res[$k]['trial'][$kt]['block_name'] = $block_name;
                }
            }
            
        }
        return $res;


      

    }  

    public function get_patrol_member_count_1($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('voice_area_main.part', $part);
        }
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');


        $res = $this->db->get()->result_array();
        // print_r($res);

        if(!empty($res)){
            function odd($var)
            {
                return($var['year'] == $_SESSION['year']);
            }

            $sub =  array_filter($res, "odd");

            sort($sub);
            for ($i=0; $i < count($sub); $i++) {
                
                $voucher = $this->db->where('part', $part)->where('first_start <=', $sub[$i]['field'])->where('first_end >=', $sub[$i]['field'])->get('voice_trial_staff')->result_array();
                foreach ($voucher as $k => $v) {
                    # code...
                    $arr[$v['trial_staff_code']][] = array(
                        'trial_staff_name'=>$v['trial_staff_name'],
                    );
                }
            }
            if(!empty($arr)){
                return count($arr);
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function get_supervisor_list($part = '')
    {
        $this->db->select('*');
       
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        if ($part != '') {
            $this->db->where('voice_area_main.part', $part);
        }
        // $this->db->where("v.year",$_SESSION['year']);

        $res = $this->db->get()->result_array();
        


        for ($i=0; $i < count($res); $i++) {
            # code...
            $course = $this->db->where('year', $_SESSION['year'])->where('field', $res[$i]['field'])->get('voice_exam_area')->row_array();
            $arr[] = array(
                'sn'=>$res[$i]['sn'],
                'field' => $res[$i]['field'],
                'test_section' => $res[$i]['class'],
                'part' => $res[$i]['part'],
                'supervisor_code'=>$res[$i]['trial_staff_code_1'],
                'supervisor'=>$res[$i]['supervisor_1'],
                'do_date' => $res[$i]['first_member_do_date'],
                'floor' =>$res[$i]['floor'],
                'subject_01'=>$course['subject_01'],
                         
            );

            $arr[] = array(
                'sn'=>$res[$i]['sn'],
                'field' => $res[$i]['field'],
                'test_section' => $res[$i]['class'],
                'part' => $res[$i]['part'],
                'supervisor_code'=>$res[$i]['trial_staff_code_2'],
                'supervisor'=>$res[$i]['supervisor_2'],
                'do_date' => $res[$i]['second_member_do_date'],
                'floor' =>$res[$i]['floor'],
                'subject_01'=>$course['subject_01'],
                 
            );            


        }
        return $arr;
    }

    
    
    public function e_3_2_1($part = '')
    {
        $this->db->select('*');
        $year = $this->session->userdata('year');
        $this->db->where('voice_area_main.year', $year);
        if ($part != '') {
            $this->db->where('voice_area_main.part', $part);
        }
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
    

        $sub = $this->db->get()->result_array();
        if(!empty($sub)){
            for ($i=0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('voice_import_member')->row_array();
                $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('voice_import_member')->row_array();
                $voucher = $this->db->where('part', $part)->where('first_start <=', $sub[$i]['field'])->where('first_end >=', $sub[$i]['field'])->get('voice_trial_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('voice_exam_area')->row_array();
                $trial = $this->db->get('voice_trial_staff')->result_array();
                # code...
                $arr[] = array(
                    'sn'=>$sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section'=>$sub[$i]['class'],
                    'start'=>$sub[$i]['start'],
                    'end'=>$sub[$i]['end'],
                    'floor'=>$sub[$i]['floor'],
                    'part' => $sub[$i]['part'],
                    'supervisor_1'=>$sub[$i]['supervisor_1'],
                    'supervisor_2'=>$sub[$i]['supervisor_2'],
                    'allocation_code'=>$voucher['allocation_code'],
                    'voucher'=>$voucher['trial_staff_name']
                );        
            }
            return $arr;
        }else{
            return false;
        }
    }  


    public function get_trial_member_count($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('voice_area_main.part', $part);
        }
        $this->db->where("voice_area_main.year",$_SESSION['year']);

        $this->db->where("voice_trial_assign.supervisor_1 != ","");
        $this->db->where("voice_trial_assign.supervisor_2 != ","");      
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        $year = $this->session->userdata('year');
        
        $sub = $this->db->get()->result_array();
        if(!empty($sub)){

            // print_r($sub);

            for ($i=0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('voice_import_member')->row_array();
                $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('voice_import_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('voice_patrol_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('voice_exam_area')->row_array();
                $trial = $this->db->get('voice_trial_staff')->result_array();
                if($sub[$i]['first_member_salary_section'] == ""){
                    $first_member_salary_section = 0;
                }else{
                    $first_member_salary_section = $sub[$i]['first_member_salary_section'];
                }
                if($sub[$i]['second_member_salary_section'] == ""){
                    $second_member_salary_section = 0;
                }else{
                    $second_member_salary_section = $sub[$i]['second_member_salary_section'];
                }      
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $arr[] = array(
                    'sn'=>$sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['class'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['first_member_do_date'],
                    'first_member_salary_section'=> $sub[$i]['first_member_section_salary_total'] * count($do_date1),
                    'first_member_section_salary_total'=>$sub[$i]['first_member_section_salary_total']*count($do_date1),
                    'supervisor_1'=>$sub[$i]['supervisor_1'],
                    'supervisor_1_unit' => $supervisor1['member_unit'] ,
                    'supervisor_1_phone' => $supervisor1['member_phone'],
                    'second_member_salary_section'=> $sub[$i]['second_member_section_salary_total']*count($do_date2),
                    'second_member_section_salary_total'=>$sub[$i]['second_member_section_salary_total']*count($do_date2),
                    'supervisor_2'=>$sub[$i]['supervisor_2'],
                    'supervisor_2_unit' => $supervisor2['member_unit'] ,
                    'supervisor_2_phone' => $supervisor2['member_phone'],
                );
            }
            // print_r($arr);
            return $arr;
        }else{
            return false;
        }
    }     

    public function get_list_for_csv()
    {
        // $this->db->where('year', $_SESSION['year']);

        $this->db->select('*');
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        // $this->db->where('year', $_SESSION['year']);

        $this->db->where('first_member_do_date !=', "");

        $res = $this->db->get()->result_array();
    
        
        function even($var)
        {
            return($var['year'] == $_SESSION['year']);
            return($var['ladder'] == $_SESSION['ladder']);

        }

        $sub =  array_filter($res, "even");
        // print_r($sub);
        sort($sub);

        for ($i=0; $i < count($sub); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('voice_import_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('voice_import_member')->row_array();
            

            // foreach ($res as $k => $v) {
            # code...
            $arr[] = array(
                    'year' => $sub[$i]['year'],
                    'ladder' => $sub[$i]['ladder'],                    
                    'area_name'=>$sub[$i]['area_name'],
                    'do_date' => $sub[$i]['first_member_do_date'],
                    'member_unit' => $supervisor1['member_unit'],
                    'member_name'=> $supervisor1['member_name'],
                    'member_code' =>$supervisor1['member_code'],
                    'trial_staff_code'=>$sub[$i]['trial_staff_code_1'],
                );
            $arr[] = array(
                    'year' => $sub[$i]['year'],
                    'ladder' => $sub[$i]['ladder'],
                    'area_name'=>$sub[$i]['area_name'],
                    'do_date' => $sub[$i]['second_member_do_date'],
                    'member_unit' => $supervisor2['member_unit'],
                    'member_name'=> $supervisor2['member_name'],
                    'member_code' =>$supervisor2['member_code'],
                    'trial_staff_code'=>$sub[$i]['trial_staff_code_2'],
                );                
            // }
        }
        // print_r($arr);
        return $arr;
    }

    public function e_6_1($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('voice_area_main.part', $part);
        }
     
        $this->db->not_like('voice_area_main.field', '29','after');
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');
    

        
        $res = $this->db->get()->result_array();
        if(!empty($res)){
            function even($var)
            {
                return($var['year'] == $_SESSION['year']);
                return($var['ladder'] == $_SESSION['ladder']);

            }

            $sub =  array_filter($res, "even");

            sort($sub);

            // print_r($sub);

            for ($i=0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('voice_import_member')->row_array();
                $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('voice_import_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('voice_patrol_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('voice_exam_area')->row_array();
                $trial = $this->db->get('voice_trial_staff')->result_array();
                if($sub[$i]['first_member_section_salary_total'] == ""){
                    $first_member_section_salary_total = 0;
                }else{
                    $first_member_section_salary_total = $sub[$i]['first_member_section_salary_total'];
                }
                if($sub[$i]['second_member_section_salary_total'] == ""){
                    $second_member_section_salary_total = 0;
                }else{
                    $second_member_section_salary_total = $sub[$i]['second_member_section_salary_total'];
                }      
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $arr[] = array(
                    'sn'=>$sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['class'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['first_member_do_date'],
                    'first_member_salary_section'=> $first_member_section_salary_total,
                    'first_member_section_salary_total'=>$sub[$i]['first_member_section_salary_total'],
                    'supervisor_1'=>$sub[$i]['supervisor_1'],
                    'supervisor_1_unit' => $supervisor1['member_unit'] ,
                    'supervisor_1_phone' => $supervisor1['member_phone'],
                    'second_member_salary_section'=> $second_member_section_salary_total,
                    'second_member_section_salary_total'=>$sub[$i]['second_member_section_salary_total'],
                    'supervisor_2'=>$sub[$i]['supervisor_2'],
                    'supervisor_2_unit' => $supervisor2['member_unit'] ,
                    'supervisor_2_phone' => $supervisor2['member_phone'],
                );
            }
            // print_r($arr);
            return $arr;
        }else{
            return false;
        }
    }    


    public function get_all_salary_trial_total($part = '')
    {
        $this->db->select('*');
       
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        if ($part != '') {
            $this->db->where('voice_area_main.part', $part);
        }
        $this->db->not_like('voice_area_main.field', '29','after');
        $this->db->where("voice_area_main.year",$_SESSION['year']);

        $sub = $this->db->get()->result_array();
        if(!empty($sub)){
            $salary = 0;
            for ($i=0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('voice_import_member')->row_array();
                $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('voice_import_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('voice_patrol_staff')->row_array();
                $course = $this->db->where('year', $_SESSION['year'])->where('field', $sub[$i]['field'])->get('voice_exam_area')->row_array();
                $trial = $this->db->get('voice_trial_staff')->result_array();
                if($sub[$i]['first_member_salary_section'] == ""){
                    $first_member_salary_section = 0;
                }else{
                    $first_member_salary_section = $sub[$i]['first_member_salary_section'];
                }
                if($sub[$i]['second_member_salary_section'] == ""){
                    $second_member_salary_section = 0;
                }else{
                    $second_member_salary_section = $sub[$i]['second_member_salary_section'];
                }            
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $salary += $sub[$i]['first_member_section_salary_total'] + $sub[$i]['second_member_section_salary_total'];
            }
            return $salary;
        }else{
            return false;
        }
    }  

    public function e_6_1_member_count($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('voice_area_main.part', $part);
        }
        $this->db->where("voice_area_main.year",$_SESSION['year']);

        $this->db->where("voice_trial_assign.supervisor_1 != ","");
        $this->db->where("voice_trial_assign.supervisor_2 != ","");        
        $this->db->not_like('voice_area_main.field', '29','after');
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        $year = $this->session->userdata('year');
        
        $sub = $this->db->get()->result_array();
        if(!empty($sub)){

            // print_r($sub);

            for ($i=0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('voice_import_member')->row_array();
                $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('voice_import_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('voice_patrol_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('voice_exam_area')->row_array();
                $trial = $this->db->get('voice_trial_staff')->result_array();
                if($sub[$i]['first_member_salary_section'] == ""){
                    $first_member_salary_section = 0;
                }else{
                    $first_member_salary_section = $sub[$i]['first_member_salary_section'];
                }
                if($sub[$i]['second_member_salary_section'] == ""){
                    $second_member_salary_section = 0;
                }else{
                    $second_member_salary_section = $sub[$i]['second_member_salary_section'];
                }      
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $arr[] = array(
                    'sn'=>$sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['class'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['first_member_do_date'],
                    'first_member_salary_section'=> $sub[$i]['first_member_section_salary_total'] * count($do_date1),
                    'first_member_section_salary_total'=>$sub[$i]['first_member_section_salary_total']*count($do_date1),
                    'supervisor_1'=>$sub[$i]['supervisor_1'],
                    'supervisor_1_unit' => $supervisor1['member_unit'] ,
                    'supervisor_1_phone' => $supervisor1['member_phone'],
                    'second_member_salary_section'=> $sub[$i]['second_member_section_salary_total']*count($do_date2),
                    'second_member_section_salary_total'=>$sub[$i]['second_member_section_salary_total']*count($do_date2),
                    'supervisor_2'=>$sub[$i]['supervisor_2'],
                    'supervisor_2_unit' => $supervisor2['member_unit'] ,
                    'supervisor_2_phone' => $supervisor2['member_phone'],
                );
            }
            // print_r($arr);
            return $arr;
        }else{
            return false;
        }
    }   

    public function get_list_for_obs($part = '', $obs)
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('voice_area_main.part', $part);
        }
        $this->db->like('voice_area_main.field', $obs,'after');
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');

        $res = $this->db->get()->result_array();
        // print_r($res);
        function even($var)
        {
            return($var['year'] == $_SESSION['year']);
            return($var['ladder'] == $_SESSION['ladder']);

        }

        $sub =  array_filter($res, "even");

        sort($sub);

        
        if(!empty($sub)){
            for ($i=0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('voice_import_member')->row_array();
                $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('voice_import_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('voice_patrol_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('voice_exam_area')->row_array();
                $trial = $this->db->get('voice_trial_staff')->result_array();
                if($sub[$i]['first_member_section_salary_total'] == ""){
                    $first_member_section_salary_total = 0;
                }else{
                    $first_member_section_salary_total = $sub[$i]['first_member_section_salary_total'];
                }
                if($sub[$i]['second_member_section_salary_total'] == ""){
                    $second_member_section_salary_total = 0;
                }else{
                    $second_member_section_salary_total = $sub[$i]['second_member_section_salary_total'];
                }               
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $arr[] = array(
                    'sn'=>$sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['class'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['first_member_do_date'],
                    'first_member_salary_section'=> $first_member_section_salary_total,
                    'first_member_section_salary_total'=>$first_member_section_salary_total,
                    'first_member_section_total'=>$sub[$i]['first_member_section_total'],
                    'supervisor_1'=>$sub[$i]['supervisor_1'],
                    'supervisor_1_unit' => $supervisor1['member_unit'] ,
                    'supervisor_1_phone' => $supervisor1['member_phone'],
                    'second_member_salary_section'=> $second_member_section_salary_total,
                    'second_member_section_salary_total'=>$second_member_section_salary_total,
                    'second_member_section_total'=>$sub[$i]['second_member_section_total'],
                    'supervisor_2'=>$sub[$i]['supervisor_2'],
                    'supervisor_2_unit' => $supervisor2['member_unit'] ,
                    'supervisor_2_phone' => $supervisor2['member_phone'],
                    'floor' =>$sub[$i]['floor'],
                    'number'=>$sub[$i]['count_num'],
                    'start'=>$sub[$i]['start'],
                    'end'=>$sub[$i]['end'],
                    'patrol'=>$patrol['patrol_staff_name'],
                    'subject_01'=>$course['subject_01'],
                );
            }
            return $arr;
        }else{
            return false;
        }
        
    }

    public function get_all_salary_trial_total_of_obs($part = '',$obs)
    {
        $this->db->select('*');
        $this->db->like('voice_area_main.field', $obs);
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        if ($part != '') {
            $this->db->where('voice_area_main.part', $part);
        }
        $this->db->where("voice_area_main.year",$_SESSION['year']);
        $this->db->where("voice_area_main.ladder",$_SESSION['ladder']);


        $sub = $this->db->get()->result_array();

        if(!empty($sub)){
            $salary = 0;
            for ($i=0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('voice_import_member')->row_array();
                $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('voice_import_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('voice_patrol_staff')->row_array();
                $course = $this->db->where('year', $_SESSION['year'])->where('field', $sub[$i]['field'])->get('voice_exam_area')->row_array();
                $trial = $this->db->get('voice_trial_staff')->result_array();
                if($sub[$i]['first_member_salary_section'] == ""){
                    $first_member_salary_section = 0;
                }else{
                    $first_member_salary_section = $sub[$i]['first_member_salary_section'];
                }
                if($sub[$i]['second_member_salary_section'] == ""){
                    $second_member_salary_section = 0;
                }else{
                    $second_member_salary_section = $sub[$i]['second_member_salary_section'];
                }            
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $salary += $sub[$i]['first_member_section_salary_total'] + $sub[$i]['second_member_section_salary_total'];
            }
            return $salary;
        }else{
            return false;
        }
    } 
    
    
    public function get_list_for_obs_member_count($part = '', $obs)
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('voice_area_main.part', $part);
        }
        $this->db->where('voice_area_main.year',$_SESSION['year']);
        $this->db->where('voice_trial_assign.supervisor_1 !=',"");
        $this->db->where('voice_trial_assign.supervisor_2 !=',"");
        $this->db->like('voice_area_main.field', $obs);
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        $year = $this->session->userdata('year');

        $sub = $this->db->get()->result_array();
        if(!empty($sub)){
            return $sub;
        }else{
            return false;
        }
    }    

    public function get_trial_staff_task_money_list($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('voice_trial_staff')->result_array();
        if (!empty($res)) {
            for ($i=0; $i < count($res); $i++) {
                $do_date = explode(",", $res[$i]['do_date']);
                # code...
                $arr[] = array(
                    'job'=> '分區管卷人員',
                    'name'=>$res[$i]['trial_staff_name'],
                    'one_day_salary'=>$res[$i]['salary'],
                    'salary_total'=>$res[$i]['salary_total'],
                    'total'=>$res[$i]['total'],
                );

            }
            
            return $arr;
        }else{
            return false;
        }
    }   


    public function get_trial_staff_salary_total($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('voice_trial_staff')->result_array();
        $salary = 0;
        if (!empty($res)) {
            for ($i=0; $i < count($res); $i++) {
                $do_date = explode(",", $res[$i]['do_date']);
                # code...
                $arr[] = array(
                    'job'=> '分區管卷人員',
                    'name'=>$res[$i]['trial_staff_name'],
                    'one_day_salary'=>$res[$i]['salary'],
                    'salary_total'=>$res[$i]['salary_total'],
                    'total'=>$res[$i]['total'],
                );

                $salary += $res[$i]['salary_total']; 

            }
            
            return $salary;
        }else{
            return false;
        }
    }     
    
    public function get_trial_staff_task_member_count($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('voice_trial_staff')->result_array();
        if (!empty($res)) {            
            return $res;
        }else{
            return false;
        }
    }       

    public function get_patrol_staff_task_money_list($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('voice_patrol_staff')->result_array();
        // print_r($res);
        if (!empty($res)) {
            for ($i=0; $i < count($res); $i++) {
                $do_date = explode(",", $res[$i]['do_date']);
                # code...
                $arr[] = array(
                    'job'=> '分區巡場人員',
                    'name'=>$res[$i]['patrol_staff_name'],
                    'one_day_salary'=>$res[$i]['salary'],
                    'salary_total'=>$res[$i]['salary_total'],
                    'total'=>$res[$i]['total'],
                );

            }
            
            return $arr;
        }else{
            return false;
        }
    }    

     
    public function get_patrol_staff_salary_total($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('voice_patrol_staff')->result_array();
        if (!empty($res)) {
            $salary = 0;
            for ($i=0; $i < count($res); $i++) {
                $do_date = explode(",", $res[$i]['do_date']);

                $salary += $res[$i]['salary_total'];

            }
            
            return $salary;
        }else{
            return false;
        }
    }        

    public function get_patrol_staff_task_member_count($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('voice_patrol_staff')->result_array();
        // print_r($res);
        if (!empty($res)) {
            return $res;
        }else{
            return false;
        }
    }   


    public function get_trial_moneylist_for_csv($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('voice_area_main.part', $part);
        }
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        
        // $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');

        $res = $this->db->get()->result_array();
        if(!empty($res)){
            function even($var)
            {
                return($var['year'] == $_SESSION['year']);
                return($var['ladder'] == $_SESSION['ladder']);

            }

            $sub =  array_filter($res, "even");

            sort($sub);


            for ($i=0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('voice_import_member')->row_array();
                $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('voice_import_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('voice_patrol_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('voice_exam_area')->row_array();
                $trial = $this->db->get('voice_trial_staff')->result_array();
                if($sub[$i]['first_member_section_salary_total'] == ""){
                    $first_member_salary_section = 0;
                }else{
                    $first_member_salary_section = $sub[$i]['first_member_section_salary_total'];
                }
                if($sub[$i]['second_member_section_salary_total'] == ""){
                    $second_member_salary_section = 0;
                }else{
                    $second_member_salary_section = $sub[$i]['second_member_section_salary_total'];
                }            
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $arr[] = array(
                    'sn'=>$sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['class'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['first_member_do_date'],
                    'salary_section'=> $first_member_salary_section,
                    'section_salary_total'=>$sub[$i]['first_member_section_total'],
                    'supervisor'=>$sub[$i]['supervisor_1'],
                );
                $arr[] = array(
                    'sn'=>$sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['class'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['second_member_do_date'],
                    'salary_section'=>$second_member_salary_section,
                    'section_salary_total'=>$sub[$i]['second_member_section_total'],
                    'supervisor'=>$sub[$i]['supervisor_2'],
                ); 
            }
            return $arr;
        }else{
            return false;
        }
    }    

    public function chk_part_list_of_obs($part, $area, $obs)
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('voice_area_main.part', $part);
        }
        $this->db->like('voice_area_main.field', $obs);

        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');

        $res = $this->db->get()->result_array();
        // print_r($res);


        function even($var)
        {
            return($var['year'] == $_SESSION['year']);
            return($var['ladder'] == $_SESSION['ladder']);
            
        }

        $sub =  array_filter($res, "even");

        sort($sub);


        if (!empty($sub)) {
            return true;
        } else {
            return false;
        }
    }




}
?>