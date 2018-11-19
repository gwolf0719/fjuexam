<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{
    function import_position(){
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
                    $datas[$i] = $data;
                    $i = $i + 1;
                }
                $row = $row+1;
            }
           
            
            fclose($file);
            unlink($file_name);
            $json_arr['sys_code'] = '200';
            $json_arr['sys_msg'] = '資料上傳完成';
            $json_arr['datas'] = $datas;
            $json_arr['post'] = $_POST;
            
        }else{
            $json_arr['sys_code'] = '000';
            $json_arr['sys_msg'] = '資料上傳錯誤';
            
        }
        echo json_encode($json_arr);
    }
    // public function room_use_day1()
    // {
    //     $this->load->model('mod_exam_datetime');
    //     $res = $this->mod_exam_datetime->room_use_day("220140","220172",'2501');
    //     echo json_encode($res);
    //     // echo $this->db->last_query();
    // }

    // public function room_use_day2()
    // {
    //     $this->load->model('mod_exam_datetime');
    //     $res = $this->mod_exam_datetime->room_use_day("210114","292502",'2502');
    //     echo json_encode($res);
    //     // echo $this->db->last_query();
    // }    

    // public function get_once_day_section_test()
    // {
    //     $this->load->model('mod_exam_datetime');
    //     $res = $this->mod_exam_datetime->get_once_day_section_test('2', '210119', '210120');
    //     echo json_encode($res);
    // }

    // public function get_day_section()
    // {
    //     $this->load->model('mod_exam_datetime');
    //     $res = $this->mod_exam_datetime->get_day_section('210119', '210120');
    //     echo json_encode($res);
    // }

    // public function get_list_for_csv()
    // {
    //     $this->load->model('mod_trial');
    //     $res = $this->mod_trial->get_list_for_csv();
    //     echo json_encode($res);
    // }

    // function get_supervisor_member_count(){
    //     $this->load->model('mod_trial');
    //     $res = $this->mod_trial->get_supervisor_member_count('2501');
    //     echo json_encode($res);

    // }

    // public function e_3_2_1_1()
    // {
    //     $this->load->library('pdf');
    //     $this->load->model('mod_trial');
    //     $this->load->model('mod_exam_area');
    //     $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
    //     $obj_pdf->SetCreator(PDF_CREATOR);
    //     $title = '試場工作人員分配表';
    //     $date = date('yyyy/m/d');
    //     $part = $_GET['part'];
    //     $area = $_GET['area'];

    //     $obj_pdf->SetTitle($title);
    //     $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
    //     $obj_pdf->setPrintHeader(false);
    //     // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    //     $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    //     $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
    //     $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
    //     $obj_pdf->SetFont('msungstdlight', '', 12);

    //     $obj_pdf->setFontSubsetting(false);
    //     $obj_pdf->AddPage();
    //     $date = $_GET['date'];
    //     $data = array(
    //         'part' => $this->mod_trial->e_3_2_1($part),
    //         'area' => $area,
    //         'count'=> $this->mod_trial->get_patrol_member_count($part),
    //         'school' => $this->mod_exam_area->year_school_name($part),
    //         'date' => $date,
    //         'count'=>$this->mod_trial->e_6_1_member_count($part),
    //     );
    //     // print_r($data);
    //     $view =  $this->load->view('designated/e_3_2_1', $data, true);
    //     $obj_pdf->writeHTML($view);
    //     $obj_pdf->Output('試場工作人員分配表.pdf', 'I');
    // }
}

/* End of file Unit.php */
