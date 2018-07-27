<style>
    table {
        width: 780px;
        border: 1px solid #999999;
        margin: 30px auto;
    }

    td {
        border: 1px solid #999999;
    }

    th {
        border: 1px solid #999999;
        text-align: center;
    }
</style>

<div>
    <h2 style="text-align:center">
        <?=$_SESSION['year']?>學年度定科目考試新北一考區監試人員簽到表</h2>
</div>

<h3 style="text-align:left">分區：第一分區</h3>
<h3 style="text-align:left">考場：板橋高中</h3>
<h3 style="text-align:left">簽到日期：
    <?=date('20y-m-d')?>
</h3>

<table class="" id="" style="width:510px;padding:10px 4px 10px 4px;text-align:center;">
    <thead>
        <tr>
            <th>試場</th>
            <th colspan="2" class="bb">監試人員(1)</th>
            <th>簽名</th>
            <th colspan="2" class="bb">監試人員(2)</th>
            <th>簽名</th>
        </tr>
        <tr>
            <td></td>
            <td>姓名</td>
            <td>單位別</td>
            <td></td>
            <td>姓名</td>
            <td>單位別</td>
            <td></td>
        </tr>
    </thead>
    <?php foreach ($part1 as $k => $v): ?>
    <tr>
        <td>
            <?=$v['field']?>
        </td>
        <td>
            <?=$v['supervisor_1']?>
        </td>
        <td>
            <?=$v['supervisor_1_unit']?>
        </td>
        <td></td>
        <td>
            <?=$v['supervisor_2']?>
        </td>
        <td>
            <?=$v['supervisor_2_unit']?>
        </td>
        <td></td>
    </tr>
    <?php endforeach; ?>
</table>


<h3 style="text-align:left">分區：第二分區</h3>
<h3 style="text-align:left">考場：板橋高中</h3>
<h3 style="text-align:left">簽到日期：
    <?=date('20y-m-d')?>
</h3>

<table class="" id="" style="width:510px;padding:10px 4px 10px 4px;text-align:center;">
    <thead>
        <tr>
            <th>試場</th>
            <th colspan="2" class="bb">監試人員(1)</th>
            <th>簽名</th>
            <th colspan="2" class="bb">監試人員(2)</th>
            <th>簽名</th>
        </tr>
        <tr>
            <td></td>
            <td>姓名</td>
            <td>單位別</td>
            <td></td>
            <td>姓名</td>
            <td>單位別</td>
            <td></td>
        </tr>
    </thead>
    <?php foreach ($part2 as $k => $v): ?>
    <tr>
        <td>
            <?=$v['field']?>
        </td>
        <td>
            <?=$v['supervisor_1']?>
        </td>
        <td>
            <?=$v['supervisor_1_unit']?>
        </td>
        <td></td>
        <td>
            <?=$v['supervisor_2']?>
        </td>
        <td>
            <?=$v['supervisor_2_unit']?>
        </td>
        <td></td>
    </tr>
    <?php endforeach; ?>
</table>


<h3 style="text-align:left">分區：第三分區</h3>
<h3 style="text-align:left">考場：板橋高中</h3>
<h3 style="text-align:left">簽到日期：
    <?=date('20y-m-d')?>
</h3>

<table class="" id="" style="width:510px;padding:10px 4px 10px 4px;text-align:center;">
    <thead>
        <tr>
            <th>試場</th>
            <th colspan="2" class="bb">監試人員(1)</th>
            <th>簽名</th>
            <th colspan="2" class="bb">監試人員(2)</th>
            <th>簽名</th>
        </tr>
        <tr>
            <td></td>
            <td>姓名</td>
            <td>單位別</td>
            <td></td>
            <td>姓名</td>
            <td>單位別</td>
            <td></td>
        </tr>
    </thead>
    <?php foreach ($part3 as $k => $v): ?>
    <tr>
        <td>
            <?=$v['field']?>
        </td>
        <td>
            <?=$v['supervisor_1']?>
        </td>
        <td>
            <?=$v['supervisor_1_unit']?>
        </td>
        <td></td>
        <td>
            <?=$v['supervisor_2']?>
        </td>
        <td>
            <?=$v['supervisor_2_unit']?>
        </td>
        <td></td>
    </tr>
    <?php endforeach; ?>
</table>