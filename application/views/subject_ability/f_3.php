
<style>
    table {
        border: 1px solid #ccc;
        width: 100%;
    }

    td {
        padding: 5px;
        border: 1px solid #ccc;
        text-align: center;
    }
</style>
<script>
// window.onload=init();

//    function init(){
//     // alert('asdfgh');

//         var a=$(".lname").val();
//         console.log(a);
        
    
//     }

</script>


<div class="row">
    <div class="input-group col-sm-2">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>"
            readonly>

    </div>

    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/f3_title.png" alt="" style="width: 20%;">
    </div>

</div>

<div class="row">
    <?php if($data_list_4_day!=""||!empty($data_list_4_day)){?>
        <?php foreach($data_list_4_day as $key=>$datetime_info):?>
        <?php $i = $key+1;?>
        <div class="col-12">
            <table style="margin:15px 0px;">
                <tr>
                    <td>時間</td>
                    <td colspan="4">上午</td>
                    <td colspan="4">下午</td>
                </tr>
                <tr>
                    <td>科目</td>
                    <td rowspan="2">
                        <?=$datetime_info['pre_1']; ?>
                    </td>
                    <td rowspan="2">
                        <?=$datetime_info['course_1_start']; ?>~
                        <?=$datetime_info['course_1_end']; ?>
                    </td>
                    <td rowspan="2">
                        <?=$datetime_info['pre_2']; ?>
                    </td>
                    <td rowspan="2">
                        <?=$datetime_info['course_2_start']; ?>~
                        <?=$datetime_info['course_2_end']; ?>
                    </td>
                    <td rowspan="2">
                        <?=$datetime_info['pre_3']; ?>
                    </td>
                    <td rowspan="2">
                        <?=$datetime_info['course_3_start']; ?>~
                        <?=$datetime_info['course_3_end']; ?>
                    </td>
                    <td rowspan="2">
                        <?=$datetime_info['pre_4']; ?>
                    </td>
                    <td rowspan="2">
                        <?=$datetime_info['course_4_start']; ?>~
                        <?=$datetime_info['course_4_end']; ?>
                    </td>
                </tr>
                <tr>
                <td style="text-align:center">日期</td>
                </tr>
                    <!-- <?php if(isset($course[$i])){?> -->
                <tr>
                    <td>
                        <?=$datetime_info['do_date']; ?>
                    </td>
                    <td >預備鈴</td>
                    <td>
                        <?=$course[$i][$i.'_1']['subject']?>
                    </td>
                    <td >預備鈴</td>
                    <td>
                        <?=$course[$i][$i.'_2']['subject']?>
                    </td>
                    <td >預備鈴</td>
                    <td>
                        <?=$course[$i][$i.'_3']['subject']?>
                    </td>
                    <td >預備鈴</td>
                    <td>
                        <?=$course[$i][$i.'_4']['subject']?>
                    </td>
                </tr>
                    <!-- <?php }?> -->
                
            </table>


        </div>
        <?php endforeach;?>
    <?php }?>
    <div class="col-3"></div>

</div>