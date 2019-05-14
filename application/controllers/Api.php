<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function login()
    {
        $getpost = array('user_id', 'user_pwd');
        $requred = array('user_id', 'user_pwd');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($this->mod_user->chk_login($data['user_id'], $data['user_pwd'])) {
                $this->mod_user->do_login($data['user_id']);
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '登入完成';
            } else {
                $json_arr['sys_code'] = '500';
                $json_arr['sys_msg'] = '帳密登入失敗';
            }
        }
        echo json_encode($json_arr);
    }

    /**
     * a相關api.
     */
    public function add_school_unit()
    {
        $this->load->model('mod_school_unit');
        $getpost = array('company_name_01', 'company_name_02', 'department', 'code');
        $requred = array('company_name_01', 'company_name_02', 'department', 'code');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $this->mod_school_unit->add_once($data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料新增完成';
        }
        echo json_encode($json_arr);
    }

    public function edit_school_unit()
    {
        $this->load->model('mod_school_unit');
        $getpost = array('sn', 'company_name_01', 'company_name_02', 'department', 'code');
        $requred = array('sn', 'company_name_01', 'company_name_02', 'department', 'code');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $this->mod_school_unit->update_once($data['sn'], $data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料編輯完成';
        }
        echo json_encode($json_arr);
    }

    public function get_once_school_unit()
    {
        $this->load->model('mod_school_unit');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['info'] = $this->mod_school_unit->get_once($data['sn']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    public function remove_once_school_unit()
    {
        $this->load->model('mod_school_unit');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $this->mod_school_unit->remove_once($data['sn']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '刪除成功';
        }
        echo json_encode($json_arr);
    }

    public function add_staff()
    {
        $this->load->model('mod_staff');
        $getpost = array('member_code', 'member_name', 'unit', 'member_unit', 'member_phone', 'member_title', 'order_meal', 'meal');
        $requred = array('member_code', 'member_name', 'unit', 'member_unit', 'member_phone', 'member_title', 'order_meal', 'meal');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if (!$this->mod_staff->chk_once($data['member_code']) == true) {
                $this->mod_staff->add_once($data);
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料新增完成';
            } else {
                $json_arr['sys_code'] = '500';
                $json_arr['sys_msg'] = '職員代碼重複';
            }
        }
        echo json_encode($json_arr);
    }

    public function edit_staff()
    {
        $this->load->model('mod_staff');
        $getpost = array('sn', 'member_code', 'member_name', 'unit', 'member_unit', 'member_phone', 'member_title', 'order_meal', 'meal');
        $requred = array('sn', 'member_code', 'member_name', 'unit', 'member_unit', 'member_phone', 'member_title', 'order_meal', 'meal');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $this->mod_staff->update_once($data['sn'], $data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料編輯完成';
        }
        echo json_encode($json_arr);
    }

    public function get_once_staff()
    {
        $this->load->model('mod_staff');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);

        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['info'] = $this->mod_staff->get_once($data['sn']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    public function remove_once_staff()
    {
        $this->load->model('mod_staff');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $this->mod_staff->remove_once($data['sn']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '刪除成功';
        }
        echo json_encode($json_arr);
    }

    /**
     * b相關api.
     */
    public function add_task()
    {
        $this->load->model('mod_task');
        $getpost = array('area', 'job_code', 'job_title', 'name', 'phone', 'start_date', 'trial_start', 'trial_end', 'note', 'section', 'salary_section', 'lunch_count', 'lunch_fee', 'day_count', 'one_day_salary', 'price', 'lunch_price', 'total');
        $requred = array('area', 'job_code', 'job_title', 'name', 'phone', 'start_date', 'trial_start', 'trial_end', 'section', 'salary_section', 'lunch_count', 'lunch_fee', 'day_count', 'one_day_salary', 'price', 'lunch_price', 'total');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if (!$this->mod_task->chk_once($data['job_code'])) {
                $this->mod_task->add_once($data);
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料新增完成';
            } else {
                $json_arr['sys_code'] = '500';
                $json_arr['sys_msg'] = '職員代碼重複';
            }
        }
        echo json_encode($json_arr);
    }

    public function edit_task()
    {
        $this->load->model('mod_task');
        $getpost = array('sn', 'area', 'job_code', 'job_title', 'name', 'phone', 'trial_start', 'trial_end', 'note', 'day_count', 'one_day_salary', 'salary_total', 'lunch_price', 'lunch_total', 'total', 'do_date');
        $requred = array('sn', 'area', 'job_code', 'job_title', 'name', 'phone', 'day_count', 'one_day_salary', 'salary_total', 'lunch_price', 'lunch_total', 'total', 'do_date');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $this->mod_task->update_once($data['sn'], $data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料編輯完成';
        }
        echo json_encode($json_arr);
    }

    public function get_once_task()
    {
        $this->load->model('mod_task');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['info'] = $this->mod_task->get_once($data['sn']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    public function remove_once_task()
    {
        $this->load->model('mod_task');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $this->mod_task->remove_once($data['sn']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '刪除成功';
        }
        echo json_encode($json_arr);
    }

    public function get_member_info()
    {
        $this->load->model('mod_task');

        $res = $this->mod_task->get_member_info();
        foreach ($res as $key => $value) {
            $json_arr['info'][$key]['id'] = $value['member_code'];
            $json_arr['info'][$key]['name'] = $value['member_code'] . ' - ' . $value['member_name'];
        }
        $json_arr['sys_code'] = '200';
        $json_arr['sys_msg'] = '搜尋成功';

        echo json_encode($json_arr);
    }

    //確定指派
    public function assignment()
    {
        $this->load->model('mod_task');
        $getpost = array('job_code', 'job', 'area');
        $requred = array('job_code', 'job', 'area');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $count = $this->mod_task->check_use_member_job($data['job_code'], $data['area']);
            if ($count > 0) {
                $json_arr['sys_code'] = '000';
                $json_arr['sys_msg'] = '人員已重複指派';
            } else {
                $json_arr['info'] = $this->mod_task->get_once_info($data['job_code']);
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料處理完成';
            }
        }
        echo json_encode($json_arr);
    }

    /**
     * 取消職務.
     */
    public function cancel_job()
    {
        $this->load->model('mod_task');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['job'] = '';
            $this->mod_task->update_once($data['sn'], $data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    /**
     * 新增職務 ＠James.
     */
    public function job_add()
    {
        $this->load->model('mod_task');
        $getpost = array('job', 'area');
        $requred = array('job', 'area');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $year = $this->session->userdata('year');
            $part = $this->mod_task->get_part_for_once($data['area']);

            $this->mod_task->add_job($year, $data['job'], $data['area'], $part['trial_start'], $part['trial_end']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '新增完成';
        }
        echo json_encode($json_arr);
    }

    /**
     * 切換學年度.
     */
    public function ch_year()
    {
        $year = $this->input->get('year');
        if ($year != '') {
            if ($year > 100 && $year < 200) {
                $this->session->set_userdata('year', $year);
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料處理完成';
            } else {
                $json_arr['sys_code'] = '000';
                $json_arr['sys_msg'] = '資料格式有誤請輸入民國年';
            }
        } else {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
        }
        echo json_encode($json_arr);
    }

    //儲存課程
    public function add_act()
    {
        $this->load->model('mod_exam_datetime');
        $getpost = array('year', 'day_1', 'day_2', 'day_3', 'pre_1', 'pre_2', 'pre_3', 'pre_4', 'course_1_start', 'course_1_end', 'course_2_start', 'course_2_end', 'course_3_start', 'course_3_end', 'course_4_start', 'course_4_end');
        $requred = array('year', 'day_1', 'day_2', 'day_3', 'pre_1', 'pre_2', 'pre_3', 'pre_4', 'course_1_start', 'course_1_end', 'course_2_start', 'course_2_end', 'course_3_start', 'course_3_end', 'course_4_start', 'course_4_end');
        $data = $this->getpost->getpost_array($getpost, $requred);
        $year = $this->session->userdata('year');
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($this->mod_exam_datetime->chk_once($year)) {
                $this->mod_exam_datetime->update_once($year, $data);
            } else {
                $this->mod_exam_datetime->add_once($data);
            }
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '儲存成功';
        }
        echo json_encode($json_arr);
    }

    public function add_course()
    {
        $this->load->model('mod_exam_datetime');
        // echo json_encode($_POST);
        $getpost = array('data');
        $requred = array('data');
        $data = $this->getpost->getpost_array($getpost, $requred);

        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $year = $this->session->userdata('year');
            $this->mod_exam_datetime->clean_course($year);
            $this->mod_exam_datetime->setting_course($year, $data['data']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '修改成功';
        }
        echo json_encode($json_arr);
    }

    //儲存價格
    public function add_fee()
    {
        $this->load->model('mod_exam_fees');
        $getpost = array('year', 'one_day_salary', 'salary_section', 'lunch_fee');
        $requred = array('year', 'one_day_salary', 'salary_section', 'lunch_fee');
        $data = $this->getpost->getpost_array($getpost, $requred);
        $year = $this->session->userdata('year');
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($this->mod_exam_fees->chk_once($year)) {
                $this->mod_exam_fees->update_once($year, $data);
            } else {
                $this->mod_exam_fees->add_once($data);
            }
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '儲存成功';
        }
        echo json_encode($json_arr);
    }

    /**
     * C 相關api.
     */
    public function get_once_part()
    {
        $this->load->model('mod_part_info');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['info'] = $this->mod_part_info->get_once($data['sn']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    public function save_part()
    {
        $this->load->model('mod_part_info');
        $getpost = array('sn', 'section', 'addr', 'floor', 'note');
        $requred = array('sn', 'section', 'addr', 'floor');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $this->mod_part_info->update_once($data['sn'], $data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料儲存完成';
        }
        echo json_encode($json_arr);
    }

    public function save_floor()
    {
        $this->load->model('mod_part_info');
        $getpost = array('part', 'start', 'end', 'floor', 'note');
        $requred = array('part', 'start', 'end', 'floor');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $this->mod_part_info->update_floor($data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料儲存完成';
        }
        echo json_encode($json_arr);
    }

    public function save_addr()
    {
        $this->load->model('mod_part_addr');
        $getpost = array('year', 'part_addr_1', 'part_addr_2', 'part_addr_3');
        $requred = array('year', 'part_addr_1', 'part_addr_2', 'part_addr_3');
        $data = $this->getpost->getpost_array($getpost, $requred);
        $year = $this->session->userdata('year');
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($this->mod_part_addr->chk_once($year)) {
                $this->mod_part_addr->update_once($year, $data);
            } else {
                $this->mod_part_addr->add_once($data);
            }
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '儲存成功';
        }
        echo json_encode($json_arr);
    }

    /**
     * D 相關api.
     */
    public function get_part()
    {
        $this->load->model('mod_exam_area');
        $getpost = array('part');
        $requred = array('part');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['part'] = $this->mod_exam_area->get_part($data['part']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    /**
     * 檢查監試人員是否指派過
     */
    function chk_trial_assigned()
    {
        $this->load->model('mod_trial');
        $getpost = array('code');
        $requred = array('code');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($this->mod_trial->chk_trial_assigned($data['code'])) {
                $json_arr['sys_code'] = '500';
                $json_arr['sys_msg'] = '該人員已經被指派過，請選擇其他人員';
            } else {
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = 'success';
            }
            $json_arr['sql'] = $this->db->last_query();
        }
        echo json_encode($json_arr);
    }

    public function save_trial()
    {
        $this->load->model('mod_trial');
        $this->load->model('mod_staff');
        $this->load->model('mod_exam_datetime');
        $this->load->model('mod_exam_fees');
        $this->load->model('mod_part_info');
        $getpost = array('sn', 'part', 'supervisor_1', 'supervisor_1_code', 'supervisor_2', 'supervisor_2_code', 'trial_staff_code_1', 'trial_staff_code_2', 'note', 'field');
        $requred = array('sn', 'part', 'supervisor_1', 'supervisor_1_code', 'supervisor_2', 'supervisor_2_code', 'trial_staff_code_1', 'trial_staff_code_2', 'field');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            if ($this->mod_trial->chk_once($data['sn'])) {
                $member1 = $this->mod_staff->get_staff_member(trim($data['supervisor_1_code']));
                $member2 = $this->mod_staff->get_staff_member(trim($data['supervisor_2_code']));
                $day = $this->mod_exam_datetime->room_use_day($data['field'], $data['field'], $data['part']);
                $datetime_info = $this->mod_exam_datetime->get_once($_SESSION['year']);
                $fees_info = $this->mod_exam_fees->get_once($_SESSION['year']);
                $part_info = $this->mod_part_info->get_once($data['sn']);
                $do_date = array();
                if ($day[0] != "") {
                    array_push($do_date, mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'));
                }
                if ($day[1] != "") {
                    array_push($do_date, mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'));
                }
                if ($day[2] != "") {
                    array_push($do_date, mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'));
                }
                $date = implode(",", $do_date);
                if ($member1['order_meal'] == "N") {
                    $first_lunch_fee = 0;
                    $first_lunch_total = 0;
                    $first_member_salary_total = $part_info['test_section'] * $fees_info['salary_section'];
                    $first_member_total = $first_member_salary_total;
                } else {
                    $first_lunch_fee = $fees_info['lunch_fee'];
                    $first_lunch_total = $fees_info['lunch_fee'] * count($do_date);
                    $first_member_salary_total = $part_info['test_section'] * $fees_info['salary_section'];
                    $first_member_total = $first_member_salary_total - $first_lunch_total;
                }
                if ($member2['order_meal'] == "N") {
                    $second_lunch_fee = 0;
                    $second_lunch_total = 0;
                    $second_member_salary_total = $part_info['test_section'] * $fees_info['salary_section'];
                    $second_member_total = $second_member_salary_total;
                } else {
                    $second_lunch_fee = $fees_info['lunch_fee'];
                    $second_lunch_total = $fees_info['lunch_fee'] * count($do_date);
                    $second_member_salary_total = $part_info['test_section'] * $fees_info['salary_section'];
                    $second_member_total = $second_member_salary_total - $second_lunch_total;
                }
                $sql_data = array(
                    'sn' => $data['sn'],
                    'supervisor_1' => trim($data['supervisor_1']),
                    'supervisor_1_code' => trim($data['supervisor_1_code']),
                    'supervisor_2_code' => trim($data['supervisor_2_code']),
                    'supervisor_2' => trim($data['supervisor_2']),
                    'trial_staff_code_1' => trim($data['trial_staff_code_1']),
                    'trial_staff_code_2' => trim($data['trial_staff_code_2']),
                    'first_member_order_meal' => $member1['order_meal'],
                    'first_member_meal' => $member1['meal'],
                    'second_member_order_meal' => $member2['order_meal'],
                    'second_member_meal' => $member2['meal'],
                    'first_member_do_date' => $date,
                    'second_member_do_date' => $date,
                    'first_member_day_count' => $part_info['test_section'],
                    'second_member_day_count' => $part_info['test_section'],
                    'first_member_salary_section' => $fees_info['salary_section'],
                    'second_member_salary_section' => $fees_info['salary_section'],
                    'first_member_lunch_price' => $fees_info['lunch_fee'],
                    'second_member_lunch_price' => $fees_info['lunch_fee'],
                    'first_member_section_salary_total' => $first_member_salary_total,
                    'second_member_section_salary_total' => $second_member_salary_total,
                    'first_member_section_lunch_total' => $first_lunch_total,
                    'second_member_section_lunch_total' => $second_lunch_total,
                    'first_member_section_total' => $first_member_total,
                    'second_member_section_total' => $second_member_total,
                    'note' => $data['note'],
                );
                $this->mod_trial->update_once($data['sn'], $sql_data);
            } else {
                $json_arr['sys_code'] = '404';
                $json_arr['sys_msg'] = '查無此資料';
            }
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料儲存完成';
        }
        echo json_encode($json_arr);
    }


    //清空指派資料
    public function remove_trial()
    {
        $this->load->model('mod_trial');
        $this->load->model('mod_staff');
        $getpost = array('sn', 'supervisor_1', 'supervisor_1_code', 'supervisor_2', 'supervisor_2_code', 'trial_staff_code_1', 'trial_staff_code_2', 'note', 'first_member_order_meal', 'first_member_meal', 'second_member_order_meal', 'second_member_meal', 'first_member_do_date', 'first_member_day_count', 'first_member_salary_section', 'first_member_section_salary_total', 'first_member_lunch_price', 'first_member_section_lunch_total', 'first_member_section_total', 'second_member_do_date', 'second_member_day_count', 'second_member_salary_section', 'second_member_section_salary_total', 'second_member_lunch_price', 'second_member_section_lunch_total', 'second_member_section_total');
        $requred = array('sn', 'supervisor_1', 'supervisor_1_code', 'supervisor_2', 'supervisor_2_code', 'trial_staff_code_1', 'trial_staff_code_2', 'note', 'first_member_order_meal', 'first_member_meal', 'second_member_order_meal', 'second_member_meal', 'first_member_do_date', 'first_member_day_count', 'first_member_salary_section', 'first_member_section_salary_total', 'first_member_lunch_price', 'first_member_section_lunch_total', 'first_member_section_total', 'second_member_do_date', 'second_member_day_count', 'second_member_salary_section', 'second_member_section_salary_total', 'second_member_lunch_price', 'second_member_section_lunch_total', 'second_member_section_total');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            if ($this->mod_trial->chk_once($data['sn'])) {

                $this->mod_trial->update_once($data['sn'], $data);
            } else {
                $json_arr['sys_code'] = '404';
                $json_arr['sys_msg'] = '查無此資料';
            }
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料刪除完成';
        }
        echo json_encode($json_arr);
    }

    public function save_trial_for_price()
    {
        $this->load->model('mod_trial');
        $getpost = array('sn', 'first_member_do_date', 'second_member_do_date', 'first_member_day_count', 'first_member_salary_section', 'first_member_section_salary_total', 'second_member_day_count', 'second_member_salary_section', 'second_member_section_salary_total');
        $requred = array('sn', 'first_member_do_date', 'second_member_do_date', 'first_member_day_count', 'first_member_salary_section', 'first_member_section_salary_total', 'second_member_day_count', 'second_member_salary_section', 'second_member_section_salary_total');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            // print_r($data);
            $data['year'] = $this->session->userdata('year');
            $this->mod_trial->update_once($data['sn'], $data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料儲存完成';
        }
        echo json_encode($json_arr);
    }

    public function get_max_filed()
    {
        $this->load->model('mod_exam_area');
        $getpost = array('start', 'end');
        $requred = array('start', 'end');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['section'] = $this->mod_exam_area->get_max_filed($data['start'], $data['end']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    //取得每天節數總和
    public function get_day_section()
    {
        $this->load->model('mod_exam_datetime');
        $getpost = array('start', 'end');
        $requred = array('start', 'end');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['section'] = $this->mod_exam_datetime->get_day_section($data['start'], $data['end']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    //取得當天節數
    public function get_once_day_section()
    {
        $this->load->model('mod_exam_datetime');
        $getpost = array('day', 'start', 'end');
        $requred = array('day', 'start', 'end');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['section'] = $this->mod_exam_datetime->get_once_day_section($data['day'], $data['start'], $data['end']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    public function add_trial_staff()
    {
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_fees');
        $getpost = array('part', 'allocation_code', 'trial_staff_code', 'trial_staff_name', 'first_start', 'first_end', 'first_section', 'second_start', 'second_end', 'second_section', 'third_start', 'third_end', 'third_section', 'note', 'do_date');
        $requred = array('part', 'allocation_code', 'trial_staff_code', 'trial_staff_name', 'first_start', 'first_end', 'first_section', 'second_start', 'second_end', 'second_section', 'third_start', 'third_end', 'third_section', 'do_date');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            $member = $this->mod_trial->get_once_trial_by_code($data['trial_staff_code']);
            $do_date = explode(",", $data['do_date']);
            $fees_info = $this->mod_exam_fees->get_once($_SESSION['year']);
            if ($member['order_meal'] == "N") {
                $lunch_price = 0;
                $lunch_total = 0;
                $salary_total = ($data['first_section'] + $data['second_section'] + $data['third_section']) * $fees_info['salary_section'];
                $total = $salary_total;
            } else {
                $lunch_price = $fees_info['lunch_fee'];
                $lunch_total = $lunch_price * count($do_date);
                $salary_total = ($data['first_section'] + $data['second_section'] + $data['third_section']) * $fees_info['salary_section'];
                $total = $salary_total - $lunch_total;
            }
            $sql_data = array(
                'part' => $data['part'],
                'year' => $_SESSION['year'],
                'allocation_code' => $data['allocation_code'],
                'trial_staff_code' => trim($data['trial_staff_code']),
                'trial_staff_name' => trim($data['trial_staff_name']),
                'first_start' => $data['first_start'],
                'first_end' => $data['first_end'],
                'first_section' => $data['first_section'],
                'second_start' => $data['second_start'],
                'second_end' => $data['second_end'],
                'second_section' => $data['second_section'],
                'third_start' => $data['third_start'],
                'third_end' => $data['third_end'],
                'third_section' => $data['third_section'],
                'order_meal' => $member['order_meal'],
                'meal' => $member['meal'],
                'calculation' => 'by_section',
                'do_date' => $data['do_date'],
                'count' => $data['first_section'] + $data['second_section'] + $data['third_section'],
                'salary' => $fees_info['salary_section'],
                'salary_total' => $salary_total,
                'lunch_price' => $fees_info['lunch_fee'],
                'lunch_total' => $lunch_total,
                'total' => $total,
            );
            // print_r($sql_data);
            // if($this->mod_trial->chk_trial_staff_field($data) == true){
            //     $json_arr['sys_code'] = '500';
            //     $json_arr['sys_msg'] = '有重複輸入試場';
            // }else{
            $this->mod_trial->add_trial($sql_data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料新增完成';                
            // }

        }
        echo json_encode($json_arr);
    }

    public function save_trial_staff()
    {

        $this->load->model('mod_trial');
        $getpost = array('sn', 'part', 'allocation_code', 'trial_staff_code', 'trial_staff_name', 'first_start', 'first_end', 'first_section', 'second_start', 'second_end', 'second_section', 'third_start', 'third_end', 'third_section', 'note', 'count');
        $requred = array('sn', 'part', 'allocation_code', 'trial_staff_code', 'trial_staff_name', 'first_start', 'first_end', 'first_section', 'second_start', 'second_end', 'second_section', 'third_start', 'third_end', 'third_section', 'count');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            if ($this->mod_trial->chk_trial($data['sn'])) {
                $this->mod_trial->update_trial($data['sn'], $data);
            } else {
                $this->mod_trial->add_trial($data);
            }
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料儲存完成';
        }
        echo json_encode($json_arr);
    }

    public function remove_trial_staff()
    {
        $this->load->model('mod_trial');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            if ($this->mod_trial->chk_trial($data['sn'])) {
                $this->mod_trial->remove_trial_staff($data['sn']);
            } else {
                $json_arr['sys_code'] = '404';
                $json_arr['sys_msg'] = '查無資料';
            }
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料刪除完成';
        }
        echo json_encode($json_arr);
    }

    public function get_once_assign()
    {
        $this->load->model('mod_trial');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['info'] = $this->mod_trial->get_once_assign($data['sn']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    public function get_once_trial()
    {
        $this->load->model('mod_trial');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['info'] = $this->mod_trial->get_once_trial($data['sn']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    public function get_field_start_end()
    {
        $this->load->model('mod_part');
        $this->load->model('mod_trial');
        $getpost = array('part');
        $requred = array('part');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['max'] = $this->mod_trial->get_max_field($data['part']);
            $json_arr['min'] = $this->mod_trial->get_min_field($data['part']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    public function add_patrol_staff()
    {
        $this->load->model('mod_patrol');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_datetime');
        $this->load->model('mod_exam_fees');
        $this->load->model('mod_part_info');
        $this->load->model('mod_staff');
        $getpost = array('part', 'allocation_code', 'patrol_staff_code', 'patrol_staff_name', 'start', 'end', 'section', 'note');
        $requred = array('part', 'allocation_code', 'patrol_staff_code', 'patrol_staff_name', 'start', 'end', 'section');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            $day = $this->mod_exam_datetime->room_use_day($data['start'], $data['end'], $data['part']);
            $datetime_info = $this->mod_exam_datetime->get_once($_SESSION['year']);
            $fees_info = $this->mod_exam_fees->get_once($_SESSION['year']);
            $member = $this->mod_staff->get_staff_member(trim($data['patrol_staff_code']));
            $do_date = array();
            if ($day[0] != "") {
                array_push($do_date, mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'));
            }
            if ($day[1] != "") {
                array_push($do_date, mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'));
            }
            if ($day[2] != "") {
                array_push($do_date, mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'));
            }
            $date = implode(",", $do_date);
            if ($member['order_meal'] == "N") {
                $lunch_price = 0;
                $lunch_total = 0;
                $salary_total = $fees_info['salary_section'] * $data['section'];
                $total = $salary_total;
            } else {
                $lunch_price = $fees_info['lunch_fee'];
                $lunch_total = $fees_info['lunch_fee'] * count($do_date);
                $salary_total = $fees_info['salary_section'] * $data['section'];
                $total = $salary_total - $lunch_total;
            }
            $data = array(
                'part' => $data['part'],
                'year' => $_SESSION['year'],
                'allocation_code' => $data['allocation_code'],
                'patrol_staff_code' => trim($data['patrol_staff_code']),
                'patrol_staff_name' => trim($data['patrol_staff_name']),
                'start' => $data['start'],
                'end' => $data['end'],
                'section' => $data['section'],
                'note' => $data['note'],
                'do_date' => $date,
                'calculation' => 'by_section',
                'count' => count($do_date),
                'salary' => $fees_info['salary_section'],
                'salary_total' => $salary_total,
                'lunch_price' => $fees_info['lunch_fee'],
                'lunch_total' => $lunch_total,
                'total' => $total,
                'order_meal' => $member['order_meal'],
                'meal' => $member['meal'],
            );
            $this->mod_patrol->add_once($data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料儲存完成';
        }
        echo json_encode($json_arr);
    }

    public function save_patrol_staff()
    {
        $this->load->model('mod_patrol');
        $getpost = array('sn', 'part', 'allocation_code', 'patrol_staff_code', 'patrol_staff_name', 'start', 'end', 'section', 'note');
        $requred = array('sn', 'part', 'allocation_code', 'patrol_staff_name', 'start', 'end', 'section');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            $this->mod_patrol->update_once($data['sn'], $data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料儲存完成';
        }
        echo json_encode($json_arr);
    }

    public function remove_patrol_staff()
    {
        $this->load->model('mod_patrol');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            $this->mod_patrol->remove_patrol_staff($data['sn'], $data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料刪除完成';
        }
        echo json_encode($json_arr);
    }


    public function get_once_patrol()
    {
        $this->load->model('mod_patrol');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['info'] = $this->mod_patrol->get_once($data['sn']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    public function get_patrol_list()
    {
        $this->load->model('mod_patrol');
        $getpost = array('part');
        $requred = array('part');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['info'] = $this->mod_patrol->get_patrol_list($data['part']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    public function get_staff_member()
    {
        $this->load->model('mod_staff');
        $getpost = array('code');
        $requred = array('code');
        $data = $this->getpost->getpost_array($getpost, $requred);

        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['info'] = $this->mod_staff->get_staff_member($data['code']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    public function save_trial_staff_for_list()
    {
        $this->load->model('mod_trial');
        $this->load->model('mod_staff');
        $this->load->model('mod_task');
        $getpost = array('sn', 'calculation', 'do_date', 'count', 'salary', 'salary_total', 'total', 'note');
        $requred = array('sn', 'calculation', 'do_date', 'count', 'salary', 'salary_total', 'total');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            $this->mod_trial->update_trial($data['sn'], $data);

            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料修改完成';
        }
        echo json_encode($json_arr);
    }

    public function save_patrol_staff_for_list()
    {
        $this->load->model('mod_patrol');
        $this->load->model('mod_staff');
        $this->load->model('mod_task');
        $getpost = array('sn', 'calculation', 'do_date', 'count', 'salary', 'salary_total', 'lunch_price', 'lunch_total', 'total', 'order_meal', 'meal');
        $requred = array('sn', 'calculation', 'do_date', 'count', 'salary', 'salary_total', 'lunch_price', 'lunch_total', 'total', 'order_meal', 'meal');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            $this->mod_patrol->update_once($data['sn'], $data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料修改完成';
        }
        echo json_encode($json_arr);
    }

    public function room_use_day()
    {
        $this->load->model('mod_exam_datetime');
        $getpost = array('start', 'end', 'part');
        $requred = array('start', 'end', 'part');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            $json_arr['day'] = $res = $this->mod_exam_datetime->room_use_day($data['start'], $data['end'], $data['part']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '日期取得完成';
        }
        echo json_encode($json_arr);
    }

    public function chk_part_list()
    {
        $this->load->model('mod_trial');
        $getpost = array('part', 'area');
        $requred = array('part', 'area');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($this->mod_trial->chk_part_list($data['part'], $data['area']) == true) {
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '匯出完成';
            } else {
                $json_arr['sys_code'] = '404';
                $json_arr['sys_msg'] = '查無此資料，請確認是否有資料';
                $json_arr['sys_sql'] = $this->db->last_query();
            }
        }
        echo json_encode($json_arr);
    }

    public function chk_list_for_voucher()
    {
        $this->load->model('mod_trial');
        $getpost = array('part');
        $requred = array('part');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($this->mod_trial->chk_list_for_voucher($data['part']) == true) {
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '匯出完成';
            } else {
                $json_arr['sys_code'] = '404';
                $json_arr['sys_msg'] = '查無此資料，請確認是否有資料';
            }
        }
        echo json_encode($json_arr);
    }

    public function chk_task_list()
    {
        $this->load->model('mod_task');
        $getpost = array('area');
        $requred = array('area');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($this->mod_task->chk_task_list($data['area']) == true) {
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '匯出完成';
            } else {
                $json_arr['sys_code'] = '404';
                $json_arr['sys_msg'] = '查無此資料，請確認是否有資料';
            }
        }
        echo json_encode($json_arr);
    }


    public function chk_trial_staff_task_list()
    {
        $this->load->model('mod_trial');
        $getpost = array('part');
        $requred = array('part');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($this->mod_trial->chk_trial_staff_task_list($data['part']) == true) {
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '匯出完成';
            } else {
                $json_arr['sys_code'] = '404';
                $json_arr['sys_msg'] = '查無此資料，請確認是否有資料';
            }
        }
        echo json_encode($json_arr);
    }

    public function chk_patrol_staff_task_list()
    {
        $this->load->model('mod_trial');
        $getpost = array('part');
        $requred = array('part');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($this->mod_trial->chk_patrol_staff_task_list($data['part']) == true) {
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '匯出完成';
            } else {
                $json_arr['sys_code'] = '404';
                $json_arr['sys_msg'] = '查無此資料，請確認是否有資料';
            }
        }
        echo json_encode($json_arr);
    }

    public function chk_supervisor_list()
    {
        $this->load->model('mod_trial');
        $getpost = array('part');
        $requred = array('part');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($this->mod_trial->chk_supervisor_list($data['part']) == true) {
                if ($this->mod_trial->chk_patrol_member($data['part']) == true) {
                    $json_arr['sys_code'] = '200';
                    $json_arr['sys_msg'] = '匯出完成';
                } else {
                    $json_arr['sys_code'] = '404';
                    $json_arr['sys_msg'] = '查無此資料，請確認是否管卷人員是否有資料';
                }
            } else {
                $json_arr['sys_code'] = '404';
                $json_arr['sys_msg'] = '查無此資料，請確認是否有資料';
            }
        }
        echo json_encode($json_arr);
    }

    public function chk_part_list_of_obs()
    {
        $this->load->model('mod_trial');
        $getpost = array('part', 'area', 'obs');
        $requred = array('part', 'area', 'obs');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($this->mod_trial->chk_part_list_of_obs($data['part'], $data['area'], $data['obs']) == true) {
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '匯出完成';
            } else {
                $json_arr['sys_code'] = '404';
                $json_arr['sys_msg'] = '查無此資料，請重新輸入';
            }
        }
        echo json_encode($json_arr);
    }
}
/* End of file Api.php */