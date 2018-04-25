<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Designated extends CI_Controller
{
    public function index()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '指考主選單',
            'path' => 'designated/index',
            'path_text' => ' > 指考主選單',
        );
        $this->load->view('layout', $data);
    }

    /**
     * a資料匯入作業.
     */
    public function a()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '資料匯入作業',
            'path' => 'designated/a',
            'path_text' => ' > 指考主選單 > 資料匯入作業',
        );
        $this->load->view('layout', $data);
    }

    /**
     * a資料匯入作業.
     */
    public function a_1()
    {
        $this->load->model('mod_exam_area');
        $this->mod_user->chk_status();
        if (isset($_FILES['file'])) { // 如果有接收到上傳檔案資料
            // print_r($_FILES);
            $file = $_FILES['file']['tmp_name'];
            $file_name = './tmp/'.time().'.csv';
            copy($file, $file_name);
            $file = fopen($file_name, 'r');
            $datas = array();
            fgetcsv($file);
            while (!feof($file)) {
                $data = fgetcsv($file);
                $datas[] = array(
                    'year' => $this->session->userdata('year'),
                    'part' => $data[0],
                    'part_name' => $data[1],
                    'field' => $data[2],
                    'start' => $data[3],
                    'end' => $data[4],
                    'number' => $data[5],
                    'subject_01' => $data[6],
                    'subject_02' => $data[7],
                    'subject_03' => $data[8],
                    'subject_04' => $data[9],
                    'subject_05' => $data[10],
                    'subject_06' => $data[11],
                    'subject_07' => $data[12],
                    'subject_08' => $data[13],
                    'subject_09' => $data[14],
                    'subject_10' => $data[15],
                    'addr' => $data[16],
                    'floor' => $data[17],
                );
            }
            // echo json_encode($datas);

            $this->mod_exam_area->import($datas);
            fclose($file);
            unlink($file_name);
            // print_r(fgetcsv($file));
            redirect('designated/a_1');
        } else {
            $data = array(
                'title' => '考區試場資料',
                'path' => 'designated/a_1',
                'path_text' => ' > 指考主選單 > 資料匯入作業 > 考區試場資料',
                'datalist' => $this->mod_exam_area->year_get_list(),
            );
            $this->load->view('layout', $data);
        }
    }

    public function a_2()
    {
        $this->load->model('mod_school_unit');
        $this->mod_user->chk_status();
        if (isset($_FILES['file'])) { // 如果有接收到上傳檔案資料
            // print_r($_FILES);
            $file = $_FILES['file']['tmp_name'];
            $file_name = './tmp/'.time().'.csv';
            copy($file, $file_name);
            $file = fopen($file_name, 'r');
            $datas = array();
            fgetcsv($file);
            while (!feof($file)) {
                $data = fgetcsv($file);
                $datas[] = array(
                     'sn' => uniqid(),
                     'year' => $this->session->userdata('year'),
                     'company_name_01' => $data[0],
                     'company_name_02' => $data[1],
                     'department' => $data[2],
                     'code' => $data[3],
                 );
                // print_r($datas);
            }
            // echo json_encode($datas);

            $this->mod_school_unit->import($datas);
            fclose($file);
            unlink($file_name);
            //  print_r(fgetcsv($file));
            redirect('designated/a_2');
        } else {
            $data = array(
                'title' => '本校單位資料',
                'path' => 'designated/a_2',
                'path_text' => ' > 指考主選單 > 資料匯入作業 > 本校單位資料',
                'datalist' => $this->mod_school_unit->year_get_list(),
            );
            $this->load->view('layout', $data);
        }
    }

    public function a_3()
    {
        $this->load->model('mod_staff');
        $this->mod_user->chk_status();
        if (isset($_FILES['file'])) { // 如果有接收到上傳檔案資料
            // print_r($_FILES);
            $file = $_FILES['file']['tmp_name'];
            $file_name = './tmp/'.time().'.csv';
            copy($file, $file_name);
            $file = fopen($file_name, 'r');
            $datas = array();
            fgetcsv($file);
            // print_r(fgetcsv($file));
            while (!feof($file)) {
                $data = fgetcsv($file);
                $datas[] = array(
                    'year' => $this->session->userdata('year'),
                    'member_code' => $data[0],
                    'member_name' => $data[1],
                    'member_unit' => $data[2],
                    'member_phone' => $data[3],
                    'member_title' => $data[4],
                    'order_meal' => $data[5],
                    'meal' => $data[6],
                 );
                // print_r($datas);
            }
            // echo json_encode($datas);

            $this->mod_staff->import($datas);
            fclose($file);
            unlink($file_name);
            redirect('designated/a_3');
            //  print_r(fgetcsv($file));
        } else {
            $data = array(
                'title' => '工作人員資料',
                'path' => 'designated/a_3',
                'path_text' => ' > 指考主選單 > 資料匯入作業 > 工作人員資料',
                'datalist' => $this->mod_staff->year_get_list(),
            );
            $this->load->view('layout', $data);
        }
    }

    /**
     * 考區任務編組.
     */
    public function b()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '考區任務編組',
            'path' => 'designated/b',
            'path_text' => ' > 指考主選單 > 考區任務編組',
        );
        $this->load->view('layout', $data);
    }

    public function b_1()
    {
        $this->load->model('mod_exam_area');
        $this->load->model('mod_task');
        $this->mod_user->chk_status();
        $year = $this->session->userdata("year");
        $jobs = $this->mod_task->get_job_list($year);
        

        $data = array(
            'title' => '考區任務編組',
            'path' => 'designated/b_1',
            'path_text' => ' > 指考主選單 > 考區任務編組 > 考區',
            'field' => $this->mod_task->get_field(),
            'datalist' => $this->mod_task->get_list('考區'),
            "jobs"=>$jobs
        );
        $this->load->view('layout', $data);
    }

    public function b_2()
    {
        $this->load->model('mod_exam_area');
        $this->load->model('mod_task');
        $this->mod_user->chk_status();
        $data = array(
            'title' => '考區任務編組',
            'path' => 'designated/b_2',
            'path_text' => ' > 指考主選單 > 考區任務編組 > 第一分區',
            'field' => $this->mod_task->get_field(),
            'datalist' => $this->mod_task->get_list('第一分區'),
        );
        $this->load->view('layout', $data);
    }

    public function b_3()
    {
        $this->load->model('mod_exam_area');
        $this->load->model('mod_task');
        $this->mod_user->chk_status();
        $data = array(
            'title' => '考區任務編組',
            'path' => 'designated/b_3',
            'path_text' => ' > 指考主選單 > 考區任務編組 > 第二分區',
            'field' => $this->mod_task->get_field(),
            'datalist' => $this->mod_task->get_list('第二分區'),
        );
        $this->load->view('layout', $data);
    }

    public function b_4()
    {
        $this->load->model('mod_exam_area');
        $this->load->model('mod_task');
        $this->mod_user->chk_status();
        $data = array(
            'title' => '考區任務編組',
            'path' => 'designated/b_4',
            'path_text' => ' > 指考主選單 > 考區任務編組 > 第三分區',
            'field' => $this->mod_task->get_field(),
            'datalist' => $this->mod_task->get_list('第三分區'),
        );
        $this->load->view('layout', $data);
    }

    public function b_5()
    {
        $this->load->model('mod_exam_area');
        $this->load->model('mod_task');
        $this->mod_user->chk_status();
        $data = array(
            'title' => '預覽任務編組表',
            'path' => 'designated/b_5',
            'path_text' => ' > 指考主選單 > 考區任務編組 > 預覽任務編組表',
            'all' => $this->mod_task->get_list(),
            'b1' => $this->mod_task->get_list('考區'),
            'b2' => $this->mod_task->get_list('第一分區'),
            'b3' => $this->mod_task->get_list('第二分區'),
            'b4' => $this->mod_task->get_list('第三分區'),
        );
        $this->load->view('layout', $data);
    }

    /**
     * F 考程設定
     */
    function f(){
        $this->mod_user->chk_status();
        
        $data = array(
            'title' => '考程設定',
            'path' => 'designated/f',
            'path_text' => ' > 指考主選單 > 考程設定',
        );
        $this->load->view('layout', $data);
    }
    function f_1(){
        $this->mod_user->chk_status();
        $this->load->model("mod_exam_datetime");
        $year = $this->session->userdata("year");
       
        if($this->mod_exam_datetime->chk_once($year)){
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        }else{
            $datetime_info = array(
                "day_1"=>date("Y")."/07/01",
                "day_2"=>date("Y")."/07/02",
                "day_3"=>date("Y")."/07/03",
                "course_1_start"=>"08:40",
                "course_1_end"=>"10:00",
                "course_2_start"=>"10:50",
                "course_2_end"=>"12:00",
                "course_3_start"=>"14:00",
                "course_3_end"=>"15:20",
                "course_4_start"=>"16:01",
                "course_4_end"=>"17:30",
                'pre_1'=>"08:25",
                'pre_2'=>"10:45",
                'pre_3'=>"13:55",
                'pre_4'=>"16:05",
            );
        }
        $data = array(
            'title' => '考試日期與時間',
            'path' => 'designated/f_1',
            'path_text' => ' > 指考主選單 > 考程設定 > 考試日期與時間',
            "datetime_info"=>$datetime_info
        );
        $this->load->view('layout', $data);
    }
    function f_1_act(){
        $this->load->model("mod_exam_datetime");
        $year = $this->session->userdata("year");
        $data = $_POST;
        $data['year']=$year;
        
        if($this->mod_exam_datetime->chk_once($year)){
            $this->mod_exam_datetime->update_once($year,$data);
        }else{
            $this->mod_exam_datetime->add_once($data);
        }
        redirect("./designated/f_1");
    }
    function f_2(){
        $this->mod_user->chk_status();
        $this->load->model("mod_exam_datetime");
        $year = $this->session->userdata("year");
        $datetime_info = $this->mod_exam_datetime->get_once($year);
        if($this->mod_exam_datetime->chk_course($year)){
            $course = $this->mod_exam_datetime->get_course($year);
        }else{
            $course = array(
                "1-1"=>"未安排",
                "1-2"=>"未安排",
                "1-3"=>"未安排",
                "1-4"=>"未安排",
                "2-1"=>"未安排",
                "2-2"=>"未安排",
                "2-3"=>"未安排",
                "2-4"=>"未安排",
                "3-1"=>"未安排",
                "3-2"=>"未安排",
                "3-3"=>"未安排",
                "3-4"=>"未安排",
                "4-1"=>"未安排",
                "4-2"=>"未安排",
                "4-3"=>"未安排",
                "4-4"=>"未安排",
            );
        }
        $data = array(
            'title' => '考試科目',
            'path' => 'designated/f_2',
            'path_text' => ' > 指考主選單 > 考程設定 > 考試科目',
            "datetime_info"=>$datetime_info,
            "course"=>$course
        );
        $this->load->view('layout', $data);
    }
    function f_2_act(){
        $this->load->model("mod_exam_datetime");
        $year = $this->session->userdata("year");
        
        
        $this->mod_exam_datetime->clean_course($year);
        $this->mod_exam_datetime->setting_course($year,$_POST);
        redirect("./designated/f_2");
    }
    function f_3(){
        $this->mod_user->chk_status();
        $this->load->model("mod_exam_datetime");
        $year = $this->session->userdata("year");

        if($this->mod_exam_datetime->chk_once($year)){
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        }else{
            $datetime_info = array(
                "day_1"=>date("Y")."/07/01",
                "day_2"=>date("Y")."/07/02",
                "day_3"=>date("Y")."/07/03",
                "course_1_start"=>"08:40",
                "course_1_end"=>"10:00",
                "course_2_start"=>"10:50",
                "course_2_end"=>"12:00",
                "course_3_start"=>"14:00",
                "course_3_end"=>"15:20",
                "course_4_start"=>"16:01",
                "course_4_end"=>"17:30",
                'pre_1'=>"08:25",
                'pre_2'=>"10:45",
                'pre_3'=>"13:55",
                'pre_4'=>"16:05",
            );
        }

        if($this->mod_exam_datetime->chk_course($year)){
            $course = $this->mod_exam_datetime->get_course($year);
        }else{
            $course = array(
                "1-1"=>"未安排",
                "1-2"=>"未安排",
                "1-3"=>"未安排",
                "1-4"=>"未安排",
                "2-1"=>"未安排",
                "2-2"=>"未安排",
                "2-3"=>"未安排",
                "2-4"=>"未安排",
                "3-1"=>"未安排",
                "3-2"=>"未安排",
                "3-3"=>"未安排",
                "3-4"=>"未安排",
                "4-1"=>"未安排",
                "4-2"=>"未安排",
                "4-3"=>"未安排",
                "4-4"=>"未安排",
            );
        }
        $data = array(
            'title' => '預覽考程表',
            'path' => 'designated/f_3',
            'path_text' => ' > 指考主選單 > 預覽考程表',
            "course"=>$course,
            "datetime_info"=>$datetime_info
        );
        $this->load->view('layout', $data);
    }
}

/* End of file Designated.php */
