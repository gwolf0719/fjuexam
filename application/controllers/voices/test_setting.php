<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**任務編組 */
class Test_setting extends CI_Controller {

    public function index()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '考程設定',
            'path' => 'voice/testing_setting',
            'path_text' => ' > 考程設定',
        );
        $this->load->view('layout', $data);
    }









}
