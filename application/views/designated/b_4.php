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
.form{
    position: relative;
    width: 100%;
    margin: 0 auto;
    border-top: 1px solid;
    background: #f2f2f2;
    padding: 50px 0px;
    left: -15px;
    display:none;
    float: left;
    height: auto;    
}
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
    margin-bottom: .5rem;
    margin: 0px 5%;
    width:25%;
    text-align:right;
}
.form-control {
    display: block;
    width: 65%;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.form-group {
    margin-bottom: 1rem;
    padding-right:10%;
}
.up{
    cursor: pointer;
    z-index: 9999;
    width: 100%;
    text-align: center;
    position: relative;
    top: 25px;
}
.bottom{
    position: absolute;
    bottom: 0px;
    width:100%;
}
</style>
<script>
    $("body").on("click","#Upload",function(){
        if(confirm("注意！舊資料會全部刪除，新資料將匯入")){
            $("#form").submit();
        }
        
    })
    $("body").on("click","tr",function(){
        var sn = $(this).attr("sn");
        $(".form").addClass("upup");
        if($(".form").hasClass("upup")){
            $(".form").slideDown();
        }else{
            $(".form").slideUp();
        }             
        $.ajax({
            url: 'api/get_once_task',
            data:{
                "sn":sn,
            },
            dataType:"json"
        }).done(function(data){
            $("#sn").val(sn);
            console.log(data.info);
            $("#job_code").val(data.info.job_code)
            $("#job_title").val(data.info.job_title)
            $("#name").val(data.info.name)
            $("#start_date").val(data.info.start_date)
            $("#trial_start").val(data.info.trial_start)
            $("#trial_end").val(data.info.trial_end)
            $("#number").val(data.info.number)
            $("#section").val(data.info.section)
            $("#price").val(data.info.price)
            $("#lunch").val(data.info.lunch)
            $("#phone").val(data.info.phone)
            $("#note").val(data.info.note)
        })
    })
    
    $("body").on("click","#add",function(){
        var area = "第三分區";
        var job_code = $("#job_code").val();
        var job_title = $("#job_title").val();
        var name = $("#name").val();
        var start_date = $("#start_date").val();
        var trial_start = $("#trial_start").val();
        var trial_end = $("#trial_end").val();        
        var number = $("#number").val();
        var section = $("#section").val();
        var price = $("#price").val();        
        var lunch = $("#lunch").val();
        var phone = $("#phone").val();        
        var note = $("textarea[name='note']").val();
        console.log(note);
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
                "number":number,                
                "section":section,
                "price":price,
                "lunch":lunch,
                "phone":phone,                
                "note":note,
                "class":cla,             
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
        var sn = $("#sn").val();
        var area = "第三分區";
        var job_code = $("#job_code").val();
        var job_title = $("#job_title").val();
        var name = $("#name").val();
        var start_date = $("#start_date").val();
        var trial_start = $("#trial_start").val();
        var trial_end = $("#trial_end").val();        
        var number = $("#number").val();
        var section = $("#section").val();
        var price = $("#price").val();        
        var lunch = $("#lunch").val();
        var phone = $("#phone").val();        
        var note = $("textarea[name='note']").val();
        var cla = "第三分區";
        $.ajax({
            url: 'api/edit_task',
            data:{
                "sn":sn,
                "area":area,
                "job_code":job_code,
                "job_title":job_title,
                "name":name,
                "start_date":start_date,
                "trial_start":trial_start,
                "trial_end":trial_end,
                "number":number,                
                "section":section,
                "price":price,
                "lunch":lunch,
                "phone":phone,                
                "note":note,
                "class":cla,  
            },
            dataType:"json"
        }).done(function(data){
                alert(data.sys_msg);
            if(data.sys_code == "200"){
                location.reload();
            }      
        })
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
        $(".form").slideToggle();
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
         $("#search_job").text($("#job").val());
     })

     $("body").on("click","#search_btn",function(){
        $.post("./api/get_name",{
            job_code:$("#search_job_code").val(),
        },function(data){
            if(data.sys_code == "200"){
                $("#search_name").val(data.info.member_name);
            }
        },"json")     
     })

     $("body").on("click","#sure",function(){
        $.post("./api/assignment",{
            job_code:$("#search_job_code").val(),
            job:$("#search_job").text(),
            area:"第三分區"
        },function(data){
            if(data.sys_code == "200"){
                location.reload();
            }
        },"json")           
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
<div class="row" style="height: 700px;overflow: auto;margin: 20px auto;">
    
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
                    <th>任務編號</th>
                    <th>節數</th>
                    <th>單價</th>
                    <th>午餐</th>
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
                    <td><?=$v['number']; ?></td>
                    <td><?=$v['section']; ?></td>
                    <td><?=$v['price']; ?></td>
                    <td><?=$v['lunch']; ?></td>
                    <td><?=$v['phone']; ?></td>
                    <td><?=$v['note']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
     </div>
</div>

<div class="bottom">
    <div class="up">
        <img src="assets/images/upup.png" alt="" >
    </div>
    <div class="row form" style="">
        <!-- 職務選擇開始 -->
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin:20px 0px 20px 25px">
            <div class="row">
                <div for=""  class="col-2" style="display: inline-block;line-height:40px;text-align:right;">職務</div>
                <select class="form-control col-6" id="job">
                        <?php foreach ($jobs as $k => $v): ?>
                            <option value="<?=$v; ?>"><?=$v; ?></option>
                        <?php endforeach; ?>
                    </select>
                <div class="col-4">
                    <button type="button" class="btn btn-primary" id="assign" data-toggle="modal" data-target="#exampleModal">指派</button>
                    <button class="btn btn-primary" type="button" id="new_job">新增職務</button>
                </div>
            </div>
        </div>
        <!-- 職務選擇結束 -->       
        <div class="col-md-12 col-sm-12 col-xs-12 border">      
            <form method="POST" enctype="multipart/form-data"  action="" id="form" class="">                                            
                <div class="col-md-3 col-sm-3 col-xs-3 cube">
                    <div class="form-group">
                        <label for="job_code" class=""  style="float:left;">職員代碼</label>
                        <input type="hidden" id="sn">
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
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 cube">
                    <div class="form-group">
                        <label for="start_date" class=""  style="float:left;">執行日</label>
                        <input type="text" class="form-control" id="start_date">
                    </div>  
                    <div class="form-group">
                        <label for="trial_start" class=""  style="float:left;">試場起號</label>
                        <select class="form-control" id="trial_start">
                            <?php foreach ($field as $k => $v): ?>
                                <option value="<?=$v['field']; ?>"><?=$v['field']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>                  
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">試場迄號</label>
                        <select class="form-control" id="trial_end">
                            <?php foreach ($field as $k => $v): ?>
                                <option value="<?=$v['field']; ?>"><?=$v['field']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>                  
                </div>    
                <div class="col-md-3 col-sm-3 col-xs-3 cube">
                    <div class="form-group">
                        <label for="start_date" class=""  style="float:left;">任務編號</label>
                        <input type="text" class="form-control" id="number">
                    </div>  
                    <div class="form-group">
                        <label for="trial_start" class=""  style="float:left;">聯絡電話</label>
                        <input type="text" class="form-control" id="phone">
                    </div>                  
                </div>                        
                <div class="col-md-3 col-sm-3 col-xs-3 cube" style="float:left">
                    <div class="form-group">
                        <label for="start_date" class=""  style="float:left;">節數</label>
                        <input type="text" class="form-control" id="section">
                    </div>  
                    <div class="form-group">
                        <label for="trial_start" class=""  style="float:left;">單價</label>
                        <input type="text" class="form-control" id="price">
                    </div>                  
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">午餐</label>
                        <input type="text" class="form-control" id="lunch">
                    </div>   
                    <div class="form-group">
                        <label for="trial_end" class=""  style="float:left;">總計</label>
                        <input type="text" class="form-control" id="total">
                    </div>                                  
                </div>     
                <div class="col-md-6 col-sm-6 col-xs-6 " style="float:left;margin: 20px auto;">             
                    <div class="">
                        <div class="">
                            <label for="note" class="" style="float:left;text-align:left;width: 5%;">備註</label>
                            <textarea name="note" id="note" class="" style="width:300px"></textarea>
                        </div>
                    </div>                  
                </div> 
                <div class="col-md-6 col-sm-6 col-xs-6" style="float:left;margin: 20px auto;">             
                    <div class="form-group" style="text-align:right">
                        <div class="">
                            <button class="btn btn-primary" type="button" id="add">新增</button>
                            <button type="button" class="btn btn-primary" id="remove">刪除</button>
                            <button type="button" class="btn btn-success" id="send">儲存</button>
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
                            <p>職員代碼<input type="text" class="" id="search_job_code" style="margin-left: 10px;"></p>
                        </div>  
                        <div>
                            <p>職員姓名<input type="text" class="" id="search_name" style="margin-left: 10px;"></p>
                        </div>                          
                    </div>       
                    <div class="" style="text-align: center;border-bottom: 1px solid #f2f2f2;padding: 20px 0px;">
                        <button class="btn btn-primary" type="button" id="search_btn">搜尋</button>
                    </div>       
                    <div class="" style="text-align: right;margin: 20px;">
                        <button type="button" class="btn btn-primary" id="sure">確定指派</button>
                        <button type="button" class="btn btn-success" id="">取消</button>
                    </div>                                                                                                   
                </form>
            </div>
        </div>    
      </div>
    </div>
  </div>
</div>
<!-- Modal end-->
