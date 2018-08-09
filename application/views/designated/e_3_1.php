<style>

    .bb {
        border: 1px solid #999999;
    }

    th {
        border: 1px solid #999999;
        text-align: center;
    }
</style>

<?php foreach ($part as $k => $v): ?>
<table style="padding:10px 0px;text-align:center;">
    <thead>
        <tr>
            <td style="font-size:18px"><?=$_SESSION['year']?>學年度定科目考試新北一考區</td>
        </tr>
        <tr>
            <td style="font-size:14px">監試人員監考科目日程對照表</td>
        </tr>        
        <tr>
            <td style="text-align:left">編號:<?=$v['field']?></td>
        </tr>
        <tr>
            <td style="text-align:left">監試人員:<?=$v['supervisor']?></td>
        </tr>   
        <tr>
            <td style="text-align:left">監試分區:<?=$_GET['area']?></td>
        </tr>   
        <tr>
            <td style="text-align:left">監試日期:<?=$v['do_date']?></td>
        </tr>     
        <tr>
            <td style="text-align:left">監試節次:<?=$v['test_section']?></td>
        </tr>     
        <tr>
            <td style="line-height:1px"></td>
        </tr>                   
    </thead>
</table>
<table class="" id="" style="padding:4px;text-align:center;">
    <tr>
        <td class="bb">物理</td>
        <td class="bb">化學</td>
        <td class="bb">生物</td>
        <td class="bb">數學乙</td>
        <td class="bb">國文</td>
        <td class="bb">英文</td>
        <td class="bb">數學甲</td>
        <td class="bb">歷史</td>
        <td class="bb">地理</td>
        <td class="bb">公民與社會</td>
    </tr>
    <tr>
        <td class="bb">
            <?php
            switch ($v['subject_01']) {
                case '0':
                    echo '';
                    break;
                default:
                    echo 'V';
            }

            ?>

        </td>
        <td class="bb">
            <?php
            switch ($v['subject_02']) {
                case '0':
                    echo '';
                    break;
                default:
                    echo 'V';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_03']) {
                case '0':
                    echo '';
                    break;
                default:
                    echo 'V';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_04']) {
                case '0':
                    echo '';
                    break;
                default:
                    echo 'V';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_05']) {
                case '0':
                    echo '';
                    break;
                default:
                    echo 'V';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_06']) {
                case '0':
                    echo '';
                    break;
                default:
                    echo 'V';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_07']) {
                case '0':
                    echo '';
                    break;
                default:
                    echo 'V';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_08']) {
                case '0':
                    echo '';
                    break;
                default:
                    echo 'V';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_09']) {
                case '0':
                    echo '';
                    break;
                default:
                    echo 'V';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_10']) {
                case '0':
                    echo '';
                    break;
                default:
                    echo 'V';
            }

            ?>
        </td>
    </tr>
</table>
<table class="" id="" style="padding:4px;text-align:center;">
    <tr>
        <td colspan="9" style="padding:10px 0px;text-align:left;"></td>
    </tr>
    <tr>
        <td colspan="9" style="padding:10px 0px;text-align:left;">考試日程表：</td>
    </tr>
    <tr>
        <td colspan="9" style="padding:10px 0px;text-align:left;"></td>
    </tr>    
    <tr>
        <td class="bb">時間</td>
        <td class="bb" colspan="4">上午</td>
        <td class="bb" colspan="4">下午</td>
    </tr>
    <tr>
        <td class="bb">科目</td>
        <td class="bb" rowspan="2">
            <?=$datetime_info['pre_1']; ?>
        </td>
        <td class="bb" rowspan="2">
            <?=$datetime_info['course_1_start']; ?><br>|<br>
            <?=$datetime_info['course_1_end']; ?>
        </td>
        <td class="bb" rowspan="2">
            <?=$datetime_info['pre_2']; ?>
        </td>
        <td class="bb" rowspan="2">
            <?=$datetime_info['course_2_start']; ?><br>|<br>
            <?=$datetime_info['course_2_end']; ?>
        </td>
        <td class="bb" rowspan="2">
            <?=$datetime_info['pre_3']; ?>
        </td>
        <td class="bb" rowspan="2">
            <?=$datetime_info['course_3_start']; ?><br>|<br>
            <?=$datetime_info['course_3_end']; ?>
        </td>
        <td class="bb" rowspan="2">
            <?=$datetime_info['pre_4']; ?>
        </td>
        <td class="bb" rowspan="2">
            <?=$datetime_info['course_4_start']; ?><br>|<br>
            <?=$datetime_info['course_4_end']; ?>
        </td>
    </tr>
    <tr>
        <td class="bb" style="text-align:center">日期</td>
    </tr>
    <tr>
        <td class="bb">
            <?=mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?>
        </td>
        <td class="bb" rowspan="3">預備鈴</td>
        <td class="bb">
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
        <td class="bb" rowspan="3">預<br>備<br>鈴</td>
        <td class="bb">
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
        <td class="bb" rowspan="3">預<br>備<br>鈴</td>
        <td class="bb">
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
        <td class="bb" rowspan="3">預
            <br>備
            <br>鈴</td>
        <td class="bb">
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
        <td class="bb">
            <?=mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?>
        </td>
        <!-- <td></td> -->
        <td class="bb">
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
        <td class="bb">
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
        <td class="bb">
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
        <td class="bb">
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
        <td class="bb">
            <?=mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?>
        </td>
        <!-- <td></td> -->
        <td class="bb">
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
        <td class="bb">
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
        <td class="bb">
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
        <td class="bb">
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
<?php endforeach;
