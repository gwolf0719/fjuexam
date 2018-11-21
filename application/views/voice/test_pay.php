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
    .btn-margin{
        margin-top: 83px;
    }
   
</style>
<script>
    $(function(){
        $("body").on("click","#save",function(){
            if(confirm("是否儲存?")){
                $.ajax({
                    url: './voice/api/save_pay',
                    data:{
                        "year":$("#year").val(),
                        'ladder':$('#ladder').val(),
                        "pay_1":$("#one_day_salary").val(),
                        "pay_2":$("#salary_section").val(),
                       
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
        <img src="assets/images/f4_title.png" alt="" style="width: 20%;">
    </div>
    
</div>
<form action="./designated/f_1_act" method="POST">
    <div class="row">
    
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:20px;">
            <div class="row table-form" class="">
                <div class="col-3 text-right">一日薪資</div>
                <input type="hidden" class="col-6" id="year" name="year" value="<?=$_SESSION['year']; ?>">
                <input type="hidden" class="col-6" id="ladder" name="ladder" value="<?=$_SESSION['ladder']; ?>">
                <input type="text" class="col-6" id="one_day_salary" name="one_day_salary" value='<?=$data_pay['pay_1'];?>' >
                <div class="col-3 "></div>
            </div>
            <div class="row table-form" class="">
                <div class="col-3 text-right">一節薪資</div>
                <input type="text" class="col-6" id="salary_section" name="salary_section" value='<?=$data_pay['pay_2'];?>'>
                <div class="col-3 "></div>
            </div>
        </div>
        <div class="row text-right" >
            <div class="col-12">
                <button type="button" class="btn btn-primary btn-margin" id="save">儲存</button>
            </div>

        </div>
    </div>

    
</form>