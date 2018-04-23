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
        $data = array(
            'title' => '考區任務編組',
            'path' => 'designated/b_1',
            'path_text' => ' > 指考主選單 > 考區任務編組 > 考區',
            'field' => $this->mod_task->get_field(),
            'datalist' => $this->mod_task->get_list('考區'),
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
}

/* End of file Designated.php */
