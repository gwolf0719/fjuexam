<style>
.bb {
    border: 1px solid #999999;
    line-height:1cm;
    height:1.2cm;
}

table {
    text-align: center;
    border-spacing: 0px;
    width: 100%;
}

td {
    padding: 5px 0px;
    font-size: 16px;
}

* {
    overflow: visible !important;
}

table,tr,td,th,tbody,thead,tfoot {
    page-break-before: always;
    page-break-inside: avoid;
}
.W50 {
    width: 50%;
    float: left;
}
</style>

<?php foreach ($part as $k => $v): ?>
<table style="padding:5px 0px;text-align:center;">
    <thead>
        <tr>
            <td colspan="6" style="font-size:26px;text-align:center;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區</td>
        </tr>
        <tr>
            <td colspan="6" style="font-size:22px;text-align:center;"><?=$_GET['area']?><?=$school?>試題本、答案卷卡收發記錄單</td>
        </tr>
        <tr>
            <td colspan="6" style="font-size:22px;text-align:left;font-weight:bold;">管卷人員：<?=$k?></td>
        </tr>
        <tr>
            <td class="bb" colspan="2">日期 科目</td>
            <td class="bb" colspan="4"><?=mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?></td>
        </tr>
        <tr>
            <td class="bb" style="width:15%;">試場</td>
            <td class="bb" style="width:15%;">監試人員</td>
            <td class="bb">第1節<br>數乙</td>
            <td class="bb">第2節<br>國文</td>
            <td class="bb">第3節<br>英文</td>
            <td class="bb">第4節<br>數甲</td>
        </tr>
    </thead>
    <?php foreach ($v as $kc => $vc): ?>
    <tr>
        <td class="bb" rowspan="2" style="font-size:18px;"><?=$vc['field']?></td>
        <td class="bb"><?=$vc['supervisor_1']?></td>
        <td class="bb" style="font-size:18px;font-weight:bold;">
        <?php
            switch ($vc['subject_04']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
        <td class="bb" style="font-size:18px;font-weight:bold;">
        <?php
            switch ($vc['subject_05']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
        <td class="bb" style="font-size:18px;font-weight:bold;">
        <?php
            switch ($vc['subject_06']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
        <td class="bb" style="font-size:18px;font-weight:bold;">
        <?php
            switch ($vc['subject_07']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
    </tr>
    <tr>
        <td class="bb"><?=$vc['supervisor_2']?></td>
        <td class="bb" style="font-size:18px;font-weight:bold;">
        <?php
            switch ($vc['subject_04']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
        <td class="bb" style="font-size:18px;font-weight:bold;">
        <?php
            switch ($vc['subject_05']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
        <td class="bb" style="font-size:18px;font-weight:bold;">
        <?php
            switch ($vc['subject_06']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
        <td class="bb" style="font-size:18px;font-weight:bold;">
        <?php
            switch ($vc['subject_07']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
    </tr>
    <tr>
        <td class="bb" colspan="2" style="font-size:18px;font-weight:bold;">管卷人員簽收記錄表</td>
        <td class="bb" style="font-size:18px;font-weight:bold;">
        <?php
            switch ($vc['subject_04']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
        <td class="bb" style="font-size:18px;font-weight:bold;">
        <?php
            switch ($vc['subject_05']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
        <td class="bb" style="font-size:18px;font-weight:bold;">
        <?php
            switch ($vc['subject_06']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
        <td class="bb" style="font-size:18px;font-weight:bold;">
        <?php
            switch ($vc['subject_07']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }
        ?>
        </td>
    </tr>
    <?php if($kc%7 == 6):?>
            <tr class="hr">
                <td colspan="6" ></td>
            </tr>
        <?php endif;?>
    <?php endforeach;?>
</table>
<?php endforeach;
