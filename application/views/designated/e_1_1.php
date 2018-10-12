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
        font-size:14px;
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
            <td colspan="6" style="font-size:22px;">各單位名稱一覽表</td>
        </tr>             
        <tr>
            <td colspan="3" style="font-size:18px;text-align:left;">單位：<?=$k?></td>
            <td colspan="3" style="font-size:18px;text-align:right;">印表日期：<?=date('Y/m/d')?></td>
        </tr>
        <tr>
            <td colspan="1" style="border:1px solid #999">序號</td>
            <td colspan="1" style="border:1px solid #999">部別</td>
            <td colspan="2" style="border:1px solid #999">代碼</td>
            <td colspan="2" style="border:1px solid #999">單位名稱</td>
        </tr>          
    </thead>
    <?php foreach ($v as $kc => $vc): ?>
    <tr>
        <td colspan="1" style="border:1px solid #999"><?=($kc+1)?></td>
        <td colspan="1" style="border:1px solid #999"><?=$vc['department']?></td>
        <td colspan="2" style="border:1px solid #999"><?=$vc['code']?></td>
        <td colspan="2" style="border:1px solid #999"><?=$vc['company_name_02']?></td>
    </tr>
    <?php endforeach;?>
</table>
<?php endforeach;?>