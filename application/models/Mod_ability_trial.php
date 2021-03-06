<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_ability_trial extends CI_Model
{
    /**
     * 檢查監試人員是否指派過
     */
    function chk_trial_assigned($trial_staff_code)
    {
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('supervisor_1_code', $trial_staff_code);
        $this->db->where('supervisor_1_code', $trial_staff_code);
        $this->db->or_where('supervisor_2_code', $trial_staff_code);
        if ($this->db->count_all_results('ability_trial_assign') == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 檢查管卷人員試場是否重複
     */
    function chk_trial_staff_field($data)
    {
        $this->db->where('part', $data['part']);
        $this->db->where('first_start', $data['first_start']);
        $this->db->where('first_end', $data['first_end']);
        $this->db->where('second_start', $data['second_start']);
        $this->db->where('second_end', $data['second_end']);
        $this->db->where('third_start', $data['third_start']);
        $this->db->where('third_end', $data['third_end']);
        if ($this->db->count_all_results('ability_trial_staff') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function import($datas)
    {
        // 先清除當年資料
        // $this->db->where('year', $this->session->userdata('year'))->truncate('ability_trial_assign');
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->delete('ability_trial_assign');
        $this->db->insert_batch('ability_trial_assign', $datas);
    }

    public function import_trial($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('ability_trial_staff');
        $this->db->insert_batch('ability_trial_staff', $datas);
    }

    public function year_get_list()
    {
        return $this->db->where('year', $thability_trial_assignis->session->userdata('year'))->get('ability_trial_assign')->result_array();
    }

    public function chk_once($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('ability_trial_assign') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function chk_trial($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('ability_trial_staff') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_list($part = '')
    {
        $this->db->select('*');
        $this->db->where('ability_part_info.year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        return $this->db->get()->result_array();
    }
    public function new_get_list($part = '')
    {

        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }


        $res = array();
        foreach ($this->db->get('ability_part_info')->result_array() as $key => $value) {
          
            # code...
            $res[$key] = $value;
            $res[$key]['trial_staff_code_1'] = '';
            $res[$key]['supervisor_1'] = '';
            $res[$key]['supervisor_1_code'] = '';
            $res[$key]['trial_staff_code_2'] = '';
            $res[$key]['supervisor_2'] = '';
            $res[$key]['supervisor_2_code'] = '';
            $res[$key]['note'] = '';




            $assign = array();
            $this->db->where('year', $this->session->userdata('year'));
            $this->db->where('sn', $value['sn']);
            // if($part!=""){
            //     $this->db->where('part',$part);
            // }


            $assign = $this->db->get('ability_trial_assign')->result_array();
            // print_r($assign);

            if (empty($assign)) {
                // unset($res[$key]);
            } else {




                $res[$key]['field'] = $value['field'];
                $res[$key]['trial_staff_code_1'] = $assign[0]['trial_staff_code_1'];
                $res[$key]['supervisor_1'] = $assign[0]['supervisor_1'];
                $res[$key]['supervisor_1_code'] = $assign[0]['supervisor_1_code'];
                $res[$key]['trial_staff_code_2'] = $assign[0]['trial_staff_code_2'];
                $res[$key]['supervisor_2'] = $assign[0]['supervisor_2'];
                $res[$key]['supervisor_2_code'] = $assign[0]['supervisor_2_code'];
                $res[$key]['note'] = $assign[0]['note'];
            }
        }
        $res = array_values($res);
        for ($i = 0; $i < count($res); $i++) { 
            # code...
            if ($res[$i]['field'] == '100645') {
                // print_r($res[$i]);

            }
        }
        return $res;
    }

    public function chk_part_list($part, $area)
    {
        $year = $this->session->userdata('year');

        $this->db->where('year', $year);
        $this->db->where('part', $part);
        $res = $this->db->get('ability_part_info')->result_array();

        $sub = array();
        foreach ($res as $key => $value) {
            $this->db->where('sn', $value['sn']);
            // $this->db->where('first_member_do_date !=', "");
            $sub = $this->db->get('ability_trial_assign')->result_array();
        }



        if (!empty($sub)) {
            return true;
        } else {
            return false;
        }
    }

    public function chk_list_for_voucher($part, $area)
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $year = $this->session->userdata('year');

        $this->db->where('first_member_do_date !=', "");
        $res = $this->db->get()->result_array();


        function even($var)
        {
            return ($var['year'] == $_SESSION['year']);
        }

        $sub = array_filter($res, "even");

        sort($sub);


        if (!empty($sub)) {
            return true;
        } else {
            return false;
        }
    }

    public function chk_trial_staff_task_list($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('ability_trial_staff')->result_array();
        if (!empty($res)) {
            return true;
        } else {
            return false;
        }
    }

    public function chk_patrol_staff_task_list($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('ability_patrol_staff')->result_array();
        if (!empty($res)) {
            return true;
        } else {
            return false;
        }
    }

    public function chk_part_list_of_obs($part, $area, $obs = '')
    {
        $this->db->select('*');
        $this->db->where('ability_part_info.year', $_SESSION['year']);
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        if ($obs != '') {

            $this->db->like('ability_part_info.field', $obs, 'after');
        }

        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();
        // print_r($res);


        // function even($var)
        // {
        //     return ($var['year'] == $_SESSION['year']);
        // }

        // $sub = array_filter($res, "even");

        // sort($sub);


        if (!empty($res)) {
            return true;
        } else {
            return false;
        }
    }

    public function e_2_1_2($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('ability_trial_staff')->result_array();
        if (!empty($res)) {
            for ($i = 0; $i < count($res); $i++) {
                # code...
                $member = $this->db->where('member_code', $res[$i]['trial_staff_code'])->get('ability_staff_member')->row_array();
                // $trial = $this->db->where('part',$part)->where('year',$_SESSION['year'])->get('trial_staff')->row_array();
                $do_date = explode(",", $res[$i]['do_date']);
                for ($d = 0; $d < count($do_date); $d++) {

                    $arr[$do_date[$d]][] = array(
                        'job_code' => $res[$i]['trial_staff_code'],
                        'job' => '管卷人員',
                        // 'job_title' => $res[$i]['job_title'],
                        'name' => $res[$i]['trial_staff_name'],
                        'member_unit' => $member['member_unit'],
                        'meal' => $res[$i]['meal'],
                        'note' => $res[$i]['note'],
                    );
                }
            }
            return $arr;
        } else {
            return false;
        }
    }

    public function e_2_1_3($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('ability_patrol_staff')->result_array();
        if (!empty($res)) {
            for ($i = 0; $i < count($res); $i++) {
                # code...
                $member = $this->db->where('member_code', $res[$i]['patrol_staff_code'])->get('ability_staff_member')->row_array();
                // $trial = $this->db->where('part',$part)->where('year',$_SESSION['year'])->get('trial_staff')->row_array();
                $do_date = explode(",", $res[$i]['do_date']);
                for ($d = 0; $d < count($do_date); $d++) {

                    $arr[$do_date[$d]][] = array(
                        'job_code' => $res[$i]['patrol_staff_code'],
                        'job' => '巡場人員',
                        // 'job_title' => $res[$i]['job_title'],
                        'name' => $res[$i]['patrol_staff_name'],
                        'member_unit' => $member['member_unit'],
                        'meal' => $res[$i]['meal'],
                        'note' => $res[$i]['note'],
                    );
                }
            }
            return $arr;
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
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        // $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();
        if (!empty($res)) {
            function even($var)
            {
                return ($var['year'] == $_SESSION['year']);
            }

            $sub = array_filter($res, "even");

            sort($sub);


            for ($i = 0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('ability_patrol_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('ability_trial_staff')->result_array();
                // $trial_staff = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('trial_staff')->row_array();
                // print_r($trial_staff);
                if ($sub[$i]['first_member_salary_section'] == "") {
                    $first_member_salary_section = 0;
                } else {
                    $first_member_salary_section = $sub[$i]['first_member_salary_section'];
                }
                if ($sub[$i]['second_member_salary_section'] == "") {
                    $second_member_salary_section = 0;
                } else {
                    $second_member_salary_section = $sub[$i]['second_member_salary_section'];
                }
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $arr[] = array(
                    'sn' => $sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['test_section'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['first_member_do_date'],
                    'first_member_salary_section' => $first_member_salary_section,
                    'first_member_section_lunch_total' => $sub[$i]['first_member_section_lunch_total'] * count($do_date1),
                    'first_member_section_salary_total' => $sub[$i]['first_member_section_salary_total'],
                    'order_meal1' => $supervisor1['order_meal'],
                    'supervisor_1' => $sub[$i]['supervisor_1'],
                    'supervisor_1_unit' => $supervisor1['member_unit'],
                    'supervisor_1_phone' => $supervisor1['member_phone'],
                    'second_member_salary_section' => $second_member_salary_section,
                    'second_member_section_lunch_total' => $sub[$i]['second_member_section_lunch_total'] * count($do_date2),
                    'second_member_section_salary_total' => $sub[$i]['second_member_section_salary_total'],
                    'supervisor_2' => $sub[$i]['supervisor_2'],
                    'supervisor_2_unit' => $supervisor2['member_unit'],
                    'supervisor_2_phone' => $supervisor2['member_phone'],
                    'order_meal2' => $supervisor2['order_meal'],
                    'floor' => $sub[$i]['floor'],
                    'number' => $sub[$i]['number'],
                    'start' => $sub[$i]['start'],
                    'end' => $sub[$i]['end'],
                    'allocation_code' => $patrol['allocation_code'],
                    'patrol' => $patrol['patrol_staff_name'],
                    'subject_01' => $course['subject_01'],
                    'subject_02' => $course['subject_02'],
                    'subject_03' => $course['subject_03'],
                    'subject_04' => $course['subject_04'],
                    'subject_05' => $course['subject_05'],
                    'subject_06' => $course['subject_06'],
                    'subject_07' => $course['subject_07'],
                    'subject_08' => $course['subject_08'],
                    'subject_09' => $course['subject_09'],
                    'subject_10' => $course['subject_10'],
                );
            }
            return $arr;
        } else {
            return false;
        }
    }

    public function e_6_1($part = '')
    {
        $this->db->select('*');
        $this->db->where('ability_part_info.year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->not_like('ability_part_info.field', '29', 'after');
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();
        if (!empty($res)) {
            function even($var)
            {
                return ($var['year'] == $_SESSION['year']);
            }

            $sub = array_filter($res, "even");

            sort($sub);

            // print_r($sub);

            for ($i = 0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('ability_patrol_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('ability_trial_staff')->result_array();

                if ($sub[$i]['first_member_section_salary_total'] == "" || $sub[$i]['supervisor_1'] == ' ') {
                    $first_member_section_salary_total = 0;
                    $sub[$i]['first_member_section_lunch_total'] = 0;
                } else {
                    $first_member_section_salary_total = $sub[$i]['first_member_section_salary_total'];
                }
                if ($sub[$i]['second_member_section_salary_total'] == "" || $sub[$i]['supervisor_2'] == ' ') {
                    $second_member_section_salary_total = 0;
                    $sub[$i]['second_member_section_lunch_total'] = 0;
                } else {
                    $second_member_section_salary_total = $sub[$i]['second_member_section_salary_total'];
                }
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $arr[] = array(
                    'sn' => $sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['test_section'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['first_member_do_date'],
                    'first_member_salary_section' => $first_member_section_salary_total,
                    'first_member_section_lunch_total' => $sub[$i]['first_member_section_lunch_total'],
                    'first_member_section_salary_total' => $sub[$i]['first_member_section_salary_total'],
                    'order_meal1' => $res[$i]['first_member_order_meal'],
                    'supervisor_1' => $sub[$i]['supervisor_1'],
                    'supervisor_1_unit' => $supervisor1['member_unit'],
                    'supervisor_1_phone' => $supervisor1['member_phone'],
                    'second_member_salary_section' => $second_member_section_salary_total,
                    'second_member_section_lunch_total' => $sub[$i]['second_member_section_lunch_total'],
                    'second_member_section_salary_total' => $sub[$i]['second_member_section_salary_total'],
                    'supervisor_2' => $sub[$i]['supervisor_2'],
                    'supervisor_2_unit' => $supervisor2['member_unit'],
                    'supervisor_2_phone' => $supervisor2['member_phone'],
                    'order_meal2' => $res[$i]['second_member_order_meal'],
                );
            }
            // print_r($arr);
            return $arr;
        } else {
            return false;
        }
    }

    public function get_trial_member_count($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->where("ability_part_info.year", $_SESSION['year']);

        $this->db->where("trial_assign.supervisor_1 != ", "");
        $this->db->where("trial_assign.supervisor_2 != ", "");
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        $year = $this->session->userdata('year');

        $sub = $this->db->get()->result_array();
        if (!empty($sub)) {

            // print_r($sub);

            for ($i = 0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('ability_patrol_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('ability_trial_staff')->result_array();
                if ($sub[$i]['first_member_salary_section'] == "") {
                    $first_member_salary_section = 0;
                } else {
                    $first_member_salary_section = $sub[$i]['first_member_salary_section'];
                }
                if ($sub[$i]['second_member_salary_section'] == "") {
                    $second_member_salary_section = 0;
                } else {
                    $second_member_salary_section = $sub[$i]['second_member_salary_section'];
                }
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $arr[] = array(
                    'sn' => $sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['test_section'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['first_member_do_date'],
                    'first_member_salary_section' => $sub[$i]['first_member_section_salary_total'] * count($do_date1),
                    'first_member_section_lunch_total' => $sub[$i]['first_member_section_lunch_total'] * count($do_date1),
                    'first_member_section_salary_total' => $sub[$i]['first_member_section_salary_total'] * count($do_date1),
                    'order_meal1' => $sub[$i]['first_member_order_meal'],
                    'supervisor_1' => $sub[$i]['supervisor_1'],
                    'supervisor_1_unit' => $supervisor1['member_unit'],
                    'supervisor_1_phone' => $supervisor1['member_phone'],
                    'second_member_salary_section' => $sub[$i]['second_member_section_salary_total'] * count($do_date2),
                    'second_member_section_lunch_total' => $sub[$i]['second_member_section_lunch_total'] * count($do_date2),
                    'second_member_section_salary_total' => $sub[$i]['second_member_section_salary_total'] * count($do_date2),
                    'supervisor_2' => $sub[$i]['supervisor_2'],
                    'supervisor_2_unit' => $supervisor2['member_unit'],
                    'supervisor_2_phone' => $supervisor2['member_phone'],
                    'order_meal2' => $sub[$i]['second_member_order_meal'],
                );
            }
            // print_r($arr);
            return $arr;
        } else {
            return false;
        }
    }

    public function e_6_1_member_count($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->where("ability_part_info.year", $_SESSION['year']);

        $this->db->where("ability_trial_assign.supervisor_1 != ", "");
        $this->db->where("ability_trial_assign.supervisor_2 != ", "");
        $this->db->not_like('ability_part_info.field', '29', 'after');
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        $year = $this->session->userdata('year');

        $sub = $this->db->get()->result_array();
        if (!empty($sub)) {

            // print_r($sub);

            for ($i = 0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('ability_patrol_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('ability_trial_staff')->result_array();
                if ($sub[$i]['first_member_salary_section'] == "") {
                    $first_member_salary_section = 0;
                } else {
                    $first_member_salary_section = $sub[$i]['first_member_salary_section'];
                }
                if ($sub[$i]['second_member_salary_section'] == "") {
                    $second_member_salary_section = 0;
                } else {
                    $second_member_salary_section = $sub[$i]['second_member_salary_section'];
                }
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $arr[] = array(
                    'sn' => $sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['test_section'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['first_member_do_date'],
                    'first_member_salary_section' => $sub[$i]['first_member_section_salary_total'] * count($do_date1),
                    'first_member_section_lunch_total' => $sub[$i]['first_member_section_lunch_total'] * count($do_date1),
                    'first_member_section_salary_total' => $sub[$i]['first_member_section_salary_total'] * count($do_date1),
                    'order_meal1' => $sub[$i]['first_member_order_meal'],
                    'supervisor_1' => $sub[$i]['supervisor_1'],
                    'supervisor_1_unit' => $supervisor1['member_unit'],
                    'supervisor_1_phone' => $supervisor1['member_phone'],
                    'second_member_salary_section' => $sub[$i]['second_member_section_salary_total'] * count($do_date2),
                    'second_member_section_lunch_total' => $sub[$i]['second_member_section_lunch_total'] * count($do_date2),
                    'second_member_section_salary_total' => $sub[$i]['second_member_section_salary_total'] * count($do_date2),
                    'supervisor_2' => $sub[$i]['supervisor_2'],
                    'supervisor_2_unit' => $supervisor2['member_unit'],
                    'supervisor_2_phone' => $supervisor2['member_phone'],
                    'order_meal2' => $sub[$i]['second_member_order_meal'],
                );
            }
            // print_r($arr);
            return $arr;
        } else {
            return false;
        }
    }

    public function get_all_salary_trial_total($part = '')
    {
        $this->db->select('*');

        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->not_like('ability_part_info.field', '29', 'after');
        $this->db->where("ability_part_info.year", $_SESSION['year']);

        $sub = $this->db->get()->result_array();
        if (!empty($sub)) {
            $salary = 0;
            for ($i = 0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('ability_patrol_staff')->row_array();
                $course = $this->db->where('year', $_SESSION['year'])->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('ability_trial_staff')->result_array();
                if ($sub[$i]['first_member_salary_section'] == "") {
                    $first_member_salary_section = 0;
                } else {
                    $first_member_salary_section = $sub[$i]['first_member_salary_section'];
                }
                if ($sub[$i]['second_member_salary_section'] == "") {
                    $second_member_salary_section = 0;
                } else {
                    $second_member_salary_section = $sub[$i]['second_member_salary_section'];
                }
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $salary += $sub[$i]['first_member_section_salary_total'] + $sub[$i]['second_member_section_salary_total'];
            }
            return $salary;
        } else {
            return false;
        }
    }

    public function get_all_trial_lunch_total($part = '')
    {
        $this->db->select('*');

        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->not_like('ability_part_info.field', '29', 'after');
        $this->db->where("ability_part_info.year", $_SESSION['year']);

        $sub = $this->db->get()->result_array();
        if (!empty($sub)) {
            $lunch = 0;
            for ($i = 0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('ability_patrol_staff')->row_array();
                $course = $this->db->where('year', $_SESSION['year'])->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('ability_trial_staff')->result_array();
                if ($sub[$i]['first_member_salary_section'] == "") {
                    $first_member_salary_section = 0;
                } else {
                    $first_member_salary_section = $sub[$i]['first_member_salary_section'];
                }
                if ($sub[$i]['second_member_salary_section'] == "") {
                    $second_member_salary_section = 0;
                } else {
                    $second_member_salary_section = $sub[$i]['second_member_salary_section'];
                }
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $lunch += $sub[$i]['first_member_section_lunch_total'] + $sub[$i]['second_member_section_lunch_total'];
            }
            return abs($lunch);
        } else {
            return false;
        }
    }


    public function get_all_salary_trial_total_of_obs($part = '', $obs)
    {
        $this->db->select('*');
        $this->db->like('ability_part_info.field', $obs);
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->where("ability_part_info.year", $_SESSION['year']);

        $sub = $this->db->get()->result_array();
        if (!empty($sub)) {
            $salary = 0;
            for ($i = 0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('ability_patrol_staff')->row_array();
                $course = $this->db->where('year', $_SESSION['year'])->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('ability_trial_staff')->result_array();
                if ($sub[$i]['first_member_salary_section'] == "") {
                    $first_member_salary_section = 0;
                } else {
                    $first_member_salary_section = $sub[$i]['first_member_salary_section'];
                }
                if ($sub[$i]['second_member_salary_section'] == "") {
                    $second_member_salary_section = 0;
                } else {
                    $second_member_salary_section = $sub[$i]['second_member_salary_section'];
                }
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $salary += $sub[$i]['first_member_section_salary_total'] + $sub[$i]['second_member_section_salary_total'];
            }
            return $salary;
        } else {
            return false;
        }
    }

    public function get_all_trial_lunch_total_of_obs($part = '', $obs)
    {
        $this->db->select('*');
        $this->db->like('ability_part_info.field', $obs);
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->where("ability_part_info.year", $_SESSION['year']);

        $sub = $this->db->get()->result_array();
        if (!empty($sub)) {
            $lunch = 0;
            for ($i = 0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('ability_patrol_staff')->row_array();
                $course = $this->db->where('year', $_SESSION['year'])->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('ability_trial_staff')->result_array();

                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $lunch += $sub[$i]['first_member_section_lunch_total'] + $sub[$i]['second_member_section_lunch_total'];
            }
            return abs($lunch);
        } else {
            return false;
        }
    }

    public function get_trial_moneylist_for_csv($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();
        if (!empty($res)) {
            function even($var)
            {
                return ($var['year'] == $_SESSION['year']);
            }

            $sub = array_filter($res, "even");

            sort($sub);


            for ($i = 0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('ability_patrol_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('ability_trial_staff')->result_array();
                if ($sub[$i]['first_member_section_salary_total'] == "") {
                    $first_member_salary_section = 0;
                } else {
                    $first_member_salary_section = $sub[$i]['first_member_section_salary_total'];
                }
                if ($sub[$i]['second_member_section_salary_total'] == "") {
                    $second_member_salary_section = 0;
                } else {
                    $second_member_salary_section = $sub[$i]['second_member_section_salary_total'];
                }
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $arr[] = array(
                    'sn' => $sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['test_section'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['first_member_do_date'],
                    'salary_section' => $first_member_salary_section,
                    'section_lunch_total' => $sub[$i]['first_member_section_lunch_total'],
                    'section_salary_total' => $sub[$i]['first_member_section_total'],
                    'order_meal' => $supervisor1['order_meal'],
                    'supervisor' => $sub[$i]['supervisor_1'],
                );
                $arr[] = array(
                    'sn' => $sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['test_section'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['second_member_do_date'],
                    'salary_section' => $second_member_salary_section,
                    'section_lunch_total' => $sub[$i]['second_member_section_lunch_total'],
                    'section_salary_total' => $sub[$i]['second_member_section_total'],
                    'supervisor' => $sub[$i]['supervisor_2'],
                    'order_meal' => $supervisor2['order_meal'],
                );
            }
            return $arr;
        } else {
            return false;
        }
    }

    public function get_list_for_voucher($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();
        function even($var)
        {
            return ($var['year'] == $_SESSION['year']);
        }

        $sub = array_filter($res, "even");

        sort($sub);

        for ($i = 0; $i < count($sub); $i++) {
                # code...
            $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
            $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
            $voucher = $this->db->where('part', $part)->where('first_start <=', $sub[$i]['start'])->where('first_end >=', $sub[$i]['end'])->get('ability_trial_staff')->row_array();
            $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
            $trial = $this->db->get('ability_trial_staff')->result_array();


            $arr[$voucher['trial_staff_name']] = array(
                'sn' => $sub[$i]['sn'],
                'field' => $sub[$i]['field'],
                'test_section' => $sub[$i]['test_section'],
                'part' => $sub[$i]['part'],
                'supervisor_1' => $sub[$i]['supervisor_1'],
                'supervisor_2' => $sub[$i]['supervisor_2'],
                'subject_01' => $course['subject_01'],
                'subject_02' => $course['subject_02'],
                'subject_03' => $course['subject_03'],
                'subject_04' => $course['subject_04'],
                'subject_05' => $course['subject_05'],
                'subject_06' => $course['subject_06'],
                'subject_07' => $course['subject_07'],
                'subject_08' => $course['subject_08'],
                'subject_09' => $course['subject_09'],
                'subject_10' => $course['subject_10'],
            );
        }
        return $arr;
    }

    public function get_once_date_of_voucher1($part = '')
    {
        $this->db->select('*');
        $year = $this->session->userdata('year');
        $this->db->where('ability_part_info.year', $year);
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');


        $sub = $this->db->get()->result_array();
        if (!empty($sub)) {
            for ($i = 0; $i < count($sub); $i++) {
                    # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $voucher = $this->db->where('part', $part)->where('first_start <=', $sub[$i]['field'])->where('first_end >=', $sub[$i]['field'])->get('ability_trial_staff')->result_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('ability_trial_staff')->result_array();
                if (!empty($voucher)) {
                    for ($v = 0; $v < count($voucher); $v++) { 
                        # code...
                        $arr[$voucher[$v]['trial_staff_name']][] = array(
                            'sn' => $sub[$i]['sn'],
                            'field' => $sub[$i]['field'],
                            'test_section' => $sub[$i]['test_section'],
                            'part' => $sub[$i]['part'],
                            'supervisor_1' => $sub[$i]['supervisor_1'],
                            'supervisor_2' => $sub[$i]['supervisor_2'],
                            'subject_01' => $course['subject_01'],
                            'subject_02' => $course['subject_02'],
                            'subject_03' => $course['subject_03'],
                        );
                    }
                } else {
                    return false;
                }

            }
            return $arr;
        } else {
            return false;
        }

    }

    public function get_once_date_of_voucher2($part = '')
    {
        $this->db->select('*');
        $year = $this->session->userdata('year');
        $this->db->where('ability_part_info.year', $year);
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');


        $sub = $this->db->get()->result_array();
        if (!empty($sub)) {
            for ($i = 0; $i < count($sub); $i++) {
                    # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $voucher = $this->db->where('part', $part)->where('second_start <=', $sub[$i]['field'])->where('second_end >=', $sub[$i]['field'])->get('ability_trial_staff')->result_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('ability_trial_staff')->result_array();
                if (!empty($voucher)) {
                    for ($v = 0; $v < count($voucher); $v++) { 
                        # code...
                        $arr[$voucher[$v]['trial_staff_name']][] = array(
                            'sn' => $sub[$i]['sn'],
                            'field' => $sub[$i]['field'],
                            'test_section' => $sub[$i]['test_section'],
                            'part' => $sub[$i]['part'],
                            'supervisor_1' => $sub[$i]['supervisor_1'],
                            'supervisor_2' => $sub[$i]['supervisor_2'],
                            'subject_04' => $course['subject_04'],
                            'subject_05' => $course['subject_05'],
                            'subject_06' => $course['subject_06'],
                            'subject_07' => $course['subject_07'],
                        );
                    }
                } else {
                    return false;
                }
            }
            return $arr;
        } else {
            return false;
        }

    }

    public function get_once_date_of_voucher3($part = '')
    {
        $this->db->select('*');
        $year = $this->session->userdata('year');
        $this->db->where('ability_part_info.year', $year);
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');


        $sub = $this->db->get()->result_array();
        if (!empty($sub)) {
            for ($i = 0; $i < count($sub); $i++) {
                    # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $voucher = $this->db->where('part', $part)->where('third_start <=', $sub[$i]['field'])->where('third_end >=', $sub[$i]['field'])->get('ability_trial_staff')->result_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('ability_trial_staff')->result_array();
                if (!empty($voucher)) {
                    for ($v = 0; $v < count($voucher); $v++) { 
                        # code...
                        $arr[$voucher[$v]['trial_staff_name']][] = array(
                            'sn' => $sub[$i]['sn'],
                            'field' => $sub[$i]['field'],
                            'test_section' => $sub[$i]['test_section'],
                            'part' => $sub[$i]['part'],
                            'supervisor_1' => $sub[$i]['supervisor_1'],
                            'supervisor_2' => $sub[$i]['supervisor_2'],
                            'subject_08' => $course['subject_08'],
                            'subject_09' => $course['subject_09'],
                            'subject_010' => $course['subject_10'],
                        );
                    }
                } else {
                    return false;
                }

            }

            return $arr;
        } else {
            return false;
        }

    }

    public function e_3_2_1($part = '')
    {
        $this->db->select('*');
        $year = $this->session->userdata('year');
        $this->db->where('ability_part_info.year', $year);
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');


        $sub = $this->db->get()->result_array();
        // for ($i = 0; $i < count($sub); $i++) {

        //     $date = $_GET['date'];
        //     $dates = $sub[$i]['first_member_do_date'];
        //     $long = strlen($sub[$i]['first_member_do_date']);
        //     if ($dates == "" && $dates == " " && $long < 1) {
        //         unset($sub[$i]['supervisor_1']);
        //     } else {
        //         $dates = explode(",", $dates);
        //         if (in_array($date, $dates)) {
        //             //有找到執行區

        //         } else {
        //             //沒找到執行區
        //             unset($sub[$i]['supervisor_1']);
        //         }

        //     }
        // }

        // for ($i = 0; $i < count($sub); $i++) {

        //     $date = $_GET['date'];
        //     $dates = $sub[$i]['second_member_do_date'];
        //     $long = strlen($sub[$i]['first_member_do_date']);
        //     if ($dates == "" && $dates == " " && $long < 1) {
        //         unset($sub[$i]['supervisor_2']);
        //     } else {
        //         $dates = explode(",", $dates);
        //         if (in_array($date, $dates)) {
        //             //有找到執行區

        //         } else {
        //             //沒找到執行區
        //             unset($sub[$i]['supervisor_2']);
        //         }

        //     }
        // }
        // print_r($sub);
        if (!empty($sub)) {
            for ($i = 0; $i < count($sub); $i++) {
                    # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $voucher = $this->db->where('year', $year)->where('part', $part)->where('first_start <=', $sub[$i]['field'])->where('first_end >=', $sub[$i]['field'])->get('ability_trial_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('trial_staff')->result_array();
                if (!isset($sub[$i]['supervisor_1'])) {
                    $sub[$i]['supervisor_1'] = "";
                };
                if (!isset($sub[$i]['supervisor_2'])) {
                    $sub[$i]['supervisor_2'] = "";
                };



                // $dates = $voucher['do_date'];
                // // print_r($dates);
                // $dates = explode(",", $dates);
                // if (in_array($date, $dates)) {
                //     //有找到執行區
                // } else {
                //     //沒找到執行區
                //     unset($voucher['patrol_staff_name']);
                //     unset($voucher['allocation_code']);
                // }


                // if (!isset($voucher['patrol_staff_name'])) {
                //     $voucher['patrol_staff_name'] = "";
                // };
                // if (!isset($voucher['allocation_code'])) {
                //     $voucher['allocation_code'] = "";
                // };


                $arr[] = array(
                    'sn' => $sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['test_section'],
                    'start' => $sub[$i]['start'],
                    'end' => $sub[$i]['end'],
                    'floor' => $sub[$i]['floor'],
                    'part' => $sub[$i]['part'],
                    'supervisor_1' => $sub[$i]['supervisor_1'],
                    'supervisor_2' => $sub[$i]['supervisor_2'],
                    'allocation_code' => $voucher['allocation_code'],
                    'voucher' => $voucher['trial_staff_name']
                );
            }
            // print_r($arr);
            return $arr;
        } else {
            return false;
        }
    }

    public function e_3_2_2($part = '')
    {
        $this->db->select('*');
        $year = $this->session->userdata('year');
        $this->db->where('ability_part_info.year', $year);
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');


        $sub = $this->db->get()->result_array();
        for ($i = 0; $i < count($sub); $i++) {

            $date = $_GET['date'];
            $dates = $sub[$i]['first_member_do_date'];
            $long = strlen($sub[$i]['first_member_do_date']);
            if ($dates == "" && $dates == " " && $long < 1) {
                unset($sub[$i]['supervisor_1']);
            } else {
                $dates = explode(",", $dates);
                if (in_array($date, $dates)) {
                    //有找到執行區

                } else {
                    //沒找到執行區
                    unset($sub[$i]['supervisor_1']);
                }

            }
        }

        for ($i = 0; $i < count($sub); $i++) {

            $date = $_GET['date'];
            $dates = $sub[$i]['second_member_do_date'];
            $long = strlen($sub[$i]['first_member_do_date']);
            if ($dates == "" && $dates == " " && $long < 1) {
                unset($sub[$i]['supervisor_2']);
            } else {
                $dates = explode(",", $dates);
                if (in_array($date, $dates)) {
                    //有找到執行區

                } else {
                    //沒找到執行區
                    unset($sub[$i]['supervisor_2']);
                }

            }
        }
        // print_r($sub);
        if (!empty($sub)) {
            for ($i = 0; $i < count($sub); $i++) {
                    # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $voucher = $this->db->where('part', $part)->where('second_start <=', $sub[$i]['field'])->where('second_end >=', $sub[$i]['field'])->get('ability_trial_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('trial_staff')->result_array();
                if (!isset($sub[$i]['supervisor_1'])) {
                    $sub[$i]['supervisor_1'] = "";
                };
                if (!isset($sub[$i]['supervisor_2'])) {
                    $sub[$i]['supervisor_2'] = "";
                };



                $dates = $voucher['do_date'];
                print_r($dates);
                $dates = explode(",", $dates);
                if (in_array($date, $dates)) {
                    //有找到執行區
                } else {
                    //沒找到執行區
                    unset($voucher['trial_staff_name']);
                    unset($voucher['allocation_code']);
                }


                if (!isset($voucher['trial_staff_name'])) {
                    $voucher['trial_staff_name'] = "";
                };
                if (!isset($voucher['allocation_code'])) {
                    $voucher['allocation_code'] = "";
                };


                $arr[] = array(
                    'sn' => $sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['test_section'],
                    'start' => $sub[$i]['start'],
                    'end' => $sub[$i]['end'],
                    'floor' => $sub[$i]['floor'],
                    'part' => $sub[$i]['part'],
                    'supervisor_1' => $sub[$i]['supervisor_1'],
                    'supervisor_2' => $sub[$i]['supervisor_2'],
                    'allocation_code' => $voucher['allocation_code'],
                    'voucher' => $voucher['trial_staff_name']
                );
            }
            return $arr;
        } else {
            return false;
        }
    }

    public function e_3_2_3($part = '')
    {
        $this->db->select('*');
        $year = $this->session->userdata('year');
        $this->db->where('ability_part_info.year', $year);
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');


        $sub = $this->db->get()->result_array();

        for ($i = 0; $i < count($sub); $i++) {

            $date = $_GET['date'];
            $dates = $sub[$i]['first_member_do_date'];
            $long = strlen($sub[$i]['first_member_do_date']);
            if ($dates == "" && $dates == " " && $long < 1) {
                unset($sub[$i]['supervisor_1']);
            } else {
                $dates = explode(",", $dates);
                if (in_array($date, $dates)) {
                    //有找到執行區

                } else {
                    //沒找到執行區
                    unset($sub[$i]['supervisor_1']);
                }

            }
        }

        for ($i = 0; $i < count($sub); $i++) {

            $date = $_GET['date'];
            $dates = $sub[$i]['second_member_do_date'];
            $long = strlen($sub[$i]['first_member_do_date']);
            if ($dates == "" && $dates == " " && $long < 1) {
                unset($sub[$i]['supervisor_2']);
            } else {
                $dates = explode(",", $dates);
                if (in_array($date, $dates)) {
                    //有找到執行區

                } else {
                    //沒找到執行區
                    unset($sub[$i]['supervisor_2']);
                }

            }
        }
        // print_r($sub);
        if (!empty($sub)) {
            for ($i = 0; $i < count($sub); $i++) {
                    # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $voucher = $this->db->where('part', $part)->where('third_start <=', $sub[$i]['field'])->where('third_end >=', $sub[$i]['field'])->get('ability_trial_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('trial_staff')->result_array();
                if (!isset($sub[$i]['supervisor_1'])) {
                    $sub[$i]['supervisor_1'] = "";
                };
                if (!isset($sub[$i]['supervisor_2'])) {
                    $sub[$i]['supervisor_2'] = "";
                };



                $dates = $voucher['do_date'];
                // print_r($dates);
                $dates = explode(",", $dates);
                if (in_array($date, $dates)) {
                    //有找到執行區
                } else {
                    //沒找到執行區
                    unset($voucher['trial_staff_name']);
                    unset($voucher['allocation_code']);
                }


                if (!isset($voucher['trial_staff_name'])) {
                    $voucher['trial_staff_name'] = "";
                };
                if (!isset($voucher['allocation_code'])) {
                    $voucher['allocation_code'] = "";
                };


                $arr[] = array(
                    'sn' => $sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['test_section'],
                    'start' => $sub[$i]['start'],
                    'end' => $sub[$i]['end'],
                    'floor' => $sub[$i]['floor'],
                    'part' => $sub[$i]['part'],
                    'supervisor_1' => $sub[$i]['supervisor_1'],
                    'supervisor_2' => $sub[$i]['supervisor_2'],
                    'allocation_code' => $voucher['allocation_code'],
                    'voucher' => $voucher['trial_staff_name']
                );
            }
            return $arr;
        } else {
            return false;
        }
    }          

    //按照日期取的監試人員資料
    public function get_date_for_trial_list($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();

        function even($var)
        {
            return ($var['year'] == $_SESSION['year']);
        }

        $sub = array_filter($res, "even");

        sort($sub);

        // print_r($sub);

        if (!empty($sub)) {
            for ($i = 0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $do_date = explode(",", $sub[$i]['first_member_do_date']);
                print_r($supervisor1);
                
                # code...
                if (strtoupper($sub[$i]['first_member_order_meal']) == "Y") {
                    $first_member_meal = $supervisor1['meal'];
                } else {
                    $first_member_meal = '自備';
                }

                if (strtoupper($sub[$i]['second_member_order_meal']) == "Y") {
                    $second_member_meal = $supervisor2['meal'];
                } else {
                    $second_member_meal = '自備';
                }

                for ($d = 0; $d < count($do_date); $d++) {
                    $arr[$do_date[$d]][] = array(
                        'sn' => $sub[$i]['sn'],
                        'field' => $sub[$i]['field'],
                        'test_section' => $sub[$i]['test_section'],
                        'part' => $sub[$i]['part'],
                        'order_meal1' => $supervisor1['order_meal'],
                        'meal1' => $first_member_meal,
                        'supervisor_1' => $sub[$i]['supervisor_1'],
                        'supervisor_1_unit' => $supervisor1['member_unit'],
                        'supervisor_1_phone' => $supervisor1['member_phone'],
                        'meal2' => $second_member_meal,
                        'supervisor_2' => $sub[$i]['supervisor_2'],
                        'supervisor_2_unit' => $supervisor2['member_unit'],
                        'supervisor_2_phone' => $supervisor2['member_phone'],
                        'order_meal2' => $supervisor2['order_meal'],
                        'floor' => $sub[$i]['floor'],
                        'number' => $sub[$i]['number'],
                        'start' => $sub[$i]['start'],
                        'end' => $sub[$i]['end'],
                    );
                }
            }
            // print_r($arr);
            return $arr;
        } else {
            return false;
        }
    }

    public function get_date_for_trial_list_test($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();

        function even($var)
        {
            return ($var['year'] == $_SESSION['year']);
        }

        $sub = array_filter($res, "even");

        sort($sub);

        // print_r($sub);

        if (!empty($sub)) {
            for ($i = 0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('year', $this->session->userdata('year'))->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $do_date = explode(",", $sub[$i]['first_member_do_date']);
                
                # code...
                if (strtoupper($sub[$i]['first_member_order_meal']) == "Y") {
                    $first_member_meal = $supervisor1['meal'];
                } else {
                    $first_member_meal = '自備';
                }

                if (strtoupper($sub[$i]['second_member_order_meal']) == "Y") {
                    $second_member_meal = $supervisor2['meal'];
                } else {
                    $second_member_meal = '自備';
                }

                for ($d = 0; $d < count($do_date); $d++) {
                    $arr[$do_date[$d]][] = array(
                        'sn' => $sub[$i]['sn'],
                        'field' => $sub[$i]['field'],
                        'test_section' => $sub[$i]['test_section'],
                        'part' => $sub[$i]['part'],
                        'order_meal1' => $supervisor1['order_meal'],
                        'meal1' => $first_member_meal,
                        'supervisor_1' => $sub[$i]['supervisor_1'],
                        'supervisor_1_unit' => $supervisor1['member_unit'],
                        'supervisor_1_phone' => $supervisor1['member_phone'],
                        'meal2' => $second_member_meal,
                        'supervisor_2' => $sub[$i]['supervisor_2'],
                        'supervisor_2_unit' => $supervisor2['member_unit'],
                        'supervisor_2_phone' => $supervisor2['member_phone'],
                        'order_meal2' => $supervisor2['order_meal'],
                        'floor' => $sub[$i]['floor'],
                        'number' => $sub[$i]['number'],
                        'start' => $sub[$i]['start'],
                        'end' => $sub[$i]['end'],
                    );
                }
            }
            // print_r($arr);
            return $arr;
        } else {
            return false;
        }
    }

    public function get_trial_staff_task_money_list($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('ability_trial_staff')->result_array();
        if (!empty($res)) {
            for ($i = 0; $i < count($res); $i++) {
                $do_date = explode(",", $res[$i]['do_date']);
                # code...
                $arr[] = array(
                    'job' => '分區管卷人員',
                    'name' => $res[$i]['trial_staff_name'],
                    'one_day_salary' => $res[$i]['salary'],
                    'salary_total' => $res[$i]['salary_total'],
                    'lunch_price' => $res[$i]['lunch_price'] * count($do_date),
                    'lunch_total' => $res[$i]['lunch_total'],
                    'total' => $res[$i]['total'],
                    'order_meal' => $res[$i]['order_meal']
                );

            }

            return $arr;
        } else {
            return false;
        }
    }

    public function get_trial_staff_task_member_count($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('ability_trial_staff')->result_array();
        if (!empty($res)) {
            return $res;
        } else {
            return false;
        }
    }

    public function get_trial_staff_salary_total($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('ability_trial_staff')->result_array();
        $salary = 0;
        if (!empty($res)) {
            for ($i = 0; $i < count($res); $i++) {
                $do_date = explode(",", $res[$i]['do_date']);
                # code...
                $arr[] = array(
                    'job' => '分區管卷人員',
                    'name' => $res[$i]['trial_staff_name'],
                    'one_day_salary' => $res[$i]['salary'],
                    'salary_total' => $res[$i]['salary_total'],
                    'lunch_price' => $res[$i]['lunch_price'] * count($do_date),
                    'lunch_total' => $res[$i]['lunch_total'] * count($do_date),
                    'total' => $res[$i]['total'],
                    'order_meal' => $res[$i]['order_meal']
                );

                $salary += $res[$i]['salary_total'];

            }

            return $salary;
        } else {
            return false;
        }
    }

    public function get_trial_staff_lunch_total($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('ability_trial_staff')->result_array();
        $lunch = 0;
        if (!empty($res)) {
            for ($i = 0; $i < count($res); $i++) {
                $do_date = explode(",", $res[$i]['do_date']);
                # code...
                $arr[] = array(
                    'job' => '分區管卷人員',
                    'name' => $res[$i]['trial_staff_name'],
                    'one_day_salary' => $res[$i]['salary'] * count($do_date),
                    'salary_total' => $res[$i]['salary_total'] * count($do_date),
                    'lunch_price' => $res[$i]['lunch_price'] * count($do_date),
                    'lunch_total' => $res[$i]['lunch_total'] * count($do_date),
                    'total' => $res[$i]['total'] * count($do_date),
                    'order_meal' => $res[$i]['order_meal']
                );

                $lunch += $res[$i]['lunch_total'];

            }

            return abs($lunch);
        } else {
            return false;
        }
    }

    public function get_patrol_staff_task_money_list($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('ability_patrol_staff')->result_array();
        // print_r($res);
        if (!empty($res)) {
            for ($i = 0; $i < count($res); $i++) {
                $do_date = explode(",", $res[$i]['do_date']);
                # code...
                $arr[] = array(
                    'job' => '分區巡場人員',
                    'name' => $res[$i]['patrol_staff_name'],
                    'one_day_salary' => $res[$i]['salary'],
                    'salary_total' => $res[$i]['salary_total'],
                    'lunch_price' => $res[$i]['lunch_price'] * count($do_date),
                    'lunch_total' => $res[$i]['lunch_total'],
                    'total' => $res[$i]['total'],
                    'order_meal' => $res[$i]['order_meal']
                );

            }

            return $arr;
        } else {
            return false;
        }
    }

    public function get_patrol_staff_task_member_count($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('ability_patrol_staff')->result_array();
        // print_r($res);
        if (!empty($res)) {
            return $res;
        } else {
            return false;
        }
    }

    public function get_patrol_staff_salary_total($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('ability_patrol_staff')->result_array();
        if (!empty($res)) {
            $salary = 0;
            for ($i = 0; $i < count($res); $i++) {
                $do_date = explode(",", $res[$i]['do_date']);

                $salary += $res[$i]['salary_total'];

            }

            return $salary;
        } else {
            return false;
        }
    }

    public function get_patrol_staff_lunch_total($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        $res = $this->db->get('ability_patrol_staff')->result_array();
        if (!empty($res)) {
            $lunch = 0;
            for ($i = 0; $i < count($res); $i++) {
                $do_date = explode(",", $res[$i]['do_date']);

                $lunch += $res[$i]['lunch_total'];

            }

            return abs($lunch);
        } else {
            return false;
        }
    }

    public function odd($var)
    {
        return ($var['year'] == $_SESSION['year']);
    }

    public function get_trial_member_own_count($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();

        function odd($var)
        {
            return ($var['year'] == $_SESSION['year']);
        }

        $sub = array_filter($res, "odd");

        sort($sub);
        $own = 0;
        for ($i = 0; $i < count($sub); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();

            if (strtoupper($sub[$i]['first_member_order_meal']) == "Y") {
                //取的自備午餐人數
                $this->db->where('member_code', $sub[$i]['supervisor_1_code']);
                $this->db->where('meal', '自備');
                $own1 = $this->db->get('ability_staff_member')->row_array();
            }

            if (strtoupper($sub[$i]['second_member_order_meal']) == "Y") {
                $this->db->where('member_code', $sub[$i]['supervisor_2_code']);
                $this->db->where('meal', '自備');
                $own2 = $this->db->get('ability_staff_member')->row_array();
            }
            // $own += count($own1['meal']) + count($own2['meal']);
        }
        return $own;
    }

    public function get_trial_member_veg_count($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();
        $veg = 0;
        for ($i = 0; $i < count($res); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $res[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $res[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();

            //取的自備午餐人數
            $this->db->where('member_code', $res[$i]['supervisor_1_code']);
            $this->db->where('meal', '素');
            $veg1 = $this->db->get('ability_staff_member')->row_array();
            $this->db->where('member_code', $res[$i]['supervisor_2_code']);
            $this->db->where('meal', '素');
            $veg2 = $this->db->get('ability_staff_member')->row_array();

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
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();


        $sub = array_filter($res, "odd");

        sort($sub);

        $meat = 0;
        for ($i = 0; $i < count($res); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $res[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $res[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();

            //取的自備午餐人數
            $this->db->where('member_code', $res[$i]['supervisor_1_code']);
            $this->db->where('meal', '葷');
            $meat1 = $this->db->get('ability_staff_member')->row_array();
            $this->db->where('member_code', $res[$i]['supervisor_2_code']);
            $this->db->where('meal', '葷');
            $meat2 = $this->db->get('ability_staff_member')->row_array();

            $meat += count($meat1['meal']) + count($meat2['meal']);
        }
        return $meat;
    }

    public function get_patrol_member_count_1($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();

        if (!empty($res)) {
            function odd($var)
            {
                return ($var['year'] == $_SESSION['year']);
            }

            $sub = array_filter($res, "odd");

            sort($sub);
            for ($i = 0; $i < count($sub); $i++) {

                $voucher = $this->db->where('part', $part)->where('first_start <=', $sub[$i]['field'])->where('first_end >=', $sub[$i]['field'])->get('ability_trial_staff')->result_array();
                foreach ($voucher as $k => $v) {
                    # code...
                    $arr[$v['trial_staff_code']][] = array(
                        'trial_staff_name' => $v['trial_staff_name'],
                    );
                }
            }
            if (!empty($arr)) {
                return count($arr);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_patrol_member_count_2($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();

        if (!empty($res)) {
            function odd($var)
            {
                return ($var['year'] == $_SESSION['year']);
            }

            $sub = array_filter($res, "odd");

            sort($sub);
            for ($i = 0; $i < count($sub); $i++) {

                $voucher = $this->db->where('part', $part)->where('second_start <=', $sub[$i]['field'])->where('second_end >=', $sub[$i]['field'])->get('ability_trial_staff')->result_array();
                foreach ($voucher as $k => $v) {
                    # code...
                    $arr[$v['trial_staff_code']][] = array(
                        'trial_staff_name' => $v['trial_staff_name'],
                    );
                }
            }
            if (!empty($arr)) {
                return count($arr);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_patrol_member_count_3($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();

        if (!empty($res)) {
            function odd($var)
            {
                return ($var['year'] == $_SESSION['year']);
            }

            $sub = array_filter($res, "odd");

            sort($sub);

            for ($i = 0; $i < count($sub); $i++) {
                $voucher = $this->db->where('part', $part)->where('third_start <=', $sub[$i]['field'])->where('third_end >=', $sub[$i]['field'])->get('ability_trial_staff')->result_array();
                foreach ($voucher as $k => $v) {
                    # code...
                    $arr[$v['trial_staff_code']][] = array(
                        'trial_staff_name' => $v['trial_staff_name'],
                    );
                }
            }
            if (!empty($arr)) {
                return count($arr);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function chk_patrol_member($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();

        function even($var)
        {
            return ($var['year'] == $_SESSION['year']);
        }

        $sub = array_filter($res, "even");

        sort($sub);


        if (!empty($sub)) {
            return true;
        } else {
            return false;
        }
    }

    public function chk_supervisor_list($part)
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $year = $this->session->userdata('year');

        $this->db->where('first_member_do_date !=', "");
        $res = $this->db->get()->result_array();


        function even($var)
        {
            return ($var['year'] == $_SESSION['year']);
        }

        $sub = array_filter($res, "even");

        sort($sub);


        if (!empty($sub)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_supervisor_list($part = '')
    {
        $this->db->select('*');

        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->where("ability_part_info.year", $_SESSION['year']);

        $res = $this->db->get()->result_array();



        for ($i = 0; $i < count($res); $i++) {
            # code...
            $course = $this->db->where('year', $_SESSION['year'])->where('field', $res[$i]['field'])->get('ability_exam_area')->row_array();
            $arr[] = array(
                'sn' => $res[$i]['sn'],
                'field' => $res[$i]['field'],
                'test_section' => $res[$i]['test_section'],
                'part' => $res[$i]['part'],
                'supervisor_code' => $res[$i]['trial_staff_code_1'],
                'supervisor' => $res[$i]['supervisor_1'],
                'do_date' => $res[$i]['first_member_do_date'],
                'floor' => $res[$i]['floor'],
                'subject_01' => $course['subject_01'],
                'subject_02' => $course['subject_02'],
                'subject_03' => $course['subject_03'],
                'subject_04' => $course['subject_04'],
                'subject_05' => $course['subject_05'],
                'subject_06' => $course['subject_06'],
                'subject_07' => $course['subject_07'],
                'subject_08' => $course['subject_08'],
                'subject_09' => $course['subject_09'],
                'subject_10' => $course['subject_10'],
            );

            $arr[] = array(
                'sn' => $res[$i]['sn'],
                'field' => $res[$i]['field'],
                'test_section' => $res[$i]['test_section'],
                'part' => $res[$i]['part'],
                'supervisor_code' => $res[$i]['trial_staff_code_2'],
                'supervisor' => $res[$i]['supervisor_2'],
                'do_date' => $res[$i]['second_member_do_date'],
                'floor' => $res[$i]['floor'],
                'subject_01' => $course['subject_01'],
                'subject_02' => $course['subject_02'],
                'subject_03' => $course['subject_03'],
                'subject_04' => $course['subject_04'],
                'subject_05' => $course['subject_05'],
                'subject_06' => $course['subject_06'],
                'subject_07' => $course['subject_07'],
                'subject_08' => $course['subject_08'],
                'subject_09' => $course['subject_09'],
                'subject_10' => $course['subject_10'],
            );


        }
        return $arr;
    }

    public function get_list_for_obs($part = '', $obs)
    {
        // print_r($obs);
        $this->db->select('*');
        $this->db->where('ability_part_info.year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->like('ability_part_info.field', 19, 'after');
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        $year = $this->session->userdata('year');

        $sub = $this->db->get()->result_array();

        // function even($var)
        // {
        //     return ($var['year'] == $_SESSION['year']);
        // }

        // $sub = array_filter($res, "even");

        sort($sub);
        // print_r($sub);
        if (!empty($sub)) {
            for ($i = 0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('ability_patrol_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('ability_exam_area')->row_array();
                $trial = $this->db->get('ability_trial_staff')->result_array();

                if ($sub[$i]['first_member_section_salary_total'] == "" || $sub[$i]['supervisor_1'] == ' ') {
                    $first_member_section_salary_total = 0;
                    $sub[$i]['first_member_section_lunch_total'] = 0;
                } else {
                    $first_member_section_salary_total = $sub[$i]['first_member_section_salary_total'];
                }
                if ($sub[$i]['second_member_section_salary_total'] == "" || $sub[$i]['supervisor_2'] == ' ') {
                    $second_member_section_salary_total = 0;
                    $sub[$i]['second_member_section_lunch_total'] = 0;
                } else {
                    $second_member_section_salary_total = $sub[$i]['second_member_section_salary_total'];
                }


                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $arr[] = array(
                    'sn' => $sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['test_section'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['first_member_do_date'],
                    'first_member_salary_section' => $first_member_section_salary_total,
                    'first_member_section_salary_total' => $first_member_section_salary_total,
                    'first_member_section_lunch_total' => $sub[$i]['first_member_section_lunch_total'],
                    'first_member_section_total' => $sub[$i]['first_member_section_total'],
                    'order_meal1' => $sub[$i]['first_member_order_meal'],
                    'supervisor_1' => $sub[$i]['supervisor_1'],
                    'supervisor_1_unit' => $supervisor1['member_unit'],
                    'supervisor_1_phone' => $supervisor1['member_phone'],
                    'second_member_salary_section' => $second_member_section_salary_total,
                    'second_member_section_salary_total' => $second_member_section_salary_total,
                    'second_member_section_lunch_total' => $sub[$i]['second_member_section_lunch_total'],
                    'second_member_section_total' => $sub[$i]['second_member_section_total'],
                    'supervisor_2' => $sub[$i]['supervisor_2'],
                    'supervisor_2_unit' => $supervisor2['member_unit'],
                    'supervisor_2_phone' => $supervisor2['member_phone'],
                    'order_meal2' => $sub[$i]['second_member_order_meal'],
                    'floor' => $sub[$i]['floor'],
                    'number' => $sub[$i]['number'],
                    'start' => $sub[$i]['start'],
                    'end' => $sub[$i]['end'],
                    'patrol' => $patrol['patrol_staff_name'],
                    'subject_01' => $course['subject_01'],
                    'subject_02' => $course['subject_02'],
                    'subject_03' => $course['subject_03'],
                    'subject_04' => $course['subject_04'],
                    'subject_05' => $course['subject_05'],
                    'subject_06' => $course['subject_06'],
                    'subject_07' => $course['subject_07'],
                    'subject_08' => $course['subject_08'],
                    'subject_09' => $course['subject_09'],
                    'subject_10' => $course['subject_10'],
                );
            }

            return $arr;
        } else {
            return false;
        }

    }

    public function get_list_for_obs_member_count($part = '', $obs)
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('ability_part_info.part', $part);
        }
        $this->db->where('ability_part_info.year', $_SESSION['year']);
        $this->db->where('ability_trial_assign.supervisor_1 !=', "");
        $this->db->where('ability_trial_assign.supervisor_2 !=', "");
        $this->db->like('ability_part_info.field', $obs);
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        $year = $this->session->userdata('year');

        $sub = $this->db->get()->result_array();
        if (!empty($sub)) {
            return $sub;
        } else {
            return false;
        }
    }

    public function get_trial_list_of_obs_for_csv($part = '', $obs)
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part_info.part', $part);
        }
        $this->db->like('ability_part_info.field', $obs, 'after');
        $this->db->from('ability_part_info');
        $this->db->where("ability_part_info.year", $_SESSION['year']);
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        $year = $this->session->userdata('year');

        $sub = $this->db->get()->result_array();

        if (!empty($sub)) {
            for ($i = 0; $i < count($sub); $i++) {
                # code...
                $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
                $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
                $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('ability_patrol_staff')->row_array();
                $course = $this->db->where('year', $year)->where('field', $sub[$i]['field'])->get('exam_area')->row_array();
                $trial = $this->db->get('ability_trial_staff')->result_array();
                if ($sub[$i]['first_member_section_salary_total'] == "") {
                    $first_member_salary_section = 0;
                } else {
                    $first_member_salary_section = $sub[$i]['first_member_section_salary_total'];
                }
                if ($sub[$i]['second_member_section_salary_total'] == "") {
                    $second_member_salary_section = 0;
                } else {
                    $second_member_salary_section = $sub[$i]['second_member_section_salary_total'];
                }
                $do_date1 = explode(",", $sub[$i]['first_member_do_date']);
                $do_date2 = explode(",", $sub[$i]['second_member_do_date']);
                $arr[] = array(
                    'sn' => $sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['test_section'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['first_member_do_date'],
                    'salary_section' => $first_member_salary_section,
                    'section_lunch_total' => $sub[$i]['first_member_section_lunch_total'],
                    'section_salary_total' => $sub[$i]['first_member_section_total'],
                    'order_meal' => $supervisor1['order_meal'],
                    'supervisor' => $sub[$i]['supervisor_1'],
                );
                $arr[] = array(
                    'sn' => $sub[$i]['sn'],
                    'field' => $sub[$i]['field'],
                    'test_section' => $sub[$i]['test_section'],
                    'part' => $sub[$i]['part'],
                    'do_date' => $sub[$i]['second_member_do_date'],
                    'salary_section' => $second_member_salary_section,
                    'section_lunch_total' => $sub[$i]['second_member_section_lunch_total'],
                    'section_salary_total' => $sub[$i]['second_member_section_total'],
                    'supervisor' => $sub[$i]['supervisor_2'],
                    'order_meal' => $supervisor2['order_meal'],
                );
            }
            return $arr;
        } else {
            return false;
        }
    }

    public function get_list_for_csv()
    {
        // $this->db->where('year', $_SESSION['year']);

        $this->db->select('*');
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');
        // $this->db->where('year', $_SESSION['year']);

        $this->db->where('first_member_do_date !=', "");

        $res = $this->db->get()->result_array();

        function even($var)
        {
            return ($var['year'] == $_SESSION['year']);
        }

        $sub = array_filter($res, "even");

        sort($sub);

        for ($i = 0; $i < count($sub); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $sub[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $sub[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();
            

            // foreach ($res as $k => $v) {
            # code...
            $arr[] = array(
                'year' => $sub[$i]['year'],
                'part_name' => $sub[$i]['part_name'],
                'do_date' => $sub[$i]['first_member_do_date'],
                'member_unit' => $supervisor1['member_unit'],
                'member_name' => $supervisor1['member_name'],
                'member_code' => $supervisor1['member_code'],
                'trial_staff_code' => $sub[$i]['trial_staff_code_1'],
            );
            $arr[] = array(
                'year' => $sub[$i]['year'],
                'part_name' => $sub[$i]['part_name'],
                'do_date' => $sub[$i]['second_member_do_date'],
                'member_unit' => $supervisor2['member_unit'],
                'member_name' => $supervisor2['member_name'],
                'member_code' => $supervisor2['member_code'],
                'trial_staff_code' => $sub[$i]['trial_staff_code_2'],
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
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $res = $this->db->get()->result_array();
        $arr = [];
        for ($i = 0; $i < count($res); $i++) {
            # code...
            $supervisor1 = $this->db->where('member_code', $res[$i]['supervisor_1_code'])->get('ability_staff_member')->row_array();
            $supervisor2 = $this->db->where('member_code', $res[$i]['supervisor_2_code'])->get('ability_staff_member')->row_array();

            // $own1 = array_count_values($supervisor1);
            // $own2 = array_count_values($supervisor2);
            // // $own_count1 = count($own1['自備']);
            // $own += count($own1['自備']) + count($own2['自備']);
            $arr[] = array(
                'field' => $res[$i]['field'],
                'supervisor_1' => $res[$i]['supervisor_1'],
                'trial_staff_code_1' => $res[$i]['trial_staff_code_1'],
                'order_meal_1' => $res[$i]['first_member_meal'],
                'supervisor_2' => $res[$i]['supervisor_2'],
                'trial_staff_code_2' => $res[$i]['trial_staff_code_2'],
                'order_meal_2' => $res[$i]['second_member_meal'],
            );

        }
        // print_r($own);
        return $arr;
    }

    public function get_trial_own_meal_count($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $res = $this->db->get()->result_array();
        $own1 = 0;
        $own2 = 0;
        for ($i = 0; $i < count($res); $i++) {
            # code...

            if ($res[$i]['first_member_meal'] == "自備") {
                $own1 += 1;
            }

            if ($res[$i]['second_member_meal'] == "自備") {
                $own2 += 1;
            }
        }
        $own = $own1 + $own2;
        return $own;
    }

    public function get_trial_veg_meal_count($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $res = $this->db->get()->result_array();
        $veg1 = 0;
        $veg2 = 0;
        for ($i = 0; $i < count($res); $i++) {

            if ($res[$i]['first_member_meal'] == "素") {
                $veg1 += 1;
            }

            if ($res[$i]['second_member_meal'] == "素") {
                $veg2 += 1;
            }
        }
        $veg = $veg1 + $veg2;
        return $veg;
    }

    public function get_trial_meat_meal_count($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('ability_part_info');
        $this->db->join('ability_trial_assign', 'ability_part_info.sn = ability_trial_assign.sn');

        $res = $this->db->get()->result_array();
        $meat1 = 0;
        $meat2 = 0;
        for ($i = 0; $i < count($res); $i++) {

            if ($res[$i]['first_member_meal'] == "葷") {
                $meat1 += 1;
            }

            if ($res[$i]['second_member_meal'] == "葷") {
                $meat2 += 1;
            }
        }
        $meat = $meat1 + $meat2;
        return $meat;
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

        return $this->db->get('ability_trial_staff')->result_array();
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('ability_trial_assign')->row_array();
    }

    public function get_once_trial($sn)
    {
        return $this->db->where('sn', $sn)->get('ability_trial_staff')->row_array();
    }

    public function get_once_trial_by_code($trial_staff_code)
    {
        return $this->db->where('member_code', $trial_staff_code)->get('ability_staff_member')->row_array();
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('ability_trial_assign', $data);


        $res = $this->db->where('sn', $sn)->get('ability_trial_assign')->row_array();
        $person1 = explode(",", $res['first_member_do_date']);
        $person2 = explode(",", $res['second_member_do_date']);




        if ($res['first_member_order_meal'] == 'Y') {
            $p1_lunch = count($person1) * $res['first_member_lunch_price'];
        } else {
            $p1_lunch = 0;
        }
        if ($res['second_member_order_meal'] == 'Y') {
            $p2_lunch = count($person2) * $res['second_member_lunch_price'];
        } else {
            $p2_lunch = 0;
        }


        $update = array(
            'first_member_day_count' => count($person1),
            'first_member_section_lunch_total' => $p1_lunch,
            'second_member_day_count' => count($person2),
            'second_member_section_lunch_total' => $p2_lunch,
        );
        $this->db->update('ability_trial_assign', $update);

        return true;
    }

    public function update_trial($sn, $data)
    {
        $this->load->model('mod_ability_exam_fees');
        $this->db->where('sn', $sn);
        $this->db->update('ability_trial_staff', $data);

        $res = $this->db->where('sn', $sn)->get('ability_trial_staff')->row_array();
        $fees_info = $this->mod_ability_exam_fees->get_once($_SESSION['year']);
        $salary_total = ($data['first_section'] + $data['second_section'] + $data['third_section']) * $fees_info['salary_section'];
        $new = array(
            'salary_total' => $salary_total,
            'total' => $salary_total - $res['lunch_total'],
            'count' => $data['first_section'] + $data['second_section'] + $data['third_section'],
        );
        $this->db->where('sn', $sn);
        $this->db->update('ability_trial_staff', $new);

        return true;
    }

    public function add_once($data)
    {
        $this->db->insert('ability_trial_assign', $data);

        return true;
    }

    public function get_once_assign($sn)
    {
        return $this->db->where('sn', $sn)->get('ability_trial_assign')->row_array();
    }

    public function add_trial($data)
    {
        $this->db->insert('ability_trial_staff', $data);

        return true;
    }

    public function get_min_field($part)
    {
        $this->db->where('part', $part);
        $this->db->order_by('field', 'asc');
        $this->db->select('field');

        return $this->db->get('ability_part_info')->row_array();
    }

    public function get_max_field($part)
    {
        $this->db->where('part', $part);
        $this->db->order_by('field', 'desc');
        $this->db->select('field');

        return $this->db->get('ability_part_info')->row_array();
    }

    public function remove_trial_staff($sn)
    {
        $this->db->where('sn', $sn);
        $this->db->delete('ability_trial_staff');

        return true;
    }

    public function remove_ability_trial_staff()
    {   
        // $this->db->where('year', $this->session->userdata('year'))->truncate('ability_trial_staff');
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->delete('ability_trial_staff');
        // $r=$this->db->last_query('ability_exam_area');
        // print_r($r);
    }
    public function remove_ability_patrol_staff()
    {


        $this->db->where('year', $this->session->userdata('year'));
        $this->db->delete('ability_patrol_staff');
        // $r=$this->db->last_query('ability_exam_area');
        // print_r($r);
    }

    public function chk_all_d($code)
    {


        $code = trim($code);
        // d1
        $this->db->where('year', $_SESSION['year']);
        $this->db->where('supervisor_1_code', $code);
        $count1 = $this->db->count_all_results('ability_trial_assign');
        // print_r($count1);

        // d1
        $this->db->where('year', $_SESSION['year']);
        $this->db->where('supervisor_2_code', $code);
        $count2 = $this->db->count_all_results('ability_trial_assign');
        
        // d2
        $this->db->where('year', $_SESSION['year']);
        $this->db->where('trial_staff_code', $code);
        $count3 = $this->db->count_all_results('ability_trial_staff');

        // d3
        $this->db->where('year', $_SESSION['year']);
        $this->db->where('patrol_staff_code', $code);
        $count4 = $this->db->count_all_results('ability_patrol_staff');

        $count = $count1 + $count2 + $count3 + $count4;
        // print_r($count);
        if ($count == 0) {
            return false;
        } else {
            return true;
        }

    }



}

/* End of file Mod_exam_area.php */