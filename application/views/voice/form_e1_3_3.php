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
            <td colspan="9" style="position: relative;font-size:30px;"><?=$_SESSION['year']?>學年度英語聽力測驗<?=$_SESSION['ladder']?>考試新北一考區</td>
        </tr>
        <tr>
            <td colspan="3" style="position: relative;font-size:26px;left: 25%;"><?=$school['area_name']?>試務人員一覽表</td>
        </tr>
        <tr>
            <td colspan="1"  style="font-size:22px;text-align:left"><?=$this->config->item('partition')[$_GET['area']] ?></td>
            <td colspan="1"  style="font-size:22px;text-align:center"></th>
            <td colspan="1"  style="font-size:22px;text-align:right"></td>
        </tr>
        <tr>
            <td class="bb" style="width: 6%;font-size:21px;">職別</td>
            <td class="bb" style="width: 4%;font-size:21px;">姓名</td>
            <td class="bb" style="width: 7%;font-size:21px;">單位別&連絡電話</td>
            <!-- <td class="bb" style="width: 7%;font-size:21px;">單位二</td> -->
            <td class="bb" style="width: 6%;font-size:21px;">職稱</td>
            <td class="bb" style="width: 4%;font-size:21px;">姓名</td>
            <td class="bb" style="width: 7%;font-size:21px;">單位別&連絡電話</td>
            <!-- <td class="bb" colspan="2" >備註(工作分配)</td> -->
        </tr>
    </thead>
        <?php foreach ($part as $k => $v): ?>
        <tr>
            <td class="bb" style="text-align: left;padding-left:10px;font-size:21px; ">
                <?=$v['job']?>
            </td>
            <td class="bb" style="font-size:21px;">
                <?=$v['name']; ?>
            </td>
            <td class="bb" style="text-align: left;padding-left:10px;font-size:21px; ">
                <?=$v['member_unit']; ?></br>
                <?=$v['member_phone']; ?>
            </td>
            <!-- <td class="bb" style="font-size:21px;">
            <?=$v['member_unit']; ?>
            </td> -->
            <td class="bb" style="font-size:21px;">
            <?=$v['job_title']; ?>
            </td>
            <td class="bb" style="font-size:21px;">
            <?=$v['note']; ?>
            </td>
            <td class="bb" style="font-size:21px;">
            <?=$v['note']; ?>
            </td>
            <!-- <td class="bb">
            <?=$v['note']; ?>
            </td> -->
        </tr>
        <?php endforeach; ?>
</table>
