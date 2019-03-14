
<style>
@media (min-width: 1200px){
    .container {
        max-width: 100%;
        width:100%;
    }
}
.typeahead{
    z-index: 1051;
    margin-left:10px;
}
img{
    max-width:100%;
}
.boxs{
    border-top: 1px solid;
    background: #f2f2f2;
    padding: 50px 0px 20px;
}
.table{
    height: auto;
    overflow: auto;
}
.cube{
    background: #e2eed3;
    margin: 0px 10px;
    padding: 20px;
    border-radius: 10px;
    float: left;
    flex: 0 0 30%;
    max-width: 32%;    
}
label {
    display: inline-block;
    line-height: 40px;
    text-align: center;
    width: 35%;
}
.form-control {
    display: block;
    width: 50%;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-boxs;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,boxs-shadow .15s ease-in-out;
}
.form-group {
    margin-bottom: 1rem;
    padding-right:10%;
}
.bottom{
    bottom: 0px;
    width:100%;
}
tr{
    cursor:pointer;
}
</style>

<script>
$(function(){
    // 載入預設資料到下方編輯表單
    $("body").on("click","tr",function(){
        var sn = $(this).attr("sn");
        $("html, body").animate({
            scrollTop: $("body").height()
        }, 1000);         
        var _this = $(this);
        
        $("#start").val(_this.find("td").eq(4).text());
        $("#end").val(_this.find("td").eq(4).text());
        $("#note").val(_this.find("td").eq(-1).text());
        $("#floor").val(_this.find("td").eq(-2).text());
        
    })
    // 送出
    $("body").on("click","#send",function(){

        var start = $("#start").val();
        var end = $("#end").val();
        if(start > end){
            alert("試場起號不能大於試場迄號，請確認後重新送出");
        }else{
            if(confirm("是否要儲存?")){
                var sn = $("#sn").val();
                var part = $("#part").val();            
                var floor = $("#floor").val();
                var note = $("textarea[name='note']").val();
                $("tr").each(function(k,v){
                    var _this = $(this);
                    var _field = $(this).attr('field');
                    // 篩選需要修改的區間範圍
                    if(_field >= start && _field<=end ){
                        $.ajax({
                            url: './voice/api/save_part',
                            data:{
                                "field":_field,
                                "floor":floor,
                                "note":note
                            },
                            dataType:"json"
                        }).done(function(data){
                            if(data.sys_code == "200"){
                                _this.find('td').eq(-2).text(floor);
                                _this.find('td').eq(-1).text(note);
                                if(_this.attr('field') == end){
                                    alert('資料更新完成');
                                }
                            }
                        })
                    }
                })
                
            }
        }

        
    })
    // 送出結尾

});
</script>

<div class="row">
  <div class="p-2 "  style="width:300px;">
        <div class="input-group">

            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">學年度</span>
            </div>
            <input type="text" class="form-control"  value="<?=$this->session->userdata('year'); ?>" style="width:60px;" readonly>
            <input type="text" class="form-control"  value="<?=$this->session->userdata('ladder'); ?>" style="width:100px;" readonly>
            
        </div>
 </div>

    <div class="col-sm-8" style="text-align: center;">
        
        <img id='title_img' src="assets/images/<?=$title_img;?>.png" alt="" style="width: 15%;">
    </div>
    
</div>

<div class="row" style="height:700px;overflow: auto;">
   <div class="col-12" style="margin-top: 10px;">
        <table class="table table-hover" id="">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>年度</th>
                    <th>分區</th>
                    <th>分區名稱</th>
                    <th>試場</th>
                    <th>考試節數</th>
                    <th>考生應試號起</th>
                    <th>考生應試號迄</th>
                    <th>應試人數</th>
                    <th>樓層</th>
                    <th>備註</th>                    
                </tr>
            </thead>
            <tbody>
            <?php foreach ($datalist as $k => $v): ?>
                <tr sn="<?=$v['sn']; ?>" field="<?=$v['field']?>">
                    <td><?=$k + 1; ?></td>
                    <td><?=$v['year']; ?></td>
                    <td><?=$v['part']; ?></td>
                    <td><?=$v['area_name']; ?></td>
                    <td><?=$v['field']; ?></td>
                    <td>
                        <?php 
                        switch ($v['block_name']) {
                            case 1:
                                echo '上午場';
                                break;
                            case 2:
                                echo '下午場';
                                break;
                            default:
                                echo '上午場,下午場';
                                break;
                        }
                        ?>
                    
                    </td>
                    <td><?=$v['start']; ?></td>
                    <td><?=$v['end']; ?></td>
                    <td><?=$v['count_num']; ?></td>
                    <td><?=$v['floor'];?></td>
                    <td><?=$v['note']; ?></td>
                </tr>                    
            <?php endforeach; ?>
            </tbody>
        </table>
     </div>
</div>

<div class="bottom">
    <div class="row boxs">
        <div class="col-md-12 col-sm-12 col-xs-12 ">      
            <form method="POST" enctype="multipart/form-data"  action="" id="form" class="">                                            
                <div class="col-md-3 col-sm-3 col-xs-3 cube">
                    <div class="form-group">
                        <label for="part" class=""  style="float:left;">分區</label>
                        <input type="hidden" id="sn">
                        <input type="text" class="form-control" id="part" readonly value="<?=$v['part']?>">
                    </div>  
                    <div class="form-group">
                        <label for="part_name" class="" style="float:left;">分區名稱</label>
                        <input type="text" class="form-control" id="part_name" readonly value="<?=$v['area_name']?>">
                    </div>     
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 cube">
                    <div class="form-group">
                        <label for="start" class=""  style="float:left;">試場起號</label>
                        <select name="start" id="start" class="form-control">
                            <option value="">請選擇</option>
                            <?php foreach ($datalist as $k => $v): ?>
                                <option value="<?=$v['field']; ?>"><?=$v['field']; ?></option>
                            <?php endforeach; ?>         
                        </select>
                    </div>                  
                    <div class="form-group">
                        <label for="end" class=""  style="float:left;">試場迄號</label>
                        <select name="start" id="end" class="form-control">
                            <option value="">請選擇</option>
                            <?php foreach ($datalist as $k => $v): ?>
                                <option value="<?=$v['field']; ?>"><?=$v['field']; ?></option>
                            <?php endforeach; ?>        
                        </select>
                    </div>     
                </div>                    
                <div class="col-md-3 col-sm-3 col-xs-3 cube">   
                    
                    <div class="form-group">
                        <label for="floor" class="" style="float:left;">樓層別</label>
                        <input type="text" class="form-control" id="floor">
                    </div>                                                       
                </div>     
                <div class="col-md-6 col-sm-6 col-xs-6 " style="float:left;margin: 20px auto;">             
                    <div class="">
                        <div class="">
                            <label for="note" class="" style="float:left;text-align:left;width: 8%;text-align:center;">備註</label>
                        <textarea name="note" id="note" class="" style="width:300px"></textarea>
                        </div>
                    </div>                  
                </div> 
                <div class="col-md-6 col-sm-6 col-xs-6" style="float:left;margin: 20px auto;">             
                    <div class="form-group" style="text-align:right">
                        <div class="">
                            <button type="button" class="btn btn-primary" id="send">儲存</button>
                        </div>
                    </div>                  
                </div>                         
            </form>
        </div>
    </div> 
</div> 



