<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_voice_trial extends CI_Model
{

    public function get_list($part = '')
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->from('voice_area_main');
        // $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        return $this->db->get()->result_array();
    }

    public function import($datas)
    {
        $this->db->where('year', $this->session->userdata('year'))->delete('voice_trial_assign');
        $this->db->insert_batch('voice_trial_assign',$datas);

    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn',$sn);
        $this->db->update('voice_trial_assign',$data);

        return true;
    }

    
    public function get_once_assign($sn)
    {
        return $this->db->where('sn', $sn)->get('voice_trial_assign')->row_array();
    }

    public function chk_once($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('voice_trial_assign') == 0) {
            return false;
        } else {
            return true;
        }
    }






}
?>