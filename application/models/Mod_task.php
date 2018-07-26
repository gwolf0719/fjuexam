<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_task extends CI_Model
{
    public function import($area)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('area', '考區');
        $this->db->delete('district_task');
        $this->db->insert_batch('district_task', $area);
    }

    public function import_1($area_1)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('area', '第一分區');
        $this->db->delete('district_task');
        $this->db->insert_batch('district_task', $area_1);
    }

    public function import_2($area_2)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('area', '第二分區');
        $this->db->delete('district_task');
        $this->db->insert_batch('district_task', $area_2);
    }

    public function import_3($area_3)
    {
        // 先清除當年資料
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('area', '第三分區');
        $this->db->delete('district_task');
        $this->db->insert_batch('district_task', $area_3);
    }

    /**
     * 取得職務列表.
     */
    public function get_job_list($year, $area)
    {
        $this->db->where('year', $year);
        $this->db->where('area', $area);
        $this->db->select('job');

        return $this->db->get('district_task')->result_array();
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

    public function chk_job_code($job_code)
    {
        $this->db->where('job_code', $job_code);
        if ($this->db->count_all_results('district_task') == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 檢查職務.
     */
    public function chk_job($job, $area)
    {
        $this->db->where('job', $job);
        $this->db->where('area', $area);
        if ($this->db->count_all_results('district_task') == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 建立新職務.
     */
    public function add_job($year, $job, $area, $trial_start, $trial_end)
    {
        $data = array(
            'year' => $year,
            'job' => $job,
            'area' => $area,
            'trial_start' => $trial_start,
            'trial_end' => $trial_end,
        );
        $this->db->insert('district_task', $data);
    }

    public function get_list($area = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        if ($area != '') {
            $this->db->where('area', $area);
        }
        $this->db->order_by('sn', 'asc');

        return $this->db->get('district_task')->result_array();
    }

    public function get_list_for_pdf()
    {
        $this->db->where('year', $this->session->userdata('year'));

        $res = $this->db->get('district_task')->result_array();

        

        for ($i=0; $i < count($res); $i++) {
            # code...
            $member_unit = $this->db->where('member_code', $res[$i]['job_code'])->select('member_unit')->get('staff_member')->row_array();
            if ($res[$i]['job_code'] != "") {
                $arr[] = array(
                    'job_code' => $res[$i]['job_code'],
                    'name' => $res[$i]['name'],
                    'job_title' => $res[$i]['job_title'],
                    'member_unit'=>$member_unit['member_unit'],
                    'do_date' => $res[$i]['do_date']
                );
            }
        }
        return $arr;
    }

    public function get_once($sn)
    {
        return $this->db->where('sn', $sn)->get('district_task')->row_array();
    }

    public function get_part_for_once($part)
    {
        return $this->db->where('area', $part)->get('district_task')->row_array();
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

        return $this->db->get('staff_member')->row_array();
    }
}

/* End of file Mod_exam_area.php */
