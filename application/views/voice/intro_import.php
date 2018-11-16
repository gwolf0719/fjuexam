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

    <div class='input-group col-sm-3'>
        <div class="input-group-prepend">  
            <span class="input-group-text" id="">場次</span>
        </div>  
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('ladder'); ?>" readonly>
    </div>
</div>

<div class="row">
    
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./voice/a/test_area">
            <img src="assets_voice/images/a1.png" alt="">
        </a>    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <!-- <a href="./designated/a_2"> -->
            <img src="assets_voice/images/a2.png" alt="" style="-webkit-filter:grayscale(1);">
        <!-- </a>     -->
    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./voice/a/staff_member">
            <img src="assets_voice/images/a3.png" alt="">
        </a>    
    </div>
    
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./voice/a/position">
            <img src="assets_voice/images/a4.png" alt="">
        </a>    
    </div>


    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center"></div>

    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center"></div>
    
</div>