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
   tr{
        cursor:pointer;
    }
</style>
<script>
    $(function(){
        $("body").on("click","#save",function(){
            if(confirm("是否儲存?")){
                $.ajax({
                    url: './subject_ability/api/save_addr',
                    data:{
                        "year":$("#year").val(),
                        "part_addr_1":$("#part_addr_1").val(),
                        "part_addr_2":$("#part_addr_2").val(),
                        "part_addr_3":$("#part_addr_3").val(),
                        "part_addr_4":$("#part_addr_4").val(),
                        "part_addr_5":$("#part_addr_5").val(),
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
    <div class="input-group col-sm-2">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>" readonly>
        
    </div>

    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/c6_title.png" alt="" style="width: 20%;">
    </div>
    
</div>
<form action="./subject_ability/f_1_act" method="POST">
    <div class="row">
    
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:20px;">
            <div class="row table-form" class="">
                <div class="col-3 text-right">第一分區地址</div>
                <input type="hidden" class="col-6" id="year" name="year" value="<?=$_SESSION['year']; ?>">
                <input type="text" class="col-6" id="part_addr_1" name="part_addr_1" value="<?=$addr_info['part_addr_1']; ?>">
                <div class="col-3 "></div>
            </div>
            <div class="row table-form" class="">
                <div class="col-3 text-right">第二分區地址</div>
                <input type="text" class="col-6" id="part_addr_2" name="part_addr_2" value="<?=$addr_info['part_addr_2']; ?>">
                <div class="col-3 "></div>
            </div>
            <div class="row table-form" class="">
                <div class="col-3 text-right">第三分區地址</div>
                <input type="text" class="col-6" id="part_addr_3" name="part_addr_3" value="<?=$addr_info['part_addr_3'];?>">
                <div class="col-3 "></div>
            </div>
            <div class="row table-form" class="">
                <div class="col-3 text-right">第四分區地址</div>
                <input type="text" class="col-6" id="part_addr_4" name="part_addr_4" value="<?=$addr_info['part_addr_4'];?>">
                <div class="col-3 "></div>
            </div>
            <div class="row table-form" class="">
                <div class="col-3 text-right">第五分區地址</div>
                <input type="text" class="col-6" id="part_addr_5" name="part_addr_5" value="<?=$addr_info['part_addr_5'];?>">
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