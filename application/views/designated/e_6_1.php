<style>
    table {
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
        <?=$_SESSION['year']?>學年度定科目考試新北一考區</h2>
</div>

<h3 style="text-align:center;">監試人員印領清冊</h3>

<h3>
    分區：
    <?=$area?>
</h3>

<table class="" id="" style="padding:4px;text-align:center;">
    <thead>
        <tr>
            <th rowspan="2">試場</th>
            <th colspan="4" class="bb">監試人員(1)</th>
            <th rowspan="2">簽名或蓋章</th>
            <th colspan="3" class="bb">監試人員(2)</th>
            <th rowspan="2">簽名或蓋章</th>
        </tr>
        <tr>
            <td>監考費</td>
            <td>姓名</td>
            <td>餐費</td>
            <td>應領費用</td>
            <td>姓名</td>
            <td>餐費</td>
            <td>應領費用</td>
        </tr>
    </thead>
    <?php foreach ($part as $k => $v): ?>
    <tr>
        <td>
            <?=$v['field']?>
        </td>
        <td>
            <?=$v['first_member_salary_section']?>
        </td>
        <td>
            <?=$v['supervisor_1']?>
        </td>
        <td>
            <?php
            if ($v['order_meal1'] == "N") {
                echo 0;
            } else {
                echo abs($v['first_member_section_lunch_total']);
            }
            ?>
        </td>
        <td>
            <?php
            if ($v['order_meal1'] == "N") {
                echo $v['first_member_section_salary_total'] - 0;
            } else {
                echo $v['first_member_section_salary_total'] - abs($v['first_member_section_lunch_total']);
            }
            ?>
        </td>
        <td></td>
        <td>
            <?=$v['supervisor_2']?>
        </td>
        <td>
            <?php
            if ($v['order_meal2'] == "N") {
                echo 0;
            } else {
                echo abs($v['second_member_section_lunch_total']);
            }
            ?>
        </td>
        <td>
            <?php
            if ($v['order_meal2'] == "N") {
                echo $v['second_member_section_salary_total'] - 0;
            } else {
                echo $v['second_member_section_salary_total'] - abs($v['second_member_section_lunch_total']);
            }
            ?>
        </td>
        <td></td>
    </tr>
    <?php endforeach; ?>
</table>