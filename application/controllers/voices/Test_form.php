<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Test_form extends CI_Controller
{

    public function index()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '製作報表',
            'path' => 'voice/form_e',
            'path_text' => ' > 製作報表',
        );
        $this->load->view('voice_layout', $data);
    }

    /**********************************************
     * 
     *  E1
     */

    public function form_e1()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '名單 / 資料 / 統計表',
            'path' => 'voice/form_e1',
            'path_text' => ' > 製作報表 > 名單 / 資料 / 統計表',
        );
        $this->load->view('voice_layout', $data);
    }

    public function form_e1_1()
    {

        $this->load->model('mod_school_unit');

        $data = array(
            'list' => $this->mod_school_unit->year_get_school_unit_list(),
        );
        if ($data['list'] != false) {
            $view = $this->load->view('voice/form_e1_1', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e1_1');

        } else {
            return false;
        }
    }

    public function form_e1_2()
    {

        $this->load->model('mod_voice_job_list');

        $data = array(
            'list' => $this->mod_voice_job_list->get_all_assign_member_list(),
        );
        // print_r($data);
        $view = $this->load->view('voice/form_e1_2', $data, true);
        $this->pdf->view_to_pdf($view, 'form_e1_2');

    }

    /**
     * 監試及試務人員 > 監試人員
     */
    public function form_e1_3_1()
    {

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');

        $part = $_GET['part'];
        $area = $_GET['area'];

        $data = array(
            'part' => $this->mod_voice_trial->get_list_for_pdf($part),
            'area' => $area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
        );



        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e1_3', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e1_3');

        } else {
            return false;
        }
    }
    /**
     * 監試及試務人員 > 試務
     */
    function form_e1_3_2()
    {

        $this->load->model('mod_voice_job_list');
        $this->load->model('mod_voice_exam_area');
        $this->load->model("mod_voice_part_addr");
        $part = $_GET['part'];
        $area = $_GET['area'];
        if ($_GET['part'] != "2500") {
            $part = $_GET['part'];
            $school = $this->mod_voice_exam_area->year_school_name($part);
        } else {
            $school = "";
        }

        $year = $this->input->get('year');
        $ladder = $this->input->get('ladder');
        if ($this->mod_voice_part_addr->chk_once($year, $ladder)) {
            $addr_info = $this->mod_voice_part_addr->get_once($year, $ladder);
        } else {
            $addr_info = array(
                'part_addr_1' => '',
                'part_addr_2' => '',
                'part_addr_3' => '',
            );
        }
        $data = array(
            'part' => $this->mod_voice_job_list->get_district_task($area, $part),
            'area' => $area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'addr_info' => $addr_info,
        );
        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e1_3_3', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e1_3_3');

        } else {
            return false;
        }
    }

    public function form_e1_3_4()
    {

        $this->load->model('mod_voice_job_list');
        $this->load->model('mod_voice_exam_area');
        $this->load->model("mod_voice_part_addr");
        $part = $_GET['part'];
        $area = $_GET['area'];
        if ($_GET['part'] != "2500") {
            $part = $_GET['part'];
            $school = $this->mod_voice_exam_area->year_school_name($part);
        } else {
            $school = "";
        }

        $year = $_SESSION['year'];
        $ladder = $_SESSION['ladder'];


        if ($this->mod_voice_part_addr->chk_once($year, $ladder)) {
            $addr_info = $this->mod_voice_part_addr->get_once($year, $ladder);
        } else {
            $addr_info = array(
                'part_addr_1' => '',
                'part_addr_2' => '',
                'part_addr_3' => '',
            );
        }
        $data = array(
            'part' => $this->mod_voice_job_list->get_trial_staff_list_for_pdf($area, $part),
            'area' => $area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'addr_info' => $addr_info,
        );
        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e1_3_4', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e1_3_4');

        } else {
            return false;
        }
    }

    public function form_e1_3_5()
    {

        $this->load->model('mod_voice_job_list');
        $this->load->model('mod_voice_exam_area');
        $this->load->model("mod_voice_part_addr");
        $part = $_GET['part'];
        $area = $_GET['area'];
        if ($_GET['part'] != "2500") {
            $part = $_GET['part'];
            $school = $this->mod_voice_exam_area->year_school_name($part);
        } else {
            $school = "";
        }

        $year = $_SESSION['year'];
        $ladder = $_SESSION['ladder'];

        if ($this->mod_voice_part_addr->chk_once($year, $ladder)) {
            $addr_info = $this->mod_voice_part_addr->get_once($year, $ladder);
        } else {
            $addr_info = array(
                'part_addr_1' => '',
                'part_addr_2' => '',
                'part_addr_3' => '',
            );
        }
        $data = array(
            'part' => $this->mod_voice_job_list->get_patrol_staff_list_for_pdf($area, $part),
            'area' => $area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'addr_info' => $addr_info,
        );
        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e1_3_5', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e1_3_5');

        } else {
            return false;
        }
    }

    /**
     * 缺考人數統計表
     */
    public function form_e1_4()
    {
        $this->load->model('mod_voice_area');
        $this->load->model('mod_voice_exam_area');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_datetime');
        $title = '缺考人數統計';
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');


        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $datetime_info = $this->mod_voice_exam_datetime->get_once($year, $ladder);
        
        // 取得所有考場
        $area_list = $this->mod_voice_trial->get_distinct_voice_area($part);
        
        // 取得考場資料
        foreach ($area_list as $k => $v) {
            // echo '1';
            $area_list[$k]['count_num_1'] = $this->mod_voice_area->get_count_num($v['field'], '1');
            $area_list[$k]['count_num_2'] = $this->mod_voice_area->get_count_num($v['field'], '2');

        }

        $data = array(
            'list' => $area_list,
            'count' => $this->mod_voice_exam_area->year_get_member_count_list($part),
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            // 'course' => $this->mod_voice_exam_datetime->get_course($year,$ladder),
            'datetime_info' => $datetime_info,
            'area' => $area
        );
        if ($data['list'] != false) {
            $view = $this->load->view('voice/form_e1_4', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e1_4');

        } else {
            return false;
        }
    }


    /********************************************
     * E2
     */

    public function form_e_2()
    {
        $this->mod_user->chk_status();
        $this->load->model('mod_voice_exam_datetime');
        $datetime_info = $this->mod_voice_exam_datetime->get_once($_SESSION['year'], $_SESSION['ladder']);
        $data = array(
            'title' => '簽到表 / 簽收單',
            'path' => 'voice/form_e_2',
            'path_text' => ' > 製作報表 > 簽到表 / 簽收單',
            'datetime_info' => $datetime_info
        );
        $this->load->view('layout', $data);
    }

    public function form_e_2_1_1()
    {

        $this->load->model('mod_voice_job_list');
        $this->load->model('mod_voice_exam_area');
        $this->load->model('mod_voice_exam_datetime');
        $part = $_GET['part'];
        $area = $_GET['area'];


        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');


        $data = array(
            'part' => $this->mod_voice_job_list->e_2_1($area, $part),
            'area' => $area,
            'datetime_info' => $this->mod_voice_exam_datetime->get_once($year, $ladder),
            'school' => $this->mod_voice_exam_area->year_school_name($part),
        );


        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_2_1_1', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e_2_1_1');
        } else {
            return false;
        }
    }

    public function form_e_2_1_2()
    {


        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        $this->load->model('mod_voice_exam_datetime');

        $title = '試務人員執行任務簽到表';
        $area = $_GET['area'];
        $part = $_GET['part'];
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');
        if ($_GET['part'] != "2500") {
            $part = $_GET['part'];
            $school = $this->mod_voice_exam_area->year_school_name($part);
        } else {
            $school = "";
        }
        $date = date('yyyy/m/d');


        $data = array(
            'part' => $this->mod_voice_trial->e_2_1_2($part),
            'area' => $area,
            'datetime_info' => $this->mod_voice_exam_datetime->get_once($year, $ladder),
            'school' => $school,
        );

        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_2_1_2', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e_2_1_2');
        } else {
            return false;
        }
    }

    public function form_e_2_1_3()
    {

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        $this->load->model('mod_voice_exam_datetime');

        $title = '試務人員執行任務簽到表';
        $area = $_GET['area'];
        $part = $_GET['part'];
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');
        if ($_GET['part'] != "2500") {
            $part = $_GET['part'];
            $school = $this->mod_voice_exam_area->year_school_name($part);
        } else {
            $school = "";
        }
        $date = date('yyyy/m/d');


        $data = array(
            'part' => $this->mod_voice_trial->e_2_1_3($part),
            'area' => $area,
            'datetime_info' => $this->mod_voice_exam_datetime->get_once($year, $ladder),
            'school' => $school,
        );
        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_2_1_3', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e_2_1_3');

        } else {
            return false;
        }
    }

    /**
     * 監試人員執行任務簽到表
     */
    public function form_e_2_2()
    {

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        $this->load->model('mod_voice_exam_datetime');

        $title = '監試人員執行任務簽到表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');
        $res = $this->mod_voice_trial->get_list_for_pdf($part);

        $count = [];
        foreach ($res as $key => $value) {
            if ($value['supervisor_1'] != '') {
                $count[$key] = $value;
            }
        }

        $data = array(
            'part' => $this->mod_voice_trial->get_list_for_pdf($part),
            'area' => $area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'datetime_info' => $this->mod_voice_exam_datetime->get_once($year, $ladder),
            'count' => count($count),

        );



        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_2_2', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e_2_2');
        } else {
            return false;
        }

    }
    /**
     * 監試人員執行任務簽到表
     */
    public function form_e_2_3_1()
    {

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        $this->load->model('mod_voice_exam_datetime');

        $title = '答案卷卡收發記錄單';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');


        $datetime_info = $this->mod_voice_exam_datetime->get_once($year, $ladder);
        $data = array(
            'part' => $this->mod_voice_trial->get_once_date_of_voucher1($part),
            'area' => $area,
            'datetime_info' => $datetime_info,
            'count' => $this->mod_voice_trial->get_patrol_member_count_1($part),
            'school' => $this->mod_voice_exam_area->year_school_name($part),
        );


        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_2_3_1', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e_2_3_1');
        } else {
            return false;
        }
    }

    public function form_e_2_3_2()
    {

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        $this->load->model('mod_voice_exam_datetime');

        $title = '答案卷卡收發記錄單';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $year = $this->session->userdata('year');

        $datetime_info = $this->mod_voice_exam_datetime->get_once($year);

        $data = array(
            'part' => $this->mod_voice_trial->get_once_date_of_voucher2($part),
            'area' => $area,
            'datetime_info' => $datetime_info,
            'count' => $this->mod_voice_trial->get_patrol_member_count_2($part),
            'school' => $this->mod_voice_exam_area->year_school_name($part),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_2_3_2', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e_2_3_2');

        } else {
            return false;
        }
    }

    public function form_e_2_3_3()
    {

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        $this->load->model('mod_voice_exam_datetime');


        $year = $this->session->userdata('year');

        $datetime_info = $this->mod_voice_exam_datetime->get_once($year);

        $data = array(
            'part' => $this->mod_voice_trial->get_once_date_of_voucher3($part),
            'area' => $area,
            'datetime_info' => $datetime_info,
            'count' => $this->mod_voice_trial->get_patrol_member_count_3($part),
            'school' => $this->mod_voice_exam_area->year_school_name($part),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_2_3_3', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e_2_3_3');
        } else {
            return false;
        }
    }
    /**
     * 監試說明會開會簽到表
     */
    public function form_e_2_4()
    {

        $this->load->model('mod_voice_job_list');
        
        // 過濾重複資料
        $data_list = array();
        foreach ($this->mod_voice_job_list->get_member_map_list() as $k => $v) {
            $clean_list = array();
            $member_code = array();
            foreach ($v as $k1 => $v1) {
                if (!in_array($v1['member_code'], $member_code)) {
                    $clean_list[] = $v1;
                    $member_code[] = $v1['member_code'];
                }
            }
            $data_list[$k] = $clean_list;
        }


        $data = array(
            'part' => $data_list
        );


        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_2_4', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e_2_4');
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

    /**
     * 開會通知單簽收報表
     */
    public function form_e_2_5()
    {

        $this->load->model('mod_voice_job_list');
        $this->load->model('mod_voice_exam_area');

        $data_list = array();
        foreach ($this->mod_voice_job_list->get_member_map_list() as $k => $v) {
            $clean_list = array();
            $member_code = array();
            foreach ($v as $k1 => $v1) {
                if (!in_array($v1['member_code'], $member_code)) {
                    $clean_list[] = $v1;
                    $member_code[] = $v1['member_code'];
                }
            }
            $data_list[$k] = $clean_list;
        }
        // print_r($data_list);
        $data = array(
            'data' => $this->mod_voice_job_list->member_map(),
            'list' => $data_list,
        );

        if ($data['list'] != false) {
            $view = $this->load->view('voice/form_e_2_5', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e_2_5');
        } else {
            return false;
        }
    }


    public function form_e_3()
    {
        $this->load->model('mod_voice_exam_datetime');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');

        $datetime_info = $this->mod_voice_exam_datetime->get_once($year, $ladder);

        $data = array(
            'title' => '日程表 / 分配表',
            'path' => 'voice/form_e_3',
            'path_text' => ' > 製作報表 > 日程表 / 分配表',
            'datetime_info' => $datetime_info
        );
        $this->load->view('voice_layout', $data);
    }


    public function form_e_3_2_1()
    {

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');

        $date = $_GET['date'];
        $part = $_GET['part'];
        $area = $_GET['area'];

        $data = array(
            'part' => $this->mod_voice_trial->e_3_2_1($part),
            'part1' => $this->mod_voice_trial->e_3_2_1_1($part),
            'area' => $area,
            'patrol_count' => $this->mod_voice_trial->get_patrol_member_count_1($part),
            'trial_count' => $this->mod_voice_trial->get_trial_member_count($part),
            'trial_count1' => $this->mod_voice_trial->get_trial_member_count1($part),
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'date' => $date,
        );
        $view = $this->load->view('voice/form_e_3_2_1', $data, true);
        $this->pdf->view_to_pdf($view, 'form_e_3_2_1');

    }



    public function form_e_3_2_2()
    {

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');

        $title = '試場工作人員分配表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $date = $_GET['date'];
        $data = array(
            'part' => $this->mod_voice_trial->e_3_2_1($part),
            'part1' => $this->mod_voice_trial->e_3_2_1_1($part),
            'area' => $area,
            'patrol_count' => $this->mod_voice_trial->get_patrol_member_count_1($part),
            'trial_count' => $this->mod_voice_trial->get_trial_member_count($part),
            'trial_count1' => $this->mod_voice_trial->get_trial_member_count1($part),
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'date' => $date,
        );
        // print_r($data);
        $view = $this->load->view('voice/form_e_3_2_2', $data, true);
        $this->pdf->view_to_pdf($view, 'form_e_3_2_2');

    }





    public function form_e_3_2_3()
    {

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');

        $date = $_GET['date'];
        $part = $_GET['part'];
        $area = $_GET['area'];
        $data = array(
            'part' => $this->mod_voice_trial->e_3_2_1($part),
            'part1' => $this->mod_voice_trial->e_3_2_1_1($part),
            'area' => $area,
            'patrol_count' => $this->mod_voice_trial->get_patrol_member_count_1($part),
            'trial_count' => $this->mod_voice_trial->get_trial_member_count($part),
            'trial_count1' => $this->mod_voice_trial->get_trial_member_count1($part),
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'date' => $date,
        );
        $view = $this->load->view('voice/form_e_3_2_3', $data, true);
        $this->pdf->view_to_pdf($view, 'form_e_3_2_3');

    }

    
    // 各考區試場及個考生座位分配表
    public function form_e_3_3()
    {

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        $this->load->model('mod_voice_area');
        $this->load->model('mod_voice_exam_datetime');
        $block_name = $this->input->get('block_name');
        $data_list = $this->mod_voice_area->total_list_by_part_name($block_name);
        $year = $_SESSION['year'];
        $ladder = $_SESSION['ladder'];
        $date = $this->mod_voice_exam_datetime->get_once($year, $ladder);
        $data = array(
            'data_list' => $data_list,
            'date' => $date,
            'block_name' => $block_name,
        );

        $view = $this->load->view('voice/form_e_3_3', $data, true);
        $this->pdf->view_to_pdf($view, 'form_e_3_3', true);
    }


    public function form_e_4()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '監試務工作說明會教務處書函',
            'path' => 'voice/form_e_4',
            'path_text' => ' > 製作報表 > 監試務工作說明會教務處書函',
        );
        $this->load->view('voice_layout', $data);
    }

    public function form_e_4_1()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '監試務工作說明會教務處書函',
            'path' => 'voice/form_e_4_1',
            'path_text' => ' > 製作報表 > 監試務工作說明會教務處書函',
        );
        $this->load->view('layout', $data);
    }

    public function form_e_4_1_1()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $member_codes = array();

        $i = 0;
        $arr = array();
        foreach ($this->mod_voice_trial->get_list_for_csv() as $k => $v) {

            if (!in_array($v['member_code'], $member_codes)) {
                $member_codes[] = $v['member_code'];
                $arr[] = $v;
            }
        }
        // print_r($arr);
        if (isset($arr)) {

            for ($i = 0; $i < count($arr); $i++) {
                // print_r($arr[$i]);
                # code...
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', '場次');
                $objPHPExcel->getActiveSheet()->setCellValue('C1', '人員');
                $objPHPExcel->getActiveSheet()->setCellValue('D1', '監試日期');

                $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['year']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['ladder']);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['member_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['do_date']);
            }

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="監試人員' . '.csv"');
            header('Cache-Control: max-age=0');



            $objWriter->save('php://output');
        }
    }

    public function form_e_4_1_2()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_job_list');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        $i = 0;
        $res = array();
        $member_codes = array();
        foreach ($this->mod_voice_job_list->get_list_for_csv() as $k => $v) {
            // print_r($v);
            if (!in_array($v['member_code'], $member_codes)) {
                $member_codes[] = $v['member_code'];
                $res[] = $v;
            }
        }

        if (isset($res)) {
            for ($i = 0; $i < count($res); $i++) {
                # code...
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', '場次');
                $objPHPExcel->getActiveSheet()->setCellValue('C1', '人員');
                $objPHPExcel->getActiveSheet()->setCellValue('D1', '執行日');
                $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $res[$i]['year']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $res[$i]['ladder']);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $res[$i]['name']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $res[$i]['do_date']);
            }


            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="試務人員' . '.csv"');
            header('Cache-Control: max-age=0');

            $objWriter->save('php://output');
        }
    }

    public function form_e_4_1_3()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_patorl');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_patorl->get_trial_staff_for_csv();

        if (isset($arr)) {
            for ($i = 0; $i < count($arr); $i++) {
                # code...
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', '場次');
                $objPHPExcel->getActiveSheet()->setCellValue('C1', '人員');
                $objPHPExcel->getActiveSheet()->setCellValue('D1', '監試日期');

                $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['year']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['ladder']);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['member_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['do_date']);
            }

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="管卷人員' . '.csv"');
            header('Cache-Control: max-age=0');



            $objWriter->save('php://output');
        }

    }

    public function form_e_4_1_4()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_patorl');
        $this->load->model('mod_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_patorl->get_patrol_for_csv();


        if (isset($arr)) {
            for ($i = 0; $i < count($arr); $i++) {
                # code...
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', '場次');
                $objPHPExcel->getActiveSheet()->setCellValue('C1', '人員');
                $objPHPExcel->getActiveSheet()->setCellValue('D1', '監試日期');

                $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['year']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['ladder']);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['member_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['do_date']);
            }

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="巡場人員' . '.csv"');
            header('Cache-Control: max-age=0');



            $objWriter->save('php://output');
        }
    }

    public function form_e_5()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '識別證 / 標籤',
            'path' => 'voice/form_e_5',
            'path_text' => ' > 製作報表 > 識別證 / 標籤',
        );
        $this->load->view('layout', $data);
    }

    public function form_e_5_1()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '識別證 / 標籤',
            'path' => 'voice/form_e_5_1',
            'path_text' => ' > 製作報表 > 識別證 / 標籤',
        );
        $this->load->view('layout', $data);
    }

    public function form_e_5_2()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '套印標籤',
            'path' => 'voice/form_e_5_2',
            'path_text' => ' > 製作報表 > 識別證 / 標籤 > 套印標籤',
        );
        $this->load->view('layout', $data);
    }

    public function form_e_5_1_1()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');
        $this->load->model('mod_voice_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_trial->get_list_for_csv();

        if (isset($arr)) {
            // for ($i=0; $i < count($arr); $i++) {
            $i = 0;
            foreach ($arr as $key => $value) {
                    # code...
                    # code...
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '分區');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', '職務');
                $objPHPExcel->getActiveSheet()->setCellValue('C1', '人員');
                $objPHPExcel->getActiveSheet()->setCellValue('D1', '編號');


                $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $value['area_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), '監試人員');
                $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $value['member_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $value['trial_staff_code']);
                $i = $i + 1;

            }

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="監試人員名牌' . '.csv"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }
    }

    public function form_e_5_1_2()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_job_list');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_job_list->get_list_for_csv();
        // print_r($arr);
        if (isset($arr)) {
            for ($i = 0; $i < count($arr); $i++) {

                switch ($arr[$i]['area']) {
                    case '0':
                        $area = '考區';
                        break;
                    case '1':
                        $area = '第一分區';
                        break;
                    case '2':
                        $area = '第二分區';
                        break;
                    case '3':
                        $area = '第三分區';
                        break;


                }
                # code...
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '分區');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', '職務');
                $objPHPExcel->getActiveSheet()->setCellValue('C1', '人員');
                $objPHPExcel->getActiveSheet()->setCellValue('D1', '編號');


                $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $area);
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
    }

    public function form_e_5_1_3()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_patorl');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_patorl->get_trial_staff_for_csv();
        if (isset($arr)) {
            for ($i = 0; $i < count($arr); $i++) {
                # code...
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '分區');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', '職務');
                $objPHPExcel->getActiveSheet()->setCellValue('C1', '人員');
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
    }

    public function form_e_5_1_4()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_patorl');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_patorl->get_patrol_for_csv();
        if (isset($arr)) {
            for ($i = 0; $i < count($arr); $i++) {
                # code...
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '分區');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', '職務');
                $objPHPExcel->getActiveSheet()->setCellValue('C1', '人員');
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
    }

    public function form_e_5_2_1()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');
        $this->load->model('mod_voice_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_trial->get_list_for_csv();
        if (isset($arr)) {
            // for ($i=0; $i < count($arr); $i++) {
            $i = 0;
            foreach ($arr as $key => $value) {
        
                
                # code...
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '單位');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', '人員');

                $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $value['member_unit']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $value['member_name']);
                $i = $i + 1;
            }

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="監試人員標籤樣式' . '.csv"');
            header('Cache-Control: max-age=0');



            $objWriter->save('php://output');
        }
    }

    public function form_e_5_2_2()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_job_list');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_job_list->get_district_task_csv();
        if (isset($arr)) {
            for ($i = 0; $i < count($arr); $i++) {
                # code...
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '單位');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', '人員');

                $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['member_unit']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['name']);
            }

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="試務人員標籤樣式' . '.csv"');
            header('Cache-Control: max-age=0');



            $objWriter->save('php://output');
        }
    }


    public function form_e_5_2_3()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_patorl');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_patorl->get_trial_staff_for_csv();
        if (isset($arr)) {
            for ($i = 0; $i < count($arr); $i++) {
                # code...
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '單位');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', '人員');

                $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['member_unit']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['member_name']);
            }

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="管卷人員標籤樣式' . '.csv"');
            header('Cache-Control: max-age=0');



            $objWriter->save('php://output');
        }
    }

    public function form_e_5_2_4()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_patorl');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_patorl->get_patrol_for_csv();
        if (isset($arr)) {
            for ($i = 0; $i < count($arr); $i++) {
                # code...
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '單位');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', '人員');

                $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['member_unit']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['member_name']);
            }

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="巡場人員標籤樣式' . '.csv"');
            header('Cache-Control: max-age=0');



            $objWriter->save('php://output');
        }
    }


    public function form_e_6()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '印領清冊',
            'path' => 'voice/form_e_6',
            'path_text' => ' > 製作報表 > 印領清冊',
        );
        $this->load->view('layout', $data);
    }

    public function form_e_6_1()
    {

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');

        $title = '監試人員印領清冊';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $arr = array();
        $fields = array();
        $dataarray = $this->mod_voice_trial->e_6_1($part);
        $i = 0;
        foreach ($dataarray as $k => $v) {

            $key = array_search($v['field'], $fields);
            if ($key === false) {
                $fields[] = $v['field'];
                $arr[$i] = $v;
                $i++;
            }

        }


        $data = array(
            'part' => $arr,
            'area' => $area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'salary' => $this->mod_voice_trial->get_all_salary_trial_total($part),
            'count' => $this->mod_voice_trial->e_6_1_member_count($part)
        );



        $view = $this->load->view('voice/form_e_6_1', $data, true);
        $this->pdf->view_to_pdf($view, 'form_e_6_1');
    }

    public function form_e_6_2()
    {

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');

        $title = '監試人員印領清冊';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];
        $obs = $_GET['obs'];
        $dataarray = $this->mod_voice_trial->get_list_for_obs($part, $obs);
        $i = 0;
        $fields = array();
        $arr = array();
        // print_r($dataarray);
        foreach ($dataarray as $k => $v) {

            $key = array_search($v['field'], $fields);
            if ($key === false) {
                $fields[] = $v['field'];
                $arr[$i] = $v;
                $i++;

            }

        }
        $data = array(
            'part' => $arr,
            'area' => $area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'salary' => $this->mod_voice_trial->get_all_salary_trial_total_of_obs($part, $obs),
            'count' => $this->mod_voice_trial->get_list_for_obs_member_count($part, $obs),
        );


        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_6_2', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e_6_2');

        } else {
            return false;
        }
    }

    public function form_e_6_3()
    {

        $this->load->model('mod_voice_job_list');
        $this->load->model('mod_voice_exam_area');

        $title = '試務人員印領清冊';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $test_partition = $_GET['test_partition'];

        $data = array(
            'part' => $this->mod_voice_job_list->get_district_task_money_list($test_partition),
            'test_partition' => $test_partition,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'salary' => $this->mod_voice_job_list->get_all_salary_trial_total_of_district($test_partition),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_6_3', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e_6_3');
        } else {
            return false;
        }
    }

    public function form_e_6_4()
    {

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');

        $part = $_GET['part'];
        $area = $_GET['area'];


        $data = array(
            'part' => $this->mod_voice_trial->get_trial_staff_task_money_list($part),
            'area' => $area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'salary' => $this->mod_voice_trial->get_trial_staff_salary_total($part),
            'count' => $this->mod_voice_trial->get_trial_staff_task_member_count($part),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_6_4', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e_6_4');
        } else {
            return false;
        }
    }

    public function form_e_6_5()
    {

        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');

        $part = $_GET['part'];
        $area = $_GET['area'];
        $data = array(
            'part' => $this->mod_voice_trial->get_patrol_staff_task_money_list($part),
            'area' => $area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'salary' => $this->mod_voice_trial->get_patrol_staff_salary_total($part),
            'count' => $this->mod_voice_trial->get_patrol_staff_task_member_count($part),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_6_5', $data, true);
            $this->pdf->view_to_pdf($view, 'form_e_6_5');
        } else {
            return false;
        }
    }

    public function form_e_7()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_job_list');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_job_list->get_all_assign_member_list();

        $i = 0;
        foreach ($arr as $key => $value) {
        
            # code...

            $objPHPExcel->getActiveSheet()->getStyle()->getNumberFormat()->setFormatCode();
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '職員代碼');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '單位');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '職稱');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '執勤日期');


            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), (string)$value['job_code'], PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $value['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $value['member_unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $value['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . (2 + $i), $value['do_date']);
            $i = $i + 1;
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header("content-type:application/csv;charset=UTF-8");
        header('Content-Disposition: attachment;filename="請公假名單檔案匯出' . '.csv"');
        header('Cache-Control: max-age=0');
        header("Expires:0");



        $objWriter->save('php://output');

    }


    // 監試人員印領清冊
    public function form_e_7_1()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $part = $_GET['part'];
        $area = $_GET['area'];
        $arr = array();
        $supervisor_codes = array();
        $i = 0;
        foreach ($this->mod_voice_trial->get_trial_moneylist_for_csv($part, '') as $k => $v) {
            // print_r($v['salary_section']);
            if ($v['salary_section'] != 0) { //有費用的才列出來
                $key = array_search($v['supervisor_code'], $supervisor_codes);
                if ($key === false) { //如果不曾出現過
                    $supervisor_codes[] = $v['supervisor_code'];
                    $arr[$i] = $v;
                    $i++;
                } else {
                    $arr[$key]['section_salary_total'] = $v['salary_section'];
                }
            }


        }
        // print_r($arr);
        // $arr = $this->mod_voice_trial->get_trial_moneylist_for_csv($part);
        for ($i = 0; $i < count($arr); $i++) {
            # code...

            // $objPHPExcel->getActiveSheet()->setCellValue('A0', '');
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '試場');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '監考費');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['field']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['section_salary_total']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['supervisor']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['section_salary_total']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $area . '印領清冊' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function form_e_7_2()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $part = $_GET['part'];
        $area = $_GET['area'];
        $obs = $_GET['obs'];

        $dataarray = $this->mod_voice_trial->get_trial_moneylist_for_csv($part, $obs);

        // print_r($dataarray);
        $arr = array();
        $supervisor_codes = array();
        $i = 0;
        foreach ($dataarray as $k => $v) {
            if ($v['salary_section'] != 0) { //有費用的才列出來
                $key = array_search($v['supervisor_code'], $supervisor_codes);
                if ($key === false) { //如果不曾出現過
                    $supervisor_codes[] = $v['supervisor_code'];
                    $arr[$i] = $v;
                    $i++;
                } else {
                    $arr[$key]['section_salary_total'] = $v['salary_section'];
                }
            }

        }

        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '試場');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '監考費');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $arr[$i]['field']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $arr[$i]['section_salary_total']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $arr[$i]['supervisor']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['section_salary_total']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $area . '印領清冊(身障)' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function form_e_7_3()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_job_list');
        $this->load->model('mod_voice_exam_area');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $part = $_GET['part'];
        $area = $_GET['area'];

        $school = $this->mod_voice_exam_area->year_school_name($part);
        $arr = $this->mod_voice_job_list->get_district_task_money_list($area);
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '序號');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '考場');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '工作費');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $i + 1);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $area);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $school['area_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . (2 + $i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . (2 + $i), number_format($arr[$i]['one_day_salary']));
            $objPHPExcel->getActiveSheet()->setCellValue('H' . (2 + $i), number_format($arr[$i]['total']));

        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $area . '試務人員印領清冊' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function form_e_7_4()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $part = $_GET['part'];
        $area = $_GET['area'];

        $school = $this->mod_voice_exam_area->year_school_name($part);
        $arr = $this->mod_voice_trial->get_trial_staff_task_money_list($part);
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '序號');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '考場');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '工作費');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $i + 1);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $area);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $school['area_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . (2 + $i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . (2 + $i), number_format($arr[$i]['salary_total']));
            $objPHPExcel->getActiveSheet()->setCellValue('H' . (2 + $i), number_format($arr[$i]['total']));

        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $area . '管卷人員印領清冊' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function form_e_7_5()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $part = $_GET['part'];
        $area = $_GET['area'];

        $school = $this->mod_voice_exam_area->year_school_name($part);
        $arr = $this->mod_voice_trial->get_patrol_staff_task_money_list($part);
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '序號');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '考場');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '工作費');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), $i + 1);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $area);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $school['area_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . (2 + $i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . (2 + $i), number_format($arr[$i]['salary_total']));
            $objPHPExcel->getActiveSheet()->setCellValue('H' . (2 + $i), number_format($arr[$i]['total']));

        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $area . '巡場人員印領清冊' . '.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function form_e_7_6()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $proctor = $this->mod_voice_trial->get_all();
        // print_r($proctor);
        $persons_data = [];
        for ($i = 0; $i < count($proctor); $i++) {
            $persons_data[$i] = $this->mod_voice_trial->get_person_data($proctor[$i]['supervisor_1']);
        }

        for ($i = 0; $i < count($persons_data); $i++) {
            # code...

            $objPHPExcel->getActiveSheet()->getStyle()->getNumberFormat()->setFormatCode();
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '序號');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '人員代碼');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '單位一');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '單位二');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '職稱');
            $objPHPExcel->getActiveSheet()->setCellValue('G1', '連絡電話');



            $objPHPExcel->getActiveSheet()->setCellValue('A' . (2 + $i), ($i + 1));
            $objPHPExcel->getActiveSheet()->setCellValue('B' . (2 + $i), $persons_data[$i]['member_code']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . (2 + $i), $persons_data[$i]['member_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . (2 + $i), $persons_data[$i]['unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . (2 + $i), $persons_data[$i]['member_unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . (2 + $i), $persons_data[$i]['member_title']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . (2 + $i), $persons_data[$i]['member_phone']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header("content-type:application/csv;charset=UTF-8");
        header('Content-Disposition: attachment;filename="監試人員名單' . '.csv"');
        header('Cache-Control: max-age=0');
        header("Expires:0");



        $objWriter->save('php://output');

    }



}

?>