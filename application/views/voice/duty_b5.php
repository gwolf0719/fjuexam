<style>
    @media (min-width: 1200px) {
        .container {
            max-width: 1680px;
            width: 1680px;
        }
    }
    img {
        max-width: 100%;
    }
    .tab {
        width: 18%;
        float: left;
        text-align: center;
        background: #e2e2e2;
        height: 70px;
        padding-top: 14px;
        margin: 10px;
        cursor: pointer;
        border-radius: 10px 10px 0px 0px;
    }
    .tab.active {
        background: #c3e691;
    }
    .cube {
        display: none;
    }
    .W50 {
        width: 50%;
        float: left;
    }
    .tab_text {
        text-align: left;
        padding: 10px 0px;
        font-size: 21px;
    }
    .ball {
        color: #c3e691;
        background: #fff;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        padding: 5px 0px;
        font-size: 25px;
        margin: 0px 10%;
    }
    tr {
        cursor: pointer;
    }
</style>
<script>
    $(function() {
        $(".cube").eq(0).show();
        $("body").on("click", ".tab", function() {
            var $this = $(this);
            //點擊先做還原動作
            $(".tab").removeClass("active");
            $(".cube").hide();
            // 點擊到的追加active以及打開相對應table
            $this.addClass("active");
            var area = $this.attr("area");
            $("#b" + area).show()
        })
    })
</script>
<div class="row">
    <div class="input-group col-sm-2">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>"
            readonly>
            <input type="text" class="form-control"  value="<?=$this->session->userdata('ladder'); ?>" style="width:100px;" readonly>

    </div>

    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/b5_title.png" alt="" style="width: 20%;">
    </div>

</div>
<div class="row" style="position: relative;top: 20px;left: 10px;">
    <div style="width:95%;margin:0 auto">
        <div class="tab active" area="0">
            <div class="W50 ball">B</div>
            <div class="W50 tab_text">ALL</div>
        </div>
        <div class="tab" area="1">
            <div class="W50 ball">B1</div>
            <div class="W50 tab_text">考區</div>
        </div>
        <div class="tab" area="2">
            <div class="W50 ball">B2</div>
            <div class="W50 tab_text">第一分區</div>
        </div>
        <div class="tab" area="3">
            <div class="W50 ball">B3</div>
            <div class="W50 tab_text">第二分區</div>
        </div>
        <div class="tab" area="4">
            <div class="W50 ball">B4</div>
            <div class="W50 tab_text">第三分區</div>
        </div>
    </div>
</div>
<div class="row cube" id="b0">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>年度</th>
                    <th>考區</th>
                    <th>職務</th>
                    <th>職員代碼</th>
                    <th>職稱</th>
                    <th>姓名</th>
                    <th>執行日</th>
                    <th>聯絡電話</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>">
                    <td>
                        <?=$k + 1; ?>
                    </td>
                    <td>
                        <?=$v['year']; ?>
                    </td>
                    <td>
                        <?=$this->config->item('partition')[$v['test_partition']];?>
                    </td>
                    <td>
                        <?=$v['job']; ?>
                    </td>
                    <td>
                        <?=$v['job_code']; ?>
                    </td>
                    <td>
                        <?=$v['job_title']; ?>
                    </td>
                    <td>
                        <?=$v['name']; ?>
                    </td>
                    <td>
                        <?=$v['do_date']; ?>
                    </td>
                    <!-- <td><?=$v['trial_start']; ?></td>
                    <td>
                        <?=$v['trial_end']; ?>
                    </td> -->
                    <td>
                        <?=$v['phone']; ?>
                    </td>
                    <td>
                        <?=$v['note']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row cube" id="b1">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>年度</th>
                    <th>考區</th>
                    <th>職務</th>
                    <th>職員代碼</th>
                    <th>職稱</th>
                    <th>姓名</th>
                    <th>執行日</th>
                    <th>聯絡電話</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($b1 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>">
                    <td>
                        <?=$k + 1; ?>
                    </td>
                    <td>
                        <?=$v['year']; ?>
                    </td>
                    <td>
                         <?=$this->config->item('partition')[$v['test_partition']];?>
                    </td>
                    <td>
                        <?=$v['job']; ?>
                    </td>
                    <td>
                        <?=$v['job_code']; ?>
                    </td>
                    <td>
                        <?=$v['job_title']; ?>
                    </td>
                    <td>
                        <?=$v['name']; ?>
                    </td>
                    <td>
                        <?=$v['do_date']; ?>
                    </td>
                    <!-- <td><?=$v['trial_start']; ?></td>
                    <td>
                        <?=$v['trial_end']; ?>
                    </td> -->
                    <td>
                        <?=$v['phone']; ?>
                    </td>
                    <td>
                        <?=$v['note']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row cube" id="b2">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>年度</th>
                    <th>考區</th>
                    <th>職務</th>
                    <th>職員代碼</th>
                    <th>職稱</th>
                    <th>姓名</th>
                    <th>執行日</th>
                    <!-- <th>試場起號</th>
                    <th>試場迄號</th> -->
                    <th>聯絡電話</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($b2 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>">
                    <td>
                        <?=$k + 1; ?>
                    </td>
                    <td>
                        <?=$v['year']; ?>
                    </td>
                    <td>
                        <?=$this->config->item('partition')[$v['test_partition']];?>
                    </td>
                    <td>
                        <?=$v['job']; ?>
                    </td>
                    <td>
                        <?=$v['job_code']; ?>
                    </td>
                    <td>
                        <?=$v['job_title']; ?>
                    </td>
                    <td>
                        <?=$v['name']; ?>
                    </td>
                    <td>
                        <?=$v['do_date']; ?>
                    </td>
                    <!-- <td><?=$v['trial_start']; ?></td>
                    <td>
                        <?=$v['trial_end']; ?>
                    </td> -->
                    <td>
                        <?=$v['phone']; ?>
                    </td>
                    <td>
                        <?=$v['note']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row cube" id="b3">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>年度</th>
                    <th>考區</th>
                    <th>職務</th>
                    <th>職員代碼</th>
                    <th>職稱</th>
                    <th>姓名</th>
                    <th>執行日</th>
                    <!-- <th>試場起號</th>
                    <th>試場迄號</th> -->
                    <th>聯絡電話</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($b3 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>">
                    <td>
                        <?=$k + 1; ?>
                    </td>
                    <td>
                        <?=$v['year']; ?>
                    </td>
                    <td>
                        <?=$this->config->item('partition')[$v['test_partition']];?>
                    </td>
                    <td>
                        <?=$v['job']; ?>
                    </td>
                    <td>
                        <?=$v['job_code']; ?>
                    </td>
                    <td>
                        <?=$v['job_title']; ?>
                    </td>
                    <td>
                        <?=$v['name']; ?>
                    </td>
                    <td>
                        <?=$v['do_date']; ?>
                    </td>
                    <!-- <td><?=$v['trial_start']; ?></td>
                    <td>
                        <?=$v['trial_end']; ?>
                    </td> -->
                    <td>
                        <?=$v['phone']; ?>
                    </td>
                    <td>
                        <?=$v['note']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row cube" id="b4">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>年度</th>
                    <th>考區</th>
                    <th>職務</th>
                    <th>職員代碼</th>
                    <th>職稱</th>
                    <th>姓名</th>
                    <th>執行日</th>
                    <th>聯絡電話</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($b4 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>">
                    <td>
                        <?=$k + 1; ?>
                    </td>
                    <td>
                        <?=$v['year']; ?>
                    </td>
                    <td>
                        <?=$this->config->item('partition')[$v['test_partition']];?>
                    </td>
                    <td>
                        <?=$v['job']; ?>
                    </td>
                    <td>
                        <?=$v['job_code']; ?>
                    </td>
                    <td>
                        <?=$v['job_title']; ?>
                    </td>
                    <td>
                        <?=$v['name']; ?>
                    </td>
                    <td>
                        <?=$v['do_date']; ?>
                    </td>
                    <!-- <td><?=$v['trial_start']; ?></td>
                    <td>
                        <?=$v['trial_end']; ?>
                    </td> -->
                    <td>
                        <?=$v['phone']; ?>
                    </td>
                    <td>
                        <?=$v['note']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>