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
        <?=$_SESSION['year']?>學年度定科目考試新北一考區</h2>
    <h2>
        分區：
        <?=$area?>
    </h2>
</div>

<table class="" id="" style="width:510px;padding:10px 4px 10px 4px;text-align:center;">
    <thead>
        <tr style="background:#FFE4E7">
            <th>試場</th>
            <th>考試節數</th>
            <th>考生起訖號碼</th>
            <th>人數</th>
            <th>樓層別</th>
            <th>監試人員</th>
            <th>監試人員</th>
            <th>試務人員</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($part as $k => $v): ?>
        <tr>
            <td>
                <?=$v['field']?>
            </td>
            <td>
                <?=$v['test_section']; ?>
            </td>
            <td>
                <?=$v['start']; ?>
                <br>~
                <br>
                <?=$v['end']; ?>
            </td>
            <td>
                <?=$v['number']; ?>
            </td>
            <td>
                <?=$v['floor']; ?>
            </td>
            <td>
                <?=$v['supervisor_1']?>
            </td>
            <td>
                <?=$v['supervisor_2']?>
            </td>
            <td>
                <?=$v['patrol']?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table class="" id="" style="width:510px;padding:10px 4px 10px 4px;text-align:center;">
    <thead>
        <tr style="background:#FFE4E7">
            <th>試場</th>
            <th>考試節數</th>
            <th>考生起訖號碼</th>
            <th>人數</th>
            <th>樓層別</th>
            <th>監試人員</th>
            <th>監試人員</th>
            <th>試務人員</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($part2 as $k => $v): ?>
        <tr>
            <td>
                <?=$v['field']?>
            </td>
            <td>
                <?=$v['test_section']; ?>
            </td>
            <td>
                <?=$v['start']; ?>~
                <?=$v['end']; ?>
            </td>
            <td>
                <?=$v['number']; ?>
            </td>
            <td>
                <?=$v['floor']; ?>
            </td>
            <td>
                <?=$v['supervisor_1']?>
            </td>
            <td>
                <?=$v['supervisor_2']?>
            </td>
            <td>
                <?=$v['patrol']?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table class="" id="" style="width:510px;padding:10px 4px 10px 4px;text-align:center;">
    <thead>
        <tr style="background:#FFE4E7">
            <th>試場</th>
            <th>考試節數</th>
            <th>考生起訖號碼</th>
            <th>人數</th>
            <th>樓層別</th>
            <th>監試人員</th>
            <th>監試人員</th>
            <th>試務人員</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($part3 as $k => $v): ?>
        <tr>
            <td>
                <?=$v['field']?>
            </td>
            <td>
                <?=$v['test_section']; ?>
            </td>
            <td>
                <?=$v['start']; ?>~
                <?=$v['end']; ?>
            </td>
            <td>
                <?=$v['number']; ?>
            </td>
            <td>
                <?=$v['floor']; ?>
            </td>
            <td>
                <?=$v['supervisor_1']?>
            </td>
            <td>
                <?=$v['supervisor_2']?>
            </td>
            <td>
                <?=$v['patrol']?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>