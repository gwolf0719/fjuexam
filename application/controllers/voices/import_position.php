<?php
defined('BASEPATH') or exit('No direct script access allowed');

class import_position extends CI_Controller
{

 function import_position()
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



}






?>