<style>
    img{
        max-width:100%;
    }
    .cube{
        margin:80px auto;
    }
</style>
<div class="row">
    <div class="input-group col-sm-3">

      <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>" readonly>
        <input type="text" class="form-control"  value="<?=$this->session->userdata('ladder'); ?>" style="width:100px;" readonly>
        
    </div>
</div>
<div class="row">
    
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 cube">
        <a href="./voice/f/test_day_time">
            <img src="assets/images/f1.png" alt="">
        </a>    
    </div>

    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 cube">
        <a href="./designated/f_2">
            <img src="assets/images/f2.png" alt="">
        </a>    
    </div>

    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 cube">
        <a href="./designated/f_3">
            <img src="assets/images/f3.png" alt="">
        </a>    
    </div>

    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 cube">
        <a href="./designated/f_4">
            <img src="assets/images/f4.png" alt="">
        </a>    
    </div>    
    
</div>