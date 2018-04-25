<style>
    @media (min-width: 1200px){
        .container {
            max-width: 100%;
            width: 100%;
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
    padding: 20px 0px;
    left: -15px;
    display:none;
    float: left;
    height: auto;    
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
label {
    display: inline-block;
    margin-bottom: .5rem;
    margin: 0px 5%;
    width: 30%;
    text-align: right;
    float: left;
}
.form-control {
    display: block;
    width: 60%;
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
            url: 'api/get_once_staff',
            data:{
                "sn":sn,
            },
            dataType:"json"
        }).done(function(data){
            $("#sn").val(sn);
            $("#member_code").val(data.info.member_code);
            $("#member_name").val(data.info.member_name);
            $("#member_unit").val(data.info.member_unit);
            $("#member_title").val(data.info.member_title);
            $("#member_phone").val(data.info.member_phone);
            $("#order_meal").val(data.info.order_meal);
            $("#meal").val(data.info.meal);
            console.log(data.info.order_meal);
            if(data.info.order_meal == "y"){
                $("#order_meal").prop("checked",true);
            }else{
                $("#order_meal").prop("checked",false);
            }
        })
    })

    var member_meal = "n";
    $("#order_meal").change(function() {
        if (this.checked) {
            member_meal = "y";
        } else {
            member_meal = "n";
        }
    });    
    
    $("body").on("click","#add",function(){
        var member_code = $("#member_code").val();
        var member_name = $("#member_name").val();
        var member_unit = $("#member_unit").val();
        var member_title = $("#member_title").val();
        var member_phone = $("#member_phone").val();
        var order_meal = $("#order_meal").val();
        var meal = $("#meal").val();
        $.ajax({
            url: 'api/add_staff',
            data:{
                "member_code":member_code,
                "member_name":member_name,
                "member_unit":member_unit,
                "member_title":member_title,
                "member_phone":member_phone,
                "order_meal":member_meal,
                "meal":meal,
            },
            dataType:"json"
        }).done(function(data){
            if(data.sys_code == "200"){
                alert(data.sys_msg);
                location.reload();
            }      
        })
    })
    $("body").on("click","#send",function(){
        var sn = $("#sn").val();
        var member_code = $("#member_code").val();
        var member_name = $("#member_name").val();
        var member_unit = $("#member_unit").val();
        var member_title = $("#member_title").val();
        var member_phone = $("#member_phone").val();
        var order_meal = $("#order_meal").val();
        var meal = $("#meal").val();
        $.ajax({
            url: 'api/edit_staff',
            data:{
                "sn":sn,
                "member_code":member_code,
                "member_name":member_name,
                "member_unit":member_unit,
                "member_title":member_title,
                "member_phone":member_phone,
                "member_title":member_title,
                "order_meal":member_meal,
                "meal":meal,
            },
            dataType:"json"
        }).done(function(data){
            if(data.sys_code == "200"){
                alert(data.sys_msg);
                location.reload();
            }      
        })
    })  

    $("body").on("click","#remove",function(){
        if(confirm("是否確定要刪除？")){
            var sn = $("#sn").val();
            $.ajax({
                url: 'api/remove_once_staff',
                data:{
                    "sn":sn,
                },
                dataType:"json"
            }).done(function(data){
                if(data.sys_code == "200"){
                    alert(data.sys_msg);
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
        <img src="assets/images/a3_title.png" alt="" style="width: 15%;">
    </div>

    <div class="input-group col-sm-2">

        <button type="button" class="btn btn-primary "  data-toggle="modal" data-target="#exampleModal"  >匯入資料</button>
        
        
    </div>
    
</div>
<div class="row" style="height: 50vh;overflow: auto;">
   <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>年度</th>
                    <th>工作人員代碼</th>    
                    <th>姓名</th>
                    <th>單位別</th>
                    <th>職稱</th>
                    <th>聯絡電話</th>
                    <th>訂餐需求</th>
                    <th>餐別</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($datalist as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['year']; ?></td>
                    <td><?=$v['member_code']; ?></td>
                    <td><?=$v['member_name']; ?></td>
                    <td><?=$v['member_unit']; ?></td>
                    <td><?=$v['member_phone']; ?></td>
                    <td><?=$v['member_title']; ?></td>
                    <td><?=$v['order_meal']; ?></td>
                    <td><?=$v['meal']; ?></td>
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
        <div class="col-md-12 col-sm-12 col-xs-12">      
            <form method="POST" enctype="multipart/form-data"  action="" id="form" class="page_form">     
                <div class="col-md-3 col-sm-3 col-xs-3 cube">                                       
                    <div class="form-group">
                        <label for="member_code">工作人員代碼</label>
                        <input type="text" class="form-control" id="member_code">
                        <input type="hidden" class="" id="sn">
                    </div>   
                    <div class="form-group">
                        <label for="member_name">姓名</label>
                        <input type="text" class="form-control" id="member_name">
                    </div>                   
                    <div class="form-group">
                        <label for="member_unit">單位別</label>
                        <input type="text" class="form-control" id="member_unit">
                    </div>                   
                    <div class="form-group">
                        <label for="member_title">職稱</label>
                        <input type="text" class="form-control" id="member_title">
                    </div>  
                    <div class="form-group">
                        <label for="member_phone">聯絡電話</label>
                        <input type="text" class="form-control" id="member_phone">
                    </div>  
                    <div class="form-group">
                        <label for="order_meal">訂餐需求</label>
                        <input type="checkbox" class="form-control" id="order_meal"><span>需訂餐</span>
                    </div>                      
                    <div class="form-group">
                        <label for="meal">餐別</label>
                        <select name="meal" id="meal" class="form-control">
                            <option value="葷">葷</option>
                            <option value="素">素</option>
                        </select>
                    </div>  
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 cube">                    
                    <div class="form-group" style="text-align: right;">
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">資料匯入</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data"  action="" id="form" class="page_form">
                  
            <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile02" name="file">
                <label class="custom-file-label" for="inputGroupFile02">請選擇檔案</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text" id="Upload">Upload</span>
            </div>
            </div>
            

        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Modal end-->

