<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_school_unit extends CI_Model
{
    public function import($datas)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'))->delete('school_unit');
        $this->db->insert_batch('school_unit', $datas);
    }

    public function year_get_list()
    {
        return $this->db->where('year', $this->session->userdata('year'))->get('school_unit')->result_array();
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('school_unit')->row_array();
    }

    public function add_once($data)
    {
        $data['sn'] = uniqid();
        $data['year'] = $this->session->userdata('year');
        $this->db->insert('school_unit', $data);

        return true;
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('school_unit', $data);

        return true;
    }

    public function remove_once($sn)
    {
        $this->db->where('sn', $sn);
        $this->db->delete('school_unit');

        return true;
    }
}

/* End of file Mod_exam_area.php */
