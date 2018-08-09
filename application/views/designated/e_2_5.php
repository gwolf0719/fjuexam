<style>
    .bb {
        border: 1px solid #999999;
    }
</style>

<!-- <div>
    <h2 style="text-align:center">開會通知簽收表</h2>
</div>


<h3 style="text-align:left">分區：
    <?=$area?>
</h3>
<h3 style="text-align:left">考場：板橋高中</h3>
<h3 style="text-align:left">簽到日期：
    <?=date('20y-m-d')?>
</h3> -->


<table class="" id="" style="padding:4px 0px;text-align:center;">
    <thead>
        <tr>
            <td colspan="6" style="font-size:14px;">大學入學考試中心<?=$_SESSION['year']?>學年度定科目考試新北一考區監視說明會開會通知簽收表</td>
        </tr>             
        <tr style="background:#FFE4E7">
            <th class="bb">編號</th>
            <th class="bb" colsapn="2">職務</th>
            <th class="bb">姓名</th>
            <th class="bb">職稱</th>
            <th class="bb">單位別</th>
            <th class="bb">簽名</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($part as $k => $v): ?>
        <tr>
            <td class="bb">
                <?=$v['job_code']?>
            </td>
            <td class="bb" colsapn="2">
                <?=$v['job']?>
            </td>
            <td class="bb">
                <?=$v['name']; ?>
            </td>
            <td class="bb">
                <?=$v['job_title']; ?>
            </td>
            <td class="bb">
                <?=$v['member_unit']; ?>
            </td>
            <td class="bb"></td>
            <td class="bb"></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>