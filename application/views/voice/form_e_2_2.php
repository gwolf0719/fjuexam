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
        padding: 8px 0px;
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

<table class="" id="" style="padding:5px 0px;;text-align:center;">
    <thead>
        <tr>
            <td style="font-size:40px;lne-height:50px;" colspan="9"><?=$_SESSION['year']?>學年度英語聽力測驗<?=$_SESSION['ladder']?>考試</td>
            </tr>
            <tr>
            <td style="font-size:30px;lne-height:50px;" colspan="9">新北一考區監試人員簽到表</td>
        </tr>
        <tr>
            <td colspan="9" >
                <div style="display: table;width:100%;border-collapse: collapse;">
                    <div style="font-size:22px;display: table-row; " class="row">
                        <div style="text-align:left;display: table-cell;">分區：<?=$area?></div>
                        <div style="text-align:center;display: table-cell;"><?=$school['area_name']?></div>
                        <div style="text-align:right;display: table-cell;">簽到日期：<?=$datetime_info['day']?></div>
                    </div>
                </div>
                
            </td>
        </tr>
        <tr>
            <td style="border:1px solid #999" rowspan="2" width="10%">試場</td>
            <td style="border:1px solid #999" colspan="2" width="10%" class="bb">監試人員(1)</td>
            <td style="border:1px solid #999" rowspan="2" width="20%" colspan="2">簽名</td>
            <td style="border:1px solid #999" colspan="2" width="10%" class="bb">監試人員(2)</td>
            <td style="border:1px solid #999" rowspan="2" width="20%" colspan="2">簽名</td>
        </tr>

        <tr>
            <td style="border:1px solid #999" width="11%">姓名</td>
            <td style="border:1px solid #999" width="10%">單位別</td>
            <td style="border:1px solid #999" width="10%">姓名</td>
            <td style="border:1px solid #999" width="10%">單位別</td>
        </tr>
    </thead>
    <?php foreach ($part as $kc => $vc): ?>
    <tr style="height:60px;">
        <td style="border:1px solid #999;font-size:18px;" nowrap="nowrap"><?=$vc['field']?></td>
        <td style="border:1px solid #999;font-size:18px;" nowrap="nowrap"><?=$vc['supervisor_1']?></td>
        <td style="border:1px solid #999;font-size:18px;" nowrap="nowrap"><?=$vc['supervisor_1_unit']?></td>
        <td style="border:1px solid #999;font-size:18px;" colspan="2" nowrap="nowrap"></td>
        <td style="border:1px solid #999;font-size:18px;" nowrap="nowrap"><?=$vc['supervisor_2']?></td>
        <td style="border:1px solid #999;font-size:18px;" nowrap="nowrap"><?=$vc['supervisor_2_unit']?></td>
        <td style="border:1px solid #999;font-size:18px;" colspan="2"></td>
    </tr>
    <?php endforeach;?>
    <tr>
        <td colspan="9" style="font-size:16px;text-align:left;">共計：<?=($count*2)?>人</td>
    </tr>
</table>

