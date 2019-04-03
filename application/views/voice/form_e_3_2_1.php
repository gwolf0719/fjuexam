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
        padding: 15px 0px;
        font-size:16px;
    }
    th{
        padding: 15px 0px;
        font-size:16px;
    }
    * {
        overflow: visible !important;
    }
    table, tr, td, th, tbody, thead, tfoot {
        page-break-before: always;
        page-break-inside: avoid;
    }
    .W50{
        width:50%;
        float:left;
    }
</style>

<table class="" id="" style="padding: 15px 0px;text-align:center;">

    <tr>
        <td width="100%" colspan="7" style="font-size:30px;text-align:center;"><?=$_SESSION['year']?>學年度英語聽力測驗<?=$_SESSION['ladder']?>考試新北一考區</td>
    </tr>
    <tr>
        <td width="100%" colspan="7" style="font-size:26px;text-align:center;"><?=$area?><?=$school['ladder']?>試場工作人員分配表 (<?=$date?>)(上午場)</td>
    </tr>
    <tr style="background:#FFE4E7">
        <th class="bb" style="font-size:20px;">試場</th>
        <th class="bb" style="font-size:20px;">考生起訖號碼</th>
        <th class="bb" style="font-size:20px;">人數</th>
        <th class="bb" style="font-size:20px;">樓層別</th>
        <th class="bb" style="font-size:20px;">監試人員</th>
        <th class="bb" style="font-size:20px;">監試人員</th>
        <th class="bb" style="font-size:20px;">試務人員</th>
    </tr>
    <?php 
        $data = array();
        $p_count=0;

    ?>
    <?php foreach ($part as $k => $v): ?>
    <?php 
        $p=trim($v['voucher']);


        if(in_array($p,$data)){

        } else {
            if(strlen($p)>0){
                array_push($data,$p);
                $p_count=$p_count+1;
            }
        }


    ?>


        <tr>
            <td class="bb" style="font-size:18px;"><?=trim($v['field'])?></td>
            <td class="bb" style="font-size:18px;"><?=trim($v['start']) ?>~<?=trim($v['end']) ?></td>
            <td class="bb" style="font-size:18px;">
            <?=trim($v['count_num']) ?>
            </td>
            <td class="bb" style="font-size:18px;"><?=trim($v['floor']) ?></td>
            <td class="bb" style="font-size:18px;"><?=trim($v['supervisor_1'])?></td>
            <td class="bb" style="font-size:18px;"><?=trim($v['supervisor_2'])?></td>
            <td class="bb" style="font-size:18px;"><?=trim($v['allocation_code'])?>&emsp;<?=trim($v['voucher'])?></td>
        </tr>
  
    <?php endforeach; ?>
    <tr>
        <td style="text-align:left;font-size:16px;">共計：<?=$trial_count*2+$p_count?>人</td>
    </tr>
</table>








<?php if(!empty($part1)){?>
<table class="" id="" style="padding: 15px 0px;text-align:center;">

<tr>
    <td width="100%" colspan="7" style="font-size:30px;text-align:center;"><?=$_SESSION['year']?>學年度英語聽力測驗<?=$_SESSION['ladder']?>考試新北一考區</td>
</tr>
<tr>
    <td width="100%" colspan="7" style="font-size:26px;text-align:center;"><?=$area?><?=$school['ladder']?>試場工作人員分配表 (<?=$date?>)(下午場)</td>
</tr>
<tr style="background:#FFE4E7">
    <th class="bb" style="font-size:20px;">試場</th>
    <th class="bb" style="font-size:20px;">考生起訖號碼</th>
    <th class="bb" style="font-size:20px;">人數</th>
    <th class="bb" style="font-size:20px;">樓層別</th>
    <th class="bb" style="font-size:20px;">監試人員</th>
    <th class="bb" style="font-size:20px;">監試人員</th>
    <th class="bb" style="font-size:20px;">試務人員</th>
</tr>
<?php }?>
<?php 
$data = array();
$p_count=0;

?>
<?php foreach ($part1 as $k => $v): ?>
<?php 
$p=trim($v['voucher']);


if(in_array($p,$data)){

} else {
    if(strlen($p)>0){
        array_push($data,$p);
        $p_count=$p_count+1;
    }
}


?>

    <tr>
        <td class="bb" style="font-size:18px;"><?=trim($v['field'])?></td>
        <td class="bb" style="font-size:18px;"><?=trim($v['start']) ?>~<?=trim($v['end']) ?></td>
        <td class="bb" style="font-size:18px;">
            <?=trim($v['count_num']) ?>
            </td>
        <td class="bb" style="font-size:18px;"><?=trim($v['floor']) ?></td>
        <td class="bb" style="font-size:18px;"><?=trim($v['supervisor_1'])?></td>
        <td class="bb" style="font-size:18px;"><?=trim($v['supervisor_2'])?></td>
        <td class="bb" style="font-size:18px;"><?=trim($v['allocation_code'])?>&emsp;<?=trim($v['voucher'])?></td>
    </tr>

<?php endforeach; ?>


<?php if(!empty($part1)){?>
<tr>
    <td style="text-align:left;font-size:16px;">共計：<?=$trial_count1*2+$p_count?>人</td>
</tr>
</table>
<?php }?>
