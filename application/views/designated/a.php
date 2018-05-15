<style>
    @media (min-width: 1200px){
        .container {
            max-width: 100%;
            width: 100%;
        }
    }
    img{
        max-width:100%;
    }
    .cube{
        margin:30px auto;
    }
    .cube img{
        max-width:65%;
    }
</style>
<div class="row">
    <div class="input-group col-sm-3">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>" readonly>
        
        
        
    </div>
    
</div>
<div class="row">
    
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/a_1">
            <img src="assets/images/a1.png" alt="">
        </a>    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/a_2">
            <img src="assets/images/a2.png" alt="">
        </a>    
    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/a_3">
            <img src="assets/images/a3.png" alt="">
        </a>    
    </div>
    
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/a_4">
            <img src="assets/images/a4.png" alt="">
        </a>    
    </div>


    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center"></div>

    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center"></div>
    
</div>