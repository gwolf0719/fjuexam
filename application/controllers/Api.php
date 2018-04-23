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
            $this->mod_staff->add_once($data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料新增完成';
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
}

/* End of file Api.php */
