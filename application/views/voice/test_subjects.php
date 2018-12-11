<style>
    .table-form-title{
        width:80%;
        background:#ddd;
        margin:0 auto;
        line-height:42px;
    }
    .table-form{
        width:80%;
        background:#ddd;
        text-align:center;
        padding:10px;
        margin:0 auto;
    }
    .input{
        text-align:left;
        margin-left:0px;
        padding-left:0px;
    }
    .btn-margin{
        margin-top: 125px;
    }
   
</style>
<script>
        /**取得預設填寫資料結束 */
     $(function(){   
        $("body").on("click","#save",function(){
            if(confirm("是否確定修改？")){
            //    console.log($('#2_2').val());
               $.ajax({
                    url: './voice/api/save_subject',
                    data:{
                        "year":$("#year").val(),
                        'ladder':$('#ladder').val(),
                        'subject_1': $('#1_1').val(),
                        'subject_2': $('#2_2').val(),

                    },
                    dataType:'json'
               }).done(function (data) {
                   alert(data.sys_msg)
                   if (data.sys_code == '200') {
                       location.reload();
                   }
               })
              
               
            }
        })
    })

</script>
<div class="row">
    <div class="p-2 "  style="width:300px;">
        <div class="input-group">

            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
            </div>
            <input type="text" class="form-control"  value="<?=$this->session->userdata('year'); ?>" style="width:60px;" readonly>
            <input type="text" class="form-control"  value="<?=$this->session->userdata('ladder'); ?>" style="width:100px;" readonly>
            
        </div>
    </div>
    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/f2_title.png" alt="" style="width: 20%;">
    </div>
    
</div>

<form action="" method="POST">
<div class="row">
    
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding:20px;">
        <div class="row table-form-title" >
            <div class="col-5 text-right">考試日期</div><div class="col-7 text-left"><?=$datetime_info['day']; ?></div>
        </div>
        <div class="row table-form" >
            
            <div class="col-5 text-right">上午場</div>
            <input type="hidden" class="col-6" id="year" name="year" value="<?=$_SESSION['year']; ?>">
                <input type="hidden" class="col-6" id="ladder" name="ladder" value="<?=$_SESSION['ladder']; ?>">
            <select name="1_1" id="1_1" class="col-7 course" name="上午場">
                    <option><?=$data_subject['subject_1'];?></option> 
            </select>
        </div>
       
        <div class="row table-form" >
            <div class="col-5 text-right">下午場</div>
            <select name="1_1" id="2_2" class="col-7 course" name="下午場">
                    <option><?=$data_subject['subject_2']; ?></option> 
            </select>
        </div>
       
    </div>
    <div class="row text-right" >
    <div class="col-12">
        <button type="button" class="btn btn-primary btn-margin" id="save">儲存</button>
    </div>

</div>
</duv>
   


</form> 