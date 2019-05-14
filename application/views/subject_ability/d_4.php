<style>
@media (min-width: 1200px) {
    .container {
        max-width: 1680px;
        width: 1680px;
    }
}

.container {
    max-width: 2100px;
    width: 2100px !important;
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
    padding: 50px 0px 20px;
}

.table {
    height: auto;
    overflow: auto;
}

.cube {
    background: #dacddf;
    margin: 0px 10px;
    padding: 20px;
    border-radius: 10px;
    float: left;
    flex: 0 0 30%;
    max-width: 31%;
    height: auto;
}

.cube1 {
    margin: 0px 10px;
    padding: 20px;
    border-radius: 10px;
    float: left;
    flex: 0 0 30%;
    max-width: 32%;
}

label {
    display: inline-block;
    line-height: 40px;
    text-align: center;
    width: 35%;
    font-size: 14px;
}

.form-control {
    display: block;
    width: 50%;
    padding: .375rem .75rem;
    font-size: 14px;
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
    padding-right: 0%;
    float: left;
    width: 100%;
}

.bottom {
    bottom: 0px;
    width: 100%;
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
    background: #a97eb8;
}

.part {
    display: none;
}

.W50 {
    width: 50%;
    float: left;
}

.tab_text {
    text-align: center;
    padding: 10px 0px;
    font-size: 21px;
}

tr {
    cursor: pointer;
}
</style>

<script>
$(function() {
    var nowHash = location.hash; //取得loading進來後目前#
    var nowTabNum = nowHash.slice(-1);
    var nowHtml = location.pathname.split("/").pop();
    // console.log(nowTabNum);
    if (nowHash != "") {
        $(".part").hide();
        $('#part' + nowTabNum).show();
        $(".tab").removeClass('active');
        $('.tab' + nowTabNum).addClass('active');
    } else {
        //如果loading進來的網址沒有hash，判斷是不是tab頁面
        // console.log(object);
        switch (nowHash) {
            case "":
                $('.tab1').addClass('active');
                $(".part").hide();
                $('#part1').show();
                break;
            case "#1":
                $('.tab1').addClass('active');
                $(".part").hide();
                $('#part' + nowTabNum).show();
                break;
            case "#2":
                $('.tab2').addClass('active');
                $(".part").hide();
                $('#part' + nowTabNum).show();
                break;
            case "#3":
                $('.tab3').addClass('active');
                $(".part").hide();
                $('#part' + nowTabNum).show();
                break;
        }
    }

    $("body").on("click", ".tab", function(e) {
        e.preventDefault();
        var newHash = $(this).attr("area"); //點到的id
        //點擊先做還原動作
        $('input[name="first_member_day"]').each(function() {
            for (let index = 0; index < 3; index++) {
                $(this).prop("checked", false);
            }
        })
        $('input[name="second_member_day"]').each(function() {
            for (let index = 0; index < 3; index++) {
                $(this).prop("checked", false);
            }
        })
        $("#trial_staff_code_1").val("");
        $("#trial_staff_code_2").val("");
        $("#sn").val("");
        $("#member_job_title").val("");
        $("#first_member_job_code").val("");
        $("#first_member_job_title").val("");
        $("#first_member_name").val("");
        $("#first_member_phone").val("");
        $(".field").val("");
        $("#first_member_meal").val("");
        $("#second_member_meal").val("");
        $("#first_member_order_meal").prop("checked", false);
        $("#first_member_day_count").val(0);
        $("#first_member_section_count").val(0);
        $("#first_member_one_day_salary").val(<?= $fees_info['one_day_salary']; ?>);
        $("#first_member_salary_section").val(<?= $fees_info['salary_section']; ?>);
        $("#first_member_lunch_price").val(0);
        $("#first_member_day_lunch_total").val(0);
        $("#first_member_section_lunch_total").val(0);
        $("#first_member_section_total").val(0);
        $("#first_member_day_total").val(0);
        $("#first_member_section_salary_total").val(0);
        $("#second_member_job_code").val("");
        $("#second_member_job_title").val("");
        $("#second_member_name").val("");
        $("#second_member_phone").val("");
        $("#second_member_order_meal").prop("checked", false);
        $("#second_member_day_count").val(0);
        $("#second_member_section_count").val(0);
        $("#second_member_one_day_salary").val(<?= $fees_info['one_day_salary']; ?>);
        $("#second_member_salary_section").val(<?= $fees_info['salary_section']; ?>);
        $("#second_member_lunch_price").val(0);
        $("#second_member_day_lunch_total").val(0);
        $("#second_member_section_lunch_total").val(0);
        $("#second_member_section_total").val(0);
        $("#second_member_day_total").val(0);
        $("#second_member_section_salary_total").val(0);
        $(".first_member_meal").hide();
        $(".second_member_meal").hide();
        // console.log(newHash);
        if (nowHtml == "d_4") {
            //開闔div
            $(".part").css({
                "display": "none"
            });
            $('#part' + newHash).show();
            //tab樣式
            $(".tab").removeClass('active');
            $(this).addClass('active');
            //修正網址
            location.hash = '#' + newHash;
        } else {
            //如果本頁不是f_2_2則為一般超連結
            location.href = './subject_ability/d_4' + newHash;
            $('#part' + newHash).show();
        }
    })

    $(window).on("load", function() {
        var addr = $("#addr").val();
        // console.log(arr);
        if (addr == "") {
            alert("目前 C6 考試地址尚未填寫資料，請先填寫資料再進行操作");
            location.href = "./subject_ability/c_4";
        }
    })

    /**自動完成 */
    var data;
    $.getJSON("./subject_ability/api/get_member_info", function(data) {
        data = data.info;
        // console.log(data);
        var $input = $(".typeahead");
        $input.typeahead({
            source: data,
            autoSelect: true,
        });
    })

    // $(".part").eq(0).show();
    // $("body").on("click", ".tab", function() {
    //     var $this = $(this);

    //     $(".tab").removeClass("active");
    //     $(".part").hide();
    //     // 點擊到的追加active以及打開相對應table
    //     $this.addClass("active");
    //     var area = $this.attr("area");
    //     $("#part" + area).show();
    // })

    $("body").on("click", "tr", function() {

        $('input[name="first_member_day"]').each(function() {
            for (let index = 0; index < 3; index++) {
                $(this).prop("checked", false);
            }
        })
        $('input[name="second_member_day"]').each(function() {
            for (let index = 0; index < 3; index++) {
                $(this).prop("checked", false);
            }
        })

        var section = $(this).attr("section");
        $("#first_member_section_count").val(section);
        $("#second_member_section_count").val(section);
        var sn = $(this).attr("sn");
        $("#sn").val(sn);
        var part = $(this).attr("part");
        var field = $(this).attr("field");
        // console.log(field);
        $("html, body").animate({
            scrollTop: $("body").height()
        }, 1000);
        $.ajax({
            url: './subject_ability/api/get_once_assign',
            data: {
                "sn": sn,
            },
            dataType: "json"
        }).done(function(data) {
            console.log(data.info);
            // console.log(data.info.first_member_do_date);

            var date = data.info.first_member_do_date;
            var date2 = data.info.second_member_do_date;
            var date = date.split(",");
            var date2 = date2.split(",");

            $('input[name="first_member_day"]').each(function() {
                for (let index = 0; index < 1; index++) {
                    var a = $(this).val();
                    var ans = jQuery.inArray(a, date);
                    // console.log(a);
                    // console.log(date);

                    if (ans >= 0) {
                        console.log(ans);
                        $(this).prop("checked", true);
                    } else if (ans == -1) {
                        $(this).prop("checked", false);
                    }
                }
            })

            $('input[name="second_member_day"]').each(function() {
                for (let index = 0; index < 1; index++) {
                    var a = $(this).val();
                    var ans = jQuery.inArray(a, date2);

                    if (ans >= 0) {
                        // console.log(ans);
                        $(this).prop("checked", true);
                    } else if (ans == -1) {
                        $(this).prop("checked", false);
                    }
                }
            })






            $(".field").val(field);
            $("#sn").val(data.info.sn);
            //職員一
            $("#first_member_lunch_price").attr("lunch_price",
                "<?= $fees_info['lunch_fee']; ?>");
            $("#second_member_lunch_price").attr("lunch_price",
                "<?= $fees_info['lunch_fee']; ?>");
            $("#first_member_day_count").val(data.info.first_member_day_count);

            if (data.info.first_member_order_meal == "Y") {
                $("#first_member_order_meal").prop("checked", true);
                $(".first_member_meal").show();
                $("#first_member_lunch_price").val(data.info.first_member_lunch_price);
            } else {
                $("#first_member_order_meal").prop("checked", false);
                $(".first_member_meal").hide();
                $("#first_member_lunch_price").val(0);
            }
            $("#first_member_meal").prop("checked", true);
            $("#first_member_order_meal").val(data.info.first_member_order_meal);
            $("#first_member_salary_section").val(data.info.first_member_salary_section);
            $("#first_member_section_lunch_total").val(data.info
                .first_member_section_lunch_total);
            $("#first_member_section_salary_total").val(data.info
                .first_member_section_salary_total);
            $("#first_member_section_total").val(data.info.first_member_section_total);
            $("#first_member_name").val(data.info.supervisor_1);
            $("#first_member_job_code").val(data.info.supervisor_1_code);
            $("#trial_staff_code_1").val(data.info.trial_staff_code_1);
            //職員二
            $("#second_member_day_count").val(data.info.second_member_day_count);

            $("#second_member_meal").val(data.info.second_member_meal);
            if (data.info.second_member_order_meal == "Y") {
                $("#second_member_order_meal").prop("checked", true);
                $(".second_member_meal").show();
                $("#second_member_lunch_price").val(data.info.second_member_lunch_price);
            } else {
                $("#second_member_order_meal").prop("checked", false);
                $(".second_member_meal").hide();
                $("#second_member_lunch_price").val(0);
            }
            $("#second_member_salary_section").val(data.info.second_member_salary_section);
            $("#second_member_section_lunch_total").val(data.info
                .second_member_section_lunch_total);
            $("#second_member_section_salary_total").val(data.info
                .second_member_section_salary_total);
            $("#second_member_section_total").val(data.info.second_member_section_total);
            $("#second_member_name").val(data.info.supervisor_2);
            $("#second_member_job_code").val(data.info.supervisor_2_code);
            $("#trial_staff_code_2").val(data.info.trial_staff_code_2);

            // 取得職員一資料
            $.ajax({
                url: './subject_ability/api/get_staff_member',
                data: {
                    "code": data.info.supervisor_1_code,
                },
                dataType: "json"
            }).done(function(member) {
                // console.log(member);
                $("#first_member_job_title").val(member.info.member_title);
                $("#first_member_phone").val(member.info.member_phone);
            })
            // // 取得職員二資料
            $.ajax({
                url: './subject_ability/api/get_staff_member',
                data: {
                    "code": data.info.supervisor_2_code,
                },
                dataType: "json"
            }).done(function(data) {
                $("#second_member_job_title").val(data.info.member_title);
                $("#second_member_phone").val(data.info.member_phone);
            })
            // 取得試場 start & end get_field_start_end
            $.ajax({
                url: './subject_ability/api/room_use_day',
                data: {
                    "part": part,
                    "start": field,
                    "end": field,
                },
                dataType: "json"
            }).done(function(day) {
                // console.log(day.day);
                // // 監試人員一天數
                // $('input:checkbox[name="first_member_day"]').eq(0).prop("checked", day.day[0]);
                // $('input:checkbox[name="first_member_day"]').eq(1).prop("checked", day.day[1]);
                // $('input:checkbox[name="first_member_day"]').eq(2).prop("checked", day.day[2]);

                // // 監試人員二天數
                // $('input:checkbox[name="second_member_day"]').eq(0).prop("checked", day.day[0]);
                // $('input:checkbox[name="second_member_day"]').eq(1).prop("checked", day.day[1]);
                // $('input:checkbox[name="second_member_day"]').eq(2).prop("checked", day.day[2]);
            })
        })
    })



    $("body").on("click", ".send", function() {
        var day_count1 = $('input:checkbox:checked[name="first_member_day"]').map(function() {
            return $(this).val();
        }).get()
        var first_member_do_date = day_count1.join(",");
        var day_count2 = $('input:checkbox:checked[name="second_member_day"]').map(function() {
            return $(this).val();
        }).get()
        var second_member_do_date = day_count2.join(",");
        if (confirm("是否要儲存?")) {
            var sn = $("#sn").val();
            var first_member_meal;
            if ($("#first_member_order_meal").prop("checked") == true) {
                first_member_meal = $("#first_member_meal").val()
            } else {
                first_member_meal = "自備";
            }
            var second_member_meal;
            if ($("#second_member_order_meal").prop("checked") == true) {
                second_member_meal = $("#second_member_meal").val()
            } else {
                second_member_meal = "自備";
            }
            var first_member_order_meal;
            if ($("#first_member_order_meal").prop("checked") == false) {
                first_member_order_meal = "N";
            } else {
                first_member_order_meal = "Y"
            }
            var second_member_order_meal;
            if ($("#second_member_order_meal").prop("checked") == false) {
                second_member_order_meal = "N";
            } else {
                second_member_order_meal = "Y"
            }
            $.ajax({
                url: './subject_ability/api/save_trial_for_price',
                data: {
                    "sn": sn,
                    "first_member_do_date": first_member_do_date,
                    "first_member_day_count": $("#first_member_day_count").val(),
                    "first_member_salary_section": $("#first_member_salary_section").val(),
                    "first_member_section_salary_total": $("#first_member_section_salary_total")
                        .val(),
                    "first_member_order_meal": first_member_order_meal,
                    "first_member_lunch_price": $("#first_member_lunch_price").val(),
                    "first_member_section_lunch_total": $("#first_member_section_lunch_total")
                        .val(),
                    "first_member_section_total": $("#first_member_section_total").val(),
                    "second_member_do_date": second_member_do_date,
                    "second_member_day_count": $("#second_member_day_count").val(),
                    "second_member_salary_section": $("#second_member_salary_section").val(),
                    "second_member_section_salary_total": $(
                        "#second_member_section_salary_total").val(),
                    "second_member_order_meal": second_member_order_meal,
                    "second_member_lunch_price": $("#second_member_lunch_price").val(),
                    "second_member_section_lunch_total": $("#second_member_section_lunch_total")
                        .val(),
                    "second_member_section_total": $("#second_member_section_total").val(),
                    "first_member_meal": first_member_meal,
                    "second_member_meal": second_member_meal
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

    $("body").on("keyup", "#first_member_lunch_price", function() {
        var lunch_total = 0 - $(this).val() * $("#first_member_day_count").val();
        $("#first_member_section_lunch_total").val(lunch_total);
        var first_member_section_total = parseInt($("#first_member_section_salary_total").val()) +
            parseInt($("#first_member_section_lunch_total").val());
        $("#first_member_section_total").val(first_member_section_total);
    })

    $("body").on("keyup", "#second_member_lunch_price", function() {
        var lunch_total = 0 - $(this).val() * $("#second_member_day_count").val();
        $("#second_member_section_lunch_total").val(lunch_total);
        var second_member_section_total = parseInt($("#second_member_section_salary_total").val()) +
            parseInt($("#second_member_section_lunch_total").val());
        $("#second_member_section_total").val(second_member_section_total);
    })

    $("#first_member_order_meal").change(function() {
        if (this.checked) {
            $(this).val("Y");
            $(".first_member_meal").show();
            $("#first_member_lunch_price").attr("readonly", false);
            $("#first_member_meal").val("葷");
            //判斷有沒有編輯過便當價格決定要不要帶入預設值
            if ($("#first_member_lunch_price").attr("lunch_price") ==
                "<?= $fees_info['lunch_fee']; ?>" || $("#first_member_lunch_price").attr(
                    "#first_member_lunch_price") == undefined) {
                $("#first_member_lunch_price").val($("#first_member_lunch_price").attr("lunch_price"));
                var lunch_total = 0 - $("#first_member_lunch_price").val() * $(
                    "#first_member_day_count").val();
                $("#first_member_section_lunch_total").val(lunch_total);
                var first_member_section_total = parseInt($("#first_member_section_salary_total")
                    .val()) + parseInt($("#first_member_section_lunch_total").val());
                $("#first_member_section_total").val(first_member_section_total);
            } else {
                $("#first_member_lunch_price").val("<?= $fees_info['lunch_fee']; ?>");
            }
        } else {
            $(this).val("N");
            $(".first_member_meal").hide();
            $("#first_member_lunch_price").attr("readonly", true);
            $("#first_member_lunch_price").val(0);
            $("#first_member_section_lunch_total").val(0);
            var first_member_section_total = parseInt($("#first_member_section_salary_total").val()) +
                parseInt($("#first_member_section_lunch_total").val());
            $("#first_member_section_total").val(first_member_section_total);
        }
    });

    $("#second_member_order_meal").change(function() {
        if (this.checked) {
            $(this).val("Y");
            $(".second_member_meal").show();
            $("#second_member_lunch_price").attr("readonly", false);
            $("#second_member_meal").val("葷");
            //判斷有沒有編輯過便當價格決定要不要帶入預設值
            if ($("#second_member_lunch_price").attr("lunch_price") ==
                "<?= $fees_info['lunch_fee']; ?>" || $("#second_member_lunch_price").attr(
                    "#second_member_lunch_price") == undefined) {
                $("#second_member_lunch_price").val($("#second_member_lunch_price").attr(
                    "lunch_price"));
                var lunch_total = 0 - $("#second_member_lunch_price").val() * $(
                    "#second_member_day_count").val();
                $("#second_member_section_lunch_total").val(lunch_total);
                var second_member_section_total = parseInt($("#second_member_section_salary_total")
                    .val()) + parseInt($("#second_member_section_lunch_total").val());
                $("#second_member_section_total").val(second_member_section_total);
            } else {
                $("#second_member_lunch_price").val("<?= $fees_info['lunch_fee']; ?>");
            }
        } else {
            $(this).val("N");
            $(".second_member_meal").hide();
            $("#second_member_lunch_price").attr("readonly", true);
            $("#second_member_lunch_price").val(0);
            $("#second_member_section_lunch_total").val(0);
            var second_member_day_total = parseInt($("#second_member_section_salary_total").val()) +
                parseInt($("#second_member_section_lunch_total").val());
            $("#second_member_section_total").val(second_member_day_total);
        }
    });

    $("body").on("keyup", "#first_member_salary_section", function() {
        var section_total = $(this).val() * $("#first_member_section_count").val();
        $("#first_member_section_salary_total").val(section_total);
        //計算總金額 (排除沒訂餐)
        if ($("#first_member_order_meal").val() == "N") {
            $("#first_member_section_total").val(section_total);
        } else {
            var first_member_section_lunch_total = parseInt($("#first_member_day_count").val()) *
                parseInt($("#first_member_lunch_price").val());
            var first_member_section_lunch_total = first_member_section_lunch_total;
            $("#first_member_section_lunch_total").val(first_member_section_lunch_total);
            var first_member_section_total = parseInt($("#first_member_section_salary_total").val()) -
                parseInt($("#first_member_section_lunch_total").val());
            $("#first_member_section_total").val(first_member_section_total);
        }
    })

    $("body").on("keyup", "#second_member_salary_section", function() {
        var section_total = $(this).val() * $("#second_member_section_count").val();
        $("#second_member_section_salary_total").val(section_total);
        //計算總金額 (排除沒訂餐)
        if ($("#second_member_order_meal").val() == "N") {
            $("#second_member_section_total").val(section_total);
        } else {
            var second_member_section_lunch_total = parseInt($("#second_member_day_count").val()) *
                parseInt($("#second_member_lunch_price").val());
            var second_member_section_lunch_total = second_member_section_lunch_total;
            $("#second_member_section_lunch_total").val(second_member_section_lunch_total);
            var second_member_section_total = parseInt($("#second_member_section_salary_total").val()) -
                parseInt($("#second_member_section_lunch_total").val());
            $("#second_member_section_total").val(second_member_section_total);
        }
    })
});
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
        <img src="assets/images/d4_title.png" alt="" style="width: 15%;">
    </div>

</div>
<div class="row" style="position: relative;top: 20px;left: 10px;">
    <div style="width:95%;margin:5px auto;">
        <div class="tab tab1 active" area="1" part="2501" eng="first">
            <div class="tab_text">第一分區</div>
        </div>
        <div class="tab tab2" area="2" part="2502" eng="second">
            <div class="tab_text">第二分區</div>
        </div>
        <div class="tab tab3" area="3" part="2503" eng="third">
            <div class="tab_text">第三分區</div>
        </div>
        <div class="tab tab4" area="4" part="2504" eng="fourth">
            <div class="tab_text">第四分區</div>
        </div>
        <div class="tab tab5" area="5" part="2505" eng="fifth">
            <div class="tab_text">第五分區</div>
        </div>
    </div>
</div>
<div class="row part" id="part1" style="height:700px;overflow: auto;">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>試場</th>
                    <th>考試節數</th>
                    <th>考生應試號起</th>
                    <th>考生應試號迄</th>
                    <th>應試人數</th>
                    <th>樓層別</th>
                    <th>監試人員一編號</th>
                    <th>監試人員一</th>
                    <th>監試人員二編號</th>
                    <th>監試人員二</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part1 as $k => $v) : ?>
                <tr sn="<?= $v['sn']; ?>" part="2501" field="<?= $v['field']; ?>" section="<?= $v['test_section']; ?>">
                    <td>
                        <?= $k + 1; ?>
                    </td>
                    <td>
                        <?= $v['field']; ?>
                    </td>
                    <td>
                        <?= $v['test_section']; ?>
                    </td>
                    <td>
                        <?= $v['start']; ?>
                    </td>
                    <td>
                        <?= $v['end']; ?>
                    </td>
                    <td>
                        <?= $v['number']; ?>
                    </td>
                    <td>
                        <?= $v['floor']; ?>
                    </td>
                    <td>
                        <?= $v['trial_staff_code_1']; ?>
                    </td>
                    <td>
                        <?= $v['supervisor_1']; ?>
                    </td>
                    <td>
                        <?= $v['trial_staff_code_2']; ?>
                    </td>
                    <td>
                        <?= $v['supervisor_2']; ?>
                    </td>
                    <td>
                        <?= $v['note']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row part" id="part2" style="height:700px;overflow: auto;">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>試場</th>
                    <th>考試節數</th>
                    <th>考生應試號起</th>
                    <th>考生應試號迄</th>
                    <th>應試人數</th>
                    <th>樓層別</th>
                    <th>監試人員一編號</th>
                    <th>監試人員一</th>
                    <th>監試人員二編號</th>
                    <th>監試人員二</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part2 as $k => $v) : ?>
                <tr sn="<?= $v['sn']; ?>" part="2502" field="<?= $v['field']; ?>" section="<?= $v['test_section']; ?>">
                    <td>
                        <?= $k + 1; ?>
                    </td>
                    <td>
                        <?= $v['field']; ?>
                    </td>
                    <td>
                        <?= $v['test_section']; ?>
                    </td>
                    <td>
                        <?= $v['start']; ?>
                    </td>
                    <td>
                        <?= $v['end']; ?>
                    </td>
                    <td>
                        <?= $v['number']; ?>
                    </td>
                    <td>
                        <?= $v['floor']; ?>
                    </td>
                    <td>
                        <?= $v['trial_staff_code_1']; ?>
                    </td>
                    <td>
                        <?= $v['supervisor_1']; ?>
                    </td>
                    <td>
                        <?= $v['trial_staff_code_2']; ?>
                    </td>
                    <td>
                        <?= $v['supervisor_2']; ?>
                    </td>
                    <td>
                        <?= $v['note']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row part" id="part3" style="height:700px;overflow: auto;">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>試場</th>
                    <th>考試節數</th>
                    <th>考生應試號起</th>
                    <th>考生應試號迄</th>
                    <th>應試人數</th>
                    <th>樓層別</th>
                    <th>監試人員一編號</th>
                    <th>監試人員一</th>
                    <th>監試人員二編號</th>
                    <th>監試人員二</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part3 as $k => $v) : ?>
                <tr sn="<?= $v['sn']; ?>" part="2503" field="<?= $v['field']; ?>" section="<?= $v['test_section']; ?>">
                    <td>
                        <?= $k + 1; ?>
                    </td>
                    <td>
                        <?= $v['field']; ?>
                    </td>
                    <td>
                        <?= $v['test_section']; ?>
                    </td>
                    <td>
                        <?= $v['start']; ?>
                    </td>
                    <td>
                        <?= $v['end']; ?>
                    </td>
                    <td>
                        <?= $v['number']; ?>
                    </td>
                    <td>
                        <?= $v['floor']; ?>
                    </td>
                    <td>
                        <?= $v['trial_staff_code_1']; ?>
                    </td>
                    <td>
                        <?= $v['supervisor_1']; ?>
                    </td>
                    <td>
                        <?= $v['trial_staff_code_2']; ?>
                    </td>
                    <td>
                        <?= $v['supervisor_2']; ?>
                    </td>
                    <td>
                        <?= $v['note']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="row part" id="part4" style="height:700px;overflow: auto;">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>試場</th>
                    <th>考試節數</th>
                    <th>考生應試號起</th>
                    <th>考生應試號迄</th>
                    <th>應試人數</th>
                    <th>樓層別</th>
                    <th>監試人員一編號</th>
                    <th>監試人員一</th>
                    <th>監試人員二編號</th>
                    <th>監試人員二</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part4 as $k => $v) : ?>
                <tr sn="<?= $v['sn']; ?>" part="2504" field="<?= $v['field']; ?>" section="<?= $v['test_section']; ?>">
                    <td>
                        <?= $k + 1; ?>
                    </td>
                    <td>
                        <?= $v['field']; ?>
                    </td>
                    <td>
                        <?= $v['test_section']; ?>
                    </td>
                    <td>
                        <?= $v['start']; ?>
                    </td>
                    <td>
                        <?= $v['end']; ?>
                    </td>
                    <td>
                        <?= $v['number']; ?>
                    </td>
                    <td>
                        <?= $v['floor']; ?>
                    </td>
                    <td>
                        <?= $v['trial_staff_code_1']; ?>
                    </td>
                    <td>
                        <?= $v['supervisor_1']; ?>
                    </td>
                    <td>
                        <?= $v['trial_staff_code_2']; ?>
                    </td>
                    <td>
                        <?= $v['supervisor_2']; ?>
                    </td>
                    <td>
                        <?= $v['note']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row part" id="part5" style="height:700px;overflow: auto;">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>試場</th>
                    <th>考試節數</th>
                    <th>考生應試號起</th>
                    <th>考生應試號迄</th>
                    <th>應試人數</th>
                    <th>樓層別</th>
                    <th>監試人員一編號</th>
                    <th>監試人員一</th>
                    <th>監試人員二編號</th>
                    <th>監試人員二</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part5 as $k => $v) : ?>
                <tr sn="<?= $v['sn']; ?>" part="2505" field="<?= $v['field']; ?>" section="<?= $v['test_section']; ?>">
                    <td>
                        <?= $k + 1; ?>
                    </td>
                    <td>
                        <?= $v['field']; ?>
                    </td>
                    <td>
                        <?= $v['test_section']; ?>
                    </td>
                    <td>
                        <?= $v['start']; ?>
                    </td>
                    <td>
                        <?= $v['end']; ?>
                    </td>
                    <td>
                        <?= $v['number']; ?>
                    </td>
                    <td>
                        <?= $v['floor']; ?>
                    </td>
                    <td>
                        <?= $v['trial_staff_code_1']; ?>
                    </td>
                    <td>
                        <?= $v['supervisor_1']; ?>
                    </td>
                    <td>
                        <?= $v['trial_staff_code_2']; ?>
                    </td>
                    <td>
                        <?= $v['supervisor_2']; ?>
                    </td>
                    <td>
                        <?= $v['note']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="bottom">
    <div class="row boxs">
        <div class="col-md-12 col-sm-12 col-xs-12 ">
            <form method="POST" enctype="multipart/form-data" action="" id="form" class="">
                <div style="width:50%;float:left">
                    <div style="width:70%;float:left;margin-left:35%;">
                        <input type="text" id="trial_staff_code_1" placeholder="監試人員編號" style="width:20%;float:left;">
                        <h3 style="width:50%;float:left;">監試人員一</h3>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3 cube W14">
                        <div class="form-group">
                            <label for="job_code" class="" style="float:left;">職員代碼</label>
                            <input type="hidden" id="sn">
                            <input type="hidden" id="member_job_title">
                            <input type="text" class="form-control" id="first_member_job_code" readonly>
                        </div>
                        <div class="form-group">
                            <label for="job_title" class="" style="float:left;">職稱</label>
                            <input type="text" class="form-control" id="first_member_job_title" readonly>
                        </div>
                        <div class="form-group">
                            <label for="member_name" class="" style="float:left;">姓名</label>
                            <input type="text" class="form-control" id="first_member_name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="trial_start" class="" style="float:left;">聯絡電話</label>
                            <input type="text" class="form-control" id="first_member_phone" readonly>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3 cube W14">
                        <div class="form-group">
                            <label for="trial_start" class="" style="float:left;">試場</label>
                            <input type="text" class="form-control field" readonly>
                        </div>
                        <div class="form-group">
                            <label for="start_date" class="" style="float:left;">執行日</label>
                            <input type="checkbox" class="chbox" id="" name="first_member_day"
                                value="<?= mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?>" disabled>
                            <span class="chbox">
                                <?= mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?>
                            </span>
                            <input type="checkbox" class="chbox" id="" name="first_member_day"
                                value="<?= mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?>" disabled>
                            <span class="chbox">
                                <?= mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?>
                            </span>
                            <input type="checkbox" class="chbox" id="" name="first_member_day"
                                value="<?= mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?>" disabled>
                            <span class="chbox">
                                <?= mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="order_meal">訂餐需求</label>
                            <input type="checkbox" class="" name="need" id="first_member_order_meal" disabled>
                            <span>需訂餐</span>
                        </div>
                        <div class="form-group first_member_meal">
                            <label for="first_member_meal" class="" style="float:left;">餐別</label>
                            <select class="form-control" id="first_member_meal" disabled>
                                <option value="葷">葷</option>
                                <option value="素">素</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3 cube W20">
                        <div class="form-group">
                            <label for="start_date" class="" style="float:left;">天數/節數</label>
                            <input type="hidden" class="form-control" id="first_member_day_count" readonly>
                            <input type="text" class="form-control" id="first_member_section_count" readonly>
                        </div>
                        <div class="form-group" style="padding: 0% 3%;">
                            <div class="W50">
                                <label for="trial_start" class="" style="float:left;width: 50%;">薪資單價</label>
                                <input type="hidden" class="form-control" id="first_member_one_day_salary"
                                    value="<?= $fees_info['one_day_salary']; ?>">
                                <input type="text" class="form-control" id="first_member_salary_section" value=0
                                    disabled>
                            </div>
                            <div class="W50">
                                <label for="trial_start" class="" style="float:left;width: 50%;">薪資總計</label>
                                <input type="hidden" class="form-control" id="first_member_day_salary_total" value="0"
                                    readonly>
                                <input type="text" class="form-control" id="first_member_section_salary_total" value="0"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group" style="padding: 0% 3%;">
                            <div class="W50">
                                <label for="trial_start" class="" style="float:left;width: 50%;">便當費 </label>
                                <input type="text" class="form-control" id="first_member_lunch_price" value=0 disabled>
                            </div>
                            <div class="W50">
                                <label for="trial_start" class="" style="float:left;width: 50%;">便當總計</label>
                                <input type="hidden" class="form-control" id="first_member_day_lunch_total" value="0"
                                    readonly>
                                <input type="text" class="form-control" id="first_member_section_lunch_total" value="0"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trial_end" class="" style="float:left;">總計</label>
                            <input type="hidden" class="form-control" id="first_member_day_total" value="0">
                            <input type="text" class="form-control" id="first_member_section_total" value="0" readonly>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="float: left;margin: 50px auto 0;">
                        <div class="form-group" style="text-align:right">
                            <div class="">
                                <button type="button" class="btn btn-primary send">修改</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div style="width:50%;float:left;padding-left:30px;border-left: 1px solid #000;">
                    <div style="width:70%;float:left;margin-left:35%;">
                        <input type="text" id="trial_staff_code_2" placeholder="監試人員編號" style="width:20%;float:left;">
                        <h3 style="width:50%;float:left;">監試人員二</h3>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3 cube W14">
                        <div class="form-group">
                            <label for="job_code" class="" style="float:left;">職員代碼</label>
                            <input type="hidden" id="second_member_member_job_title">
                            <input type="text" class="form-control" id="second_member_job_code" readonly>
                        </div>
                        <div class="form-group">
                            <label for="job_title" class="" style="float:left;">職稱</label>
                            <input type="text" class="form-control" id="second_member_job_title" readonly>
                        </div>
                        <div class="form-group">
                            <label for="member_name" class="" style="float:left;">姓名</label>
                            <input type="text" class="form-control" id="second_member_name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="trial_start" class="" style="float:left;">聯絡電話</label>
                            <input type="text" class="form-control" id="second_member_phone" readonly>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3 cube W14">
                        <div class="form-group">
                            <label for="trial_start" class="" style="float:left;">試場</label>
                            <input type="text" class="form-control field" readonly>
                        </div>
                        <div class="form-group">
                            <label for="start_date" class="" style="float:left;">執行日</label>
                            <input type="checkbox" class="chbox" id="" name="second_member_day"
                                value="<?= mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?>" disabled>
                            <span class="chbox">
                                <?= mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?>
                            </span>
                            <input type="checkbox" class="chbox" id="" name="second_member_day"
                                value="<?= mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?>" disabled>
                            <span class="chbox"></span>
                            <?= mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?>
                            </span>
                            <input type="checkbox" class="chbox" id="" name="second_member_day"
                                value="<?= mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?>" disabled>
                            <span class="chbox"></span>
                            <?= mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="order_meal">訂餐需求</label>
                            <input type="checkbox" class="" name="need" id="second_member_order_meal" disabled>
                            <span>需訂餐</span>
                        </div>
                        <div class="form-group second_member_meal">
                            <label for="second_member_meal" class="" style="float:left;">餐別</label>
                            <select class="form-control" id="second_member_meal" disabled>
                                <option value="葷">葷</option>
                                <option value="素">素</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3 cube W20">
                        <div class="form-group">
                            <label for="start_date" class="" style="float:left;">天數/節數</label>
                            <input type="hidden" class="form-control" id="second_member_day_count" readonly>
                            <input type="text" class="form-control" id="second_member_section_count" readonly>
                        </div>
                        <div class="form-group" style="padding: 0% 3%;">
                            <div class="W50">
                                <label for="trial_start" class="" style="float:left;width: 50%;">薪資單價</label>
                                <input type="hidden" class="form-control" id="second_member_one_day_salary"
                                    value="<?= $fees_info['one_day_salary']; ?>">
                                <input type="text" class="form-control" id="second_member_salary_section"
                                    value="<?= $fees_info['salary_section']; ?>" disabled>
                            </div>
                            <div class="W50">
                                <label for="trial_start" class="" style="float:left;width: 50%;">薪資總計</label>
                                <input type="hidden" class="form-control" id="second_member_day_salary_total" value="0"
                                    readonly>
                                <input type="text" class="form-control" id="second_member_section_salary_total"
                                    value="0" readonly>
                            </div>
                        </div>
                        <div class="form-group" style="padding: 0% 3%;">
                            <div class="W50">
                                <label for="trial_start" class="" style="float:left;width: 50%;">便當費 </label>
                                <input type="text" class="form-control" id="second_member_lunch_price"
                                    value="<?= $fees_info['lunch_fee']; ?>" disabled>
                            </div>
                            <div class="W50">
                                <label for="trial_start" class="" style="float:left;width: 50%;">便當總計</label>
                                <input type="hidden" class="form-control" id="second_member_day_lunch_total" value="0"
                                    readonly>
                                <input type="text" class="form-control" id="second_member_section_lunch_total" value="0"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trial_end" class="" style="float:left;">總計</label>
                            <input type="hidden" class="form-control" id="second_member_day_total" value="0">
                            <input type="text" class="form-control" id="second_member_section_total" value="0" readonly>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12" style="float: left;margin: 50px auto 0;">
                        <div class="form-group" style="text-align:right">
                            <div class="">
                                <button type="button" class="btn btn-primary send">修改</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>