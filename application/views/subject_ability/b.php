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
<div class="row">
    <div class="input-group col-sm-3">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>" readonly>
        
        
        
    </div>
    
</div>
<div class="row" >
    
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 cube text-center">
        <a href="./subject_ability/b_1">
            <img src="assets/images/b1.png" alt="">
        </a>    
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 cube text-center">
        <a href="./subject_ability/b_2">
            <img src="assets/images/b2.png" alt="">
        </a>    
    
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 cube text-center">
        <a href="./subject_ability/b_3">
            <img src="assets/images/b3.png" alt="">
        </a>    
    
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 cube text-center">
        <a href="./subject_ability/b_4">
            <img src="assets/images/b4.png" alt="">
        </a>    
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 cube text-center">
        <a href="./subject_ability/b_5">
            <img src="assets/images/b5n.png" alt="">
        </a>    
    </div> 
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 cube text-center">
        <a href="./subject_ability/b_6">
            <img src="assets/images/b6.png" alt="">
        </a>    
    </div> 
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 cube text-center">
        <a href="./subject_ability/b_7">
            <img src="assets/images/b7.png" alt="">
        </a>    
    </div> 

    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 cube text-center">

    </div> 

    
</div>