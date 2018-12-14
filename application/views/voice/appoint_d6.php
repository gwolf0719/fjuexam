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
        background: #dacddf;
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
        width: 35%;
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
        /**自動完成 */
        var data;
        $.getJSON("./voice/api/get_member_info", function(data) {
            data = data.info;
            // console.log(data);
            var $input = $(".typeahead");
            $input.typeahead({
                source: data,
                autoSelect: true,
            });
        })

       //tab設定
        var nowHash = location.hash; //取得loading進來後目前#
        var nowTabNum = nowHash.slice(-1);
        var nowHtml = location.pathname.split("/").pop();
        console.log(nowTabNum);
        if (nowHash != "") {
            $(".part").hide();
            $('#part' + nowTabNum).show();
            $(".tab").removeClass('active');
            $('.tab' + nowTabNum).addClass('active');
        } else {
            //如果loading進來的網址沒有hash，判斷是不是tab頁面
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
            //點擊先做還原動作
            $("#sn").val("");
            $("#member_job_title").val("");
            $("#job_code").val("");
            $("#job_title").val("");
            $("#name").val("");
            $("#phone").val("");
            $('input[name="day"]').each(function() {
                for (let index = 0; index < 3; index++) {
                    $(this).prop("checked", false);
                }
            })
            $("#trial_start").val("");
            $("#trial_end").val("");
            $("#calculation").val("by_section");
            $("#order_meal").prop("checked", false);
            $("#section_count").val(0);
            $("#day_count").val(0)
            $("#salary_section").val(
                "<?=$fees_info['pay_1']; ?>");
            $("#one_day_salary").val(
                "<?=$fees_info['pay_1']; ?>");
            $("#day_salary_total").val(0);
            $("#section_salary_total").val(0);
            $("#lunch_price").val(0);
            $("#section_lunch_total").val(0);
            $("#day_lunch_total").val(0);
            $("#section_total").val(0);
            $("#day_total").val(0);
            console.log(newHash);
            if (nowHtml == "appoint_d6") {
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
                location.href = './voice/d/appoint_d6' + newHash;
                $('#part' + newHash).show();
            }
        })               


        $("body").on("click", "tr", function() {
            var sn = $(this).attr("sn");
            var code = $(this).attr("code");
            var part = $(this).attr("part");


            $("html, body").animate({
                scrollTop: $("body").height()
            }, 1000);
            $.ajax({
                url: './voice/api/get_once_patrol',
                data: {
                    "sn": sn,
                },
                dataType: "json"
            }).done(function(data) {
                console.log(data.info);
                $("#sn").val(sn);
                $("#first_start").val(data.info.first_start);
                $("#first_end").val(data.info.first_end);
                $("#first_section").val(data.info.first_section);
                $("#second_start").val(data.info.second_start);
                $("#second_end").val(data.info.second_end);
                $("#second_section").val(data.info.second_section);
                $("#note").val(data.info.note);
                var section_count = parseInt(data.info.first_section) + parseInt(data.info.second_section) ;
                var day_arr = [data.info.first_section, data.info.second_section];
                var count = day_arr.filter(function(value) {
                    return value != "0";
                });
                var uses_day_count = day_arr.length;
                console.log(data.info);
                
                //取得節數
                // $.ajax({
                //     url: './voice/api/get_day_section',
                //     data: {
                //         "start": data.info.start,
                //         "end": data.info.end,
                //     },
                //     dataType: "json"
                // }).done(function(data) {
                //     console.log(data.section);
                   
                //     // $("#section_count").val(data.section);
                // })
                switch (data.info.calculation) {
                    case "by_section":
                        $("#calculation").val("by_section");
                        $("#day_count").hide();
                        $("#one_day_salary").hide();
                        $("#day_salary_total").hide();
                        $("#day_total").hide();
                        $("#section_count").show();
                        $("#salary_section").show()
                        $("#section_salary_total").show();
                        $("#section_total").show();
                        $("#section_count").val(section_count);
                        $("#salary_section").val(data.info.salary);
                        $("#section_salary_total").val(data.info.salary_total);
                        // $("#section_total").val(data.info.total);
                        var section_salary_total = parseInt($("#salary_section").val()) *
                            parseInt($(
                                "#section_count").val());
                        $("#section_salary_total").val(section_salary_total);
                        var section_total = section_salary_total;
                        $("#section_total").val(section_total);
                        break;
                        break;
                    case "by_day":
                        $("#calculation").val("by_day");
                        $("#day_count").show();
                        $("#one_day_salary").show();
                        $("#day_salary_total").show();
                        $("#day_total").show();
                        $("#section_count").hide();
                        $("#salary_section").hide()
                        $("#section_salary_total").hide();
                        $("#section_total").hide();
                        $("#day_count").val(data.info.count);
                        $("#one_day_salary").val(data.info.salary);
                        $("#day_salary_total").val(data.info.salary_total);
                        $("#day_total").val(data.info.total);
                        break;
                    case "":
                        $("#calculation").val("by_section");
                        $("#section_count").show();
                        $("#salary_section").show()
                        $("#section_salary_total").show();
                        $("#section_lunch_total").show();
                        $("#section_total").show();
                        $("#day_count").hide();
                        $("#one_day_salary").hide();
                        $("#day_salary_total").hide();
                        $("#day_total").hide();
                        var section_salary_total = parseInt($("#salary_section").val()) * parseInt($("#section_count").val());
                            $("#section_salary_total").val(section_salary_total);
                            var section_total = section_salary_total;
                            $("#section_total").val(section_total);                            
                            var section_salary_total = parseInt($("#salary_section").val()) * parseInt($("#section_count").val());
                            $("#section_salary_total").val(section_salary_total);
                            var section_total = section_salary_total;
                            $("#section_total").val(section_total);                       


                        break;

                }
                //開始讀取天數
                // $.ajax({
                //     url: './voice/api/room_use_day',
                //     data: {
                //         "part": part,
                //         "start": $("#trial_start").val(),
                //         "end": $("#trial_end").val(),
                //     },
                //     dataType: "json"
                // }).done(function(data) {
                //     console.log(data.day);
                //     $('input:checkbox[name="day"]').eq(0).prop("checked", data.day[0]);
                //     $('input:checkbox[name="day"]').eq(1).prop("checked", data.day[1]);
                //     $('input:checkbox[name="day"]').eq(2).prop("checked", data.day[2]);
                //     var day_count = $('input:checkbox:checked[name="day"]').map(
                //         function() {
                //             return $(this).val();
                //         }).get().length;
                //     $("#day_count").val(day_count);
                //     var day_salary_total = parseInt($("#one_day_salary").val()) *
                //         parseInt($("#day_count").val());
                //     $("#day_salary_total").val(day_salary_total);
                //     if ($("#order_meal").val() == "N") {
                //         $("#day_total").val(day_salary_total);
                //     } else {
                //         var day_lunch_total = 0 - parseInt($("#lunch_price").val()) *
                //             parseInt($("#day_count").val());
                //         $("#day_lunch_total").val(day_lunch_total);
                //         var day_total = parseInt($("#day_salary_total").val()) +
                //             parseInt($("#day_lunch_total").val());
                //         $("#day_total").val(day_total);
                //     }
                // })
            })
            //取得職員資料     
            $.ajax({
                url: './voice/api/get_staff_member',
                data: {
                    "code": code,
                },
                dataType: "json"
            }).done(function(data) {
                $("#job_code").val(data.info.member_code);
                $("#job_title").val(data.info.member_title);
                $("#name").val(data.info.member_name);
                $("#phone").val(data.info.member_phone);
            })



        })

      

        $("body").on("click", "#send", function() {
          
            if (confirm("確定儲存修改資料？")) {
                var sn = $("#sn").val();
                var arr = $('input:checkbox:checked[name="day"]').map(function() {
                    return $(this).val();
                }).get();
                var do_date = arr.join(",");
                var calculation = $("#calculation").val();
                var count;
                var salary;
                var salary_total;
                var total;
                var note = $("textarea[name='note']").val();
                // if (calculation == "by_section") {
                //     count = $("#section_count").val();
                //     salary = $("#salary_section").val();
                //     salary_total = $("#section_salary_total").val()
                //     total = $("#section_total").val()
                // } else {
                //     count = $("#day_count").val();
                //     salary = $("#one_day_salary").val();
                //     salary_total = $("#day_salary_total").val()
                //     total = $("#day_total").val()
                // }
                $.ajax({
                    url: './voice/api/save_patrol_staff_for_list',
                    data: {
                        "sn": sn,
                        "do_date": do_date,
                        "count": $("#section_count").val(),
                        "salary": $("#salary_section").val(),
                        "salary_total":$("#section_salary_total").val(),
                        "total": $("#section_total").val(),
                        "note": note,
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

        $("input[name='day']").change(function() {
            var arr = $('input:checkbox:checked[name="day"]').map(function() {
                return $(this).val();
            }).get().length;
            $("#day_count").val(arr);
            var day_salary_total = parseInt($("#one_day_salary").val()) * parseInt(arr);
            $("#day_salary_total").val(day_salary_total);
                var day_total = day_salary_total ;
                $("#day_total").val(day_total);
            
        })

     
        $("body").on("keyup", "#one_day_salary", function() {
            console.log($(this).val());
            var day_salary_total = parseInt($(this).val()) * parseInt($("#day_count").val());
            $("#day_salary_total").val(day_salary_total);
                $("#day_total").val(day_salary_total);
                var day_total = day_salary_total;
                $("#day_total").val(day_total);
        })

        $("body").on("keyup", "#salary_section", function() {
            console.log($(this).val());
            var section_salary_total = parseInt($(this).val()) * parseInt($("#section_count").val());
            $("#section_salary_total").val(section_salary_total);
                $("#section_total").val(section_salary_total);
                var section_total = section_salary_total;
                $("#section_total").val(section_total);
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
        <img src="assets/images/d6_title.png" alt="" style="width: 20%;">
    </div>

</div>
<div class="row" style="position: relative;top: 20px;left: 10px;">
    <div style="width:95%;margin:5px auto;">
        <div class="tab tab1 active" area="1" part="2501">
            <div class="tab_text">第一分區</div>
        </div>
        <div class="tab tab2" area="2" part="2502">
            <div class="tab_text">第二分區</div>
        </div>
        <div class="tab tab3" area="3" part="2503">
            <div class="tab_text">第三分區</div>
        </div>
    </div>
</div>
<div class="row part" id="part1" style="height:700px;overflow: auto;">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="" style="text-align:center">
            <thead>
                <tr>
                    <th rowspan="2">序號</th>
                    <th rowspan="2">管卷人員編號</th>
                    <th rowspan="2">管卷人員</th>
                    <th colspan="3" class="bb">上午場</th>
                    <th colspan="3" class="bb">下午場</th>
                    <th rowspan="2">備註</th>
                </tr>
                <tr>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part1 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>" part="<?=$v['part']; ?>" code="<?=$v['patrol_staff_code']; ?>">
                    <td class="bt">
                        <?=$k + 1; ?>
                    </td>
                    <td class="bt">
                        <?=$v['allocation_code']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['patrol_staff_name']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['first_start']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['first_end']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['first_section']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['second_start']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['second_end']; ?>
                    </td>
                 
                    <td class="bt">
                        <?=$v['second_section']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['note']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row part" id="part2" style="height:700px;overflow: auto;">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="" style="text-align:center">
            <thead>
                <tr>
                    <th rowspan="2">序號</th>
                    <th rowspan="2">管卷人員編號</th>
                    <th rowspan="2">管卷人員</th>
                    <th colspan="3" class="bb">上午場</th>
                    <th colspan="3" class="bb">下午場</th>
                    <th rowspan="2">備註</th>
                </tr>
                <tr>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part2 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>" part="<?=$v['part']; ?>" code="<?=$v['patrol_staff_code']; ?>">
                    <td class="bt">
                        <?=$k + 1; ?>
                    </td>
                    <td class="bt">
                        <?=$v['allocation_code']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['patrol_staff_name']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['first_start']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['first_end']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['second_start']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['second_end']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['first_section']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['second_section']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['note']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row part" id="part3" style="height:700px;overflow: auto; " >
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="" style="text-align:center">
            <thead>
                <tr>
                    <th rowspan="2">序號</th>
                    <th rowspan="2">管卷人員編號</th>
                    <th rowspan="2">管卷人員</th>
                    <th colspan="3" class="bb">上午場</th>
                    <th colspan="3" class="bb">下午場</th>
                    <th rowspan="2">備註</th>
                </tr>
                <tr>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part3 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>" part="<?=$v['part']; ?>" code="<?=$v['patrol_staff_code']; ?>">
                    <td class="bt">
                        <?=$k + 1; ?>
                    </td>
                    <td class="bt">
                        <?=$v['allocation_code']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['patrol_staff_name']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['first_start']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['first_end']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['first_section']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['second_start']; ?>
                    </td>
                    <td class="bt">
                        <?=$v['second_end']; ?>
                    </td>
                 
                    <td class="bt">
                        <?=$v['second_section']; ?>
                    </td>
                    <td class="bt">
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
        <div class="col-md-12 col-sm-12 col-xs-12 " style="margin: 50px auto 0px;">
            <form method="POST" enctype="multipart/form-data" action="" id="form" class="">
                <div class="col-md-3 col-sm-3 col-xs-3 cube W14">
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
                <div class="col-md-3 col-sm-3 col-xs-3 cube W14">
                    <p style="text-align:center">上午場
                        <?=$datetime_info['day']; ?>
                    </p>
                    <div class="form-group">
                        <label for="trial_start" class="" style="float:left;">試場起號</label>
                        <input type="text" class="form-control" id="first_start" readonly>
                    </div>
                    <div class="form-group">
                        <label for="trial_end" class="" style="float:left;">試場迄號</label>
                        <input type="text" class="form-control" id="first_end" readonly>
                    </div>
                    <div class="form-group">
                        <label for="trial_end" class="" style="float:left;">最大節數</label>
                        <input type="text" class="form-control day" id="first_section" readonly day="<?=mb_substr($datetime_info['day'], 5, 8, 'utf-8'); ?>">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 cube W14">
                    <p style="text-align:center">下午場
                        <?=$datetime_info['day']; ?>
                    </p>
                    <div class="form-group">
                        <label for="trial_start" class="" style="float:left;">試場起號</label>
                        <input type="text" class="form-control" id="second_start" readonly>
                    </div>
                    <div class="form-group">
                        <label for="trial_end" class="" style="float:left;">試場迄號</label>
                        <input type="text" class="form-control" id="second_end" readonly>
                    </div>
                    <div class="form-group">
                        <label for="trial_end" class="" style="float:left;">最大節數</label>
                        <input type="text" class="form-control day" id="second_section" readonly day="<?=mb_substr($datetime_info['day'], 5, 8, 'utf-8'); ?>">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 cube W14">
                    <div class="form-group">
                        <label for="start_date" class="" style="float:left;">天數/節數</label>
                        <input type="text" class="form-control" style="display:none" id="day_count" readonly value="0">
                        <input type="text" class="form-control" id="section_count" readonly value="0">
                    </div>
                    <div class="form-group" style="padding: 0% 3%;">
                        <div class="W50">
                            <label for="trial_start" class="" style="float:left;width: 50%;">薪資單價</label>
                            <input type="text" class="form-control" id="one_day_salary" style="display:none" value="<?=$fees_info['pay_1']; ?>">
                            <input type="text" class="form-control" id="salary_section" value="<?=$fees_info['pay_1']; ?>">
                        </div>
                        <div class="W50">
                            <label for="trial_start" class="" style="float:left;width: 50%;">薪資總計</label>
                            <input type="text" class="form-control" id="day_salary_total" style="display:none" value="0" readonly>
                            <input type="text" class="form-control" id="section_salary_total" value="0" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="trial_end" class="" style="float:left;">總計</label>
                        <input type="text" class="form-control" id="day_total" style="display:none" value="0" readonly>
                        <input type="text" class="form-control" id="section_total" value="0" readonly>
                    </div>
                </div>
                    <div class=" " style="float:left;margin: 20px auto;">
                    <div class="">
                        <div class="">
                            <label for="note" class="" style="float:left;text-align:left;width: 15%;text-align:center;">備註</label>
                            <textarea name="note" id="note" class="" style="width:300px"></textarea>
                        </div>
                     
                  
                        <div class=" "style="float:left;margin: 20px auto;">
                            <button type="button" class="btn btn-primary" id="send">修改</button>
                        </div>
                   
                </div>
               
            </form>
        </div>
    </div>
</div>