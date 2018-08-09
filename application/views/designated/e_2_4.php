<style>

    .bb {
        border: 1px solid #999999;
    }
</style>

<?php foreach ($part as $k => $v): ?>
<table class="" id="" style="padding:5px 0px;text-align:center;">

    <tr>
        <td colspan="5" style="font-size:14px;">大學入學考試中心<?=$_SESSION['year']?>學年度定科目考試新北一考區監視說明會開會通知簽收表</td>
    </tr>   
    <tr>
        <td colspan="6" style="font-size:13px;text-align:left;">單位：<?=$k?></td>
    </tr>        
    <tr style="background:#FFE4E7">
        <th class="bb">職務</th>
        <th class="bb">姓名</th>
        <th class="bb">單位別</th>
        <th class="bb">簽名</th>
        <th class="bb">備註</th>
    </tr>  
    <?php foreach ($v as $k => $vc): ?>
        <tr>
            <td class="bb">
                <?=$vc['job']?>
            </td>
            <td class="bb">
                <?=$vc['member_name']; ?>
            </td>
            <td class="bb">
                <?=$vc['member_unit']; ?>
            </td>
            <td class="bb"></td>
            <td class="bb"></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="5" style="font-size:13px;text-align:left;">共計：<?=count($v)?>人</td>
    </tr>             
</table>
<?php endforeach; ?>
