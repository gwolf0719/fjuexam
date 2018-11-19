<style>
    @media (min-width: 1200px) {
        .container {
            max-width: 100%;
            width: 100%;
        }
    }

    img {
        max-width: 100%;
    }

 

    .boxs {
        border-top: 1px solid;
        background: #f2f2f2;
        padding: 0px 0px 20px;
    }

    .bottom {
        position: relative;
        width: 100%;
        top: 100px;
    }

    label {
        display: inline-block;
        margin-bottom: .5rem;
        margin: 0px 5%;
        width: 30%;
        text-align: right;
        float: left;
    }

    .form-control {
        display: block;
        width: 60%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    tr {
        cursor: pointer;
    }
</style>
<script>
    $(function() {
        // 畫面一載入的時候全部 input 關閉
        $("#member_code").attr("readonly", "readonly");
        $('input[type=text]').attr("disabled", "disabled");
        $('input[type=checkbox]').attr("disabled", "disabled");


        $("body").on("click", "#Upload", function() {
            var formData = new FormData($('#form')[0]); 
            var files = $('input[name="file"]').prop('files');
            if(files.length == 0){
                alert('請先選擇文件');
                return;
            }else{
                if(confirm("注意！舊資料會全部刪除，新資料將匯入")){
                    
                    $.ajax({
                        type:"post",
                        dataType: 'json',
                        url: "./voice/api/import_staff_member", 
                        data: formData, 
                        cache: false, 
                        processData: false, 
                        contentType: false, 
                    }).done(function(data){
                        console.log(data);
                        alert(data.sys_msg);
                        window.location.reload();  
                    });
                }else{
                    alert("上傳失敗");
                }
        }  
        })

        // 當點選資料的時候可以進行編輯
        $("body").on("click", "tr", function() {
            if($("#member_code").attr('readonly') != "readonly"){
                if(confirm("目前為新增資料模式，請問是否要改為編輯舊資料？")){
                    var sn = $(this).attr("sn");
                    edit_info(sn);
                }
            }else{
                var sn = $(this).attr("sn");
                edit_info(sn);
            }
            
        })
        // 啟用編輯區
        function edit_info(sn){
            $(".form").addClass("upup");
            $("input").attr("readonly", false);
            $("input").removeAttr("disabled");
            $("#send").show();
            $("#add").hide();
            $("#member_code").attr("readonly", true);
            if ($(".form").hasClass("upup")) {
                $(".form").slideDown();
            } else {
                $(".form").slideUp();
            }
            $.ajax({
                url: './voice/api/voice_get_once_staff',
                data: {
                    "sn": sn,
                },
                dataType: "json"
            }).done(function(data) {
                $("#sn").val(sn);
                $("#member_code").val(data.info.member_code);
                $("#member_name").val(data.info.member_name);
                $("#unit").val(data.info.unit);
                $("#member_unit").val(data.info.member_unit);
                $("#member_phone").val(data.info.member_phone);
                $("#member_title").val(data.info.member_title);
              
            })
        }


     


        $("body").on("click", "#add_info", function() {
            // $(this).hide();
            $("input").attr("readonly", false);
            $("input").removeAttr("disabled");
            $("#send").hide();
            $("#remove").hide();
            $("#add").show();
            $("#no").show();
            $("#member_code").val("");
            $("#member_name").val("");
            $("#unit").val("");
            $("#member_unit").val("");
            $("#member_phone").val("");
            $("#member_title").val("");
        })

        $("body").on("click", "#no", function() {
            location.reload();
            // $(this).hide();
            // $("#add").hide();
            // $("#add_info").show();
            // $("#send").show();
            // $("#remove").show();
        })

        $("body").on("click", "#add", function() {
            var member_code = $("#member_code").val();
            var member_name = $("#member_name").val();
            var member_unit = $("#member_unit").val();
            var unit = $("#unit").val();
            var member_title = $("#member_title").val();
            var member_phone = $("#member_phone").val();
            
           
            $.ajax({
                url: './voice/api/voice_add_staff',
                data: {
                    "member_code": member_code,
                    "member_name": member_name,
                    "member_unit": member_unit,
                    "unit":unit,
                    "member_title": member_title,
                    "member_phone": member_phone,
                    
                },
                dataType: "json"
            }).done(function(data) {
                alert(data.sys_msg);
                if (data.sys_code == "200") {
                    location.reload();
                }
            })
        })
        $("body").on("click", "#send", function() {
            if (confirm("確定儲存修改資料？")) {
                var sn = $("#sn").val();
                var member_code = $("#member_code").val();
                var member_name = $("#member_name").val();
                var member_unit = $("#member_unit").val();
                var unit = $("#unit").val();
                var member_title = $("#member_title").val();
                var member_phone = $("#member_phone").val();
              
                $.ajax({
                    url: './voice/api/voice_edit_staff',
                    data: {
                        "sn": sn,
                        "member_code": member_code,
                        "member_name": member_name,
                        "unit": unit,
                        "member_unit": member_unit,
                        "member_title": member_title,
                        "member_phone": member_phone,
                        
                    },
                    dataType: "json"
                }).done(function(data) {
                    alert(data.sys_msg);
                    if (data.sys_code == "200") {
                        location.reload();
                    }
                })
            }
        })

        $("body").on("click", "#remove", function() {
            if (confirm("是否確定要刪除？")) {
                var sn = $("#sn").val();
                $.ajax({
                    url: './voice/api/remove_once_staff',
                    data: {
                        "sn": sn,
                    },
                    dataType: "json"
                }).done(function(data) {
                    if (data.sys_code == "200") {
                        alert(data.sys_msg);
                        location.reload();
                    }
                })
            }
        })
        $("body").on("click", ".up", function() {
            $(".form").slideToggle();
        })
    })
</script>

<!-- 標題選單列開始 -->
<div class="d-flex justify-content-between">
    <div class="p-2 "  style="width:300px;">
        <div class="input-group">

            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
            </div>
            <input type="text" class="form-control"  value="<?=$this->session->userdata('year'); ?>" style="width:60px;" readonly>
            <input type="text" class="form-control"  value="<?=$this->session->userdata('ladder'); ?>" style="width:100px;" readonly>
            
        </div>
    </div>
    <div class="p-2 ">
        <img src="assets/images/a3_title.png" alt="" style="height:50px;">
    </div>
    <div class="p-2 " style="width:300px;text-align:right;">
        <a  class="btn btn-primary " href="./assets_voice/sample/people_exam.csv"> 下載範本</a>
        <button type="button" class="btn btn-primary "  data-toggle="modal" data-target="#exampleModal" >匯入資料</button>
    </div>
</div>
<!-- 標題選單列結束 -->
<div class="row" style="height: 50vh;overflow: auto;">
    <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>人員編號</th>
                    <th>姓名</th>
                    <th>單位一</th>
                    <th>單位二</th>
                    <th>職稱</th>
                    <th>聯絡電話</th>
                </tr>
            </thead>
            <tbody>
              
                <?php foreach ($datalist as $k => $v): ?>
                
                <tr sn="<?=$v['sn']; ?>">
                    <td>
                        <?=$k + 1; ?>
                    </td>
                    <td>
                        <?=$v['member_code']; ?>
                    </td>
                    <td>
                        <?=$v['member_name']; ?>
                    </td>
                    <td>
                        <?=$v['unit']; ?>
                    </td>
                    <td>
                        <?=$v['member_unit']; ?>
                    </td>
                    <td>
                        <?=$v['member_title']; ?>
                    </td>
                    <td>
                        <?=$v['member_phone']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="bottom">
    <div class="row boxs">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <form method="POST" class="" style="padding: 30px 0px 0px;">
                <div class="col-md-3 col-sm-3 col-xs-3 cube" style="width:50%;float:left;">
                    <div class="form-group">
                        <label for="member_code">人員代碼</label>
                        <input type="text" class="form-control" id="member_code">
                        <input type="hidden" class="" id="sn">
                    </div>
                    <div class="form-group">
                        <label for="member_name">姓名</label>
                        <input type="text" class="form-control" id="member_name">
                    </div>
                    <div class="form-group">
                        <label for="unit">單位一</label>
                        <input type="text" class="form-control" id="unit">
                    </div>
                    <div class="form-group">
                        <label for="member_unit">單位二</label>
                        <input type="text" class="form-control" id="member_unit">
                    </div>

                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 cube" style="width:50%;float:left;">
                    <div class="form-group">
                        <label for="member_title">職稱</label>
                        <input type="text" class="form-control" id="member_title">
                    </div>
                    <div class="form-group">
                        <label for="member_phone">聯絡電話</label>
                        <input type="text" class="form-control" id="member_phone">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 cube" style="width:100%;float:left;">
                    <div class="form-group" style="text-align: right;">
                        <div class="">
                            <button class="btn btn-primary" type="button" id="add" style="display:none">確定</button>
                            <button class="btn btn-danger" type="button" id="no" style="display:none">取消</button>
                            
                            <button type="button" class="btn btn-primary" id="send">修改</button>
                            <button type="button" class="btn btn-danger" id="remove">刪除</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal start-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">資料匯入</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="" id="form" class="page_form">

                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="" id="inputGroupFile02" name="file">
                            <!-- <label class="custom-file-label" for="inputGroupFile02">請選擇檔案</label> -->
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="Upload">Upload</span>
                        </div>
                    </div>


                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal end-->
