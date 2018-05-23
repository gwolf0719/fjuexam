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
   
</style>
<script>
    $(function(){
        $("body").on("change",".course",function(){
            var this_val = $(this).val();
            var chk = 0;
            if(this_val != "subject_00"){
                $(".course").each(function(k,v){
                    if($(this).val() != "subject_00"){
                        console.log($(this).val());
                        if(($(this).val() == this_val) ){
                            chk = chk+1;
                        }
                    }
                })
                if(chk >  1){
                    alert("設定重複");
                    $(this).val("subject_00");
                }
            }
        })

        var load_json  = <?=$course;?>;
        $.each(load_json,function(k,v){
            $("#"+v['course']).val(v['subject']);
        })
        
        $("body").on("click","#save",function(){
            if(confirm("是否確定修改？")){
                var year = $("#year").val();
                var data = [];
                $(".course").each(function(){
                    data.push({
                        "course":$(this).attr("id"),
                        "subject":$(this).val(),
                        "day":$(this).attr("id").split("_")[0],
                    })
                })
                $.post('api/add_course',{
                    "data":data
                },function(data){
                    console.log(data);
                },"json")
                
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
        <img src="assets/images/f2_title.png" alt="" style="width: 20%;">
    </div>
    
</div>
<form action="" method="POST">
<div class="row">
    
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding:20px;">
        <div class="row table-form-title" >
            <div class="col-5 text-right">第一天</div><div class="col-7 text-left"><?=$datetime_info['day_1']; ?></div>
        </div>
        <div class="row table-form" >
            <div class="col-5 text-right">上午第一節</div>
            <select name="1_1" id="1_1" class="col-7 course" name="上午第一節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$k; ?>" ><?=$v; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-5 text-right">上午第二節</div>
            <select name="1_2" id="1_2" class="col-7 course" name="上午第二節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$k; ?>" ><?=$v; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-5 text-right">下午第一節</div>
            <select name="1_3" id="1_3" class="col-7 course" name="下午第一節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$k; ?>" ><?=$v; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-5 text-right">下午第二節</div>
            <select name="1_4" id="1_4" class="col-7 course" name="下午第二節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$k; ?>" ><?=$v; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding:20px;">
        <div class="row table-form-title" >
            <div class="col-5 text-right">第二天</div><div class="col-87 text-left"><?=$datetime_info['day_2']; ?></div>
        </div>
        <div class="row table-form" >
            <div class="col-5 text-right">上午第一節</div>
            <select name="2_1" id="2_1" class="col-7 course" name="上午第一節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$k; ?>" ><?=$v; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-5 text-right">上午第二節</div>
            <select name="2_2" id="2_2" class="col-7 course" name="上午第二節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$k; ?>" ><?=$v; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-5 text-right">下午第一節</div>
            <select name="2_3" id="2_3" class="col-7 course" name="下午第一節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$k; ?>" ><?=$v; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-5 text-right">下午第二節</div>
            <select name="2_4" id="2_4" class="col-7 course" name="下午第二節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$k; ?>" ><?=$v; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding:20px;">
        <div class="row table-form-title" >
            <div class="col-5 text-right">第三天</div><div class="col-7 text-left"><?=$datetime_info['day_3']; ?></div>
        </div>
        <div class="row table-form" >
            <div class="col-5 text-right">上午第一節</div>
            <select name="3_1" id="3_1" class="col-7 course" name="上午第一節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$k; ?>" ><?=$v; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-5 text-right">上午第二節</div>
            <select name="3_2" id="3_2" class="col-7 course" name="上午第二節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$k; ?>" ><?=$v; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-5 text-right">下午第一節</div>
            <select name="3_3" id="3_3" class="col-7 course" name="下午第一節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$k; ?>" ><?=$v; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-5 text-right">下午第二節</div>
            <select name="3_4" id="3_4" class="col-7 course" name="下午第二節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$k; ?>" ><?=$v; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    

</div>

<div class="row text-right" >
    <div class="col-12">
        <button type="button" class="btn btn-primary" id="save">儲存</button>
    </div>
</div>
</form> 