<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    /**
     * 切換學年度. 和梯次
     */
    public function ch_year()
    {
        $getpost = array('year','ladder');
        $requred = array('year','ladder');
        
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($data['year'] > 100 && $data['year'] < 200) {
                if($data['ladder'] == "第一次" || $data['ladder'] == "第二次"){
                    $this->session->set_userdata('year', $data['year']);
                    $this->session->set_userdata('ladder', $data['ladder']);
                    $json_arr['sys_code'] = '200';
                    $json_arr['sys_msg'] = '資料處理完成';
                    $json_arr['data'] = $this->session->userdata();
                }else{
                    $json_arr['sys_code'] = '000';
                    $json_arr['sys_msg'] = '資料格式有誤';
                }
            } else {
                $json_arr['sys_code'] = '000';
                $json_arr['sys_msg'] = '資料格式有誤';
            }
        }
        echo json_encode($json_arr);
    }


    /**
     * 匯入考場資料
     */
    function import_test_area(){
        
        $this->load->model('mod_voice_area');
        if (isset($_FILES['file'])) { 
            $file = $_FILES['file']['tmp_name'];
            $file_name = './tmp/'.time().'.csv';
            copy($file, $file_name);
            $file = fopen($file_name, 'r');
            $row = 0;
            $i = 0;
            while (!feof($file)) {
                $data = fgetcsv($file);
                if($row > 0 && $data != false){
                    
                    $datas[$i]['year'] = $this->session->userdata('year');
                    $datas[$i]['ladder'] = $this->session->userdata('ladder');
                    $datas[$i]['area_id'] = $data[0];
                    $datas[$i]['area_name'] = $data[1];
                    $datas[$i]['class'] = $data[2];
                    $datas[$i]['block_name'] = $data[3];
                    $datas[$i]['class_room'] = $data[4];
                    $datas[$i]['start_num'] = $data[5];
                    $datas[$i]['end_num'] = $data[6];
                    $datas[$i]['count_num'] = $data[7];
                    $i = $i + 1;
                }
                $row = $row+1;
            }
            $this->mod_voice_area->clean_voice_area_main();
            $this->mod_voice_area->insert_batch($datas);
            
            fclose($file);
            unlink($file_name);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料上傳完成';
            $json_arr['datas'] = $datas;
            
        }else{
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料上傳錯誤';
            
        }
        echo json_encode($json_arr);
    }

    /**
     * 匯入工作人員資料
     */
    function import_staff_member()
    {
        $this->load->model("mod_voice_staff");
        if (isset($_FILES['file'])) { 
            $file = $_FILES['file']['tmp_name'];
            $file_name = './tmp/'.time().'.csv';
            copy($file, $file_name);
            $file = fopen($file_name, 'r');
            $row = 0;
            $i = 0;
            while (!feof($file)) {
                $data = fgetcsv($file);
                if($row > 0 && $data != false){

                    $datas[$i]['year'] = $this->session->userdata('year');
                    $datas[$i]['ladder'] = $this->session->userdata('ladder');
                    $datas[$i]['member_code'] =  $data[0];
                    $datas[$i]['member_name'] = $data[1];
                    $datas[$i]['unit'] = $data[2];
                    $datas[$i]['member_unit'] = $data[3];
                    $datas[$i]['member_title'] = $data[4];
                    $datas[$i]['member_phone'] =  $data[5];
                    $i = $i + 1;
                }
                $row = $row+1;
            }
            // $this->mod_voice_area->clean_voice_area_main();
            $this->mod_voice_staff->insert_job($datas);
            
            fclose($file);
            unlink($file_name);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料上傳完成';
            $json_arr['datas'] = $datas;
            
        }else{
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料上傳錯誤';
            
        }
        echo json_encode($json_arr);

    }
    /**
     * 取得個人工作人員資料
     */
     function voice_get_once_staff()
    {
        $this->load->model('mod_voice_staff');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);

        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['info'] = $this->mod_voice_staff->voice_get_once($data['sn']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }
      /**
     * 新增個人工作人員資料
     */
    public function voice_add_staff()
    {
        $this->load->model('mod_voice_staff');
        $getpost = array('member_code', 'member_name', 'unit','member_unit', 'member_phone', 'member_title');
        $requred = array('member_code', 'member_name', 'unit','member_unit', 'member_phone', 'member_title');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if (!$this->mod_voice_staff->voice_chk_once($data['member_code']) == true) {
                $this->mod_voice_staff->voice_add_once($data);
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料新增完成';
            } else {
                $json_arr['sys_code'] = '500';
                $json_arr['sys_msg'] = '職員代碼重複';
            }
        }
        echo json_encode($json_arr);
    }

      /**
     * 修改個人工作人員資料
     */
    public function voice_edit_staff()
    {
        $this->load->model('mod_voice_staff');
        $getpost = array('sn', 'member_code', 'member_name', 'unit','member_unit', 'member_phone', 'member_title');
        $requred = array('sn', 'member_code', 'member_name', 'unit','member_unit', 'member_phone', 'member_title' );
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $this->mod_voice_staff->voice_update_once($data['sn'], $data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料編輯完成';
        }
        echo json_encode($json_arr);
    }
    /**
     * 刪除個人工作人員資料
     */
    public function remove_once_staff()
    {
        $this->load->model('mod_voice_staff');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $this->mod_voice_staff->voice_remove_once($data['sn']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '刪除成功';
        }
        echo json_encode($json_arr);
    }
    /**
    a4 上傳資料
    
    */

    public function import_position(){

        $this->load->model('mod_voice_job_list');

      if (isset($_FILES['file'])) { 
            $file = $_FILES['file']['tmp_name'];
            $file_name = './tmp/'.time().'.csv';
            copy($file, $file_name);
            $file = fopen($file_name, 'r');
            $row = 0;
            $i = 0;
            $datas = array();
            while (!feof($file)) {
                $data = fgetcsv($file);
                if($row > 0 && $data != false){
                   
                    $datas[$i]['year'] = $this->session->userdata('year');
                    $datas[$i]['ladder'] = $this->session->userdata('ladder');
                    $datas[$i]['area'] = $data[0];
                    $datas[$i]['job'] = $data[1];
                    $datas[$i]['test_partition'] = $this->input->post('test_partition');
                
                    $i = $i + 1;
                }
                $row = $row+1;
            }
    //         // $this->mod_voice_area->clean_voice_area_main();
            $this->mod_voice_job_list->insert_member($datas);
    
            fclose($file);
            unlink($file_name);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料上傳完成';
            $json_arr['datas'] = $datas;
            echo json_encode($json_arr);
        }else{
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料上傳錯誤';
        }
       
    }


    /* 
    f 頁  考試日期修改
    */
    public function save_datetime()
    {
        $this->load->model('mod_voice_exam_datetime');
        $getpost = array('year','day','pre_1','pre_2','course_1_start','course_1_end','course_2_start','course_2_end');
        $requred = array('year','day','pre_1','pre_2','course_1_start','course_1_end','course_2_start','course_2_end');
        $data = $this->getpost->getpost_array($getpost,$requred);
        $year = $this->session->userdata('year');
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
            
        }else{
            if($this->mod_voice_exam_datetime->chk_once($year)){
                $this->mod_voice_exam_datetime->update_once($year,$data);
            }else{
                $this->mod_voice_exam_datetime->add_once($data);
            }
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '儲存成功';
            
        }
        echo json_encode($json_arr);


    }
    
    /** 
    f2頁 考試科目
    */
    public function save_subject()
    {
        $this->load->model('mod_voice_subject');
        $getpost = array('year','ladder','subject_1','subject_2');
        $requred = array('year','ladder','subject_1','subject_2');
        $data = $this->getpost->getpost_array($getpost,$requred);
        $year = $this->session->userdata('year');
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);

        }else{
            if($this->mod_voice_subject->chk_once($year)){
                $this->mod_voice_subject->update_once($year,$data);
            }else{
                $this->mod_voice_subject->add_once($data);
            }
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '儲存成功';


        }
        echo json_encode($json_arr);


    }
     /** 
    f4頁 考科費用
    */
    public function save_pay()
    {
        $this->load->model('mod_voice_test_pay');
        $getpost = array('year','ladder','pay_1','pay_2');
        $requred = array('year','ladder','pay_1','pay_2');
        $data = $this->getpost->getpost_array($getpost,$requred);
        $year = $this->session->userdata('year');
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);

        }else{
            if($this->mod_voice_test_pay->chk_once($year)){
                $this->mod_voice_test_pay->update_once($year,$data);
            }else{
                $this->mod_voice_test_pay->add_once($data);
            }
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '儲存成功';


        }
        echo json_encode($json_arr);


    }


}

/* End of file Api.php */
