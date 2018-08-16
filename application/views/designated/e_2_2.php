<?php foreach ($part as $k => $v): ?>
<table class="" id="" style="padding:4px 0px;;text-align:center;">
    <thead>
        <tr>
            <td style="font-size:16px;" colspan="7">
                <?=$_SESSION['year']?>學年度指定科目考試新北一考區監試人員簽到表</td>
        </tr>
        <tr>
            <td colspan="2" style="font-size:14px;">分區：
                <?=$_GET['area']?>
            </td>
            <td colspan="3" style="font-size:14px;">
                <?=$school?>
            </td>
            <td colspan="2" style="font-size:14px;">簽到日期：
                <?=$k?>
            </td>
        </tr>
        <tr>
            <th style="border:1px solid #999" rowspan="2">試場</th>
            <th style="border:1px solid #999" colspan="2" class="bb">監試人員(1)</th>
            <th style="border:1px solid #999" rowspan="2">簽名</th>
            <th style="border:1px solid #999" colspan="2" class="bb">監試人員(2)</th>
            <th style="border:1px solid #999" rowspan="2">簽名</th>
        </tr>
        <tr>
            <td style="border:1px solid #999">姓名</td>
            <td style="border:1px solid #999">單位別</td>
            <td style="border:1px solid #999">姓名</td>
            <td style="border:1px solid #999">單位別</td>
        </tr>
        <?php foreach ($v as $kc => $vc): ?>
        <tr>
            <td style="border:1px solid #999">
                <?=$vc['field']?>
            </td>
            <td style="border:1px solid #999">
                <?=$vc['supervisor_1']?>
            </td>
            <td style="border:1px solid #999">
                <?=$vc['supervisor_1_unit']?>
            </td>
            <td style="border:1px solid #999"></td>
            <td style="border:1px solid #999">
                <?=$vc['supervisor_2']?>
            </td>
            <td style="border:1px solid #999">
                <?=$vc['supervisor_2_unit']?>
            </td>
            <td style="border:1px solid #999"></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="7" style="text-align:left;font-size:16px;">共計：<?=count($part)*2?>人、自備：<?=$own?>人、素食：<?=$veg?>人、葷食：<?=$meat?>人</td>
        </tr>
    </thead>
</table>
<?php endforeach;
