<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_task extends CI_Model
{
    /**
     * 取得職務列表
     */
    function get_job_list($year){
        $this->db->where("year",$year);
        $this->db->select("job");
        $this->db->distinct();
        $res = array();
        foreach ($this->db->get("district_task")->result_array() as $key => $value) {
            # code...
            $res[] = $value['job'];
        }
        return $res ;
    }

    /**
     * 建立新職務
     */
    function add_job($year,$job,$area){
        $data = array(
            "year"=>$year,
            "job"=>$job,
            "area"=>$area
        );
        $this->db->insert("district_task",$data);
    }

    public function get_list($area = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($area != '') {
            $this->db->where('area', $area);
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
