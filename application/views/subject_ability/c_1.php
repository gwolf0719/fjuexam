
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
    padding: 50px 0px 20px;
}
.table{
    height: auto;
    overflow: auto;
}
.cube{
    background: #e2eed3;
    margin: 0px 10px;
    padding: 20px;
    border-radius: 10px;
    float: left;
    flex: 0 0 30%;
    max-width: 32%;    
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
.bottom{
    bottom: 0px;
    width:100%;
}
tr{
    cursor:pointer;
}
</style>

<script>
$(function(){

    $(window).on("load",function(){
        var addr = $("#addr").val();
        // console.log(arr);
        if(addr == ""){
            alert("目前 C1 考試地址尚未填寫資料，請先填寫資料再進行操作");
            location.href="./subject_ability/c_4";
        }
    })

    $("body").on("click","tr",function(){
        var sn = $(this).attr("sn");
        $("html, body").animate({
        scrollTop: $("body").height()
        }, 1000);         
        $.ajax({
            url: 'api/get_once_part',
            data:{
                "sn":sn,
            },
            dataType:"json"
        }).done(function(data){
            console.log(data.info);
            $("#sn").val(sn);
            $("#part").val(data.info.part);
            $("#part_name").val(data.info.part_name);
            $("#field").val(data.info.field);
            $("#start").val(data.info.field);
            $("#end").val(data.info.field);
            $("#floor").val(data.info.floor);
            $("#number").val(data.info.number);
            $("#section").val(data.info.test_section);
            $("#note").val(data.info.note);
        })
    })

    $("body").on("click","#send",function(){
        if(confirm("是否要儲存?")){
            var part = $("#part").val();            
            var floor = $("#floor").val();
            var start = $("#start").val();
            var end = $("#end").val();
            var note = $("textarea[name='note']").val();
            $.ajax({
                url: 'api/save_floor',
                data:{
                    "part":part,
                    "floor":floor,
                    "start":start,
                    "end":end,
                    "note":note
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
        <img src="assets/images/c1_title.png" alt="" style="width: 15%;">
    </div>
    
</div>

<div class="row" style="height:700px;overflow: auto;">
   <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>年度</th>
                    <th>分區</th>
                    <th>分區名稱</th>
                    <th>試場</th>
                    <th>考試節數</th>
                    <th>考生應試號起</th>
                    <th>考生應試號迄</th>
                    <th>應試人數</th>
                    <!-- <th>地址</th> -->
                    <th>樓層別</th>
                    <th>備註</th>                    
                </tr>
            </thead>
            <tbody>
            <?php foreach ($datalist as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['year']; ?></td>
                    <td><?=$v['part']; ?></td>
                    <td><?=$v['part_name']; ?></td>
                    <td><?=$v['field']; ?></td>
                    <td><?=$v['test_section']; ?></td>
                    <td><?=$v['start']; ?></td>
                    <td><?=$v['end']; ?></td>
                    <td><?=$v['number']; ?></td>
                    <!-- <td><?=$addr_info['part_addr_1']; ?></td> -->
                    <td><?=$v['floor']; ?></td>
                    <td><?=$v['note']; ?></td>
                </tr>                    
            <?php endforeach; ?>
            </tbody>
        </table>
     </div>
</div>

<div class="bottom">
    <div class="row boxs">
        <div class="col-md-12 col-sm-12 col-xs-12 ">      
            <form method="POST" enctype="multipart/form-data"  action="" id="form" class="">                                            
                <div class="col-md-3 col-sm-3 col-xs-3 cube">
                    <div class="form-group">
                        <label for="part" class=""  style="float:left;">分區</label>
                        <input type="hidden" id="sn">
                        <input type="text" class="form-control" id="part" readonly>
                    </div>  
                    <div class="form-group">
                        <label for="part_name" class="" style="float:left;">分區名稱</label>
                        <input type="text" class="form-control" id="part_name" readonly>
                    </div>     
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 cube">
                    <div class="form-group">
                        <label for="start" class=""  style="float:left;">試場起號</label>
                        <select name="start" id="start" class="form-control">
                            <option value="">請選擇</option>
                            <?php foreach ($datalist as $k => $v): ?>
                                <option value="<?=$v['field']; ?>"><?=$v['field']; ?></option>
                            <?php endforeach; ?>         
                        </select>
                    </div>                  
                    <div class="form-group">
                        <label for="end" class=""  style="float:left;">試場迄號</label>
                        <select name="start" id="end" class="form-control">
                            <option value="">請選擇</option>
                            <?php foreach ($datalist as $k => $v): ?>
                                <option value="<?=$v['field']; ?>"><?=$v['field']; ?></option>
                            <?php endforeach; ?>        
                        </select>
                    </div>     
                </div>                    
                <div class="col-md-3 col-sm-3 col-xs-3 cube">   
                    <div class="form-group" style="display:none">
                        <label for="addr" class="" style="float:left;">考試地址</label>
                        <input type="text" class="form-control" id="addr" value="<?=$addr_info['part_addr_1']; ?>" readonly>
                    </div>  
                    <div class="form-group">
                        <label for="floor" class="" style="float:left;">樓層別</label>
                        <input type="text" class="form-control" id="floor">
                    </div>                                                       
                </div>     
                <div class="col-md-6 col-sm-6 col-xs-6 " style="float:left;margin: 20px auto;">             
                    <div class="">
                        <div class="">
                            <label for="note" class="" style="float:left;text-align:left;width: 15%;text-align:center;">備註</label>
                            <textarea name="note" id="note" class="" style="width:500px"></textarea>
                        </div>
                    </div>                  
                </div> 
                <div class="col-md-6 col-sm-6 col-xs-6" style="float:left;margin: 20px auto;">             
                    <div class="form-group" style="text-align:right">
                        <div class="">
                            <button type="button" class="btn btn-primary" id="send">儲存</button>
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


