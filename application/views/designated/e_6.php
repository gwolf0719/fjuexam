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
        <a href="./designated/e_6_1" target="_blank">
            <img src="assets/images/e_6_1.png" alt="">
        </a>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center"></div>
</div>