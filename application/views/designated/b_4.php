<style>
@media (min-width: 1200px){
    .container {
        max-width: 100%;
        width:100%;
    }
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
}
/* .to_up{
    position: fixed;
    bottom: 0;
    left: 48%;
}
.down{
    margin: 0 auto;
    text-align: center;
}
.to_down{
    transform: rotate(180deg);
}
.up{
    cursor: pointer;
    z-index: 1;
    width: 100%;
    text-align: center;
    position: relative;
    height:25px;
}
.up.active{
    cursor: pointer;
    z-index: 1;
    width: 100%;
    text-align: center;
    position: relative;
    overflow: hidden;
    height:56px;
} */
.bottom{
    /* position: fixed; */
    bottom: 0px;
    width:100%;
}
</style>
<script>
    /**自動完成 */
    var data ;
    $.getJSON("./api/get_member_info",function(data){
        data = data.info;
        console.log(data);
        var $input = $(".typeahead");
            $input.typeahead({
            source: data,
            autoSelect: true
        });
    })

    $("body").on("click","#Upload",function(){
        if(confirm("注意！舊資料會全部刪除，新資料將匯入")){
            $("#form").submit();
        }
        
    })
    $("body").on("click","tr",function(){
        var sn = $(this).attr("sn");
        $("#job_code").attr("readonly",true);
        // $("html, body").animate({
        //     scrollTop: $("body").height()
        // }, 1000);           
        // $(".to_up").hide();
        // $(".boxs").addClass("upup");
        // if($(".boxs").hasClass("upup")){
        //     $(".boxs").slideDown();
        // }else{
        //     $(".boxs").slideUp();
        // }             
        $.ajax({
            url: 'api/get_once_task',
            data:{
                "sn":sn,
            },
            dataType:"json"
        }).done(function(data){
            $("#sn").val(sn);
            $("#job").val(data.info.job)
            $("#job_code").val(data.info.job_code)
            $("#job_title").val(data.info.job_title)
            $("#name").val(data.info.name)
            $("#start_date").val(data.info.start_date)
            $("#trial_start").val(data.info.trial_start)
            $("#trial_end").val(data.info.trial_end)
            $("#section").val(data.info.section)
            $("#price").val(data.info.price)
            $("#lunch").val(data.info.lunch)
            $("#phone").val(data.info.phone)
            $("#note").val(data.info.note)
        })
    })

    // $("body").on("change","#job",function(){
    //     $("#job_title").val($(this).val());
    //     $("#member_job_title").val($(this).val());
    // })

    $("body").on("click","#add_info",function(){
        $(this).hide();
        $("#send").hide();
        $("#remove").hide();
        $("#add").show();
        $("#no").show();
    })

    $("body").on("click","#no",function(){
        $(this).hide();
        $("#add").hide();
        $("#add_info").show();
        $("#send").show();
        $("#remove").show();        
    })

    $("body").on("click","#add",function(){
        var area = "第三分區";
        var job_code = $("#job_code").val();
        var job_title = $("#job_title").val();
        var name = $("#name").val();
        var start_date = $("#start_date").val();
        var trial_start = $("#trial_start").val();
        var trial_end = $("#trial_end").val();    
        var phone = $("#phone").val();        
        var note = $("textarea[name='note']").val();
        var section = $("#section").val();
        var salary_section = $("#salary_section").val();
        var lunch_price = $("#lunch_price").val();
        var lunch_count = $("#lunch_count").val();
        var lunch_fee = $("#lunch_fee").val();
        var total = $("#total").val();
        var price = $("#price").val();
        var day_count = $("#day_count").val();
        var one_day_salary = $("#one_day_salary").val();          
        var cla = "第三分區";
        $.ajax({
            url: 'api/add_task',
            data:{
                "area":area,
                "job_code":job_code,
                "job_title":job_title,
                "name":name,
                "start_date":start_date,
                "trial_start":trial_start,
                "trial_end":trial_end,       
                "class":cla,
                "section":section,  
                "salary_section":salary_section,  
                "lunch_price":lunch_price,  
                "lunch_count":lunch_count,  
                "lunch_fee":lunch_fee,  
                "total":total,  
                "price":price,  
                "day_count":day_count,  
                "one_day_salary":one_day_salary,              
            },
            dataType:"json"
        }).done(function(data){
            alert(data.sys_msg);
            if(data.sys_code == "200"){
                // alert(data.sys_msg);
                location.reload();
            }      
        })
    })
    $("body").on("click","#send",function(){
        if(confirm("是否確定要修改？")){
            var sn = $("#sn").val();
            var area = "第三分區";
            var job = $("#member_job_title").val();
            var job_code = $("#job_code").val();
            var job_title = $("#job_title").val();
            var name = $("#name").val();
            var start_date = $("#start_date").val();
            var trial_start = $("#trial_start").val();
            var trial_end = $("#trial_end").val();  
            var phone = $("#phone").val();        
            var note = $("textarea[name='note']").val();
            var cla = "第三分區";
            var section = $("#section").val();
            var salary_section = $("#salary_section").val();
            var lunch_price = $("#lunch_price").val();
            var lunch_count = $("#lunch_count").val();
            var lunch_fee = $("#lunch_fee").val();
            var total = $("#total").val();
            var price = $("#price").val();
            var day_count = $("#day_count").val();
            var one_day_salary = $("#one_day_salary").val();                  
            $.ajax({
                url: 'api/edit_task',
                data:{
                    "sn":sn,
                    "area":area,
                    "job":job,
                    "job_code":job_code,
                    "job_title":job_title,
                    "name":name,
                    "start_date":start_date,
                    "trial_start":trial_start,
                    "trial_end":trial_end,   
                    "phone":phone,                
                    "note":note,
                    "class":cla,  
                    "section":section,  
                    "salary_section":salary_section,  
                    "lunch_price":lunch_price,  
                    "lunch_count":lunch_count,  
                    "lunch_fee":lunch_fee,  
                    "total":total,  
                    "price":price,  
                    "day_count":day_count,  
                    "one_day_salary":one_day_salary,                      
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

    $("body").on("click","#remove",function(){
        if(confirm("是否確定要刪除？")){
            var sn = $("#sn").val();
            $.ajax({
                url: 'api/remove_once_task',
                data:{
                    "sn":sn,
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
    $("body").on("click",".up",function(){
       $("html, body").animate({
        scrollTop: $("body").height()
        }, 1000);
        $(this).hide();
        $(".boxs").show();
    })

    $("body").on("click",".down",function(){
        $('.up').show();
        $('.to_up').show();
        $(".boxs").hide();
    })    

    /**
    新增職務
     */
     $("body").on("click","#new_job",function(){
         var job = prompt("請輸入職務名稱");
         
         if(job == null){
             alert("動作取消");
         }else{
             if(job == ""){
                 alert("需要輸入內容");
             }else{
                 $.getJSON("./api/job_add",{
                     job:job,
                     area:"第三分區"
                 },function(data){
                     alert(data.sys_msg);
                     location.reload();
                 })
             }
         }
         
     }) 

     $("body").on("click","#assign",function(){
         $(".typeahead").val("");
         $("#search_job").text($("#job").val());
     })

    $("body").on("click","#sure",function(){
         var code = $(".typeahead").val().substr(0,4);
        $.post("./api/assignment",{
            job_code:code,
            job:$("#search_job").text(),
            area:"第三分區",
        },function(data){
            if(data.info != null){
                alert(data.sys_msg);
                if(data.sys_code == "200"){
                    $('#exampleModal').modal('hide');
                    $("#member_job_title").val($("#search_job").text());
                    $("#job_code").val(data.info.member_code);
                    $("#job_title").val(data.info.member_title);
                    $("#name").val(data.info.member_name);
                    $("#phone").val(data.info.member_phone);
                }
            }else{
                alert("查無此人");
            }
        },"json")           
     })   

    /**
    取消職務
     */
    $("body").on("click","#cancel_job",function(){
        if(confirm("是否要取消職務？")){
            var sn = $("#sn").val();
            $.ajax({
                url: 'api/cancel_job',
                data:{
                    "sn":sn,
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

    $("body").on("change","#calculation",function(){
        if($(this).val() == "by_section"){
            $(".by_section").show();
            $(".by_day").hide();
        }else{
            $(".by_section").hide();
            $(".by_day").show();             
        }
        $("#section").val("0");
        $("#lunch_price").val("0");
        $("#lunch_count").val("0");
        $("#total").val("0");
        $("#price").val("0");
        $("#day_count").val("0");
    })

     $("body").on("change",".section_count",function(){
        if($("#calculation").val() == "by_section"){
            //以節計算
            var price = $("#section").val() * $("#salary_section").val();
            $("#price").val(price);
            var lunch_price = $("#lunch_count").val() * $("#lunch_fee").val();
            $("#lunch_price").val(lunch_price);
            var total = price + lunch_price;
            $("#total").val(total);
        }else{
            //以天計算
            var price = $("#day_count").val() * $("#one_day_salary").val();
            $("#price").val(price);
            var lunch_price = $("#lunch_count").val() * $("#lunch_fee").val();
            $("#lunch_price").val(lunch_price);
            var total = price + lunch_price;
            $("#total").val(total);            
        }
     })    
</script>
<div class="row">
    <div class="input-group col-sm-2">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>" readonly>
        
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
                    <th>年度</th>
                    <th>考區</th>
                    <th>職務</th>
                    <th>職員代碼</th>
                    <th>職稱</th>
                    <th>姓名</th>
                    <th>執行日</th>
                    <th>試場起號</th>
                    <th>試場迄號</th>
                    <!-- <th>節數</th>
                    <th>單價</th>
                    <th>便當</th> -->
                    <th>聯絡電話</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($datalist as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['year']; ?></td>
                    <td><?=$v['area']; ?></td>
                    <td><?=$v['job']; ?></td>
                    <td><?=$v['job_code']; ?></td>
                    <td><?=$v['job_title']; ?></td>
                    <td><?=$v['name']; ?></td>
                    <td><?=$v['start_date']; ?></td>
                    <td><?=$v['trial_start']; ?></td>
                    <td><?=$v['trial_end']; ?></td>
                    <!-- <td><?=$v['section']; ?></td>
                    <td><?=$v['price']; ?></td>
                    <td><?=$v['lunch']; ?></td> -->
                    <td><?=$v['phone']; ?></td>
                    <td><?=$v['note']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
     </div>
</div>

<div class="bottom">
    <!-- <div class="up">
        <img src="assets/images/upup.png" alt="" class="to_up">
    </div> -->
    <div class="row boxs" style="">
        <!-- <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 down">
            <img src="assets/images/upup.png" alt="" class="to_down">
        </div>        -->
        <!-- 職務選擇開始 -->
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin:20px 0px 20px 25px">
            <div class="row">
                <div for=""  class="col-2" style="display: inline-block;line-height:40px;text-align:right;">職務</div>
                <select class="form-control col-4" id="job">
                        <?php foreach ($jobs as $k => $v): ?>
                            <option value="<?=$v; ?>"><?=$v; ?></option>
                        <?php endforeach; ?>
                    </select>
                <div class="col-6">
                    <button type="button" class="btn btn-primary" id="assign" data-toggle="modal" data-target="#exampleModal">指派</button>
                    <button class="btn btn-primary" type="button" id="new_job">新增職務</button>
                    <!-- <button class="btn btn-danger" type="button" id="cancel_job">取消職務</button> -->
                </div>
            </div>
        </div>
        <!-- 職務選擇結束 -->       
        <div class="col-md-12 col-sm-12 col-xs-12">      
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
                        <input type="text" class="form-control" id="start_date">
                    </div>  
                    <div class="form-group">
                        <label for="trial_start" class=""  style="float:left;">試場起號</label>
                        <select class="form-control" id="trial_start">
                            <option value="">請選擇</option>
                            <?php foreach ($field as $k => $v): ?>
                                <option value="<?=$v['field']; ?>"><?=$v['field']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>                  
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">試場迄號</label>
                        <select class="form-control" id="trial_end">
                            <option value="">請選擇</option>
                            <?php foreach ($field as $k => $v): ?>
                                <option value="<?=$v['field']; ?>"><?=$v['field']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>                  
                </div>                         
                <div class="col-md-3 col-sm-3 col-xs-3 cube" style="height:266px;">
                    <div class="form-group">
                        <label for="order_meal">訂餐需求</label>
                        <input type="checkbox" class="" id="order_meal"><span>需訂餐</span>
                    </div>  
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">計算方式</label>
                        <select class="form-control" id="calculation">
                            <option value="by_section">以節計算</option>
                            <option value="by_day">以天計算</option>
                        </select>
                    </div>      
                    <div class="by_section">
                        <div class="form-group">
                            <label for="start_date" class=""  style="float:left;">節數</label>
                            <input type="text" class="form-control section_count" id="section" value="0">
                            <input type="hidden" class="form-control" id="salary_section" value="<?=$fees_info['salary_section']; ?>">
                        </div>   
                        <div class="form-group">
                            <label for="start_date" class=""  style="float:left;">便當數</label>
                            <input type="text" class="form-control section_count" id="lunch_count" value="0">
                            <input type="hidden" class="form-control" id="lunch_fee" value="<?=$fees_info['lunch_fee']; ?>">
                        </div>                                                  
                    </div>         
                    <div class="by_day" style="display:none">
                        <div class="form-group">
                            <label for="start_date" class=""  style="float:left;">天數</label>
                            <input type="text" class="form-control section_count" id="day_count" value="0">
                            <input type="hidden" class="form-control" id="one_day_salary" value="<?=$fees_info['one_day_salary']; ?>">
                        </div>                                            
                    </div>                                           
                </div>                        
                <div class="col-md-3 col-sm-3 col-xs-3 cube" style="float:left">
                    <!-- <div class="form-group">
                        <label for="start_date" class=""  style="float:left;">節數</label>
                        <input type="text" class="form-control" id="section">
                    </div>   -->
                    <div class="form-group">
                        <label for="trial_start" class=""  style="float:left;">薪資費</label>
                        <input type="text" class="form-control" id="price" value="0">
                    </div>                  
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">便當費</label>
                        <input type="text" class="form-control" id="lunch_price" value="<?=$fees_info['lunch_fee']; ?>">
                    </div>   
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">總計</label>
                        <input type="text" class="form-control" id="total" value="0">
                    </div>                                  
                </div> 
                <div class="col-md-6 col-sm-6 col-xs-6 " style="float:left;margin: 20px auto;">             
                    <div class="">
                        <div class="">
                            <label for="note" class="" style="float:left;text-align:left;width: 15%;text-align:center">備註</label>
                            <textarea name="note" id="note" class="" style="width:300px"></textarea>
                        </div>
                    </div>                  
                </div> 
                <div class="col-md-6 col-sm-6 col-xs-6" style="float:left;margin: 20px auto;">             
                    <div class="form-group" style="text-align:right">
                        <div class="">
                            <button class="btn btn-primary" type="button" id="add" style="display:none">確定</button>
                            <button class="btn btn-danger" type="button" id="no" style="display:none">取消</button>
                            <button class="btn btn-primary" type="button" id="add_info">新增</button>
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
