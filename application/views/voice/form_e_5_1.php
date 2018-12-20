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

    .W20 {
        width: 20%;
        float: left;
    }

    .W80 {
        width: 80%;
        float: left;
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

<div class="input-group W20">

    <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
    </div>
    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>"
        readonly>
        <input type="text" class="form-control"  value="<?=$this->session->userdata('ladder'); ?>" style="width:100px;" readonly>
</div>

<div class="W80" style="text-align: left;padding-left: 6%;">
    <img src="assets/images/e5.png" alt="" style="width: 30%;margin-right: 20px;">
    <img src="assets/images/e_5_1.png" alt="" style="width: 30%;">
</div>

<div style="clear:both"></div>

<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <img src="assets/images/download.png" alt="" style="cursor: pointer;" data-toggle="modal" data-target="#download">
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <a href="assets/zip/英聽試務人員識別證.docx" target="_blank" download> 
            <img src="assets/images/E5101.png" alt="">
        </a>              
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
    </div>    

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cube text-center">
        <a href="assets/zip/英聽監試人員識別證.docx" target="_blank" download> 
            <img src="assets/images/E5102.png" alt="">
        </a>              
    </div>    
</div>

<!-- Modal start-->
<div class="modal fade" id="download" tabindex="-1" role="dialog" aria-labelledby="download" aria-hidden="true">
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
                        <a href="./designated/e_5_1_1" target="_blank">
                            <div class="btn_part">監試人員</div>
                        </a>
                        <a href="./designated/e_5_1_2" target="_blank">
                            <div class="btn_part">試務人員</div>
                        </a>
                        <a href="./designated/e_5_1_3" target="_blank">
                            <div class="btn_part">管卷人員</div>
                        </a>        
                        <a href="./designated/e_5_1_4" target="_blank">
                            <div class="btn_part">巡場人員</div>
                        </a>                                                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<!-- Modal start-->
<div class="modal fade" id="download1" tabindex="-1" role="dialog" aria-labelledby="download1" aria-hidden="true">
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
                        <a href="assets/zip/監試人員名牌.docx" target="_blank" download>
                            <div class="btn_part">監試人員</div>
                        </a>
                        <a href="assets/zip/試務人員名牌.docx" target="_blank" download>
                            <div class="btn_part">試務人員</div>
                        </a>                                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->