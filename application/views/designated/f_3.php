<style>
table{
    border:1px solid #ccc;
    width:100%;
}
td{
    padding:5px;
    border:1px solid #ccc;
    text-align:center;
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
        <img src="assets/images/f3_title.png" alt="" style="width: 20%;">
    </div>
    
</div>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <table>
            <tr>
                <td style="text-align:right">時間</td>
                <td colspan="4">上午</td>
                <td colspan="4">下午</td>
            </tr>
            <tr>
                <td>科目</td>
                <td rowspan="2">8:35</td>
                <td rowspan="2">8:40 ~ 10:00 </td>
                <td rowspan="2">10:45 </td>
                <td rowspan="2">10:50 ~ 12:00 </td>
                <td rowspan="2">8:35</td>
                <td rowspan="2">8:40 ~ 10:00 </td>
                <td rowspan="2">10:45 </td>
                <td rowspan="2">10:50 ~ 12:00 </td>
            </tr>
            <tr>
                <td style="text-align:left">日期</td>
            </tr>


            <tr>
                <td>2018/07/01</td>
                <td rowspan="3">預<br>備<br>鈴</td>
                <td>物理</td>
                <td rowspan="3">預<br>備<br>鈴</td>
                <td>物理</td>
                <td rowspan="3">預<br>備<br>鈴</td>
                <td>物理</td>
                <td rowspan="3">預<br>備<br>鈴</td>
                <td>物理</td>
            </tr>
            <tr>
                <td>2018/07/02</td>
                <!-- <td></td> -->
                <td>物理</td>
                <!-- <td></td> -->
                <td>物理</td>
                <!-- <td></td> -->
                <td>物理</td>
                <!-- <td></td> -->
                <td>物理</td>
            </tr>
            <tr>
                <td>2018/07/03</td>
                <!-- <td></td> -->
                <td>物理</td>
                <!-- <td></td> -->
                <td>物理</td>
                <!-- <td></td> -->
                <td>物理</td>
                <!-- <td></td> -->
                <td>物理</td>
            </tr>
        </table>


    </div>
    <div class="col-3"></div>

</div>