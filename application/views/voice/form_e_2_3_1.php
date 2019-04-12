<style>
    .bb {
        border: 1px solid #999999;
    }
    table{
        text-align: center;
        border-spacing: 0px;
        width:100%;
    }
    td{
        padding: 5px 0px;
        font-size:16px;
    }
    * {
        overflow: visible !important;
    }
    h1{
        page-break-before: always;
    }
    table, tr, td, th, tbody, thead, tfoot {
        page-break-inside: avoid;
    }
    
    /* table td {
        word-break: break-all;
    }     */
    .W50{
        width:50%;
        float:left;
    }
</style>

<?php foreach ($part as $key => $value) :?>
<h1 style="font-size:30px;text-align:center;">
    <?=$_SESSION['year']?>學年度英語聽力測驗<?=$_SESSION['ladder']?>考試新北一考區
</h1>
<h3 style="font-size:26px;text-align:center;"><?=$_GET['area']?><?=$school['area_name']?>試題本、答案卷卡收發記錄單</h3>
<h4 style="font-size:26px;text-align:left;height: 10px;font-weight:bold;">管卷人員：<?=$value['trial_staff_code']?><?=$value['trial_staff_name']?></h4>
<table style="text-align:center;margin:0px auto;">
    <thead>
        <tr>
            <td class="bb" colspan="2" style="font-size:20px;"><div class="W50">日期</div>  <div class="W50">科目</div></td>
            <td class="bb" colspan="2" style="font-size:20px;"><?=mb_substr($datetime_info['day'], 5, 8, 'utf-8'); ?></td>
        </tr>
        <tr>
            <td class="bb" style="width: 15%;">試場</td>
            <td class="bb" style="width: 15%;">監試人員</td> 
            <td class="bb">上午場</td>
            <td class="bb">下午場</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($value['trial'] as $kc => $vc): ?>
        
        <tr>
            <td class="bb" rowspan="2" style="font-size:20px;"><?=$vc['field']?></td>
            <td class="bb" style="height:50px;font-size:20px;"><?=$vc['supervisor_1']?></td>
            <td class="bb" style="font-weight:bold;font-size:20px;">
                <?php if(!isset($vc['block_1'])){
                    echo "X";
                }?>
            </td>
            <td class="bb" style="font-weight:bold;font-size:20px;">
                <?php if(!isset($vc['block_2'])){
                    echo "X";
                }?>
            </td>
            
        </tr>
        <tr>
            <td class="bb" style="height:50px;font-size:20px;"><?=$vc['supervisor_2']?></td>
            <td class="bb" style="font-weight:bold;font-size:20px;">
                <?php if(!isset($vc['block_1'])){
                    echo "X";
                }?>
            </td>
            <td class="bb" style="font-weight:bold;font-size:20px;">
                <?php if(!isset($vc['block_2'])){
                    echo "X";
                }?>
            </td>
            
        </tr>
        <tr>
            <td class="bb" colspan="2" style="font-weight:bold;height:50px;">管卷人員簽收記錄表</td>
            <td class="bb" style="font-weight:bold;font-size:20px;">
                <?php if(!isset($vc['block_1'])){
                    echo "X";
                }?>
            </td>
            <td class="bb" style="font-weight:bold;font-size:20px;">
                <?php if(!isset($vc['block_2'])){
                    echo "X";
                }?>
            </td>
            
        </tr>
    <?php endforeach;?>
    </tbody>
    <tfoot></tfoot>
</table>
 <?php endforeach;?>