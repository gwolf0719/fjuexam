<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

    public function room_use_day()
    {
        $this->load->model('mod_exam_datetime');
        $res = $this->mod_exam_datetime->room_use_day("220140","220172");
        echo json_encode($res);
        // echo $this->db->last_query();
    }

}

/* End of file Unit.php */
?>