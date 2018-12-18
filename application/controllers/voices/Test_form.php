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
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, 2,PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, 10);
        $obj_pdf->SetFont('msungstdlight', 'L', 14);

        $obj_pdf->setFontSubsetting(false);
        $data = array(
            'list' => $this->mod_school_unit->year_get_school_unit_list(),
        );
        if ($data['list'] != false) {
            $view =  $this->load->view('voice/form_e1_1', $data, true);
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = 'form_e1_1.html';
                $fp = fopen('./html/'.$path,'w');//建檔
                fwrite($fp,$view);
                fclose($fp);//關閉開啟的檔案
                // copy($path, './html/'.$path);

            }

            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/form_e1_1.html  ./pdf/form_e1_1.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/form_e1_1.pdf"</script>';
        }else{
            return false;
        }
    }

    public function form_e1_2()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_job_list');
        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '請公假名單';
        $date = date('yyyy/m/d');
        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData('', '', $title, '印表日期：'.$date);
        $obj_pdf->setPrintHeader(false);
        // $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, 7,PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('msungstdlight', 'L', 14);
        $obj_pdf->SetCellPadding(0);

        $obj_pdf->setFontSubsetting(false);

        $obj_pdf->AddPage();
        $data = array(
            'list' => $this->mod_voice_job_list->get_all_assign_member_list(),
        );
        // print_r($data);
        $view =  $this->load->view('voice/form_e1_2', $data, true);
        if (!is_dir('./html/')) {
            mkdir('./html/');
        } else {
            $path = 'form_e1_2.html';
            $fp = fopen('./html/'.$path,'w');//建檔
            fwrite($fp,$view);
            fclose($fp);//關閉開啟的檔案
            // copy($path, './html/'.$path);

        }

        if (!is_dir('./pdf/')) {
            mkdir('./pdf/');
        } else {
            exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/form_e1_2.html  ./pdf/form_e1_2.pdf');
        }
        echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/form_e1_2.pdf"</script>';
    }

    public function form_e1_3()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');

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
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, 5,PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, 10);
        $obj_pdf->SetFont('msungstdlight', 'L', 14);

        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->AddPage();
        $data = array(
            'part' => $this->mod_voice_trial->get_list_for_pdf($part),
            'area' => $area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
        );
        if($data['part'] != false){
          $view =  $this->load->view('voice/form_e1_3', $data, true);
          if (!is_dir('./html/')) {
              mkdir('./html/');
          } else {
              $path = 'form_e1_3.html';
              $fp = fopen('./html/'.$path,'w');//建檔
              fwrite($fp,$view);
              fclose($fp);//關閉開啟的檔案
              // copy($path, './html/'.$path);

          }

          if (!is_dir('./pdf/')) {
              mkdir('./pdf/');
          } else {
              exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/form_e1_3.html  ./pdf/form_e1_3.pdf');
          }
          echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/form_e1_3.pdf"</script>';
        }else{
          return false;
        }
    }


    public function form_e_1_3()
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
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, 5,PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, 10);
        $obj_pdf->SetFont('msungstdlight', 'L', 14);

        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->AddPage();
        $data = array(
            'part' => $this->mod_trial->get_list_for_pdf($part),
            'area' => $area,
            'school' => $this->mod_exam_area->year_school_name($part),
        );
        if($data['part'] != false){
          $view =  $this->load->view('designated/e_1_3', $data, true);
          if (!is_dir('./html/')) {
              mkdir('./html/');
          } else {
              $path = 'e_1_3.html';
              $fp = fopen('./html/'.$path,'w');//建檔
              fwrite($fp,$view);
              fclose($fp);//關閉開啟的檔案
              // copy($path, './html/'.$path);

          }

          if (!is_dir('./pdf/')) {
              mkdir('./pdf/');
          } else {
              exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/e_1_3.html  ./pdf/e_1_3.pdf');
          }
          echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/e_1_3.pdf"</script>';
        }else{
          return false;
        }
    }





}

?>