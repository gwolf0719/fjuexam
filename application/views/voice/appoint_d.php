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
    $(function () {

        
        <?php
            $year = $this->session->userdata('year');
            $ladder = $this->session->userdata('ladder');
            if($year =="" || $ladder ==""){   ?>
                
                alert('請輸入學年度跟場次並點選送出');
                history.go(-1);
           <?php } ?>
            
        
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
    
</div>
<div class="row" >
    <input type="hidden" arr="<?php print_r($datalist); ?>" id="arr">
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./voice/d/appoint_d1">
            <img src="assets/images/d1.png" alt="">
        </a>    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./voice/d/appoint_d2">
            <img src="assets/images/d2.png" alt="">
        </a>    
    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./voice/d/appoint_d3">
            <img src="assets/images/d3.png" alt="">
        </a>   
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./voice/d/appoint_d4">
            <img src="assets/images/d4.png" alt="">
        </a>    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./voice/d/appoint_d5">
            <img src="assets/images/d5.png" alt="">
        </a>    
    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./voice/d/appoint_d6">
            <img src="assets/images/d6.png" alt="">
        </a>   
    </div>    
    
</div>