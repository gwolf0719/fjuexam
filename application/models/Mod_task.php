<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_task extends CI_Model
{
    public function get_list($class = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($class != '') {
            $this->db->where('class', $class);
        }

        return $this->db->get('district_task')->result_array();
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('district_task')->row_array();
    }

    public function add_once($data)
    {
        $data['year'] = $this->session->userdata('year');
        $this->db->insert('district_task', $data);

        return true;
    }

    public function update_once($sn, $data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('district_task', $data);

        return true;
    }

    public function remove_once($sn)
    {
        $this->db->where('sn', $sn);
        $this->db->delete('district_task');

        return true;
    }

    // 取得所有試場
    public function get_field()
    {
        $this->db->select('field');

        return $this->db->get('exam_area')->result_array();
    }
}

/* End of file Mod_exam_area.php */
