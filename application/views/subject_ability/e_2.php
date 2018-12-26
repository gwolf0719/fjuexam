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
        <img src="assets/images/e_2_1.png" alt="" style="cursor: pointer;" data-toggle="modal" data-target="#e_2">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <a href="./subject_ability/e_2_5" target="_blank">
            <img src="assets/images/e_2_5.png" alt="">
        </a>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <img src="assets/images/e_2_2.png" alt="" style="cursor: pointer;" data-toggle="modal" data-target="#e_2_2">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <!-- <a href="./subject_ability/e_2_3" target="_blank"> -->
        <img src="assets/images/e_2_3.png" alt="" style="cursor: pointer;" data-toggle="modal" data-target="#e_2_3">
        <!-- </a> -->
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <a href="./subject_ability/e_2_4" target="_blank">
            <img src="assets/images/e_2_4.png" alt="">
        </a>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
    </div>


</div>
<!-- Modal start-->
<div class="modal fade" id="e_2" tabindex="-1" role="dialog" aria-labelledby="e_2" aria-hidden="true">
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
                        <div class="btn_part" data-toggle="modal" data-target="#e_2_1_1">試務人員</div>
                        <div class="btn_part" data-toggle="modal" data-target="#e_2_1_2">管卷人員</div>
                        <div class="btn_part" data-toggle="modal" data-target="#e_2_1_3">巡場人員</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<!-- Modal start-->
<div class="modal fade" id="e_2_1_1" tabindex="-1" role="dialog" aria-labelledby="e_2_1_1" aria-hidden="true">
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
                        <a href="./subject_ability/e_2_1_1?area=考區&part=2500" target="_blank">
                            <div class="btn_part">考區</div>
                        </a>
                        <a href="./subject_ability/e_2_1_1?area=第一分區&part=2501" target="_blank">
                            <div class="btn_part">第一分區</div>
                        </a>
                        <a href="./subject_ability/e_2_1_1?area=第二分區&part=2502" target="_blank">
                            <div class="btn_part">第二分區</div>
                        </a>
                        <a href="./subject_ability/e_2_1_1?area=第三分區&part=2503" target="_blank">
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
<div class="modal fade" id="e_2_1_2" tabindex="-1" role="dialog" aria-labelledby="e_2_1_2" aria-hidden="true">
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
                        <a href="./subject_ability/e_2_1_2?area=第一分區&part=2501" target="_blank">
                            <div class="btn_part">第一分區</div>
                        </a>
                        <a href="./subject_ability/e_2_1_2?area=第二分區&part=2502" target="_blank">
                            <div class="btn_part">第二分區</div>
                        </a>
                        <a href="./subject_ability/e_2_1_2?area=第三分區&part=2503" target="_blank">
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
<div class="modal fade" id="e_2_1_3" tabindex="-1" role="dialog" aria-labelledby="e_2_1_3" aria-hidden="true">
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
                        <a href="./subject_ability/e_2_1_3?area=第一分區&part=2501" target="_blank">
                            <div class="btn_part">第一分區</div>
                        </a>
                        <a href="./subject_ability/e_2_1_3?area=第二分區&part=2502" target="_blank">
                            <div class="btn_part">第二分區</div>
                        </a>
                        <a href="./subject_ability/e_2_1_3?area=第三分區&part=2503" target="_blank">
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
                        <a href="./designated/e_2_2?part=2501&area=第一分區" target="_blank">
                            <div class="btn_part">第一分區</div>
                        </a>
                        <a href="./subject_ability/e_2_2?part=2502&area=第二分區" target="_blank">
                            <div class="btn_part">第二分區</div>
                        </a>
                        <a href="./subject_ability/e_2_2?part=2503&area=第三分區" target="_blank">
                            <div class="btn_part">第三分區</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal start-->
<div class="modal fade" id="e_2_3" tabindex="-1" role="dialog" aria-labelledby="e_2_3" aria-hidden="true">
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
                        <div class="btn_part" data-toggle="modal" data-target="#e_2_3_1">第一分區</div>
                        <div class="btn_part" data-toggle="modal" data-target="#e_2_3_2">第二分區</div>
                        <div class="btn_part" data-toggle="modal" data-target="#e_2_3_3">第三分區</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal start-->
<div class="modal fade" id="e_2_3_1" tabindex="-1" role="dialog" aria-labelledby="e_2_3_1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title" id="exampleModalLabel" style="">選擇日期</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="btn_part btn1" link="./subject_ability/e_2_3_1?part=2501&area=第一分區" part="2501" area="第一分區"><?=mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?></div>
                        <div class="btn_part btn1" link="./subject_ability/e_2_3_2?part=2501&area=第一分區" part="2501" area="第一分區"><?=mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?></div>
                        <div class="btn_part btn1" link="./subject_ability/e_2_3_3?part=2501&area=第一分區" part="2501" area="第一分區"><?=mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal start-->
<div class="modal fade" id="e_2_3_2" tabindex="-1" role="dialog" aria-labelledby="e_2_3_2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title" id="exampleModalLabel" style="">選擇日期</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="btn_part btn1" link="./subject_ability/e_2_3_1?part=2502&area=第二分區" part="2502" area="第二分區"><?=mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?></div>
                        <div class="btn_part btn1" link="./subject_ability/e_2_3_2?part=2502&area=第二分區" part="2502" area="第二分區"><?=mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?></div>
                        <div class="btn_part btn1" link="./subject_ability/e_2_3_3?part=2502&area=第二分區" part="2502" area="第二分區"><?=mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal start-->
<div class="modal fade" id="e_2_3_3" tabindex="-1" role="dialog" aria-labelledby="e_2_3_3" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title" id="exampleModalLabel" style="">選擇日期</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="btn_part btn1" link="./subject_ability/e_2_3_1?part=2503&area=第三分區" part="2503" area="第三分區"><?=mb_substr($datetime_info['day_1'], 5, 8, 'utf-8'); ?></div>
                        <div class="btn_part btn1" link="./subject_ability/e_2_3_2?part=2503&area=第三分區" part="2503" area="第三分區"><?=mb_substr($datetime_info['day_2'], 5, 8, 'utf-8'); ?></div>
                        <div class="btn_part btn1" link="./subject_ability/e_2_3_3?part=2503&area=第三分區" part="2503" area="第三分區"><?=mb_substr($datetime_info['day_3'], 5, 8, 'utf-8'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $("body").on("click",".btn1",function(){
        var part = $(this).attr("part");
        var area = $(this).attr("area");
        var link = $(this).attr("link");        
        $.ajax({
            url: './subject_ability/api/chk_part_list',
            data: {
                part: part,
                area: area,
            },
            dataType: "json"
        }).done(function(data) {
            alert(data.sys_msg);
            if (data.sys_code == "200") {
                location.href = link;  
            }
        })   
    })
})
</script>