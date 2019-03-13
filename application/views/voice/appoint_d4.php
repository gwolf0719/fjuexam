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
    function init(){
        
        $(".chbox").prop('checked',false);
        $("input[name=day]").prop('checked',true);
        $(".chbox").attr('disabled',true);
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
        $("#first_member_order_meal").prop("checked",false);
        $("#first_member_day_count").val('');
        $("#first_member_section_count").val('');
        $("#first_member_one_day_salary").val('');
        $("#first_member_salary_section").val('');
        $("#first_member_section_total").val('');
        $("#first_member_day_total").val('');
        $("#first_member_section_salary_total").val('');
        $("#second_member_job_code").val("");
        $("#second_member_job_title").val("");
        $("#second_member_name").val("");
        $("#second_member_phone").val("");
        $("#second_member_order_meal").prop("checked",false);
        $("#second_member_day_count").val('');
        $("#second_member_section_count").val('');
        $("#second_member_one_day_salary").val('');
        $("#second_member_salary_section").val('');
        $("#second_member_section_total").val('');
        $("#second_member_day_total").val('');
        $("#second_member_section_salary_total").val('');     
    }
    $(function() {
        init();
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
            init();
            // console.log(newHash);
            if (nowHtml == "appoint_d4") {
                //開闔div
                $(".part").hide();
                $('#part' + newHash).show();
                //tab樣式
                $(".tab").removeClass('active');
                $(this).addClass('active');
                location.hash = '#' + newHash;
            } else {
                location.href = './voice/d/appoint_d4' + newHash;
                $('#part' + newHash).show();
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

       
        // 點選列表
        $("body").on("click", "tr", function() {
            init();
            var section = $(this).attr("section");
            var sn = $(this).attr("sn");
            var part = $(this).attr("part");
            var field = $(this).attr("field");
            var block_names = $(this).attr("block_name");
            var tr = $(this);
            $("#sn").val(sn);
            // $("#first_member_section_count").val(section);
            // $("#second_member_section_count").val(section);

            $('#morning').prop("checked",false);
            $('#aftermorning').prop("checked",false);
                    
            $('#morning2').prop("checked",false);
            $('#aftermorning2').prop("checked",falsed);

            if(block_names==1){
                    $('#morning').prop("checked",true);
                    $('#morning2').prop("checked",true);
                }
                if(block_names==2){
                    $('#aftermorning').prop("checked",true);
                    $('#aftermorning2').prop("checked",true);
                }
                if(block_names==3){
                    $('#morning').prop("checked",true);
                    $('#aftermorning').prop("checked",true);
                    
                    $('#morning2').prop("checked",true);
                    $('#aftermorning2').prop("checked",true);


                }

            
            $("html, body").animate({
                scrollTop: $("body").height()
            }, 1000);
            $.ajax({
                url: './voice/api/get_once_assign',
                data: {
                    "field": field,
                },
                dataType: "json"
            }).done(function(data) {
                // console.log(data);
                $(".field").val(field);
                $("#sn").val(data.info.sn);
                //職員一
                $("#first_member_salary_section").val(data.info.first_member_salary_section);
                $("#first_member_section_salary_total").val(data.info.first_member_section_salary_total);
                
                $("#first_member_name").val(data.info.supervisor_1);
                $("#first_member_job_code").val(data.info.supervisor_1_code);
                $("#trial_staff_code_1").val(data.info.trial_staff_code_1);
                // console.log(tr.find('td').eq(2).text());
                var block_names= tr.find('td').eq(2).text();

                

                //職員二
                $("#second_member_day_count").val(data.info.second_member_day_count);
                $("#second_member_salary_section").val(data.info.second_member_salary_section);
                $("#second_member_section_salary_total").val(data.info.second_member_section_salary_total);
                
                $("#second_member_name").val(data.info.supervisor_2);
                $("#second_member_job_code").val(data.info.supervisor_2_code);
                $("#trial_staff_code_2").val(data.info.trial_staff_code_2);
                var block_names_2 = tr.find('td').eq(2).text().split(',');
                if(block_names_2.indexOf('上午場') >= 0){
                    $('.block').eq(2).prop("checked",true);
                }
                if(block_names_2.indexOf('下午場') >= 0){
                    $('.block').eq(3).prop("checked",true);
                }
                $("#second_member_section_count").val(block_names_2.length);
                $("#second_member_section_total").val(block_names_2.length*data.info.second_member_section_total);
                
                // 取得職員一資料
                if(data.info.supervisor_1_code != ""){
                    $.ajax({
                        url: './voice/api/get_staff_member',
                        data: {
                            "code": data.info.supervisor_1_code,
                        },
                        dataType: "json"
                    }).done(function(member) {
                        // console.log(member);
                        $("#first_member_job_title").val(member.info.member_title);
                        $("#first_member_phone").val(member.info.member_phone);
                    })
                }
                
                // // 取得職員二資料
                if(data.info.supervisor_2_code != ""){
                    $.ajax({
                        url: './voice/api/get_staff_member',
                        data: {
                            "code": data.info.supervisor_2_code,
                        },
                        dataType: "json"
                    }).done(function(data) {
                        // console.log(data);
                        $("#second_member_job_title").val(data.info.member_title);
                        $("#second_member_phone").val(data.info.member_phone);
                    })
                }
                
            })
        })

       



        $("body").on("click", ".send", function() {
            var part =$('.tab.active').attr('part');
            var field = $("#field").val();
            var block_name = $('.block').val();
            var day_count1 = $('input:checkbox:checked[name="first_member_day"]').map(function() {return $(this).val();}).get()
            var first_member_do_date = day_count1.join(",");
            var day_count2 = $('input:checkbox:checked[name="second_member_day"]').map(function() {return $(this).val();}).get()
            var second_member_do_date = day_count2.join(",");
            // console.log(block_name);
            // console.log(part);
            // console.log(field);

            if (confirm("是否要儲存?")) {
                var sn = $("#sn").val();
                $.ajax({
                    url: './voice/api/save_trial_for_price',
                    data: {
                        "sn": sn,
                        "part": part,
                        'block_name':block_name,
                        "field":field,
                        "first_member_do_date": first_member_do_date,
                        "first_member_day_count": $("#first_member_day_count").val(),
                        "first_member_salary_section": $("#first_member_salary_section").val(),
                        "first_member_section_salary_total": $("#first_member_section_salary_total").val(),
                        "first_member_section_total": $("#first_member_section_total").val(),
                        "second_member_do_date": second_member_do_date,
                        "second_member_day_count": $("#second_member_day_count").val(),
                        "second_member_salary_section": $("#second_member_salary_section").val(),
                        "second_member_section_salary_total": $("#second_member_section_salary_total").val(),
                        "second_member_section_total": $("#second_member_section_total").val(),
                    },
                    dataType: "json"
                }).done(function(data) {
                    alert(data.sys_msg);
                    if (data.sys_code == "200") {
                        // location.reload();
                    }
                })
            }
        })


        });

        $("body").on("keyup", "#first_member_salary_section", function() {
            var section_total = $(this).val() * $("#first_member_section_count").val();
            $("#first_member_section_salary_total").val(section_total);
           
                $("#first_member_section_total").val(section_total);
                var first_member_section_lunch_total = parseInt($("#first_member_day_count").val()) ;
                $("#first_member_section_lunch_total").val(first_member_section_lunch_total);
                var first_member_section_total = parseInt($("#first_member_section_salary_total").val());
                $("#first_member_section_total").val(first_member_section_total);
            
        })

        $("body").on("keyup", "#second_member_salary_section", function() {
            var section_total = $(this).val() * $("#second_member_section_count").val();
            $("#second_member_section_salary_total").val(section_total);
          
                $("#second_member_section_total").val(section_total);
                var second_member_section_lunch_total = parseInt($("#second_member_day_count").val());
                $("#second_member_section_lunch_total").val(second_member_section_lunch_total);
                var second_member_section_total = parseInt($("#second_member_section_salary_total").val());
                $("#second_member_section_total").val(second_member_section_total); 
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
    </div>
</div>
<div class="row part" id="part1" style="height:700px;overflow: auto;">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>試場</th>
                    <th>場次</th>
                    <!-- <th>考生應試號起</th> -->
                    <!-- <th>考生應試號迄</th> -->
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
                <tr sn="<?=$v['sn']; ?>" part="2501" field="<?=$v['field']; ?>"  block_name='<?=$v['block_name']?>' section="<?=$v['class']; ?>" assign_sn="<?=$v['assign_sn']?>">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['field']; ?></td>
                    <td>
                    <?php 
                            switch ($v['block_name']) {
                                case 1:
                                   echo '上午場';
                                    break;
                                case 2:
                                    echo '上午場';
                                    break;
                                default:
                                    echo '上午場,下午場';
                                    break;
                            }
                        ?>
                   </td>
                    <td><?=$v['count_num']; ?></td>
                    <td><?=$v['floor']; ?></td>
                    <td><?=$v['trial_staff_code_1']; ?></td>
                    <td><?=$v['supervisor_1']; ?></td>
                    <td><?=$v['trial_staff_code_2']; ?></td>
                    <td><?=$v['supervisor_2']; ?></td>
                    <td><?=$v['note']; ?></td>
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
                    <th>場次</th>
                    <!-- <th>考生應試號起</th>
                    <th>考生應試號迄</th> -->
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
                <tr sn="<?=$v['sn']; ?>" part="2502" field="<?=$v['field']; ?>"  block_name='<?=$v['block_name']?>' section="<?=$v['class']; ?>">
                <td><?=$k + 1; ?></td>
                    <td><?=$v['field']; ?></td>
                    <td>
                        <?php 
                            switch ($v['block_name']) {
                                case 1:
                                   echo '上午場';
                                    break;
                                case 2:
                                    echo '上午場';
                                    break;
                                default:
                                    echo '上午場,下午場';
                                    break;
                            }
                        ?>
                   </td>
                    <td><?=$v['count_num']; ?></td>
                    <td><?=$v['floor']; ?></td>
                    <td><?=$v['trial_staff_code_1']; ?></td>
                    <td><?=$v['supervisor_1']; ?></td>
                    <td><?=$v['trial_staff_code_2']; ?></td>
                    <td><?=$v['supervisor_2']; ?></td>
                    <td><?=$v['note']; ?></td>
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
                    <th>場次</th>
                    <!-- <th>考生應試號起</th>
                    <th>考生應試號迄</th> -->
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
                <tr sn="<?=$v['sn']; ?>" part="2503" field="<?=$v['field']; ?>"  block_name='<?=$v['block_name']?>' section="<?=$v['class']; ?>">
                <td><?=$k + 1; ?></td>
                    <td><?=$v['field']; ?></td>
                    <td>
                    <?php 
                            switch ($v['block_name']) {
                                case 1:
                                   echo '上午場';
                                    break;
                                case 2:
                                    echo '上午場';
                                    break;
                                default:
                                    echo '上午場,下午場';
                                    break;
                            }
                        ?>
                   </td>
                    <td><?=$v['count_num']; ?></td>
                    <td><?=$v['floor']; ?></td>
                    <td><?=$v['trial_staff_code_1']; ?></td>
                    <td><?=$v['supervisor_1']; ?></td>
                    <td><?=$v['trial_staff_code_2']; ?></td>
                    <td><?=$v['supervisor_2']; ?></td>
                    <td><?=$v['note']; ?></td>
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
                            <input type="text" class="form-control field" id='field' readonly>
                        </div>
                        <div class="form-group">
                        
                            <label for="start_date" class="" style="float:left;">執行日</label>
                            <input type="checkbox" class="chbox" id="do_date" name="day" checked>
                            <span class="chbox"  >
                                <?=$datetime_info['day']; ?>
                            </span>
                        </div>
                        <div class="form-group">
                        <label for="floor" class="">場次</label>
                            <input type="checkbox" class="chbox block" id='morning'  value="上午場" >
                            <span class="chbox"  >
                                 上午場
                            </span>
                            <input type="checkbox" class="chbox block" id='aftermorning'  value="下午場"  >
                            <span class="chbox"  >
                                 下午場
                            </span>
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
                                <input type="hidden" class="form-control" id="first_member_one_day_salary" value="">
                                <input type="text" class="form-control" id="first_member_salary_section" value="">
                            </div>
                            <div class="W50">
                                <label for="trial_start" class="" style="float:left;width: 50%;">薪資總計</label>
                                <input type="hidden" class="form-control" id="first_member_day_salary_total" value="" readonly>
                                <input type="text" class="form-control" id="first_member_section_salary_total" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trial_end" class="" style="float:left;">總計</label>
                            <input type="hidden" class="form-control" id="first_member_day_total" value="">
                            <input type="text" class="form-control" id="first_member_section_total" value="" readonly>
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
                            <input type="text" class="form-control field" id='field' readonly>

                        </div>
                        <div class="form-group">
                        
                            <label for="start_date" class="" style="float:left;">執行日</label>
                            <input type="checkbox" class="chbox" id="do_date" name="day" checked>
                            <span class="chbox"  >
                                <?=$datetime_info['day']; ?>
                            </span>
                        </div>
                        <div class="form-group">
                        <label for="floor" class="">場次</label>
                        <input type="checkbox" class="chbox block" id='morning2'  value="上午場" >
                            <span class="chbox"  >
                                 上午場
                            </span>
                            <input type="checkbox" class="chbox block" id='aftermorning2'  value="下午場">
                            <span class="chbox"  >
                                 下午場
                            </span>
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
                                <input type="hidden" class="form-control" id="second_member_one_day_salary" value="">
                                <input type="text" class="form-control" id="second_member_salary_section" value="">
                            </div>
                            <div class="W50">
                                <label for="trial_start" class="" style="float:left;width: 50%;">薪資總計</label>
                                <input type="hidden" class="form-control" id="second_member_day_salary_total" value="" readonly>
                                <input type="text" class="form-control" id="second_member_section_salary_total" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trial_end" class="" style="float:left;">總計</label>
                            <input type="hidden" class="form-control" id="second_member_day_total" value="">
                            <input type="text" class="form-control" id="second_member_section_total" value="" readonly>
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