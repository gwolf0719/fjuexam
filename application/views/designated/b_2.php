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
        var area = "第一分區";
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
        var cla = "第一分區";
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
        var area = "第一分區";
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
        var cla = "第一分區";
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
</script>
<div class="row">
    <div class="input-group col-sm-2">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>" readonly>
        
    </div>

    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/b2_title.png" alt="" style="width: 15%;">
    </div>
    
</div>
<div class="row table" style="height: auto;overflow: auto;margin: 20px auto;">
    
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
                    <td></td>
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

