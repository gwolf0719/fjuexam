
</script>
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
    <!-- <div class="col-3"></div> -->
    <div class="col-12">
        <table>
            <tr>
                <td style="text-align:right">時間</td>
                <td colspan="4">上午</td>
                <td colspan="4">下午</td>
            </tr>
            <tr>
                <td>科目</td>
                <td rowspan="2"><?=$datetime_info['pre_1']; ?></td>
                <td rowspan="2"><?=$datetime_info['course_1_start']; ?> ~ <?=$datetime_info['course_1_end']; ?> </td>
                <td rowspan="2"><?=$datetime_info['pre_2']; ?></td>
                <td rowspan="2"><?=$datetime_info['course_2_start']; ?> ~ <?=$datetime_info['course_2_end']; ?> </td>
                <td rowspan="2"><?=$datetime_info['pre_3']; ?></td>
                <td rowspan="2"><?=$datetime_info['course_3_start']; ?> ~ <?=$datetime_info['course_3_end']; ?> </td>
                <td rowspan="2"><?=$datetime_info['pre_4']; ?></td>
                <td rowspan="2"><?=$datetime_info['course_4_start']; ?> ~ <?=$datetime_info['course_4_end']; ?> </td>
            </tr>
            <tr>
                <td style="text-align:center">日期</td>
            </tr>
            <tr>
                <td><?=$datetime_info['day_1']; ?></td>
                <td rowspan="3">預<br>備<br>鈴</td>
                <td>
                    <?php
                    switch ($course[0]['subject']) {
                        case 'subject_00':
                            echo '';
                            break;
                        case 'subject_01':
                            echo '物理';
                            break;
                        case 'subject_02':
                            echo '化學';
                            break;
                        case 'subject_03':
                            echo '生物';
                            break;
                        case 'subject_04':
                            echo '數乙';
                            break;
                        case 'subject_05':
                            echo '國文';
                            break;
                        case 'subject_06':
                            echo '英文';
                            break;
                        case 'subject_07':
                            echo '數甲';
                            break;
                        case 'subject_08':
                            echo '歷史';
                            break;
                        case 'subject_09':
                            echo '地理';
                            break;
                        case 'subject_10':
                            echo '公民與社會';
                            break;
                    }
                    ?>                    
                </td>
                <td rowspan="3">預<br>備<br>鈴</td>
                <td>
                    <?php
                    switch ($course[1]['subject']) {
                        case 'subject_00':
                            echo '';
                            break;
                        case 'subject_01':
                            echo '物理';
                            break;
                        case 'subject_02':
                            echo '化學';
                            break;
                        case 'subject_03':
                            echo '生物';
                            break;
                        case 'subject_04':
                            echo '數乙';
                            break;
                        case 'subject_05':
                            echo '國文';
                            break;
                        case 'subject_06':
                            echo '英文';
                            break;
                        case 'subject_07':
                            echo '數甲';
                            break;
                        case 'subject_08':
                            echo '歷史';
                            break;
                        case 'subject_09':
                            echo '地理';
                            break;
                        case 'subject_10':
                            echo '公民與社會';
                            break;
                    }
                    ?>  
                </td>
                <td rowspan="3">預<br>備<br>鈴</td>
                <td>
                <?php
                    switch ($course[2]['subject']) {
                        case 'subject_00':
                            echo '';
                            break;
                        case 'subject_01':
                            echo '物理';
                            break;
                        case 'subject_02':
                            echo '化學';
                            break;
                        case 'subject_03':
                            echo '生物';
                            break;
                        case 'subject_04':
                            echo '數乙';
                            break;
                        case 'subject_05':
                            echo '國文';
                            break;
                        case 'subject_06':
                            echo '英文';
                            break;
                        case 'subject_07':
                            echo '數甲';
                            break;
                        case 'subject_08':
                            echo '歷史';
                            break;
                        case 'subject_09':
                            echo '地理';
                            break;
                        case 'subject_10':
                            echo '公民與社會';
                            break;
                    }
                    ?>  
                </td>
                <td rowspan="3">預<br>備<br>鈴</td>
                <td>
                    <?php
                    switch ($course[3]['subject']) {
                        case 'subject_00':
                            echo '';
                            break;
                        case 'subject_01':
                            echo '物理';
                            break;
                        case 'subject_02':
                            echo '化學';
                            break;
                        case 'subject_03':
                            echo '生物';
                            break;
                        case 'subject_04':
                            echo '數乙';
                            break;
                        case 'subject_05':
                            echo '國文';
                            break;
                        case 'subject_06':
                            echo '英文';
                            break;
                        case 'subject_07':
                            echo '數甲';
                            break;
                        case 'subject_08':
                            echo '歷史';
                            break;
                        case 'subject_09':
                            echo '地理';
                            break;
                        case 'subject_10':
                            echo '公民與社會';
                            break;
                    }
                    ?>  
                </td>
            </tr>
            <tr>
                <td><?=$datetime_info['day_2']; ?></td>
                <!-- <td></td> -->
                <td>
                <?php
                    switch ($course[4]['subject']) {
                        case 'subject_00':
                            echo '';
                            break;
                        case 'subject_01':
                            echo '物理';
                            break;
                        case 'subject_02':
                            echo '化學';
                            break;
                        case 'subject_03':
                            echo '生物';
                            break;
                        case 'subject_04':
                            echo '數乙';
                            break;
                        case 'subject_05':
                            echo '國文';
                            break;
                        case 'subject_06':
                            echo '英文';
                            break;
                        case 'subject_07':
                            echo '數甲';
                            break;
                        case 'subject_08':
                            echo '歷史';
                            break;
                        case 'subject_09':
                            echo '地理';
                            break;
                        case 'subject_10':
                            echo '公民與社會';
                            break;
                    }
                    ?>  
                </td>
                <!-- <td></td> -->
                <td>
                    <?php
                    switch ($course[5]['subject']) {
                        case 'subject_00':
                            echo '';
                            break;
                        case 'subject_01':
                            echo '物理';
                            break;
                        case 'subject_02':
                            echo '化學';
                            break;
                        case 'subject_03':
                            echo '生物';
                            break;
                        case 'subject_04':
                            echo '數乙';
                            break;
                        case 'subject_05':
                            echo '國文';
                            break;
                        case 'subject_06':
                            echo '英文';
                            break;
                        case 'subject_07':
                            echo '數甲';
                            break;
                        case 'subject_08':
                            echo '歷史';
                            break;
                        case 'subject_09':
                            echo '地理';
                            break;
                        case 'subject_10':
                            echo '公民與社會';
                            break;
                    }
                    ?>  
                </td>
                <!-- <td></td> -->
                <td>
                    <?php
                    switch ($course[6]['subject']) {
                        case 'subject_00':
                            echo '';
                            break;
                        case 'subject_01':
                            echo '物理';
                            break;
                        case 'subject_02':
                            echo '化學';
                            break;
                        case 'subject_03':
                            echo '生物';
                            break;
                        case 'subject_04':
                            echo '數乙';
                            break;
                        case 'subject_05':
                            echo '國文';
                            break;
                        case 'subject_06':
                            echo '英文';
                            break;
                        case 'subject_07':
                            echo '數甲';
                            break;
                        case 'subject_08':
                            echo '歷史';
                            break;
                        case 'subject_09':
                            echo '地理';
                            break;
                        case 'subject_10':
                            echo '公民與社會';
                            break;
                    }
                    ?>  
                </td>
                <!-- <td></td> -->
                <td>
                    <?php
                    switch ($course[7]['subject']) {
                        case 'subject_00':
                            echo '';
                            break;
                        case 'subject_01':
                            echo '物理';
                            break;
                        case 'subject_02':
                            echo '化學';
                            break;
                        case 'subject_03':
                            echo '生物';
                            break;
                        case 'subject_04':
                            echo '數乙';
                            break;
                        case 'subject_05':
                            echo '國文';
                            break;
                        case 'subject_06':
                            echo '英文';
                            break;
                        case 'subject_07':
                            echo '數甲';
                            break;
                        case 'subject_08':
                            echo '歷史';
                            break;
                        case 'subject_09':
                            echo '地理';
                            break;
                        case 'subject_10':
                            echo '公民與社會';
                            break;
                    }
                    ?>  
                </td>
            </tr>
            <tr>
                <td><?=$datetime_info['day_3']; ?></td>
                <!-- <td></td> -->
                <td>
                <?php
                    switch ($course[8]['subject']) {
                        case 'subject_00':
                            echo '';
                            break;
                        case 'subject_01':
                            echo '物理';
                            break;
                        case 'subject_02':
                            echo '化學';
                            break;
                        case 'subject_03':
                            echo '生物';
                            break;
                        case 'subject_04':
                            echo '數乙';
                            break;
                        case 'subject_05':
                            echo '國文';
                            break;
                        case 'subject_06':
                            echo '英文';
                            break;
                        case 'subject_07':
                            echo '數甲';
                            break;
                        case 'subject_08':
                            echo '歷史';
                            break;
                        case 'subject_09':
                            echo '地理';
                            break;
                        case 'subject_10':
                            echo '公民與社會';
                            break;
                    }
                    ?>  
                </td>
                <!-- <td></td> -->
                <td>
                <?php
                    switch ($course[9]['subject']) {
                        case 'subject_00':
                            echo '';
                            break;
                        case 'subject_01':
                            echo '物理';
                            break;
                        case 'subject_02':
                            echo '化學';
                            break;
                        case 'subject_03':
                            echo '生物';
                            break;
                        case 'subject_04':
                            echo '數乙';
                            break;
                        case 'subject_05':
                            echo '國文';
                            break;
                        case 'subject_06':
                            echo '英文';
                            break;
                        case 'subject_07':
                            echo '數甲';
                            break;
                        case 'subject_08':
                            echo '歷史';
                            break;
                        case 'subject_09':
                            echo '地理';
                            break;
                        case 'subject_10':
                            echo '公民與社會';
                            break;
                    }
                    ?>  
                </td>
                <!-- <td></td> -->
                <td>
                <?php
                    switch ($course[10]['subject']) {
                        case 'subject_00':
                            echo '';
                            break;
                        case 'subject_01':
                            echo '物理';
                            break;
                        case 'subject_02':
                            echo '化學';
                            break;
                        case 'subject_03':
                            echo '生物';
                            break;
                        case 'subject_04':
                            echo '數乙';
                            break;
                        case 'subject_05':
                            echo '國文';
                            break;
                        case 'subject_06':
                            echo '英文';
                            break;
                        case 'subject_07':
                            echo '數甲';
                            break;
                        case 'subject_08':
                            echo '歷史';
                            break;
                        case 'subject_09':
                            echo '地理';
                            break;
                        case 'subject_10':
                            echo '公民與社會';
                            break;
                    }
                    ?>  
                </td>
                <!-- <td></td> -->
                <td>
                <?php
                    switch ($course[11]['subject']) {
                        case 'subject_00':
                            echo '';
                            break;
                        case 'subject_01':
                            echo '物理';
                            break;
                        case 'subject_02':
                            echo '化學';
                            break;
                        case 'subject_03':
                            echo '生物';
                            break;
                        case 'subject_04':
                            echo '數乙';
                            break;
                        case 'subject_05':
                            echo '國文';
                            break;
                        case 'subject_06':
                            echo '英文';
                            break;
                        case 'subject_07':
                            echo '數甲';
                            break;
                        case 'subject_08':
                            echo '歷史';
                            break;
                        case 'subject_09':
                            echo '地理';
                            break;
                        case 'subject_10':
                            echo '公民與社會';
                            break;
                    }
                    ?>  
                </td>
            </tr>
        </table>


    </div>
    <div class="col-3"></div>

</div>