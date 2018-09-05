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
            $("#field").val("");
            $("#section").val("");
            $("#start").val("");
            $("#end").val("");
            $("#number").val("");
            $("#floor").val("");
            $("#trial_staff_code_1").val("");
            $("#supervisor_1").val("");
            $("#supervisor_1_code").val("");
            $("#trial_staff_code_2").val("");
            $("#supervisor_2").val("");
            $("#supervisor_2_code").val("");
            $("#note").val("");            
            console.log(newHash);
            if (nowHtml == "d_1") {
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
                location.href = './designated/d_1' + newHash;
                $('#part' + newHash).show();
            }
        })            

        $(window).on("load", function() {
            var addr = $("#addr").val();
            // console.log(arr);
            if (addr == "") {
                alert("目前 C1 考試地址尚未填寫資料，請先填寫資料再進行操作");
                location.href = "./designated/c_4";
            }
        })

        /**自動完成 */
        var data;
        $.getJSON("./api/get_member_info", function(data) {
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

        //     // //點擊先做還原動作
        //     // $(".tab").removeClass("active");
        //     // $(".part").hide();
        //     // // 點擊到的追加active以及打開相對應table
        //     // $this.addClass("active");
        //     // var area = $this.attr("area");
        //     // $("#part" + area).show();
        // })

        // 監試人員一指派動作 
        $("body").on("click", "#sure1", function() {
            var arr = $("#number_1").val().split(" - ");
            chk_code_use(arr[0],function(params) {
                if(params){
                    $("#supervisor_1").val(arr[1]);
                    $("#supervisor_1_code").val(arr[0]);
                    $('#exampleModal1').modal('hide');
                }
            })
        })
        // 監試人員二指派動作 
        $("body").on("click", "#sure2", function() {
            var arr = $("#number_2").val().split(" - ");
            chk_code_use(arr[0],function(params) {
                if(params){
                    $("#supervisor_2").val(arr[1]);
                    $("#supervisor_2_code").val(arr[0]);
                    $('#exampleModal2').modal('hide');
                }
            })
        })
        /**
        * 檢查監試人員是否指派過
        */
        function chk_code_use(code,callback){
            $.getJSON("./api/chk_trial_assigned",{
                code:code
                },
                function (data) {
                    if(data.sys_code != "200"){
                        alert(data.sys_msg);
                        return callback(false);
                    }else{
                        return callback(true);
                    }
                }
            );
        }


        $("body").on("click", "tr", function() {
            var sn = $(this).attr("sn");
            var part = $(this).attr("part");
            $("#part").val(part);
            $("html, body").animate({
                scrollTop: $("body").height()
            }, 1000);
            $.ajax({
                url: 'api/get_once_part',
                data: {
                    "sn": sn,
                },
                dataType: "json"
            }).done(function(data) {
                $("#sn").val(sn);
                $("#field").val(data.info.field);
                $("#start").val(data.info.start);
                $("#end").val(data.info.end);
                $("#floor").val(data.info.floor);
                $("#number").val(data.info.number);
                $("#section").val(data.info.test_section);
                $("#trial_staff_code_1").val();
                //監試人員編號第一碼產生

                switch (part) {
                    case "2501":
                        var c1 = "1";
                        break;
                    case "2502":
                        var c1 = "2";
                        break;
                    case "2503":
                        var c1 = "3";
                        break;
                }
                //監試人員編號第二碼產生
                var c2 = data.info.field.substring(3, 6);
                console.log(c2);
                $("#trial_staff_code_1").val(c1 + c2 + "1");
                $("#trial_staff_code_2").val(c1 + c2 + "2");

                //取得監試人員資料
                $.ajax({
                    url: 'api/get_once_assign',
                    data: {
                        "sn": sn,
                    },
                    dataType: "json"
                }).done(function(data) {
                    console.log(data.info);
                    $("#supervisor_1").val(data.info.supervisor_1);
                    $("#supervisor_2").val(data.info.supervisor_2);
                    $("#supervisor_1_code").val(data.info.supervisor_1_code);
                    $("#supervisor_2_code").val(data.info.supervisor_2_code);
                    $("#note").val(data.info.note);
                })
            })
        })

        $("body").on("click", "#send", function() {
            if (confirm("是否要儲存?")) {
                var sn = $("#sn").val();
                var part = $("#part").val();
                var supervisor_1 = $("#supervisor_1").val();
                var supervisor_1_code = $("#supervisor_1_code").val();
                var supervisor_2 = $("#supervisor_2").val();
                var supervisor_2_code = $("#supervisor_2_code").val();
                var trial_staff_code_1 = $("#trial_staff_code_1").val();
                var trial_staff_code_2 = $("#trial_staff_code_2").val();
                var note = $("textarea[name='note']").val();
                console.log(sn);
                $.ajax({
                    url: 'api/save_trial',
                    data: {
                        "sn": sn,
                        "part": part,
                        "supervisor_1": supervisor_1,
                        "supervisor_1_code": supervisor_1_code,
                        "supervisor_2": supervisor_2,
                        "supervisor_2_code": supervisor_2_code,
                        "trial_staff_code_1": trial_staff_code_1,
                        "trial_staff_code_2": trial_staff_code_2,
                        "note": note
                    },
                    dataType: "json"
                }).done(function(data) {
                    alert(data.sys_msg);
                    if (data.sys_code == "200") {
                        // location.reload();
                        console.log(note);
                        $("tr").each(function(){
                            if($(this).attr("sn") == $("#sn").val()){
                                $(this).find("td").eq(7).text(trial_staff_code_1);
                                $(this).find("td").eq(8).text(supervisor_1)
                                $(this).find("td").eq(9).text(trial_staff_code_2)
                                $(this).find("td").eq(10).text(supervisor_2)
                                $(this).find("td").eq(11).text(note)
                            }
                        })
                    }
                })
            }
        })

        $("body").on("click","#remove",function(){
            if (confirm("是否要取消指派?")) {
                var sn = $("#sn").val();
                console.log(sn);
                $.ajax({
                    url: 'api/remove_trial',
                    data: {
                        "sn": sn,
                        "supervisor_1": " ",
                        "supervisor_1_code": " ",
                        "supervisor_2": " ",
                        "supervisor_2_code": " ",
                        "trial_staff_code_1": " ",
                        "trial_staff_code_2": " ",
                        "first_member_order_meal":" ",
                        "first_member_meal":" ",
                        "second_member_order_meal":" ",
                        "second_member_meal":" ",  
                        "first_member_do_date":" ",
                        "first_member_day_count":" ",
                        "first_member_salary_section":" ",
                        "first_member_section_salary_total":" ",
                        "first_member_lunch_price":" ",
                        "first_member_section_lunch_total":" ",
                        "first_member_section_total":" ",
                        "second_member_do_date":" ",
                        "second_member_day_count":" ",
                        "second_member_salary_section":" ",
                        "second_member_section_salary_total":" ",
                        "second_member_lunch_price":" ",
                        "second_member_section_lunch_total":" ",
                        "second_member_section_total":" ",
                        "note": " "
                    },
                    dataType: "json"
                }).done(function(data) {
                    alert(data.sys_msg);
                    if (data.sys_code == "200") {
                        // location.reload();
                        $("tr").each(function(){
                            if($(this).attr("sn") == $("#sn").val()){
                                $(this).find("td").eq(7).text("");
                                $(this).find("td").eq(8).text("")
                                $(this).find("td").eq(9).text("")
                                $(this).find("td").eq(10).text("")
                                $(this).find("td").eq(11).text("")
                            }
                        })
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
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>"
            readonly>

    </div>

    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/d1_title.png" alt="" style="width: 15%;">
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
                <?php foreach ($part1 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>" part="2501">
                    <td>
                        <?=$k + 1; ?>
                    </td>
                    <td>
                        <?=$v['field']; ?>
                    </td>
                    <td>
                        <?=$v['test_section']; ?>
                    </td>
                    <td>
                        <?=$v['start']; ?>
                    </td>
                    <td>
                        <?=$v['end']; ?>
                    </td>
                    <td>
                        <?=$v['number']; ?>
                    </td>
                    <td>
                        <?=$v['floor']; ?>
                    </td>
                    <td>
                        <?=$v['trial_staff_code_1']; ?>
                    </td>
                    <td>
                        <?=$v['supervisor_1']; ?>
                    </td>
                    <td>
                        <?=$v['trial_staff_code_2']; ?>
                    </td>
                    <td>
                        <?=$v['supervisor_2']; ?>
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
                <?php foreach ($part2 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>" part="2502">
                    <td>
                        <?=$k + 1; ?>
                    </td>
                    <td>
                        <?=$v['field']; ?>
                    </td>
                    <td>
                        <?=$v['test_section']; ?>
                    </td>
                    <td>
                        <?=$v['start']; ?>
                    </td>
                    <td>
                        <?=$v['end']; ?>
                    </td>
                    <td>
                        <?=$v['number']; ?>
                    </td>
                    <td>
                        <?=$v['floor']; ?>
                    </td>
                    <td>
                        <?=$v['trial_staff_code_1']; ?>
                    </td>
                    <td>
                        <?=$v['supervisor_1']; ?>
                    </td>
                    <td>
                        <?=$v['trial_staff_code_2']; ?>
                    </td>
                    <td>
                        <?=$v['supervisor_2']; ?>
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
                <?php foreach ($part3 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>" part="2503">
                    <td>
                        <?=$k + 1; ?>
                    </td>
                    <td>
                        <?=$v['field']; ?>
                    </td>
                    <td>
                        <?=$v['test_section']; ?>
                    </td>
                    <td>
                        <?=$v['start']; ?>
                    </td>
                    <td>
                        <?=$v['end']; ?>
                    </td>
                    <td>
                        <?=$v['number']; ?>
                    </td>
                    <td>
                        <?=$v['floor']; ?>
                    </td>
                    <td>
                        <?=$v['trial_staff_code_1']; ?>
                    </td>
                    <td>
                        <?=$v['supervisor_1']; ?>
                    </td>
                    <td>
                        <?=$v['trial_staff_code_2']; ?>
                    </td>
                    <td>
                        <?=$v['supervisor_2']; ?>
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
                <div style=width:100%;float:left;>
                    <div class="col-md-3 col-sm-3 col-xs-3 cube">
                        <div class="form-group">
                            <label for="field" class="" style="float:left;">試場</label>
                            <input type="text" class="form-control" id="field" readonly>
                            <input type="hidden" class="form-control" id="sn">
                            <input type="hidden" class="form-control" id="part">
                        </div>
                        <div class="form-group">
                            <label for="section" class="" style="float:left;">考試節數</label>
                            <input type="text" class="form-control" id="section" readonly>
                        </div>
                        <div class="form-group">
                            <label for="start" class="" style="float:left;">考生應試號起</label>
                            <input type="text" class="form-control" id="start" readonly>
                        </div>
                        <div class="form-group">
                            <label for="end" class="" style="float:left;">考生應試號迄</label>
                            <input type="text" class="form-control" id="end" readonly>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3 cube">
                        <div class="form-group">
                            <label for="number" class="" style="float:left;">應試人數</label>
                            <input type="text" class="form-control" id="number" readonly>
                        </div>
                        <div class="form-group">
                            <label for="floor" class="" style="float:left;">樓層別</label>
                            <input type="text" class="form-control" id="floor" readonly>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3 cube" style="background:#afccf0"> 
                        <div class="form-group" style="width: 100%;float: left;">
                            <label for="number" class="" style="float:left;">監試人員一</label>
                            <input type="text" class="form-control" id="trial_staff_code_1" style="width: 25%;margin: 0px 4px;float: left;" placeholder="監試人員編號" readonly>
                            <input type="text" class="form-control" id="supervisor_1" style="width: 25%;float: left;">
                            <input type="hidden" class="form-control" id="supervisor_1_code">
                            <button type="button" class="btn btn-primary assgin" data-toggle="modal" data-target="#exampleModal1" style="float:left;width:15%;margin-left:5px;background:#346a90;border:unset">指派</button>
                        </div>
                        <div class="form-group" style="width: 100%;float: left;">
                            <label for="floor" class="" style="float:left;">監試人員二</label>
                            <input type="text" class="form-control" id="trial_staff_code_2" style="width: 25%;margin: 0px 4px;float: left;" placeholder="監試人員編號" readonly>
                            <input type="text" class="form-control" id="supervisor_2" style="width: 25%;float: left;">
                            <input type="hidden" class="form-control" id="supervisor_2_code">
                            <button type="button" class="btn btn-primary assgin" data-toggle="modal" data-target="#exampleModal2" style="float:left;width:15%;margin-left:5px;background:#346a90;border:unset">指派</button>
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
                            <button type="button" class="btn btn-danger" id="remove">取消指派</button>
                            <button type="button" class="btn btn-primary" id="send">修改</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal start-->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
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
                                        <input type="text" class="typeahead" id="number_1">
                                    </p>
                                </div>
                            </div>
                            <div class="" style="text-align: right;margin: 20px;">
                                <button type="button" class="btn btn-primary" id="sure1">確定指派</button>
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
<!-- Modal start-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
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
                                        <input type="text" class="typeahead" id="number_2">
                                    </p>
                                </div>
                            </div>
                            <div class="" style="text-align: right;margin: 20px;">
                                <button type="button" class="btn btn-primary" id="sure2">確定指派</button>
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
<!-- Modal start-->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
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
                                        <input type="text" class="typeahead" id="number_3">
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