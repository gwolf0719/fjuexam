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
        $getpost = array('member_code', 'member_name', 'member_unit', 'member_phone', 'member_title', 'order_meal', 'meal');
        $requred = array('member_code', 'member_name', 'member_unit', 'member_phone', 'member_title', 'order_meal', 'meal');
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
        $getpost = array('sn', 'member_code', 'member_name', 'member_unit', 'member_phone', 'member_title', 'order_meal', 'meal');
        $requred = array('sn', 'member_code', 'member_name', 'member_unit', 'member_phone', 'member_title', 'order_meal', 'meal');
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
        $getpost = array('sn', 'area', 'job_code', 'job_title', 'name', 'phone', 'trial_start', 'trial_end', 'note', 'day_count', 'one_day_salary', 'salary_total', 'lunch_price', 'lunch_total', 'total', 'order_meal', 'do_date');
        $requred = array('sn', 'area', 'job_code', 'job_title', 'name', 'phone', 'trial_start', 'trial_end', 'day_count', 'one_day_salary', 'salary_total', 'lunch_price', 'lunch_total', 'total', 'order_meal', 'do_date');
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
            // $json_arr['info'][$key]['sn'] = $value['sn'];
            $json_arr['info'][$key]['id'] = $value['member_code'];
            $json_arr['info'][$key]['name'] = $value['member_code'].' - '.$value['member_name'];
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
            if (!$this->mod_task->chk_once($data['job_code'])) {
                $json_arr['info'] = $this->mod_task->get_once_info($data['job_code']);
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料處理完成';
            } else {
                $json_arr['sys_code'] = '500';
                $json_arr['sys_msg'] = '該職員已經有指派職務';
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
            if (!$this->mod_task->chk_job($data['job'], $data['area'])) {
                $year = $this->session->userdata('year');
                $this->mod_task->add_job($year, $data['job'], $data['area']);
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '新增完成';
            } else {
                $json_arr['sys_code'] = '500';
                $json_arr['sys_msg'] = '名稱重複';
            }
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
            $json_arr['sys_msg'] = 'Success';
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

    public function save_trial()
    {
        $this->load->model('mod_trial');
        $getpost = array('sn', 'supervisor_1', 'supervisor_1_code', 'supervisor_2', 'supervisor_2_code', 'trial_staff_code_1', 'trial_staff_code_2', 'note');
        $requred = array('sn', 'supervisor_1', 'supervisor_1_code', 'supervisor_2', 'supervisor_2_code', 'trial_staff_code_1', 'trial_staff_code_2');
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
                $this->mod_trial->add_once($data);
            }
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料儲存完成';
        }
        echo json_encode($json_arr);
    }

    public function save_trial_for_price()
    {
        $this->load->model('mod_trial');
        $getpost = array('sn', 'first_member_day_count', 'first_member_one_day_salary', 'first_member_day_salary_total', 'first_member_lunch_price', 'first_member_day_lunch_total', 'first_member_day_total', 'second_member_day_count', 'second_member_one_day_salary', 'second_member_day_salary_total', 'second_member_lunch_price', 'second_member_day_lunch_total', 'second_member_day_total');
        $requred = array('sn', 'first_member_day_count', 'first_member_one_day_salary', 'first_member_day_salary_total', 'first_member_lunch_price', 'first_member_day_lunch_total', 'first_member_day_total', 'second_member_day_count', 'second_member_one_day_salary', 'second_member_day_salary_total', 'second_member_lunch_price', 'second_member_day_lunch_total', 'second_member_day_total');
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
                $this->mod_trial->add_once($data);
            }
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

    public function add_trial_staff()
    {
        $this->load->model('mod_trial');
        $getpost = array('part', 'allocation_code', 'trial_staff_code', 'trial_staff_name', 'first_start', 'first_end', 'first_section', 'second_start', 'second_end', 'second_section', 'third_start', 'third_end', 'third_section', 'note');
        $requred = array('part', 'allocation_code', 'trial_staff_code', 'trial_staff_name', 'first_start', 'first_end', 'first_section', 'second_start', 'second_end', 'second_section', 'third_start', 'third_end', 'third_section');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            $this->mod_trial->add_trial($data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料儲存完成';
        }
        echo json_encode($json_arr);
    }

    public function save_trial_staff()
    {
        $this->load->model('mod_trial');
        $getpost = array('sn', 'part', 'allocation_code', 'trial_staff_code', 'trial_staff_name', 'first_start', 'first_end', 'first_section', 'second_start', 'second_end', 'second_section', 'third_start', 'third_end', 'third_section', 'note', 'order_meal');
        $requred = array('sn', 'part', 'allocation_code', 'trial_staff_code', 'trial_staff_name', 'first_start', 'first_end', 'first_section', 'second_start', 'second_end', 'second_section', 'third_start', 'third_end', 'third_section', 'order_meal');
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
        $getpost = array('part', 'allocation_code', 'patrol_staff_code', 'patrol_staff_name', 'start', 'end', 'section', 'note');
        $requred = array('part', 'allocation_code', 'patrol_staff_code', 'patrol_staff_name', 'start', 'end', 'section');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
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
        $getpost = array('sn', 'calculation', 'do_date', 'count', 'salary', 'salary_total', 'lunch_price', 'lunch_total', 'total', 'note', 'order_meal');
        $requred = array('sn', 'calculation', 'count', 'salary', 'salary_total', 'lunch_price', 'lunch_total', 'total', 'order_meal');
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
        $getpost = array('sn', 'calculation', 'do_date', 'count', 'salary', 'salary_total', 'lunch_price', 'lunch_total', 'total', 'order_meal');
        $requred = array('sn', 'calculation', 'count', 'salary', 'salary_total', 'lunch_price', 'lunch_total', 'total', 'order_meal');
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
        $getpost = array('start', 'end');
        $requred = array('start', 'end');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            $json_arr['day'] = $res = $this->mod_exam_datetime->room_use_day($data['start'], $data['end']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '日期取得完成';
        }
        echo json_encode($json_arr);
    }
}
/* End of file Api.php */
