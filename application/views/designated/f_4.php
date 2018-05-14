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
                url: 'api/add_fee',
                data:{
                    "year":$("#year").val(),
                    "one_day_salary":$("#one_day_salary").val(),
                    "salary_section":$("#salary_section").val(),
                    "lunch_fee":$("#lunch_fee").val()
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
    <div class="input-group col-sm-2">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>" readonly>
        
    </div>

    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/f4_title.png" alt="" style="width: 20%;">
    </div>
    
</div>
<form action="./designated/f_1_act" method="POST">
    <div class="row">
    
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:20px;">
            <div class="row table-form" class="">
                <div class="col-3 text-right">一日薪資</div>
                <input type="hidden" class="col-6" id="year" name="year" value="<?=$_SESSION['year']; ?>">
                <input type="text" class="col-6" id="one_day_salary" name="one_day_salary" value="<?=$fees_info['one_day_salary']; ?>">
                <div class="col-3 "></div>
            </div>
            <div class="row table-form" class="">
                <div class="col-3 text-right">一節薪資</div>
                <input type="text" class="col-6" id="salary_section" name="salary_section" value="<?=$fees_info['salary_section']; ?>">
                <div class="col-3 "></div>
            </div>
            <div class="row table-form" class="">
                <div class="col-3 text-right">便當費</div>
                <input type="text" class="col-6" id="lunch_fee" name="lunch_fee" value="<?=$fees_info['lunch_fee'];?>">
                <div class="col-3 "></div>
            </div>
        </div>
    </div>

    <div class="row text-right" >
        <div class="col-12">
            <button type="button" class="btn btn-primary" id="save">儲存</button>
        </div>
    </div>
</form>