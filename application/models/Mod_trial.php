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

    public function get_list_for_pdf($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('part_info');
        $this->db->join('trial_assign', 'part_info.sn = trial_assign.sn');
        
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
            $patrol = $this->db->where('start <=', $sub[$i]['start'])->where('end >=', $sub[$i]['end'])->get('patrol_staff')->row_array();

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

            $arr[] = array(
                'field' => $res[$i]['field'],
                'supervisor_1'=>$res[$i]['supervisor_1'],
                'supervisor_1_code' => $res[$i]['supervisor_1_code'],
                'order_meal_1' => $supervisor1['meal'],
                'supervisor_2' => $res[$i]['supervisor_2'],
                'supervisor_2_code' => $res[$i]['supervisor_2_code'],
                'order_meal_2' => $supervisor2['meal']
            );
        }
        return $arr;
    }

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
