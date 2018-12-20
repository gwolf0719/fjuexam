<style>

    .bb {
        border: 1px solid #999999;
    }


</style>

<?php foreach ($part as $k => $v): ?>
<table style="padding:2px 0px;text-align:center;">
    <tr>
        <td colspan="14" style="font-size:16px;text-align:center;"><?=$_SESSION['year']?>學年度英語能力測驗<?=$_SESSION['ladder']?>考試新北一考區</td>
    </tr>
    <tr>
        <td colspan="14" style="font-size:16px;text-align:center;"><?=$_GET['area']?><?=$school?>試題本、答案券收發記錄單</td>
    </tr>    
    <thead>
        <tr>
            <td colspan="14" style="font-size:13px;text-align:left;">管券人員：<?=$k?></td>
        </tr>    
        <tr>
            <td class="bb" colspan="3">日期</td>
            <td class="bb" colspan="3"><?=mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?></td>
            <td class="bb" colspan="4"><?=mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?></td>
            <td class="bb" colspan="4"><?=mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?></td>
        </tr>
        <tr>
            <td class="bb">試場</td>
            <td class="bb" colspan="2">監試人員</td>
            <td class="bb">第1節<br>物理</td>
            <td class="bb">第2節<br>化學</td>
            <td class="bb">第3節<br>生物</td>
            <td class="bb">第1節<br>數學乙</td>
            <td class="bb">第2節<br>國文</td>
            <td class="bb">第3節<br>英文</td>
            <td class="bb">第4節<br>數學甲</td>
            <td class="bb">第1節<br>歷史</td>
            <td class="bb">第2節<br>地理</td>
            <td class="bb" colspan="2">第3節<br>公民與社會</td>            
        </tr>      
    </thead>
    <tr>
        <td class="bb"><?=$v['field']?></td>
        <td class="bb" colspan="2"><?=$v['supervisor_1']?><br><?=$v['supervisor_2']?></td>
        <td class="bb">
            <?php
            switch ($v['subject_01']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }

            ?>

        </td>
        <td class="bb">
            <?php
            switch ($v['subject_02']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_03']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_04']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_05']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_06']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_07']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_08']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }

            ?>
        </td>
        <td class="bb">
            <?php
            switch ($v['subject_09']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }

            ?>
        </td>
        <td class="bb" colspan="2">
            <?php
            switch ($v['subject_10']) {
                case '0':
                    echo 'X';
                    break;
                default:
                    echo '';
            }

            ?>
        </td>
    </tr>
</table>
<!-- <table class="" id="" style="padding:4px;text-align:center;">


   
</table> -->
<?php endforeach;
