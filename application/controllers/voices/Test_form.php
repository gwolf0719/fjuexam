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
        $this->load->library('pdf');
        $this->load->model('mod_school_unit');
        
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

    /**
     * 監試及試務人員 > 監試人員
     */
    public function form_e1_3_1()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        
        $part = $_GET['part'];
        $area = $_GET['area'];
        
        
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
    /**
     * 監試及試務人員 > 試務
     */
    function form_e1_3_2(){
        $this->load->library('pdf');
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
        if ($this->mod_voice_part_addr->chk_once($year,$ladder)) {
            $addr_info = $this->mod_voice_part_addr->get_once($year,$ladder);
        } else {
            $addr_info = array(
                'part_addr_1' => '',
                'part_addr_2' => '',
                'part_addr_3' => '',
            );
        }
        $data = array(
            'part' => $this->mod_voice_job_list->get_district_task($area,$part),
            'area' => $area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'addr_info' => $addr_info,
        );
        if($data['part'] != false){
          $view =  $this->load->view('voice/form_e1_3_3', $data, true);
          if (!is_dir('./html/')) {
              mkdir('./html/');
          } else {
              $path = 'e_1_3_3.html';
              $fp = fopen('./html/'.$path,'w');//建檔
              fwrite($fp,$view);
              fclose($fp);//關閉開啟的檔案
              // copy($path, './html/'.$path);

          }

          if (!is_dir('./pdf/')) {
              mkdir('./pdf/');
          } else {
              exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/e_1_3_3.html  ./pdf/e_1_3_3.pdf');
          }
          echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/e_1_3_3.pdf"</script>';
        }
        else{
          return false;
        }
    }

    public function form_e1_3_3()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');

        $part = $_GET['part'];
        $area = $_GET['area'];
        
        $data = array(
            'part' => $this->mod_voice_trial->get_list_for_pdf($part),
            'area' => $area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
        );
        if($data['part'] != false){
              $this->load->view('voice/form_e_1_3', $data);
          $view =  $this->load->view('voice/form_e_1_3', $data, true);
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
    public function form_e1_3_4()
    {
        $this->load->library('pdf');
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
        if ($this->mod_voice_part_addr->chk_once($year)) {
            $addr_info = $this->mod_voice_part_addr->get_once($year);
        } else {
            $addr_info = array(
                'part_addr_1' => '',
                'part_addr_2' => '',
                'part_addr_3' => '',
            );
        }
        $data = array(
            'part' => $this->mod_voice_job_list->get_trial_staff_list_for_pdf($area,$part),
            'area' => $area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'addr_info' => $addr_info,
        );
        if($data['part'] != false){
          $view =  $this->load->view('designated/e_1_3_4', $data, true);
          if (!is_dir('./html/')) {
              mkdir('./html/');
          } else {
              $path = 'e_1_3_4.html';
              $fp = fopen('./html/'.$path,'w');//建檔
              fwrite($fp,$view);
              fclose($fp);//關閉開啟的檔案
              // copy($path, './html/'.$path);

          }

          if (!is_dir('./pdf/')) {
              mkdir('./pdf/');
          } else {
              exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/e_1_3_4.html  ./pdf/e_1_3_4.pdf');
          }
          echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/e_1_3_4.pdf"</script>';
        }else{
          return false;
        }
    }

    public function form_e1_4()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_task');
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
        if ($this->mod_voice_part_addr->chk_once($year)) {
            $addr_info = $this->mod_voice_part_addr->get_once($year);
        } else {
            $addr_info = array(
                'part_addr_1' => '',
                'part_addr_2' => '',
                'part_addr_3' => '',
            );
        }
        $data = array(
            'part' => $this->mod_voice_task->get_patrol_staff_list_for_pdf($area,$part),
            'area' => $area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'addr_info' => $addr_info,
        );
        if($data['part'] != false){
            $view =  $this->load->view('designated/e_1_3_5', $data, true);
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = 'e_1_3_5.html';
                $fp = fopen('./html/'.$path,'w');//建檔
                fwrite($fp,$view);
                fclose($fp);//關閉開啟的檔案
                // copy($path, './html/'.$path);

            }

            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/e_1_3_5.html  ./pdf/e_1_3_5.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/e_1_3_5.pdf"</script>';
        }else{
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
        $datetime_info = $this->mod_voice_exam_datetime->get_once($_SESSION['year'],$_SESSION['ladder']);
        $data = array(
            'title' => '簽到表 / 簽收單',
            'path' => 'voice/form_e_2',
            'path_text' => ' > 製作報表 > 簽到表 / 簽收單',
            'datetime_info'=>$datetime_info
        );
        $this->load->view('layout', $data);
    }

    public function form_e_2_1_1()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_job_list');
        $this->load->model('mod_voice_exam_area');
        

        $data = array(
            'part' => $this->mod_voice_job_list->e_2_1($area,$part),
            'area' => $area,
            // 'own'=> $this->mod_task->get_task_own_count($area),
            // 'veg'=> $this->mod_task->get_member_veg_count($area),
            // 'meat'=> $this->mod_task->get_member_meat_count($area),
            'school' => $school['area_name'],
        );
        if ($data['part'] != false) {
            $view =  $this->load->view('voice/form_e_2_1_1', $data, true);
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = 'form_e_2_1_1.html';
                $fp = fopen('./html/'.$path,'w');//建檔
                fwrite($fp,$view);
                fclose($fp);//關閉開啟的檔案
                // copy($path, './html/'.$path);

            }

            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/form_e_2_1_1.html  ./pdf/form_e_2_1_1.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/form_e_2_1_1.pdf"</script>';
        }else{
            return false;
        }
    }

    public function form_e_2_1_2()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        
        $title = '試務人員執行任務簽到表';
        $area = $_GET['area'];
        $part = $_GET['part'];
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
            // 'own'=> $this->mod_task->get_task_own_count($area),
            // 'veg'=> $this->mod_task->get_member_veg_count($area),
            // 'meat'=> $this->mod_task->get_member_meat_count($area),
            'school' => $school,
        );
        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_2_1_2', $data,true);
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = 'form_e_2_1_2.html';
                $fp = fopen('./html/'.$path,'w');//建檔
                fwrite($fp,$view);
                fclose($fp);//關閉開啟的檔案
                // copy($path, './html/'.$path);

            }
            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/form_e_2_1_2.html  ./pdf/form_e_2_1_2.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/form_e_2_1_2.pdf"</script>';
        }else{
            return false;
        }
    }

    public function form_e_2_1_3()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        
        $title = '試務人員執行任務簽到表';
        $area = $_GET['area'];
        $part = $_GET['part'];
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
            // 'own'=> $this->mod_task->get_task_own_count($area),
            // 'veg'=> $this->mod_task->get_member_veg_count($area),
            // 'meat'=> $this->mod_task->get_member_meat_count($area),
            'school' => $school,
        );
        if ($data['part'] != false) {
            $view =  $this->load->view('voice/form_e_2_1_3', $data, true);
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = 'form_e_2_1_3.html';
                $fp = fopen('./html/'.$path,'w');//建檔
                fwrite($fp,$view);
                fclose($fp);//關閉開啟的檔案
                // copy($path, './html/'.$path);

            }
            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/form_e_2_1_3.html  ./pdf/form_e_2_1_3.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/form_e_2_1_3.pdf"</script>';
        }else{
            return false;
        }
    }

    public function form_e_2_2()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        
        $title = '監試人員執行任務簽到表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        

        $year = $this->session->userdata('year');
        $data = array(
            'part' => $this->mod_voice_trial->get_date_for_trial_list($part),
            'area' =>$area,
            'school' => $this->mod_voice_exam_area->year_school_name($part),
        );
       

        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_2_2', $data,true);
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = 'form_e_2_2.html';
                $fp = fopen('./html/'.$path,'w');//建檔
                fwrite($fp,$view);
                fclose($fp);//關閉開啟的檔案
            }

            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality  --enable-forms http://uat.fofo.tw/fjuexam/html/form_e_2_2.html  ./pdf/form_e_2_2.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/form_e_2_2.pdf"</script>';
        }else{
            return false;
        }

    }

    public function form_e_2_3_1()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        $this->load->model('mod_voice_exam_datetime');

        $title = '答案卷卡收發記錄單';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');



        $datetime_info = $this->mod_voice_exam_datetime->get_once($year,$ladder);


        $data = array(
            'part' => $this->mod_voice_trial->get_once_date_of_voucher1($part),
            'area' => $area,
            'datetime_info' => $datetime_info,
            'count'=> $this->mod_voice_trial->get_patrol_member_count_1($part),
            'school' => $this->mod_voice_exam_area->year_school_name($part),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_2_3_1', $data,true);
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = 'form_e_2_3_1.html';
                $fp = fopen('./html/'.$path,'w');//建檔
                fwrite($fp,$view);
                fclose($fp);//關閉開啟的檔案
            }

            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality  --enable-forms http://uat.fofo.tw/fjuexam/html/form_e_2_3_1.html  ./pdf/form_e_2_3_1.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/form_e_2_3_1.pdf"</script>';
        }else{
            return false;
        }
    }

    public function e_2_3_2()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        $this->load->model('mod_voice_exam_datetime');

        $title = '答案卷卡收發記錄單';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $year = $this->session->userdata('year');

        $datetime_info = $this->mod_voice_exam_datetime->get_once($year);

        $obj_pdf->setFontSubsetting(false);
        $data = array(
            'part' => $this->mod_voice_trial->get_once_date_of_voucher2($part),
            'area' => $area,
            'datetime_info' => $datetime_info,
            'count'=> $this->mod_voice_trial->get_patrol_member_count_2($part),
            'school' => $this->mod_voice_exam_area->year_school_name($part),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_2_3_2', $data,true);
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = 'e_2_3_2.html';
                $fp = fopen('./html/'.$path,'w');//建檔
                fwrite($fp,$view);
                fclose($fp);//關閉開啟的檔案
            }

            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality  --enable-forms http://uat.fofo.tw/fjuexam/html/e_2_3_2.html  ./pdf/e_2_3_2.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/e_2_3_2.pdf"</script>';
        }else{
            return false;
        }
    }

    public function e_2_3_3()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        $this->load->model('mod_voice_exam_datetime');

        
        $year = $this->session->userdata('year');

        $datetime_info = $this->mod_voice_exam_datetime->get_once($year);

        $data = array(
            'part' => $this->mod_voice_trial->get_once_date_of_voucher3($part),
            'area' => $area,
            'datetime_info' => $datetime_info,
            'count'=> $this->mod_voice_trial->get_patrol_member_count_3($part),
            'school' => $this->mod_voice_exam_area->year_school_name($part),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('designated/e_2_3_3', $data,true);
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = 'e_2_3_3.html';
                $fp = fopen('./html/'.$path,'w');//建檔
                fwrite($fp,$view);
                fclose($fp);//關閉開啟的檔案
            }

            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality  --enable-forms http://uat.fofo.tw/fjuexam/html/e_2_3_3.html  ./pdf/e_2_3_3.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/e_2_3_3.pdf"</script>';
        }else{
            return false;
        }
    }

    public function form_e_2_4()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_job_list');
        
        $data = array(
            'part' => $this->mod_voice_job_list->get_sign_list(),
        );
        if ($data['part'] != false) {
            $view = $this->load->view('voice/form_e_2_4',$data,true);
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = 'form_e_2_4.html';
                $fp = fopen('./html/'.$path,'w');//建檔
                fwrite($fp,$view);
                fclose($fp);//關閉開啟的檔案
            }

            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality  --enable-forms http://uat.fofo.tw/fjuexam/html/form_e_2_4.html  ./pdf/form_e_2_4.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/form_e_2_4.pdf"</script>';
        }else{
            return false;
        }
    }


    function utf8_array_asort(&$array) {

        if(!isset($array) || !is_array($array)) {
            return false;
        }
        foreach($array as $k=>$v) {
            $array[$k] = iconv('UTF-8', 'GBK',$v);
        }
        asort($array);
        foreach($array as $k=>$v) {
            $array[$k] = iconv('GBK', 'UTF-8', $v);
        }
        return true;
    }

    public function form_e_2_5()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_job_list');
        $this->load->model('mod_voice_exam_area');

        
        $data = array(
            'data' => $this->mod_voice_job_list->member_map(),
            'list' => $this->mod_voice_job_list->get_member_map_list()
        );
        if ($data['list'] != false) {
            $view = $this->load->view('voice/form_e_2_5',$data,true);
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = 'form_e_2_5.html';
                $fp = fopen('./html/'.$path,'w');//建檔
                fwrite($fp,$view);
                fclose($fp);//關閉開啟的檔案
            }

            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality  --enable-forms http://uat.fofo.tw/fjuexam/html/form_e_2_5.html  ./pdf/form_e_2_5.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/form_e_2_5.pdf"</script>';
        }else{
            return false;
        }
    }


    public function form_e_3()
    {
        $this->load->model('mod_voice_exam_datetime');
        $this->mod_user->chk_status();
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');


        if ($this->mod_voice_exam_datetime->chk_once($year,$ladder)) {
            $datetime_info = $this->mod_voice_exam_datetime->get_once($year,$ladder);
        } else {
            $datetime_info = array(
                'day_1' => '1911' + $this->session->userdata('year').'/10/26',
                'course_1_start' => '08:40',
                'course_1_end' => '10:00',
                'course_2_start' => '10:50',
                'course_2_end' => '12:00',
                'course_3_start' => '14:00',
                'course_3_end' => '15:20',
                'pre_1' => '08:25',
                'pre_2' => '10:45',
                'pre_3' => '13:55',
                'pre_4' => '16:05',
            );
        }
        $data = array(
            'title' => '日程表 / 分配表',
            'path' => 'voice/form_e_3',
            'path_text' => ' > 製作報表 > 日程表 / 分配表',
            'datetime_info'=> $datetime_info
        );
        $this->load->view('voice_layout', $data);
    }

    public function form_e_3_1()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_exam_datetime');
        $this->load->model('mod_voice_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $part = $_GET['part'];
        $area = $_GET['area'];
        $year = $this->session->userdata('year');
        $ladder = $this->session->userdata('ladder');

        $datetime_info = $this->mod_voice_exam_datetime->get_once($year,$ladder);
        $course = $this->mod_voice_exam_datetime->get_course($year,$ladder);
        $res = $this->mod_voice_trial->get_supervisor_list($part);


     
        for ($i=0; $i < count($res); $i++) {
            # code...
            switch ($res[$i]['subject_01']) {
                case '0':
                    $subject_01 =  '';
                    break;
                default:
                    $subject_01 =  'V';
            }
        //     switch ($res[$i]['subject_2']) {
        //         case '0':
        //             $subject_02 =  '';
        //             break;
        //         default:
        //             $subject_02 =  'V';
        //     }

            switch ($course[0]['subject_01']) {
                case 'subject_00':
                    $course1 = '';
                    break;
                case 'subject_01':
                    $course1 = '英聽';
                    break;
            }

        //    switch ($course[1]['subject']) {
        //         case 'subject_00':
        //             $course2 = '';
        //             break;
        //         case 'subject_01':
        //             $course2 = '';
        //             break;
        //         case 'subject_02':
        //             $course2 = '化學';
        //             break;
        //     }

            $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '考試日期一');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '編號');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '監試人員姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('G1', '監試分區');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '監試日期');
            $objPHPExcel->getActiveSheet()->setCellValue('I1', '監試節次');
            $objPHPExcel->getActiveSheet()->setCellValue('O1', '英文');
            $objPHPExcel->getActiveSheet()->setCellValue('T1', '第1科');
            $objPHPExcel->getActiveSheet()->setCellValue('U1', '第1科');


            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $_SESSION['year']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), mb_substr($datetime_info['day'], 5, 8, 'utf-8'));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.(2+$i), $res[$i]['supervisor_code']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.(2+$i), trim($res[$i]['supervisor']));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.(2+$i), $_GET['area']);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.(2+$i), str_replace("、",",",$res[$i]['do_date']));
            $objPHPExcel->getActiveSheet()->setCellValue('I'.(2+$i), $res[$i]['test_section']);
            $objPHPExcel->getActiveSheet()->setCellValue('J'.(2+$i), $subject_01);
            $objPHPExcel->getActiveSheet()->setCellValue('T'.(2+$i), $course    );
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="監試人員監考日程表'.'.csv"');
        header('Cache-Control: max-age=0');


        $objWriter->save('php://output');
    }

    public function form_e_3_2_1()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        
        $date = $_GET['date'];
        $data = array(
            'part' => $this->mod_voice_trial->e_3_2_1($part),
            'area' => $area,
            'patrol_count'=> $this->mod_voice_trial->get_patrol_member_count_1($part),
            'trial_count'=>$this->mod_voice_trial->get_trial_member_count($part),
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'date' => $date,
        );
        // print_r($data);
        $view = $this->load->view('voice/form_e_3_2_1',$data, true);
        if (!is_dir('./html/')) {
            mkdir('./html/');
        } else {
            $path = 'form_e_3_2_1.html';
            $fp = fopen('./html/'.$path,'w');//建檔
            fwrite($fp,$view);
            fclose($fp);//關閉開啟的檔案
        }

        if (!is_dir('./pdf/')) {
            mkdir('./pdf/');
        } else {
            exec('wkhtmltopdf --lowquality http://uat.fofo.tw/fjuexam/html/form_e_3_2_1.html  ./pdf/form_e_3_2_1.pdf');
        }
        echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/form_e_3_2_1.pdf"</script>';
    }

    public function e_3_2_1_2()
    {
        $this->load->library('pdf');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        
        $date = $_GET['date'];
        $data = array(
            'part' => $this->mod_trial->e_3_2_2($part),
            'area' => $area,
            'patrol_count'=> $this->mod_trial->get_patrol_member_count_2($part),
            'trial_count'=>$this->mod_trial->get_trial_member_count($part),
            'school' => $this->mod_exam_area->year_school_name($part),
            'date' => $date,
        );
        // print_r($data);
        $view = $this->load->view('designated/e_3_2_1', $data, true);
        if (!is_dir('./html/')) {
            mkdir('./html/');
        } else {
            $path = 'e_3_2_1.html';
            $fp = fopen('./html/'.$path,'w');//建檔
            fwrite($fp,$view);
            fclose($fp);//關閉開啟的檔案
        }

        if (!is_dir('./pdf/')) {
            mkdir('./pdf/');
        } else {
            exec('wkhtmltopdf --lowquality http://uat.fofo.tw/fjuexam/html/e_3_2_1.html  ./pdf/e_3_2_1.pdf');
        }
        echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/e_3_2_1.pdf"</script>';
    }


    public function form_e_3_2_2()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        $obj_pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = '試場工作人員分配表';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $date = $_GET['date'];
        $data = array(
            'part' => $this->mod_voice_trial->e_3_2_1($part),
            'area' => $area,
            'patrol_count'=> $this->mod_voice_trial->get_patrol_member_count_1($part),
            'trial_count'=>$this->mod_voice_trial->get_trial_member_count($part),
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'date' => $date,
        );
        // print_r($data);
        $view =  $this->load->view('voice/form_e_3_2_2', $data, true);
        if (!is_dir('./html/')) {
            mkdir('./html/');
        } else {
            $path = 'form_e_3_2_2.html';
            $fp = fopen('./html/'.$path,'w');//建檔
            fwrite($fp,$view);
            fclose($fp);//關閉開啟的檔案
        }

        if (!is_dir('./pdf/')) {
            mkdir('./pdf/');
        } else {
            exec('wkhtmltopdf --lowquality http://uat.fofo.tw/fjuexam/html/form_e_3_2_2.html  ./pdf/form_e_3_2_2.pdf');
        }
        echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/form_e_3_2_2.pdf"</script>';
    }

  

  

    public function form_e_3_2_3()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_voice_exam_area');
        
        $date = $_GET['date'];
        $data = array(
            'part' => $this->mod_voice_trial->e_3_2_1($part),
            'area' => $area,
            'patrol_count'=> $this->mod_voice_trial->get_patrol_member_count_1($part),
            'trial_count'=>$this->mod_voice_trial->get_trial_member_count($part),
            'school' => $this->mod_voice_exam_area->year_school_name($part),
            'date' => $date,
        );
        // print_r($data);
        $view =  $this->load->view('voice/form_e_3_2_3', $data, true);
        if (!is_dir('./html/')) {
            mkdir('./html/');
        } else {
            $path = 'form_e_3_2_3.html';
            $fp = fopen('./html/'.$path,'w');//建檔
            fwrite($fp,$view);
            fclose($fp);//關閉開啟的檔案
        }

        if (!is_dir('./pdf/')) {
            mkdir('./pdf/');
        } else {
            exec('wkhtmltopdf --lowquality http://uat.fofo.tw/fjuexam/html/form_e_3_2_3.html  ./pdf/form_e_3_2_3.pdf');
        }
        echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/form_e_3_2_3.pdf"</script>';
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

    public function e_4_1_1()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_trial->get_list_for_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '監試人員');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '監試日期');

            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['year']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $arr[$i]['member_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['do_date']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="監試人員'.'.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function e_4_1_2()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_job_list');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $res = $this->mod_voice_job_list->get_list_for_csv();
        for ($i=0; $i < count($res); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '試務人員');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '執行日');
            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $res[$i]['year']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $res[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $res[$i]['do_date']);
        }


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="試務人員'. '.csv"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
    }

    public function e_4_1_3()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_patorl');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_patorl->get_trial_staff_for_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '試務人員');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '監試日期');

            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['year']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $arr[$i]['member_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['do_date']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="管卷人員'.'.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function e_4_1_4()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_patorl');
        $this->load->model('mod_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_patorl->get_patrol_for_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '學年度');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '試務人員');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '監試日期');

            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['year']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $arr[$i]['member_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['do_date']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="巡場人員'.'.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
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

    public function e_5_1_1()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');
        $this->load->model('mod_voice_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_trial->get_list_for_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '監試人員');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '編號');


            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['part_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), '監試人員');
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['member_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.(2+$i), $arr[$i]['trial_staff_code']);
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
        $this->load->model('mod_voice_job_list');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_job_list->get_list_for_csv();
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

    public function e_5_1_3()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_patorl');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_patorl->get_trial_staff_for_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '試務人員');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '編號');


            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['area']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['member_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.(2+$i), $arr[$i]['member_code']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="管卷人員名牌'.'.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function e_5_1_4()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_patorl');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_patorl->get_patrol_for_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '試務人員');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '編號');


            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['area']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['member_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.(2+$i), $arr[$i]['member_code']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="巡場人員名牌'.'.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function e_5_2_1()
    {
        $this->load->library('excel');
        $this->load->model('mod_patrol');
        $this->load->model('mod_voice_trial');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_trial->get_list_for_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '單位');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '監試人員');

            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['member_unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $arr[$i]['member_name']);
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
        $this->load->model('mod_voice_job_list');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_job_list->get_district_task_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '單位');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '試務人員');

            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['member_unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $arr[$i]['name']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="試務人員標籤樣式'.'.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }


    public function e_5_2_3()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_patorl');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_patorl->get_trial_staff_for_csv();
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '單位');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '試務人員');

            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['member_unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $arr[$i]['member_name']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="管卷人員標籤樣式'.'.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }

    public function e_5_2_4()
    {
        $this->load->library('excel');
        $this->load->model('mod_voice_patorl');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $arr = $this->mod_voice_patorl->get_patrol_for_csv();
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

    public function e_6_1()
    {
        $this->load->library('pdf');
        $this->load->model('mod_voice_trial');
        $this->load->model('mod_exam_area');
        
        $title = '監試人員印領清冊';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];
        $data = array(
            'part' => $this->mod_voice_trial->e_6_1($part),
            'area'=> $area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'salary'=>$this->mod_voice_trial->get_all_salary_trial_total($part),
            'count'=>$this->mod_voice_trial->e_6_1_member_count($part)
        );
        $view = $this->load->view('designated/e_6_1', $data,true);
        if (!is_dir('./html/')) {
            mkdir('./html/');
        } else {
            $path = 'e_6_1.html';
            $fp = fopen('./html/'.$path,'w');//建檔
            fwrite($fp,$view);
            fclose($fp);//關閉開啟的檔案
        }

        if (!is_dir('./pdf/')) {
            mkdir('./pdf/');
        } else {
            exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/e_6_1.html  ./pdf/e_6_1.pdf');
        }
        echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/e_6_1.pdf"</script>';
    }

    public function e_6_2()
    {
        $this->load->library('pdf');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        
        $title = '監試人員印領清冊';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];
        $obs = $_GET['obs'];
        $data = array(
            'part' => $this->mod_trial->get_list_for_obs($part, $obs),
            'area'=> $area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'salary'=>$this->mod_trial->get_all_salary_trial_total_of_obs($part,$obs),
            'count' => $this->mod_trial->get_list_for_obs_member_count($part, $obs),
        );
        if($data['part'] != false){
            $view =  $this->load->view('designated/e_6_2', $data, true);
            if (!is_dir('./html/')) {
                    mkdir('./html/');
                } else {
                    $path = 'e_6_2.html';
                    $fp = fopen('./html/'.$path,'w');//建檔
                    fwrite($fp,$view);
                    fclose($fp);//關閉開啟的檔案
                }

                if (!is_dir('./pdf/')) {
                    mkdir('./pdf/');
                } else {
                    exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/e_6_2.html  ./pdf/e_6_2.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/e_6_2.pdf"</script>';
        }else{
          return false;
        }
    }

    public function e_6_3()
    {
        $this->load->library('pdf');
        $this->load->model('mod_task');
        $this->load->model('mod_exam_area');
        
        $title = '試務人員印領清冊';
        $date = date('yyyy/m/d');
        $part = $_GET['part'];
        $area = $_GET['area'];

        $data = array(
            'part' => $this->mod_task->get_district_task_money_list($area),
            'area'=> $area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'salary'=>$this->mod_task->get_all_salary_trial_total_of_district($area),
        );
        if($data['part'] != false){
            $view =  $this->load->view('designated/e_6_3', $data,true);
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = 'e_6_3.html';
                $fp = fopen('./html/'.$path,'w');//建檔
                fwrite($fp,$view);
                fclose($fp);//關閉開啟的檔案
            }

            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/e_6_3.html  ./pdf/e_6_3.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/e_6_3.pdf"</script>';
        }else{
          return false;
        }
    }

    public function e_6_4()
    {
        $this->load->library('pdf');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
       
        $data = array(
            'part' => $this->mod_trial->get_trial_staff_task_money_list($part),
            'area'=> $area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'salary'=>$this->mod_trial->get_trial_staff_salary_total($part),
            'count' => $this->mod_trial->get_trial_staff_task_member_count($part),
        );
        if($data['part'] != false){
            $view =  $this->load->view('designated/e_6_4', $data, true);
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = 'e_6_4.html';
                $fp = fopen('./html/'.$path,'w');//建檔
                fwrite($fp,$view);
                fclose($fp);//關閉開啟的檔案
            }

            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/e_6_4.html  ./pdf/e_6_4.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/e_6_4.pdf"</script>';
        }else{
          return false;
        }
    }

    public function e_6_5()
    {
        $this->load->library('pdf');
        $this->load->model('mod_trial');
        $this->load->model('mod_exam_area');
        
        $data = array(
            'part' => $this->mod_trial->get_patrol_staff_task_money_list($part),
            'area'=> $area,
            'school' => $this->mod_exam_area->year_school_name($part),
            'salary'=>$this->mod_trial->get_patrol_staff_salary_total($part),
            'count' => $this->mod_trial->get_patrol_staff_task_member_count($part),
        );
        if($data['part'] != false){
            $view =  $this->load->view('designated/e_6_5', $data, true);
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = 'e_6_5.html';
                $fp = fopen('./html/'.$path,'w');//建檔
                fwrite($fp,$view);
                fclose($fp);//關閉開啟的檔案
            }

            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality --enable-forms http://uat.fofo.tw/fjuexam/html/e_6_5.html  ./pdf/e_6_5.pdf');
            }
            echo '<script>location.href="http://uat.fofo.tw/fjuexam/pdf/e_6_5.pdf"</script>';
        }else{
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
        for ($i=0; $i < count($arr); $i++) {
            # code...

            $objPHPExcel->getActiveSheet()->getStyle()->getNumberFormat()->setFormatCode();
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '職員代碼');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '單位');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '職稱');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '執勤日期');


            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), (string)$arr[$i]['job_code'],PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['member_unit']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.(2+$i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.(2+$i), $arr[$i]['do_date']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header("content-type:application/csv;charset=UTF-8");
        header('Content-Disposition: attachment;filename="檔案匯出'.'.csv"');
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
        // print_r($arr);
        for ($i=0; $i < count($arr); $i++) {
            # code...



            $objPHPExcel->getActiveSheet()->setCellValue('A0', '');
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '試場');

            $objPHPExcel->getActiveSheet()->setCellValue('B1', '監考費');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['field']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), number_format($arr[$i]['salary_section']));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['supervisor']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.(2+$i), $arr[$i]['section_salary_total']);
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


        $arr = $this->mod_trial->get_trial_list_of_obs_for_csv($part, $obs);
        for ($i=0; $i < count($arr); $i++) {
            # code...

            $objPHPExcel->getActiveSheet()->setCellValue('A1', '試場');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '監考費');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $arr[$i]['field']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), number_format($arr[$i]['salary_section']));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $arr[$i]['supervisor']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.(2+$i), $arr[$i]['section_salary_total']);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$area.'印領清冊'.'.csv"');
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
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '序號');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '考場');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '工作費');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $i+1);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $area);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $school);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.(2+$i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.(2+$i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.(2+$i), number_format($arr[$i]['one_day_salary']));
            $objPHPExcel->getActiveSheet()->setCellValue('H'.(2+$i), number_format($arr[$i]['total']));

        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$area.'試務人員印領清冊'.'.csv"');
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
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '序號');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '考場');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '工作費');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $i+1);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $area);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $school);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.(2+$i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.(2+$i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.(2+$i), number_format($arr[$i]['salary_total']));
            $objPHPExcel->getActiveSheet()->setCellValue('H'.(2+$i), number_format($arr[$i]['total']));

        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$area.'管卷人員印領清冊'.'.csv"');
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
        for ($i=0; $i < count($arr); $i++) {
            # code...
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '序號');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '分區');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '考場');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '姓名');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '職務');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '工作費');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '應領費用');
            $objPHPExcel->getActiveSheet()->setCellValue('A'.(2+$i), $i+1);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(2+$i), $area);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(2+$i), $school);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.(2+$i), $arr[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.(2+$i), $arr[$i]['job']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.(2+$i), number_format($arr[$i]['salary_total']));
            $objPHPExcel->getActiveSheet()->setCellValue('H'.(2+$i), number_format($arr[$i]['total']));

        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$area.'巡場人員印領清冊'.'.csv"');
        header('Cache-Control: max-age=0');



        $objWriter->save('php://output');
    }





}

?>