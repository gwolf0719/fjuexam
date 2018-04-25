<style>
table{
    border:1px solid #ccc;
    width:100%;
}
td{
    padding:5px;
    border:1px solid #ccc;
    text-align:center;
}
</style>
<div class="row">
    <div class="input-group col-sm-2">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>" readonly>
        
    </div>

    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/f3_title.png" alt="" style="width: 20%;">
    </div>
    
</div>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <table>
            <tr>
                <td style="text-align:right">時間</td>
                <td colspan="4">上午</td>
                <td colspan="4">下午</td>
            </tr>
            <tr>
                <td>科目</td>
                <td rowspan="2"><?=$datetime_info['pre_1']?></td>
                <td rowspan="2"><?=$datetime_info['course_1_start']?> ~ <?=$datetime_info['course_1_end']?> </td>
                <td rowspan="2"><?=$datetime_info['pre_2']?></td>
                <td rowspan="2"><?=$datetime_info['course_2_start']?> ~ <?=$datetime_info['course_2_end']?> </td>
                <td rowspan="2"><?=$datetime_info['pre_3']?></td>
                <td rowspan="2"><?=$datetime_info['course_3_start']?> ~ <?=$datetime_info['course_3_end']?> </td>
                <td rowspan="2"><?=$datetime_info['pre_4']?></td>
                <td rowspan="2"><?=$datetime_info['course_4_start']?> ~ <?=$datetime_info['course_4_end']?> </td>
            </tr>
            <tr>
                <td style="text-align:left">日期</td>
            </tr>


            <tr>
                <td><?=$datetime_info['day_1']?></td>
                <td rowspan="3">預<br>備<br>鈴</td>
                <td><?=$course['1_1']?></td>
                <td rowspan="3">預<br>備<br>鈴</td>
                <td><?=$course['1_2']?></td>
                <td rowspan="3">預<br>備<br>鈴</td>
                <td><?=$course['1_3']?></td>
                <td rowspan="3">預<br>備<br>鈴</td>
                <td><?=$course['1_4']?></td>
            </tr>
            <tr>
                <td><?=$datetime_info['day_2']?></td>
                <!-- <td></td> -->
                <td><?=$course['2_1']?></td>
                <!-- <td></td> -->
                <td><?=$course['2_2']?></td>
                <!-- <td></td> -->
                <td><?=$course['2_3']?></td>
                <!-- <td></td> -->
                <td><?=$course['2_4']?></td>
            </tr>
            <tr>
                <td><?=$datetime_info['day_3']?></td>
                <!-- <td></td> -->
                <td><?=$course['3_1']?></td>
                <!-- <td></td> -->
                <td><?=$course['3_2']?></td>
                <!-- <td></td> -->
                <td><?=$course['3_3']?></td>
                <!-- <td></td> -->
                <td><?=$course['3_4']?></td>
            </tr>
        </table>


    </div>
    <div class="col-3"></div>

</div>