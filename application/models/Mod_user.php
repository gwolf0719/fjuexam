<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_user extends CI_Model {
    // 確認帳密
    function chk_login($user_id,$user_pwd){
        $this->db->where("user_id",$user_id);
        $this->db->where("user_pwd",$user_pwd);
        if($this->db->count_all_results("user") == 0 ){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    // 執行登入
    function do_login($user_id){
        $data = array(
            "user_id"=>$user_id,
            "login"=>TRUE,
            "year"=>date("Y")-1911,
        );
        $this->session->set_userdata($data);
    }

    // 確認登入狀態
    public function chk_status()
    {
        if(!$this->session->userdata("login")){
            
            redirect(base_url("login"),'refresh');
            
        }else{
            return TRUE;
        }
    }
    

}

/* End of file Mod_usser.php */
