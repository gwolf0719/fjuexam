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
        <img src="assets/images/e_3_1.png" alt="" style="cursor: pointer;" data-toggle="modal" data-target="#e_3_1">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <a href="assets/zip/監試人員考科目日程表.docx" download>
            <img src="assets/images/E301.png" alt="">
        </a>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <img src="assets/images/e_3_2.png" alt="" style="cursor: pointer;" data-toggle="modal" data-target="#e_3_2">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center"></div>

</div>
<!-- Modal start-->
<div class="modal fade" id="e_3_1" tabindex="-1" role="dialog" aria-labelledby="e_3_1" aria-hidden="true">
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
                        <div class="btn_part btn2" link="./designated/e_3_1?part=2501&area=第一分區" part="2501" area="第一分區">第一分區</div>
                        <div class="btn_part btn2" link="./designated/e_3_1?part=2502&area=第二分區" part="2502" area="第二分區">第二分區</div>
                        <div class="btn_part btn2" link="./designated/e_3_1?part=2502&area=第三分區" part="2503" area="第三分區">第三分區</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<!-- Modal start-->
<div class="modal fade" id="e_3_2" tabindex="-1" role="dialog" aria-labelledby="e_3_2" aria-hidden="true">
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
                        <div class="btn_part btn1" link="./designated/e_3_2?part=2501&area=第一分區" part="2501" area="第一分區">第一分區</div>
                        <div class="btn_part btn1" link="./designated/e_3_2?part=2502&area=第二分區" part="2502" area="第二分區">第二分區</div>
                        <div class="btn_part btn1" link="./designated/e_3_2?part=2503&area=第三分區" part="2503" area="第三分區">第三分區</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<script>
$(function(){
    $("body").on("click",".btn1",function(){
        var part = $(this).attr("part");
        var area = $(this).attr("area");
        var link = $(this).attr("link");
        $.ajax({
            url: 'api/chk_part_list',
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

    $("body").on("click",".btn2",function(){
        var part = $(this).attr("part");
        var area = $(this).attr("area");
        var link = $(this).attr("link");
        location.href = link;  
    })
})
</script>