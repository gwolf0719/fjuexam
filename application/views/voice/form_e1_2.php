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
            <td colspan="13" style="font-size:26px;">請公假名單</td>
        </tr>
        <tr>
            <td colspan="13" style="text-align:right;font-size:22px;">印表日期：<?=(date("Y") - 1911).date("/m/d")?></td>
        </tr>
        <tr style="background:#FFE4E7">
            <th class="bb" colspan="1">序號</th>
            <th class="bb" colspan="2">職員代碼</th>
            <th class="bb" colspan="2">姓名</th>
            <th class="bb" colspan="3">單位</th>
            <th class="bb" colspan="2">職稱</th>
            <th class="bb" colspan="3">執勤日期</th>
        </tr>
    </thead>
    <?php  $i=0?>
        <?php foreach ($list as $k => $v): ?>
        <tr>
            <td class="bb" colspan="1">
                <?=$i + 1?>
            </td>
            <td class="bb" colspan="2">
                <?=$v['job_code']?>
            </td>
            <td class="bb" colspan="2">
                <?=$v['name']; ?>
            </td>
            <td class="bb" colspan="3">
                <?=$v['member_unit']; ?>
            </td>
            <td class="bb" colspan="2">
                <?=$v['job_title']; ?>
            </td>
            <td class="bb" colspan="3">
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
