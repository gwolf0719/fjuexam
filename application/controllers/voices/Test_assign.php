<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_assign extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_voice_part_info');
        $this->load->model('mod_voice_part_addr');
    }


    public function index()
    {
        $this->load->model('mod_part_info');
        $this->mod_user->chk_status();
        $data = array(
            'title'=> '試場分配',
            'path'=> 'voice/test_assign_index',
            'path_text'=> '英聽主選單 > 試場分配',
            'datalist'=> $this->mod_part_info->get_list(),   
        );

         $this->load->view('voice_layout', $data);

    }
    
    public function assign($part)
    {  
        
        switch ($part) {
            case '2501':
               $test_partition = '第一分區';
                break;
            case '2502':
                $test_partition = '第二分區';
                 break;
            case '2503':
                 $test_partition = '第三分區';
                  break;
            
           
        }
        $year = $this->session->userdata('year');
        if ($this->mod_voice_part_addr->chk_once($year)) {
            $addr_info = $this->mod_voice_part_addr->get_once($year);
        } else {
            $addr_info = array(
                'part_addr_1' => '',
                'part_addr_2' => '',
                'part_addr_3' => '',
            );
        }
        $datalist = array();

       $this->mod_user->chk_status();
       $data= array(
            'title'=> $test_partition,
            'path'=> 'voice/assign_c1',
            'path_text'=> '> 英聽主選單 > 試場分配 >'.$test_partition,
            'datalist'=> $this->mod_voice_part_info->get_list($part),
            'addr_info'=> $addr_info,
            'test_partition'=>$test_partition,

       );
       $this->load->view('voice_layout',$data);
    }

    public function  assign_c4()
    {
        $this->mod_user->chk_status();
        $this->load->model('mod_voice_part_addr');
        $year = $this->session->userdata('year');

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
            'title' => '分區地址',
            'path' => 'voice/assign_c4',
            'path_text' => ' > 英聽主選單 > 分區地址',
            'addr_info' => $addr_info,
        );
        $this->load->view('voice_layout', $data);
    }






}


?>