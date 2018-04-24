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
            $("form").submit();
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
        <img src="assets/images/f1_title.png" alt="" style="width: 20%;">
    </div>
    
</div>
  <form action="./designated/f_1_act" method="POST">
<div class="row">
  
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:20px;">
        <div class="row table-form" class="">
            <div class="col-3 text-right">第一天</div>
            <input type="text" class="col-6" id="day_1" name="day_1" value="<?=$datetime_info['day_1'];?>">
            <div class="col-3 "></div>
        </div>
        <div class="row table-form" class="">
            <div class="col-3 text-right">第二天</div>
            <input type="text" class="col-6" id="day_2" name="day_2" value="<?=$datetime_info['day_2'];?>">
            <div class="col-3 "></div>
        </div>
        <div class="row table-form" class="">
            <div class="col-3 text-right">第三天</div>
            <input type="text" class="col-6" id="day_3" name="day_3" value="<?=$datetime_info['day_3'];?>">
            <div class="col-3 "></div>
        </div>
         

    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:20px;"> 
        <div class="row table-form" class="">
            <div class="col-3 text-right">上午預備鈴1</div>
            <input type="text" class="col-6" id="pre_1" name="pre_1" value="<?=$datetime_info['pre_1'];?>">
            <div class="col-3 "></div>
        </div>
        <div class="row table-form" class="">
            <div class="col-3 text-right">上午預備鈴2</div>
            <input type="text" class="col-6" id="pre_2" name="pre_2" value="<?=$datetime_info['pre_2'];?>">
            <div class="col-3 "></div>
        </div>
        <hr>
        <div class="row table-form" class="">
            <div class="col-3 text-right">下午預備鈴1</div>
            <input type="text" class="col-6" id="pre_3" name="pre_3" value="<?=$datetime_info['pre_3'];?>">
            <div class="col-3 "></div>
        </div>
        <div class="row table-form" class="">
            <div class="col-3 text-right">下午預備鈴2</div>
            <input type="text" class="col-6" id="pre_4" name="pre_4" value="<?=$datetime_info['pre_4'];?>">
            <div class="col-3 "></div>
        </div>

        <hr>
        <div class="row table-form" class="">
            <div class="col-3 text-right">上午第一節</div>

            <div class="col-9 text-left input">
                <input type="text" class="" id="course_1_start" name="course_1_start" value="<?=$datetime_info['course_1_start'];?>">
                -
                <input type="text" class="" id="course_1_end" name="course_1_end" value="<?=$datetime_info['course_1_end'];?>">
            </div>
        </div>

        <div class="row table-form" class="">
            <div class="col-3 text-right">上午第二節</div>

            <div class="col-9 text-left input">
                <input type="text" class="" id="course_2_start" name="course_2_start" value="<?=$datetime_info['course_2_start'];?>">
                -
                <input type="text" class="" id="course_2_end" name="course_2_end" value="<?=$datetime_info['course_2_end'];?>">
            </div>
        </div>

        <div class="row table-form" class="">
            <div class="col-3 text-right">下午第一節</div>

            <div class="col-9 text-left input">
                <input type="text" class="" id="course_3_start" name="course_3_start" value="<?=$datetime_info['course_3_start'];?>">
                -
                <input type="text" class="" id="course_3_end" name="course_3_end" value="<?=$datetime_info['course_3_end'];?>">
            </div>
        </div>
        <div class="row table-form" class="">
            <div class="col-3 text-right">下午第二節</div>

            <div class="col-9 text-left input">
                <input type="text" class="" id="course_4_start" name="course_4_start" value="<?=$datetime_info['course_4_start'];?>">
                -
                <input type="text" class="" id="course_4_end" name="course_4_end" value="<?=$datetime_info['course_4_end'];?>">
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