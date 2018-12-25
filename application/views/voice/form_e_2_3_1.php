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
    table, tr, td, th, tbody, thead, tfoot {
        page-break-before: always;
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

<table style="text-align:center;margin:0px auto;">
    <thead>
        <tr>
            <td colspan="5" style="font-size:26px;text-align:center;"><?=$_SESSION['year']?>學年度英語聽力測驗<?=$_SESSION['ladder']?>考試新北一考區</td>
        </tr>
        <tr>
            <td colspan="5" style="font-size:22px;text-align:center;"><?=$_GET['area']?><?=$school['area_name']?>試題本、答案卷卡收發記錄單</td>
        </tr>
        <tr>
            <td colspan="5" style="font-size:22px;text-align:left;font-weight:bold;">管卷人員：<?=$value['trial_staff_name']?></td>
        </tr>
        <tr>
            <td class="bb" colspan="2"><div class="W50">日期</div>  <div class="W50">科目</div></td>
            <td class="bb" colspan="3"><?=mb_substr($datetime_info['day'], 5, 8, 'utf-8'); ?></td>
        </tr>
        <tr>
            <td class="bb" style="width: 15%;">試場</td>
            <td class="bb" style="width: 15%;">監試人員</td> 
            <td class="bb">上午場</td>
            <td class="bb">下午場</td>
        </tr>
    </thead>
    <?php foreach ($value['trial'] as $kc => $vc): ?>
        
        <tr>
            <td class="bb" rowspan="2" style="font-size:18px;"><?=$vc['field']?></td>
            <td class="bb" style="height:50px;"><?=$vc['supervisor_1']?></td>
            <td class="bb" style="font-weight:bold;font-size:18px;">
                <?php if(!isset($vc['block_1'])){
                    echo "X";
                }?>
            </td>
            <td class="bb" style="font-weight:bold;font-size:18px;">
                <?php if(!isset($vc['block_2'])){
                    echo "X";
                }?>
            </td>
            
        </tr>
        <tr>
            <td class="bb" style="height:50px;"><?=$vc['supervisor_2']?></td>
            <td class="bb" style="font-weight:bold;font-size:18px;">
                <?php if(!isset($vc['block_1'])){
                    echo "X";
                }?>
            </td>
            <td class="bb" style="font-weight:bold;font-size:18px;">
                <?php if(!isset($vc['block_2'])){
                    echo "X";
                }?>
            </td>
            
        </tr>
        <tr>
            <td class="bb" colspan="2" style="font-weight:bold;height:50px;">管卷人員簽收記錄表</td>
            <td class="bb" style="font-weight:bold;font-size:18px;">
                <?php if(!isset($vc['block_1'])){
                    echo "X";
                }?>
            </td>
            <td class="bb" style="font-weight:bold;font-size:18px;">
                <?php if(!isset($vc['block_2'])){
                    echo "X";
                }?>
            </td>
            
        </tr>
    <?php endforeach;?>
</table>
 <?php endforeach;?>