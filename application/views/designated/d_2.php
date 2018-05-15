
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
    height: 256px;
}
.cube1{
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
</style>

<script>
$(function(){

    $(window).on("load",function(){
        var addr = $("#addr").val();
        // console.log(arr);
        if(addr == ""){
            alert("目前 C1 考試地址尚未填寫資料，請先填寫資料再進行操作");
            location.href="./designated/c_4";
        }
    })

    /**自動完成 */
    var data ;
    $.getJSON("./api/get_member_info",function(data){
        data = data.info;
        // console.log(data);
        var $input = $(".typeahead");
            $input.typeahead({
            source: data,
            autoSelect: true,
        });
    })

    $("body").on("click","#sure1",function(){
        var code = $("#number_1").val().substr(0,4);
        var name = $("#number_1").val().substr(7,8);
        $("#supervisor_1").val(name);
        $("#supervisor_1_code").val(code);
        $('#exampleModal1').modal('hide');
    })

    $("body").on("click","#sure2",function(){
        var code = $("#number_2").val().substr(0,4);
        var name = $("#number_2").val().substr(7,8);
        $("#supervisor_2").val(name);
        $("#supervisor_2_code").val(code);
        $('#exampleModal2').modal('hide');
    })

    $("body").on("click","#sure3",function(){
        var code = $("#number_3").val().substr(0,4);
        var name = $("#number_3").val().substr(7,8);
        $("#trial_staff").val(name);
        $('#exampleModal3').modal('hide');
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
            $("#field").val(data.info.field);
            $("#start").val(data.info.start);
            $("#end").val(data.info.end);
            $("#floor").val(data.info.floor);
            $("#number").val(data.info.number);
            $("#section").val(data.info.test_section);
            // $("#note").val(data.info.note);
        })
    })

    $("body").on("click","#send",function(){
        if(confirm("是否要儲存?")){
            var sn = $("#sn").val();
            var supervisor_1 = $("#supervisor_1").val();
            var supervisor_1_code = $("#supervisor_1_code").val();
            var supervisor_2 = $("#supervisor_2").val();
            var supervisor_2_code = $("#supervisor_2_code").val();          
            var trial_staff = $("#trial_staff").val();
            var trial_staff_code = $("#trial_staff_code").val();
            var note = $("textarea[name='note']").val();
            console.log(sn);
            $.ajax({
                url: 'api/save_trial',
                data:{
                    "sn":sn,
                    "supervisor_1":supervisor_1,
                    "supervisor_1_code":supervisor_1_code,
                    "supervisor_2":supervisor_2,
                    "supervisor_2_code":supervisor_2_code,                    
                    "trial_staff":trial_staff,
                    "trial_staff_code":trial_staff_code,
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
        <img src="assets/images/d2_title.png" alt="" style="width: 15%;">
    </div>
    
</div>

<div class="row" style="height:700px;overflow: auto;">
   <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>試場</th>
                    <th>考試節數</th>
                    <th>考生應試號起</th>
                    <th>考生應試號迄</th>
                    <th>應試人數</th>
                    <th>樓層別</th>
                    <th>監試人員一</th>
                    <th>監試人員二</th>
                    <th>試務人員編號</th>
                    <th>試務人員</th>
                    <th>備註</th>                    
                </tr>
            </thead>
            <tbody>
            <?php foreach ($assign as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['field']; ?></td>
                    <td><?=$v['test_section']; ?></td>
                    <td><?=$v['start']; ?></td>
                    <td><?=$v['end']; ?></td>                   
                    <td><?=$v['number']; ?></td>
                    <td><?=$v['floor']; ?></td>
                    <td><?=$v['supervisor_1']; ?></td>
                    <td><?=$v['supervisor_2']; ?></td>
                    <td><?=$v['trial_staff_code']; ?></td>
                    <td><?=$v['trial_staff']; ?></td>                       
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
                        <label for="field" class=""  style="float:left;">試場</label>
                        <input type="text" class="form-control" id="field" readonly>
                        <input type="hidden" class="form-control" id="sn">
                    </div>     
                    <div class="form-group">
                        <label for="section" class=""  style="float:left;">考試節數</label>
                        <input type="text" class="form-control" id="section" readonly>
                    </div>  
                    <div class="form-group">
                        <label for="start" class=""  style="float:left;">考生應試號起</label>
                        <input type="text" class="form-control" id="start" readonly>
                    </div>                  
                    <div class="form-group">
                        <label for="end" class=""  style="float:left;">考生應試號迄</label>
                        <input type="text" class="form-control" id="end" readonly>
                    </div>                        
                </div>              
                <div class="col-md-3 col-sm-3 col-xs-3 cube">
                    <div class="form-group">
                        <label for="number" class="" style="float:left;">應試人數</label>
                        <input type="text" class="form-control" id="number" readonly>
                    </div>      
                    <div class="form-group">
                        <label for="floor" class="" style="float:left;">樓層別</label>
                        <input type="text" class="form-control" id="floor" readonly>
                    </div>                                                       
                </div>     
                <div class="col-md-3 col-sm-3 col-xs-3 cube">
                    <div class="form-group" style="width: 100%;float: left;">
                        <label for="number" class="" style="float:left;">監試人員一</label>
                        <input type="text" class="form-control" id="supervisor_1" style="width: 40%;float: left;">
                        <input type="hidden" class="form-control" id="supervisor_1_code">
                        <button type="button" class="btn btn-primary assgin" data-toggle="modal" data-target="#exampleModal1" style="float:left;width:15%;margin-left:5px;">指派</button>
                    </div>      
                    <div class="form-group" style="width: 100%;float: left;">
                        <label for="floor" class="" style="float:left;">監試人員二</label>
                        <input type="text" class="form-control" id="supervisor_2" style="width: 40%;float: left;">
                        <input type="hidden" class="form-control" id="supervisor_2_code">
                        <button type="button" class="btn btn-primary assgin" data-toggle="modal" data-target="#exampleModal2" style="float:left;width:15%;margin-left:5px;">指派</button>
                    </div>    
                    <div class="form-group" style="width: 100%;float: left;">
                        <label for="floor" class="" style="float:left;">試務人員</label>
                        <input type="text" class="form-control" id="trial_staff_code" style="width: 20%;float: left;" placeholder="分配編號">
                        <input type="text" class="form-control" id="trial_staff" style="width: 25%;float: left;margin-left: 5px;">
                        <button type="button" class="btn btn-primary assgin" data-toggle="modal" data-target="#exampleModal3" style="float:left;width:15%;margin-left:5px;">指派</button>
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
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
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
                            <p>關鍵字<input type="text" class="typeahead" id="number_1"></p>
                        </div>
                    </div>       
                    <div class="" style="text-align: right;margin: 20px;">
                        <button type="button" class="btn btn-primary" id="sure1">確定指派</button>
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
<!-- Modal start-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
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
                            <p>關鍵字<input type="text" class="typeahead" id="number_2"></p>
                        </div>
                    </div>       
                    <div class="" style="text-align: right;margin: 20px;">
                        <button type="button" class="btn btn-primary" id="sure2">確定指派</button>
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
<!-- Modal start-->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
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
                            <p>關鍵字<input type="text" class="typeahead" id="number_3"></p>
                        </div>
                    </div>       
                    <div class="" style="text-align: right;margin: 20px;">
                        <button type="button" class="btn btn-primary" id="sure3">確定指派</button>
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


