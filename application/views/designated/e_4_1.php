<style>
    img {
        max-width: 100%;
    }

    @media (min-width: 1200px) {
        .container {
            max-width: 100%;
            width: 100%;
        }
    }

    .cube {
        margin: 20px auto;
    }

    .cube img {
        max-width: 65%;
    }

    .W20 {
        width: 20%;
        float: left;
    }

    .W80 {
        width: 80%;
        float: left;
    }
</style>

<div class="input-group W20">

    <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
    </div>
    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>"
        readonly>
</div>

<div class="W80" style="text-align: left;padding-left: 6%;">
    <img src="assets/images/e4.png" alt="" style="width: 30%;margin-right: 20px;">
    <img src="assets/images/e_4_1.png" alt="" style="width: 30%;">
</div>

<div style="clear:both"></div>

<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <a href="./designated/e_3_1" target="_blank">
            <img src="assets/images/e_4_1_1.png" alt="">
        </a>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <a href="assets/zip/監試人員書函.zip" download>
            <img src="assets/images/e_4_1_2.png" alt="">
        </a>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center"></div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <a href="assets/zip/試務人員書函.zip" download>
            <img src="assets/images/e_4_1_3.png" alt="">
        </a>
    </div>





</div>