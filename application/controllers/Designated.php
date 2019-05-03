<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Designated extends CI_Controller
{
    public function index()
    {
        $this->load->model('mod_area');
        $this->mod_user->chk_status();
        $data = array(
            'title' => '指考主選單',
            'path' => 'designated/index',
            'path_text' => ' > 指考主選單',
            'a1_check' => $this->mod_area->check_a1(),
            'f_check' => $this->mod_area->check_f(),
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
        // $this->load->model('mod_exam_area');
        $this->load->model('mod_part_info');
        $this->load->model('mod_trial');
        $this->load->model('mod_patrol');
        $this->mod_user->chk_status();
        if (isset($_FILES['file'])) { // 如果有接收到上傳檔案資料

            $file = $_FILES['file']['tmp_name'];
            $file_name = './tmp/' . time() . '.csv';
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
            $this->load->model('mod_exam_area');



            $this->mod_exam_area->import($datas);
            $this->mod_part_info->import($datas_part);

            // d1
            $this->mod_trial->import($datas_trial);
            // D管卷
            $this->mod_trial->remove_trial_staff_data();
            // D巡場
            $this->mod_trial->remove_patrol_staff_data();


            fclose($file);
            unlink($file_name);
            // print_r(fgetcsv($file));
            redirect('designated/a_1');
        } else {
            $this->load->model('mod_trial');
            $data = array(
                'title' => '考區試場資料',
                'path' => 'designated/a_1',
                'path_text' => ' > 指考主選單 > 資料匯入作業 > 考區試場資料',
                'datalist' => $this->mod_trial->year_get_lists(),

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
            $file_name = './tmp/' . time() . '.csv';
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

            $file = $_FILES['file']['tmp_name'];
            $file_name = './tmp/' . time() . '.csv';
            copy($file, $file_name);
            $file = fopen($file_name, 'r');
            $datas = array();
            fgetcsv($file);
            while (!feof($file)) {
                $data = fgetcsv($file);
                if ($data[0] != '') {
                    if (!isset($data[7])) {
                        $data[7] = '';
                    }
                    $datas[] = array(
                        'year' => $this->session->userdata('year'),
                        'member_code' => $data[0],
                        'member_name' => $data[1],
                        'unit' => $data[2],
                        'member_unit' => $data[3],
                        'member_title' => $data[4],
                        'member_phone' => $data[5],
                        'order_meal' => $data[6],
                        'meal' => $data[7],
                    );
                }

            }

            $this->mod_staff->remove_district_task();
            $this->mod_staff->remove_trial_assign();
            $this->mod_staff->remove_trial_staff();
            $this->mod_staff->remove_patrol_staff();
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
            $file_name = './tmp/' . time() . '.csv';
            copy($file, $file_name);
            $file = fopen($file_name, 'r');
            $datas = array();
            // fgetcsv($file);
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
            $file_name = './tmp/' . time() . '.csv';
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

            }


            $this->mod_task->import_1($area_1);
            fclose($file);
            unlink($file_name);
            print_r(fgetcsv($file));
            redirect('designated/a_4');
        } elseif (isset($_FILES['inputGroupFile02'])) {
            $file = $_FILES['inputGroupFile02']['tmp_name'];
            $file_name = './tmp/' . time() . '.csv';
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


            $this->mod_task->import_2($area_2);
            fclose($file);
            unlink($file_name);
            print_r(fgetcsv($file));
            redirect('designated/a_4');
        } elseif (isset($_FILES['inputGroupFile03'])) {
            $file = $_FILES['inputGroupFile03']['tmp_name'];
            $file_name = './tmp/' . time() . '.csv';
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
            'title' => '監試人員指派',
            'path' => 'designated/d_1',
            'path_text' => ' > 指考主選單 > 試場人員指派 > 監試人員指派',
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
            'title' => '監試人員列表',
            'path' => 'designated/d_4',
            'path_text' => ' > 指考主選單 > 試場人員指派 > 監試人員列表',
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

        $this->load->model('mod_school_unit');

        $title = '行政單位';
        $date = date('yyyy/m/d');

        $data = array(
            'list' => $this->mod_school_unit->year_get_school_unit_list(),
        );
        if ($data['list'] != false) {
            $view = $this->load->view('designated/e_1_1', $data, true);
            $this->pdf->view_to_pdf($view, 'e_1_1');
        } else {
            return false;
        }
    }

    public function e_1_2()
    {

        $this->load->model('mod_task');

        $title = '請公假名單';
        $date = date('yyyy/m/d');

        $data = array(
            'list' => $this->mod_task->get_all_assign_member_list(),
        );

        $view = $this->load->view('designated/e_1_2', $data, true);
        $this->pdf->view_to_pdf($view, 'e_1_2');
    }

    public function e_1_3()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');

        $part = $_GET['part'];
        $area = $_GET['area'];

        $title = '監試及試務人員一覽表';
        $date = date('yyyy/m/d');

        $data = array(
            'part' => $this->mod_trial->get_list_for_pdf($part),
            'area' => $area,
            'school' => $this->mod_exam_area->year_school_name($part),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_1_3', $data, true);
            $this->pdf->view_to_pdf($view, 'e_1_3');
        } else {
            return false;
        }
    }

    public function e_1_3_3()
    {

        $this->load->model('mod_task');
        $this->load->model('mod_exam_area');
        $this->load->model("mod_part_addr");
        $part = $_GET['part'];
        $area = $_GET['area'];
        if ($_GET['part'] != "2500") {
            $part = $_GET['part'];
            $school = $this->mod_exam_area->year_school_name($part);
        } else {
            $school = "";
        }

        $title = '監試及試務人員一覽表';
        $date = date('yyyy/m/d');

        $year = $_SESSION['year'];
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
            'part' => $this->mod_task->get_district_task($area, $part),
            'area' => $area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'addr_info' => $addr_info,
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_1_3_3', $data, true);
            $this->pdf->view_to_pdf($view, 'e_1_3_3');
        } else {
            return false;
        }
    }

    public function e_1_3_4()
    {

        $this->load->model('mod_task');
        $this->load->model('mod_exam_area');
        $this->load->model("mod_part_addr");
        $part = $_GET['part'];
        $area = $_GET['area'];
        if ($_GET['part'] != "2500") {
            $part = $_GET['part'];
            $school = $this->mod_exam_area->year_school_name($part);
        } else {
            $school = "";
        }

        $title = '監試及試務人員一覽表';
        $date = date('yyyy/m/d');

        $year = $_SESSION['year'];
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
            'part' => $this->mod_task->get_trial_staff_list_for_pdf($area, $part),
            'area' => $area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'addr_info' => $addr_info,
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_1_3_4', $data, true);
            $this->pdf->view_to_pdf($view, 'e_1_3_4');
        } else {
            return false;
        }
    }

    public function e_1_3_5()
    {

        $this->load->model('mod_task');
        $this->load->model('mod_exam_area');
        $this->load->model("mod_part_addr");
        $part = $_GET['part'];
        $area = $_GET['area'];
        if ($_GET['part'] != "2500") {
            $part = $_GET['part'];
            $school = $this->mod_exam_area->year_school_name($part);
        } else {
            $school = "";
        }

        $title = '監試及試務人員一覽表';
        $date = date('yyyy/m/d');

        $year = $_SESSION['year'];
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
            'part' => $this->mod_task->get_patrol_staff_list_for_pdf($area, $part),
            'area' => $area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'addr_info' => $addr_info,
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_1_3_5', $data, true);
            $this->pdf->view_to_pdf($view, 'e_1_3_5');
        } else {
            return false;
        }
    }

    public function e_1_4()
    {
        $this->load->model('mod_exam_area');
        $this->load->model('mod_exam_datetime');
        $title = '缺考人數統計';
        $year = $this->session->userdata('year');

        $date = date('yyyy/m/d');
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
                'day_1' => '7月/1日',
                'day_2' => '7月/2日',
                'day_3' => '7月/3日',
            );
        }

        $data = array(
            'list' => $this->mod_exam_area->year_get_list($part),
            'count' => $this->mod_exam_area->year_get_member_count_list($part),
            'school' => $this->mod_exam_area->year_school_name($part),
            'course' => $this->mod_exam_datetime->get_course($year),
            'datetime_info' => $datetime_info,
            'area' => $area
        );
        if ($data['list'] != false) {
            $view = $this->load->view('designated/e_1_4', $data, true);
            $this->pdf->view_to_pdf($view, 'e_1_4');
        } else {
            return false;
        }
    }

    public function e_1_5()
    {

        $this->load->model('mod_trial');

        $part = $_GET['part'];
        $area = $_GET['area'];

        $title = $area . '監試人員午餐一覽表';

        $data = array(
            'part' => $this->mod_trial->get_dinner_list_for_pdf($part),
            'area' => $area,
            'count' => $this->mod_trial->e_6_1_member_count($part),
            'own' => $this->mod_trial->get_trial_own_meal_count($part),
            'veg' => $this->mod_trial->get_trial_veg_meal_count($part),
            'meat' => $this->mod_trial->get_trial_meat_meal_count($part),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_1_5', $data, true);
            $this->pdf->view_to_pdf($view, 'e_1_5');
        } else {
            return false;
        }
    }

    public function e_2()
    {
        $this->mod_user->chk_status();
        $this->load->model('mod_exam_datetime');
        $datetime_info = $this->mod_exam_datetime->get_once($_SESSION['year']);
        $data = array(
            'title' => '簽到表 / 簽收單',
            'path' => 'designated/e_2',
            'path_text' => ' > 製作報表 > 簽到表 / 簽收單',
            'datetime_info' => $datetime_info
        );
        $this->load->view('layout', $data);
    }

    public function e_2_1_1()
    {

        $this->load->model('mod_task');
        $this->load->model('mod_exam_area');

        $title = '試務人員執行任務簽到表';
        $area = $_GET['area'];
        $part = $_GET['part'];
        if ($_GET['part'] != "2500") {
            $part = $_GET['part'];
            $school = $this->mod_exam_area->year_school_name($part);
        } else {
            $school = "";
        }
        $date = date('yyyy/m/d');


        $data = array(
            'part' => $this->mod_task->e_2_1($area, $part),
            'area' => $area,
            'school' => $school,
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_2_1_1', $data, true);
            $this->pdf->view_to_pdf($view, 'e_2_1_1');
        } else {
            return false;
        }
    }

    public function e_2_1_2()
    {

        $this->load->model('mod_task');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');

        $title = '試務人員執行任務簽到表';
        $area = $_GET['area'];
        $part = $_GET['part'];
        if ($_GET['part'] != "2500") {
            $part = $_GET['part'];
            $school = $this->mod_exam_area->year_school_name($part);
        } else {
            $school = "";
        }
        $date = date('yyyy/m/d');


        $data = array(
            'part' => $this->mod_trial->e_2_1_2($part),
            'area' => $area,

            'school' => $school,
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_2_1_2', $data, true);
            $this->pdf->view_to_pdf($view, 'e_2_1_2');
        } else {
            return false;
        }
    }

    public function e_2_1_3()
    {

        $this->load->model('mod_task');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');

        $title = '試務人員執行任務簽到表';
        $area = $_GET['area'];
        $part = $_GET['part'];
        if ($_GET['part'] != "2500") {
            $part = $_GET['part'];
            $school = $this->mod_exam_area->year_school_name($part);
        } else {
            $school = "";
        }
        $date = date('yyyy/m/d');


        $data = array(
            'part' => $this->mod_trial->e_2_1_3($part),
            'area' => $area,

            'school' => $school,
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_2_1_3', $data, true);
            $this->pdf->view_to_pdf($view, 'e_2_1_3');
        } else {
            return false;
        }
    }

    public function e_2_2()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');

        $title = '監試人員執行任務簽到表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];


        $year = $this->session->userdata('year');
        $data = array(
            'part' => $this->mod_trial->get_date_for_trial_list($part),
            'area' => $area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'own' => $this->mod_trial->get_trial_own_meal_count($part),
            'veg' => $this->mod_trial->get_trial_veg_meal_count($part),
            'meat' => $this->mod_trial->get_trial_meat_meal_count($part),
        );

        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_2_2', $data, true);
            $this->pdf->view_to_pdf($view, 'e_2_2');
        } else {
            return false;
        }

    }

    public function e_2_3_1()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $this->load->model('mod_exam_datetime');

        $part = $this->input->get('part');
        $area = $this->input->get('area');
        $year = $this->session->userdata('year');
        $datetime_info = $this->mod_exam_datetime->get_once($year);

        $data = array(
            'part' => $this->mod_trial->get_once_date_of_voucher1($part),
            'area' => $area,
            'datetime_info' => $datetime_info,
            'count' => $this->mod_trial->get_patrol_member_count_1($part),
            'school' => $this->mod_exam_area->year_school_name($part),
        );

        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_2_3_1', $data, true);
            $this->pdf->view_to_pdf($view, 'e_2_3_1', false);
        } else {
            // echo 'X';
            return false;
        }
    }

    public function e_2_3_2()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $this->load->model('mod_exam_datetime');

        $part = $_GET['part'];
        $area = $_GET['area'];

        $year = $this->session->userdata('year');

        $datetime_info = $this->mod_exam_datetime->get_once($year);

        $data = array(
            'part' => $this->mod_trial->get_once_date_of_voucher2($part),
            'area' => $area,
            'datetime_info' => $datetime_info,
            'count' => $this->mod_trial->get_patrol_member_count_2($part),
            'school' => $this->mod_exam_area->year_school_name($part),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_2_3_2', $data, true);
            $this->pdf->view_to_pdf($view, 'e_2_3_2', false);
        } else {
            return false;
        }
    }

    public function e_2_3_3()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $this->load->model('mod_exam_datetime');


        $title = '答案卷卡收發記錄單';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $year = $this->session->userdata('year');

        $datetime_info = $this->mod_exam_datetime->get_once($year);

        $data = array(
            'part' => $this->mod_trial->get_once_date_of_voucher3($part),
            'area' => $area,
            'datetime_info' => $datetime_info,
            'count' => $this->mod_trial->get_patrol_member_count_3($part),
            'school' => $this->mod_exam_area->year_school_name($part),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_2_3_3', $data, true);
            $this->pdf->view_to_pdf($view, 'e_2_3_3');
        } else {
            return false;
        }
    }

    public function e_2_4()
    {

        $this->load->model('mod_task');

        $title = '監試說明會簽到表';
        $date = date('yyyy/m/d');

        $data = array(
            'part' => $this->mod_task->get_sign_list(),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_2_4', $data, true);
            $this->pdf->view_to_pdf($view, 'e_2_4');
        } else {
            return false;
        }
    }


    function utf8_array_asort(&$array)
    {

        if (!isset($array) || !is_array($array)) {
            return false;
        }
        foreach ($array as $k => $v) {
            $array[$k] = iconv('UTF-8', 'GBK', $v);
        }
        asort($array);
        foreach ($array as $k => $v) {
            $array[$k] = iconv('GBK', 'UTF-8', $v);
        }
        return true;
    }

    public function e_2_5()
    {

        $this->load->model('mod_task');
        $this->load->model('mod_exam_area');


        $title = '大學入學考試中心' . $_SESSION['year'] . '學年度指定科目考試新北一考區監試說明會開會通知簽收表';

        $date = date('yyyy/m/d');

        $data = array(
            'data' => $this->mod_task->member_map(),
            'list' => $this->mod_task->get_member_map_list()
        );
        if ($data['list'] != false) {
            $view = $this->load->view('designated/e_2_5', $data, true);
            $this->pdf->view_to_pdf($view, 'e_2_5');
        } else {
            return false;
        }
    }


    public function e_3()
    {
        $this->load->model('mod_exam_datetime');
        $this->mod_user->chk_status();
        if ($this->mod_exam_datetime->chk_once($_SESSION['year'])) {
            $datetime_info = $this->mod_exam_datetime->get_once($_SESSION['year']);
        } else {
            $datetime_info = array(
                'day_1' => '1911' + $this->session->userdata('year') . '/07/01',
                'day_2' => '1911' + $this->session->userdata('year') . '/07/02',
                'day_3' => '1911' + $this->session->userdata('year') . '/07/03',
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
            'title' => '日程表 / 分配表',
            'path' => 'designated/e_3',
            'path_text' => ' > 製作報表 > 日程表 / 分配表',
            'datetime_info' => $datetime_info
        );
        $this->load->view('layout', $data);
    }

    public function e_3_1()
    {
        $this->load->library('excel');
        $this->load->model('mod_exam_datetime');
        $this->load->model('mod_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $part = $_GET['part'];
        $area = $_GET['area'];
        $year = $this->session->userdata('year');
        $datetime_info = $this->mod_exam_datetime->get_once($year);
        $course = $this->mod_exam_datetime->get_course($year);
        $res = $this->mod_trial->get_supervisor_list($part);
        // print_r($course);
        for ($i = 0; $i < count($res); $i++) {
            # code...
            switch ($res[$i]['subject_01']) {
                case '0':
                    $subject_01 = '';
                    break;
                default:
                    $subject_01 = 'V';
            }
            switch ($res[$i]['subject_02']) {
                case '0':
                    $subject_02 = '';
                    break;
                default:
                    $subject_02 = 'V';
            }
            switch ($res[$i]['subject_03']) {
                case '0':
                    $subject_03 = '';
                    break;
                default:
                    $subject_03 = 'V';
            }
            switch ($res[$i]['subject_04']) {
                case '0':
                    $subject_04 = '';
                    break;
                default:
                    $subject_04 = 'V';
            }
            switch ($res[$i]['subject_05']) {
                case '0':
                    $subject_05 = '';
                    break;
                default:
                    $subject_05 = 'V';
            }
            switch ($res[$i]['subject_06']) {
                case '0':
                    $subject_06 = '';
                    break;
                default:
                    $subject_06 = 'V';
            }
            switch ($res[$i]['subject_07']) {
                case '0':
                    $subject_07 = '';
                    break;
                default:
                    $subject_07 = 'V';
            }
            switch ($res[$i]['subject_08']) {
                case '0':
                    $subject_08 = '';
                    break;
                default:
                    $subject_08 = 'V';
            }
            switch ($res[$i]['subject_09']) {
                case '0':
                    $subject_09 = '';
                    break;
                default:
                    $subject_09 = 'V';
            }
            switch ($res[$i]['subject_10']) {
                case '0':
                    $subject_10 = '';
                    break;
                default:
                    $subject_10 = 'V';
            }

            switch ($course[0]['subject']) {
                case 'subject_00':
                    $course1 = '';
                    break;
                case 'subject_01':
                    $course1 = '物理';
                    break;
                case 'subject_02':
                    $course1 = '化學';
                    break;
                case 'subject_03':
                    $course1 = '生物';
                    break;
                case 'subject_04':
                    $course1 = '數乙';
                    break;
                case 'subject_05':
                    $course1 = '國文';
                    break;
                case 'subject_06':
                    $course1 = '英文';
                    break;
                case 'subject_07':
                    $course1 = '數甲';
                    break;
                case 'subject_08':
                    $course1 = '歷史';
                    break;
                case 'subject_09':
                    $course1 = '地理';
                    break;
                case 'subject_10':
                    $course1 = '公民與社會';
                    break;
            }

            switch ($course[1]['subject']) {
                case 'subject_00':
                    $course2 = '';
                    break;
                case 'subject_01':
                    $course2 = '物理';
                    break;
                case 'subject_02':
                    $course2 = '化學';
                    break;
                case 'subject_03':
                    $course2 = '生物';
                    break;
                case 'subject_04':
                    $course2 = '數乙';
                    break;
                case 'subject_05':
                    $course2 = '國文';
                    break;
                case 'subject_06':
                    $course2 = '英文';
                    break;
                case 'subject_07':
                    $course2 = '數甲';
                    break;
                case 'subject_08':
                    $course2 = '歷史';
                    break;
                case 'subject_09':
                    $course2 = '地理';
                    break;
                case 'subject_10':
                    $course2 = '公民與社會';
                    break;
            }

            switch ($course[2]['subject']) {
                case 'subject_00':
                    $course3 = '';
                    break;
                case 'subject_01':
                    $course3 = '物理';
                    break;
                case 'subject_02':
                    $course3 = '化學';
                    break;
                case 'subject_03':
                    $course3 = '生物';
                    break;
                case 'subject_04':
                    $course3 = '數乙';
                    break;
                case 'subject_05':
                    $course3 = '國文';
                    break;
                case 'subject_06':
                    $course3 = '英文';
                    break;
                case 'subject_07':
                    $course3 = '數甲';
                    break;
                case 'subject_08':
                    $course3 = '歷史';
                    break;
                case 'subject_09':
                    $course3 = '地理';
                    break;
                case 'subject_10':
                    $course3 = '公民與社會';
                    break;
            }

            switch ($course[3]['subject']) {
                case 'subject_00':
                    $course4 = '';
                    break;
                case 'subject_01':
                    $course4 = '物理';
                    break;
                case 'subject_02':
                    $course4 = '化學';
                    break;
                case 'subject_03':
                    $course4 = '生物';
                    break;
                case 'subject_04':
                    $course4 = '數乙';
                    break;
                case 'subject_05':
                    $course4 = '國文';
                    break;
                case 'subject_06':
                    $course4 = '英文';
                    break;
                case 'subject_07':
                    $course4 = '數甲';
                    break;
                case 'subject_08':
                    $course4 = '歷史';
                    break;
                case 'subject_09':
                    $course4 = '地理';
                    break;
                case 'subject_10':
                    $course4 = '公民與社會';
                    break;
            }

            switch ($course[4]['subject']) {
                case 'subject_00':
                    $course5 = '';
                    break;
                case 'subject_01':
                    $course5 = '物理';
                    break;
                case 'subject_02':
                    $course5 = '化學';
                    break;
                case 'subject_03':
                    $course5 = '生物';
                    break;
                case 'subject_04':
                    $course5 = '數乙';
                    break;
                case 'subject_05':
                    $course5 = '國文';
                    break;
                case 'subject_06':
                    $course5 = '英文';
                    break;
                case 'subject_07':
                    $course5 = '數甲';
                    break;
                case 'subject_08':
                    $course5 = '歷史';
                    break;
                case 'subject_09':
                    $course5 = '地理';
                    break;
                case 'subject_10':
                    $course5 = '公民與社會';
                    break;
            }

            switch ($course[5]['subject']) {
                case 'subject_00':
                    $course6 = '';
                    break;
                case 'subject_01':
                    $course6 = '物理';
                    break;
                case 'subject_02':
                    $course6 = '化學';
                    break;
                case 'subject_03':
                    $course6 = '生物';
                    break;
                case 'subject_04':
                    $course6 = '數乙';
                    break;
                case 'subject_05':
                    $course6 = '國文';
                    break;
                case 'subject_06':
                    $course6 = '英文';
                    break;
                case 'subject_07':
                    $course6 = '數甲';
                    break;
                case 'subject_08':
                    $course6 = '歷史';
                    break;
                case 'subject_09':
                    $course6 = '地理';
                    break;
                case 'subject_10':
                    $course6 = '公民與社會';
                    break;
            }

            switch ($course[6]['subject']) {
                case 'subject_00':
                    $course7 = '';
                    break;
                case 'subject_01':
                    $course7 = '物理';
                    break;
                case 'subject_02':
                    $course7 = '化學';
                    break;
                case 'subject_03':
                    $course7 = '生物';
                    break;
                case 'subject_04':
                    $course7 = '數乙';
                    break;
                case 'subject_05':
                    $course7 = '國文';
                    break;
                case 'subject_06':
                    $course7 = '英文';
                    break;
                case 'subject_07':
                    $course7 = '數甲';
                    break;
                case 'subject_08':
                    $course7 = '歷史';
                    break;
                case 'subject_09':
                    $course7 = '地理';
                    break;
                case 'subject_10':
                    $course7 = '公民與社會';
                    break;
            }

            switch ($course[7]['subject']) {
                case 'subject_00':
                    $course8 = '';
                    break;
                case 'subject_01':
                    $course8 = '物理';
                    break;
                case 'subject_02':
                    $course8 = '化學';
                    break;
                case 'subject_03':
                    $course8 = '生物';
                    break;
                case 'subject_04':
                    $course8 = '數乙';
                    break;
                case 'subject_05':
                    $course8 = '國文';
                    break;
                case 'subject_06':
                    $course8 = '英文';
                    break;
                case 'subject_07':
                    $course8 = '數甲';
                    break;
                case 'subject_08':
                    $course8 = '歷史';
                    break;
                case 'subject_09':
                    $course8 = '地理';
                    break;
                case 'subject_10':
                    $course8 = '公民與社會';
                    break;
            }

            switch ($course[8]['subject']) {
                case 'subject_00':
                    $course9 = '';
                    break;
                case 'subject_01':
                    $course9 = '物理';
                    break;
                case 'subject_02':
                    $course9 = '化學';
                    break;
                case 'subject_03':
                    $course9 = '生物';
                    break;
                case 'subject_04':
                    $course9 = '數乙';
                    break;
                case 'subject_05':
                    $course9 = '國文';
                    break;
                case 'subject_06':
                    $course9 = '英文';
                    break;
                case 'subject_07':
                    $course9 = '數甲';
                    break;
                case 'subject_08':
                    $course9 = '歷史';
                    break;
                case 'subject_09':
                    $course9 = '地理';
                    break;
                case 'subject_10':
                    $course9 = '公民與社會';
                    break;
            }

            switch ($course[9]['subject']) {
                case 'subject_00':
                    $course10 = '';
                    break;
                case 'subject_01':
                    $course10 = '物理';
                    break;
                case 'subject_02':
                    $course10 = '化學';
                    break;
                case 'subject_03':
                    $course10 = '生物';
                    break;
                case 'subject_04':
                    $course10 = '數乙';
                    break;
                case 'subject_05':
                    $course10 = '國文';
                    break;
                case 'subject_06':
                    $course10 = '英文';
                    break;
                case 'subject_07':
                    $course10 = '數甲';
                    break;
                case 'subject_08':
                    $course10 = '歷史';
                    break;
                case 'subject_09':
                    $course10 = '地理';
                    break;
                case 'subject_10':
                    $course10 = '公民與社會';
                    break;
            }

            switch ($course[10]['subject']) {
                case 'subject_00':
                    $course11 = '';
                    break;
                case 'subject_01':
                    $course11 = '物理';
                    break;
                case 'subject_02':
                    $course11 = '化學';
                    break;
                case 'subject_03':
                    $course11 = '生物';
                    break;
                case 'subject_04':
                    $course11 = '數乙';
                    break;
                case 'subject_05':
                    $course11 = '國文';
                    break;
                case 'subject_06':
                    $course11 = '英文';
                    break;
                case 'subject_07':
                    $course11 = '數甲';
                    break;
                case 'subject_08':
                    $course11 = '歷史';
                    break;
                case 'subject_09':
                    $course11 = '地理';
                    break;
                case 'subject_10':
                    $course11 = '公民與社會';
                    break;
            }

            switch ($course[11]['subject']) {
                case 'subject_00':
                    $course12 = '';
                    break;
                case 'subject_01':
                    $course12 = '物理';
                    break;
                case 'subject_02':
                    $course12 = '化學';
                    break;
                case 'subject_03':
                    $course12 = '生物';
                    break;
                case 'subject_04':
                    $course12 = '數乙';
                    break;
                case 'subject_05':
                    $course12 = '國文';
                    break;
                case 'subject_06':
                    $course12 = '英文';
                    break;
                case 'subject_07':
                    $course12 = '數甲';
                    break;
                case 'subject_08':
                    $course12 = '歷史';
                    break;
                case 'subject_09':
                    $course12 = '地理';
                    break;
                case 'subject_10':
                    $course12 = '公民與社會';
                    break;
            }



            $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '考試日期一');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '考試日期二');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '考試日期三');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '編號');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '監試人員姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('G1', '監試分區');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '監試日期');
            $objPHPExcel->getActiveSheet()->setCellValue('I1', '監試節次');
            $objPHPExcel->getActiveSheet()->setCellValue('J1', '物理');
            $objPHPExcel->getActiveSheet()->setCellValue('K1', '化學');
            $objPHPExcel->getActiveSheet()->setCellValue('L1', '生物');
            $objPHPExcel->getActiveSheet()->setCellValue('M1', '數學乙');
            $objPHPExcel->getActiveSheet()->setCellValue('N1', '國文');
            $objPHPExcel->getActiveSheet()->setCellValue('O1', '英文');
            $objPHPExcel->getActiveSheet()->setCellValue('P1', '數學甲');
            $objPHPExcel->getActiveSheet()->setCellValue('Q1', '歷史');
            $objPHPExcel->getActiveSheet()->setCellValue('R1', '地理');
            $objPHPExcel->getActiveSheet()->setCellValue('S1', '公民與社會');
            $objPHPExcel->getActiveSheet()->setCellValue('T1', '第1科');
            $objPHPExcel->getActiveSheet()->setCellValue('U1', '第2科');
            $objPHPExcel->getActiveSheet()->setCellValue('V1', '第3科');
            $objPHPExcel->getActiveSheet()->setCellValue('W1', '第4科');
            $objPHPExcel->getActiveSheet()->setCellValue('X1', '第5科');
            $objPHPExcel->getActiveSheet()->setCellValue('Y1', '第6科');
            $objPHPExcel->getActiveSheet()->setCellValue('Z1', '第7科');
            $objPHPExcel->getActiveSheet()->setCellValue('AA1', '第8科');
            $objPHPExcel->getActiveSheet()->setCellValue('AB1', '第9科');
            $objPHPExcel->getActiveSheet()->setCellValue('AC1', '第10科');
            $objPHPExcel->getActiveSheet()->setCellValue('AD1', '第11科');
            $objPHPExcel->getActiveSheet()->setCellValue('AE1', '第12科');


            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $_SESSION['year']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'));
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'));
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'));
            $objPHPExcel->getActiveSheet()->setCellValue('E' . (2 + $i), $res[$i]['supervisor_code']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . (2 + $i), trim($res[$i]['supervisor']));
            $objPHPExcel->getActiveSheet()->setCellValue('G' . (2 + $i), $_GET['area']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . (2 + $i), str_replace("、", ",", $res[$i]['do_date']));
            $objPHPExcel->getActiveSheet()->setCellValue('I' . (2 + $i), $res[$i]['test_section']);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . (2 + $i), $subject_01);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . (2 + $i), $subject_02);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . (2 + $i), $subject_03);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . (2 + $i), $subject_04);
            $objPHPExcel->getActiveSheet()->setCellValue('N' . (2 + $i), $subject_05);
            $objPHPExcel->getActiveSheet()->setCellValue('O' . (2 + $i), $subject_06);
            $objPHPExcel->getActiveSheet()->setCellValue('P' . (2 + $i), $subject_07);
            $objPHPExcel->getActiveSheet()->setCellValue('Q' . (2 + $i), $subject_08);
            $objPHPExcel->getActiveSheet()->setCellValue('R' . (2 + $i), $subject_09);
            $objPHPExcel->getActiveSheet()->setCellValue('S' . (2 + $i), $subject_10);
            $objPHPExcel->getActiveSheet()->setCellValue('T' . (2 + $i), $course1);
            $objPHPExcel->getActiveSheet()->setCellValue('U' . (2 + $i), $course2);
            $objPHPExcel->getActiveSheet()->setCellValue('V' . (2 + $i), $course3);
            $objPHPExcel->getActiveSheet()->setCellValue('W' . (2 + $i), $course4);
            $objPHPExcel->getActiveSheet()->setCellValue('X' . (2 + $i), $course5);
            $objPHPExcel->getActiveSheet()->setCellValue('Y' . (2 + $i), $course6);
            $objPHPExcel->getActiveSheet()->setCellValue('Z' . (2 + $i), $course7);
            $objPHPExcel->getActiveSheet()->setCellValue('AA' . (2 + $i), $course8);
            $objPHPExcel->getActiveSheet()->setCellValue('AB' . (2 + $i), $course9);
            $objPHPExcel->getActiveSheet()->setCellValue('AC' . (2 + $i), $course10);
            $objPHPExcel->getActiveSheet()->setCellValue('AD' . (2 + $i), $course11);
            $objPHPExcel->getActiveSheet()->setCellValue('AE' . (2 + $i), $course12);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="監試人員監考日程表' . '.csv"');
        header('Cache-Control: max-age=0');


        $objWriter->save('php://output');
    }

    public function e_3_2_1_1()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');

        $title = '試場工作人員分配表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $date = $_GET['date'];
        $data = array(
            'part' => $this->mod_trial->e_3_2_1($part),
            'area' => $area,
            'patrol_count' => $this->mod_trial->get_patrol_member_count_1($part),
            'trial_count' => $this->mod_trial->get_trial_member_count($part),
            'school' => $this->mod_exam_area->year_school_name($part),
            'date' => $date,
        );
        $view = $this->load->view('designated/e_3_2_1', $data, true);
        $this->pdf->view_to_pdf($view, 'e_3_2_1');
    }

    public function e_3_2_1_2()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $title = '試場工作人員分配表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $date = $_GET['date'];
        $data = array(
            'part' => $this->mod_trial->e_3_2_2($part),
            'area' => $area,
            'patrol_count' => $this->mod_trial->get_patrol_member_count_2($part),
            'trial_count' => $this->mod_trial->get_trial_member_count($part),
            'school' => $this->mod_exam_area->year_school_name($part),
            'date' => $date,
        );
        $view = $this->load->view('designated/e_3_2_1', $data, true);
        $this->pdf->view_to_pdf($view, 'e_3_2_1');
    }

    public function e_3_2_1_3()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $title = '試場工作人員分配表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $date = $_GET['date'];
        $data = array(
            'part' => $this->mod_trial->e_3_2_3($part),
            'area' => $area,
            'patrol_count' => $this->mod_trial->get_patrol_member_count_3($part),
            'trial_count' => $this->mod_trial->get_trial_member_count($part),
            'school' => $this->mod_exam_area->year_school_name($part),
            'date' => $date,
        );
        // print_r($data);
        $view = $this->load->view('designated/e_3_2_1', $data, true);
        $this->pdf->view_to_pdf($view, 'e_3_2_1');
    }

    public function e_3_2_2_1()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');

        $title = '試場工作人員分配表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $date = $_GET['date'];
        $data = array(
            'part' => $this->mod_trial->e_3_2_1($part),
            'area' => $area,
            'patrol_count' => $this->mod_trial->get_patrol_member_count_1($part),
            'trial_count' => $this->mod_trial->get_trial_member_count($part),
            'school' => $this->mod_exam_area->year_school_name($part),
            'date' => $date,
        );
        $view = $this->load->view('designated/e_3_2_2', $data, true);
        $this->pdf->view_to_pdf($view, 'e_3_2_2');
    }

    public function e_3_2_2_2()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $title = '試場工作人員分配表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $date = $_GET['date'];
        $data = array(
            'part' => $this->mod_trial->e_3_2_2($part),
            'area' => $area,
            'patrol_count' => $this->mod_trial->get_patrol_member_count_2($part),
            'trial_count' => $this->mod_trial->get_trial_member_count($part),
            'school' => $this->mod_exam_area->year_school_name($part),
            'date' => $date,
        );
        // print_r($data);
        $view = $this->load->view('designated/e_3_2_2', $data, true);
        $this->pdf->view_to_pdf($view, 'e_3_2_2');
    }

    public function e_3_2_2_3()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $title = '試場工作人員分配表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $date = $_GET['date'];
        $data = array(
            'part' => $this->mod_trial->e_3_2_3($part),
            'area' => $area,
            'patrol_count' => $this->mod_trial->get_patrol_member_count_3($part),
            'trial_count' => $this->mod_trial->get_trial_member_count($part),
            'school' => $this->mod_exam_area->year_school_name($part),
            'date' => $date,
        );
        $view = $this->load->view('designated/e_3_2_2', $data, true);
        $this->pdf->view_to_pdf($view, 'e_3_2_2');
    }

    public function e_3_2_3_1()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $title = '試場工作人員分配表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];
        $date = $_GET['date'];
        $data = array(
            'part' => $this->mod_trial->e_3_2_1($part),
            'area' => $area,
            'patrol_count' => $this->mod_trial->get_patrol_member_count_1($part),
            'trial_count' => $this->mod_trial->get_trial_member_count($part),
            'school' => $this->mod_exam_area->year_school_name($part),
            'date' => $date,
        );

        $view = $this->load->view('designated/e_3_2_3', $data, true);
        $this->pdf->view_to_pdf($view, 'e_3_2_3');
    }

    public function e_3_2_3_2()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $title = '試場工作人員分配表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $date = $_GET['date'];
        $data = array(
            'part' => $this->mod_trial->e_3_2_2($part),
            'area' => $area,
            'patrol_count' => $this->mod_trial->get_patrol_member_count_2($part),
            'trial_count' => $this->mod_trial->get_trial_member_count($part),
            'school' => $this->mod_exam_area->year_school_name($part),
            'date' => $date,
        );
        $view = $this->load->view('designated/e_3_2_3', $data, true);
        $this->pdf->view_to_pdf($view, 'e_3_2_3');
    }

    public function e_3_2_3_3()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $title = '試場工作人員分配表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $date = $_GET['date'];
        $data = array(
            'part' => $this->mod_trial->e_3_2_3($part),
            'area' => $area,
            'patrol_count' => $this->mod_trial->get_patrol_member_count_3($part),
            'trial_count' => $this->mod_trial->get_trial_member_count($part),
            'school' => $this->mod_exam_area->year_school_name($part),
            'date' => $date,
        );
        $view = $this->load->view('designated/e_3_2_3', $data, true);
        $this->pdf->view_to_pdf($view, 'e_3_2_3');
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
        $arr = $this->mod_trial->get_list_for_csv();
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '監試人員');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '監試日期');

            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['year']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['member_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['do_date']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="監試人員' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function e_4_1_2()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');
        $this->load->model('mod_task');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $res = $this->mod_task->get_list_for_csv();
        for ($i = 0; $i < count($res); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '試務人員');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '執行日');
            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $res[$i]['year']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $res[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $res[$i]['do_date']);
        }


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="試務人員' . '.csv"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
    }

    public function e_4_1_3()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_patrol->get_trial_staff_for_csv();
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '試務人員');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '監試日期');

            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['year']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['member_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['do_date']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="管卷人員' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function e_4_1_4()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');
        $this->load->model('mod_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_patrol->get_patrol_for_csv();
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '試務人員');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '監試日期');

            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['year']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['member_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['do_date']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="巡場人員' . '.csv"');
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
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '監試人員');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '編號');


            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['part_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), '監試人員');
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['member_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['trial_staff_code']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="監試人員名牌' . '.csv"');
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
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '試務人員');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '編號');


            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['area']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['job_code']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="試務人員名牌' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function e_5_1_3()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_patrol->get_trial_staff_for_csv();
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '試務人員');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '編號');


            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['area']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['member_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['member_code']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="管卷人員名牌' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function e_5_1_4()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_patrol->get_patrol_for_csv();
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '試務人員');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '編號');


            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['area']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['member_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['member_code']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="巡場人員名牌' . '.csv"');
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
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '單位');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '監試人員');

            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['member_unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['member_name']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="監試人員標籤樣式' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function e_5_2_2()
    {
        $this->load->library('excel');
        $this->load->model('mod_task');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_task->get_district_task_csv();
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '單位');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '試務人員');

            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['member_unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['name']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="試務人員標籤樣式' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }


    public function e_5_2_3()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_patrol->get_trial_staff_for_csv();
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '單位');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '試務人員');

            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['member_unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['member_name']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="管卷人員標籤樣式' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function e_5_2_4()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_patrol->get_patrol_for_csv();
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '單位');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '試務人員');

            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['member_unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['member_name']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="試務人員標籤樣式' . '.csv"');
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

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');

        $title = '監試人員印領清冊';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];
        $data = array(
            'part' => $this->mod_trial->e_6_1($part),
            'area' => $area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'salary' => $this->mod_trial->get_all_salary_trial_total($part),
            'lunch' => $this->mod_trial->get_all_trial_lunch_total($part),
            'count' => $this->mod_trial->e_6_1_member_count($part)
        );
        $view = $this->load->view('designated/e_6_1', $data, true);
        $this->pdf->view_to_pdf($view, 'e_6_1');
    }

    public function e_6_2()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');

        $title = '監試人員印領清冊';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];
        $obs = $_GET['obs'];
        $data = array(
            'part' => $this->mod_trial->get_list_for_obs($part, $obs),
            'area' => $area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'salary' => $this->mod_trial->get_all_salary_trial_total_of_obs($part, $obs),
            'lunch' => $this->mod_trial->get_all_trial_lunch_total_of_obs($part, $obs),
            'count' => $this->mod_trial->get_list_for_obs_member_count($part, $obs),
        );

        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_6_2', $data, true);
            $this->pdf->view_to_pdf($view, 'e_6_2');
        } else {
            return false;
        }
    }

    public function e_6_3()
    {

        $this->load->model('mod_task');
        $this->load->model('mod_exam_area');
        $title = '試務人員印領清冊';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $data = array(
            'part' => $this->mod_task->get_district_task_money_list($area),
            'area' => $area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'salary' => $this->mod_task->get_all_salary_trial_total_of_district($area),
            'lunch' => $this->mod_task->get_all_lunch_trial_total_of_district($area)
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_6_3', $data, true);
            $this->pdf->view_to_pdf($view, 'e_6_3');
        } else {
            return false;
        }
    }

    public function e_6_4()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');

        $title = '管卷人員印領清冊';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $data = array(
            'part' => $this->mod_trial->get_trial_staff_task_money_list($part),
            'area' => $area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'salary' => $this->mod_trial->get_trial_staff_salary_total($part),
            'lunch' => $this->mod_trial->get_trial_staff_lunch_total($part),
            'count' => $this->mod_trial->get_trial_staff_task_member_count($part),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_6_4', $data, true);
            $this->pdf->view_to_pdf($view, 'e_6_4');
        } else {
            return false;
        }
    }

    public function e_6_5()
    {

        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        $title = '巡場人員印領清冊';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];
        $data = array(
            'part' => $this->mod_trial->get_patrol_staff_task_money_list($part),
            'area' => $area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'salary' => $this->mod_trial->get_patrol_staff_salary_total($part),
            'lunch' => $this->mod_trial->get_patrol_staff_lunch_total($part),
            'count' => $this->mod_trial->get_patrol_staff_task_member_count($part),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_6_5', $data, true);
            $this->pdf->view_to_pdf($view, 'e_6_5');
        } else {
            return false;
        }
    }

    public function e_7()
    {
        $this->load->library('excel');
        $this->load->model('mod_task');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_task->get_all_assign_member_list();
        for ($i = 0; $i < count($arr); $i++) {
            # code...

            $objPHPExcel->getActiveSheet()->getStyle()->getNumberFormat()->setFormatCode();
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '職員代碼');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '單位');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '職稱');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '執勤日期');


            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), (string)$arr[$i]['job_code'], PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['member_unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . (2 + $i), $arr[$i]['do_date']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header("content-type:application/csv;charset=UTF-8");
        header('Content-Disposition: attachment;filename="檔案匯出' . '.csv"');
        header('Cache-Control: max-age=0');
        header("Expires:0");



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

        $arr = $this->mod_trial->get_trial_moneylist_for_csv($part);
        if ($arr == false) {
            echo "<script>alert('此分區無資料!');</script>";
            redirect('./designated/e');
        } else {

            for ($i = 0; $i < count($arr); $i++) {
                # code...



                $objPHPExcel->getActiveSheet()->setCellValue('A0', '');
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '試場');

                $objPHPExcel->getActiveSheet()->setCellValue('B1', '監考費');
                $objPHPExcel->getActiveSheet()->setCellValue('C1', '姓名');
                $objPHPExcel->getActiveSheet()->setCellValue('D1', '餐費');
                $objPHPExcel->getActiveSheet()->setCellValue('E1', '應領費用');
                $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['field']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), number_format($arr[$i]['salary_section']));
                $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['supervisor']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['section_lunch_total']);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . (2 + $i), number_format($arr[$i]['salary_section'] - $arr[$i]['section_lunch_total']));
            }

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $area . '印領清冊' . '.csv"');
            header('Cache-Control: max-age=0');



            $objWriter->save('php://output');
        }
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


        $arr = $this->mod_trial->get_trial_list_of_obs_for_csv($part, $obs);
        for ($i = 0; $i < count($arr); $i++) {
            # code...

            $objPHPExcel->getActiveSheet()->setCellValue('A1', '試場');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '監考費');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '餐費');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['field']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), number_format($arr[$i]['salary_section']));
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['supervisor']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['section_lunch_total']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . (2 + $i), $arr[$i]['section_salary_total']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $area . '印領清冊' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function e_7_3()
    {
        $this->load->library('excel');
        $this->load->model('mod_task');
        $this->load->model('mod_exam_area');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $part = $_GET['part'];
        $area = $_GET['area'];

        $school = $this->mod_exam_area->year_school_name($part);
        $arr = $this->mod_task->get_district_task_money_list($area);
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '序號');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '考場');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '工作費');
            $objPHPExcel->getActiveSheet()->setCellValue('G1', '餐費費');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $i + 1);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $area);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $school);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . (2 + $i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . (2 + $i), number_format($arr[$i]['one_day_salary']));
            $objPHPExcel->getActiveSheet()->setCellValue('G' . (2 + $i), number_format($arr[$i]['lunch_total']));
            $objPHPExcel->getActiveSheet()->setCellValue('H' . (2 + $i), number_format($arr[$i]['total']));

        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $area . '試務人員印領清冊' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function e_7_4()
    {
        $this->load->library('excel');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $part = $_GET['part'];
        $area = $_GET['area'];

        $school = $this->mod_exam_area->year_school_name($part);
        $arr = $this->mod_trial->get_trial_staff_task_money_list($part);
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '序號');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '考場');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '工作費');
            $objPHPExcel->getActiveSheet()->setCellValue('G1', '餐費費');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $i + 1);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $area);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $school);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . (2 + $i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . (2 + $i), number_format($arr[$i]['salary_total']));
            $objPHPExcel->getActiveSheet()->setCellValue('G' . (2 + $i), number_format($arr[$i]['lunch_total']));
            $objPHPExcel->getActiveSheet()->setCellValue('H' . (2 + $i), number_format($arr[$i]['total']));

        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $area . '管卷人員印領清冊' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function e_7_5()
    {
        $this->load->library('excel');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $part = $_GET['part'];
        $area = $_GET['area'];

        $school = $this->mod_exam_area->year_school_name($part);
        $arr = $this->mod_trial->get_patrol_staff_task_money_list($part);
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '序號');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '考場');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '工作費');
            $objPHPExcel->getActiveSheet()->setCellValue('G1', '餐費費');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $i + 1);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $area);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $school);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . (2 + $i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . (2 + $i), number_format($arr[$i]['salary_total']));
            $objPHPExcel->getActiveSheet()->setCellValue('G' . (2 + $i), number_format($arr[$i]['lunch_total']));
            $objPHPExcel->getActiveSheet()->setCellValue('H' . (2 + $i), number_format($arr[$i]['total']));

        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $area . '巡場人員印領清冊' . '.csv"');
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
        $this->load->model('models/mod_exam_datetime', "mod_exam_datetime");
        $year = $this->session->userdata('year');

        if ($this->mod_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => '1911' + $this->session->userdata('year') . '年7月1日',
                'day_2' => '1911' + $this->session->userdata('year') . '年7月2日',
                'day_3' => '1911' + $this->session->userdata('year') . '年7月3日',
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



    public function f_3()
    {
        $this->mod_user->chk_status();
        $this->load->model('mod_exam_datetime');
        $year = $this->session->userdata('year');

        if ($this->mod_exam_datetime->chk_once($year)) {
            $datetime_info = $this->mod_exam_datetime->get_once($year);
        } else {
            $datetime_info = array(
                'day_1' => date('Y') . '年7月1日',
                'day_2' => date('Y') . '年7月2日',
                'day_3' => date('Y') . '年7月3日',
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