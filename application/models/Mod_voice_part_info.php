<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_voice_part_info extends CI_Model
{
    public function import($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->truncate('voice_area_main');
        $this->db->insert_batch('voice_area_main', $datas);
    }

    public function year_get_list()
    {
        return $this->db->where('year', $this->session->userdata('year'))->get('voice_area_main')->result_array();
    }

    public function get_list($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($part != '') {
            $this->db->where('part', $part);
        }

        return $this->db->get('voice_area_main')->result_array();
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('voice_exam_area')->row_array();
    }

    
    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('voice_area_main', $data);
        return true;
    }

    public function update_floor($data)
    {
        $this->db->where('sn',$data['sn']);
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('part',$data['part']);
        $this->db->where('field>=', $data['start']);
        $this->db->where('field<=', $data['end']);
        $res = $this->db->get('voice_area_main')->result_array();
       
        // for ($i=0; $i < count($res); $i++) { 
            
        //     $arr[] = array(
        //         'sn'=>$res[$i]['sn'],
        //         'floor'=>$data['floor'],
                
        //     );
        // }
        // $this->db->update_batch('voice_area_main', $arr, 'sn');
        $this->db->update('voice_area_main',$data);
        return true;
    }    
}

/* End of file Mod_exam_area.php */
