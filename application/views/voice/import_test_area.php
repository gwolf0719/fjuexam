
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
tr{
    cursor:pointer;
}
</style>
<script>
    $("body").on("click","#Upload",function(){
        var formData = new FormData($('#form')[0]); 
        var files = $('input[name="file"]').prop('files');
        if(files.length == 0){
            alert('請先選擇文件');
            return;
        }else{
          
                if(confirm("注意！舊資料會全部刪除，新資料將匯入")){
                    $.ajax({
                        type:"post",
                        dataType: 'json',
                        url: "./voice/api/import_test_area", 
                        data: formData, 
                        cache: false, 
                        processData: false, 
                        contentType: false, 
                    }).done(function(data){
                        console.log(data);
                        alert(data.sys_msg);
                        window.location.reload();  
                    });
                }else{
                    alert("上傳失敗");
                }
        }        
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
        <img src="assets/images/a1_title.png" alt="" style="height:50px;">
    </div>
    <div class="p-2 " style="width:300px;text-align:right;">
      <a  class="btn btn-primary " href="./assets_voice/sample/area_exam.csv"> 下載範本</a>
        <button type="button" class="btn btn-primary "  data-toggle="modal" data-target="#exampleModal"  >匯入資料</button>
    </div>
</div>
<!-- 標題選單列結束 -->

<div class="row">
   <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>年度</th>
                    <th>第幾次</th>
                    <th>分區</th>
                    <th>分區名稱</th>
                    <th>考區</th>
                    <th>試場</th>
                    <th>應試號碼起</th>
                    <th>應試號碼迄</th>
                    <th>應試號碼數</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($datalist as $k => $v): ?> 
           
                <tr>
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['year']; ?></td>
                    <td><?=$v['ladder']; ?></td>
                    <td><?=$v['part']; ?></td>
                    <td><?=$v['area_name']; ?></td>
                    <td><?=$v['block_name']; ?></td>
                    <td><?=$v['field']; ?></td>
                    <td><?=$v['start']; ?></td>
                    <td><?=$v['end']; ?></td>
                    <td><?=$v['count_num']; ?></td>                    
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
        <h5 class="modal-title" id="exampleModalLabel">考區試場資料匯入</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data"  action="" id="form" class="page_form">
                  
            <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="" id="file" name="file">
                <!-- <label class="custom-file-label" for="inputGroupFile02">請選擇檔案</label> -->
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