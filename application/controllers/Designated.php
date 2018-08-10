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
        $this->load->model('mod_part_info');
        $this->load->model('mod_trial');
        $this->load->model('mod_patrol');
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
            }
            // echo json_encode($datas);

            $this->mod_exam_area->import($datas);
            $this->mod_part_info->import($datas_part);
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

            $this->mod_staff->import($datas);
            fclose($file);
            unlink($file_name);
            redirect('designated/a_3');
            print_r(fgetcsv($file));
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

    public function a_4()
    {
        $this->load->model('mod_task');
        $this->load->model('mod_exam_area');
        $this->mod_user->chk_status();

        if (isset($_FILES['inputGroupFile00'])) { // 如果有接收到上傳檔案資料
            $file = $_FILES['inputGroupFile00']['tmp_name'];
            $file_name = './tmp/'.time().'.csv';
            copy($file, $file_name);
            $file = fopen($file_name, 'r');
            $datas = array();
            fgetcsv($file);
            $start = $this->mod_exam_area->get_min_start();
            $end = $this->mod_exam_area->get_max_end();
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
            $this->mod_task->import($area);
            fclose($file);
            unlink($file_name);
            redirect('designated/a_4');
        } elseif (isset($_FILES['inputGroupFile01'])) {
            $file = $_FILES['inputGroupFile01']['tmp_name'];
            $file_name = './tmp/'.time().'.csv';
            copy($file, $file_name);
            $file = fopen($file_name, 'r');
            $datas = array();
            fgetcsv($file);
            $start_1 = $this->mod_exam_area->get_min_start('2501');
            $end_1 = $this->mod_exam_area->get_max_end('2501');
            $start_2 = $this->mod_exam_area->get_min_start('2502');
            $end_2 = $this->mod_exam_area->get_max_end('2502');
            $start_3 = $this->mod_exam_area->get_min_start('2503');
            $end_3 = $this->mod_exam_area->get_max_end('2503');
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
                // $area_2[] = array(
                //     'year' => $this->session->userdata('year'),
                //     'area' => '第二分區',
                //     'job' => $data[0],
                //     'job_code' => '',
                //     'job_title' => '',
                //     'name' => '',
                //     'trial_start' => $start_2['field'],
                //     'trial_end' => $end_2['field'],
                //     'number' => '',
                //     'phone' => '',
                //     'note' => '',
                //     'do_date' => '',
                //     'day_count' => '',
                //     'one_day_salary' => '',
                //     'salary_total' => '',
                //     'lunch_price' => '',
                //     'lunch_total' => '',
                //     'total' => '',
                //     'status' => '1',
                //  );
                // $area_3[] = array(
                //     'year' => $this->session->userdata('year'),
                //     'area' => '第三分區',
                //     'job' => $data[0],
                //     'job_code' => '',
                //     'job_title' => '',
                //     'name' => '',
                //     'trial_start' => $start_3['field'],
                //     'trial_end' => $end_3['field'],
                //     'number' => '',
                //     'phone' => '',
                //     'note' => '',
                //     'do_date' => '',
                //     'day_count' => '',
                //     'one_day_salary' => '',
                //     'salary_total' => '',
                //     'lunch_price' => '',
                //     'lunch_total' => '',
                //     'total' => '',
                //     'status' => '1',
                //  );
            }
            // echo json_encode($datas);

            $this->mod_task->import_1($area_1);
            // $this->mod_task->import_2($area_2);
            // $this->mod_task->import_3($area_3);
            fclose($file);
            unlink($file_name);
            print_r(fgetcsv($file));
            redirect('designated/a_4');
        } elseif (isset($_FILES['inputGroupFile02'])) {
            $file = $_FILES['inputGroupFile02']['tmp_name'];
            $file_name = './tmp/'.time().'.csv';
            copy($file, $file_name);
            $file = fopen($file_name, 'r');
            $datas = array();
            fgetcsv($file);
            $start_2 = $this->mod_exam_area->get_min_start('2502');
            $end_2 = $this->mod_exam_area->get_max_end('2502');
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

            $this->mod_task->import_2($area_2);
            fclose($file);
            unlink($file_name);
            print_r(fgetcsv($file));
            redirect('designated/a_4');
        } elseif (isset($_FILES['inputGroupFile03'])) {
            $file = $_FILES['inputGroupFile03']['tmp_name'];
            $file_name = './tmp/'.time().'.csv';
            copy($file, $file_name);
            $file = fopen($file_name, 'r');
            $datas = array();
            fgetcsv($file);
            $start_3 = $this->mod_exam_area->get_min_start('2503');
            $end_3 = $this->mod_exam_area->get_max_end('2503');
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

            $this->mod_task->import_3($area_3);
            fclose($file);
            unlink($file_name);
            print_r(fgetcsv($file));
            redirect('designated/a_4');
        } else {
            $data = array(
                    'title' => '職務資料',
                    'path' => 'designated/a_4',
                    'path_text' => ' > 指考主選單 > 資料匯入作業 > 職務資料',
                    'all' => $this->mod_task->get_list(),
                    'b1' => $this->mod_task->get_list('考區'),
                    'b2' => $this->mod_task->get_list('第一分區'),
                    'b3' => $this->mod_task->get_list('第二分區'),
                    'b4' => $this->mod_task->get_list('第三分區'),
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
        $this->load->model('mod_exam_fees');
        $this->load->model('mod_exam_datetime');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $jobs = $this->mod_task->get_job_list($year, '考區');
        if ($this->mod_exam_fees->chk_once($year)) {
            $fees_info = $this->mod_exam_fees->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '0',
                'salary_section' => '0',
                'lunch_fee' => '0',
            );
        }
        if ($this->mod_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_exam_datetime->get_once($year);
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
            'path_text' => ' > 指考主選單 > 考區任務編組 > 考區',
            'field' => $this->mod_task->get_field(),
            'datalist' => $this->mod_task->get_list('考區'),
            'jobs' => $jobs,
            'fees_info' => $fees_info,
            'datetime_info' => $datetime_info,
        );

        $this->load->view('layout', $data);
    }

    public function b_2()
    {
        $this->load->model('mod_exam_area');
        $this->load->model('mod_task');
        $this->load->model('mod_exam_fees');
        $this->load->model('mod_exam_datetime');
        $this->load->model('mod_part');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $jobs = $this->mod_task->get_job_list($year, '第一分區');
        if ($this->mod_exam_fees->chk_once($year)) {
            $fees_info = $this->mod_exam_fees->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '0',
                'salary_section' => '0',
                'lunch_fee' => '0',
            );
        }

        if ($this->mod_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '07/01',
                'day_2' => '07/02',
                'day_3' => '07/03',
            );
        }
        $data = array(
            'title' => '考區任務編組',
            'path' => 'designated/b_2',
            'path_text' => ' > 指考主選單 > 考區任務編組 > 第一分區',
            'datalist' => $this->mod_task->get_list('第一分區'),
            'jobs' => $jobs,
            'fees_info' => $fees_info,
            'datetime_info' => $datetime_info,
        );
        $this->load->view('layout', $data);
    }

    public function b_3()
    {
        $this->load->model('mod_exam_area');
        $this->load->model('mod_task');
        $this->load->model('mod_exam_fees');
        $this->load->model('mod_part');
        $this->load->model('mod_exam_datetime');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $jobs = $this->mod_task->get_job_list($year, '第二分區');
        if ($this->mod_exam_fees->chk_once($year)) {
            $fees_info = $this->mod_exam_fees->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '0',
                'salary_section' => '0',
                'lunch_fee' => '0',
            );
        }
        if ($this->mod_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '07/01',
                'day_2' => '07/02',
                'day_3' => '07/03',
            );
        }
        $data = array(
            'title' => '考區任務編組',
            'path' => 'designated/b_3',
            'path_text' => ' > 指考主選單 > 考區任務編組 > 第二分區',
            'datalist' => $this->mod_task->get_list('第二分區'),
            'jobs' => $jobs,
            'fees_info' => $fees_info,
            'datetime_info' => $datetime_info,
        );
        $this->load->view('layout', $data);
    }

    public function b_4()
    {
        $this->load->model('mod_exam_area');
        $this->load->model('mod_task');
        $this->load->model('mod_part');
        $this->load->model('mod_exam_datetime');
        $this->load->model('mod_exam_fees');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $jobs = $this->mod_task->get_job_list($year, '第三分區');
        if ($this->mod_exam_fees->chk_once($year)) {
            $fees_info = $this->mod_exam_fees->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '0',
                'salary_section' => '0',
                'lunch_fee' => '0',
            );
        }
        if ($this->mod_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '07/01',
                'day_2' => '07/02',
                'day_3' => '07/03',
            );
        }
        $data = array(
            'title' => '考區任務編組',
            'path' => 'designated/b_4',
            'path_text' => ' > 指考主選單 > 考區任務編組 > 第三分區',
            'datalist' => $this->mod_task->get_list('第三分區'),
            'jobs' => $jobs,
            'fees_info' => $fees_info,
            'datetime_info' => $datetime_info,
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
     * C 試場分配.
     */
    public function c()
    {
        $this->load->model('mod_part_info');
        $this->mod_user->chk_status();
        $data = array(
            'title' => '試場分配',
            'path' => 'designated/c',
            'path_text' => ' > 指考主選單 > 試場分配',
            'datalist' => $this->mod_part_info->get_list(),
        );
        $this->load->view('layout', $data);
    }

    public function c_1()
    {
        $this->load->model('mod_part_info');
        $this->load->model('mod_part_addr');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');

        if ($this->mod_part_addr->chk_once($year)) {
            $addr_info = $this->mod_part_addr->get_once($year);
        } else {
            $addr_info = array(
                'part_addr_1' => '',
                'part_addr_2' => '',
                'part_addr_3' => '',
            );
        }

        $data = array(
            'title' => '第一分區',
            'path' => 'designated/c_1',
            'path_text' => ' > 指考主選單 > 試場分配 > 第一分區',
            'datalist' => $this->mod_part_info->get_list('2501'),
            'addr_info' => $addr_info,
        );
        $this->load->view('layout', $data);
    }

    public function c_2()
    {
        $this->load->model('mod_part_info');
        $this->load->model('mod_part_addr');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');

        if ($this->mod_part_addr->chk_once($year)) {
            $addr_info = $this->mod_part_addr->get_once($year);
        } else {
            $addr_info = array(
                'part_addr_1' => '',
                'part_addr_2' => '',
                'part_addr_3' => '',
            );
        }

        $data = array(
            'title' => '第二分區',
            'path' => 'designated/c_2',
            'path_text' => ' > 指考主選單 > 試場分配 > 第二分區',
            'datalist' => $this->mod_part_info->get_list('2502'),
            'addr_info' => $addr_info,
        );
        $this->load->view('layout', $data);
    }

    public function c_3()
    {
        $this->load->model('mod_part_info');
        $this->load->model('mod_part_addr');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');

        if ($this->mod_part_addr->chk_once($year)) {
            $addr_info = $this->mod_part_addr->get_once($year);
        } else {
            $addr_info = array(
                'part_addr_1' => '',
                'part_addr_2' => '',
                'part_addr_3' => '',
            );
        }

        $data = array(
            'title' => '第三分區',
            'path' => 'designated/c_3',
            'path_text' => ' > 指考主選單 > 試場分配 > 第三分區',
            'datalist' => $this->mod_part_info->get_list('2503'),
            'addr_info' => $addr_info,
        );
        $this->load->view('layout', $data);
    }

    public function c_4()
    {
        $this->mod_user->chk_status();
        $this->load->model('mod_part_addr');
        $year = $this->session->userdata('year');

        if ($this->mod_part_addr->chk_once($year)) {
            $addr_info = $this->mod_part_addr->get_once($year);
        } else {
            $addr_info = array(
                'part_addr_1' => '',
                'part_addr_2' => '',
                'part_addr_3' => '',
            );
        }

        $data = array(
            'title' => '分區地址',
            'path' => 'designated/c_4',
            'path_text' => ' > 指考主選單 > 分區地址',
            'addr_info' => $addr_info,
        );
        $this->load->view('layout', $data);
    }

    /**
     * d 試場分配.
     */
    public function d()
    {
        $this->load->model('mod_part_info');
        $this->mod_user->chk_status();
        $data = array(
            'title' => '試場人員指派',
            'path' => 'designated/d',
            'path_text' => ' > 指考主選單 > 試場人員指派',
            'datalist' => $this->mod_part_info->get_list(),
        );
        $this->load->view('layout', $data);
    }

    public function d_1()
    {
        $this->load->model('mod_part_info');
        $this->load->model('mod_trial');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $part1 = $this->mod_trial->get_list('2501');
        $part2 = $this->mod_trial->get_list('2502');
        $part3 = $this->mod_trial->get_list('2503');
        $data = array(
            'title' => '監視人員指派',
            'path' => 'designated/d_1',
            'path_text' => ' > 指考主選單 > 試場人員指派 > 監視人員指派',
            'part1' => $part1,
            'part2' => $part2,
            'part3' => $part3,
        );
        $this->load->view('layout', $data);
    }

    public function d_2()
    {
        $this->load->model('mod_part_info');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $this->load->model('mod_exam_datetime');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $part = $this->mod_exam_area->get_part('2501');
        $part1 = $this->mod_trial->get_trial_list('2501');
        $part2 = $this->mod_trial->get_trial_list('2502');
        $part3 = $this->mod_trial->get_trial_list('2503');
        if ($this->mod_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '07/01',
                'day_2' => '07/02',
                'day_3' => '07/03',
            );
        }
        $data = array(
            'title' => '管卷人員指派',
            'path' => 'designated/d_2',
            'path_text' => ' > 指考主選單 > 試場人員指派 > 管卷人員指派',
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
        $this->load->model('mod_patrol');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $part = $this->mod_exam_area->get_part('2501');
        $part1 = $this->mod_patrol->get_patrol_list('2501');
        $part2 = $this->mod_patrol->get_patrol_list('2502');
        $part3 = $this->mod_patrol->get_patrol_list('2503');
        $data = array(
            'title' => '巡場人員指派',
            'path' => 'designated/d_3',
            'path_text' => ' > 指考主選單 > 試場人員指派 > 巡場人員指派',
            'part' => $part,
            'part1' => $part1,
            'part2' => $part2,
            'part3' => $part3,
        );
        $this->load->view('layout', $data);
    }

    public function d_4()
    {
        $this->load->model('mod_part_info');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_datetime');
        $this->load->model('mod_exam_fees');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $part1 = $this->mod_trial->get_list('2501');
        $part2 = $this->mod_trial->get_list('2502');
        $part3 = $this->mod_trial->get_list('2503');
        if ($this->mod_exam_fees->chk_once($year)) {
            $fees_info = $this->mod_exam_fees->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '0',
                'salary_section' => '0',
                'lunch_fee' => '0',
            );
        }
        if ($this->mod_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '07/01',
                'day_2' => '07/02',
                'day_3' => '07/03',
            );
        }
        $data = array(
            'title' => '監視人員列表',
            'path' => 'designated/d_4',
            'path_text' => ' > 指考主選單 > 試場人員指派 > 監視人員列表',
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
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_datetime');
        $this->load->model('mod_exam_fees');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $part1 = $this->mod_trial->get_trial_list('2501');
        $part2 = $this->mod_trial->get_trial_list('2502');
        $part3 = $this->mod_trial->get_trial_list('2503');
        if ($this->mod_exam_fees->chk_once($year)) {
            $fees_info = $this->mod_exam_fees->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '0',
                'salary_section' => '0',
                'lunch_fee' => '0',
            );
        }
        if ($this->mod_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '07/01',
                'day_2' => '07/02',
                'day_3' => '07/03',
            );
        }
        $data = array(
            'title' => '管卷人員列表',
            'path' => 'designated/d_5',
            'path_text' => ' > 指考主選單 > 試場人員指派 > 管卷人員列表',
            'part1' => $part1,
            'part2' => $part2,
            'part3' => $part3,
            'fees_info' => $fees_info,
            'datetime_info' => $datetime_info,
        );
        $this->load->view('layout', $data);
    }

    public function d_6()
    {
        $this->load->model('mod_patrol');
        $this->load->model('mod_exam_datetime');
        $this->load->model('mod_exam_fees');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $part1 = $this->mod_patrol->get_patrol_list('2501');
        $part2 = $this->mod_patrol->get_patrol_list('2502');
        $part3 = $this->mod_patrol->get_patrol_list('2503');
        if ($this->mod_exam_fees->chk_once($year)) {
            $fees_info = $this->mod_exam_fees->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '0',
                'salary_section' => '0',
                'lunch_fee' => '0',
            );
        }
        if ($this->mod_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '07/01',
                'day_2' => '07/02',
                'day_3' => '07/03',
            );
        }
        $data = array(
            'title' => '巡場人員列表',
            'path' => 'designated/d_6',
            'path_text' => ' > 指考主選單 > 試場人員指派 > 巡場人員列表',
            'part1' => $part1,
            'part2' => $part2,
            'part3' => $part3,
            'fees_info' => $fees_info,
            'datetime_info' => $datetime_info,
        );
        $this->load->view('layout', $data);
    }

    /**
     * 考區任務編組.
     */
    public function e()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '製作報表',
            'path' => 'designated/e',
            'path_text' => ' > 製作報表',
        );
        $this->load->view('layout', $data);
    }

    public function e_1()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '名單 / 資料 / 統計表',
            'path' => 'designated/e_1',
            'path_text' => ' > 製作報表 > 名單 / 資料 / 統計表',
        );
        $this->load->view('layout', $data);
    }

    public function e_1_1()
    {
        $this->load->library('pdf');
        $this->load->model('mod_school_unit');
        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '行政單位';
        $date = date('yyyy/m/d');
        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
        $obj_pdf->setPrintHeader(false);
        // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', 'B', 13);

        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->AddPage();
        $data = array(
            'list' => $this->mod_school_unit->year_get_list(),
        );
        // print_r($data);
        $view =  $this->load->view('designated/e_1_1', $data, true);
        $obj_pdf->writeHTML($view);
        $obj_pdf->Output('行政單位.pdf', 'I');
    }

    public function e_1_2()
    {
        $this->load->library('pdf');
        $this->load->model('mod_task');
        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '請公假名單';
        $date = date('yyyy/m/d');
        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
        $obj_pdf->setPrintHeader(false);
        // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', 'B', 10);
        $obj_pdf->SetCellPadding(0);

        $obj_pdf->setFontSubsetting(false);

        $obj_pdf->AddPage();
        $data = array(
            'list' => $this->mod_task->get_list_for_pdf(),
        );
        // print_r($data);
        $view =  $this->load->view('designated/e_1_2', $data, true);
        $obj_pdf->writeHTML($view);
        $obj_pdf->Output('請公假名單.pdf', 'I');
    }

    public function e_1_3()
    {
        $this->load->library('pdf');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');

        $part = $_GET['part'];
        $area = $_GET['area'];
        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '監試及試務人員一覽表';
        $date = date('yyyy/m/d');
        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
        $obj_pdf->setPrintHeader(false);
        // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', 'B', 10);

        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->AddPage();
        $data = array(
            'part' => $this->mod_trial->get_list_for_pdf($part),
            'area' => $area,
            'school' => $this->mod_exam_area->year_school_name($part),
        );
        $view =  $this->load->view('designated/e_1_3', $data, true);
        $obj_pdf->writeHTML($view);
        $obj_pdf->Output('監試及試務人員一覽表.pdf', 'I');
    }

    public function e_1_4()
    {
        $this->load->library('pdf');
        $this->load->model('mod_exam_area');
        $this->load->model('mod_exam_datetime');
        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '缺考人數統計';
        $year = $this->session->userdata('year');

        $date = date('yyyy/m/d');
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(3, 2, 3, 0);

        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', '', 8);

        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->SetCellPadding(0);

        $obj_pdf->AddPage();
        $part = $_GET['part'];
        $area = $_GET['area'];
        
        if ($this->mod_exam_datetime->chk_course($year)) {
            $course = $this->mod_exam_datetime->get_course($year);
        } else {
            $course = array();
            for ($i = 0; $i <= 12; ++$i) {
                $course[$i]['subject'] = '';
            }
        }
        if ($this->mod_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '07/01',
                'day_2' => '07/02',
                'day_3' => '07/03',
            );
        }
        
        $data = array(
            'list' => $this->mod_exam_area->year_get_list($part),
            'school' => $this->mod_exam_area->year_school_name($part),
            'course' => $this->mod_exam_datetime->get_course($year),
            'datetime_info'=>$datetime_info,
            'area'=>$area
        );
        $view =  $this->load->view('designated/e_1_4', $data, true);
        $obj_pdf->writeHTML($view);
        $obj_pdf->Output('缺考人數統計.pdf', 'I');
    }

    public function e_1_5()
    {
        $this->load->library('pdf');
        $this->load->model('mod_trial');
        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $part = $_GET['part'];
        $area = $_GET['area'];

        $title = $area.'監試人員午餐一覽表';
        $date = date('yyyy/m/d');
        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
        $obj_pdf->setPrintHeader(false);
        // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', 'B', 10);

        $obj_pdf->setFontSubsetting(false);
        
        $obj_pdf->AddPage();
        $data = array(
            'part' => $this->mod_trial->get_dinner_list_for_pdf($part),
            'area' => $area,
            // 'deal' => $this->mod_trial->get_all_meal_count($part),
        );
        $view =  $this->load->view('designated/e_1_5', $data, true);
        $obj_pdf->writeHTML($view);
        $obj_pdf->Output($area.'監試人員午餐一覽表.pdf', 'I');
    }

    public function e_2()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '簽到表 / 簽收單',
            'path' => 'designated/e_2',
            'path_text' => ' > 製作報表 > 簽到表 / 簽收單',
        );
        $this->load->view('layout', $data);
    }

    public function e_2_1()
    {
        $this->load->library('pdf');
        $this->load->model('mod_task');
        $this->load->model('mod_exam_area');
        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '試務人員執行任務簽到表';
        $area = $_GET['area'];
        if($_GET['part'] != "2500"){
            $part = $_GET['part'];
            $school = $this->mod_exam_area->year_school_name($part);
        }else{
            $school = "";
        }
        $date = date('yyyy/m/d');
        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
        $obj_pdf->setPrintHeader(false);
        // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', 'B', 10);

        $obj_pdf->setFontSubsetting(false);
        
        $data = array(
            'part' => $this->mod_task->e_2_1($area),
            'area' => $area,
            'own'=> $this->mod_task->get_member_own_count($area),
            'veg'=> $this->mod_task->get_member_veg_count($area),
            'meat'=> $this->mod_task->get_member_meat_count($area),
            'school' => $school,
        );
        if ($data['part'] != false) {
            foreach ($data['part'] as $k => $v) {
                # code...
                $html = '<table class="" id="" style="padding:5px 0px;;text-align:center;">';
                $html .= '<tr>';
                $html .= '<td style="font-size:16px;lne-height:50px;" colspan="6">'.$_SESSION['year'].'學年度定科目考試新北一考區試務人員簽到表</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td colspan="2" style="font-size:14px;text-align:left;">分區：'.$area.'</td>';
                $html .= '<td colspan="2" style="font-size:14px;">'.$school.'</td>';
                $html .= '<td colspan="2" style="font-size:14px;text-align:right;">簽到日期：'.$k.'</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<th style="border:1px solid #999">職務</th>';
                $html .= '<th style="border:1px solid #999">姓名</th>';
                $html .= '<th style="border:1px solid #999">單位別</th>';
                $html .= '<th style="border:1px solid #999">簽名</th>';
                $html .= '<th style="border:1px solid #999" colspan="2">備註(工作分配)</th>';
                $html .= '</tr>';
                        
                foreach ($v as $kc => $vc) {
                    # code...
                    $html .= '<tr>';
                    $html .= '<td style="border:1px solid #999">'.$vc['job'].'</td>';
                    $html .= '<td style="border:1px solid #999">'.$vc['name'].'<br><span style="color:#ff0000">'.$vc['meal'].'</span></td>';'</td>';
                    $html .= '<td style="border:1px solid #999">'.$vc['member_unit'].'</td>';
                    $html .= '<td style="border:1px solid #999"></td>';
                    $html .= '<td style="border:1px solid #999" colspan="2">'.$vc['note'].'</td>';
                    $html .= '</tr>';
                }
                $html .= '<tr>';
                $html .= '<td colspan="6" style="font-size:16px;text-align:left;">共計：'.(count($v)).'人、'.'自備共'.$data['own'].'人、'.'素食共'.$data['veg'].'人、'.'葷食共'.$data['veg'].'人</td>';
                $html .= '</tr>';

                $html .= '</table>';


                $obj_pdf->AddPage($html);

                $obj_pdf->writeHTML($html);
            }
        }

        $obj_pdf->Output('試務人員執行任務簽到表.pdf', 'I');
    }

    public function e_2_2()
    {
        $this->load->library('pdf');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '監試人員執行任務簽到表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
        $obj_pdf->setPrintHeader(false);
        // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', 'B', 10);

        $obj_pdf->setFontSubsetting(false);

        $year = $this->session->userdata('year');
        $data = array(
            'part' => $this->mod_trial->get_date_for_trial_list($part),
            'area' =>$area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'own'=>$this->mod_trial->get_trial_member_own_count($part),
            'veg'=>$this->mod_trial->get_trial_member_veg_count($part),
            'meat'=>$this->mod_trial->get_trial_member_meat_count($part),
        );
        if($data['part'] != false){
            foreach ($data['part'] as $k => $v) {
                # code...
                $html = '<table class="" id="" style="padding:5px 0px;;text-align:center;">';
                $html .= '<tr>';
                $html .= '<td style="font-size:16px;lne-height:50px;" colspan="7">'.$_SESSION['year'].'學年度定科目考試新北一考區監試人員簽到表</td>';
                $html .= '</tr>';
                $html .= '<tr>';

                $html .= '<td colspan="2" style="font-size:14px;">分區：'.$part.'</td>';
                $html .= '<td colspan="3" style="font-size:14px;">'.$data['school'].'</td>';
                $html .= '<td colspan="2" style="font-size:14px;">簽到日期：'.$k.'</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<th style="border:1px solid #999" rowspan="2">試場</th>';
                $html .= '<th style="border:1px solid #999" colspan="2" class="bb">監試人員(1)</th>';
                $html .= '<th style="border:1px solid #999" rowspan="2">簽名</th>';
                $html .= '<th style="border:1px solid #999" colspan="2" class="bb">監試人員(2)</th>';
                $html .= '<th style="border:1px solid #999" rowspan="2">簽名</th>';
                $html .= '</tr>';

                $html .= '<tr>';
                $html .= '<td style="border:1px solid #999">姓名</td>';
                $html .= '<td style="border:1px solid #999">單位別</td>';
                $html .= '<td style="border:1px solid #999">姓名</td>';
                $html .= '<td style="border:1px solid #999">單位別</td>';
                $html .= '</tr>';
                        
                foreach ($v as $kc => $vc) {
                    # code...
                    $html .= '<tr>';
                    $html .= '<td style="border:1px solid #999">'.$vc['field'].'</td>';
                    $html .= '<td style="border:1px solid #999">'.$vc['supervisor_1'].'<br><span style="color:#ff0000">'.$vc['meal1'].'</span></td>';
                    $html .= '<td style="border:1px solid #999">'.$vc['supervisor_1_unit'].'</td>';
                    $html .= '<td style="border:1px solid #999"></td>';
                    $html .= '<td style="border:1px solid #999">'.$vc['supervisor_2'].'<br><span style="color:#ff0000">'.$vc['meal2'].'</span></td>';
                    $html .= '<td style="border:1px solid #999">'.$vc['supervisor_2_unit'].'</td>';
                    $html .= '<td style="border:1px solid #999"></td>';
                    $html .= '</tr>';
                }
                $html .= '<tr>';
                $html .= '<td colspan="7" style="font-size:16px;text-align:left;">共計：'.(count($v)*2).'人、'.'自備共'.$data['own'].'人、'.'素食共'.$data['veg'].'人、'.'葷食共'.$data['veg'].'人</td>';
                $html .= '</tr>';
                $html .= '</table>';


                $obj_pdf->AddPage($html);

                $obj_pdf->writeHTML($html);
            }

        }
        
        // $this->load->view('designated/e_2_2', $data);
        // $obj_pdf->writeHTML($view); 
        $obj_pdf->Output('監試人員執行任務簽到表.pdf', 'I');
    }

    public function e_2_3()
    {
        $this->load->library('pdf');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $this->load->model('mod_exam_datetime');

        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '試場工作人員分配表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];
        
        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
        $obj_pdf->setPrintHeader(false);
        // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', 'L', 10);
        $year = $this->session->userdata('year');

        $datetime_info = $this->mod_exam_datetime->get_once($year);

        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->AddPage();
        $data = array(
            'part' => $this->mod_trial->get_list_for_voucher($part),
            'area' => $area,
            'datetime_info' => $datetime_info,
            'count'=> $this->mod_trial->get_patrol_member_count($part),
            'school' => $this->mod_exam_area->year_school_name($part),
        );
        // print_r($data);
        $view = $this->load->view('designated/e_2_3', $data,true);
        $obj_pdf->writeHTML($view);
        $obj_pdf->Output('試場工作人員分配表.pdf', 'I');
    }    

    public function e_2_4()
    {
        $this->load->library('pdf');
        $this->load->model('mod_task');
        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '監試說明會簽到表';
        $date = date('yyyy/m/d');

        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
        $obj_pdf->setPrintHeader(false);
        // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', 'B', 10);

        $obj_pdf->setFontSubsetting(false);
        $data = array(
            'part' => $this->mod_task->get_sign_list(),
        );
        if($data['part'] != false){
            foreach ($data['part'] as $k => $v) {
                $html = '<table style="padding:5px 0px;text-align:center;">';
                $html .=  '<tr>';
                $html .=  '<td colspan="5" style="font-size:14px;">大學入學考試中心'.$_SESSION['year'].'學年度定科目考試新北一考區監視說明會開會通知簽收表</td>';
                $html .=  '</tr>';

                $html .=  '<tr>';
                $html .=  '<td colspan="6" style="font-size:13px;text-align:left;">單位：'.$k.'</td>';
                $html .=  '</tr>';
                $html .=  '<tr style="background:#FFE4E7">';
                $html .=  '<th style="border: 1px solid #999999;">職務</th>';
                $html .=  '<th style="border: 1px solid #999999;">姓名</th>';
                $html .=  '<th style="border: 1px solid #999999;">單位別</th>';
                $html .=  '<th style="border: 1px solid #999999;">簽名</th>';
                $html .=  '<th style="border: 1px solid #999999;">備註</th>';
                $html .=  '</tr>';
                foreach ($v as $kc => $vc) {
                    $html .=   '<tr>';
                    $html .=  '<td  style="border: 1px solid #999999;">'.$vc['job'].'</td>';
                    $html .=  '<td  style="border: 1px solid #999999;">'.$vc['member_name'].'</td>';
                    $html .=  '<td  style="border: 1px solid #999999;">'.$vc['member_unit'].'</td>';
                    $html .=  '<td  style="border: 1px solid #999999;"></td>';
                    $html .=  '<td  style="border: 1px solid #999999;"></td>';
                    $html .=  '</tr>';
                }
                $html .= '<tr>';
                $html .= '<td colspan="5" style="font-size:13px;text-align:left;">共計：'.count($v).'人</td>';
                $html .=  '</tr>';
                    
                $html .=  '</table>';

                $obj_pdf->AddPage($html);

                $obj_pdf->writeHTML($html);
            }
        }
        $obj_pdf->Output('監試說明會簽到表.pdf', 'I');
    }

    public function e_2_5()
    {
        $this->load->library('pdf');
        $this->load->model('mod_task');
        $this->load->model('mod_exam_area');

        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '大學入學考試中心'.$_SESSION['year'].'學年度定科目考試新北一考區監視說明會開會通知簽收表';

        $date = date('yyyy/m/d');
        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
        $obj_pdf->setPrintHeader(false);
        // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', 'B', 10);

        $obj_pdf->setFontSubsetting(false);
        $data = array(
            'part' => $this->mod_task->get_sign_list(),
        );
        if($data['part'] != false){
            foreach ($data['part'] as $k => $v) {
                $html = '<table style="padding:5px 0px;text-align:center;">';
                $html .=  '<tr>';
                $html .=  '<td colspan="6" style="font-size:14px;">大學入學考試中心'.$_SESSION['year'].'學年度定科目考試新北一考區監視說明會開會通知簽收表</td>';
                $html .=  '</tr>';

                $html .=  '<tr>';
                $html .=  '<td colspan="6" style="font-size:13px;text-align:left;">單位：'.$k.'</td>';
                $html .=  '</tr>';
                $html .=  '<tr style="background:#FFE4E7">';
                $html .=  '<th style="border: 1px solid #999999;">編號</th>';
                $html .=  '<th style="border: 1px solid #999999;">職務</th>';
                $html .=  '<th style="border: 1px solid #999999;">姓名</th>';
                $html .=  '<th style="border: 1px solid #999999;">單位別</th>';
                $html .=  '<th style="border: 1px solid #999999;">簽名</th>';
                $html .=  '<th style="border: 1px solid #999999;">備註</th>';
                $html .=  '</tr>';
                foreach ($v as $kc => $vc) {
                    $html .=   '<tr>';
                    $html .=  '<td  style="border: 1px solid #999999;">'.$vc['member_code'].'</td>';

                    $html .=  '<td  style="border: 1px solid #999999;">'.$vc['job'].'</td>';
                    $html .=  '<td  style="border: 1px solid #999999;">'.$vc['member_name'].'</td>';
                    $html .=  '<td  style="border: 1px solid #999999;">'.$vc['member_unit'].'</td>';
                    $html .=  '<td  style="border: 1px solid #999999;"></td>';
                    $html .=  '<td  style="border: 1px solid #999999;"></td>';
                    $html .=  '</tr>';
                }
                $html .= '<tr>';
                $html .= '<td colspan="5" style="font-size:13px;text-align:left;">共計：'.count($v).'人</td>';
                $html .=  '</tr>';
                    
                $html .=  '</table>';

                $obj_pdf->AddPage($html);

                $obj_pdf->writeHTML($html);
            }

        }
        $obj_pdf->Output('大學入學考試中心'.$_SESSION['year'].'學年度定科目考試新北一考區監視說明會開會通知簽收表'.'.pdf', 'I');
    }


    public function e_3()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '日程表 / 分配表',
            'path' => 'designated/e_3',
            'path_text' => ' > 製作報表 > 日程表 / 分配表',
        );
        $this->load->view('layout', $data);
    }

    public function e_3_1()
    {
        $this->load->library('pdf');
        $this->load->model('mod_exam_datetime');
        $this->load->model('mod_trial');
        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '監試人員監考科目日程對照表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
        $obj_pdf->setPrintHeader(false);
        // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', 'B', 11);

        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->AddPage();
        $year = $this->session->userdata('year');

        $datetime_info = $this->mod_exam_datetime->get_once($year);
        $course = $this->mod_exam_datetime->get_course($year);
        $res = $this->mod_trial->get_supervisor_list($part);
        $course_info = $this->mod_exam_datetime->get_once_day_section_test($res);
        
        $data = array(
            'part' => $res,
            'area' =>$area,
            'course' => $course,
            'datetime_info' => $datetime_info,
            'course_info' => $course_info,
        );

        $view =  $this->load->view('designated/e_3_1', $data, true);

        $obj_pdf->writeHTML($view);
        $obj_pdf->Output('監試人員監考科目日程對照表.pdf', 'I');
    }

    public function e_3_2()
    {
        $this->load->library('pdf');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '試場工作人員分配表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
        $obj_pdf->setPrintHeader(false);
        // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', '', 12);

        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->AddPage();
        $data = array(
            'part' => $this->mod_trial->get_list_for_pdf($part),
            'area' => $area,
            'count'=> $this->mod_trial->get_patrol_member_count($part),
            'school' => $this->mod_exam_area->year_school_name($part),
        );
        // print_r($data);
        $view =  $this->load->view('designated/e_3_2', $data, true);
        $obj_pdf->writeHTML($view);
        $obj_pdf->Output('試場工作人員分配表.pdf', 'I');
    }

    public function e_4()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '監試務工作說明會教務處書函',
            'path' => 'designated/e_4',
            'path_text' => ' > 製作報表 > 監試務工作說明會教務處書函',
        );
        $this->load->view('layout', $data);
    }

    public function e_4_1()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '監試務工作說明會教務處書函',
            'path' => 'designated/e_4_1',
            'path_text' => ' > 製作報表 > 監試務工作說明會教務處書函',
        );
        $this->load->view('layout', $data);
    }

    public function e_4_1_1()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');
        $this->load->model('mod_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $res = $this->mod_patrol->get_patrol_list();
        for ($i=0; $i < count($res); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '試務人員');
            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $res[$i]['year']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $res[$i]['patrol_staff_name']);
        }


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="試務人員'. '.csv"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
    }

    public function e_4_1_2()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');
        $this->load->model('mod_trial');
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_trial->get_list_for_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '監試人員');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '監試日期');

            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['year']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['do_date']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="監試人員'.'.csv"');
        header('Cache-Control: max-age=0');

        

        $objWriter->save('php://output');
    }

    public function e_5()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '識別證 / 標籤',
            'path' => 'designated/e_5',
            'path_text' => ' > 製作報表 > 識別證 / 標籤',
        );
        $this->load->view('layout', $data);
    }

    public function e_5_1()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '識別證 / 標籤',
            'path' => 'designated/e_5_1',
            'path_text' => ' > 製作報表 > 識別證 / 標籤',
        );
        $this->load->view('layout', $data);
    }

    public function e_5_2()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '套印標籤',
            'path' => 'designated/e_5_2',
            'path_text' => ' > 製作報表 > 識別證 / 標籤 > 套印標籤',
        );
        $this->load->view('layout', $data);
    }

    public function e_5_1_1()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');
        $this->load->model('mod_trial');
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_trial->get_list_for_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '監試人員');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '編號');


            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['part_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), '監試人員');
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['member_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.(2+$i), $arr[$i]['member_code']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="監試人員名牌'.'.csv"');
        header('Cache-Control: max-age=0');

        

        $objWriter->save('php://output');
    }

    public function e_5_1_2()
    {
        $this->load->library('excel');
        $this->load->model('mod_task');
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_task->get_list_for_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '試務人員');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '編號');


            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['area']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.(2+$i), $arr[$i]['job_code']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="試務人員名牌'.'.csv"');
        header('Cache-Control: max-age=0');

        

        $objWriter->save('php://output');
    }

    public function e_5_2_1()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');
        $this->load->model('mod_trial');
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_trial->get_list_for_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '單位');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '監試人員');

            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $arr[$i]['name']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="監試人員標籤樣式'.'.csv"');
        header('Cache-Control: max-age=0');

        

        $objWriter->save('php://output');
    }

    public function e_5_2_2()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_patrol->get_patrol_for_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '單位');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '試務人員');

            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['member_unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $arr[$i]['member_name']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="試務人員標籤樣式'.'.csv"');
        header('Cache-Control: max-age=0');

        

        $objWriter->save('php://output');
    }


    public function e_6()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '印領清冊',
            'path' => 'designated/e_6',
            'path_text' => ' > 製作報表 > 印領清冊',
        );
        $this->load->view('layout', $data);
    }

    public function e_6_1()
    {
        $this->load->library('pdf');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '監試人員印領清冊';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];
        
        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
        $obj_pdf->setPrintHeader(false);
        // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(3, 3);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', '', 10);

        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->AddPage();
        $data = array(
            'part' => $this->mod_trial->get_list_for_pdf($part),
            'area'=> $area,
            'school' => $this->mod_exam_area->year_school_name($part),
        );
        $view =  $this->load->view('designated/e_6_1', $data, true);
        $obj_pdf->writeHTML($view);
        $obj_pdf->Output('監試人員印領清冊.pdf', 'I');
    }

    public function e_6_2()
    {
        $this->load->library('pdf');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '監試人員印領清冊';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];
        $obs = $_GET['obs'];

        
        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
        $obj_pdf->setPrintHeader(false);
        // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(3, 3);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', '', 10);

        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->AddPage();
        $data = array(
            'part' => $this->mod_trial->get_list_for_obs($part, $obs),
            'area'=> $area,
            'school' => $this->mod_exam_area->year_school_name($part),
        );
        $view =  $this->load->view('designated/e_6_2', $data, true);
        $obj_pdf->writeHTML($view);
        $obj_pdf->Output('監試人員印領清冊.pdf', 'I');
    }

    public function e_7()
    {
        $this->load->library('excel');
        $this->load->model('mod_task');
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_task->get_list_for_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '職員代碼');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '單位');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '職稱');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '執勤日期');



            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['job_code']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['member_unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.(2+$i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.(2+$i), $arr[$i]['do_date']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="檔案匯出'.'.csv"');
        header('Cache-Control: max-age=0');

        

        $objWriter->save('php://output');
    }

    public function e_7_1()
    {
        $this->load->library('excel');
        $this->load->model('mod_trial');
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $part = $_GET['part'];
        $area = $_GET['area'];

        $arr = $this->mod_trial->get_list_for_pdf($part);
        for ($i=0; $i < count($arr); $i++) {
            # code...
            if ($arr[$i]['order_meal1'] == "N") {
                $first_member_section_lunch_total = 0;
            } else {
                $first_member_section_lunch_total = number_format(abs($arr[$i]['first_member_section_lunch_total']));
            }
            if ($arr[$i]['order_meal1'] == "N") {
                $first_member_section_salary_total = number_format($arr[$i]['first_member_section_salary_total'] - 0);
            } else {
                $first_member_section_salary_total =  number_format($arr[$i]['first_member_section_salary_total'] - abs($arr[$i]['first_member_section_lunch_total']));
            }

            if ($arr[$i]['order_meal2'] == "N") {
                $second_member_section_lunch_total = 0;
            } else {
                $second_member_section_lunch_total = number_format(abs($arr[$i]['second_member_section_lunch_total']));
            }
            if ($arr[$i]['order_meal2'] == "N") {
                $second_member_section_salary_total = number_format($arr[$i]['second_member_section_salary_total'] - 0);
            } else {
                $second_member_section_salary_total =  number_format($arr[$i]['second_member_section_salary_total'] - abs($arr[$i]['second_member_section_lunch_total']));
            }
            

            $objPHPExcel->getActiveSheet()->setCellValue('A0','');
            $objPHPExcel->getActiveSheet()->setCellValue('A1','試場');

            $objPHPExcel->getActiveSheet()->setCellValue('B1', '監考費');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '餐費');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '監考費');
            $objPHPExcel->getActiveSheet()->setCellValue('G1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '餐費');
            $objPHPExcel->getActiveSheet()->setCellValue('I1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['field']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), number_format($arr[$i]['first_member_salary_section']));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['supervisor_1']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.(2+$i), $first_member_section_lunch_total);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.(2+$i), $second_member_section_salary_total);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.(2+$i), number_format($arr[$i]['second_member_salary_section']));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.(2+$i), $arr[$i]['supervisor_2']);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.(2+$i), $second_member_section_lunch_total);
            $objPHPExcel->getActiveSheet()->setCellValue('I'.(2+$i), $second_member_section_salary_total);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$area.'印領清冊'.'.csv"');
        header('Cache-Control: max-age=0');

        

        $objWriter->save('php://output');
    }    

    public function e_7_2()
    {
        $this->load->library('excel');
        $this->load->model('mod_trial');
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $part = $_GET['part'];
        $area = $_GET['area'];
        $obs = $_GET['obs'];


        $arr = $this->mod_trial->get_list_for_obs($part, $obs);
        for ($i=0; $i < count($arr); $i++) {
            # code...
            if ($arr[$i]['order_meal1'] == "N") {
                $first_member_section_lunch_total = 0;
            } else {
                $first_member_section_lunch_total = number_format(abs($arr[$i]['first_member_section_lunch_total']));
            }
            if ($arr[$i]['order_meal1'] == "N") {
                $first_member_section_salary_total = number_format($arr[$i]['first_member_section_salary_total'] - 0);
            } else {
                $first_member_section_salary_total =  number_format($arr[$i]['first_member_section_salary_total'] - abs($arr[$i]['first_member_section_lunch_total']));
            }

            if ($arr[$i]['order_meal2'] == "N") {
                $second_member_section_lunch_total = 0;
            } else {
                $second_member_section_lunch_total = number_format(abs($arr[$i]['second_member_section_lunch_total']));
            }
            if ($arr[$i]['order_meal2'] == "N") {
                $second_member_section_salary_total = number_format($arr[$i]['second_member_section_salary_total'] - 0);
            } else {
                $second_member_section_salary_total =  number_format($arr[$i]['second_member_section_salary_total'] - abs($arr[$i]['second_member_section_lunch_total']));
            }
            

            $objPHPExcel->getActiveSheet()->setCellValue('A1','試場');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '監考費');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '餐費');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '監考費');
            $objPHPExcel->getActiveSheet()->setCellValue('G1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '餐費');
            $objPHPExcel->getActiveSheet()->setCellValue('I1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['field']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), number_format($arr[$i]['first_member_salary_section']));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['supervisor_1']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.(2+$i), $first_member_section_lunch_total);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.(2+$i), $second_member_section_salary_total);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.(2+$i), number_format($arr[$i]['second_member_salary_section']));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.(2+$i), $arr[$i]['supervisor_2']);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.(2+$i), $second_member_section_lunch_total);
            $objPHPExcel->getActiveSheet()->setCellValue('I'.(2+$i), $second_member_section_salary_total);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$area.'印領清冊'.'.csv"');
        header('Cache-Control: max-age=0');

        

        $objWriter->save('php://output');
    }      

    /**
     * F 考程設定.
     */
    public function f()
    {
        $this->mod_user->chk_status();

        $data = array(
            'title' => '考程設定',
            'path' => 'designated/f',
            'path_text' => ' > 指考主選單 > 考程設定',
        );
        $this->load->view('layout', $data);
    }

    public function f_1()
    {
        $this->mod_user->chk_status();
        $this->load->model('mod_exam_datetime');
        $year = $this->session->userdata('year');

        if ($this->mod_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '1911' + $this->session->userdata('year').'/07/01',
                'day_2' => '1911' + $this->session->userdata('year').'/07/02',
                'day_3' => '1911' + $this->session->userdata('year').'/07/03',
                'course_1_start' => '08:40',
                'course_1_end' => '10:00',
                'course_2_start' => '10:50',
                'course_2_end' => '12:00',
                'course_3_start' => '14:00',
                'course_3_end' => '15:20',
                'course_4_start' => '16:01',
                'course_4_end' => '17:30',
                'pre_1' => '08:25',
                'pre_2' => '10:45',
                'pre_3' => '13:55',
                'pre_4' => '16:05',
            );
        }
        $data = array(
            'title' => '考試日期與時間',
            'path' => 'designated/f_1',
            'path_text' => ' > 指考主選單 > 考程設定 > 考試日期與時間',
            'datetime_info' => $datetime_info,
        );
        $this->load->view('layout', $data);
    }

    public function f_1_act()
    {
        $this->load->model('mod_exam_datetime');
        $year = $this->session->userdata('year');
        $data = $_POST;
        $data['year'] = $year;

        if ($this->mod_exam_datetime->chk_once($year)) {
            $this->mod_exam_datetime->update_once($year, $data);
        } else {
            $this->mod_exam_datetime->add_once($data);
        }
        redirect('./designated/f_1');
    }

    public function f_2()
    {
        $this->mod_user->chk_status();
        $this->load->model('mod_exam_datetime');
        $year = $this->session->userdata('year');
        $datetime_info = $this->mod_exam_datetime->get_once($year);

        $course = $this->mod_exam_datetime->get_course($year);

        $data = array(
            'title' => '考試科目',
            'path' => 'designated/f_2',
            'path_text' => ' > 指考主選單 > 考程設定 > 考試科目',
            'datetime_info' => $datetime_info,
            'course' => json_encode($course),
        );
        $this->load->view('layout', $data);
    }

    // public function f_2_act()
    // {
    //     $this->load->model('mod_exam_datetime');
    //     $year = $this->session->userdata('year');

    //     $this->mod_exam_datetime->clean_course($year);

    //     $this->mod_exam_datetime->setting_course($year, $_POST);

    //     // redirect('./designated/f_2');
    // }

    public function f_3()
    {
        $this->mod_user->chk_status();
        $this->load->model('mod_exam_datetime');
        $year = $this->session->userdata('year');

        if ($this->mod_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => date('Y').'/07/01',
                'day_2' => date('Y').'/07/02',
                'day_3' => date('Y').'/07/03',
                'course_1_start' => '08:40',
                'course_1_end' => '10:00',
                'course_2_start' => '10:50',
                'course_2_end' => '12:00',
                'course_3_start' => '14:00',
                'course_3_end' => '15:20',
                'course_4_start' => '16:01',
                'course_4_end' => '17:30',
                'pre_1' => '08:25',
                'pre_2' => '10:45',
                'pre_3' => '13:55',
                'pre_4' => '16:05',
            );
        }

        if ($this->mod_exam_datetime->chk_course($year)) {
            $course = $this->mod_exam_datetime->get_course($year);
        } else {
            $course = array();
            for ($i = 0; $i <= 12; ++$i) {
                $course[$i]['subject'] = '';
            }
        }
        $data = array(
            'title' => '預覽考程表',
            'path' => 'designated/f_3',
            'path_text' => ' > 指考主選單 > 預覽考程表',
            'course' => $course,
            'datetime_info' => $datetime_info,
        );
        $this->load->view('layout', $data);
    }

    public function f_4()
    {
        $this->mod_user->chk_status();
        $this->load->model('mod_exam_fees');
        $year = $this->session->userdata('year');

        if ($this->mod_exam_fees->chk_once($year)) {
            $fees_info = $this->mod_exam_fees->get_once($year);
        } else {
            $fees_info = array(
                'one_day_salary' => '',
                'salary_section' => '',
                'lunch_fee' => '',
            );
        }

        $data = array(
            'title' => '考科費用',
            'path' => 'designated/f_4',
            'path_text' => ' > 指考主選單 > 考科費用',
            'fees_info' => $fees_info,
        );
        $this->load->view('layout', $data);
    }
}

/* End of file Designated.php */
