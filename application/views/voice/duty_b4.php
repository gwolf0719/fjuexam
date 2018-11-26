<style>
    @media (min-width: 1200px) {
        .container {
            max-width: 1680px;
            width: 1680px;
        }
    }

    .typeahead {
        z-index: 1051;
        margin-left: 10px;
    }

    img {
        max-width: 100%;
    }

    .boxs {
        border-top: 1px solid;
        background: #f2f2f2;
        padding: 0px 0px 20px;
    }

    .table {
        height: auto;
        overflow: auto;
    }

    .cube {
        background: #e2eed3;
        margin: 0px 10px;
        width: 23%;
        padding: 20px;
        border-radius: 10px;
        float: left;
        height: 266px;
    }

    label {
        display: inline-block;
        line-height: 40px;
        text-align: center;
        width: 30%;
    }

    .form-control {
        display: block;
        width: 50%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-boxs;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, boxs-shadow .15s ease-in-out;
    }

    .form-group {
        margin-bottom: 1rem;
        padding-right: 10%;
        float: left;
        width: 100%;
    }

    .bottom {
        bottom: 0px;
        width: 100%;
    }

    .chbox {
        vertical-align: sub;
    }

    .W50 {
        width: 50%;
        float: left;
    }

    tr {
        cursor: pointer;
    }
</style>

<script>
    $(function() {
        /**自動完成 */
        var data;
        $.getJSON("./voice/api/get_member_info", function(data) {
            data = data.info;
            console.log(data);
            var $input = $(".typeahead");
            $input.typeahead({
                source: data,
                autoSelect: true,
            });
        })


        // $("body").on("click", "#Upload", function() {
        //     if (confirm("注意！舊資料會全部刪除，新資料將匯入")) {
        //         $("#form").submit();
        //     }
        // })

        $("body").on("click", "tr", function() {
            var sn = $(this).attr("sn");
            $("#job_code").attr("readonly", true);
            $('input:checkbox[name="day"]').eq(0).prop("checked", false);
            $('input:checkbox[name="day"]').eq(1).prop("checked", false);
            $('input:checkbox[name="day"]').eq(2).prop("checked", false);
            $("html, body").animate({
                scrollTop: $("body").height()
            }, 1000);

            $.ajax({
                url: './voice/api/get_once_task',
                data: {
                    "sn": sn,
                },
                dataType: "json"
            }).done(function(data) {

                if (data.info.do_date == "") {
                    $('input:checkbox[name="day"]').eq(0).prop("checked", true);
                } else {
                    var chk = data.info.do_date.split(",")
                    var lenght = data.info.do_date.split(",").length;
                    $('input:checkbox[name="day"]').each(function() {
                        for (let index = 0; index < lenght; index++) {
                            if (chk[index] == $(this).val()) {
                                $(this).prop("checked", true);

                            }
                        }
                    })
                }
                var day_arr = $('input:checkbox:checked[name="day"]').map(function() {
                    return $(this).val();
                }).get().length;
                console.log(day_arr);
                $("#assign").show();
                $("#job").attr("readonly", false);
                $("#job_code").attr("readonly", false);
                $("#job_title").attr("readonly", false);
                $("#name").attr("readonly", false);
                $("#phone").attr("readonly", false);
                $("#sn").val(sn);
                $("#job").val(data.info.job)
                $("#job_code").val(data.info.job_code)
                $("#job_title").val(data.info.job_title)
                $("#name").val(data.info.name)
                $("#start_date").val(data.info.start_date)
                $("#number").val(data.info.number)
                $("#section").val(data.info.section)
                $("#price").val(data.info.price)
                $("#phone").val(data.info.phone)
                $("#note").val(data.info.note)

                if (data.info.day_count != "") {
                    $("#day_count").val(data.info.day_count);
                } else {
                    $("#day_count").val(day_arr);
                }

                if (data.info.salary_total != "") {
                    $("#salary_total").val(data.info.salary_total);
                } else {
                    var one_day_salary = $("#one_day_salary").val() * day_arr;
                    $("#salary_total").val(one_day_salary);
                }
                if (data.info.one_day_salary != "") {
                    $("#one_day_salary").val(data.info.one_day_salary);
                } else {
                    $("#one_day_salary").val( <?=$fees_info['pay_1']; ?> )
                }

                if (data.info.total != "") {
                    $("#total").val(data.info.salary_total);
                } else {
                    $("#total").val("0");
                }

            })
        })

        $("body").on("click", "#add_info", function() {
            $(this).hide();
            $("#send").hide();
            $("#remove").hide();
            $("#add").show();
            $("#no").show();
        })

        $("body").on("click", "#no", function() {
            $(this).hide();
            $("#add").hide();
            $("#add_info").show();
            $("#send").show();
            $("#remove").show();
        })

        $("body").on("change","#job",function(){
            $("#job_title").val($(this).val());
            $("#member_job_title").val($(this).val());
        })

        
        $("body").on("click", "#send", function() {
            if (confirm("確定儲存修改資料？")) {
                var sn = $("#sn").val();
                var area = "第三分區";
                var job = $("#member_job_title").val();
                var job_code = $("#job_code").val();
                var job_title = $("#job_title").val();
                var name = $("#name").val();
                var phone = $("#phone").val();
                var note = $("textarea[name='note']").val();
                var cla = "第三分區";
                var arr = $('input:checkbox:checked[name="day"]').map(function() {
                    return $(this).val();
                }).get();
                var do_date = $('#do_date').val();
                var day_count = $("#day_count").val();
                var one_day_salary = $("#one_day_salary").val();
                var salary_total = $("#salary_total").val();
                var total = $("#total").val();
                $.ajax({
                    url: './voice/api/voice_edit_task',
                    data: {
                        "sn": sn,
                        "area": area,
                        "job_code": job_code,
                        "job_title": job_title,
                        "job": job,
                        "name": name,
                        "phone": phone,
                        "note": note,
                        "class": cla,
                        "do_date": do_date,
                        "day_count": day_count,
                        "one_day_salary": one_day_salary,
                        "salary_total": salary_total,
                        "total": total,
                    },
                    dataType: "json"
                }).done(function(data) {
                    alert(data.sys_msg);
                    if (data.sys_code == "200") {
                        location.reload();
                    }
                })
            }
        })
        $("body").on("click", "#sure", function() {
            var code = $(".typeahead").val().split("-");
            $.post("./voice/api/assignment", {
                job_code: code[0],
                job: $("#search_job").text(),
                area: "第三分區",
            }, function(data) {
                alert(data.sys_msg);
              
                if (data.sys_code == "200") {
                    $('#exampleModal').modal('hide');
                    $("#member_job_title").val($("#search_job").text());
                    $("#job_code").val(data.info.member_code);
                    $("#job_title").val(data.info.member_title);
                    $("#name").val(data.info.member_name);
                    $("#phone").val(data.info.member_phone);
                }
            }, "json")
        })

        $("body").on("click", "#remove", function() {
            console.log($("#sn").val());
            if (confirm("是否確定要刪除？")) {
                var sn = $("#sn").val();
                $.ajax({
                    url: './voice/api/remove_once_task',
                    data: {
                        "sn": sn,
                    },
                    dataType: "json"
                }).done(function(data) {
                    // alert(data.sys_msg);
                    if (data.sys_code == "200") {
                        alert(data.sys_msg);
                        location.reload();
                    }
                })
            }
        })


        /**
        新增職務
         */
        $("body").on("click", "#new_job", function() {
            var job = prompt("請輸入職務名稱");

            if (job == null) {
                alert("動作取消");
            } else {
                if (job == "") {
                    alert("需要輸入內容");
                } else {
                    $.getJSON("./voice/api/job_add_b4", {
                        job: job,
                        area: "第三分區"
                    }, function(data) {
                        alert(data.sys_msg);
                        location.reload();
                    })
                }
            }
        })

        /**
        取消職務
         */
        $("body").on("click", "#cancel_job", function() {
            if (confirm("是否要取消職務？")) {
                var sn = $("#sn").val();
                $.ajax({
                    url: './voice/api/cancel_job',
                    data: {
                        "sn": sn,
                    },
                    dataType: "json"
                }).done(function(data) {
                    alert(data.sys_msg);
                    if (data.sys_code == "200") {
                        location.reload();
                    }
                })
            }
        })

        $("body").on("click", "#assign", function() {
            $(".typeahead").val("");
            $("#search_job").text($("#job").val());
        })


    

        $('input:checkbox[name="day"]').click(function() {
            var arr_lenght = $('input:checkbox:checked[name="day"]').map(function() {
                return $(this).val();
            }).get().length;
            $("#day_count").val(arr_lenght);
            var day_total = $("#one_day_salary").val() * arr_lenght;
            $("#salary_total").val(day_total);
            $("#total").val($("#salary_total").val());
        })

        // $('input:checkbox[name="need"]').change(function() {
        //     if ($(this).prop("checked") == true) {
        //         var lunch_total = 0 - $("#day_count").val() * $("#lunch_price").val();
        //         $("#lunch_total").val(lunch_total);
        //         var total = parseInt($("#salary_total").val()) + parseInt($("#lunch_total").val());
        //         $("#total").val(total);
        //     } else {
        //         $("#lunch_total").val(0);
        //         var lunch = (parseInt($("#lunch_price").val()) * parseInt($("#day_count").val()));
        //         var total = parseInt($("#total").val()) + lunch;
        //         $("#total").val(total);
        //     }
        // })

        $("body").on("keyup", "#one_day_salary", function() {
            var day_total = $(this).val() * $("#day_count").val();
            $("#salary_total").val(day_total);
            var total = day_total;
            $("#total").val(total)
        })

    });
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
        <img src="assets/images/b4_title.png" alt="" style="width: 15%;">
    </div>

</div>
<div class="row" style="height:700px;overflow: auto;">

    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>考區</th>
                    <th>職務</th>
                    <th>職稱</th>
                    <th>姓名</th>
                    <th>執行日</th>
                    <th>聯絡電話</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datalist as $k => $v): ?> 
                <tr sn="<?=$v['sn']; ?>">
                    <td>
                        <?=$k + 1; ?>
                    </td>
                    <!-- <td>
                        <?=$v['year']; ?>
                    </td> -->
                    <td>
                        <?=$v['area']; ?>
                    </td>
                    <td>
                        <?=$v['job']; ?>
                    </td>
                    <!-- <td>
                        <?=$v['job_code']; ?>
                    </td> -->
                    <td>
                        <?=$v['job_title']; ?>
                    </td>
                    <td>
                        <?=$v['name']; ?>
                    </td>
                    <td>
                        <?=$v['do_date']; ?>
                    </td>
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

<div class="bottom">
    <div class="row boxs">

        <!-- 職務選擇開始 -->
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin:20px 0px 20px 25px">
            <div class="row">
                <div for="" class="col-2" style="display: inline-block;line-height:40px;text-align:right;">職務</div>
                <select class="form-control col-4" id="job" disabled>
                    <?php foreach ($job as $k => $v): ?>
                    <option value = "<?=$v['job']?>">
                        <?=$v['job']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <div class="col-6">
                    <button type="button" class="btn btn-primary" id="assign" data-toggle="modal" data-target="#exampleModal" style="display:none;">指派</button>
                    <button class="btn btn-primary" type="button" id="new_job">新增職務</button>
                </div>
            </div>
        </div>

        <!-- 職務選擇結束 -->
        <div class="col-md-12 col-sm-12 col-xs-12 ">
            <form method="POST" enctype="multipart/form-data" action="" id="form" class="">
                <div class="col-md-3 col-sm-3 col-xs-3 cube">
                    <div class="form-group">
                        <label for="job_code" class="" style="float:left;">職員代碼</label>
                        <input type="hidden" id="sn">
                        <input type="hidden" id="member_job_title">
                        <input type="text" class="form-control" id="job_code" readonly>
                    </div>
                    <div class="form-group">
                        <label for="job_title" class="" style="float:left;">職稱</label>
                        <input type="text" class="form-control" id="job_title" readonly>
                    </div>
                    <div class="form-group">
                        <label for="member_name" class="" style="float:left;">姓名</label>
                        <input type="text" class="form-control" id="name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="trial_start" class="" style="float:left;">聯絡電話</label>
                        <input type="text" class="form-control" id="phone" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 cube">
                    <div class="form-group">
                        <label for="start_date" class="" style="float:left;">執行日</label>
                        <input type="checkbox" class="chbox" id="do_date" name="day" value=<?=$datatime_info['day'];?> checked>
                        <span class="chbox"  >
                            <?=$datatime_info['day']; ?>
                        </span>
                    </div>
                    <div class="form-group" style="display:none">
                        <label for="trial_start" class="" style="float:left;">試場起號</label>
                        <input type="text" class="form-control" id="trial_start" readonly>
                    </div>
                    <div class="form-group" style="display:none">
                        <label for="trial_end" class="" style="float:left;">試場迄號</label>
                        <input type="text" class="form-control" id="trial_end" readonly>
                    </div>
                </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-3 cube" style="float:left">
        <div class="form-group">
            <label for="start_date" class="" style="float:left;">天數</label>
            <input type="text" class="form-control" id="day_count" value="0" readonly>
        </div>
        <div class="form-group" style="padding: 0% 3%;">
            <div class="W50">
                <label for="trial_start" class="" style="float:left;width: 50%;">薪資單價</label>
                <input type="text" class="form-control" id="one_day_salary">
            </div>
            <div class="W50">
                <label for="trial_start" class="" style="float:left;width: 50%;">薪資總計</label>
                <input type="text" class="form-control" id="salary_total" value="0" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="trial_end" class="" style="float:left;">總計</label>
            <input type="text" class="form-control" id="total" value="0" readonly>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 " style="float:left;margin: 20px auto;">
        <div class="">
            <div class="">
                <label for="note" class="" style="float:left;text-align:left;width: 15%;text-align:center;">備註</label>
                <textarea name="note" id="note" class="" style="width:300px"></textarea>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6" style="float:left;margin: 20px auto;">
        <div class="form-group" style="text-align:right">
            <div class="">
                <button type="button" class="btn btn-primary" id="send">修改</button>
                <button type="button" class="btn btn-danger" id="remove">刪除</button>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
</div>
<!-- Modal start-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title" id="exampleModalLabel" style="">指派職務</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form method="POST" enctype="multipart/form-data" action="" id="form" class="page_form">
                            <div style="width: 255px;margin: 0 auto;">
                                <div>
                                    <p>職務：
                                        <span id="search_job"></span>
                                    </p>
                                </div>
                                <div>
                                    <p>關鍵字
                                        <input type="text" class="typeahead">
                                    </p>
                                </div>

                            </div>
                            <div class="" style="text-align: right;margin: 20px;">
                                <button type="button" class="btn btn-primary" id="sure">確定指派</button>
                                <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close" id="">取消</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->