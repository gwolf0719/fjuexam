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

<table class="" id="" style="padding:4px;text-align:center;">
    <thead>
        <tr>
            <td colspan="3" style="font-size:26px;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區</td>
        </tr>
        <tr>
            <td colspan="3" style="font-size:22px;"><?=$_GET['area']?><?=$school?>試務人員一覽表</td>
        </tr>
        <tr>
            <td colspan="1"  style="font-size:22px;text-align:left"><?=$_GET['area']?>試務辦公室</td>
            <td colspan="1"  style="font-size:22px;text-align:center"></th>
            <td colspan="1"  style="font-size:22px;text-align:right"><?=$addr_info['part_addr_1']?></td>
        </tr>
        <tr>
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
