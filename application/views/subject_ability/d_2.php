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
        max-width: 35%;
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
        width: 25%;
    }

    .form-control {
        display: block;
        width: 75%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, boxs-shadow .15s ease-in-out;
    }

    .form-group {
        margin-bottom: 1rem;
        padding-right: 0%;
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

    .table thead th {
        vertical-align: middle;
        border-bottom: 0;

    }

    .table td,
    .table th {
        padding: .75rem;
        vertical-align: top;
        border-top: 0;
    }

    .bt {
        border-top: 1px solid #dee2e6 !important;
    }

    .bb {
        border-bottom: 1px solid #dee2e6 !important;
    }

    tr {
        cursor: pointer;
    }
</style>

<script>
    $(function() {

        $(window).on("load", function() {
            var addr = $("#addr").val();
            // console.log(arr);
            if (addr == "") {
                alert("目前 C6 考試地址尚未填寫資料，請先填寫資料再進行操作");
                location.href = "./subject_ability/c_4";
            }



            $("#send").attr('disabled',true);
            $("#remove").attr('disabled',true);
            $("#fresh").attr('disabled',true);
            $("#add").attr('disabled',false);
        })


         $("body").on("click", "#fresh", function() {
            location.reload();
        })

        //tab設定
        var nowHash = location.hash; //取得loading進來後目前#
        var nowTabNum = nowHash.slice(-1);
        var nowHtml = location.pathname.split("/").pop();
        console.log(nowHash);
        var part;
        switch (nowHash) {
            case "#1":
                part = '2501';
                break;
            case "#2":
                part = '2502';
                break;
            case "#3":
                part = '2503'
                break;                
        }
        $.ajax({
            url: './subject_ability/api/get_part',
            data: {
                "part": part,
            },
            dataType: "json"
        }).done(function(data) {
            var html = "";
            console.log(data);
            $.each(data.part, function(k, v) {
                html += '<option value="' + v.field + '">' + v.field + '</option>';
            })
            $(".field").html(html);
        })            
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
            console.log(part);

        }    

        $("body").on("click", ".tab", function(e) {
            e.preventDefault();
            var newHash = $(this).attr("area"); //點到的id
            console.log(newHash);
            var part = $(this).attr("part");
            $("#part").val(part);
            //點擊先做還原動作
            $("#sn").val("");
            $("#allocation_code").val("");
            $("#trial_staff_code").val("");
            $("#trial_staff_name").val("");
            $("#first_section").val("0");
            $("#second_section").val("0");
            $("#third_section").val("0");
            $("textarea[name='note']").val("");
            $.ajax({
                url: './subject_ability/api/get_part',
                data: {
                    "part": part,
                },
                dataType: "json"
            }).done(function(data) {
                var html = "";
                $.each(data.part, function(k, v) {

                    html += '<option value="' + v.field + '">' + v.field + '</option>';
                })
                $(".field").html(html);
            })            
            if (nowHtml == "d_2") {
                //開闔div
                $(".part").hide();
                $('#part' + newHash).show();
                //tab樣式
                $(".tab").removeClass('active');
                $(this).addClass('active');
                location.hash = '#' + newHash;
            } else {
                location.href = './subject_ability/d_2' + newHash;
                $('#part' + newHash).show();
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

        $("body").on("click", "#sure3", function() {
            var code = $(".typeahead").val().split("-");
            console.log(code);
            $("#allocation_code").val(code[0]);
            $("#trial_staff_name").val(code[1]);
            $('#exampleModal').modal('hide');
        })

        // $(".part").eq(0).show();
        // $("body").on("click", ".tab", function() {
        //     var part = $(this).attr("part");
        //     var $this = $(this);

        // })


        $("body").on("click", "tr", function() {
            
            $("#send").attr('disabled',false);
            $("#remove").attr('disabled',false);
            $("#fresh").attr('disabled',false);
            $("#add").attr('disabled',true);

            var sn = $(this).attr("sn");
            var part = $(this).attr("part");
            $("html, body").animate({
                scrollTop: $("body").height()
            }, 1000);
            $.ajax({
                url: './subject_ability/api/get_once_trial',
                data: {
                    "sn": sn,
                },
                dataType: "json"
            }).done(function(data) {
                console.log(data.info);
                $("#sn").val(sn);
                $("#part").val(part);
                $("#allocation_code").val(data.info.allocation_code);
                $("#trial_staff_code").val(data.info.trial_staff_code);
                $("#trial_staff_name").val(data.info.trial_staff_name);
                $("#first_start").val(data.info.first_start);
                $("#first_end").val(data.info.first_end);
                $("#first_section").val(data.info.first_section);
                $("#second_start").val(data.info.second_start);
                $("#second_end").val(data.info.second_end);
                $("#second_section").val(data.info.second_section);
                $("#third_start").val(data.info.third_start);
                $("#third_end").val(data.info.third_end);
                $("#third_section").val(data.info.third_section);
                $("#note").val(data.info.note);
            })
            var part = $(this).attr("part");
            $.ajax({
                url: './subject_ability/api/get_patrol_list',
                data: {
                    "part": part,
                },
                dataType: "json"
            }).done(function(data) {
                var html = "";
                $.each(data.info, function(k, v) {
                    html += '<option value="' + v.field + '">' + v.field + '</option>';
                })
                $("#start").html(html);
                $("#end").html(html);
            })
        })

        $("body").on("change", ".field1", function() {
            var start = $("#first_start").val();
            var end = $("#first_end").val();
            var day = $("#day1").val();
            console.log(day);
            $.ajax({
                url: './subject_ability/api/get_once_day_section',
                data: {
                    "day": day,
                    "start": start,
                    "end": end,
                },
                dataType: "json"
            }).done(function(data) {
                console.log(data);
                $("#first_section").val(data.section);
            })
        })

        $("body").on("change", ".field2", function() {
            var start = $("#second_start").val();
            var end = $("#second_end").val();
            var day = $("#day2").val();
            console.log(day);
            $.ajax({
                url: './subject_ability/api/get_once_day_section',
                data: {
                    "day": day,
                    "start": start,
                    "end": end,
                },
                dataType: "json"
            }).done(function(data) {
                console.log(data);
                $("#second_section").val(data.section);
            })
        })

        $("body").on("change", ".field3", function() {
            var start = $("#third_start").val();
            var end = $("#third_end").val();
            var day = $("#day3").val();
            console.log(day);
            $.ajax({
                url: './subject_ability/api/get_once_day_section',
                data: {
                    "day": day,
                    "start": start,
                    "end": end,
                },
                dataType: "json"
            }).done(function(data) {
                $("#third_section").val(data.section);
            })
        })

        // $("body").on("change",".field_start",function(){
        //     $(".field_start").each(function(){
        //         $('.field_start').val($(this).val());
        //     })
        // })

        // $("body").on("change",".field_end",function(){
        //     $(".field_end").each(function(){
        //         $('.field_end').val($(this).val());
        //     })
        // })

        $("body").on("click", "#send", function() {
            if (confirm("是否要儲存?")) {
                var sn = $("#sn").val();
                var part = $("#part").val();
                var allocation_code = $("#allocation_code").val();
                var trial_staff_code = $("#trial_staff_code").val();
                var trial_staff_name = $("#trial_staff_name").val();
                var first_start = $("#first_start").val();
                var first_end = $("#first_end").val();
                var first_section = $("#first_section").val();
                var second_start = $("#second_start").val();
                var second_end = $("#second_end").val();
                var second_section = $("#second_section").val();
                var third_start = $("#third_start").val();
                var third_end = $("#third_end").val();
                var third_section = $("#third_section").val();
                var note = $("textarea[name='note']").val();
                console.log(sn);
                $.ajax({
                    url: './subject_ability/api/save_trial_staff',
                    data: {
                        "sn": sn,
                        "part": part,
                        "allocation_code": allocation_code,
                        "trial_staff_code": trial_staff_code,
                        "trial_staff_name": trial_staff_name,
                        "first_start": first_start,
                        "first_end": first_end,
                        "first_section": first_section,
                        "second_start": second_start,
                        "second_end": second_end,
                        "second_section": second_section,
                        "third_start": third_start,
                        "third_end": third_end,
                        "third_section": third_section,
                        "note": note
                    },
                    dataType: "json"
                }).done(function(data) {
                    alert(data.sys_msg);
                    if (data.sys_code == "200") {
                        // location.reload();
                        $("tr").each(function(){
                            if($(this).attr("sn") == $("#sn").val()){
                                $(this).find("td").eq(1).text(allocation_code);
                                $(this).find("td").eq(2).text(trial_staff_name)
                                $(this).find("td").eq(3).text(first_start)
                                $(this).find("td").eq(4).text(first_end)
                                $(this).find("td").eq(5).text(first_section)
                                $(this).find("td").eq(6).text(second_start)
                                $(this).find("td").eq(7).text(second_end)
                                $(this).find("td").eq(8).text(second_section)
                                $(this).find("td").eq(9).text(third_start)
                                $(this).find("td").eq(10).text(third_end)
                                $(this).find("td").eq(11).text(third_section)
                                $(this).find("td").eq(12).text(note)
                            }
                        })
                    }
                })
            }
        })

        $("body").on("click", "#remove", function() {
            if (confirm("是否要取消指派?")) {
                var sn = $("#sn").val();
                $.ajax({
                    url: './subject_ability/api/remove_trial_staff',
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

        $("body").on("click", "#add", function() {
            if ($("#sn").val() != "") {
                if (confirm("目前處於編輯狀態，若要新增，將會清空所有欄位")) {
                    $("#sn").val("")
                    $("#allocation_code").val("")
                    $("#trial_staff_code").val("")
                    $("#trial_staff_name").val("")
                    $("#first_section").val("0");
                    $("#second_section").val("0");
                    $("#third_section").val("0");
                    $("textarea[name='note']").val("");
                }
            } else {
                var part = $("#part").val();
                var allocation_code = $("#allocation_code").val();
                var trial_staff_code = $("#allocation_code").val();
                var trial_staff_name = $("#trial_staff_name").val();
                var first_start = $("#first_start").val();
                var first_end = $("#first_end").val();
                var first_section = $("#first_section").val();
                var second_start = $("#second_start").val();
                var second_end = $("#second_end").val();
                var second_section = $("#second_section").val();
                var third_start = $("#third_start").val();
                var third_end = $("#third_end").val();
                var third_section = $("#third_section").val();
                var note = $("textarea[name='note']").val();
                var arr  = [];
                $(".day").each(function(){
                    // if($(this).val() != 0){
                        arr.push($(this).attr("day"));
                    // }
                })
                var do_date = arr.join(",");       
                console.log(do_date);         
                $.ajax({
                    url: './subject_ability/api/add_trial_staff',
                    data: {
                        "part": part,
                        "allocation_code": allocation_code,
                        "trial_staff_code": trial_staff_code,
                        "trial_staff_name": trial_staff_name,
                        "first_start": first_start,
                        "first_end": first_end,
                        "first_section": first_section,
                        "second_start": second_start,
                        "second_end": second_end,
                        "second_section": second_section,
                        "third_start": third_start,
                        "third_end": third_end,
                        "third_section": third_section,
                        "note": note,
                        "do_date":do_date
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
    });
</script>

<div class="row">
    <div class="input-group col-sm-2">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $this->session->userdata('year'); ?>"
            readonly>

    </div>

    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/d2_title.png" alt="" style="width: 15%;">
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
        <div class="tab tab3" area="4" part="2504" eng="fourth">
            <div class="tab_text">第四分區</div>
        </div>
        <div class="tab tab3" area="5" part="2505" eng="fifth">
            <div class="tab_text">第五分區</div>
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
                    <th colspan="3" class="bb">第一天</th>
                    <th colspan="3" class="bb">第二天</th>
                    <th colspan="3" class="bb">第三天</th>
                    <th rowspan="2">備註</th>
                </tr>
                <tr>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part1 as $k => $v) : ?>
                <tr sn="<?= $v['sn']; ?>" part="<?= $v['part']; ?>">
                    <td class="bt">
                        <?= $k + 1; ?>
                    </td>
                    <td class="bt">
                        <?= $v['allocation_code']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['trial_staff_name']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_section']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_section']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_section']; ?>
                    </td>
                    <td class="bt">
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
        <table class="table table-hover" id="" style="text-align:center">
            <thead>
                <tr>
                    <th rowspan="2">序號</th>
                    <th rowspan="2">管卷人員編號</th>
                    <th rowspan="2">管卷人員</th>
                    <th colspan="3" class="bb">第一天</th>
                    <th colspan="3" class="bb">第二天</th>
                    <th colspan="3" class="bb">第三天</th>
                    <th rowspan="2">備註</th>
                </tr>
                <tr>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part2 as $k => $v) : ?>
                <tr sn="<?= $v['sn']; ?>" part="<?= $v['part']; ?>">
                    <td class="bt">
                        <?= $k + 1; ?>
                    </td>
                    <td class="bt">
                        <?= $v['allocation_code']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['trial_staff_name']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_section']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_section']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_section']; ?>
                    </td>
                    <td class="bt">
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
        <table class="table table-hover" id="" style="text-align:center">
            <thead>
                <tr>
                    <th rowspan="2">序號</th>
                    <th rowspan="2">管卷人員編號</th>
                    <th rowspan="2">管卷人員</th>
                    <th colspan="3" class="bb">第一天</th>
                    <th colspan="3" class="bb">第二天</th>
                    <th colspan="3" class="bb">第三天</th>
                    <th rowspan="2">備註</th>
                </tr>
                <tr>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part3 as $k => $v) : ?>
                <tr sn="<?= $v['sn']; ?>" part="<?= $v['part']; ?>">
                    <td class="bt">
                        <?= $k + 1; ?>
                    </td>
                    <td class="bt">
                        <?= $v['allocation_code']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['trial_staff_name']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_section']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_section']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_section']; ?>
                    </td>
                    <td class="bt">
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
        <table class="table table-hover" id="" style="text-align:center">
            <thead>
                <tr>
                    <th rowspan="2">序號</th>
                    <th rowspan="2">管卷人員編號</th>
                    <th rowspan="2">管卷人員</th>
                    <th colspan="3" class="bb">第一天</th>
                    <th colspan="3" class="bb">第二天</th>
                    <th colspan="3" class="bb">第三天</th>
                    <th rowspan="2">備註</th>
                </tr>
                <tr>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part4 as $k => $v) : ?>
                <tr sn="<?= $v['sn']; ?>" part="<?= $v['part']; ?>">
                    <td class="bt">
                        <?= $k + 1; ?>
                    </td>
                    <td class="bt">
                        <?= $v['allocation_code']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['trial_staff_name']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_section']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_section']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_section']; ?>
                    </td>
                    <td class="bt">
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
        <table class="table table-hover" id="" style="text-align:center">
            <thead>
                <tr>
                    <th rowspan="2">序號</th>
                    <th rowspan="2">管卷人員編號</th>
                    <th rowspan="2">管卷人員</th>
                    <th colspan="3" class="bb">第一天</th>
                    <th colspan="3" class="bb">第二天</th>
                    <th colspan="3" class="bb">第三天</th>
                    <th rowspan="2">備註</th>
                </tr>
                <tr>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                    <td>試場號起</td>
                    <td>試場號迄</td>
                    <td>最大試節數</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part5 as $k => $v) : ?>
                <tr sn="<?= $v['sn']; ?>" part="<?= $v['part']; ?>">
                    <td class="bt">
                        <?= $k + 1; ?>
                    </td>
                    <td class="bt">
                        <?= $v['allocation_code']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['trial_staff_name']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['first_section']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['second_section']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_start']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_end']; ?>
                    </td>
                    <td class="bt">
                        <?= $v['third_section']; ?>
                    </td>
                    <td class="bt">
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
                <div class="col-md-3 col-sm-3 col-xs-3 cube" style="background:#afccf0">
                    <div class="form-group" style="width: 100%;float: left;">
                        <label for="floor" class="" style="float:left;">管卷人員</label>
                        <input type="hidden" class="form-control" id="sn">
                        <input type="text" class="form-control" id="allocation_code" style="width: 28%;float: left;" placeholder="管卷人員編號">
                        <input type="hidden" class="form-control" id="part" style="" placeholder="" value="2501">
                        <input type="hidden" class="form-control" id="trial_staff_code" style="width: 20%;float: left;" placeholder="">
                        <input type="text" class="form-control" id="trial_staff_name" style="width: 24%;float: left;margin-left: 5px;">
                        <button type="button" class="btn btn-primary assgin" data-toggle="modal" data-target="#exampleModal" style="float:left;width:20%;margin-left:5px;background:#346a90;border:unset">指派</button>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 cube" style="max-width: 20%;">
                    <p style="text-align:center">第一天
                        <?= $datetime_info['day_1']; ?>
                    </p>
                    <div class="form-group">
                        <label for="field" class="" style="float:left;">試場號起</label>
                        <input type="hidden" value="1" id="day1">
                        <select name="start" id="first_start" class="field field_start field1 form-control">
                            <?php foreach ($part as $k => $v) : ?>
                            <option value="<?= $v['field']; ?>" day="1">
                                <?= $v['field']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="section" class="" style="float:left;">試場號迄</label>
                        <select name="end" id="first_end" class="field field1 field_end form-control">
                            <?php foreach ($part as $k => $v) : ?>
                            <option value="<?= $v['field']; ?>" day="1">
                                <?= $v['field']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start" class="" style="float:left;">節數</label>
                        <input type="text" class="form-control day" id="first_section" value="0" readonly day="<?= mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?>">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 cube" style="max-width: 20%;">
                    <p style="text-align:center">第二天
                        <?= $datetime_info['day_2']; ?>
                    </p>
                    <div class="form-group">
                        <label for="field" class="" style="float:left;">試場號起</label>
                        <input type="hidden" value="2" id="day2">
                        <select name="start" id="second_start" class="field field_start field2 form-control">
                            <?php foreach ($part as $k => $v) : ?>
                            <option value="<?= $v['field']; ?>">
                                <?= $v['field']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="section" class="" style="float:left;">試場號迄</label>
                        <select name="end" id="second_end" class="field field2 field_end form-control">
                            <?php foreach ($part as $k => $v) : ?>
                            <option value="<?= $v['field']; ?>" day="2">
                                <?= $v['field']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start" class="" style="float:left;">節數</label>
                        <input type="text" class="form-control day" id="second_section" value="0" readonly day="<?= mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?>">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 cube" style="max-width: 20%;">
                    <p style="text-align:center">第三天
                        <?= $datetime_info['day_3']; ?>
                    </p>
                    <div class="form-group">
                        <label for="field" class="" style="float:left;">試場號起</label>
                        <input type="hidden" value="3" id="day3">
                        <select name="start" id="third_start" class="field field_start field3 form-control">
                            <?php foreach ($part as $k => $v) : ?>
                            <option value="<?= $v['field']; ?>" day="3">
                                <?= $v['field']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="section" class="" style="float:left;">試場號迄</label>
                        <select name="end" id="third_end" class="field field3 field_end form-control">
                            <?php foreach ($part as $k => $v) : ?>
                            <option value="<?= $v['field']; ?>" day="3">
                                <?= $v['field']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start" class="" style="float:left;">節數</label>
                        <input type="text" class="form-control day" id="third_section" value="0" readonly day="<?= mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?>">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 " style="float:left;margin: 20px auto;">
                    <div class="">
                        <div class="">
                            <label for="note" class="" style="float:left;text-align:left;width: 15%;text-align:center;">備註</label>
                            <textarea name="note" id="note" class="" style="width:500px"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6" style="float:left;margin: 20px auto;">
                    <div class="form-group" style="text-align:right">
                        <div class="">
                            <button type="button" class="btn btn-primary" id="add" style="position: relative;right: 5%">新增</button>
                            <button type="button" class="btn btn-warning" id="fresh" style="color: white;">取消修改</button>
                            <button type="button" class="btn btn-danger" id="remove">取消指派</button>
                            <button type="button" class="btn btn-primary" id="send" style="background:#346a90">修改</button>
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
                                    <p>關鍵字
                                        <input type="text" class="typeahead" id="number">
                                    </p>
                                </div>
                            </div>
                            <div class="" style="text-align: right;margin: 20px;">
                                <button type="button" class="btn btn-primary" id="sure3">確定指派</button>
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