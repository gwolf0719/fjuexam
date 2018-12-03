<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_voice_staff extends CI_Model
{

      //工作人員寫入
    function insert_job($data)
    {
          $this->db->insert_batch('voice_import_member', $data);
    }

    function voice_where_voice_import_staff_member()
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        return $this->db->get('voice_import_member')->result_array();
    }

    function voice_get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('voice_import_member')->row_array();
    }


     function voice_chk_once($member_code)
    {
        $this->db->where('member_code', $member_code);
        if ($this->db->count_all_results('voice_import_member') == 0) {
            return false;
        } else {
            return true;
        }
    }

    function voice_add_once($data)
    {
       $data['year'] = $this->session->userdata('year');
       $this->db->insert('voice_import_member',$data);

       return true;
    }

    function voice_update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('voice_import_member', $data);

        return true;
    }
    function voice_remove_once($sn)
    {
        $this->db->where('sn', $sn);
        $this->db->delete('voice_import_member');

        return true;
    }
    
    public function get_staff_member($code)
    {
        return $this->db->where('member_code', $code)->get('voice_import_member')->row_array();
    }

    


}
?>