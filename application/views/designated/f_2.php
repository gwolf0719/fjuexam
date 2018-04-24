<style>
    .table-form-title{
        width:80%;
        background:#ddd;
        margin:0 auto;
        line-height:42px;
    }
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
        <img src="assets/images/f2_title.png" alt="" style="width: 20%;">
    </div>
    
</div>

<div class="row">
    
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding:20px;">
        <div class="row table-form-title" >
            <div class="col-4 text-right">第一天</div><div class="col-8 text-left">2018/07/01</div>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">上午第一節</div>
            <select name="" id="" class="col-8"></select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">上午第二節</div>
            <select name="" id="" class="col-8"></select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">下午第一節</div>
            <select name="" id="" class="col-8"></select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">下午第二節</div>
            <select name="" id="" class="col-8"></select>
        </div>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding:20px;">
        <div class="row table-form-title" >
            <div class="col-4 text-right">第一天</div><div class="col-8 text-left">2018/07/01</div>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">上午第一節</div>
            <select name="" id="" class="col-8"></select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">上午第二節</div>
            <select name="" id="" class="col-8"></select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">下午第一節</div>
            <select name="" id="" class="col-8"></select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">下午第二節</div>
            <select name="" id="" class="col-8"></select>
        </div>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding:20px;">
        <div class="row table-form-title" >
            <div class="col-4 text-right">第一天</div><div class="col-8 text-left">2018/07/01</div>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">上午第一節</div>
            <select name="" id="" class="col-8"></select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">上午第二節</div>
            <select name="" id="" class="col-8"></select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">下午第一節</div>
            <select name="" id="" class="col-8"></select>
        </div>
        <div class="row table-form" >
            <div class="col-4 text-right">下午第二節</div>
            <select name="" id="" class="col-8"></select>
        </div>
    </div>
    

</div>

<div class="row text-right" >
    <div class="col-12">
        <button type="button" class="btn btn-primary">儲存</button>
    </div>
</div>