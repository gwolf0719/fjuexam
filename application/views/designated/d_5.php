
<style>
@media (min-width: 1200px){
    .container {
        max-width: 100%;
        width:100%;
    }
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
.cube{
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
    transition: border-color .15s ease-in-out,boxs-shadow .15s ease-in-out;
}
.form-group {
    margin-bottom: 1rem;
    padding-right:10%;
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
        var code = $(this).attr("code");
        if($("#calculation").val() == null){
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
        }
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
            $("#trial_start").val(data.info.start);
            $("#trial_end").val(data.info.end);
            $("#note").val(data.info.note);    
            $("#section_count").val(data.info.section);
            $("#calculation").val(data.info.calculation)
            if(data.info.calculation == "by_day"){
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
                $("#day_salary_total").val(data.info.salary_total);
                $("#day_lunch_total").val(data.info.lunch_total);
                $("#day_total").val(data.info.total);                             
            }else if(data.info.calculation == "by_section"){
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
                $("#salary_section").val(data.info.salary);
                $("#section_salary_total").val(data.info.salary_total);
                $("#section_lunch_total").val(data.info.lunch_total);
                $("#section_total").val(data.info.total);    
            }    
        })  
        $.ajax({
            url: 'api/get_staff_member',
            data:{
                "code":code,
            },
            dataType:"json"
        }).done(function(data){
            $("#job_code").val(data.info.member_code);
            $("#job_title").val(data.info.member_title);
            $("#name").val(data.info.member_name);
            $("#phone").val(data.info.member_phone);
            $("#order_meal").val(data.info.order_meal);
            if(data.info.order_meal.toUpperCase() == "Y"){
                $("#order_meal").prop("checked",true);
                $("#lunch_price").attr("readonly",false);
            }else{
                
                $("#order_meal").prop("checked",false);
                $("#lunch_price").attr("readonly",true);
            }         
        })               
    })

    // $("body").on("click","tr",function(){
    //     var sn = $(this).attr("sn");
    //     $("#job_code").attr("readonly",true);
    //     $("html, body").animate({
    //     scrollTop: $("body").height()
    //     }, 1000);      
        
    //     $.ajax({
    //         url: 'api/get_once_task',
    //         data:{
    //             "sn":sn,
    //         },
    //         dataType:"json"
    //     }).done(function(data){
    //         var chk = data.info.do_date.split(",")
    //         var lenght = data.info.do_date.split(",").length;
    //         for(i=1;i<=lenght;i++){
    //             if(chk[i-1] != undefined){
    //                 $('input:checkbox[name="day"]').eq(i-1).prop("checked",true);
    //             }
    //         }
    //         if(data.info.do_date == ""){
    //             $('input:checkbox[name="day"]').eq(0).prop("checked",false);
    //             $('input:checkbox[name="day"]').eq(1).prop("checked",false);
    //             $('input:checkbox[name="day"]').eq(2).prop("checked",false);
    //         }
    //         $("#sn").val(sn);
    //         $("#job").val(data.info.job)
    //         $("#job_code").val(data.info.job_code)
    //         $("#job_title").val(data.info.job_title)
    //         $("#name").val(data.info.name)
    //         $("#start_date").val(data.info.start_date)
    //         $("#trial_start").val(data.info.trial_start)
    //         $("#trial_end").val(data.info.trial_end)
    //         $("#number").val(data.info.number)
    //         $("#section").val(data.info.section)
    //         $("#price").val(data.info.price)
    //         $("#lunch").val(data.info.lunch)
    //         $("#phone").val(data.info.phone)
    //         $("#note").val(data.info.note)

    //         if(data.info.day_count != ""){
    //             $("#day_count").val(data.info.day_count);
    //         }else{
    //             $("#day_count").val("0");
    //         }

    //         if(data.info.salary_total != ""){
    //             $("#salary_total").val(data.info.salary_total);
    //         }else{
    //             $("#salary_total").val("0");
    //         }

    //         if(data.info.one_day_salary != ""){
    //             $("#one_day_salary").val(data.info.one_day_salary);
    //         }else{
    //             $("#one_day_salary").val(<?=$fees_info['one_day_salary']; ?>)
    //         }
            
    //         if(data.info.lunch_total != ""){
    //             $("#lunch_total").val(data.info.lunch_total);
    //         }else{
    //             $("#lunch_total").val("0");
    //         }

    //         if(data.info.lunch_price != ""){
    //             $("#lunch_price").val(data.info.lunch_price);
    //         }else{
    //             $("#lunch_price").val(<?=$fees_info['lunch_fee']; ?>)
    //         }

    //         if(data.info.total != ""){
    //             $("#total").val(data.info.total);
    //         }else{
    //             $("#total").val("0");
    //         }

    //         if(data.info.order_meal == "y"){
    //             $("#order_meal").prop("checked",true);
    //             $("#lunch_price").attr("readonly",false);
    //         }else{
    //             $("#order_meal").prop("checked",false);
    //             $("#lunch_price").attr("readonly",true);
    //         }
    //     })
    // })



    $("#order_meal").change(function() {
        if (this.checked) {
            $(this).val("y");
            $("#lunch_price").attr("readonly",false);
        } else {
            $(this).val("n");
            $("#lunch_price").attr("readonly",true);
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

    // $("body").on("click","#remove",function(){
    //     if(confirm("是否確定要刪除？")){
    //         var sn = $("#sn").val();
    //         $.ajax({
    //             url: 'api/remove_once_task',
    //             data:{
    //                 "sn":sn,
    //             },
    //             dataType:"json"
    //         }).done(function(data){
    //             // alert(data.sys_msg);
    //             if(data.sys_code == "200"){
    //                 alert(data.sys_msg);
    //                 location.reload();
    //             }
    //         })
    //     }
    // })    

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
        var day_total = $(this).val() * $("#day_count").val();
        $("#salary_total").val(day_total);
        var total = parseInt($("#lunch_total").val()) + day_total;
        $("#total").val(total)
    })

    $("body").on("keyup","#salary_section",function(){
        var day_total = $(this).val() * $("#count").val();
        $("#salary_total").val(day_total);
        var total = parseInt($("#lunch_total").val()) + day_total;
        $("#total").val(total)
    })

    $("body").on("keyup","#lunch_price",function(){
        var lunch_total = 0 - $(this).val() * $("#day_count").val();
        $("#lunch_total").val(lunch_total);
        var total = parseInt($("#salary_total").val()) + lunch_total;
        console.log(total);
        $("#total").val(total)
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
            var section_salary_total =  $("#section_count").val() * $("#salary_section").val();
            $("#section_salary_total").val(section_salary_total);
            $('input:checkbox[name="day"]').click(function(){
                if($("#order_meal").val() == "Y"){
                    var arr_lenght = $('input:checkbox:checked[name="day"]').map(function() { return $(this).val(); }).get().length;
                    var section_lunch_total = $("#lunch_price").val() * arr_lenght;
                    $("#section_lunch_total").val(section_lunch_total);
                    var section_total = parseInt($("#section_salary_total").val()) - parseInt($("#section_lunch_total").val());
                    $("#section_total").val(section_total);    
                }
            })
            var section_total = parseInt($("#section_salary_total").val()) - parseInt($("#section_lunch_total").val());
            $("#section_total").val(section_total);
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
            $('input:checkbox[name="day"]').click(function(){
                var arr_lenght = $('input:checkbox:checked[name="day"]').map(function() { return $(this).val(); }).get().length;
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
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>" readonly>
        
    </div>

    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/d5_title.png" alt="" style="width: 20%;">
    </div>
    
</div>
<div class="row" style="position: relative;top: 20px;left: 10px;">
    <div style="width:95%;margin:5px auto;z-index:9999">
        <div class="tab active" area="1" part="2501"><div class="tab_text">第一分區</div></div>
        <div class="tab" area="2" part="2502"><div class="tab_text">第二分區</div></div>
        <div class="tab" area="3" part="2503"><div class="tab_text">第三分區</div></div>
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
                <tr sn="<?=$v['sn']; ?>" code="<?=$v['trial_staff_code']; ?>">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['allocation_code']; ?></td>
                    <td><?=$v['trial_staff_name']; ?></td>
                    <td><?=$v['start']; ?></td>
                    <td><?=$v['end']; ?></td>                   
                    <td><?=$v['section']; ?></td>
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
                <tr sn="<?=$v['sn']; ?>" code="<?=$v['trial_staff_code']; ?>">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['allocation_code']; ?></td>
                    <td><?=$v['trial_staff_name']; ?></td>
                    <td><?=$v['start']; ?></td>
                    <td><?=$v['end']; ?></td>                   
                    <td><?=$v['section']; ?></td>
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
                <tr sn="<?=$v['sn']; ?>" code="<?=$v['trial_staff_code']; ?>">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['allocation_code']; ?></td>
                    <td><?=$v['trial_staff_name']; ?></td>
                    <td><?=$v['start']; ?></td>
                    <td><?=$v['end']; ?></td>                   
                    <td><?=$v['section']; ?></td>
                    <td><?=$v['note']; ?></td>    
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
                <div class="col-md-3 col-sm-3 col-xs-3 cube">
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
                <div class="col-md-3 col-sm-3 col-xs-3 cube">
                    <div class="form-group">
                        <label for="start_date" class=""  style="float:left;">執行日</label>
                        <input type="checkbox" class="chbox" id="" name="day" value="<?=mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?>"><span class="chbox"><?=mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?> </span>
                        <input type="checkbox" class="chbox" id="" name="day" value="<?=mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?>"><span class="chbox"><?=mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?> </span>
                        <input type="checkbox" class="chbox" id="" name="day" value="<?=mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?>"><span class="chbox"><?=mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?> </span>
                    </div>  
                    <div class="form-group">
                        <label for="trial_start" class=""  style="float:left;">試場起號</label>
                        <input type="text" class="form-control" id="trial_start" readonly>
                    </div>                  
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">試場迄號</label>
                        <input type="text" class="form-control" id="trial_end" readonly>
                    </div>                
                </div>    
                <div class="col-md-3 col-sm-3 col-xs-3 cube" style="height:150px;">
                    <div class="form-group">
                        <label for="order_meal">訂餐需求</label>
                        <input type="checkbox" class="" name="need" id="order_meal" disabled><span>需訂餐</span>
                    </div>  
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">計算方式</label>
                        <select class="form-control" id="calculation">
                            <option value="by_day">以天計算</option>
                            <option value="by_section">以節計算</option>
                        </select>
                    </div>                                             
                </div>                        
                <div class="col-md-3 col-sm-3 col-xs-3 cube" style="float:left">
                    <div class="form-group">
                        <label for="start_date" class=""  style="float:left;">天數/節數</label>
                        <input type="text" class="form-control" id="day_count" readonly>
                        <input type="text" class="form-control" style="display:none" id="section_count" readonly> 
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
                                <input type="text" class="form-control" id="lunch_price" value="<?=$fees_info['lunch_fee']; ?>">                       
                        </div>
                        <div class="W50">
                            <label for="trial_start" class=""  style="float:left;width: 50%;">便當總計</label>
                            <input type="text" class="form-control" id="day_lunch_total" value="0" readonly>   
                            <input type="text" class="form-control" id="section_lunch_total" style="display:none" value="0" readonly>                      
                        </div>        
                    </div>   
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">總計</label>
                        <input type="text" class="form-control" id="day_total" value="0">
                        <input type="text" class="form-control" id="section_total" style="display:none" value="0">
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


