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
            var arr = [];
            var no_use = [];
            $(".course").each(function(){
                if($(this).val() == ""){
                    no_use.push($(this).val());
                }else{
                    arr.push($(this).val());
                }
            })
            var nary=arr.sort();
            for(var i=0;i<arr.length;i++){
                if (nary[i]==nary[i+1]){
                    alert("内容重複："+nary[i]);
                }
            }
        })
        
        $("body").on("click","#save",function(){
            if(confirm("是否確定修改？")){
                var year = $("#year").val();
                var course = [];
                $(".course").each(function(){
                    course.push({"course":$(this).attr("id")});
                })
                var course_name = [];
                $(".course").each(function(){
                    course_name.push({"course_name":$(this).val()});
                })    
                var subject = [];
                $(".course").each(function(){
                    subject.push({"subject":$(this).find(":selected").attr("subject")});
                })    
                var date = [];
                $(".course").each(function(){
                    date.push({"date":$(this).find(":selected").attr("date")});
                })     
                $.ajax({
                    url: 'api/add_course',
                    data:{
                        "year":year,
                        "course":course,
                        "course_name":course_name,
                        "subject":subject,
                        "date":date
                    },
                    dataType:"json"
                }).done(function(data){
 
                })     
                // console.log($("#1_1").find(":selected").attr("subject"));
            }
        })
    })

</script>
<?php 
$course_arr = ['', '物理', '化學', '生物', '數學乙', '國文', '英文', '數學甲', '歷史', '地理', '公民與社會'];
// print_r($this->config->item('course'));
?>
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
            <div class="col-4 text-right">第一天</div><div class="col-8 text-left"><?=$datetime_info['day_1']; ?></div>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">上午第一節</div>
            <input type="hidden" name="" id="year" value="<?=$this->session->userdata('year'); ?>">
            <select name="1_1" id="1_1" class="col-8 course" name="上午第一節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                
                    <option value="<?=$v; ?>" subject="<?=$k; ?>" date="<?=$datetime_info['day_1']; ?>"
                        <?php if ($course['1_1'] == $v) {
    echo 'selected';
}  ?> ><?=$v; ?>                    
                    </option> 
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">上午第二節</div>
            <select name="1_2" id="1_2" class="col-8 course" name="上午第二節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$v; ?>"  subject="<?=$k; ?>" date="<?=$datetime_info['day_1']; ?>"  <?php if ($course['1_2'] == $v) {
    echo 'selected';
}  ?> ><?=$v; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">下午第一節</div>
            <select name="1_3" id="1_3" class="col-8 course" name="下午第一節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$v; ?>"  subject="<?=$k; ?>" date="<?=$datetime_info['day_1']; ?>"  <?php if ($course['1_3'] == $v) {
    echo 'selected';
}  ?> ><?=$v; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">下午第二節</div>
            <select name="1_4" id="1_4" class="col-8 course" name="下午第二節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$v; ?>"  subject="<?=$k; ?>" date="<?=$datetime_info['day_1']; ?>"  <?php if ($course['1_4'] == $v) {
    echo 'selected';
}  ?> ><?=$v; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding:20px;">
        <div class="row table-form-title" >
            <div class="col-4 text-right">第二天</div><div class="col-8 text-left"><?=$datetime_info['day_2']; ?></div>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">上午第一節</div>
            <select name="2_1" id="2_1" class="col-8 course" name="上午第一節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$v; ?>"  subject="<?=$k; ?>" date="<?=$datetime_info['day_2']; ?>"  <?php if ($course['2_1'] == $v) {
    echo 'selected';
}  ?> ><?=$v; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">上午第二節</div>
            <select name="2_2" id="2_2" class="col-8 course" name="上午第二節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$v; ?>"  subject="<?=$k; ?>" date="<?=$datetime_info['day_2']; ?>"  <?php if ($course['2_2'] == $v) {
    echo 'selected';
}  ?> ><?=$v; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">下午第一節</div>
            <select name="2_3" id="2_3" class="col-8 course" name="下午第一節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$v; ?>"  subject="<?=$k; ?>" date="<?=$datetime_info['day_2']; ?>"  <?php if ($course['2_3'] == $v) {
    echo 'selected';
}  ?> ><?=$v; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">下午第二節</div>
            <select name="2_4" id="2_4" class="col-8 course" name="下午第二節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$v; ?>"  subject="<?=$k; ?>" date="<?=$datetime_info['day_2']; ?>"  <?php if ($course['2_4'] == $v) {
    echo 'selected';
}  ?> ><?=$v; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding:20px;">
        <div class="row table-form-title" >
            <div class="col-4 text-right">第三天</div><div class="col-8 text-left"><?=$datetime_info['day_3']; ?></div>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">上午第一節</div>
            <select name="3_1" id="3_1" class="col-8 course" name="上午第一節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$v; ?>"  subject="<?=$k; ?>" date="<?=$datetime_info['day_3']; ?>"  <?php if ($course['3_1'] == $v) {
    echo 'selected';
}  ?> ><?=$v; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">上午第二節</div>
            <select name="3_2" id="3_2" class="col-8 course" name="上午第二節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$v; ?>"  subject="<?=$k; ?>" date="<?=$datetime_info['day_3']; ?>"  <?php if ($course['3_2'] == $v) {
    echo 'selected';
}  ?> ><?=$v; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">下午第一節</div>
            <select name="3_3" id="3_3" class="col-8 course" name="下午第一節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$v; ?>"  subject="<?=$k; ?>" date="<?=$datetime_info['day_3']; ?>"  <?php if ($course['3_3'] == $v) {
    echo 'selected';
}  ?> ><?=$v; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">下午第二節</div>
            <select name="3_4" id="3_4" class="col-8 course" name="下午第二節">
                <?php foreach ($this->config->item('course') as $k => $v):?>
                    <option value="<?=$v; ?>"  subject="<?=$k; ?>" date="<?=$datetime_info['day_3']; ?>"  <?php if ($course['3_4'] == $v) {
    echo 'selected';
}  ?> ><?=$v; ?></option>
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