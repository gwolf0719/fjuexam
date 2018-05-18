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
</style>
<script>
$(function(){
    $("body").on("click","#Upload1",function(){
        var files = $("input[name='inputGroupFile01']").prop('files');
        console.log(files);
        if(files.length == 0){
            alert('請先選擇文件');
            return;
        }else{
            if(confirm("注意！舊資料會全部刪除，新資料將匯入")){
                $("#form1").submit();
                // location.href="./designated/b_5";
            }
        }        
    })
    $("body").on("click","#Upload2",function(){
        var files = $("input[name='inputGroupFile02']").prop('files');
        console.log(files);
        if(files.length == 0){
            alert('請先選擇文件');
            return;
        }else{
            if(confirm("注意！舊資料會全部刪除，新資料將匯入")){
                $("#form2").submit();
                // location.href="./designated/b_5";
            }
        }        
    })    

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
        <img src="assets/images/a4_title.png" alt="" style="width: 15%;">
    </div>

    <div class="input-group col-sm-2 ">

        <button type="button" class="btn btn-primary "  data-toggle="modal" data-target="#area" style="margin: 0px 3px;">考區職務匯入</button>
        <button type="button" class="btn btn-primary "  data-toggle="modal" data-target="#part"  >分區職務匯入</button>
        
    </div>
    </div>    
    
</div>

<!-- Modal start-->
<div class="modal fade" id="area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">考區職務匯入</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data"  action="" id="form1" class="page_form">
                  
            <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="" id="inputGroupFile01" name="inputGroupFile01">
                <!-- <label class="custom-file-label" for="inputGroupFile02">請選擇檔案</label> -->
            </div>
            <div class="input-group-append">
                <span class="input-group-text" id="Upload1">Upload</span>
            </div>
            </div>
            

        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Modal end-->

<!-- Modal start-->
<div class="modal fade" id="part" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">分區職務匯入</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" action="" id="form2" class="page_form">
                  
            <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="" id="inputGroupFile02" name="inputGroupFile02">
                <!-- <label class="custom-file-label" for="inputGroupFile02">請選擇檔案</label> -->
            </div>
            <div class="input-group-append">
                <span class="input-group-text" id="Upload2">Upload</span>
            </div>
            </div>
            

        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Modal end-->