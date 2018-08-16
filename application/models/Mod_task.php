<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_task extends CI_Model
{
    public function import($area)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('area', '考區');
        $this->db->delete('district_task');
        $this->db->insert_batch('district_task', $area);
    }

    public function import_1($area_1)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('area', '第一分區');
        $this->db->delete('district_task');
        $this->db->insert_batch('district_task', $area_1);
    }

    public function import_2($area_2)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('area', '第二分區');
        $this->db->delete('district_task');
        $this->db->insert_batch('district_task', $area_2);
    }

    public function import_3($area_3)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('area', '第三分區');
        $this->db->delete('district_task');
        $this->db->insert_batch('district_task', $area_3);
    }

    /**
     * 取得職務列表.
     */
    public function get_job_list($year, $area)
    {
        $this->db->where('year', $year);
        $this->db->where('area', $area);
        $this->db->select('job');

        return $this->db->get('district_task')->result_array();
    }

    public function chk_once($job_code)
    {
        $this->db->where('job_code', $job_code);
        if ($this->db->count_all_results('district_task') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function chk_patrol($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('district_task') == 0) {
            return false;
        } else {
            return true;
        }
    }    

    public function chk_staff($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('district_task') == 0) {
            return false;
        } else {
            return true;
        }
    }        

    public function chk_job_code($job_code)
    {
        $this->db->where('job_code', $job_code);
        if ($this->db->count_all_results('district_task') == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 檢查職務.
     */
    public function chk_job($job, $area)
    {
        $this->db->where('job', $job);
        $this->db->where('area', $area);
        if ($this->db->count_all_results('district_task') == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 建立新職務.
     */
    public function add_job($year, $job, $area, $trial_start, $trial_end)
    {
        $data = array(
            'year' => $year,
            'job' => $job,
            'area' => $area,
            'trial_start' => $trial_start,
            'trial_end' => $trial_end,
        );
        $this->db->insert('district_task', $data);
    }

    public function get_list($area = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($area != '') {
            $this->db->where('area', $area);
        }
        $this->db->order_by('sn', 'asc');

        return $this->db->get('district_task')->result_array();
    }

    public function e_2_1_pdf($area = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($area != '') {
            $this->db->where('area', $area);
        }

        $this->db->where('job_code !=', "");

        $res = $this->db->get('district_task')->result_array();

        if (!empty($res)) {
            for ($i=0; $i < count($res); $i++) {
                # code...
                $member_unit = $this->db->where('member_code', $res[$i]['job_code'])->get('staff_member')->row_array();
                $arr[] = array(
                        'job_code' => $res[$i]['job_code'],
                        'job' => $res[$i]['job'],
                        'job_title' => $res[$i]['job_title'],
                        'name' => $res[$i]['name'],
                        'member_unit'=>$member_unit['member_unit'],
                        'meal' => $member_unit['meal']
                    );
            }
            return $arr;
        }
    }

    public function e_2_1($area = '',$part)
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($area != '') {
            $this->db->where('area', $area);
        }

        $this->db->where('job_code !=', "");

        $res = $this->db->get('district_task')->result_array();
        if (!empty($res)) {
            for ($i=0; $i < count($res); $i++) {
                # code...
                $member = $this->db->where('member_code', $res[$i]['job_code'])->get('staff_member')->row_array();
                // $trial = $this->db->where('part',$part)->where('year',$_SESSION['year'])->get('trial_staff')->row_array();
                $do_date = explode(",", $res[$i]['do_date']);
                for ($d=0; $d < count($do_date); $d++) {

                    $arr[$do_date[$d]][] = array(
                        'job_code' => $res[$i]['job_code'],
                        'job' => $res[$i]['job'],
                        'job_title' => $res[$i]['job_title'],
                        'name' => $res[$i]['name'],
                        'member_unit'=>$member['member_unit'],
                        'meal' => $res[$i]['meal'],
                        'note' => $res[$i]['note'],
                    );
                }
            }

            return $arr;
        }else{
            return false;
        }
    }  

    public function get_task_own_count($area = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($area != '') {
            $this->db->where('area', $area);
        }

        $this->db->where('job_code !=', "");

        $res = $this->db->get('district_task')->result_array();
        $own = 0;
        for ($i=0; $i < count($res); $i++) {
            # code...
                            if($res[$i]['meal'] == "自備"){
                    $own += 1;
                }
            $do_date = explode(",", $res[$i]['do_date']);
            for ($d=0; $d < count($do_date); $d++) {

                $arr[$do_date[$d]][] = array(
                    'own' => $own,
                );
            }
        }

        // print_r($arr);
        return $own;
    }  

    public function get_district_task($area = '',$part)
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($area != '') {
            $this->db->where('area', $area);
        }

        $this->db->where('job_code !=', "");

        $res = $this->db->get('district_task')->result_array();
        if (!empty($res)) {
            for ($i=0; $i < count($res); $i++) {
                # code...
                $member = $this->db->where('member_code', $res[$i]['job_code'])->get('staff_member')->row_array();
                    $arr[] = array(
                        'job_code' => $res[$i]['job_code'],
                        'job' => $res[$i]['job'],
                        'job_title' => $res[$i]['job_title'],
                        'name' => $res[$i]['name'],
                        'member_unit'=>$member['member_unit'],
                        'meal' => $res[$i]['meal'],
                        'note' => $res[$i]['note'],
                    );
            }

            return $arr;
        }else{
            return false;
        }
    }      

    public function get_district_task_csv()
    {
        $this->db->where('year', $this->session->userdata('year'));

        $this->db->where('job_code !=', "");

        $res = $this->db->get('district_task')->result_array();


        for ($i=0; $i < count($res); $i++) {
                # code...
            $member = $this->db->where('member_code', $res[$i]['job_code'])->get('staff_member')->row_array();
            $arr[] = array(
                'job_code' => $res[$i]['job_code'],
                'job' => $res[$i]['job'],
                'job_title' => $res[$i]['job_title'],
                'name' => $res[$i]['name'],
                'member_unit'=>$member['member_unit'],
                'meal' => $res[$i]['meal'],
                'note' => $res[$i]['note'],
            );
        }

        return $arr;

    }      

    public function chk_task_list($area = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($area != '') {
            $this->db->where('area', $area);
        }

        $res = $this->db->get('district_task')->result_array();
        if (!empty($res)) {
            return true;
        } else {
            return false;
        }
    }      

    public function get_trial_staff_list_for_pdf($area = '',$part = ''){
        //取出管卷人員
        $this->db->where('year', $this->session->userdata('year'));
        if($part != ''){
            $this->db->where('part',$part);
        }
        $res = $this->db->get('trial_staff')->result_array();  
        if (!empty($res)) {
            for ($i=0; $i < count($res); $i++) {
                # code...
                $member = $this->db->where('member_code', $res[$i]['trial_staff_code'])->get('staff_member')->row_array();
                    $arr[] = array(
                        'job_code' => $res[$i]['trial_staff_code'],
                        'job' => '分區管卷人員',
                        'job_title' => $member['member_title'],
                        'name' => $res[$i]['trial_staff_name'],
                        'member_unit'=>$member['member_unit'],
                        'meal' => $res[$i]['meal'],
                        'note' => $res[$i]['note'],
                    );
            }

            return $arr;
        }else{
            return false;
        }        
    }

    public function get_patrol_staff_list_for_pdf($area = '',$part = ''){
        //取出巡場人員
        $this->db->where('year', $this->session->userdata('year'));
        if($part != ''){
            $this->db->where('part',$part);
        }
        $res = $this->db->get('patrol_staff')->result_array();  
        if (!empty($res)) {
            for ($i=0; $i < count($res); $i++) {
                # code...
                $member = $this->db->where('member_code', $res[$i]['patrol_staff_code'])->get('staff_member')->row_array();
                    $arr[] = array(
                        'job_code' => $res[$i]['patrol_staff_code'],
                        'job' => '分區巡場人員',
                        'job_title' => $member['member_title'],
                        'name' => $res[$i]['patrol_staff_name'],
                        'member_unit'=>$member['member_unit'],
                        'meal' => $res[$i]['meal'],
                        'note' => $res[$i]['note'],
                    );
            }

            return $arr;
        }else{
            return false;
        }        
    }    
    
    public function get_member_own_count($area = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($area != '') {
            $this->db->where('area', $area);
        }

        $this->db->where('job_code !=', "");

        $res = $this->db->get('district_task')->result_array();
        if (!empty($res)) {
            $own_count = 0;
            for ($i=0; $i < count($res); $i++) {
                # code...
                $member = $this->db->where('member_code', $res[$i]['job_code'])->get('staff_member')->row_array();
                $do_date = explode(",", $res[$i]['do_date']);
                    # code...
                for ($d=0; $d < count($do_date); $d++) { 
                    # code...
                    $this->db->where('meal','自備');
                    $member = $this->db->where('job_code', $res[$i]['job_code'])->get('district_task')->row_array();
                    $own_count += count($member['meal']);
                }
            }
            return $own_count;
        }else{
            return false;
        }
    }      

    public function get_member_veg_count($area = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($area != '') {
            $this->db->where('area', $area);
        }

        $this->db->where('job_code !=', "");

        $res = $this->db->get('district_task')->result_array();
        if (!empty($res)) {
            $veg_count = 0;
            for ($i=0; $i < count($res); $i++) {
                # code...
                $member = $this->db->where('member_code', $res[$i]['job_code'])->get('staff_member')->row_array();
                $this->db->where('member_code', $res[$i]['job_code']);
                $this->db->where('meal', '素');
                $veg = $this->db->get('staff_member')->row_array();
                $veg_count += count($veg['meal']);

            }
            return $veg_count;
        }else{
            return false;
        }
    }       
    
    public function get_member_meat_count($area = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($area != '') {
            $this->db->where('area', $area);
        }

        $this->db->where('job_code !=', "");

        $res = $this->db->get('district_task')->result_array();
        if (!empty($res)) {
            $meat_count = 0;
            for ($i=0; $i < count($res); $i++) {
                # code...
                $member = $this->db->where('member_code', $res[$i]['job_code'])->get('staff_member')->row_array();
                $this->db->where('member_code', $res[$i]['job_code']);
                $this->db->where('meal', '葷');
                $meat = $this->db->get('staff_member')->row_array();
                $meat_count += count($meat['meal']);

            }
            return $meat_count;
        }else{
            return false;
        }
    }        
    
    public function get_district_task_money_list($area = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($area != '') {
            $this->db->where('area', $area);
        }

        $this->db->where('job_code !=', "");

        $res = $this->db->get('district_task')->result_array();

        if (!empty($res)) {
            for ($i=0; $i < count($res); $i++) {
                # code...
                $arr[] = array(
                    'job'=>$res[$i]['job'],
                    'name'=>$res[$i]['name'],
                    'one_day_salary'=>$res[$i]['one_day_salary'],
                    'salary_total'=>$res[$i]['salary_total'],
                    'lunch_price'=>$res[$i]['lunch_price'],
                    'lunch_total'=>$res[$i]['lunch_total'],
                    'total'=>$res[$i]['total'],
                    'order_meal'=>$res[$i]['order_meal']
                );

            }
            return $arr;
        }else{
            return false;
        }
    }           

    public function get_sign_list($area = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($area != '') {
            $this->db->where('area', $area);
        }

        $this->db->where('job_code !=', "");
        $res = $this->db->get('district_task')->result_array();

        //取出監試人員
        $this->db->select('*');
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        $this->db->where("part_info.year",$_SESSION['year']);
        $year = $this->session->userdata('year');
        $sub = $this->db->get()->result_array();

        //取出管卷人員
        $this->db->where('year', $this->session->userdata('year'));
        $trial_staff = $this->db->get('trial_staff')->result_array();    
        
        //取出巡場人員
        $this->db->where('year', $this->session->userdata('year'));

        $patrol = $this->db->get('patrol_staff')->result_array();        

        if (!empty($res)) {
            for ($i=0; $i < count($res); $i++) {
                # code...
                $member = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $res[$i]['job_code'])->get('staff_member')->result_array();

                for ($m=0; $m < count($member); $m++) { 
                    # code...
                    $unit = $this->db->where('year', $this->session->userdata('year'))->where('unit', $member[$m]['unit'])->where('member_code',$member[$m]['member_code'])->get('staff_member')->row_array();
                    $arr[$unit['unit']][] = array(
                        'member_code'=>$member[$m]['member_code'],
                        'member_name'=>$member[$m]['member_name'],
                        'member_unit'=>$member[$m]['member_unit'],
                        'job'=>$res[$i]['job'],
                    );
                }
            }

            for ($i=0; $i < count($sub); $i++) {
                # code...
                $member = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('staff_member')->row_array();

                $unit = $this->db->where('year', $this->session->userdata('year'))->where('unit', $member['unit'])->where('member_code',$member['member_code'])->get('staff_member')->row_array();
                $arr[$unit['unit']][] = array(
                    'member_code'=>$member['member_code'],
                    'member_name'=>$member['member_name'],
                    'member_unit'=>$member['member_unit'],
                    'job'=>'監試人員1',
                );        
            }        

            for ($i=0; $i < count($sub); $i++) {
                # code...
                $member = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('staff_member')->row_array();

                $unit = $this->db->where('year', $this->session->userdata('year'))->where('unit', $member['unit'])->where('member_code',$member['member_code'])->get('staff_member')->row_array();
                $arr[$unit['unit']][] = array(
                    'member_code'=>$member['member_code'],
                    'member_name'=>$member['member_name'],
                    'member_unit'=>$member['member_unit'],
                    'job'=>'監試人員2',
                );  
            }      
            
            for ($i=0; $i < count($trial_staff); $i++) {
                # code...
                $member = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $trial_staff[$i]['trial_staff_code'])->get('staff_member')->row_array();
                $unit = $this->db->where('year', $this->session->userdata('year'))->where('unit', $member['unit'])->where('member_code',$member['member_code'])->get('staff_member')->row_array();
                $arr[$unit['unit']][] = array(
                    'member_code'=>$member['member_code'],
                    'member_name'=>$member['member_name'],
                    'member_unit'=>$member['member_unit'],
                    'job'=>'管卷人員',
                );   
            }        
            
            for ($i=0; $i < count($patrol); $i++) {
                # code...
                $member = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $patrol[$i]['patrol_staff_code'])->get('staff_member')->row_array();

                $unit = $this->db->where('year', $this->session->userdata('year'))->where('unit', $member['unit'])->where('member_code',$member['member_code'])->get('staff_member')->row_array();
                $arr[$unit['unit']][] = array(
                    'member_code'=>$member['member_code'],
                    'member_name'=>$member['member_name'],
                    'member_unit'=>$member['member_unit'],
                    'job'=>'巡場人員',
                );   
            }                  
            return $arr;
        }else{
            return false;
        }
    }    

    public function get_list_for_csv()
    {
        $this->db->where('year', $_SESSION['year']);
        $this->db->where('job_code !=', "");

        $res = $this->db->get('district_task')->result_array();
        if (!empty($res)) {
            for ($i=0; $i < count($res); $i++) {
                # code...
                $member_unit = $this->db->where('member_code', $res[$i]['job_code'])->get('staff_member')->row_array();
                $arr[] = array(
                        'year'=>$res[$i]['year'],
                        'area' =>$res[$i]['area'],
                        'job_code' => $res[$i]['job_code'],
                        'job' => $res[$i]['job'],
                        'job_title' => $res[$i]['job_title'],
                        'name' => $res[$i]['name'],
                        'member_unit'=>$member_unit['member_unit'],
                        'do_date'=>$res[$i]['do_date']
                    );
            }
            return $arr;
        }
    }    


    public function get_list_for_pdf()
    {
        $this->db->where('year', $this->session->userdata('year'));

        $res = $this->db->get('district_task')->result_array();

        

        for ($i=0; $i < count($res); $i++) {
            # code...
            $member_unit = $this->db->where('member_code', $res[$i]['job_code'])->select('member_unit')->get('staff_member')->row_array();
            if ($res[$i]['job_code'] != "") {
                $arr[] = array(
                    'job_code' => $res[$i]['job_code'],
                    'name' => $res[$i]['name'],
                    'job_title' => $res[$i]['job_title'],
                    'member_unit'=>$member_unit['member_unit'],
                    'do_date' => $res[$i]['do_date']
                );
            }
        }
        return $arr;
    }

    public function get_all_assign_member_list()
    {
        //取出試務人員
        $this->db->where('year', $this->session->userdata('year'));
        $res = $this->db->get('district_task')->result_array();

        //取出監試人員
        $this->db->select('*');
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        $this->db->where("part_info.year",$_SESSION['year']);
        $year = $this->session->userdata('year');
        $sub = $this->db->get()->result_array();

        //取出管卷人員
        $this->db->where('year', $this->session->userdata('year'));
        $trial_staff = $this->db->get('trial_staff')->result_array();    
        
        //取出巡場人員
        $this->db->where('year', $this->session->userdata('year'));

        $patrol = $this->db->get('patrol_staff')->result_array();

        for ($i=0; $i < count($res); $i++) {
            # code...
            $member_unit = $this->db->where('member_code', $res[$i]['job_code'])->select('member_unit')->get('staff_member')->row_array();
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
            $supervisor_1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('staff_member')->row_array();
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
            $supervisor_2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('staff_member')->row_array();
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
            $trial_staff_member = $this->db->where('member_code', $trial_staff[$i]['trial_staff_code'])->get('staff_member')->row_array();
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
            $patrol_member = $this->db->where('member_code', $patrol[$i]['patrol_staff_code'])->get('staff_member')->row_array();
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



    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('district_task')->row_array();
    }

    public function get_part_for_once($part)
    {
        return $this->db->where('area', $part)->get('district_task')->row_array();
    }

    public function add_once($data)
    {
        $data['year'] = $this->session->userdata('year');
        $this->db->insert('district_task', $data);

        return true;
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('district_task', $data);

        return true;
    }

    public function update_job($sn, $sql_data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('district_task', $sql_data);

        return true;
    }

    public function remove_once($sn)
    {
        $this->db->where('sn', $sn);
        $this->db->delete('district_task');

        return true;
    }

    // 取得所有試場
    public function get_field()
    {
        $this->db->select('field');

        return $this->db->get('exam_area')->result_array();
    }

    // 取得姓名
    public function get_member_info()
    {
        $this->db->distinct();
        $this->db->select('member_code,member_name');

        $data = $this->db->get('staff_member')->result_array();
        // echo $this->db->last_query();
        return $data;
    }

    // 用代號取得完整資料
    public function get_once_info($job_code)
    {
        $this->db->where('member_code', $job_code);

        return $this->db->get('staff_member')->row_array();
    }
}

/* End of file Mod_exam_area.php */
