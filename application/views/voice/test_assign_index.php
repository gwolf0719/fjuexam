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
            if($year =="" || $ladder ==""){ ?>

                alert('請輸入學年度跟場次並點選送出')
                history.go(-1);
        <?php  }?>  

    })


</script>
<div class="row">
    <div class="input-group col-sm-3">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>" readonly>
        <input type="text" class="form-control"  value="<?=$this->session->userdata('ladder'); ?>" style="width:100px;" readonly>
        
        
    </div>
    
</div>
<div class="row" >
   
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./voice/c/assign/2501">
            <img src="assets/images/c1.png" alt="">
        </a>    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./voice/c/assign/2502">
            <img src="assets/images/c2.png" alt="">
        </a>    
    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./voice/c/assign/2503">
            <img src="assets/images/c3.png" alt="">
        </a>    
    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./voice/c/assign_cs">
            <img src="assets/images/c4a.png" alt="">
        </a>    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
     
            
    </div> 
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        
    </div> 
    
    
</div>