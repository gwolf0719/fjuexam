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
     *  a1 匯入考場資料 
     */
    function import_test_area(){

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_area');
        $this->load->model('mod_voice_exam_area');
       
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
                    $datas[$i]['part'] = $data[0];
                    $datas[$i]['area_name'] = $data[1];
                    $datas[$i]['class'] = '1';
                    $datas[$i]['block_name'] = $data[2];
                    $datas[$i]['field'] = $data[3];
                    $datas[$i]['start'] = $data[4];
                    $datas[$i]['end'] = $data[5];
                    $datas[$i]['count_num'] = $data[6];
                    $datas[$i]['subject_01'] = '';
                    $datas[$i]['air_test_field'] = '';
                    $i = $i + 1;
                   

                    $datas_trial[] = array(
                        'year' => $this->session->userdata('year'),
                        'ladder'=>$this->session->userdata('ladder'),
                        'part'=>$data[0],
                        'field'=>$data[3],
                        'block_name'=>$data[2],
                        'supervisor_1' => '',
                        'supervisor_1_code' => '',
                        'supervisor_2' => '',
                        'supervisor_2_code' => '',
                        'trial_staff_code_1' => '',
                        'trial_staff_code_2' => '',
                        'first_member_do_date' => '',
                        'first_member_day_count' => '',
                        'first_member_salary_section' => '',
                        'first_member_section_salary_total' => '',
                        'first_member_section_total' => '',
                        'second_member_do_date' => '',
                        'second_member_day_count' => '',
                        'second_member_salary_section' => '',
                        'second_member_section_salary_total' => '',
                        'second_member_section_total' => '',
                        'note' => '',
                    );

                }
                $row = $row+1;
               
                
            }
           
            $this->mod_voice_area->insert_batch($datas);
            $this->mod_voice_exam_area->import($datas);
            $this->mod_voice_trial->import($datas_trial);

            
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
    *a4 上傳資料
    
    */

    // 職務匯入
    // 2018-12-17@James 移除 area 欄位（由test_partition共用取代
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
                    $datas[$i]['job'] = $data[0];
                    $datas[$i]['test_partition'] = $this->input->post('test_partition');
                    $i = $i + 1;
                }
                $row = $row+1;
            }
            
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
    
    /**
     * 取消職務.
     */
     public function cancel_job()
     {
         $this->load->model('mod_voice_job_list');
         $getpost = array('sn');
         $requred = array('sn');
         $data = $this->getpost->getpost_array($getpost, $requred);
         if ($data == false) {
             $json_arr['sys_code'] = '000';
             $json_arr['sys_msg'] = '資料不足';
             $json_arr['requred'] = $this->getpost->report_requred($requred);
         } else {
             $data['job'] = '';
             $this->mod_voice_job_list->update_once($data['sn'], $data);
             $json_arr['sys_code'] = '200';
             $json_arr['sys_msg'] = '資料處理完成';
         }
         echo json_encode($json_arr);
     }
     /**
        刪除職務
     */
     public function remove_once_task()
     {
         $this->load->model('mod_voice_job_list');
         $getpost = array('sn');
         $requred = array('sn');
         $data = $this->getpost->getpost_array($getpost, $requred);
         if ($data == false) {
             $json_arr['sys_code'] = '000';
             $json_arr['sys_msg'] = '資料不足';
             $json_arr['requred'] = $this->getpost->report_requred($requred);
         } else {
             $this->mod_voice_job_list->remove_once($data['sn']);
             $json_arr['sys_code'] = '200';
             $json_arr['sys_msg'] = '刪除成功';
         }
         echo json_encode($json_arr);
     }

     /**
     * b1新增職務 
     */
     public function job_add()
     {
         $this->load->model('mod_voice_job_list');
         $getpost = array('job', 'test_partition');
         $requred = array('job', 'test_partition');
         $data = $this->getpost->getpost_array($getpost, $requred);
         if ($data == false) {
             $json_arr['sys_code'] = '000';
             $json_arr['sys_msg'] = '資料不足';
             $json_arr['requred'] = $this->getpost->report_requred($requred);
         } else {
             $year = $this->session->userdata('year');
             $ladder = $this->session->userdata('ladder');
             $part = $this->mod_voice_job_list->get_part_for_once($data['test_partition']);
             $this->mod_voice_job_list->add_job($data['test_partition'], $data['job'], $part['trial_start'], $part['trial_end']);
             $json_arr['sys_code'] = '200';
             $json_arr['sys_msg'] = '新增完成';
         }
         echo json_encode($json_arr);
     }
     function get_job_once(){
        $this->load->model('mod_voice_job_list');
         $getpost = array('sn');
         $requred = array('sn');
         $data = $this->getpost->getpost_array($getpost, $requred);
         if ($data == false) {
             $json_arr['sys_code'] = '000';
             $json_arr['sys_msg'] = '資料不足';
             $json_arr['requred'] = $this->getpost->report_requred($requred);
         } else {
             $json_arr['info'] = $this->mod_voice_job_list->get_once($data['sn']);
             $json_arr['sys_code'] = '200';
             $json_arr['sys_msg'] = 'success';
         }
         echo json_encode($json_arr);
     }
    

     public function get_once_task()
     {
         $this->load->model('mod_voice_job_list');
         $getpost = array('sn');
         $requred = array('sn');
         $data = $this->getpost->getpost_array($getpost, $requred);
         if ($data == false) {
             $json_arr['sys_code'] = '000';
             $json_arr['sys_msg'] = '資料不足';
             $json_arr['requred'] = $this->getpost->report_requred($requred);
         } else {
             $json_arr['info'] = $this->mod_voice_job_list->get_once($data['sn']);
             $json_arr['sys_code'] = '200';
             $json_arr['sys_msg'] = '資料處理完成';
         }
         echo json_encode($json_arr);
     }

     public function get_member_info()
     {
         $this->load->model('mod_voice_job_list');
 
         $res = $this->mod_voice_job_list->get_member_info();
         
         foreach ($res as $key => $value) {
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
        $this->load->model('mod_voice_job_list');
        $getpost = array('job_code', 'job', 'area');
        $requred = array('job_code', 'job', 'area');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['info'] = $this->mod_voice_job_list->get_once_info($data['job_code']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

     /**
    * 檢查監試人員是否指派過
    */
    public function chk_trial_assigned(){
        $this->load->model('mod_voice_trial');
        $getpost = array('code');
        $requred = array('code');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if($this->mod_voice_trial->chk_trial_assigned($data['code'])){
                $json_arr['sys_code'] = '500';
                $json_arr['sys_msg'] = '該人員已經被指派過，請選擇其他人員';
            }else{
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = 'success';
            }
            $json_arr['sql'] = $this->db->last_query();
        }
        echo json_encode($json_arr);
    }
    
    public function voice_edit_task()
    {
        $this->load->model('mod_voice_job_list');
        $this->load->model('mod_voice_trial');
        $getpost = array('sn', 'job_code', 'job_title', 'name', 'phone',  'note', 'day_count', 'one_day_salary', 'salary_total', 'total', 'do_date');
        $requred = array('sn',  'job_code', 'job_title', 'name', 'phone',  'day_count', 'one_day_salary', 'salary_total', 'total', 'do_date');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            // 確認有沒有換人
            $job = $this->mod_voice_job_list->get_once($data['sn']);
            if($job['job_code'] == $data['job_code']){
                $this->mod_voice_job_list->update_once($data['sn'], $data);
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料編輯完成';
            }else{
                // 確認重複
                if($this->mod_voice_trial->chk_trial_assigned($data['job_code'])){
                    $json_arr['sys_code'] = '500';
                    $json_arr['sys_msg'] = '該人員已經被指派過，請選擇其他人員';
                }else if($this->mod_voice_job_list->chk_job_code($data['job_code'])){
                    $json_arr['sys_code'] = '500';
                    $json_arr['sys_msg'] = '該人員已經被指派過，請選擇其他人員';
                }else{
                    $this->mod_voice_job_list->update_once($data['sn'], $data);
                    $json_arr['sys_code'] = '200';
                    $json_arr['sys_msg'] = '資料編輯完成';
                }
                
            }
            
        }
        echo json_encode($json_arr);
    }

    /**
     * 2018-12-18 @ James 確認人員沒事可以指派
     */
    function chk_job_code_can_use(){
        $this->load->model('mod_voice_job_list');
        $this->load->model('mod_voice_trial');
        $getpost = array('job_code');
        $requred = array('job_code');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if($this->mod_voice_trial->chk_trial_assigned($data['job_code'])){
                $json_arr['sys_code'] = '500';
                $json_arr['sys_msg'] = '該人員已經被指派過，請選擇其他人員';
            }else if($this->mod_voice_job_list->chk_job_code($data['job_code'])){
                $json_arr['sys_code'] = '500';
                $json_arr['sys_msg'] = '該人員已經被指派過，請選擇其他人員';
            }else{
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = 'data can use';
            }
               
        }
        echo json_encode($json_arr);
    }

    /**
     * C 相關api.
     */
     public function get_once_part()
     {
         $this->load->model('mod_voice_part_info');
         $getpost = array('sn');
         $requred = array('sn');
         $data = $this->getpost->getpost_array($getpost, $requred);
         if ($data == false) {
             $json_arr['sys_code'] = '000';
             $json_arr['sys_msg'] = '資料不足';
             $json_arr['requred'] = $this->getpost->report_requred($requred);
         } else {
            $json_arr['info'] = $this->mod_voice_part_info->get_once($data['sn']);
             $json_arr['sys_code'] = '200';
             $json_arr['sys_msg'] = '資料處理完成';
         }
         echo json_encode($json_arr);
     }
     public function save_part()
    {
        $this->load->model('mod_voice_part_info');
        $getpost = array( "field", 'floor','note');
        $requred = array("field", 'floor' );
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $this->mod_voice_part_info->update_once($data['field'],$data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料儲存完成';
        }
        echo json_encode($json_arr);
    }
    public function save_floor()
    {
        $this->load->model('mod_voice_part_info');
        $getpost = array('sn','part','start', 'end','floor','note');
        $requred = array('part','start', 'end','floor');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $this->mod_voice_part_info->update_floor($data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料儲存完成';
        }
        echo json_encode($json_arr);
    }
    public function save_addr()
    {
        $this->load->model('mod_voice_part_addr');
        $getpost = array('year','ladder', 'part_addr_1', 'part_addr_2', 'part_addr_3');
        $requred = array('year','ladder', 'part_addr_1', 'part_addr_2', 'part_addr_3');
        $data = $this->getpost->getpost_array($getpost, $requred);
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($this->mod_voice_part_addr->chk_once($year,$ladder)) {
                $this->mod_voice_part_addr->update_once($year,$ladder, $data);
            } else {
                $this->mod_voice_part_addr->add_once($data);
            }
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '儲存成功';
        }
        echo json_encode($json_arr);
    }

    public function save_trial()
    {
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_staff');
        $this->load->model('mod_voice_exam_datetime');
        $this->load->model('mod_voice_test_pay');
        $this->load->model('mod_voice_part_info');
        $getpost = array('sn','part','block_name','supervisor_1', 'supervisor_1_code', 'supervisor_2', 'supervisor_2_code', 'trial_staff_code_1', 'trial_staff_code_2', 'note','field');
        $requred = array('sn','part','block_name','supervisor_1', 'supervisor_1_code', 'supervisor_2', 'supervisor_2_code', 'trial_staff_code_1', 'trial_staff_code_2','field');
        $data = $this->getpost->getpost_array($getpost, $requred);
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');
        $field = $data['field'];
        $part = $data['part'];
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            $data['ladder'] = $this->session->userdata('ladder');
            if ($this->mod_voice_trial->chk_once($year,$ladder,$field,$part)) {
                $member1 = $this->mod_voice_staff->get_staff_member(trim($data['supervisor_1_code']));
                $member2 = $this->mod_voice_staff->get_staff_member(trim($data['supervisor_2_code']));
                $day = $this->mod_voice_exam_datetime->room_use_day($data['field'], $data['field'],$data['part']);
                $datetime_info = $this->mod_voice_exam_datetime->get_once($this->session->userdata('year'),$this->session->userdata('ladder'));
                $fees_info = $this->mod_voice_test_pay->get_once($this->session->userdata('year'),$this->session->userdata('ladder'));
                $part_info = $this->mod_voice_part_info->get_once($data['sn']);
                $do_date = array();
                $first_member_salary_total = $part_info['class'] * $fees_info['pay_2'];
                $first_member_total = $first_member_salary_total; 
                $second_member_salary_total = $part_info['class'] * $fees_info['pay_2'];
                $second_member_total = $second_member_salary_total ;                          
                $date = implode(",",$do_date);
                $sql_data = array (
                    // 'sn'=>$data['sn'],
                    'part'=>$data['part'],
                    'supervisor_1'=>trim($data['supervisor_1']),
                    'supervisor_1_code'=>trim($data['supervisor_1_code']),
                    'supervisor_2_code'=>trim($data['supervisor_2_code']),
                    'supervisor_2'=>trim($data['supervisor_2']),
                    'trial_staff_code_1'=>trim($data['trial_staff_code_1']),
                    'trial_staff_code_2'=>trim($data['trial_staff_code_2']),
                    'first_member_do_date'=>$date,
                    'second_member_do_date'=>$date,
                    'first_member_day_count'=>1,
                    'second_member_day_count'=>1,
                    'first_member_salary_section'=> $fees_info['pay_2'],
                    'second_member_salary_section'=> $fees_info['pay_2'],
                    'first_member_section_salary_total'=> $first_member_salary_total,
                    'second_member_section_salary_total'=> $second_member_salary_total,    
                    'first_member_section_total'=> $first_member_total,
                    'second_member_section_total'=> $second_member_total,
                    'note'=>$data['note'],
                );
                $this->mod_voice_trial->update_once($year,$ladder,$field,$part,$sql_data);         
                $json_arr['sql'] = $this->db->last_query();
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料儲存完成';
            } 
            else {
                $json_arr['sys_code'] = '404';
                $json_arr['sys_msg'] = '查無此資料';
            }
            
        }
        echo json_encode($json_arr);
    }


    //取得職員資料
    public function get_staff_member()
    {
        $this->load->model('mod_voice_staff');
        $getpost = array('code');
        $requred = array('code');
        $data = $this->getpost->getpost_array($getpost, $requred);

        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['info'] = $this->mod_voice_staff->get_staff_member($data['code']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }
    //取得天數
    public function room_use_day()
    {
        $this->load->model('mod_voice_exam_datetime');
        $getpost = array('start', 'end','part');
        $requred = array('start', 'end','part');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            $json_arr['day'] = $res = $this->mod_voice_exam_datetime->room_use_day($data['start'], $data['end'],$data['part']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '日期取得完成';
        }
        echo json_encode($json_arr);
    }

    public function get_day_section()
    {
        $this->load->model('mod_voice_exam_datetime');
        $getpost = array('start', 'end');
        $requred = array('start', 'end');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['section'] = $this->mod_voice_exam_datetime->get_day_section($data['start'], $data['end']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }
    public function save_patrol_staff_for_list()
    {

        $this->load->model('mod_voice_patrol');
        $getpost = array('sn','count', 'salary', 'salary_total', 'total','note');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $data['year'] = $this->session->userdata('year');
            $this->mod_voice_patrol->update_once($data['sn'], $data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料修改完成';
        }
        echo json_encode($json_arr);
    }
    //儲存$資料
    public function save_trial_for_price()
    {
        $this->load->model('mod_voice_trial');
        $getpost = array('sn','part','field','block_name','first_member_salary_section', 'first_member_section_salary_total','first_member_section_total', 'second_member_day_count', 'second_member_salary_section', 'second_member_section_salary_total','second_member_section_total');
        $requred = array('sn', 'first_member_salary_section', 'first_member_section_salary_total','first_member_section_total', 'second_member_day_count', 'second_member_salary_section', 'second_member_section_salary_total','second_member_section_total');
        $data = $this->getpost->getpost_array($getpost, $requred);
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');
        $field = $data['field'];
        $part = $data['part'];
        $block_name = $data['block_name'];
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $this->mod_voice_trial->update_once($year,$ladder,$field,$part,$block_name,$data);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料儲存完成';
        }
        echo json_encode($json_arr);
    }

    public function get_once_assign()
    {
        $this->load->model('mod_voice_trial');
        $getpost = array('sn');
        $requred = array('sn');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {

            $json_arr['info'] = $this->mod_voice_trial->get_once_assign($data['sn']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    /*
    清空Data
    */
    public function remove_trial()
    {
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_staff');
        $getpost = array('field','part');
        $requred = array('field','part');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            
            
                $remove_data = array(
                    "supervisor_1"=>"",
                    "supervisor_1_code"=>"",
                    "supervisor_2"=>"",
                    "supervisor_2_code"=>"",
                    "trial_staff_code_1"=>"",
                    "trial_staff_code_2"=>"",
                    "first_member_do_date"=>"",
                    "first_member_day_count"=>"",
                    "first_member_salary_section"=>"",
                    "first_member_section_salary_total"=>"",
                    "first_member_section_total"=>"",
                    "second_member_do_date"=>"",
                    "second_member_day_count"=>"",
                    "second_member_salary_section"=>"",
                    "second_member_section_salary_total"=>"",
                    "second_member_section_total"=>"",
                    "note"=>"",
                );
                $this->mod_voice_trial->update_once($this->session->userdata('year'),$this->session->userdata('ladder'),$data['field'],$data['part'],$remove_data);
            
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料刪除完成';
        }
        echo json_encode($json_arr);
    }  

    /**
     * D 相關api.
     */
     public function get_part()
     {
         $this->load->model('mod_voice_exam_area');
         $getpost = array('part');
         $requred = array('part');
         $data = $this->getpost->getpost_array($getpost, $requred);
         if ($data == false) {
             $json_arr['sys_code'] = '000';
             $json_arr['sys_msg'] = '資料不足';
             $json_arr['requred'] = $this->getpost->report_requred($requred);
         } else {
             $json_arr['part'] = $this->mod_voice_exam_area->get_part($data['part']);
             $json_arr['sys_code'] = '200';
             $json_arr['sys_msg'] = '資料處理完成';
         }
         echo json_encode($json_arr);
        }

        public function get_once_patrol()
        {
            $this->load->model('mod_voice_patrol');
            $getpost = array('sn');
            $requred = array('sn');
            $data = $this->getpost->getpost_array($getpost, $requred);
            if ($data == false) {
                $json_arr['sys_code'] = '000';
                $json_arr['sys_msg'] = '資料不足';
                $json_arr['requred'] = $this->getpost->report_requred($requred);
            } else {
                $json_arr['info'] = $this->mod_voice_patrol->get_once($data['sn']);
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料處理完成';
            }
            echo json_encode($json_arr);
        }

        public function save_patrol_staff()
        {
            $this->load->model('mod_voice_patrol');
            $getpost = array('sn', 'part', 'allocation_code', 'patrol_staff_code', 'patrol_staff_name', 'first_start', 'first_end', 'first_section', 'second_start', 'second_end', 'second_section','note');
            $requred = array('sn', 'part', 'allocation_code', 'patrol_staff_name');
            $data = $this->getpost->getpost_array($getpost, $requred);
            if ($data == false) {
                $json_arr['sys_code'] = '000';
                $json_arr['sys_msg'] = '資料不足';
                $json_arr['requred'] = $this->getpost->report_requred($requred);
            } else {
                $data['year'] = $this->session->userdata('year');
                $this->mod_voice_patrol->update_once($data['sn'], $data);
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料儲存完成';
            }
            echo json_encode($json_arr);
        }
        public function remove_patrol_staff()
        {
            $this->load->model('mod_voice_patrol');
            $getpost = array('sn');
            $requred = array('sn');
            $data = $this->getpost->getpost_array($getpost, $requred);
            if ($data == false) {
                $json_arr['sys_code'] = '000';
                $json_arr['sys_msg'] = '資料不足';
                $json_arr['requred'] = $this->getpost->report_requred($requred);
            } else {
                $data['year'] = $this->session->userdata('year');
                $this->mod_voice_patrol->remove_patrol_staff($data['sn'], $data);
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料刪除完成';
            }
            echo json_encode($json_arr);
        }
        public function add_patrol_staff()
        {
            $this->load->model('mod_voice_patrol');
            $this->load->model('mod_voice_exam_datetime');
            $this->load->model('Mod_voice_test_pay');
            $this->load->model('mod_voice_staff');
            $getpost = array('part', 'allocation_code', 'patrol_staff_code', 'patrol_staff_name',  'first_start', 'first_end', 'first_section', 'second_start', 'second_end', 'second_section', 'note');
            $requred = array('part', 'allocation_code', 'patrol_staff_code', 'patrol_staff_name');
            $data = $this->getpost->getpost_array($getpost, $requred);
            if ($data == false) {
                $json_arr['sys_code'] = '000';
                $json_arr['sys_msg'] = '資料不足';
                $json_arr['requred'] = $this->getpost->report_requred($requred);
            } else {
                $data['year'] = $this->session->userdata('year');
                $data['ladder'] = $this->session->userdata('ladder');
                $datetime_info = $this->mod_voice_exam_datetime->get_once($data['year'],$data['ladder']);
                $fees_info = $this->Mod_voice_test_pay->get_once($data['year'],$data['ladder']);
                $member = $this->mod_voice_staff->get_staff_member(trim($data['patrol_staff_code'])); 
                
                $count = $data['first_section']+$data['second_section'];
                $salary_total = $fees_info['pay_2']*$count;
                $total = $salary_total;     
                
                $data = array(
                    'part'=>$data['part'],
                    'year'=>$data['year'],
                    'allocation_code'=>$data['allocation_code'],
                    'patrol_staff_code'=>trim($data['patrol_staff_code']),
                    'patrol_staff_name'=>trim($data['patrol_staff_name']),
                    'first_start'=>$data['first_start'],
                    'first_end'=>$data['first_end'],
                    'first_section'=>$data['first_section'],
                    'second_start'=>$data['second_start'],
                    'second_end'=>$data['second_end'],
                    'second_section'=>$data['second_section'],
                    'note'=>$data['note'],
                    // 'do_date'=>$date,
                    'calculation'=> 'by_section',
                    'count'=> $count,
                    'salary'=>$fees_info['pay_2'],
                    'salary_total'=>$salary_total,
                    'total'=>$total,

                );
                $this->mod_voice_patrol->add_once($data);
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料儲存完成';
            }
            echo json_encode($json_arr);
        }

        // 新增管卷人員指派
        public function add_trial_staff()
        {
            $this->load->model('mod_voice_trial');
            $this->load->model('mod_voice_test_pay');
            $getpost = array('part', 'allocation_code', 'trial_staff_code', 'trial_staff_name', 'first_start', 'first_end', 'first_section', 'second_start', 'second_end', 'second_section','note','do_date');
            $requred = array('part', 'allocation_code');
            $data = $this->getpost->getpost_array($getpost, $requred);
            if ($data == false) {
                $json_arr['sys_code'] = '000';
                $json_arr['sys_msg'] = '資料不足';
                $json_arr['requred'] = $this->getpost->report_requred($requred);
            } else {
                $data['year'] = $this->session->userdata('year');
                $data['ladder'] = $this->session->userdata('ladder');
                $member = $this->mod_voice_trial->get_once_trial_by_code($data['trial_staff_code']);
                $do_date = explode(",", $data['do_date']);
                $fees_info = $this->mod_voice_test_pay->get_once($data['year'],$data['ladder']);  
                $count = $data['first_section']+$data['second_section'];
                $salary_total = $count*$fees_info['pay_2'];
                $total = $salary_total;

                $sql_data = array(
                    'part'=>$data['part'],
                    'year'=> $this->session->userdata('year'),
                    'ladder'=> $this->session->userdata('ladder'),
                    'allocation_code'=>$data['allocation_code'],
                    'trial_staff_code'=>trim($data['trial_staff_code']),
                    'trial_staff_name'=>trim($data['trial_staff_name']),
                    'second_start'=>$data['second_start'],
                    'second_end'=>$data['second_end'],
                    'second_section'=>$data['second_section'],
                    'first_start'=>$data['first_start'],
                    'first_end'=>$data['first_end'],
                    'first_section'=>$data['first_section'],
                    'second_start'=>$data['second_start'],
                    'second_end'=>$data['second_end'],
                    'second_section'=>$data['second_section'],
                    'calculation'=>'by_section',
                    'do_date'=>$data['do_date'],
                    'count'=>$count,
                    'salary'=>$fees_info['pay_2'],
                    'salary_total'=> $salary_total,
                    'total'=> $total,
                );
                
                // if($this->mod_voice_trial->chk_trial_staff_field($data) == true){
                //     $json_arr['sys_code'] = '500';
                //     $json_arr['sys_msg'] = '有重複輸入試場';
                // }else{
                    $this->mod_voice_trial->add_trial($sql_data);
                    $json_arr['sys_code'] = '200';
                    $json_arr['sys_msg'] = '資料新增完成';                
                // }
    
            }
            echo json_encode($json_arr);
        }
        // 修改管卷人員指派
        public function save_trial_staff()
        {
            $this->load->model('mod_voice_trial');
            $getpost = array('sn', 'part', 'allocation_code', 'trial_staff_code', 'trial_staff_name', 'first_start', 'first_end', 'first_section', 'second_start', 'second_end', 'second_section','note');
            $requred = array('sn', 'part', 'allocation_code', 'trial_staff_code', 'trial_staff_name');
            $data = $this->getpost->getpost_array($getpost, $requred);
            if ($data == false) {
                $json_arr['sys_code'] = '000';
                $json_arr['sys_msg'] = '資料不足';
                $json_arr['requred'] = $this->getpost->report_requred($requred);
            } else {
                $data['year'] = $this->session->userdata('year');
                $data['ladder'] = $this->session->userdata('ladder');
                // if($this->mod_voice_trial->chk_trial_staff_field($data) == true){
                //     $json_arr['sys_code'] = '500';
                //     $json_arr['sys_msg'] = '有重複輸入試場';
                // }else{
                    
                    $this->mod_voice_trial->update_trial($data['sn'], $data);
                    $json_arr['sys_code'] = '200';
                    $json_arr['sys_msg'] = '資料儲存完成';
                // }
                
            }
            echo json_encode($json_arr);
        }
        // 取消指派管卷人員
        public function remove_trial_staff()
        {
            $this->load->model('mod_voice_trial');
            $getpost = array('sn');
            $requred = array('sn');
            $data = $this->getpost->getpost_array($getpost, $requred);
            if ($data == false) {
                $json_arr['sys_code'] = '000';
                $json_arr['sys_msg'] = '資料不足';
                $json_arr['requred'] = $this->getpost->report_requred($requred);
            } else {
                $data['year'] = $this->session->userdata('year');
                if ($this->mod_voice_trial->chk_trial($data['sn'])) {
                    $this->mod_voice_trial->remove_trial_staff($data['sn']);
                } else {
                    $json_arr['sys_code'] = '404';
                    $json_arr['sys_msg'] = '查無資料';
                }
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料刪除完成';
            }
            echo json_encode($json_arr);
        } 


        //儲存管券人員
        public function save_trial_staff_for_list()
        {
            $this->load->model('mod_voice_trial');
            $getpost = array('sn', 'do_date', 'count', 'salary', 'salary_total', 'total', 'note');
            $requred = array('sn','do_date');
            $data = $this->getpost->getpost_array($getpost, $requred);
            if ($data == false) {
                $json_arr['sys_code'] = '000';
                $json_arr['sys_msg'] = '資料不足';
                $json_arr['requred'] = $this->getpost->report_requred($requred);
            } else {
                $data['year'] = $this->session->userdata('year');
                $this->mod_voice_trial->update_trial($data['sn'], $data);
                                   
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料修改完成';
            }
            echo json_encode($json_arr);
        }

        public function get_once_trial()
        {
            $this->load->model('mod_voice_trial');
            $getpost = array('sn');
            $requred = array('sn');
            $data = $this->getpost->getpost_array($getpost, $requred);
            if ($data == false) {
                $json_arr['sys_code'] = '000';
                $json_arr['sys_msg'] = '資料不足';
                $json_arr['requred'] = $this->getpost->report_requred($requred);
            } else {
                $json_arr['info'] = $this->mod_voice_trial->get_once_trial($data['sn']);
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '資料處理完成';
            }
            echo json_encode($json_arr);
        }
         //取得當天節數
    public function get_once_day_section()
    {
        $this->load->model('mod_voice_exam_datetime');
        $getpost = array('day', 'start', 'end');
        $requred = array('day', 'start', 'end');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['section'] = $this->mod_voice_exam_datetime->get_once_day_section($data['day'], $data['start'], $data['end']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }
    public function get_patrol_list()
    {
        $this->load->model('mod_voice_patrol');
        $getpost = array('part');
        $requred = array('part');
        $data = $this->getpost->getpost_array($getpost, $requred);
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            $json_arr['info'] = $this->mod_voice_patrol->get_patrol_list($data['part']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料處理完成';
        }
        echo json_encode($json_arr);
    }

    public function chk_part_list()
    {
        $this->load->model('mod_voice_trial');
        $getpost = array('part','area','year','ladder');
        $requred = array('part','area','year','ladder');
        $data = $this->getpost->getpost_array($getpost, $requred);
        
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        } else {
            if ($this->mod_voice_trial->chk_part_list($data['part'], $data['area'],$data['year'],$data['ladder']) == true) {
                $json_arr['sys_code'] = '200';
                $json_arr['sys_msg'] = '匯出完成';
            } 
            else {
                $json_arr['sys_code'] = '404';
                $json_arr['sys_msg'] = '查無此資料，請確認是否有資料';
                echo $json_arr['sql'] = $this->db->last_query();
            }
        }
        
        echo json_encode($json_arr);
    }
    
    /* 
    f 頁  考試日期修改
    */
    public function save_datetime()
    {
        $this->load->model('mod_voice_exam_datetime');
        $getpost = array('year','ladder','day','pre_1','pre_2','course_1_start','course_1_end','course_2_start','course_2_end');
        $requred = array('year','ladder','day','pre_1','pre_2','course_1_start','course_1_end','course_2_start','course_2_end');
        $data = $this->getpost->getpost_array($getpost,$requred);
        
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);
        }else{
            if($this->mod_voice_exam_datetime->chk_once($data['year'],$data['ladder'])){
                $this->mod_voice_exam_datetime->update_once($data['year'],$data['ladder'],$data);
            }else{
                $this->mod_voice_exam_datetime->add_once($data);
            }
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '儲存成功';
            
        }
        echo json_encode($json_arr);


    }
    
    /*
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
            if($this->mod_voice_subject->chk_once($year,$data['ladder'])){
                $this->mod_voice_subject->update_once($year,$data['ladder'],$data);
            }else{
                $this->mod_voice_subject->add_once($data);
            }
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '儲存成功';


        }
        echo json_encode($json_arr);


    }
    public function add_course()
    {
        $this->load->model('mod_voice_exam_datetime');
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
            $this->mod_voice_exam_datetime->clean_course($year);
            $this->mod_voice_exam_datetime->setting_course($year, $data['data']);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '修改成功';
        }
        echo json_encode($json_arr);
    }
     /*
    f4頁 考科費用
    */
    public function save_pay()
    {
        $this->load->model('mod_voice_test_pay');
        $getpost = array('year','ladder','pay_1','pay_2');
        $requred = array('year','ladder','pay_1','pay_2');
        $data = $this->getpost->getpost_array($getpost,$requred);
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');
        if ($data == false) {
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料不足';
            $json_arr['requred'] = $this->getpost->report_requred($requred);

        }else{
            if($this->mod_voice_test_pay->chk_once($year,$ladder)){
                $this->mod_voice_test_pay->update_once($year,$ladder,$data);
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
