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
        var files = $('input[name="file"]').prop('files');
        if(files.length == 0){
            alert('請先選擇文件');
            return;
        }else{
            if(confirm("注意！舊資料會全部刪除，新資料將匯入")){
                $("#form").submit();
            }
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
        <img src="assets/images/a1_title.png" alt="" style="width: 15%;">
    </div>

    <div class="input-group col-sm-2 ">

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
                    <th>分區</th>
                    <th>分區名稱</th>
                    <th>試場</th>
                    <th>考生應試號起</th>
                    <th>考生應試號迄</th>
                    <th>應試人數</th>
                    <th>物理</th>
                    <th>化學</th>
                    <th>生物</th>
                    <th>數乙</th>
                    <th>國文</th>
                    <th>英文</th>
                    <th>數甲</th>
                    <th>歷史</th>
                    <th>地理</th>
                    <th>公民與社會</th>
                    <th>冷氣試場</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($datalist as $k => $v): ?>
                <tr>
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['year']; ?></td>
                    <td><?=$v['part']; ?></td>
                    <td><?=$v['part_name']; ?></td>
                    <td><?=$v['field']; ?></td>
                    <td><?=$v['start']; ?></td>
                    <td><?=$v['end']; ?></td>
                    <td><?=$v['number']; ?></td>
                    <td><?=$v['subject_01']; ?></td>
                    <td><?=$v['subject_02']; ?></td>
                    <td><?=$v['subject_03']; ?></td>
                    <td><?=$v['subject_04']; ?></td>
                    <td><?=$v['subject_05']; ?></td>
                    <td><?=$v['subject_06']; ?></td>
                    <td><?=$v['subject_07']; ?></td>
                    <td><?=$v['subject_08']; ?></td>
                    <td><?=$v['subject_09']; ?></td>
                    <td><?=$v['subject_10']; ?></td>
                    <td><?=$v['air_test_field']; ?></td>
                    
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
                <input type="file" class="" id="inputGroupFile02" name="file">
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