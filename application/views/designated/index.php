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
        $.getJSON("./api/ch_year", {
            year: $("#year").val()
        }, function(data) {
            alert(data.sys_msg);

        })
    })
})
</script>
<div class="row">
    <div class="input-group col-sm-3">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" id="year" class="form-control" aria-label="Default"
            aria-describedby="inputGroup-sizing-default" value="<?= $this->session->userdata('year'); ?>">

        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="set_year">送出</button>
        </div>

    </div>

</div>
<div class="row" style="">

    <!-- // <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
    //     <a href="./designated/a">
    //         <img src="assets/images/a.png" alt="">
    //     </a>
    // </div> -->




    <?php if (!isset($_SESSION['year'])) { ?>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <img src="assets/images/a.png" alt="" class='stop' style="-webkit-filter:grayscale(1);">
    </div>
    <?php 
} else { ?>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/a">
            <img src="assets/images/a.png" alt="">
        </a>
    </div>
    <?php 
} ?>




    <!-- b -->
    <?php if ($a1_check == 'no' || $f_check == 'no' || !isset($_SESSION['year'])) { ?>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube  text-center">
        <img src="assets/images/b.png" class='stop' alt="" style="-webkit-filter:grayscale(1);">
    </div>
    <?php 
} else { ?>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube  text-center">
        <a href="./designated/b">
            <img src="assets/images/b.png" alt="">
        </a>
    </div>
    <?php 
} ?>
    <!-- b end -->

    <!-- <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube  text-center">
        <a href="./designated/b">
            <img src="assets/images/b.png" alt="">
        </a>
    </div> -->





    <!-- c -->
    <?php if ($a1_check == 'no' || $f_check == 'no' || !isset($_SESSION['year'])) { ?>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <img src="assets/images/c.png" class='stop' alt="" style="-webkit-filter:grayscale(1);">
    </div>
    <?php 
} else { ?>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/c">
            <img src="assets/images/c.png" alt="">
        </a>
    </div>
    <?php 
} ?>
    <!-- c end -->



    <!-- d -->
    <?php if ($a1_check == 'no' || $f_check == 'no' || !isset($_SESSION['year'])) { ?>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <img src="assets/images/d.png" class='stop' alt="" style="-webkit-filter:grayscale(1);">
    </div>
    <?php 
} else { ?>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/d">
            <img src="assets/images/d.png" alt="">
        </a>
    </div>
    <?php 
} ?>
    <!-- d end -->



    <!-- e -->
    <?php if ($a1_check == 'no' || $f_check == 'no' || !isset($_SESSION['year'])) { ?>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center" style="filter: grayscale(100%);">
        <img src="assets/images/e.png" class='stop' alt="">
    </div>
    <?php 
} else { ?>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/e">
            <img src="assets/images/e.png" alt="">
        </a>
    </div>
    <?php 
} ?>
    <!-- e end -->


    <?php if (!isset($_SESSION['year']) || !isset($_SESSION['ladder'])) { ?>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <img src="assets/images/f.png" class='stop' alt="" style="filter: grayscale(100%);">
    </div>
    <?php 
} else { ?>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/f">
            <img src="assets/images/f.png" alt="">
        </a>
    </div>
    <?php 
} ?>




    <!-- <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/c">
            <img src="assets/images/c.png" alt="">
        </a>
    </div> -->
    <!-- <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/d">
            <img src="assets/images/d.png" alt="">
        </a>
    </div> -->
    <!-- <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/e">
            <img src="assets/images/e.png" alt="">
        </a>
    </div> -->
    <!-- <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 cube text-center">
        <a href="./designated/f">
            <img src="assets/images/f.png" alt="">
        </a>
    </div> -->

</div>