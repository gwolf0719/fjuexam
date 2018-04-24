<style>
    img{
        max-width:100%;
    }
    .cube{
        margin:25px auto;
    }
</style>
<div class="row">
    <div class="input-group col-sm-3">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>">
        
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button">送出</button>
        </div>
        
    </div>
    
</div>
<div class="row" style="">
    
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube">
        <a href="./designated/a">
            <img src="assets/images/a.png" alt="">
        </a>    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube">
        <a href="./designated/b">
            <img src="assets/images/b.png" alt="">
        </a>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube">
        <!-- <a href="./designated/c"> -->
            <img src="assets/images/c.png" alt="">
        <!-- </a> -->
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube">
        <!-- <a href="./designated/d"> -->
            <img src="assets/images/d.png" alt="">
        <!-- </a> -->
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube">
        <!-- <a href="./designated/e"> -->
            <img src="assets/images/e.png" alt="">
        <!-- </a> -->
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube">
        <a href="./designated/f">
            <img src="assets/images/f.png" alt="">
        </a>
    </div>
    
</div>