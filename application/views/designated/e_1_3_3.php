<style>

    .bb {
        border: 1px solid #999999;
    }

</style>

<table class="" id="" style="padding:4px;text-align:center;">
    <thead>  
        <tr style="background:#FFE4E7">
            <th colspan="3" style="font-size:18px;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區</th>
        </tr>    
        <tr style="background:#FFE4E7">
            <th colspan="3" style="font-size:16px;"><?=$_GET['area']?><?=$school?>試務人員一覽表</th>
        </tr>      
        <tr style="background:#FFE4E7">
            <th colspan="1" style="text-align:left"  style="font-size:12px;"><?=$_GET['area']?>試務辦公室</th>
            <th colspan="1" style="text-align:center" style="font-size:12px;"><?=$addr_info['part_addr_1']?></th>
            <th colspan="1" style="text-align:right" style="font-size:12px;"></th>
        </tr>                            
        <tr style="background:#FFE4E7">
            <td class="bb">職別</td>
            <td class="bb">姓名</td>
            <td class="bb" colspan="2" >備註(工作分配)</td>
        </tr>
    </thead>
        <?php foreach ($part as $k => $v): ?>
        <tr>
            <td class="bb">
                <?=$v['job']?>
            </td>
            <td class="bb">
                <?=$v['name']; ?>
            </td>
            <td class="bb">
            </td>
        </tr>
        <?php endforeach; ?>
</table>