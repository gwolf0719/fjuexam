<style>
@media (min-width: 1200px){
    .container {
        max-width: 1440px;
    }
}
img{
    max-width:100%;
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
            url: 'api/get_once_school_unit',
            data:{
                "sn":sn,
            },
            dataType:"json"
        }).done(function(data){
            $("#sn").val(sn);
            $("#company_name_01").val(data.info.company_name_01);
            $("#company_name_02").val(data.info.company_name_02);
            $("#department").val(data.info.department);
            $("#code").val(data.info.code);
        })
    })
                // $.ajax({
                // url : './api/edit_addr',
                // data : {
                //     "sn":sn,
                //     "user_uid":user_uid,
                //     "name":name,
                //     "phone":phone,
                //     "addr":addall,
                //     "city":city,
                //     "district":district,
                //     "zipcode":zipcode,
                // },
                // dataType : "json"
                // }).done(function(data){
                //     if(data.sys_code == "200"){
                //         alert(data.sys_msg);
                //         location.reload();
                //     }                    
                // })       
    $("body").on("click","#add",function(){
        var company_name_01 = $("#company_name_01").val();
        var company_name_02 = $("#company_name_02").val();
        var department = $("#department").val();
        var code = $("#code").val();
        $.ajax({
            url: 'api/add_school_unit',
            data:{
                "company_name_01":company_name_01,
                "company_name_02":company_name_02,
                "department":department,
                "code":code,
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
        var company_name_01 = $("#company_name_01").val();
        var company_name_02 = $("#company_name_02").val();
        var department = $("#department").val();
        var code = $("#code").val();
        $.ajax({
            url: 'api/edit_school_unit',
            data:{
                "sn":sn,
                "company_name_01":company_name_01,
                "company_name_02":company_name_02,
                "department":department,
                "code":code,
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
                url: 'api/remove_once_school_unit',
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
</script>
<div class="row">
    <div class="input-group col-sm-2">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>" readonly>
        
    </div>

    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/a2_title.png" alt="" style="width: 20%;">
    </div>

    <div class="input-group col-sm-2">

        <button type="button" class="btn btn-primary "  data-toggle="modal" data-target="#exampleModal"  >匯入資料</button>
        
        
    </div>
    
</div>
<div class="row">
    
   <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>年度</th>
                    <th>單位名稱1</th>
                    <th>單位名稱2</th>
                    <th>部門</th>
                    <th>代號</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($datalist as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>" data-toggle="modal" data-target="#exampleModal_insert">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['year']; ?></td>
                    <td><?=$v['company_name_01']; ?></td>
                    <td><?=$v['company_name_02']; ?></td>
                    <td><?=$v['department']; ?></td>
                    <td><?=$v['code']; ?></td>
                    
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
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
<!-- Modal start-->
<div class="modal fade" id="exampleModal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModal_insertLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">本校單位匯入作業</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">      
                <form method="POST" enctype="multipart/form-data"  action="" id="form" class="page_form">                                            
                    <div class="form-group">
                        <label for="company_name_01">單位名稱1</label>
                        <input type="text" class="" id="company_name_01">
                        <input type="hidden" class="" id="sn">
                    </div>   
                    <div class="form-group">
                        <label for="company_name_02">單位名稱2</label>
                        <input type="text" class="" id="company_name_02">
                    </div>                   
                    <div class="form-group">
                        <label for="company_name_01">部門</label>
                        <input type="text" class="" id="department">
                    </div>                   
                    <div class="form-group">
                        <label for="company_name_01">代號</label>
                        <input type="text" class="" id="code">
                    </div>  
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button class="btn btn-primary" type="button" id="add">新增</button>
                            <button type="button" class="btn btn-primary" id="remove">刪除</button>
                            <button type="button" class="btn btn-success" id="send">儲存</button>
                        </div>
                    </div>                      
                </form>
            </div>
        </div>    
      </div>
      
    </div>
  </div>
</div>
<!-- Modal end-->
