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
</style>
<div class="row">
    <div class="input-group col-sm-3">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>"
            readonly>

    </div>

</div>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <a href="./designated/e_1">
            <img src="assets/images/e1.png" alt="">
        </a>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <a href="./designated/e_2">
            <img src="assets/images/e2.png" alt="">
        </a>

    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <a href="./designated/e_3">
            <img src="assets/images/e3.png" alt="">
        </a>

    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <!-- <a href="./designated/e_4"> -->
        <img src="assets/images/e4.png" alt="">
        <!-- </a> -->
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <!-- <a href="./designated/e_5"> -->
        <img src="assets/images/e5.png" alt="">
        <!-- </a> -->
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <a href="./designated/e_6">
            <img src="assets/images/e6.png" alt="">
        </a>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <!-- <a href="./designated/e_7"> -->
        <img src="assets/images/e7.png" alt="">
        <!-- </a> -->
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
    </div>

</div>