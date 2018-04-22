<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Designated extends CI_Controller {

    public function index()
    {
        $this->mod_user->chk_status();
		$data=array(
			"title"=>"指考主選單",
            "path"=>"designated/index",
            "path_text"=>" > 指考主選單",
		);
		$this->load->view("layout",$data);
    }

    /**
     * a資料匯入作業
     */
    public function a()
    {
        $this->mod_user->chk_status();
		$data=array(
			"title"=>"資料匯入作業",
            "path"=>"designated/a",
            "path_text"=>" > 指考主選單 > 資料匯入作業",
		);
		$this->load->view("layout",$data);
    }
}

/* End of file Designated.php */
