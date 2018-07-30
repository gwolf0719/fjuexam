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

    .btn_part {
        background: #dc969d;
        text-align: center;
        padding: 8px;
        border-radius: 5px;
        margin: 10px auto;
        cursor: pointer;
        width: 150px;
    }

    a {
        text-decoration: none;
        color: #000;
    }

    a:hover {
        text-decoration: none;
        color: #000;
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
        <img src="assets/images/e_2_1.png" alt="" style="cursor: pointer;" data-toggle="modal" data-target="#e_2_1">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <img src="assets/images/e_2_5.png" alt="" style="cursor: pointer;" data-toggle="modal" data-target="#e_2_5">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <img src="assets/images/e_2_2.png" alt="" style="cursor: pointer;" data-toggle="modal" data-target="#e_2_2">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <!-- <a href="./designated/e_2_3" target="_blank"> -->
        <img src="assets/images/e_2_3.png" alt="">
        <!-- </a> -->
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <img src="assets/images/e_2_4.png" alt="" style="cursor: pointer;" data-toggle="modal" data-target="#e_2_4">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
    </div>


</div>
<!-- Modal start-->
<div class="modal fade" id="e_2_1" tabindex="-1" role="dialog" aria-labelledby="e_2_1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title" id="exampleModalLabel" style="">選擇分區</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <a href="./designated/e_2_1?area=考區">
                            <div class="btn_part">考區</div>
                        </a>
                        <a href="./designated/e_2_1?area=第一分區">
                            <div class="btn_part">第一分區</div>
                        </a>
                        <a href="./designated/e_2_1?area=第二分區">
                            <div class="btn_part">第二分區</div>
                        </a>
                        <a href="./designated/e_2_1?area=第三分區">
                            <div class="btn_part">第三分區</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<!-- Modal start-->
<div class="modal fade" id="e_2_2" tabindex="-1" role="dialog" aria-labelledby="e_2_2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title" id="exampleModalLabel" style="">選擇分區</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <a href="./designated/e_2_2?part=2501&area=第一分區">
                            <div class="btn_part">第一分區</div>
                        </a>
                        <a href="./designated/e_2_2?part=2502&area=第二分區">
                            <div class="btn_part">第二分區</div>
                        </a>
                        <a href="./designated/e_2_2?part=2503&area=第三分區">
                            <div class="btn_part">第三分區</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<div class="modal fade" id="e_2_4" tabindex="-1" role="dialog" aria-labelledby="e_2_4" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title" id="exampleModalLabel" style="">選擇分區</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <a href="./designated/e_2_4?area=考區">
                            <div class="btn_part">考區</div>
                        </a>
                        <a href="./designated/e_2_4?area=第一分區">
                            <div class="btn_part">第一分區</div>
                        </a>
                        <a href="./designated/e_2_4?area=第二分區">
                            <div class="btn_part">第二分區</div>
                        </a>
                        <a href="./designated/e_2_4?area=第三分區">
                            <div class="btn_part">第三分區</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<!-- Modal end-->
<div class="modal fade" id="e_2_5" tabindex="-1" role="dialog" aria-labelledby="e_2_5" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title" id="exampleModalLabel" style="">選擇分區</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <a href="./designated/e_2_5?area=考區">
                            <div class="btn_part">考區</div>
                        </a>
                        <a href="./designated/e_2_5?area=第一分區">
                            <div class="btn_part">第一分區</div>
                        </a>
                        <a href="./designated/e_2_5?area=第二分區">
                            <div class="btn_part">第二分區</div>
                        </a>
                        <a href="./designated/e_2_5?area=第三分區">
                            <div class="btn_part">第三分區</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->