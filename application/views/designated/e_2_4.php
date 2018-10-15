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
        padding: 20px 0px;
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

<?php foreach ($part as $k => $v): ?>
                <table style="padding:10px 0px;text-align:center;">
                <thead>
                    <tr>
                        <td colspan="5" style="font-size:26px;"><?=$_SESSION['year']?>學年度指定科目考試新北一考區監試說明會簽到表</td>
                    </tr>
                    <tr>
                        <td colspan="5" style="font-size:22px;text-align:left;">單位：<?=$k?></td>
                    </tr>
                    <tr style="background:#FFE4E7">
                        <td style="border: 1px solid #999999;" width="15%">職務</td>
                        <td style="border: 1px solid #999999;" width="15%">姓名</td>
                        <td style="border: 1px solid #999999;" width="20%">單位別</td>
                        <td style="border: 1px solid #999999;">簽名</td>
                        <td style="border: 1px solid #999999;" width="15%">備註</td>
                    </tr>
                </thead>
                <?php foreach ($v as $kc => $vc): ?>
                <tr>
                    <td  style="border: 1px solid #999999;"><?=$vc['job']?></td>
                    <td  style="border: 1px solid #999999;"><?=$vc['member_name']?></td>
                    <td  style="border: 1px solid #999999;"><?=$vc['member_unit']?></td>
                    <td  style="border: 1px solid #999999;"></td>
                    <td  style="border: 1px solid #999999;"></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" style="font-size:16px;text-align:left;">共計：<?=count($v)?>人</td>
                </tr>

                </table>
<?php endforeach; ?>
