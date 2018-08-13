<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_trial extends CI_Model
{
    public function import($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('trial_assign');
        $this->db->insert_batch('trial_assign', $datas);
    }

    public function import_trial($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('trial_staff');
        $this->db->insert_batch('trial_staff', $datas);
    }

    public function year_get_list()
    {
        return $this->db->where('year', $this->session->userdata('year'))->get('trial_assign')->result_array();
    }

    public function chk_once($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('trial_assign') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function chk_trial($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('trial_staff') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_list($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        return $this->db->get()->result_array();
    }

    public function chk_part_list($part, $area)
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        
        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

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

    public function chk_part_list_of_obs($part, $area, $obs)
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->like('part', $obs, 'after');

        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        
        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

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

    public function get_list_for_pdf($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        
        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();

        function even($var)
        {
            return($var['year'] == $_SESSION['year']);
        }

        $sub =  array_filter($res, "even");

        sort($sub);


        for ($i=0; $i < count($sub); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('staff_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('staff_member')->row_array();
            $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('patrol_staff')->row_array();
            $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('exam_area')->row_array();
            $trial = $this->db->get('trial_staff')->result_array();

            $arr[] = array(
                'sn'=>$sub[$i]['sn'],
                'field' => $sub[$i]['field'],
                'test_section' => $sub[$i]['test_section'],
                'part' => $sub[$i]['part'],
                'do_date' => $sub[$i]['first_member_do_date'],
                'first_member_salary_section'=>$sub[$i]['first_member_salary_section'],
                'first_member_section_lunch_total'=>$sub[$i]['first_member_section_lunch_total'],
                'first_member_section_salary_total'=>$sub[$i]['first_member_section_salary_total'],
                'order_meal1'=>$supervisor1['order_meal'],
                'supervisor_1'=>$sub[$i]['supervisor_1'],
                'supervisor_1_unit' => $supervisor1['member_unit'] ,
                'supervisor_1_phone' => $supervisor1['member_phone'],
                'second_member_salary_section'=>$sub[$i]['second_member_salary_section'],
                'second_member_section_lunch_total'=>$sub[$i]['second_member_section_lunch_total'],
                'second_member_section_salary_total'=>$sub[$i]['second_member_section_salary_total'],
                'supervisor_2'=>$sub[$i]['supervisor_2'],
                'supervisor_2_unit' => $supervisor2['member_unit'] ,
                'supervisor_2_phone' => $supervisor2['member_phone'],
                'order_meal2'=>$supervisor2['order_meal'],
                'floor' =>$sub[$i]['floor'],
                'number'=>$sub[$i]['number'],
                'start'=>$sub[$i]['start'],
                'end'=>$sub[$i]['end'],
                'allocation_code'=>$patrol['allocation_code'],
                'patrol'=>$patrol['patrol_staff_name'],
                'subject_01'=>$course['subject_01'],
                'subject_02'=>$course['subject_02'],
                'subject_03'=>$course['subject_03'],
                'subject_04'=>$course['subject_04'],
                'subject_05'=>$course['subject_05'],
                'subject_06'=>$course['subject_06'],
                'subject_07'=>$course['subject_07'],
                'subject_08'=>$course['subject_08'],
                'subject_09'=>$course['subject_09'],
                'subject_10'=>$course['subject_10'],
            );
        }
        return $arr;
    }

    public function get_list_for_voucher($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        
        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();

        function even($var)
        {
            return($var['year'] == $_SESSION['year']);
        }

        $sub =  array_filter($res, "even");

        sort($sub);

        for ($i=0; $i < count($sub); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('staff_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('staff_member')->row_array();
            $voucher = $this->db->where('part', $part)->where('first_start <=', $sub[$i]['start'])->where('first_end >=', $sub[$i]['end'])->get('trial_staff')->row_array();
            $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('exam_area')->row_array();
            $trial = $this->db->get('trial_staff')->result_array();


            $arr[$voucher['trial_staff_name']] = array(
                'sn'=>$sub[$i]['sn'],
                'field' => $sub[$i]['field'],
                'test_section' => $sub[$i]['test_section'],
                'part' => $sub[$i]['part'],
                'supervisor_1'=>$sub[$i]['supervisor_1'],
                'supervisor_2'=>$sub[$i]['supervisor_2'],
                'subject_01'=>$course['subject_01'],
                'subject_02'=>$course['subject_02'],
                'subject_03'=>$course['subject_03'],
                'subject_04'=>$course['subject_04'],
                'subject_05'=>$course['subject_05'],
                'subject_06'=>$course['subject_06'],
                'subject_07'=>$course['subject_07'],
                'subject_08'=>$course['subject_08'],
                'subject_09'=>$course['subject_09'],
                'subject_10'=>$course['subject_10'],
            );
        }
        return $arr;
    }

    //按照日期取的監試人員資料
    public function get_date_for_trial_list($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        
        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();

        function even($var)
        {
            return($var['year'] == $_SESSION['year']);
        }

        $sub =  array_filter($res, "even");

        sort($sub);

    

        if (!empty($sub)) {
            for ($i=0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('staff_member')->row_array();
                $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('staff_member')->row_array();
                
                $do_date = explode("、", $sub[$i]['first_member_do_date']);
                # code...
                if (strtoupper($sub[$i]['first_member_order_meal']) == "Y") {
                    $first_member_meal = $supervisor1['meal'];
                } else {
                    $first_member_meal = "";
                }

                if (strtoupper($sub[$i]['second_member_order_meal']) == "Y") {
                    $second_member_meal = $supervisor2['meal'];
                } else {
                    $second_member_meal = "";
                }
    
                for ($d=0; $d < count($do_date); $d++) {
                    $arr[$do_date[$d]][] = array(
                        'sn'=>$sub[$i]['sn'],
                        'field' => $sub[$i]['field'],
                        'test_section' => $sub[$i]['test_section'],
                        'part' => $sub[$i]['part'],
                        'order_meal1'=>$supervisor1['order_meal'],
                        'meal1'=>$first_member_meal,
                        'supervisor_1'=>$sub[$i]['supervisor_1'],
                        'supervisor_1_unit' => $supervisor1['member_unit'] ,
                        'supervisor_1_phone' => $supervisor1['member_phone'],
                        'meal2'=>$second_member_meal,
                        'supervisor_2'=>$sub[$i]['supervisor_2'],
                        'supervisor_2_unit' => $supervisor2['member_unit'] ,
                        'supervisor_2_phone' => $supervisor2['member_phone'],
                        'order_meal2'=>$supervisor2['order_meal'],
                        'floor' =>$sub[$i]['floor'],
                        'number'=>$sub[$i]['number'],
                        'start'=>$sub[$i]['start'],
                        'end'=>$sub[$i]['end'],
                    );
                }
            }
            // print_r($arr);
            return $arr;
        } else {
            return false;
        }
    }
    
    public function odd($var)
    {
        return($var['year'] == $_SESSION['year']);
    }

    public function get_trial_member_own_count($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        
        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();

        function odd($var)
        {
            return($var['year'] == $_SESSION['year']);
        }

        $sub =  array_filter($res, "odd");

        sort($sub);
        $own = 0;
        for ($i=0; $i < count($sub); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('staff_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('staff_member')->row_array();

            if (strtoupper($sub[$i]['first_member_order_meal']) == "Y") {
                //取的自備午餐人數
                $this->db->where('member_code', $sub[$i]['supervisor_1_code']);
                $this->db->where('meal', '自備');
                $own1 =$this->db->get('staff_member')->row_array();
            }

            if (strtoupper($sub[$i]['second_member_order_meal']) == "Y") {
                $this->db->where('member_code', $sub[$i]['supervisor_2_code']);
                $this->db->where('meal', '自備');
                $own2 =$this->db->get('staff_member')->row_array();
            }

            $own += count($own1['meal']) + count($own2['meal']);
        }
        return $own;
    }

    public function get_trial_member_veg_count($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();
        $veg = 0;
        for ($i=0; $i < count($res); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $res[$i]['supervisor_1_code'])->get('staff_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $res[$i]['supervisor_2_code'])->get('staff_member')->row_array();

            //取的自備午餐人數
            $this->db->where('member_code', $res[$i]['supervisor_1_code']);
            $this->db->where('meal', '素');
            $veg1 =$this->db->get('staff_member')->row_array();
            $this->db->where('member_code', $res[$i]['supervisor_2_code']);
            $this->db->where('meal', '素');
            $veg2 =$this->db->get('staff_member')->row_array();
            
            $veg += count($veg1['meal']) + count($veg2['meal']);
        }
        return $veg;
    }


    public function get_trial_member_meat_count($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        
        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();


        $sub =  array_filter($res, "odd");

        sort($sub);

        $meat = 0;
        for ($i=0; $i < count($res); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $res[$i]['supervisor_1_code'])->get('staff_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $res[$i]['supervisor_2_code'])->get('staff_member')->row_array();

            //取的自備午餐人數
            $this->db->where('member_code', $res[$i]['supervisor_1_code']);
            $this->db->where('meal', '葷');
            $meat1 =$this->db->get('staff_member')->row_array();
            $this->db->where('member_code', $res[$i]['supervisor_2_code']);
            $this->db->where('meal', '葷');
            $meat2 =$this->db->get('staff_member')->row_array();
            
            $meat += count($meat1['meal']) + count($meat2['meal']);
        }
        return $meat;
    }

    public function get_patrol_member_count($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        
        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();

        function odd($var)
        {
            return($var['year'] == $_SESSION['year']);
        }

        $sub =  array_filter($res, "odd");

        sort($sub);

        for ($i=0; $i < count($sub); $i++) {
            $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('patrol_staff')->row_array();
        }
        return count($patrol['patrol_staff_name']);
    }

    public function get_supervisor_list($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        
        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();

        function even($var)
        {
            return($var['year'] == $_SESSION['year']);
        }

        $sub =  array_filter($res, "even");

        sort($sub);


        for ($i=0; $i < count($sub); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('staff_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('staff_member')->row_array();
            $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('patrol_staff')->row_array();
            $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('exam_area')->row_array();
            $trial = $this->db->get('trial_staff')->result_array();

            $arr[] = array(
                'sn'=>$sub[$i]['sn'],
                'field' => $sub[$i]['field'],
                'test_section' => $sub[$i]['test_section'],
                'part' => $sub[$i]['part'],
                'do_date' => $sub[$i]['first_member_do_date'],
                'order_meal1'=>$supervisor1['order_meal'],
                'supervisor'=>$sub[$i]['supervisor_1'],
                'floor' =>$sub[$i]['floor'],
                'number'=>$sub[$i]['number'],
                'start'=>$sub[$i]['start'],
                'end'=>$sub[$i]['end'],
                'patrol'=>$patrol['patrol_staff_name'],
                'subject_01'=>$course['subject_01'],
                'subject_02'=>$course['subject_02'],
                'subject_03'=>$course['subject_03'],
                'subject_04'=>$course['subject_04'],
                'subject_05'=>$course['subject_05'],
                'subject_06'=>$course['subject_06'],
                'subject_07'=>$course['subject_07'],
                'subject_08'=>$course['subject_08'],
                'subject_09'=>$course['subject_09'],
                'subject_10'=>$course['subject_10'],
            );

            $arr[] = array(
                'sn'=>$sub[$i]['sn'],
                'field' => $sub[$i]['field'],
                'test_section' => $sub[$i]['test_section'],
                'part' => $sub[$i]['part'],
                'do_date' => $sub[$i]['second_member_do_date'],
                'order_meal1'=>$supervisor1['order_meal'],
                'supervisor'=>$sub[$i]['supervisor_2'],
                'floor' =>$sub[$i]['floor'],
                'number'=>$sub[$i]['number'],
                'start'=>$sub[$i]['start'],
                'end'=>$sub[$i]['end'],
                'patrol'=>$patrol['patrol_staff_name'],
                'subject_01'=>$course['subject_01'],
                'subject_02'=>$course['subject_02'],
                'subject_03'=>$course['subject_03'],
                'subject_04'=>$course['subject_04'],
                'subject_05'=>$course['subject_05'],
                'subject_06'=>$course['subject_06'],
                'subject_07'=>$course['subject_07'],
                'subject_08'=>$course['subject_08'],
                'subject_09'=>$course['subject_09'],
                'subject_10'=>$course['subject_10'],
            );
        }
        return $arr;
    }

    public function get_list_for_obs($part = '', $obs)
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->like('part', $obs, 'after');
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        
        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();

        function even($var)
        {
            return($var['year'] == $_SESSION['year']);
        }

        $sub =  array_filter($res, "even");

        sort($sub);


        for ($i=0; $i < count($sub); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('staff_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('staff_member')->row_array();
            $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('patrol_staff')->row_array();
            $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('exam_area')->row_array();
            $trial = $this->db->get('trial_staff')->result_array();

            $arr[] = array(
                'sn'=>$sub[$i]['sn'],
                'field' => $sub[$i]['field'],
                'test_section' => $sub[$i]['test_section'],
                'part' => $sub[$i]['part'],
                'do_date' => $sub[$i]['first_member_do_date'],
                'first_member_salary_section'=>$sub[$i]['first_member_salary_section'],
                'first_member_section_lunch_total'=>$sub[$i]['first_member_section_lunch_total'],
                'first_member_section_salary_total'=>$sub[$i]['first_member_section_salary_total'],
                'order_meal1'=>$supervisor1['order_meal'],
                'supervisor_1'=>$sub[$i]['supervisor_1'],
                'supervisor_1_unit' => $supervisor1['member_unit'] ,
                'supervisor_1_phone' => $supervisor1['member_phone'],
                'second_member_salary_section'=>$sub[$i]['second_member_salary_section'],
                'second_member_section_lunch_total'=>$sub[$i]['second_member_section_lunch_total'],
                'second_member_section_salary_total'=>$sub[$i]['second_member_section_salary_total'],
                'supervisor_2'=>$sub[$i]['supervisor_2'],
                'supervisor_2_unit' => $supervisor2['member_unit'] ,
                'supervisor_2_phone' => $supervisor2['member_phone'],
                'order_meal2'=>$supervisor2['order_meal'],
                'floor' =>$sub[$i]['floor'],
                'number'=>$sub[$i]['number'],
                'start'=>$sub[$i]['start'],
                'end'=>$sub[$i]['end'],
                'patrol'=>$patrol['patrol_staff_name'],
                'subject_01'=>$course['subject_01'],
                'subject_02'=>$course['subject_02'],
                'subject_03'=>$course['subject_03'],
                'subject_04'=>$course['subject_04'],
                'subject_05'=>$course['subject_05'],
                'subject_06'=>$course['subject_06'],
                'subject_07'=>$course['subject_07'],
                'subject_08'=>$course['subject_08'],
                'subject_09'=>$course['subject_09'],
                'subject_10'=>$course['subject_10'],
            );
        }
        return $arr;
    }

    public function get_list_for_csv()
    {
        // $this->db->where('year', $_SESSION['year']);

        $this->db->select('*');
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        // $this->db->where('year', $_SESSION['year']);

        $this->db->where('first_member_do_date !=', "");

        $res = $this->db->get()->result_array();
        
        function even($var)
        {
            return($var['year'] == $_SESSION['year']);
        }

        $sub =  array_filter($res, "even");

        sort($sub);



        for ($i=0; $i < count($sub); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('staff_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('staff_member')->row_array();
            

            // foreach ($res as $k => $v) {
            $name = array_merge($supervisor1, $supervisor2);
            # code...
            $arr[] = array(
                    'year' => $sub[$i]['year'],
                    'part_name'=>$sub[$i]['part_name'],
                    'do_date' => $sub[$i]['first_member_do_date'],
                    'member_unit' => $name['member_unit'],
                    'member_name'=> $name['member_name'],
                    'member_code' =>$name['member_code']
                );
            // }
        }
        // print_r($arr);
        return $arr;
    }

    public function get_dinner_list_for_pdf($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');

        $res = $this->db->get()->result_array();

        for ($i=0; $i < count($res); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $res[$i]['supervisor_1_code'])->get('staff_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $res[$i]['supervisor_2_code'])->get('staff_member')->row_array();

            if (strtoupper($res[$i]['first_member_order_meal']) == "Y") {
                $first_member_meal = $supervisor1['meal'];
            } else {
                $first_member_meal = "";
            }

            if (strtoupper($res[$i]['second_member_order_meal']) == "Y") {
                $second_member_meal = $supervisor2['meal'];
            } else {
                $second_member_meal = "";
            }

            $arr[] = array(
                'field' => $res[$i]['field'],
                'supervisor_1'=>$res[$i]['supervisor_1'],
                'trial_staff_code_1' => $res[$i]['trial_staff_code_1'],
                'order_meal_1' => $first_member_meal,
                'supervisor_2' => $res[$i]['supervisor_2'],
                'trial_staff_code_2' => $res[$i]['trial_staff_code_2'],
                'order_meal_2' => $second_member_meal,
            );
        }
        // print_r($arr);
        return $arr;
    }

    // public function get_all_meal_count($part = '')
    // {
    //     $this->db->select('*');
    //     if ($part != '') {
    //         $this->db->where('part', $part);
    //     }
    //     $this->db->from('part_info');
    //     $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');

    //     $res = $this->db->get()->result_array();


    //     for ($i=0; $i < count($res); $i++) {
    //         # code...
    //         $this->db->where('member_code', $res[$i]['supervisor_1_code']);
    //         $veg1 = $this->db->get('staff_member')->row_array();
    //         // print_r(count($veg1));
    //     }
    // }

    public function get_trial_list($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        return $this->db->get('trial_staff')->result_array();
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('trial_assign')->row_array();
    }

    public function get_once_trial($sn)
    {
        return $this->db->where('sn', $sn)->get('trial_staff')->row_array();
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('trial_assign', $data);
        return true;
    }

    public function update_trial($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('trial_staff', $data);

        return true;
    }

    public function add_once($data)
    {
        $this->db->insert('trial_assign', $data);

        return true;
    }

    public function get_once_assign($sn)
    {
        return $this->db->where('sn', $sn)->get('trial_assign')->row_array();
    }

    public function add_trial($data)
    {
        $this->db->insert('trial_staff', $data);

        return true;
    }

    public function get_min_field($part)
    {
        $this->db->where('part', $part);
        $this->db->order_by('field', 'asc');
        $this->db->select('field');

        return $this->db->get('part_info')->row_array();
    }

    public function get_max_field($part)
    {
        $this->db->where('part', $part);
        $this->db->order_by('field', 'desc');
        $this->db->select('field');

        return $this->db->get('part_info')->row_array();
    }
}

/* End of file Mod_exam_area.php */
