<style>
    table {
        width: 780px;
        border: 1px solid #999999;
        margin: 0px auto;
    }

    td {
        border: 1px solid #999999;
    }

    th {
        border: 1px solid #999999;
        text-align: center;
    }
</style>

<div>
    <h2 style="text-align:center">
        <?=$_SESSION['year']?>學年度定科目考試新北一考區</h2>
    <h2>監試人員監考科目日程對照表</h2>
</div>

<?php foreach ($part as $k => $v): ?>
<div>
    <p>編號：
        <?=$v['field']?>
    </p>
    <p>監試人員：
        <?=$v['supervisor_1']?>
    </p>
    <p>監試人員：
        <?=$v['supervisor_2']?>
    </p>
    <p>監試分區：
        <?php
        switch ($v['part']) {
            case '2501':
                echo '第一分區';
                break;
            case '2502':
                echo '第二分區';
                break;
            case '2503':
                echo '第三分區';
                break;
        }

        ?>
    </p>
    <p>監試日期：
        <?=$v['do_date']?>
    </p>
    <p>監試節次：
        <?=$v['test_section']?>
    </p>
    <p>監試科目如下：
        <br>

    </p>
</div>
<table class="" id="" style="width:510px;padding:10px 4px 10px 4px;text-align:center;">
    <tr>
        <td>物理</td>
        <td>化學</td>
        <td>生物</td>
        <td>數學乙</td>
        <td>國文</td>
        <td>英文</td>
        <td>數學甲</td>
        <td>歷史</td>
        <td>地理</td>
        <td>公民與社會</td>
    </tr>
    <tr>
        <td>
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
        <td>
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
        <td>
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
        <td>
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
        <td>
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
        <td>
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
        <td>
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
        <td>
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
        <td>
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
        <td>
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
<table class="" id="" style="width:510px;padding:10px 4px 10px 4px;text-align:center;">
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
    <tr>
        <td>
            <?=$datetime_info['day_1']; ?>
        </td>
        <td rowspan="3">預
            <br>備
            <br>鈴</td>
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
        <td rowspan="3">預
            <br>備
            <br>鈴</td>
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
        <td rowspan="3">預
            <br>備
            <br>鈴</td>
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
        <td rowspan="3">預
            <br>備
            <br>鈴</td>
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
        <td>
            <?=$datetime_info['day_2']; ?>
        </td>
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
        <td>
            <?=$datetime_info['day_3']; ?>
        </td>
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
<?php endforeach;
