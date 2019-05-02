<style>
.table-form {
    width: 80%;
    background: #ddd;
    text-align: center;
    padding: 10px;
    margin: 0 auto;
}

.input {
    text-align: left;
    margin-left: 0px;
    padding-left: 0px;
}
</style>
<script>
$(function() {
    $("body").on("click", "#save", function() {
        $.ajax({
            url: './subject_ability/api/add_act',
            data: {
                "year": '<?= $this->session->userdata("year") ?>',
                "day_1": $("#day_1").val(),
                "day_2": $("#day_2").val(),
                "day_3": $("#day_3").val(),
                <?php for ($i = 1; $i <= 3; $i++) : ?> "pre_1_<?= $i ?>": $("#pre_1_<?= $i ?>")
                    .val(),
                "pre_2_<?= $i ?>": $("#pre_2_<?= $i ?>").val(),
                "pre_3_<?= $i ?>": $("#pre_3_<?= $i ?>").val(),
                "pre_4_<?= $i ?>": $("#pre_4_<?= $i ?>").val(),
                "course_1_start_<?= $i ?>": $("#course_1_start_<?= $i ?>").val(),
                "course_1_end_<?= $i ?>": $("#course_1_end_<?= $i ?>").val(),
                "course_2_start_<?= $i ?>": $("#course_2_start_<?= $i ?>").val(),
                "course_2_end_<?= $i ?>": $("#course_2_end_<?= $i ?>").val(),
                "course_3_start_<?= $i ?>": $("#course_3_start_<?= $i ?>").val(),
                "course_3_end_<?= $i ?>": $("#course_3_end_<?= $i ?>").val(),
                "course_4_start_<?= $i ?>": $("#course_4_start_<?= $i ?>").val(),
                "course_4_end_<?= $i ?>": $("#course_4_end_<?= $i ?>").val(),
                <?php endfor; ?>
            },
            dataType: "json"
        }).done(function(data) {
            alert(data.sys_msg);
            if (data.sys_code == "200") {
                // location.reload();
            }
        })
    })

})
</script>
<div class="row">
    <div class="input-group col-sm-2">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"
            value="<?= $this->session->userdata('year'); ?>" readonly>

    </div>

    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/f1_title.png" alt="" style="width: 20%;">
    </div>

</div>

<form action="./subject_ability/f_1_act" method="POST">
    <div class="row">
        <?php for ($i = 1; $i <= 3; $i++) : ?>
        <!-- 第一天開始 -->
        <div class="col-xs-4" style="padding:20px;">
            <div class="row table-form" class="">
                <div class="col-4 text-right">第 <?= $i ?> 天</div>
                <input type="text" class="col-7" id="day_<?= $i ?>" name="day_<?= $i ?>"
                    value="<?= $datetime_info['day_' . $i]; ?>">

            </div>
            <div class="row table-form" class="">
                <div class="col-4 text-right">上午預備鈴1</div>
                <input type="text" class="col-7" id="pre_1_<?= $i ?>" name="pre_1"
                    value="<?= $datetime_info['pre_1_' . $i]; ?>">

            </div>
            <div class="row table-form" class="">
                <div class="col-4 text-right">上午預備鈴2</div>
                <input type="text" class="col-7" id="pre_2_<?= $i ?>" name="pre_2"
                    value="<?= $datetime_info['pre_2_' . $i]; ?>">

            </div>
            <hr>
            <div class="row table-form" class="">
                <div class="col-4 text-right">下午預備鈴1</div>
                <input type="text" class="col-7" id="pre_3_<?= $i ?>" name="pre_3"
                    value="<?= $datetime_info['pre_3_' . $i]; ?>">

            </div>
            <div class="row table-form" class="">
                <div class="col-4 text-right">下午預備鈴2</div>
                <input type="text" class="col-7" id="pre_4_<?= $i ?>" name="pre_4"
                    value="<?= $datetime_info['pre_4_' . $i]; ?>">
            </div>

            <hr>
            <div class="row table-form" class="">
                <div class="col-4 text-right">上午第一節</div>

                <div class="col-8">
                    <div class="row form-inline">
                        <input type="text" class="form-control col-6" id="course_1_start_<?= $i ?>"
                            name="course_1_start" value="<?= $datetime_info['course_1_start_' . $i]; ?>">
                        <input type="text" class="form-control col-6" id="course_1_end_<?= $i ?>" name="course_1_end"
                            value="<?= $datetime_info['course_1_end_' . $i]; ?>">
                    </div>
                </div>
            </div>

            <div class="row table-form" class="">
                <div class="col-4 text-right">上午第二節</div>

                <div class="col-8">
                    <div class="row form-inline">
                        <input type="text" class="form-control col-6" id="course_2_start_<?= $i ?>"
                            name="course_2_start" value="<?= $datetime_info['course_2_start_' . $i]; ?>">
                        <input type="text" class="form-control col-6" id="course_2_end_<?= $i ?>" name="course_2_end"
                            value="<?= $datetime_info['course_2_end_' . $i]; ?>">
                    </div>
                </div>
            </div>

            <div class="row table-form" class="">
                <div class="col-4 text-right">下午第一節</div>
                <div class="col-8">
                    <div class="row form-inline">
                        <input type="text" class="form-control col-6" id="course_3_start_<?= $i ?>"
                            name="course_3_start" value="<?= $datetime_info['course_3_start_' . $i]; ?>">
                        <input type="text" class="form-control col-6" id="course_3_end_<?= $i ?>" name="course_3_end"
                            value="<?= $datetime_info['course_3_end_' . $i]; ?>">
                    </div>
                </div>
            </div>
            <div class="row table-form" class="">
                <div class="col-4 text-right">下午第二節</div>
                <div class="col-8">
                    <div class="row form-inline">
                        <input type="text" class="form-control col-6" id="course_4_start_<?= $i ?>"
                            name="course_4_start" value="<?= $datetime_info['course_4_start_' . $i]; ?>">
                        <input type="text" class="form-control col-6" id="course_4_end_<?= $i ?>" name="course_4_end"
                            value="<?= $datetime_info['course_4_end_' . $i]; ?>">
                    </div>
                </div>
            </div>
        </div>
        <!-- 第一天結束 -->
        <?php endfor; ?>







    </div>
    <div class="row text-right">
        <div class="col-12">
            <button type="button" class="btn btn-primary" id="save">儲存</button>
        </div>
    </div>
</form>