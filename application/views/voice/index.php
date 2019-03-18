<style>
    .cube {
        margin: 25px auto;
    }

    .cube img {
        max-width: 60%;
    }

    @media (min-width: 1200px) {
        .container {
            max-width: 100%;
            width: 100%;
        }
    }
</style>

<script>
    $(function() {
        
        $("body").on("click", "#set_year", function() {
            $.getJSON("./voice/api/ch_year", {
                year: $("#year").val(),
                ladder: $("#ladder").val()
            }, function(data) {
                alert(data.sys_msg);
                location.reload();
            })
        })

        /**FIXME:HACK@@!
         */
        $("body").on("click", ".stop", function() {


            <?php if(!isset($_SESSION['year'])||!isset($_SESSION['ladder'])){?>
                alert("學年度及場次尚未設定！");
            <?php }else{?>
                <?php if ($a1_check=='no') {  ?>
                    alert("資料尚未匯入！");
                <?php }else{?>

                    <?php if ($f_check=='no') {  ?>
                    alert("未設定考試相關資訊！");
                    <?php }?>

                <?php }?>
            <?php }?>




        })





    })
</script>

<div class="row">
    <div class="input-group col-sm-3">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" id="year" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>">
      
    </div>
    <div class='input-group col-sm-3'>
        <div class="input-group-prepend">  
            <span class="input-group-text" id="">場次</span>
        </div>  
        <select class='selectpicker' id="ladder">

            <?php if($_SESSION['ladder']=='第一次'){?>
                <option value="第一次" selected>第一次</option>
                <option value="第二次">第二次</option>
            <?php }else{?>
                <option value="第一次" >第一次</option>
                <option value="第二次" selected>第二次</option>
            <?php }?>

        </select>
    </div>
    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" id="set_year">送出</button>
    </div>

</div>
<div class="row" style="">


    <?php if(!isset($_SESSION['year'])||!isset($_SESSION['ladder'])){?>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
            <img src="./assets_voice/images/a.png" alt="" class='stop' style="-webkit-filter:grayscale(1);">
        </div>
    <?php }else{?>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
            <a href="./voice/a">
                <img src="./assets_voice/images/a.png" alt="">
            </a>
        </div>
    <?php }?>


    <!-- <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./voice/a">
            <img src="./assets_voice/images/a.png" alt="">
        </a>
    </div> -->

    <!-- b -->
    <?php if($a1_check=='no'||$f_check=='no'||!isset($_SESSION['year'])||!isset($_SESSION['ladder'])){?>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube  text-center">
                <img src="./assets_voice/images/b.png" class='stop' alt="" style="-webkit-filter:grayscale(1);">
        </div>
    <?php }else{?>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube  text-center">
            <a href="./voice/b">
                <img src="./assets_voice/images/b.png" alt="">
            </a>
        </div>
    <?php }?>
    <!-- b end -->

    <!-- c -->
    <?php if($a1_check=='no'||$f_check=='no'||!isset($_SESSION['year'])||!isset($_SESSION['ladder'])){?>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
                <img src="./assets_voice/images/c.png" class='stop' alt=""style="-webkit-filter:grayscale(1);">
        </div>
    <?php }else{?>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
            <a href="./voice/c">
                <img src="./assets_voice/images/c.png" alt="">
            </a>
        </div>
    <?php }?>
    <!-- c end -->

    <!-- d -->
    <?php if($a1_check=='no'||$f_check=='no'||!isset($_SESSION['year'])||!isset($_SESSION['ladder'])){?>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
            <img src="./assets_voice/images/d.png" class='stop' alt="" style="-webkit-filter:grayscale(1);">
    </div>
    <?php }else{?>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
            <a href="./voice/d">
                <img src="./assets_voice/images/d.png" alt="">
            </a>
        </div>
    <?php }?>
    <!-- d end -->

    <!-- e -->
    <?php if($a1_check=='no'||$f_check=='no'||!isset($_SESSION['year'])||!isset($_SESSION['ladder'])){?>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center" style="filter: grayscale(100%);">
                <img src="./assets_voice/images/e.png" class='stop' alt="">
        </div>
    <?php }else{?>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
            <a href="./voice/e">
                <img src="./assets_voice/images/e.png" alt="">
            </a>
        </div>
    <?php }?>
    <!-- e end -->



    <?php if(!isset($_SESSION['year'])||!isset($_SESSION['ladder'])){?>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
                <img src="./assets_voice/images/f.png" class='stop' alt=""style="filter: grayscale(100%);">
        </div>
    <?php }else{?>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
            <a href="./voice/f">
                <img src="./assets_voice/images/f.png" alt="">
            </a>
        </div>
    <?php }?>


</div>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/i18n/defaults-*.min.js"></script> -->