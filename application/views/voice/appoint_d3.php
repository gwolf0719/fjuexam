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
        max-width: 32%;
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
        width: 65%;
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

        $(window).on("load", function() {
            var addr = $("#addr").val();
            // console.log(arr);
            if (addr == "") {
                alert("目前 C1 考試地址尚未填寫資料，請先填寫資料再進行操作");
                location.href = "./voice/assign_c4";
            }
        })

        //tab設定
        var nowHash = location.hash; //取得loading進來後目前#
        var nowTabNum = nowHash.slice(-1);
        var nowHtml = location.pathname.split("/").pop();
        console.log(nowTabNum);
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
            url: './voice/api/get_part',
            data: {
                "part": part,
            },
            dataType: "json"
        }).done(function(data) {
            var html = "";
            html = '<option value="">請選擇</option>';
            $.each(data.part, function(k, v) {
                html += '<option value="' + v.field + '">' + v.field + '</option>';
            })
            $("#start").html(html);
            $("#end").html(html);
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
        }    

        $("body").on("click", ".tab", function(e) {
            e.preventDefault();
            var newHash = $(this).attr("area"); //點到的id
            $("#sn").val("");
            $("#allocation_code").val("")
            $("#patrol_staff_code").val("");
            $("#patrol_staff_name").val("");
            $("#first_section").val("0");
            $("#second_section").val("0");
            $("textarea[name='note']").val("");
            $("#section").val(0);     

            console.log(newHash);
            if (nowHtml == "appoint_d3") {
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
                location.href = './voice/d/appoint_d3' + newHash;
                $('#part' + newHash).show();
            }
            var part = $(this).attr("part");
            $("#part").val(part);
            $.ajax({
                url: './voice/api/get_part',
                data: {
                    "part": part,
                },
                dataType: "json"
            }).done(function(data) {
                var html = "";
                html = '<option value="">請選擇</option>';
                $.each(data.part, function(k, v) {
                    html += '<option value="' + v.field + '">' + v.field + '</option>';
                })
                $("#start").html(html);
                $("#end").html(html);
            })            
        })              

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


        $("body").on("click", "#sure3", function() {
            var code = $(".typeahead").val().split("-");
            $("#patrol_staff_code").val(code[0]);
            $("#patrol_staff_name").val(code[1]);
            $('#exampleModal').modal('hide');
        })


        $("body").on("click", "tr", function() {
            var sn = $(this).attr("sn");
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
                $("#part").val(part);
                $("#allocation_code").val(data.info.allocation_code);
                $("#patrol_staff_code").val(data.info.patrol_staff_code);
                $("#patrol_staff_name").val(data.info.patrol_staff_name);
                $("#first_start").val(data.info.first_start);
                $("#first_end").val(data.info.first_end);
                $("#first_section").val(data.info.first_section);
                $("#second_start").val(data.info.second_start);
                $("#second_end").val(data.info.second_end);
                $("#second_section").val(data.info.second_section);
                $("#note").val(data.info.note);
            })

        })

        // $("body").on("change", ".field", function() {
        //     var start = $("#start").val();
        //     var end = $("#end").val();
        //     console.log(start);
        //     console.log(end);

        //     $.ajax({
        //         url: 'api/get_day_section',
        //         data: {
        //             "start": start,
        //             "end": end,
        //         },
        //         dataType: "json"
        //     }).done(function(data) {
        //         console.log(data);
        //         $("#section").val(data.section);
        //     })
        // })

        $("body").on("click", "#send", function() {
            if (confirm("是否要儲存?")) {
                var sn = $("#sn").val();
                var part = $("#part").val();
                var allocation_code = $("#allocation_code").val();
                var patrol_staff_code = $("#patrol_staff_code").val();
                var patrol_staff_name = $("#patrol_staff_name").val();
                var first_start = $("#first_start").val();
                var first_end = $("#first_end").val();
                var first_section = $("#first_section").val();
                var second_start = $("#second_start").val();
                var second_end = $("#second_end").val();
                var second_section = $("#second_section").val();
                var note = $("textarea[name='note']").val();
                console.log(part);
                $.ajax({
                    url: './voice/api/save_patrol_staff',
                    data: {
                        "sn": sn,
                        "part": part,
                        "allocation_code": allocation_code,
                        "patrol_staff_code": patrol_staff_code,
                        "patrol_staff_name": patrol_staff_name,
                        "first_start": first_start,
                        "first_end": first_end,
                        "first_section": first_section,
                        "second_start": second_start,
                        "second_end": second_end,
                        "second_section": second_section,
                        "note": note
                    },
                    dataType: "json"
                }).done(function(data) {
                    alert(data.sys_msg);
                    if (data.sys_code == "200") {
                        location.reload();
                        $("tr").each(function(){
                            if($(this).attr("sn") == $("#sn").val()){
                                $(this).find("td").eq(1).text(allocation_code);
                                $(this).find("td").eq(2).text(patrol_staff_name)
                                $(this).find("td").eq(4).text(first_end)
                                $(this).find("td").eq(5).text(first_section)
                                $(this).find("td").eq(6).text(second_start)
                                $(this).find("td").eq(7).text(second_end)
                                $(this).find("td").eq(8).text(second_section)
                                $(this).find("td").eq(9).text(note)
                            }
                        })                        
                    }
                })
            }
        })

        $("body").on("click", "#remove", function() {
            if (confirm("是否要取消指派?")) {
                var sn = $("#sn").val();
                console.log(sn);
                $.ajax({
                    url: 'api/remove_patrol_staff',
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
                    $("#sn").val("");
                    $("#allocation_code").val("");
                    $("#section").val("");
                    $("#patrol_staff_code").val("");
                    $("#patrol_staff_name").val("");
                    $("#first_section").val("0");
                    $("#second_section").val("0");
                    $("textarea[name='note']").val("");
                    $(".field").val("");
                }
            } else {
                var part = $("#part").val();
                var allocation_code = $("#allocation_code").val();
                var patrol_staff_code = $("#patrol_staff_code").val();
                var patrol_staff_name = $("#patrol_staff_name").val();
                var first_start = $("#first_start").val();
                var first_end = $("#first_end").val();
                var first_section = $("#first_section").val();
                var second_start = $("#second_start").val();
                var second_end = $("#second_end").val();
                var second_section = $("#second_section").val();
                var note = $("textarea[name='note']").val();
                $.ajax({
                    url: './voice/api/add_patrol_staff',
                    data: {
                        "part": part,
                        "allocation_code": allocation_code,
                        "patrol_staff_code": patrol_staff_code,
                        "patrol_staff_name": patrol_staff_name,
                        "first_start": first_start,
                        "first_end": first_end,
                        "first_section": first_section,
                        "second_start": second_start,
                        "second_end": second_end,
                        "second_section": second_section,
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

        
        // 點選擇上下午後 開關起訖節數控制
        $("body").on('click',"input[name=day]",function(){
            var block_val = $(this).val();
            var block_id = block_val+"_field";
            switch ($(this).prop("checked")) {
                case true:
                    $("#"+block_id).find('.field_start').attr('disabled',false);
                    $("#"+block_id).find('.field_end').attr('disabled',false);
                    $("#"+block_id).find('.day').val("1");
                    break;
                case false:
                    $("#"+block_id).find('.field_start').attr('disabled',true);
                    $("#"+block_id).find('.field_end').attr('disabled',true);
                    $("#"+block_id).find('.day').val("0");
                    break;
            }
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
        <img src="assets/images/d3_title.png" alt="" style="width: 15%;">
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
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>巡場人員編號</th>
                    <th>巡場人員</th>
                    <th>試場號起</th>
                    <th>試場號迄</th>
                    <th>最大試節數</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part1 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>" part="<?=$v['part']; ?>">
                    <td>
                        <?=$k + 1; ?>
                    </td>
                    <td>
                        <?=$v['allocation_code']; ?>
                    </td>
                    <td>
                        <?=$v['patrol_staff_name']; ?>
                    </td>
                    <td>
                        <?=$v['first_start']; ?>
                    </td>
                    <td>
                        <?=$v['first_end']; ?>
                    </td>
                    <td>
                        <?=$v['first_section']; ?>
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
<div class="row part" id="part2" style="height:700px;overflow: auto;">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>巡場人員編號</th>
                    <th>巡場人員</th>
                    <th>試場號起</th>
                    <th>試場號迄</th>
                    <th>最大試節數</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part2 as $k => $v): ?>
                    <tr sn="<?=$v['sn']; ?>" part="<?=$v['part']; ?>">
                        <td>
                            <?=$k + 1; ?>
                        </td>
                        <td>
                            <?=$v['allocation_code']; ?>
                        </td>
                        <td>
                            <?=$v['patrol_staff_name']; ?>
                        </td>
                        <td>
                            <?=$v['first_start']; ?>
                        </td>
                        <td>
                            <?=$v['first_end']; ?>
                        </td>
                        <td>
                            <?=$v['first_section']; ?>
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
<div class="row part" id="part3" style="height:700px;overflow: auto;">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>巡場人員編號</th>
                    <th>巡場人員</th>
                    <th>試場號起</th>
                    <th>試場號迄</th>
                    <th>最大試節數</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($part3 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>" part="<?=$v['part']; ?>">
                    <td>
                        <?=$k + 1; ?>
                    </td>
                    <td>
                        <?=$v['allocation_code']; ?>
                    </td>
                    <td>
                        <?=$v['patrol_staff_name']; ?>
                    </td>
                    <td>
                        <?=$v['first_start']; ?>
                    </td>
                    <td>
                        <?=$v['first_end']; ?>
                    </td>
                    <td>
                        <?=$v['first_section']; ?>
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
        <div class="col-md-12 col-sm-12 col-xs-12 ">
            <form method="POST" enctype="multipart/form-data" action="" id="form" class="">

                <div class="col-md-3 col-sm-3 col-xs-3 cube" style="background:#afccf0">
                    <div class="form-group" style="width: 100%;float: left;">
                        <label for="floor" class="" style="float:left;">巡場人員</label>
                        <input type="hidden" class="form-control" id="sn">
                        <input type="hidden" class="form-control" id="part" value="2501">
                        <input type="text" class="form-control" id="allocation_code" style="width: 25%;float: left;" placeholder="巡場人員編號">
                        <input type="hidden" class="form-control" id="patrol_staff_code" style="width: 20%;float: left;" placeholder="">
                        <input type="text" class="form-control" id="patrol_staff_name" style="width: 25%;float: left;margin-left: 5px;">
                        <button type="button" class="btn btn-primary assgin" data-toggle="modal" data-target="#exampleModal" style="float:left;width:15%;margin-left:5px;background:#346a90;border:unset">指派</button>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 cube" style="max-width: 20%; " id="morning_field"> 
                    <p style="text-align:center">上午場
                        <?=$datetime_info['day']; ?>
                    </p>
                    <div class="form-group" >
                        <label for="field" class="" style="float:left;">試場號起</label>
                        <input type="hidden" value="1" id="day1" >
                        <select name="start" id="first_start" class="field field_start field1 form-control" disabled="disabled">
                        <option value="">請選擇</option>
                            <?php foreach ($part as $k => $v): ?>
                            <option value="<?=$v['field']; ?>" day="1" >
                                <?=$v['field']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="section" class="" style="float:left;">試場號迄</label>
                        <select name="end" id="first_end" class="field field1 field_end form-control" disabled="disabled">
                        <option value="">請選擇</option>   
                            <?php foreach ($part as $k => $v): ?>
                            <option value="<?=$v['field']; ?>" day="1">
                                <?=$v['field']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start" class="" style="float:left;">節數</label>
                        <input type="text" class="form-control day" id="first_section" value="0" readonly day="<?=mb_substr($datetime_info['day'], 5, 8, 'utf-8'); ?>">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 cube" style="max-width: 20%; " id="aftermorning_field">
                   
                    <p style="text-align:center">下午場
                        <?=$datetime_info['day']; ?>
                    </p>
                    <div class="form-group">
                        <label for="field" class="" style="float:left;">試場號起</label>
                        <input type="hidden" value="1" id="day1">
                        <select name="start" id="second_start" class="field field_start field1 form-control" disabled="disabled">
                        <option value="">請選擇</option> 
                            <?php foreach ($part_aftermoon as $k => $v): ?>
                            <option value="<?=$v['field']; ?>" day="1">
                                <?=$v['field']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="section" class="" style="float:left;">試場號迄</label>
                        <select name="end" id="second_end" class="field field1 field_end form-control" disabled="disabled">
                        <option value="">請選擇</option>    
                            <?php foreach ($part_aftermoon as $k => $v): ?>
                            <option value="<?=$v['field']; ?>" day="1">
                                <?=$v['field']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start" class="" style="float:left;">節數</label>
                        <input type="text" class="form-control day" id="second_section" value="0" readonly day="<?=mb_substr($datetime_info['day'], 5, 8, 'utf-8'); ?>">
                    </div>
                </div>   
                <div class="col-md-3 col-sm-3 col-xs-3 cube">
                    <div class='form-group'>
                            <label for="start_date" class="" value="<?=$datetime_info['day'];?>">執行日</label>
                            <input type="checkbox" class="chbox" id="do_date" name="day" checked>
                            <span class="chbox"  >
                                <?=$datetime_info['day']; ?>
                            </span>
                    </div>
                    <div class="form-group">
                        <label for="floor" class="">場次</label>
                            <input type="checkbox" class="chbox" id='morning'  value="morning" name="day" >
                            <span class="chbox"  >
                                 上午場
                            </span>
                            <input type="checkbox" class="chbox" id='aftermorning' value="aftermorning" name="day"  >
                            <span class="chbox"  >
                                 下午場
                            </span>
                        </div>
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
                            <button type="button" class="btn btn-primary" id="add">新增</button>
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