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
        width: 230px;
        display: inline-block;
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
        <img src="assets/images/e_6_1.png" alt="" style="cursor: pointer;" data-toggle="modal" data-target="#e_6">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center"></div>
</div>
<!-- Modal start-->
<div class="modal fade" id="e_6" tabindex="-1" role="dialog" aria-labelledby="e_6" aria-hidden="true">
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
                        <div class="btn_part" style="cursor: pointer;" data-toggle="modal" data-target="#e_6_1">監試人員</div>
                        <div class="btn_part" style="cursor: pointer;" data-toggle="modal" data-target="#e_6_3">試務人員</div>
                        <div class="btn_part" style="cursor: pointer;" data-toggle="modal" data-target="#e_6_4">管卷人員</div>
                        <div class="btn_part" style="cursor: pointer;" data-toggle="modal" data-target="#e_6_5">巡場人員</div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<!-- Modal start-->
<div class="modal fade" id="e_6_1" tabindex="-1" role="dialog" aria-labelledby="e_6_1" aria-hidden="true">
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
                        <div class="btn_part btn1" link="./designated/e_6_1?part=2501&area=第一分區" part="2501" area="第一分區">第一分區</div>
                        <div class="btn_part btn2" link="./designated/e_6_2?part=2501&area=第一分區&obs=291" part="2501" area="第一分區" obs="29">第一分區(身障)</div>
                        <div class="btn_part btn1" link="./designated/e_6_1?part=2502&area=第二分區" part="2502" area="第二分區">第二分區</div>
                        <div class="btn_part btn2" link="./designated/e_6_2?part=2502&area=第二分區&obs=292" part="2502" area="第二分區" obs="29">第二分區(身障)</div>    
                        <div class="btn_part btn1" link="./designated/e_6_1?part=2503&area=第三分區" part="2503" area="第三分區">第三分區</div> 
                        <div class="btn_part btn2" link="./designated/e_6_2?part=2503&area=第三分區&obs=293" part="2503" area="第三分區" obs="29">第三分區(身障)</div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<!-- Modal start-->
<div class="modal fade" id="e_6_3" tabindex="-1" role="dialog" aria-labelledby="e_6_3" aria-hidden="true">
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
                        <div class="btn_part btn3" part="2500" area="考區" link="./designated/e_6_3?part=2501&area=考區">考區</div>
                        <div class="btn_part btn3" part="2501" area="第一分區" link="./designated/e_6_3?part=2501&area=第一分區">第一分區</div>
                        <div class="btn_part btn3" part="2502" area="第二分區" link="./designated/e_6_3?part=2502&area=第二分區">第二分區</div>
                        <div class="btn_part btn3" part="2503" area="第三分區" link="./designated/e_6_3?part=2503&area=第三分區">第三分區</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<!-- Modal start-->
<div class="modal fade" id="e_6_4" tabindex="-1" role="dialog" aria-labelledby="e_6_4" aria-hidden="true">
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
                        <div class="btn_part btn4" part="2501" area="第一分區" link="./designated/e_6_4?part=2501&area=第一分區">第一分區</div>
                        <div class="btn_part btn4" part="2502" area="第二分區" link="./designated/e_6_4?part=2502&area=第二分區">第二分區</div>
                        <div class="btn_part btn4" part="2503" area="第三分區" link="./designated/e_6_4?part=2503&area=第三分區">第三分區</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<!-- Modal start-->
<div class="modal fade" id="e_6_5" tabindex="-1" role="dialog" aria-labelledby="e_6_5" aria-hidden="true">
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
                        <div class="btn_part btn5" part="2501" area="第一分區" link="./designated/e_6_5?part=2501&area=第一分區">第一分區</div>
                        <div class="btn_part btn5" part="2502" area="第二分區" link="./designated/e_6_5?part=2502&area=第二分區">第二分區</div>
                        <div class="btn_part btn5" part="2503" area="第三分區" link="./designated/e_6_5?part=2503&area=第三分區">第三分區</div>
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
        var obs = $(this).attr("obs")
        var link = $(this).attr("link");
        // location.href = link;  
        $.ajax({
            url: 'api/chk_part_list_of_obs',
            data: {
                part: part,
                area: area,
                obs:obs
            },
            dataType: "json"
        }).done(function(data) {
            alert(data.sys_msg);
            if (data.sys_code == "200") {
                location.href = link;  
            }
        })        
    })    

    $("body").on("click",".btn3",function(){
        var area = $(this).attr("area");
        var link = $(this).attr("link");
        $.ajax({
            url: 'api/chk_task_list',
            data: {
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

    $("body").on("click",".btn4",function(){
        var part = $(this).attr("part");
        var link = $(this).attr("link");
        $.ajax({
            url: 'api/chk_trial_staff_task_list',
            data: {
                part: part,
            },
            dataType: "json"
        }).done(function(data) {
            alert(data.sys_msg);
            if (data.sys_code == "200") {
                location.href = link;  
            }
        })   
    })    

    $("body").on("click",".btn5",function(){
        var part = $(this).attr("part");
        var link = $(this).attr("link");
        $.ajax({
            url: 'api/chk_patrol_staff_task_list',
            data: {
                part: part,
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