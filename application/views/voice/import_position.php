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
    background:#c3e691;
}
.cube{
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
.ball{
    color: #c3e691;
    background: #fff;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    padding: 5px 0px;
    font-size: 25px;
    margin: 0px 10%;
}
</style>
<script>
    $(function(){

        $("body").on("click","#Upload",function() {
        var formData = new FormData($('#form')[0]); 
        var files = $('input[name="file"]').prop('files');
        console.log(files);
        if(files.length == 0){
            alert('請先選擇文件');
            return;
        }else{

            if(confirm("注意！舊資料會全部刪除，新資料將匯入")){
                $.ajax({
                    type:"post",
                    dataType: 'json',
                    url: "./voice/api/import_position", 
                    data: formData, 
                    cache: false, 
                    processData: false, 
                    contentType: false, 
                }).done(function(data){
                    console.log(data);
                    alert(data.sys_msg);
                        
                });
            }else{
                alert("上傳失敗");
            }
            
            
        }        
    })
    })
  
</script>
<script>
$(function(){

    $(".cube").eq(0).show();
    $("body").on("click",".tab",function(){
        var $this = $(this);
        //點擊先做還原動作
        $(".tab").removeClass("active");
        $(".cube").hide();
        // 點擊到的追加active以及打開相對應table
        $this.addClass("active");
        var area = $this.attr("area");
        $("#b"+area).show()
    })
})
</script>

<!-- 標題選單列開始 -->
<div class="d-flex justify-content-between">
    <div class="p-2 "  style="width:300px;">
        <div class="input-group">

            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
            </div>
            <input type="text" class="form-control"  value="<?=$this->session->userdata('year'); ?>" style="width:60px;" readonly>
            <input type="text" class="form-control"  value="<?=$this->session->userdata('ladder'); ?>" style="width:100px;" readonly>
            
        </div>
    </div>
    <div class="p-2 ">
        <img src="./assets_voice/images/a4_title.png" alt="" style="height:50px;">
    </div>
    <div class="p-2 " style="width:300px;text-align:right;">
        <button type="button" class="btn btn-primary "  data-toggle="modal" data-target="#exampleModal"  >匯入資料</button>
    </div>
</div>



<div class="row" style="position: relative;top: 20px;left: 10px;">
    <div style="width:95%;margin:0 auto">
        <div class="tab active" area="0"><div class="tab_text">ALL</div></div>
        <div class="tab" area="1"><div class="tab_text">考區</div></div>
        <div class="tab" area="2"><div class="tab_text">第一分區</div></div>
        <div class="tab" area="3"><div class="tab_text">第二分區</div></div>
        <div class="tab" area="4"><div class="tab_text">第三分區</div></div>
    </div>
</div>
<div class="row cube" id="b0">
   <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="" style="text-align:center;">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>考區</th>
                    <th>職務</th>
                </tr>
            </thead>
            <tbody>
            <!-- <?php foreach ($all as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['area']; ?></td>
                    <td><?=$v['job']; ?></td>
                </tr>
            <?php endforeach; ?> -->
            </tbody>
        </table>
     </div>
</div>
<div class="row cube" id="b1">
   <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="" style="text-align:center;">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>考區</th>
                    <th>職務</th>
                </tr>
            </thead>
            <tbody>
            <!-- <?php foreach ($b1 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['area']; ?></td>
                    <td><?=$v['job']; ?></td>
                </tr>
            <?php endforeach; ?> -->
            </tbody>
        </table>
     </div>
</div>
<div class="row cube" id="b2">
   <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="" style="text-align:center;">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>考區</th>
                    <th>職務</th>
                </tr>
            </thead>
            <tbody>
            <!-- <?php foreach ($b2 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['area']; ?></td>
                    <td><?=$v['job']; ?></td>
                </tr>
            <?php endforeach; ?> -->
            </tbody>
        </table>
     </div>
</div>
<div class="row cube" id="b3">
   <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="" style="text-align:center;">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>考區</th>
                    <th>職務</th>
                </tr>
            </thead>
            <tbody>
            <!-- <?php foreach ($b3 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['area']; ?></td>
                    <td><?=$v['job']; ?></td>
                </tr>
            <?php endforeach; ?> -->
            </tbody>
        </table>
     </div>
</div>
<div class="row cube" id="b4">
   <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="" style="text-align:center;">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>考區</th>
                    <th>職務</th>
                </tr>
            </thead>
            <tbody>
            <!-- <?php foreach ($b4 as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['area']; ?></td>
                    <td><?=$v['job']; ?></td>
                </tr>
            <?php endforeach; ?> -->
            </tbody>
        </table>
     </div>
</div>



<!-- Modal start-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">職務資料匯入</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data"  action="" id="form" class="page_form">
        
            <div class="input-group mb-3">
                <select class="custom-select" id="select_area" name="area">
                    <option selected value="">選擇分區</option>
                    <option value="0">考區</option>
                    <option value="1">第一分區</option>
                    <option value="2">第二分區</option>
                    <option value="3">第三分區</option>
                </select>
                <!-- <div class="input-group-append">
                    <label class="input-group-text" for="inputGroupSelect02">Options</label>
                </div> -->
            </div>


            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file" name="file">
                    <label class="custom-file-label" for="file">Choose file</label>
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