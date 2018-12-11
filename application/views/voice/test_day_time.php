<style>
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
   
</style>
<script>
    $(function(){
        $("body").on("click","#save",function(){
           
            $.ajax({
                url: './voice/api/save_datetime',
                data:{
                    "year":$("#year").val(),
                    "ladder":$("#ladder").val(),
                    "day":$("#day").val(),
                    "pre_1":$("#pre_1").val(),
                    "pre_2":$("#pre_2").val(),
                    "course_1_start":$("#course_1_start").val(),
                    "course_1_end":$("#course_1_end").val(),
                    "course_2_start":$("#course_2_start").val(),
                    "course_2_end":$("#course_2_end").val(),
                },
                dataType:"json"
            }).done(function(data){
                    alert(data.sys_msg);
                if(data.sys_code == "200"){
                    location.reload();
                }      
            })
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
            <input type="text" id="ladder" class="form-control"  value="<?=$this->session->userdata('ladder'); ?>" style="width:100px;" readonly>
            
        </div>
    </div>
    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/f1_title.png" alt="" style="width: 20%;">
    </div>
    
</div>
<form action="./designated/f_1_act" method="POST">
    <div class="row">
    
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:20px;">
            <div class="row table-form" class="">
                <div class="col-3 text-right">第一天</div>
                <input type="hidden" class="col-6" id="year" name="year" value="<?=$this->session->userdata('year'); ?>">
                <input type="text" class="col-6" id="day" name="day" value="<?=$datetime_info['day']; ?>" placeholder="例：2018年01月01日">
                <div class="col-3 "></div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:20px;"> 
            <div class="row table-form" class="">
                <div class="col-4 text-right">上午預備鈴1</div>
                <input type="text" class="col-7" id="pre_1" name="pre_1" value="<?=$datetime_info['pre_1']; ?>" placeholder="例：00:00">
                
            </div>
            <hr>
            <div class="row table-form" class="">
                <div class="col-4 text-right">下午預備鈴1</div>
                <input type="text" class="col-7" id="pre_2" name="pre_2" value="<?=$datetime_info['pre_2']; ?>" placeholder="例：00:00">
                
            </div>
            <hr>
            <div class="row table-form" class="">
                <div class="col-3 text-right">上午第一節</div>
                <div class="col-9">
                    <div class="row form-inline">
                        <input type="text" class="form-control col-6" id="course_1_start" name="course_1_start" value="<?=$datetime_info['course_1_start']; ?>" placeholder="例：00:00">
                        <input type="text" class="form-control col-6" id="course_1_end" name="course_1_end" value="<?=$datetime_info['course_1_end']; ?>" placeholder="例：00:00">
                    </div>
                </div>
            </div>
            <div class="row table-form" class="">
                <div class="col-3 text-right">下午第一節</div>
                <div class="col-9">
                    <div class="row form-inline">
                        <input type="text" class="form-control col-6" id="course_2_start" name="course_2_start" value="<?=$datetime_info['course_2_start']; ?>" placeholder="例：00:00">
                        <input type="text" class="form-control col-6" id="course_2_end" name="course_2_end" value="<?=$datetime_info['course_2_end']; ?>" placeholder="例：00:00">
                    </div>
                </div>
            </div>
        </div>
    
        

    </div>
    <div class="row text-right" >
        <div class="col-12">
            <button type="button" class="btn btn-primary" id="save">儲存</button>
        </div>
    </div>
</form>