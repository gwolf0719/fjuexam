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
        padding: 10px 0px;
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

<?php foreach ($list as $k => $v): ?>
<table class="" id="" style="padding:5px 0px;;text-align:center;">
    <thead>
        <tr>
            <td colspan="6" style="font-size:30px;">各單位名稱一覽表</td>
        </tr>
        <tr>
            <td colspan="3" style="font-size:28px;text-align:left;padding:20px 0px">單位：<?=$k?></td>
            <td colspan="3" style="font-size:28px;text-align:right;padding:20px 0px">印表日期：<?=date('Y/m/d')?></td>
        </tr>
        <tr>
            <td colspan="1" style="border:1px solid #999;font-size:26px">序號</td>
            <td colspan="1" style="border:1px solid #999;font-size:26px">部別</td>
            <td colspan="2" style="border:1px solid #999;font-size:26px">代碼</td>
            <td colspan="2" style="border:1px solid #999;font-size:26px">單位名稱</td>
        </tr>
    </thead>
    <?php foreach ($v as $kc => $vc): ?>
    <tr>
        <td colspan="1" style="border:1px solid #999;font-size:26px"><?=($kc+1)?></td>
        <td colspan="1" style="border:1px solid #999;font-size:26px"><?=$vc['department']?></td>
        <td colspan="2" style="border:1px solid #999;font-size:26px"><?=$vc['code']?></td>
        <td colspan="2" style="border:1px solid #999;font-size:26px"><?=$vc['company_name_02']?></td>
    </tr>
    <?php endforeach;?>
</table>
<?php endforeach;?>
