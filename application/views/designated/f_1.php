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
            url: 'api/add_act',
            data: {
                "year": $("#year").val(),
                "day_1": $("#day_1").val(),
                "day_2": $("#day_2").val(),
                "day_3": $("#day_3").val(),
                "pre_1": $("#pre_1").val(),
                "pre_2": $("#pre_2").val(),
                "pre_3": $("#pre_3").val(),
                "pre_4": $("#pre_4").val(),
                "course_1_start": $("#course_1_start").val(),
                "course_1_end": $("#course_1_end").val(),
                "course_2_start": $("#course_2_start").val(),
                "course_2_end": $("#course_2_end").val(),
                "course_3_start": $("#course_3_start").val(),
                "course_3_end": $("#course_3_end").val(),
                "course_4_start": $("#course_4_start").val(),
                "course_4_end": $("#course_4_end").val()
            },
            dataType: "json"
        }).done(function(data) {
            alert(data.sys_msg);
            if (data.sys_code == "200") {
                location.reload();
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
<form action="./designated/f_1_act" method="POST">
    <div class="row">

        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:20px;">
            <div class="row table-form" class="">
                <div class="col-3 text-right">第一天</div>
                <input type="hidden" class="col-6" id="year" name="year" value="<?= $_SESSION['year']; ?>">
                <input type="text" class="col-6" id="day_1" name="day_1" placeholder="<?= $placeholder['day_1']; ?>"
                    value="<?= $datetime_info['day_1']; ?>">
                <div class="col-3 "></div>
            </div>
            <div class="row table-form" class="">
                <div class="col-3 text-right">第二天</div>
                <input type="text" class="col-6" id="day_2" name="day_2" placeholder="<?= $placeholder['day_2']; ?>"
                    value="<?= $datetime_info['day_2']; ?>">
                <div class="col-3 "></div>
            </div>
            <div class="row table-form" class="">
                <div class="col-3 text-right">第三天</div>
                <input type="text" class="col-6" id="day_3" name="day_3" placeholder="<?= $placeholder['day_3']; ?>"
                    value="<?= $datetime_info['day_3']; ?>">
                <div class="col-3 "></div>
            </div>


        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:20px;">
            <div class="row table-form" class="">
                <div class="col-4 text-right">上午預備鈴1</div>
                <input type="text" class="col-7" id="pre_1" name="pre_1" placeholder="<?= $placeholder['pre_1']; ?>"
                    value="<?= $datetime_info['pre_1']; ?>">

            </div>
            <div class="row table-form" class="">
                <div class="col-4 text-right">上午預備鈴2</div>
                <input type="text" class="col-7" id="pre_2" name="pre_2" placeholder="<?= $placeholder['pre_2']; ?>"
                    value="<?= $datetime_info['pre_2']; ?>">

            </div>
            <hr>
            <div class="row table-form" class="">
                <div class="col-4 text-right">下午預備鈴1</div>
                <input type="text" class="col-7" id="pre_3" name="pre_3" placeholder="<?= $placeholder['pre_3']; ?>"
                    value="<?= $datetime_info['pre_3']; ?>">

            </div>
            <div class="row table-form" class="">
                <div class="col-4 text-right">下午預備鈴2</div>
                <input type="text" class="col-7" id="pre_4" name="pre_4" placeholder="<?= $placeholder['pre_4']; ?>"
                    value="<?= $datetime_info['pre_4']; ?>">
            </div>

            <hr>
            <div class="row table-form" class="">
                <div class="col-3 text-right">上午第一節</div>

                <div class="col-9">
                    <div class="row form-inline">
                        <input type="text" class="form-control col-6" id="course_1_start" name="course_1_start"
                            placeholder="<?= $placeholder['course_1_start']; ?>"
                            value="<?= $datetime_info['course_1_start']; ?>">
                        <input type="text" class="form-control col-6" id="course_1_end" name="course_1_end"
                            placeholder="<?= $placeholder['course_1_end']; ?>"
                            value="<?= $datetime_info['course_1_end']; ?>">
                    </div>
                </div>
            </div>

            <div class="row table-form" class="">
                <div class="col-3 text-right">上午第二節</div>

                <div class="col-9">
                    <div class="row form-inline">
                        <input type="text" class="form-control col-6" id="course_2_start" name="course_2_start"
                            placeholder="<?= $placeholder['course_2_start']; ?>"
                            value="<?= $datetime_info['course_2_start']; ?>">
                        <input type="text" class="form-control col-6" id="course_2_end" name="course_2_end"
                            placeholder="<?= $placeholder['course_2_end']; ?>"
                            value="<?= $datetime_info['course_2_end']; ?>">
                    </div>
                </div>
            </div>

            <div class="row table-form" class="">
                <div class="col-3 text-right">下午第一節</div>
                <div class="col-9">
                    <div class="row form-inline">
                        <input type="text" class="form-control col-6" id="course_3_start" name="course_3_start"
                            placeholder="<?= $placeholder['course_3_start']; ?>"
                            value="<?= $datetime_info['course_3_start']; ?>">
                        <input type="text" class="form-control col-6" id="course_3_end" name="course_3_end"
                            placeholder="<?= $placeholder['course_3_end']; ?>"
                            value="<?= $datetime_info['course_3_end']; ?>">
                    </div>
                </div>
            </div>
            <div class="row table-form" class="">
                <div class="col-3 text-right">下午第二節</div>
                <div class="col-9">
                    <div class="row form-inline">
                        <input type="text" class="form-control col-6" id="course_4_start" name="course_4_start"
                            placeholder="<?= $placeholder['course_4_start']; ?>"
                            value="<?= $datetime_info['course_4_start']; ?>">
                        <input type="text" class="form-control col-6" id="course_4_end" name="course_4_end"
                            placeholder="<?= $placeholder['course_4_end']; ?>"
                            value="<?= $datetime_info['course_4_end']; ?>">
                    </div>
                </div>
            </div>
        </div>



    </div>
    <div class="row text-right">
        <div class="col-12">
            <button type="button" class="btn btn-primary" id="save">儲存</button>
        </div>
    </div>
</form>