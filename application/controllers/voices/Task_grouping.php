<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**任務編組 */
class Task_grouping extends CI_Controller {

    public function index()
    {
        $this->mod_user->chk_status();
        $data = array(
            'title' => '考區任務編組主選單',
            'path' => 'voice/index',
            'path_text' => ' > 考區任務編組主選單',
        );
        $this->load->view('layout', $data);
    }

}

/* End of file Task_grouping.php */
