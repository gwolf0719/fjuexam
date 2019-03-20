<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_voice_area extends CI_Model {

    // 用 part 分所有的考場資料
    function total_list_by_part_name($block_name=""){
        $part_list = $this->get_part_list();
        $res = array();
        foreach ($part_list as $key => $value) {
            # code...
            $this->db->where('ladder',$this->session->userdata('ladder'));
            $this->db->where('year',$this->session->userdata('year'));
            $this->db->where('part',$value['part']);

            if($block_name=='上午場'){
                $this->db->where('block_name',1);
            }else{
                $this->db->where('block_name',2);
            }


            // $this->db->select('field,start,end,count_num,floor');
            $this->db->distinct();
            $res[$key] = $value;
            $res[$key]['field'] = $this->db->get('voice_area_main')->result_array();
            $part_man_count = 0;
            foreach($res[$key]['field'] as $k2=>$v2){
                if($k2 == 0){
                    $res[$key]['start'] = $v2['start'];
                    $res[$key]['start_field'] = $v2['field'];
                }
                $res[$key]['end'] = $v2['end'];
                $res[$key]['end_field'] = $v2['field'];
                $part_man_count = $part_man_count+$v2['count_num'];
            }
            $res[$key]['part_man_count'] = $part_man_count;
            $res[$key]['field_count'] = count($res[$key]['field']);
        }
        // print_r($res);
        return $res;
    }
    function get_part_list(){
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->select('part,area_name');
        // $this->db->select('');
        $this->db->distinct();
        return $this->db->get('voice_area_main')->result_array();
    }

    // 多筆輸入
    function insert_batch($datas){


        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $this->db->delete('voice_area_main');
        $this->db->insert_batch('voice_area_main', $datas);
    }
  
    //把資料丟到陣列
    function voice_where_voice_area_main()
    {
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        return $this->db->get('voice_area_main')->result_array();
    }
    public function get_part($part = '')
    {
        $this->db->where('year', $this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        if ($part != '') {
            $this->db->where('part', $part);
        }
        $this->db->select('part,class');

        return $this->db->get('voice_exam_area')->result_array();
    }
    // 取得單一考場單一場次的人數
    function get_count_num($field,$block_name){
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $this->db->where('field',$field);
        $this->db->where('block_name',$block_name);
        $row = $this->db->get('voice_exam_area')->row_array();
        // print_r($row);
        $count = 0;
        if( $row['count_num'] != ""){
            $count =  $row['count_num'];
        }
        return $count;
    }





    /**
     * TODO:檢查A是否匯入完整
     */
    function check_a1(){
        
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $count1 = $this->db->count_all_results('voice_area_main');
        // print_r($count1);
        if($count1>0){$count1=1;}

        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $count2 = $this->db->count_all_results('voice_import_member');
        if($count2>0){$count2=1;}
        
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $count3 = $this->db->count_all_results('voice_job_list');
        if($count3>0){$count3=1;}

        $this->db->where('year',$this->session->userdata('year'));

        $count4 = $this->db->count_all_results('school_unit');
        if($count4>0){$count4=1;}

        // print_r($count1);
        // print_r($count2);
        // print_r($count3);
        // print_r($count4);
        $count=$count1+$count2+$count3+$count4;
        // print_r($count);

        if($count<4){
            return 'no';
        }else if($count==4){
            return 'yes';
        }
    }

    /**
     * TODO:檢查F是否匯入完整
     */
    function check_f(){
        
        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $count1 = $this->db->count_all_results('voice_exam_datetime');

        if($count1>0){$count1=1;}

        $this->db->where('year',$this->session->userdata('year'));
        $this->db->where('ladder',$this->session->userdata('ladder'));
        $count2 = $this->db->count_all_results('voice_test_pay');

        if($count2>0){$count2=1;}
        
        $count=$count1+$count2;
        if($count<2){
            return 'no';
        }else if($count==2){
            return 'yes';
        }
    }


   

}

/* End of file Mod_voice_area.php */
