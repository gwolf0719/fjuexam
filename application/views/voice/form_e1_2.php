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
            <td colspan="13" style="font-size:30px;">請公假名單</td>
        </tr>
        <tr>
            <td colspan="13" style="text-align:right;font-size:28px;">印表日期：<?=(date("Y") - 1911).date("/m/d")?></td>
        </tr>
        <tr style="background:#FFE4E7">
            <th class="bb" colspan="1" style="font-size:28px;">序號</th>
            <th class="bb" colspan="2" style="font-size:28px;">職員代碼</th>
            <th class="bb" colspan="2" style="font-size:28px;">姓名</th>
            <th class="bb" colspan="3" style="font-size:28px;">單位</th>
            <th class="bb" colspan="2" style="font-size:28px;">職稱</th>
            <th class="bb" colspan="3" style="font-size:28px;">執勤日期</th>
        </tr>
    </thead>
    <?php  $i=0?>
        <?php foreach ($list as $k => $v): ?>
        <tr>
            <td class="bb" colspan="1" style="font-size:22px;"><?=$i + 1?></td>
            <td class="bb" colspan="2" style="font-size:22px;"><?=$v['job_code']?></td>
            <td class="bb" colspan="2" style="font-size:22px;"><?=$v['name']; ?></td>
            <td class="bb" colspan="3" style="font-size:22px;"><?=$v['member_unit']; ?></td>
            <td class="bb" colspan="2" style="font-size:22px;"><?=$v['job_title']; ?></td>
            <td class="bb" colspan="3" style="font-size:22px;">
                <?php 
                $date= explode(",",$v['do_date']);
                echo $date[0];
                ?>
                
            </td>
        </tr>
        <?php $i=$i + 1;?>
        <?php endforeach; ?>
        <tr>
            <td colspan="13" style="font-size:16px;text-align:left;">共計：<?=count($list)?>人</td>
        </tr>
</table>
