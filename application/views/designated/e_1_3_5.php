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
        font-size:14px;
    }
    th{
        padding: 15px 0px;
        font-size:14px;
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

<table class="" id="" style="padding:4px;text-align:center;">
    <thead>  
        <tr style="background:#FFE4E7">
            <th colspan="3" style="font-size:22px;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區</th>
        </tr>    
        <tr style="background:#FFE4E7">
            <th colspan="3" style="font-size:18px;"><?=$_GET['area']?><?=$school?>試務人員一覽表</th>
        </tr>      
        <tr style="background:#FFE4E7">
            <th colspan="1" style="text-align:left"  style="font-size:18px;"><?=$_GET['area']?>試務辦公室</th>
            <th colspan="1" style="text-align:center" style="font-size:18px;"><?=$addr_info['part_addr_1']?></th>
            <th colspan="1" style="text-align:right" style="font-size:18px;"></th>
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