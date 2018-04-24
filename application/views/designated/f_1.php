<style>
    .table-form{
        width:80%;
        background:#ddd;
        text-align:center;
        padding:10px;
        margin:0 auto;
    }
    .input{
        text-align:left;
        margin-left:0px;
        padding-left:0px;
    }
   
</style>
<div class="row">
    <div class="input-group col-sm-2">

        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
        </div>
        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?=$this->session->userdata('year'); ?>" readonly>
        
    </div>

    <div class="col-sm-8" style="text-align: center;">
        <img src="assets/images/f1_title.png" alt="" style="width: 20%;">
    </div>
    
</div>

<div class="row">
    
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:20px;">
        <div class="row table-form" class="">
            <div class="col-3 text-right">第一天</div>
            <input type="text" class="col-6">
            <div class="col-3 "></div>
        </div>
        <div class="row table-form" class="">
            <div class="col-3 text-right">第二天</div>
            <input type="text" class="col-6">
            <div class="col-3 "></div>
        </div>
        <div class="row table-form" class="">
            <div class="col-3 text-right">第三天</div>
            <input type="text" class="col-6">
            <div class="col-3 "></div>
        </div>
         

    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding:20px;"> 
        <div class="row table-form" class="">
            <div class="col-3 text-right">上午預備鈴1</div>
            <input type="text" class="col-6">
            <div class="col-3 "></div>
        </div>
        <div class="row table-form" class="">
            <div class="col-3 text-right">上午預備鈴2</div>
            <input type="text" class="col-6">
            <div class="col-3 "></div>
        </div>
        <hr>
        <div class="row table-form" class="">
            <div class="col-3 text-right">下午預備鈴1</div>
            <input type="text" class="col-6">
            <div class="col-3 "></div>
        </div>
        <div class="row table-form" class="">
            <div class="col-3 text-right">下午預備鈴2</div>
            <input type="text" class="col-6">
            <div class="col-3 "></div>
        </div>

        <hr>
        <div class="row table-form" class="">
            <div class="col-3 text-right">上午第一節</div>

            <div class="col-9 text-left input">
                <input type="text" class="">-
                <input type="text" class="">
            </div>
        </div>

        <div class="row table-form" class="">
            <div class="col-3 text-right">上午第二節</div>

            <div class="col-9 text-left input">
                <input type="text" class="">-
                <input type="text" class="">
            </div>
        </div>

        <div class="row table-form" class="">
            <div class="col-3 text-right">下午第一節</div>

            <div class="col-9 text-left input">
                <input type="text" class="">-
                <input type="text" class="">
            </div>
        </div>
        <div class="row table-form" class="">
            <div class="col-3 text-right">下午第二節</div>

            <div class="col-9 text-left input">
                <input type="text" class="">-
                <input type="text" class="">
            </div>
        </div>
    </div>
    
    

</div>
<div class="row text-right" >
    <div class="col-12">
        <button type="button" class="btn btn-primary">儲存</button>
    </div>
</div>