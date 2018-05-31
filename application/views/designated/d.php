<style>
    img{
        max-width:100%;
    }
    @media (min-width: 1200px){
        .container {
            max-width: 100%;
            width: 100%;
        }
    }    
    .cube{
        margin:20px auto;
    }
    .cube img{
        max-width:65%;
    }
</style>
<script>
$(function(){
    $(window).on("load",function(){
        var arr = <?php print_r($datalist); ?>;
        if(arr == ""){
            alert("目前 C 試場分配資料尚未匯入資料，請先匯入資料再進行操作");
            location.href="./designated/a_1";
        }
    })
})
</script>
<div class="row">
    <div class="input-group col-sm-3">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>" readonly>
        
        
        
    </div>
    
</div>
<div class="row" >
    <input type="hidden" arr="<?php print_r($datalist); ?>" id="arr">
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/d_1">
            <img src="assets/images/d1.png" alt="">
        </a>    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/d_2">
            <img src="assets/images/d2.png" alt="">
        </a>    
    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/d_3">
            <img src="assets/images/d3.png" alt="">
        </a>   
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/d_4">
            <img src="assets/images/d4.png" alt="">
        </a>    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/d_5">
            <img src="assets/images/d5.png" alt="">
        </a>    
    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/d_6">
            <img src="assets/images/d6.png" alt="">
        </a>   
    </div>    
    
</div>