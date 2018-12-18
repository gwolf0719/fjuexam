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
            <input type="text" class="form-control"  value="<?=$this->session->userdata('ladder'); ?>" style="width:100px;" readonly>

    </div>

</div>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <a href="./voice/e/form_e1_1" target="_blank">
            <img src="assets/images/e_1_1.png" alt="">
        </a>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center"></div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <a href="./voice/e/form_e1_2" target="_blank">
            <img src="assets/images/e_1_2.png" alt="">
        </a>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <img src="assets/images/e_1_3.png" alt="" style="cursor: pointer;" data-toggle="modal" data-target="#staff">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <img src="assets/images/e_1_4.png" alt="" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal2">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
    </div>
</div>
<!-- Modal start-->
<div class="modal fade" id="staff" tabindex="-1" role="dialog" aria-labelledby="staff" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title" id="exampleModalLabel" style="">選擇人員</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="btn_part" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal">監試人員</div>
                        <div class="btn_part" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal4">試務人員</div>
                        <div class="btn_part" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal5">管卷人員</div>
                        <div class="btn_part" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal6">巡場人員</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<!-- Modal start-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
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
                        <div class="btn_part btn1" part="2501" area="第一分區" year='<?=$this->session->userdata('year');?>' ladder='<?=$this->session->userdata('ladder');?>' link="./voice/form_e1_3?part=2501&area=第一分區">第一分區</div>
                        <div class="btn_part btn1" part="2502" area="第二分區" year='<?=$this->session->userdata('year');?>' ladder='<?=$this->session->userdata('ladder');?>' link="./voice/form_e1_3?part=2502&area=第二分區">第二分區</div>
                        <div class="btn_part btn1" part="2503" area="第三分區" year='<?=$this->session->userdata('year');?>' ladder='<?=$this->session->userdata('ladder');?>' link="./voice/form_e1_3?part=2503&area=第三分區">第三分區</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<!-- Modal start-->
<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModal4" aria-hidden="true">
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
                        <div class="btn_part btn2" part="2500" area="考區" link="./designated/e_1_3_3?part=2501&area=考區">考區</div>
                        <div class="btn_part btn2" part="2501" area="第一分區" link="./designated/e_1_3_3?part=2501&area=第一分區">第一分區</div>
                        <div class="btn_part btn2" part="2502" area="第二分區" link="./designated/e_1_3_3?part=2502&area=第二分區">第二分區</div>
                        <div class="btn_part btn2" part="2503" area="第三分區" link="./designated/e_1_3_3?part=2503&area=第三分區">第三分區</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->

<!-- Modal start-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal4" aria-hidden="true">
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
                        <a href="./designated/e_1_4?part=2501&area=第一分區" target="_blank">
                            <div class="btn_part">第一分區</div>
                        </a>
                        <a href="./designated/e_1_4?part=2502&area=第二分區" target="_blank">
                            <div class="btn_part">第二分區</div>
                        </a>
                        <a href="./designated/e_1_4?part=2503&area=第三分區" target="_blank">
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
<div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModal5" aria-hidden="true">
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
                        <a href="./designated/e_1_3_4?part=2501&area=第一分區" target="_blank">
                            <div class="btn_part">第一分區</div>
                        </a>
                        <a href="./designated/e_1_3_4?part=2502&area=第二分區" target="_blank">
                            <div class="btn_part">第二分區</div>
                        </a>
                        <a href="./designated/e_1_3_4?part=2503&area=第三分區" target="_blank">
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
<div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModal6" aria-hidden="true">
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
                        <a href="./designated/e_1_3_5?part=2501&area=第一分區" target="_blank">
                            <div class="btn_part">第一分區</div>
                        </a>
                        <a href="./designated/e_1_3_5?part=2502&area=第二分區" target="_blank">
                            <div class="btn_part">第二分區</div>
                        </a>
                        <a href="./designated/e_1_3_5?part=2503&area=第三分區" target="_blank">
                            <div class="btn_part">第三分區</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<script>
    $(function() {
        $("body").on("click", ".btn1", function() {
            var part = $(this).attr("part");
            var year = $(this).attr('year');
            var ladder = $(this).attr('ladder');
            var area = $(this).attr('area');
            var link = $(this).attr("link");
            console.log(area);
            $.ajax({
                url: './voice/api/chk_part_list',
                data: {
                    year:year,
                    ladder:ladder,
                    part: part,
                    area:area,
                   
                },
                dataType: "json"
            }).done(function(data) {
                alert(data.sys_msg);
                if (data.sys_code == "200") {
                    location.href = link;
                }
            })
        })
        $("body").on("click", ".btn2", function() {
            var part = $(this).attr("part");
            var area = $(this).attr("area");
            var link = $(this).attr("link");
            location.href = link;
        })        
    })
</script>