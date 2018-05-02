<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_task extends CI_Model
{
    /**
     * 取得職務列表.
     */
    public function get_job_list($year)
    {
        $this->db->where('year', $year);
        $this->db->select('job');
        $this->db->distinct();
        $res = array();
        foreach ($this->db->get('district_task')->result_array() as $key => $value) {
            // code...
            $res[] = $value['job'];
        }

        return $res;
    }

    public function chk_once($job_code)
    {
        $this->db->where('job_code', $job_code);
        if ($this->db->count_all_results('district_task') == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 建立新職務.
     */
    public function add_job($year, $job, $area)
    {
        $data = array(
            'year' => $year,
            'job' => $job,
            'area' => $area,
        );
        $this->db->insert('district_task', $data);
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

    public function update_job($sn, $sql_data)
    {
        $this->db->where('sn', $sn);
        $this->db->update('district_task', $sql_data);

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

    // 取得姓名
    public function get_member_info()
    {

        $this->db->distinct();
        $this->db->select('member_code,member_name');
        
        $data = $this->db->get('staff_member')->result_array();
        // echo $this->db->last_query();
        return $data;
    }

    // 用代號取得完整資料
    public function get_once_info($job_code)
    {
        $this->db->where('member_code', $job_code);
        $this->db->select('member_name,member_title,member_code,member_phone');

        return $this->db->get('staff_member')->row_array();
    }
}

/* End of file Mod_exam_area.php */
