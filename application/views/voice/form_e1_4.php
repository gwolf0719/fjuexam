<style>
    .bb {
        border: 1px solid #999999;
    }
    table{
        text-align: center;
        border-spacing: 0px;
        margin: 0 auto;
    }
    td{
        padding: 5px 0px;
    }
    * {
        overflow: visible !important;
    }
    table, tr, td, th, tbody, thead, tfoot {
        page-break-inside: avoid !important;
    }
</style>



<table class="" id="">
    <thead>
        <tr>
            <td colspan="22" style="font-size:26px;"><?=$_SESSION['year']?>學年度英語能力測驗<?=$_SESSION['ladder']?>考試新北一考區缺考人數統計表</td>
        </tr>
        <tr>
            <td colspan="22" style="font-size:22px;"><?=$area?><?=$school['area_name']?></td>
        </tr>
        <tr>
            <td class="bb" colspan="2">日期</td>
            <td class="bb" colspan="6" class="bb">
                <?=mb_substr($datetime_info['day'], 5, 8, 'utf-8'); ?>
            </td>
   
        </tr>
        <tr>
            <td class="bb" colspan="2">科目</td>
            <td class="bb" colspan="2">上午場
                <br>英聽</td>
            <td class="bb" colspan="2">下午場
                <br>英聽</td>
        </tr>
        <tr>
            <td class="bb" colspan="2">試場</td>
            <td class="bb">考生
                <br>人數</td>
            <td class="bb">缺考
                <br>人數</td>
            <td class="bb">考生
                <br>人數</td>
            <td class="bb">缺考
                <br>人數</td>
          
        </tr>
    </thead>
    <tbody>
    <?php foreach ($list as $k => $v): ?>
    <tr>
        <td class="bb" colspan="2" style="font-size:16px;">
            <?=$v['field']?>
        </td>
        <td class="bb">
            <?=$v['count_num_1']?>
        </td>
        <td class="bb">
          
        </td>
        <td class="bb">
            <?=$v['count_num_2']?>
        </td>
        <td class="bb">
          
        </td>
     

    </tr>
    <?php endforeach; ?>
    <tr>
        <td class="bb" colspan="2">共計</td>
        <td class="bb"><?=$count['number1']?></td>
        <td class="bb"></td>
        <td class="bb"><?=$count['number1']?></td>
        <td class="bb"></td>
        
     
    </tr>
    </tbody>

</table>
