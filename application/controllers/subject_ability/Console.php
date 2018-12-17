<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Console extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('subject_ability/mod_area');
    }
    

    public function index()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '學測主選單',
            'path' => 'subject_ability/index',
            'path_text' => ' > 學測主選單',
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
            'path' => 'subject_ability/a',
            'path_text' => ' > 學測主選單 > 資料匯入作業',
        );
        $this->load->view('layout', $data);
    }

    
    /**
     * a資料匯入作業.
     */
     public function a_1()
     {
         $this->load->model('mod_ability_exam_area');
         $this->load->model('mod_ability_part_info');
         $this->load->model('mod_ability_trial');
         $this->load->model('mod_ability_patrol');
         $this->mod_user->chk_status();
         if (isset($_FILES['file'])) { // 如果有接收到上傳檔案資料
             
             $file = $_FILES['file']['tmp_name'];
             $file_name = './tmp/'.time().'.csv';
             copy($file, $file_name);
             $file = fopen($file_name, 'r');
             $datas = array();
             fgetcsv($file);
             while (!feof($file)) {
                 $data = fgetcsv($file);
                 $arr = array();
                 array_push($arr, $data['6'], $data['7'], $data['8'], $data['9'], $data['10'], $data['11'], $data['12'], $data['13'], $data['14'], $data['15']);
                 
                 foreach ($arr as $k => $v) {
                     if ($v == '0') {
                         unset($arr[$k]);
                     }
                 }
 
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
                     'air_test_field' => $data[16],
                 );
                 $datas_part[] = array(
                     'year' => $this->session->userdata('year'),
                     'part' => $data[0],
                     'part_name' => $data[1],
                     'field' => $data[2],
                     'test_section' => count($arr),
                     'start' => $data[3],
                     'end' => $data[4],
                     'number' => $data[5],
                 );
 
                 $datas_trial[] = array(
                     'year' => $this->session->userdata('year'),
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
                     'first_member_lunch_price' => '',
                     'first_member_section_lunch_total' => '',
                     'first_member_section_total' => '',
                     'second_member_do_date' => '',
                     'second_member_day_count' => '',
                     'second_member_salary_section' => '',
                     'second_member_section_salary_total' => '',
                     'second_member_lunch_price' => '',
                     'second_member_section_lunch_total' => '',
                     'second_member_section_total' => '',
                     'note' => '',
                 );
             }
             // echo json_encode($datas);
 
             $this->mod_ability_exam_area->import($datas);
             $this->mod_ability_part_info->import($datas_part);
             $this->mod_ability_trial->import($datas_trial);
 
 
             fclose($file);
             unlink($file_name);
             // print_r(fgetcsv($file));
             redirect('subject_ability/a_1');
         } else {
             $data = array(
                 'title' => '考區試場資料',
                 'path' => 'subject_ability/a_1',
                 'path_text' => ' > 學測主選單 > 資料匯入作業 > 考區試場資料',
                 'datalist' => $this->mod_ability_exam_area->year_get_list(),
                 
             );
             $this->load->view('layout', $data);
         }
     }

     public function a_2()
     {
         $this->load->model('mod_ability_school_unit');
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
                 // print_r($data);
                 $datas[] = array(
                      'sn' => uniqid(),
                      'year' => $this->session->userdata('year'),
                      'department' => $data[0],
                      'code' => $data[1],
                      'company_name_01' => $data[2],
                      'company_name_02' => $data[3],
                  );
                 // print_r($datas);
             }
             // echo json_encode($datas);
 
             $this->mod_ability_school_unit->import($datas);
             fclose($file);
             unlink($file_name);
             //  print_r(fgetcsv($file));
             redirect('subject_ability/a_2');
         } else {
             $data = array(
                 'title' => '本校單位資料',
                 'path' => 'subject_ability/a_2',
                 'path_text' => ' > 學測主選單 > 資料匯入作業 > 本校單位資料',
                 'datalist' => $this->mod_ability_school_unit->year_get_list(),
             );
             $this->load->view('layout', $data);
         }
     }

     public function a_3()
     {
         $this->load->model('mod_ability_staff');
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
                 if ($data[0] != '') {
                     $datas[] = array(
                         'year' => $this->session->userdata('year'),
                         'member_code' => $data[0],
                         'member_name' => $data[1],
                         'unit'=>$data[2],
                         'member_unit' => $data[3],
                         'member_title' => $data[4],
                         'member_phone' => $data[5],
                         'order_meal' => $data[6],
                         'meal' => $data[7],
                     );
                 }
                 // print_r($datas);
             }
             // echo json_encode($datas);
 
             $this->mod_ability_staff->import($datas);
             fclose($file);
             unlink($file_name);
             redirect('subject_ability/a_3');
             print_r(fgetcsv($file));
         } else {
             $data = array(
                 'title' => '工作人員資料',
                 'path' => 'subject_ability/a_3',
                 'path_text' => ' > 學測主選單 > 資料匯入作業 > 工作人員資料',
                 'datalist' => $this->mod_ability_staff->year_get_list(),
             );
             $this->load->view('layout', $data);
         }
     }

     public function a_4()
     {
         $this->load->model('mod_ability_task');
         $this->load->model('mod_ability_exam_area');
         $this->mod_user->chk_status();
 
         if (isset($_FILES['inputGroupFile00'])) { // 如果有接收到上傳檔案資料
             $file = $_FILES['inputGroupFile00']['tmp_name'];
             $file_name = './tmp/'.time().'.csv';
             copy($file, $file_name);
             $file = fopen($file_name, 'r');
             $datas = array();
             fgetcsv($file);
             $start = $this->mod_ability_exam_area->get_min_start();
             $end = $this->mod_ability_exam_area->get_max_end();
             while (!feof($file)) {
                 $data = fgetcsv($file);
                 $area[] = array(
                     'year' => $this->session->userdata('year'),
                     'area' => '考區',
                     'job' => $data[0],
                     'job_code' => '',
                     'job_title' => '',
                     'name' => '',
                     'trial_start' => $start['field'],
                     'trial_end' => $end['field'],
                     'number' => '',
                     'phone' => '',
                     'note' => '',
                     'do_date' => '',
                     'order_meal' => '',
                     'day_count' => '',
                     'one_day_salary' => '',
                     'salary_total' => '',
                     'lunch_price' => '',
                     'lunch_total' => '',
                     'total' => '',
                     'status' => '1',
                  );
             }
             $this->Mod_ability_task->import($area);
             fclose($file);
             unlink($file_name);
             redirect('subject_ability/a_4');
         } elseif (isset($_FILES['inputGroupFile01'])) {
             $file = $_FILES['inputGroupFile01']['tmp_name'];
             $file_name = './tmp/'.time().'.csv';
             copy($file, $file_name);
             $file = fopen($file_name, 'r');
             $datas = array();
             fgetcsv($file);
             $start_1 = $this->mod_ability_exam_area->get_min_start('2501');
             $end_1 = $this->mod_ability_exam_area->get_max_end('2501');
             $start_2 = $this->mod_ability_exam_area->get_min_start('2502');
             $end_2 = $this->mod_ability_exam_area->get_max_end('2502');
             $start_3 = $this->mod_ability_exam_area->get_min_start('2503');
             $end_3 = $this->mod_ability_exam_area->get_max_end('2503');
             while (!feof($file)) {
                 $data = fgetcsv($file);
                 $area_1[] = array(
                     'year' => $this->session->userdata('year'),
                     'area' => '第一分區',
                     'job' => $data[0],
                     'job_code' => '',
                     'job_title' => '',
                     'name' => '',
                     'trial_start' => $start_1['field'],
                     'trial_end' => $end_1['field'],
                     'number' => '',
                     'phone' => '',
                     'note' => '',
                     'do_date' => '',
                     'day_count' => '',
                     'one_day_salary' => '',
                     'salary_total' => '',
                     'lunch_price' => '',
                     'lunch_total' => '',
                     'total' => '',
                     'status' => '1',
                  );
              
             }
             // echo json_encode($datas);
 
             $this->Mod_ability_task->import_1($area_1);
             // $this->mod_task->import_2($area_2);
             // $this->mod_task->import_3($area_3);
             fclose($file);
             unlink($file_name);
             print_r(fgetcsv($file));
             redirect('subject_ability/a_4');
         } elseif (isset($_FILES['inputGroupFile02'])) {
             $file = $_FILES['inputGroupFile02']['tmp_name'];
             $file_name = './tmp/'.time().'.csv';
             copy($file, $file_name);
             $file = fopen($file_name, 'r');
             $datas = array();
             fgetcsv($file);
             $start_2 = $this->mod_ability_exam_area->get_min_start('2502');
             $end_2 = $this->mod_ability_exam_area->get_max_end('2502');
             while (!feof($file)) {
                 $data = fgetcsv($file);
                 $area_2[] = array(
                     'year' => $this->session->userdata('year'),
                     'area' => '第二分區',
                     'job' => $data[0],
                     'job_code' => '',
                     'job_title' => '',
                     'name' => '',
                     'trial_start' => $start_2['field'],
                     'trial_end' => $end_2['field'],
                     'number' => '',
                     'phone' => '',
                     'note' => '',
                     'do_date' => '',
                     'day_count' => '',
                     'one_day_salary' => '',
                     'salary_total' => '',
                     'lunch_price' => '',
                     'lunch_total' => '',
                     'total' => '',
                     'status' => '1',
                  );
             }
             // echo json_encode($datas);
 
             $this->mod_ability_task->import_2($area_2);
             fclose($file);
             unlink($file_name);
             print_r(fgetcsv($file));
             redirect('subject_ability/a_4');
         } elseif (isset($_FILES['inputGroupFile03'])) {
             $file = $_FILES['inputGroupFile03']['tmp_name'];
             $file_name = './tmp/'.time().'.csv';
             copy($file, $file_name);
             $file = fopen($file_name, 'r');
             $datas = array();
             fgetcsv($file);
             $start_3 = $this->mod_ability_exam_area->get_min_start('2503');
             $end_3 = $this->mod_ability_exam_area->get_max_end('2503');
             while (!feof($file)) {
                 $data = fgetcsv($file);
                 $area_3[] = array(
                     'year' => $this->session->userdata('year'),
                     'area' => '第三分區',
                     'job' => $data[0],
                     'job_code' => '',
                     'job_title' => '',
                     'name' => '',
                     'trial_start' => $start_3['field'],
                     'trial_end' => $end_3['field'],
                     'number' => '',
                     'phone' => '',
                     'note' => '',
                     'do_date' => '',
                     'day_count' => '',
                     'one_day_salary' => '',
                     'salary_total' => '',
                     'lunch_price' => '',
                     'lunch_total' => '',
                     'total' => '',
                     'status' => '1',
                  );
             }
             // echo json_encode($datas);
 
             $this->mod_ability_task->import_3($area_3);
             fclose($file);
             unlink($file_name);
             print_r(fgetcsv($file));
             redirect('subject_ability/a_4');
         } else {
             $data = array(
                     'title' => '職務資料',
                     'path' => 'subject_ability/a_4',
                     'path_text' => ' > 學測主選單 > 資料匯入作業 > 職務資料',
                     'all' => $this->mod_ability_task->get_list(),
                     'b1' => $this->mod_ability_task->get_list('考區'),
                     'b2' => $this->mod_ability_task->get_list('第一分區'),
                     'b3' => $this->mod_ability_task->get_list('第二分區'),
                     'b4' => $this->mod_ability_task->get_list('第三分區'),
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
            'path' => 'subject_ability/b',
            'path_text' => ' > 學測主選單 > 考區任務編組',
        );
        $this->load->view('layout', $data);
    }

    public function b_1()
    {
        $this->load->model('mod_ability_exam_area');
        $this->load->model('mod_ability_task');
        $this->load->model('mod_ability_exam_fees');
        $this->load->model('mod_ability_exam_datetime');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $jobs = $this->mod_ability_task->get_job_list($year, '考區');
        if ($this->mod_ability_exam_fees->chk_once($year)) {
            $fees_info = $this->mod_ability_exam_fees->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '0',
                'salary_section' => '0',
                'lunch_fee' => '0',
            );
        }
        if ($this->mod_ability_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_ability_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '07/01',
                'day_2' => '07/02',
                'day_3' => '07/03',
            );
        }
        $data = array(
            'title' => '考區任務編組',
            'path' => 'designated/b_1',
            'path_text' => ' > 英聽主選單 > 考區任務編組 > 考區',
            'field' => $this->mod_ability_task->get_field(),
            'datalist' => $this->mod_ability_task->get_list('考區'),
            'jobs' => $jobs,
            'fees_info' => $fees_info,
            'datetime_info' => $datetime_info,
        );

        $this->load->view('layout', $data);
    }

    public function b_2()
    {
        $this->load->model('mod_ability_exam_area');
        $this->load->model('mod_ability_task');
        $this->load->model('mod_ability_exam_fees');
        $this->load->model('mod_ability_exam_datetime');
        $this->load->model('mod_ability_part');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $jobs = $this->mod_ability_task->get_job_list($year, '第一分區');
        if ($this->mod_ability_exam_fees->chk_once($year)) {
            $fees_info = $this->mod_ability_exam_fees->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '0',
                'salary_section' => '0',
                'lunch_fee' => '0',
            );
        }

        if ($this->mod_ability_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_ability_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '07/01',
                'day_2' => '07/02',
                'day_3' => '07/03',
            );
        }
        $data = array(
            'title' => '考區任務編組',
            'path' => 'subject_ability/b_2',
            'path_text' => ' > 英聽主選單 > 考區任務編組 > 第一分區',
            'datalist' => $this->mod_ability_task->get_list('第一分區'),
            'jobs' => $jobs,
            'fees_info' => $fees_info,
            'datetime_info' => $datetime_info,
        );
        $this->load->view('layout', $data);
    }

    public function b_3()
    {
        $this->load->model('mod_ability_exam_area');
        $this->load->model('mod_ability_task');
        $this->load->model('mod_ability_exam_fees');
        $this->load->model('mod_ability_part');
        $this->load->model('mod_ability_exam_datetime');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $jobs = $this->mod_ability_task->get_job_list($year, '第二分區');
        if ($this->mod_ability_exam_fees->chk_once($year)) {
            $fees_info = $this->mod_ability_exam_fees->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '0',
                'salary_section' => '0',
                'lunch_fee' => '0',
            );
        }
        if ($this->mod_ability_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_ability_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '07/01',
                'day_2' => '07/02',
                'day_3' => '07/03',
            );
        }
        $data = array(
            'title' => '考區任務編組',
            'path' => 'subject_ability/b_3',
            'path_text' => ' > 英聽主選單 > 考區任務編組 > 第二分區',
            'datalist' => $this->mod_ability_task->get_list('第二分區'),
            'jobs' => $jobs,
            'fees_info' => $fees_info,
            'datetime_info' => $datetime_info,
        );
        $this->load->view('layout', $data);
    }

    public function b_4()
    {
        $this->load->model('mod_ability_exam_area');
        $this->load->model('mod_ability_task');
        $this->load->model('mod_ability_part');
        $this->load->model('mod_ability_exam_datetime');
        $this->load->model('mod_ability_exam_fees');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $jobs = $this->mod_ability_task->get_job_list($year, '第三分區');
        if ($this->mod_ability_exam_fees->chk_once($year)) {
            $fees_info = $this->mod_ability_exam_fees->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '0',
                'salary_section' => '0',
                'lunch_fee' => '0',
            );
        }
        if ($this->mod_ability_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_ability_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '07/01',
                'day_2' => '07/02',
                'day_3' => '07/03',
            );
        }
        $data = array(
            'title' => '考區任務編組',
            'path' => 'subject_ability/b_4',
            'path_text' => ' > 英聽主選單 > 考區任務編組 > 第三分區',
            'datalist' => $this->mod_ability_task->get_list('第三分區'),
            'jobs' => $jobs,
            'fees_info' => $fees_info,
            'datetime_info' => $datetime_info,
        );
        $this->load->view('layout', $data);
    }

    public function b_5()
    {
        $this->load->model('mod_ability_exam_area');
        $this->load->model('mod_ability_task');
        $this->mod_user->chk_status();
        $data = array(
            'title' => '預覽任務編組表',
            'path' => 'subject_ability/b_5',
            'path_text' => ' > 英聽主選單 > 考區任務編組 > 預覽任務編組表',
            'all' => $this->mod_ability_task->get_list(),
            'b1' => $this->mod_ability_task->get_list('考區'),
            'b2' => $this->mod_ability_task->get_list('第一分區'),
            'b3' => $this->mod_ability_task->get_list('第二分區'),
            'b4' => $this->mod_ability_task->get_list('第三分區'),
        );
        $this->load->view('layout', $data);
    }

     /**
     * C 試場分配.
     */
     public function c()
     {
         $this->load->model('mod_ability_part_info');
         $this->mod_user->chk_status();
         $data = array(
             'title' => '試場分配',
             'path' => 'subject_ability/c',
             'path_text' => ' > 英聽主選單 > 試場分配',
             'datalist' => $this->mod_ability_part_info->get_list(),
         );
         $this->load->view('layout', $data);
     }

     public function c_1()
     {
         $this->load->model('mod_ability_part_info');
         $this->load->model('mod_ability_part_addr');
         $this->mod_user->chk_status();
         $year = $this->session->userdata('year');
 
         if ($this->mod_ability_part_addr->chk_once($year)) {
             $addr_info = $this->mod_ability_part_addr->get_once($year);
         } else {
             $addr_info = array(
                 'part_addr_1' => '',
                 'part_addr_2' => '',
                 'part_addr_3' => '',
             );
         }
 
         $data = array(
             'title' => '第一分區',
             'path' => 'subject_ability/c_1',
             'path_text' => ' > 英聽主選單 > 試場分配 > 第一分區',
             'datalist' => $this->mod_ability_part_info->get_list('2501'),
             'addr_info' => $addr_info,
         );
         $this->load->view('layout', $data);
     }

     public function c_2()
    {
        $this->load->model('mod_ability_part_info');
        $this->load->model('mod_ability_part_addr');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');

        if ($this->mod_ability_part_addr->chk_once($year)) {
            $addr_info = $this->mod_ability_part_addr->get_once($year);
        } else {
            $addr_info = array(
                'part_addr_1' => '',
                'part_addr_2' => '',
                'part_addr_3' => '',
            );
        }

        $data = array(
            'title' => '第二分區',
            'path' => 'subject_ability/c_2',
            'path_text' => ' > 英聽主選單 > 試場分配 > 第二分區',
            'datalist' => $this->mod_ability_part_info->get_list('2502'),
            'addr_info' => $addr_info,
        );
        $this->load->view('layout', $data);
    }

    public function c_3()
    {
        $this->load->model('mod_ability_part_info');
        $this->load->model('mod_ability_part_addr');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');

        if ($this->mod_ability_part_addr->chk_once($year)) {
            $addr_info = $this->mod_ability_part_addr->get_once($year);
        } else {
            $addr_info = array(
                'part_addr_1' => '',
                'part_addr_2' => '',
                'part_addr_3' => '',
            );
        }

        $data = array(
            'title' => '第三分區',
            'path' => 'subject_ability/c_3',
            'path_text' => ' > 英聽主選單 > 試場分配 > 第三分區',
            'datalist' => $this->mod_ability_part_info->get_list('2503'),
            'addr_info' => $addr_info,
        );
        $this->load->view('layout', $data);
    }

    public function c_4()
    {
        $this->mod_user->chk_status();
        $this->load->model('mod_ability_part_addr');
        $year = $this->session->userdata('year');

        if ($this->mod_ability_part_addr->chk_once($year)) {
            $addr_info = $this->mod_ability_part_addr->get_once($year);
        } else {
            $addr_info = array(
                'part_addr_1' => '',
                'part_addr_2' => '',
                'part_addr_3' => '',
            );
        }

        $data = array(
            'title' => '分區地址',
            'path' => 'subject_ability/c_4',
            'path_text' => ' > 英聽主選單 > 分區地址',
            'addr_info' => $addr_info,
        );
        $this->load->view('layout', $data);
    }

    /**
     * d 試場分配.
     */
     public function d()
     {
         $this->load->model('mod_ability_part_info');
         $this->mod_user->chk_status();
         $data = array(
             'title' => '試場人員指派',
             'path' => 'subject_ability/d',
             'path_text' => ' > 英聽主選單 > 試場人員指派',
             'datalist' => $this->mod_ability_part_info->get_list(),
         );
         $this->load->view('layout', $data);
     }

     public function d_1()
     {
         $this->load->model('mod_ability_part_info');
         $this->load->model('mod_ability_trial');
         $this->mod_user->chk_status();
         $year = $this->session->userdata('year');
         $part1 = $this->mod_ability_trial->get_list('2501');
         $part2 = $this->mod_ability_trial->get_list('2502');
         $part3 = $this->mod_ability_trial->get_list('2503');
         $data = array(
             'title' => '監試人員指派',
             'path' => 'subject_ability/d_1',
             'path_text' => ' > 英聽主選單 > 試場人員指派 > 監試人員指派',
             'part1' => $part1,
             'part2' => $part2,
             'part3' => $part3,
         );
 
         $this->load->view('layout', $data);
     }
     public function d_2()
     {
         $this->load->model('mod_ability_part_info');
         $this->load->model('mod_ability_trial');
         $this->load->model('mod_ability_exam_area');
         $this->load->model('mod_ability_exam_datetime');
         $this->mod_user->chk_status();
         $year = $this->session->userdata('year');
         $part = $this->mod_ability_exam_area->get_part('2501');
         $part1 = $this->mod_ability_trial->get_trial_list('2501');
         $part2 = $this->mod_ability_trial->get_trial_list('2502');
         $part3 = $this->mod_ability_trial->get_trial_list('2503');
         if ($this->mod_ability_exam_datetime->chk_once($year)) {
             $datetime_info = $this->mod_ability_exam_datetime->get_once($year);
         } else {
             $datetime_info = array(
                 'day_1' => '07/01',
                 'day_2' => '07/02',
                 'day_3' => '07/03',
             );
         }
         $data = array(
             'title' => '管卷人員指派',
             'path' => 'subject_ability/d_2',
             'path_text' => ' > 英聽主選單 > 試場人員指派 > 管卷人員指派',
             'part' => $part,
             'part1' => $part1,
             'part2' => $part2,
             'part3' => $part3,
             'datetime_info' => $datetime_info,
         );
         $this->load->view('layout', $data);
     }
     public function d_3()
     {
         $this->load->model('mod_ability_patrol');
         $this->load->model('mod_ability_trial');
         $this->load->model('mod_ability_exam_area');
         $this->mod_user->chk_status();
         $year = $this->session->userdata('year');
         $part = $this->mod_ability_exam_area->get_part('2501');
         $part1 = $this->mod_ability_patrol->get_patrol_list('2501');
         $part2 = $this->mod_ability_patrol->get_patrol_list('2502');
         $part3 = $this->mod_ability_patrol->get_patrol_list('2503');
         $data = array(
             'title' => '巡場人員指派',
             'path' => 'subject_ability/d_3',
             'path_text' => ' > 英聽主選單 > 試場人員指派 > 巡場人員指派',
             'part' => $part,
             'part1' => $part1,
             'part2' => $part2,
             'part3' => $part3,
         );
         $this->load->view('layout', $data);
     }

     public function d_4()
     {
         $this->load->model('mod_ability_part_info');
         $this->load->model('mod_ability_trial');
         $this->load->model('mod_ability_exam_datetime');
         $this->load->model('mod_ability_exam_fees');
         $this->mod_user->chk_status();
         $year = $this->session->userdata('year');
         $part1 = $this->mod_ability_trial->get_list('2501');
         $part2 = $this->mod_ability_trial->get_list('2502');
         $part3 = $this->mod_ability_trial->get_list('2503');
         if ($this->mod_ability_exam_fees->chk_once($year)) {
             $fees_info = $this->mod_ability_exam_fees->get_once($year);
         } else {
             $fees_info = array(
                 'one_day_salary' => '0',
                 'salary_section' => '0',
                 'lunch_fee' => '0',
             );
         }
         if ($this->mod_ability_exam_datetime->chk_once($year)) {
             $datetime_info = $this->mod_ability_exam_datetime->get_once($year);
         } else {
             $datetime_info = array(
                 'day_1' => '07/01',
                 'day_2' => '07/02',
                 'day_3' => '07/03',
             );
         }
         $data = array(
             'title' => '監試人員列表',
             'path' => 'subject_ability/d_4',
             'path_text' => ' > 英聽主選單 > 試場人員指派 > 監試人員列表',
             'part1' => $part1,
             'part2' => $part2,
             'part3' => $part3,
             'fees_info' => $fees_info,
             'datetime_info' => $datetime_info,
         );
         $this->load->view('layout', $data);
     }

     public function d_5()
     {
         $this->load->model('mod_ability_trial');
         $this->load->model('mod_ability_exam_datetime');
         $this->load->model('mod_ability_exam_fees');
         $this->mod_user->chk_status();
         $year = $this->session->userdata('year');
         $part1 = $this->mod_ability_trial->get_trial_list('2501');
         $part2 = $this->mod_ability_trial->get_trial_list('2502');
         $part3 = $this->mod_ability_trial->get_trial_list('2503');
         if ($this->mod_ability_exam_fees->chk_once($year)) {
             $fees_info = $this->mod_ability_exam_fees->get_once($year);
         } else {
             $fees_info = array(
                 'one_day_salary' => '0',
                 'salary_section' => '0',
                 'lunch_fee' => '0',
             );
         }
         if ($this->mod_ability_exam_datetime->chk_once($year)) {
             $datetime_info = $this->mod_ability_exam_datetime->get_once($year);
         } else {
             $datetime_info = array(
                 'day_1' => '07/01',
                 'day_2' => '07/02',
                 'day_3' => '07/03',
             );
         }
         $data = array(
             'title' => '管卷人員列表',
             'path' => 'subject_ability/d_5',
             'path_text' => ' > 指考主選單 > 試場人員指派 > 管卷人員列表',
             'part1' => $part1,
             'part2' => $part2,
             'part3' => $part3,
             'fees_info' => $fees_info,
             'datetime_info' => $datetime_info,
         );
         $this->load->view('layout', $data);
     }








 

}

/* End of file Console.php */
