<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_voice_trial extends CI_Model
{
    // public function get_field()
    // {
    //    $this->db->where('field');
    //    return true
    // }


    
    public function get_list($part = '')
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $this->db->where('block_name','上午場');
        if($part!=""){
            $this->db->where('part',$part);
        }
        $res = array();
        foreach ($this->db->get('voice_area_main')->result_array() as $key => $value) {
            # code...
            $res[$key]=$value;
            $res[$key]['trial_staff_code_1'] = '';
            $res[$key]['supervisor_1'] = '';
            $res[$key]['supervisor_1_code'] = '';
            $res[$key]['trial_staff_code_2'] = '';
            $res[$key]['supervisor_2'] = '';
            $res[$key]['supervisor_2_code'] = '';
            $res[$key]['note'] = '';
            $res[$key]['assign_sn'] = '';
            $assign = array();
            $this->db->where('year',$this->session->userdata('year'));
            $this->db->where('ladder',$this->session->userdata('ladder'));
            if($part!=""){
                $this->db->where('part',$part);
                $this->db->where('field',$value['field']);
            }
            $this->db->select('sn,field,trial_staff_code_1,supervisor_1,supervisor_1_code,trial_staff_code_2,supervisor_2,supervisor_2_code,note,block_name');
            $assign = $this->db->get('voice_trial_assign')->result_array();
            // 整合 block_name
            $block_name = array();
            $assign_sn = array();
            foreach($assign as $kb=>$kv){
                $block_name[] = $kv['block_name'] ;
                $assign_sn[] = $kv['sn'] ;
            }
            
            $res[$key]['assign_sn'] = implode(",",$assign_sn);
            $res[$key]['block_name'] = implode(",",$block_name);        
            $res[$key]['field'] = $assign[0]['field'];            
            $res[$key]['trial_staff_code_1'] = $assign[0]['trial_staff_code_1'];
            $res[$key]['supervisor_1'] = $assign[0]['supervisor_1'];
            $res[$key]['supervisor_1_code'] = $assign[0]['supervisor_1_code'];
            $res[$key]['trial_staff_code_2'] = $assign[0]['trial_staff_code_2'];
            $res[$key]['supervisor_2'] = $assign[0]['supervisor_2'];
            $res[$key]['supervisor_2_code'] = $assign[0]['supervisor_2_code'];
            $res[$key]['note'] = $assign[0]['note'];
        }
        
        return $res;

    }

    public function get_trial_list($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        return $this->db->get('voice_trial_staff')->result_array();
    }

    public function import($datas)
    {
        $this->db->where('year', $this->session->userdata('year'))->truncate('voice_trial_assign');
        $this->db->insert_batch('voice_trial_assign',$datas);

    }

    public function update_once($year,$ladder,$field,$part,$data)
    {
        $this->db->where('year', $year);
        $this->db->where('ladder', $ladder);
        $this->db->where('field', $field);
        $this->db->where('part', $part);
        
    
        $this->db->update('voice_trial_assign',$data);

        return true;
    }
    public function get_once_trial_by_code($trial_staff_code)
    {
        return $this->db->where('member_code', $trial_staff_code)->get('voice_import_member')->row_array();
    }  

    public function get_once_trial($sn)
    {
        return $this->db->where('sn', $sn)->get('voice_trial_staff')->row_array();
    }

    
    public function get_once_assign($sn)
    {
        return $this->db->where('sn', $sn)->get('voice_trial_assign')->row_array();
    }

    public function chk_once($year,$ladder,$field,$part)
    {
        $this->db->where('year', $year);
        $this->db->where('ladder', $ladder);
        $this->db->where('field', $field);
        $this->db->where('part', $part);

        if ($this->db->count_all_results('voice_trial_assign') == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function add_trial($data)
    {
        $this->db->insert('voice_trial_staff', $data);

        return true;
    }
    public function update_trial($sn, $data)
    {
       
        $this->db->where('sn', $sn);
        $this->db->update('voice_trial_staff', $data);

        return true;
    }

      /**
     * 檢查監試人員是否指派過
     */
     public function chk_trial_assigned($trial_staff_code){
        $this->db->where('supervisor_1_code',$trial_staff_code);
        $this->db->or_where('supervisor_2_code',$trial_staff_code);
        if($this->db->count_all_results('voice_trial_assign') == 0){
            return false;
        }else{
            return true;
        }
    }
    public function chk_trial($sn)
    {
        $this->db->where('sn', $sn);
        if ($this->db->count_all_results('voice_trial_staff') == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 檢查管卷人員試場是否重複
     */
    function chk_trial_staff_field($data){
        $this->db->where('part',$data['part']);
        $this->db->where('first_start',$data['first_start']);
        $this->db->where('first_end',$data['first_end']);
        $this->db->where('second_start',$data['second_start']);
        $this->db->where('second_end',$data['second_end']);
        if($this->db->count_all_results('voice_trial_staff') == 0){
            return false;
        }else{
            return true;
        }
    }

    public function remove_trial_staff($sn)
    {
        $this->db->where('sn', $sn);
        $this->db->delete('voice_trial_staff');

        return true;
    }


    public function chk_part_list($part, $area)
    {
        $this->db->select('*');
        if ($part != '') {
            $this->db->where('part', $part);
            // $this->db->where('year',$year);
            // $this->db->where('ladder',$ladder);
        }
        $this->db->from('voice_area_main');
        $this->db->join('voice_trial_assign', 'voice_area_main.sn = voice_trial_assign.sn');
        
        $this->db->where('first_member_do_date !=', "");
        $year = $this->session->userdata('year');

        $res = $this->db->get()->result_array();


        function even($var)
        {
            return($var['year'] == $_SESSION['year']);
        }

        $sub =  array_filter($res, "even");

        sort($sub);


        if (!empty($sub)) {
            return true;
        } else {
            return false;
        }
    }




}
?>