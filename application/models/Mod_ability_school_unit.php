<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_ability_school_unit extends CI_Model
{
    public function import($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('ability_school_unit');
        $this->db->insert_batch('ability_school_unit', $datas);
    }

    public function year_get_list()
    {
        return $this->db->where('year', $this->session->userdata('year'))->get('ability_school_unit')->result_array();
    }

    public function year_get_school_unit_list()
    {
        $res = $this->db->where('year', $this->session->userdata('year'))->get('ability_school_unit')->result_array();
        if(!empty($res)){
            for ($i=0; $i < count($res); $i++) {
                # code...
                $school = $this->db->where('year', $this->session->userdata('year'))->get('school_unit')->result_array();
                $arr[$school[$i]['company_name_01']][] = array(
                    'company_name_01'=>$res[$i]['company_name_01'],
                    'company_name_02'=>$res[$i]['company_name_02'],
                    'department'=>$res[$i]['department'],
                    'code'=>$res[$i]['code'],
                );
            }
            return $arr;
        }else{
            return false;
        }

    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('ability_school_unit')->row_array();
    }

    public function add_once($data)
    {
        $data['sn'] = uniqid();
        $data['year'] = $this->session->userdata('year');
        $this->db->insert('ability_school_unit', $data);

        return true;
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('ability_school_unit', $data);

        return true;
    }

    public function remove_once($sn)
    {
        $this->db->where('sn', $sn);
        $this->db->delete('ability_school_unit');

        return true;
    }
}

/* End of file Mod_exam_area.php */
