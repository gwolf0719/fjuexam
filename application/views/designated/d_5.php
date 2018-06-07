
<style>
@media (min-width: 1200px){
    .container {
        max-width: 100%;
        width:100%!important;
    }
}
.container {
    max-width: 1680px;
    width: 1680px!important;
}
.typeahead{
    z-index: 1051;
    margin-left:10px;
}
img{
    max-width:100%;
}
.boxs{
    border-top: 1px solid;
    background: #f2f2f2;
    padding: 0px 0px 20px;
}
.table{
    height: auto;
    overflow: auto;
}
.W14{
    width:14%;
}
.W20{
    width:20%;
}
.cube{
    background: #dacddf;
    margin: 0px 10px;
    padding: 20px;
    border-radius: 10px;
    float: left;
    height: auto;
}
label {
    display: inline-block;
    line-height: 40px;
    text-align: center;
    width: 35%;
    font-size:14px;
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
    transition: border-color .15s ease-in-out,boxs-shadow .15s ease-in-out;
}
.form-group {
    margin-bottom: 1rem;
    padding-right:0%;
    float: left;
    width: 100%;
}
.tab{
    width: 18%;
    float: left;
    text-align: center;
    background: #e2e2e2;
    height: 70px;
    padding-top: 14px;
    margin: 10px;
    cursor:pointer;
    border-radius: 10px 10px 0px 0px;
}
.tab.active{
    background:#a97eb8;
}
.part{
    display:none;
}
.W50{
    width:50%;
    float:left;
}
.tab_text{
    text-align: center;
    padding: 10px 0px;
    font-size: 21px;
}
.table thead th {
    vertical-align: middle;
    border-bottom: 0;

}

.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 0;
}
.bt{
    border-top: 1px solid #dee2e6!important;
}
.bb{
    border-bottom: 1px solid #dee2e6!important;
}
tr{
    cursor:pointer;
}
</style>
</style>

<script>
$(function(){
    /**自動完成 */
    var data ;
    $.getJSON("./api/get_member_info",function(data){
        data = data.info;
        // console.log(data);
        var $input = $(".typeahead");
            $input.typeahead({
            source: data,
            autoSelect: true,
        });
    })
    
    $("body").on("click","tr",function(){
        var sn = $(this).attr("sn");
        

        $("html, body").animate({
            scrollTop: $("body").height()
        }, 1000 );
        $.ajax({
            url: 'api/get_once_trial',
            data:{
                "sn":sn,
            },
            dataType:"json"
        }).done(function(data){
            $("#sn").val(sn);
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
            $("#lunch_price").attr("lunch_price",data.info.lunch_price);     
            if(data.info.order_meal.toUpperCase() == "N" || data.info.order_meal == ""){
                $("#order_meal").prop("checked",false);
                $("#lunch_price").val("0");
                $("#lunch_price").attr("readonly",true);
            }else{
                $("#order_meal").prop("checked",true);   
                $("#lunch_price").attr("readonly",false);   
            }              
            
            var section_count = parseInt(data.info.first_section) + parseInt(data.info.second_section) + parseInt(data.info.third_section);
            var day_arr = [data.info.first_section,data.info.second_section,data.info.third_section];
            var uses_day_count = day_arr.length;
            switch(data.info.calculation) {
                case "by_section":
                    $("#calculation").val("by_section");
                    $("#day_count").hide();    
                    $("#one_day_salary").hide();
                    $("#day_salary_total").hide();
                    $("#day_lunch_total").hide();
                    $("#day_total").hide();
                    $("#section_count").show();   
                    $("#salary_section").show()  
                    $("#section_salary_total").show();
                    $("#section_lunch_total").show();
                    $("#section_total").show();       
                    $("#section_count").val(data.info.count);    
                    $("#lunch_price").val(data.info.lunch_price);
                    $("#salary_section").val(data.info.salary);
                    $("#section_salary_total").val(data.info.salary_total);
                    $("#section_lunch_total").val(data.info.lunch_total);
                    $("#section_total").val(data.info.total);   
                    break;
                case "by_day":
                    $("#calculation").val("by_day");
                    $("#day_count").show();    
                    $("#one_day_salary").show();
                    $("#day_salary_total").show();
                    $("#day_lunch_total").show();
                    $("#day_total").show();
                    $("#section_count").hide();   
                    $("#salary_section").hide()  
                    $("#section_salary_total").hide();
                    $("#section_lunch_total").hide();
                    $("#section_total").hide();       
                    $("#day_count").val(data.info.count);    
                    $("#one_day_salary").val(data.info.salary);
                    $("#lunch_price").val(data.info.lunch_price);
                    $("#day_salary_total").val(data.info.salary_total);
                    $("#day_lunch_total").val(data.info.lunch_total);
                    $("#day_total").val(data.info.total); 
                    break;
                case "":
                    $("#calculation").val("by_day");
                    $("#day_count").show();    
                    $("#one_day_salary").show();
                    $("#day_salary_total").show();
                    $("#day_lunch_total").show();
                    $("#day_total").show();
                    $("#section_count").hide();   
                    $("#salary_section").hide()  
                    $("#section_salary_total").hide();
                    $("#section_lunch_total").hide();
                    $("#section_total").hide();    
                    $("#section_count").val(data.info.count);                       
                    $("#day_count").val(uses_day_count);    
                    $("#lunch_price").val(<?=$fees_info['lunch_fee']; ?>);
                    var day_salary_total = parseInt($("#one_day_salary").val()) * parseInt($("#day_count").val());
                    $("#day_salary_total").val(day_salary_total);
                    $("#day_total").val($("#day_salary_total").val());                                               
                    break;
                    
            }  
                          
        })  
        //取得職員資料
        var code = $(this).attr("code");
        $.ajax({
            url: 'api/get_staff_member',
            data:{
                "code":code,
            },
            dataType:"json"
        }).done(function(data){
            console.log(data.info);
            $("#job_code").val(data.info.member_code);
            $("#job_title").val(data.info.member_title);
            $("#name").val(data.info.member_name);
            $("#phone").val(data.info.member_phone);     
        })    
                
    })
    

    $("#order_meal").change(function() {
        if (this.checked) {
            $(this).val("y");
            $("#lunch_price").attr("readonly",false);
            //判斷有沒有編輯過便當價格決定要不要帶入預設值
            if($("#lunch_price").attr("lunch_price") == "<?=$fees_info['lunch_fee']; ?>"  || $("#lunch_price").attr("#lunch_price") == undefined){
                $("#lunch_price").val($("#lunch_price").attr("lunch_price"));
            }else{
                $("#lunch_price").val("<?=$fees_info['lunch_fee']; ?>");
            }
        } else {
            $(this).val("n");
            $("#lunch_price").attr("readonly",true);
            $("#lunch_price").val("0");
        }
    });    
    
    $("body").on("click","#send",function(){
        if(confirm("確定儲存修改資料？")){
            var sn = $("#sn").val();
            var arr = $('input:checkbox:checked[name="day"]').map(function() { return $(this).val(); }).get();
            var do_date = arr.join(",");  
            var calculation = $("#calculation").val();
            var count;
            var salary;
            var salary_total;
            var lunch_price;
            var lunch_total;
            var total;
            var note = $("textarea[name='note']").val();
            if(calculation == "by_section"){
                count = $("#section_count").val();
                salary = $("#salary_section").val();
                salary_total = $("#section_salary_total").val()
                lunch_price = $("#lunch_price").val()
                lunch_total = $("#section_lunch_total").val()
                total = $("#section_total").val()
            }else{
                count = $("#day_count").val();
                salary = $("#one_day_salary").val();
                salary_total = $("#day_salary_total").val()
                lunch_price = $("#lunch_price").val()
                lunch_total = $("#day_lunch_total").val()
                total = $("#day_total").val()                
            }
            $.ajax({
                url: 'api/save_trial_staff_for_list',
                data:{
                    "sn":sn,
                    "do_date":do_date,
                    "calculation":calculation,
                    "count":count,  
                    "salary":salary,
                    "salary_total":salary_total,  
                    "lunch_price":lunch_price,  
                    "lunch_total":lunch_total,  
                    "total":total,  
                    "note":note,
                    "order_meal":$("#order_meal").val()
                },
                dataType:"json"
            }).done(function(data){
                    alert(data.sys_msg);
                if(data.sys_code == "200"){
                    location.reload();
                }      
            })
        }
    })  

    $(".part").eq(0).show();
    $("body").on("click",".tab",function(){
        var $this = $(this);
         //點擊先做還原動作
        $(".tab").removeClass("active");
        $(".part").hide();
        // 點擊到的追加active以及打開相對應table
        $this.addClass("active");
        var area = $this.attr("area");
        $("#part"+area).show();       

    })

    $("body").on("keyup","#one_day_salary",function(){
        console.log($(this).val());
        var day_salary_total = parseInt($(this).val()) * parseInt($("#day_count").val());
        $("#day_salary_total").val(day_salary_total);
        if($("#order_meal").val() == "N"){
            $("#day_total").val(day_salary_total);
        }else{
            var day_lunch_total = 0 - parseInt($("#lunch_price").val()) * parseInt($("#day_count").val());
            $("#day_lunch_total").val(day_lunch_total);
            var day_total = day_salary_total + day_lunch_total;
            $("#day_total").val(day_total);
        }
    })

    $("body").on("keyup","#salary_section",function(){
        console.log($(this).val());
        var section_salary_total = parseInt($(this).val()) * parseInt($("#section_count").val());
        $("#section_salary_total").val(section_salary_total);
        if($("#order_meal").val() == "N"){
            $("#section_total").val(section_salary_total);
        }else{
            var section_lunch_total = 0 - parseInt($("#lunch_price").val()) * parseInt($("#day_count").val());
            $("#section_lunch_total").val(section_lunch_total);
            var section_total = section_salary_total + section_lunch_total;
            $("#section_total").val(section_total);
        }
    })

    $("body").on("keyup","#lunch_price",function(){
        var lunch_total = 0 - $(this).val() * $("#day_count").val();
        $("#day_lunch_total").val(lunch_total);
        $("#section_lunch_total").val(lunch_total);
        var day_total = parseInt($("#day_salary_total").val()) + parseInt($("#day_lunch_total").val());
        var section_total = parseInt($("#section_salary_total").val()) + parseInt($("#section_lunch_total").val());
        $("#day_total").val(day_total);
        $("#section_total").val(section_total);
    })

    $("body").on("change","#order_meal",function(){
        if($(this).prop("checked") == false){
            $("#day_total").val($("#day_salary_total").val());
            $("#section_total").val($("#section_salary_total").val());
            $("#day_lunch_total").val(0);
            $("#section_lunch_total").val(0);
        }else{
            //節數
            var section_salary_total = parseInt($("#salary_section").val()) * parseInt($("#section_count").val());
            var section_lunch_total = 0 - parseInt($("#lunch_price").val()) * parseInt($("#day_count").val());
            $("#section_lunch_total").val(section_lunch_total);
            var section_total = section_salary_total + section_lunch_total;
            $("#section_total").val(section_total);
            // 天數
            var day_salary_total = parseInt($("#one_day_salary").val()) * parseInt($("#day_count").val());
            var day_lunch_total = 0 - parseInt($("#lunch_price").val()) * parseInt($("#day_count").val());
            $("#day_lunch_total").val(day_lunch_total);
            var day_total = day_salary_total + day_lunch_total;
            $("#day_total").val(day_total);            
        }
    })
 
     $("body").on("change","#calculation",function(){
        if($("#calculation").val() == "by_section"){
            //以節計算
            $("#day_count").hide();    
            $("#one_day_salary").hide();
            $("#day_salary_total").hide();
            $("#day_lunch_total").hide();
            $("#day_total").hide();
            $("#section_count").show();   
            $("#salary_section").show()  
            $("#section_salary_total").show();
            $("#section_lunch_total").show();
            $("#section_total").show();   
            var section_count = parseInt($("#first_section").val()) + parseInt($("#second_section").val()) + parseInt($("#third_section").val());
            $("#section_count").val(section_count);
            var section_salary_total =  $("#section_count").val() * $("#salary_section").val();
            $("#section_salary_total").val(section_salary_total);
            var section_total = parseInt($("#section_salary_total").val()) + parseInt($("#section_lunch_total").val());
            $("#section_total").val(section_total);
            if($("#order_meal").prop("checked") == false){
                $("#day_total").val($("#day_salary_total").val());
                $("#section_total").val($("#section_salary_total").val());
            }else{
                //節數
                var section_salary_total = parseInt($("#salary_section").val()) * parseInt($("#section_count").val());
                var section_lunch_total = 0 - parseInt($("#lunch_price").val()) * parseInt($("#day_count").val());
                $("#section_lunch_total").val(section_lunch_total);
                var section_total = section_salary_total + section_lunch_total;
                $("#section_total").val(section_total);
                // 天數
                var day_salary_total = parseInt($("#one_day_salary").val()) * parseInt($("#day_count").val());
                var day_lunch_total = 0 - parseInt($("#lunch_price").val()) * parseInt($("#day_count").val());
                $("#day_lunch_total").val(day_lunch_total);
                var day_total = day_salary_total + day_lunch_total;
                $("#day_total").val(day_total);            
            }            
        }else{
            //以天計算
            $("#day_count").show();    
            $("#one_day_salary").show();
            $("#day_salary_total").show();
            $("#day_lunch_total").show();
            $("#day_total").show();
            $("#section_count").hide();   
            $("#salary_section").hide()  
            $("#section_salary_total").hide();
            $("#section_lunch_total").hide();
            $("#section_total").hide();          
            if($("#order_meal").prop("checked") == false){
                $("#day_total").val($("#day_salary_total").val());
                $("#section_total").val($("#section_salary_total").val());
            }else{
                //節數
                var section_salary_total = parseInt($("#salary_section").val()) * parseInt($("#section_count").val());
                var section_lunch_total = 0 - parseInt($("#lunch_price").val()) * parseInt($("#day_count").val());
                $("#section_lunch_total").val(section_lunch_total);
                var section_total = section_salary_total + section_lunch_total;
                $("#section_total").val(section_total);
                // 天數
                var day_salary_total = parseInt($("#one_day_salary").val()) * parseInt($("#day_count").val());
                var day_lunch_total = 0 - parseInt($("#lunch_price").val()) * parseInt($("#day_count").val());
                $("#day_lunch_total").val(day_lunch_total);
                var day_total = day_salary_total + day_lunch_total;
                $("#day_total").val(day_total);            
            }                
        }
     })

});
</script>

<div class="row">
    <div class="input-group col-sm-2">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>" readonly>
        
    </div>

    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/d5_title.png" alt="" style="width: 20%;">
    </div>
    
</div>
<div class="row" style="position: relative;top: 20px;left: 10px;">
    <div style="width:95%;margin:5px auto;">
        <div class="tab active" area="1" part="2501"><div class="tab_text">第一分區</div></div>
        <div class="tab" area="2" part="2502"><div class="tab_text">第二分區</div></div>
        <div class="tab" area="3" part="2503"><div class="tab_text">第三分區</div></div>
    </div>
</div>
<div class="row part" id="part1" style="height:700px;overflow: auto;">
   <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="" style="text-align:center;">
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
            <?php foreach ($part1 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>" code="<?=$v['trial_staff_code']; ?>">
                    <td class="bt"><?=$k + 1; ?></td>
                    <td class="bt"><?=$v['allocation_code']; ?></td>
                    <td class="bt"><?=$v['trial_staff_name']; ?></td>
                    <td class="bt"><?=$v['first_start']; ?></td>
                    <td class="bt"><?=$v['first_end']; ?></td>                   
                    <td class="bt"><?=$v['first_section']; ?></td>
                    <td class="bt"><?=$v['second_start']; ?></td>
                    <td class="bt"><?=$v['second_end']; ?></td>                   
                    <td class="bt"><?=$v['second_section']; ?></td>
                    <td class="bt"><?=$v['third_start']; ?></td>
                    <td class="bt"><?=$v['third_end']; ?></td>                   
                    <td class="bt"><?=$v['third_section']; ?></td>                                          
                    <td class="bt"><?=$v['note']; ?></td>   
                </tr>                    
            <?php endforeach; ?>         
            </tbody>
        </table>
     </div>
</div>
<div class="row part" id="part2" style="height:700px;overflow: auto;">
   <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="" style="text-align:center;">
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
            <?php foreach ($part2 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>" code="<?=$v['trial_staff_code']; ?>">
                    <td class="bt"><?=$k + 1; ?></td>
                    <td class="bt"><?=$v['allocation_code']; ?></td>
                    <td class="bt"><?=$v['trial_staff_name']; ?></td>
                    <td class="bt"><?=$v['first_start']; ?></td>
                    <td class="bt"><?=$v['first_end']; ?></td>                   
                    <td class="bt"><?=$v['first_section']; ?></td>
                    <td class="bt"><?=$v['second_start']; ?></td>
                    <td class="bt"><?=$v['second_end']; ?></td>                   
                    <td class="bt"><?=$v['second_section']; ?></td>
                    <td class="bt"><?=$v['third_start']; ?></td>
                    <td class="bt"><?=$v['third_end']; ?></td>                   
                    <td class="bt"><?=$v['third_section']; ?></td>                                          
                    <td class="bt"><?=$v['note']; ?></td>    
                </tr>                    
            <?php endforeach; ?>         
            </tbody>
        </table>
     </div>
</div>
<div class="row part" id="part3" style="height:700px;overflow: auto;">
   <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="" style="text-align:center;">
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
            <?php foreach ($part3 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>" code="<?=$v['trial_staff_code']; ?>">
                    <td class="bt"><?=$k + 1; ?></td>
                    <td class="bt"><?=$v['allocation_code']; ?></td>
                    <td class="bt"><?=$v['trial_staff_name']; ?></td>
                    <td class="bt"><?=$v['first_start']; ?></td>
                    <td class="bt"><?=$v['first_end']; ?></td>                   
                    <td class="bt"><?=$v['first_section']; ?></td>
                    <td class="bt"><?=$v['second_start']; ?></td>
                    <td class="bt"><?=$v['second_end']; ?></td>                   
                    <td class="bt"><?=$v['second_section']; ?></td>
                    <td class="bt"><?=$v['third_start']; ?></td>
                    <td class="bt"><?=$v['third_end']; ?></td>                   
                    <td class="bt"><?=$v['third_section']; ?></td>                                          
                    <td class="bt"><?=$v['note']; ?></td>    
                </tr>                    
            <?php endforeach; ?>         
            </tbody>
        </table>
     </div>
</div>

<div class="bottom">
    <div class="row boxs">
        <div class="col-md-12 col-sm-12 col-xs-12" style="margin: 50px auto 0px;">      
            <form method="POST" enctype="multipart/form-data"  action="" id="form" class="">                                            
                <div class="col-md-3 col-sm-3 col-xs-3 cube W14">
                    <div class="form-group">
                        <label for="job_code" class=""  style="float:left;">職員代碼</label>
                        <input type="hidden" id="sn">
                        <input type="hidden" id="member_job_title">
                        <input type="text" class="form-control" id="job_code">
                    </div>  
                    <div class="form-group">
                        <label for="job_title" class=""  style="float:left;">職稱</label>
                        <input type="text" class="form-control" id="job_title">
                    </div>                  
                    <div class="form-group">
                        <label for="member_name" class=""  style="float:left;">姓名</label>
                        <input type="text" class="form-control" id="name">
                    </div>                  
                    <div class="form-group">
                        <label for="trial_start" class=""  style="float:left;">聯絡電話</label>
                        <input type="text" class="form-control" id="phone">
                    </div>  
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 cube W14">
                    <p style="text-align:center">第一天 <?=$datetime_info['day_1']; ?></p>
                    <div class="form-group">
                        <label for="trial_start" class=""  style="float:left;">試場起號</label>
                        <input type="text" class="form-control" id="first_start" readonly>
                    </div>                  
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">試場迄號</label>
                        <input type="text" class="form-control" id="first_end" readonly>
                    </div>     
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">最大節數</label>
                        <input type="text" class="form-control" id="first_section" readonly>
                    </div>                                    
                </div>    
                <div class="col-md-3 col-sm-3 col-xs-3 cube W14">
                <p style="text-align:center">第二天 <?=$datetime_info['day_2']; ?></p>
                    <div class="form-group">
                        <label for="trial_start" class=""  style="float:left;">試場起號</label>
                        <input type="text" class="form-control" id="second_start" readonly>
                    </div>                  
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">試場迄號</label>
                        <input type="text" class="form-control" id="second_end" readonly>
                    </div>     
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">最大節數</label>
                        <input type="text" class="form-control" id="second_section" readonly>
                    </div>                                    
                </div>    
                <div class="col-md-3 col-sm-3 col-xs-3 cube W14">
                <p style="text-align:center">第三天 <?=$datetime_info['day_3']; ?></p>
                    <div class="form-group">
                        <label for="trial_start" class=""  style="float:left;">試場起號</label>
                        <input type="text" class="form-control" id="third_start" readonly>
                    </div>                  
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">試場迄號</label>
                        <input type="text" class="form-control" id="third_end" readonly>
                    </div>     
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">最大節數</label>
                        <input type="text" class="form-control" id="third_section" readonly>
                    </div>                                    
                </div>                                    
                <div class="col-md-3 col-sm-3 col-xs-3 cube W14">
                    <div class="form-group">
                        <label for="order_meal">訂餐需求</label>
                        <input type="checkbox" class="" name="need" id="order_meal"><span>需訂餐</span>
                    </div>  
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">計算方式</label>
                        <select class="form-control" id="calculation">
                            <option value="by_day">以天計算</option>
                            <option value="by_section">以節計算</option>
                        </select>
                    </div>                                             
                </div>                        
                <div class="col-md-3 col-sm-3 col-xs-3 cube W20">
                    <div class="form-group">
                        <label for="start_date" class=""  style="float:left;">天數/節數</label>
                        <input type="text" class="form-control" id="day_count" readonly value="0">
                        <input type="text" class="form-control" style="display:none" id="section_count" readonly value="0"> 
                    </div>  
                    <div class="form-group" style="padding: 0% 3%;">
                        <div class="W50">
                            <label for="trial_start" class=""  style="float:left;width: 50%;">薪資單價</label>
                            <input type="text" class="form-control" id="one_day_salary" value="<?=$fees_info['one_day_salary']; ?>">   
                            <input type="text" class="form-control" id="salary_section" style="display:none" value="<?=$fees_info['salary_section']; ?>">                     
                        </div>
                        <div class="W50">
                            <label for="trial_start" class=""  style="float:left;width: 50%;">薪資總計</label>
                            <input type="text" class="form-control" id="day_salary_total" value="0" readonly>    
                            <input type="text" class="form-control" id="section_salary_total" style="display:none" value="0" readonly>                      
                        </div>                        
                    </div>                  
                    <div class="form-group" style="padding: 0% 3%;">
                        <div class="W50">
                            <label for="trial_start" class=""  style="float:left;width: 50%;">便當費 </label>
                                <input type="text" class="form-control" id="lunch_price" value="0" lunch_price="">                       
                        </div>
                        <div class="W50">
                            <label for="trial_start" class=""  style="float:left;width: 50%;">便當總計</label>
                            <input type="text" class="form-control" id="day_lunch_total" value="0" readonly>   
                            <input type="text" class="form-control" id="section_lunch_total" style="display:none" value="0" readonly>                      
                        </div>        
                    </div>   
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">總計</label>
                        <input type="text" class="form-control" id="day_total" value="0" readonly>
                        <input type="text" class="form-control" id="section_total" style="display:none" value="0" readonly>
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
                <form method="POST" enctype="multipart/form-data"  action="" id="form" class="page_form">                                            
                    <div style="width: 255px;margin: 0 auto;">
                        <div>
                            <p>職務：<span id="search_job"></span></p>
                        </div>         
                        <div>
                            <p>關鍵字<input type="text" class="typeahead" ></p>
                        </div>  
                        <!-- <div>
                            <p>職員姓名<input type="text" class="" id="search_name" style="margin-left: 10px;"></p>
                        </div>                           -->
                    </div>       
                    <!-- <div class="" style="text-align: center;border-bottom: 1px solid #f2f2f2;padding: 20px 0px;">
                        <button class="btn btn-primary" type="button" id="search_btn">搜尋</button>
                    </div>        -->
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


