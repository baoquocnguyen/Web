<style type="text/css">
.block-setting .form-group {position: relative}
.block-setting .form-group em {
    position: absolute;
    right: 0;
}
.block-setting .border-no {
    display: inline-block;
    border-width: 0px;
    transition: all .3s ease;
    outline: none;
}
.block-setting .check_changed {
    position: absolute;
    display: block !important;
    width: 100%;
    height: 100%;
    top: 0;
}
.block-setting .check_changed::before {
    content: '\f058';
    font-family: fontawesome;
    position: absolute;
    right: 0;
    left: 0;
    margin: 0 auto;
    text-align: center;
    align-items: center;
    background-color: rgba(125, 187, 2, 0.2);
    height: 100%;
    color: #7DBB02;
    width: 100%;
    padding-top: 10px;
    z-index: 9;
    font-size: 2em;
}
.block-setting .bg-form label {display: block}
.block-setting .form-group {position: relative}
.block-setting .control-label .fa-user-secret, .block-setting .control-label .fa-trash-o {
    color: #999;
    font-size: 20px;
    padding-left: 10px;
    transition: color .3s ease;cursor: pointer;
}
.block-setting .control-label .fa-user-secret:hover, .block-setting .control-label .fa-trash-o:hover {
    color: #000;
}
.btn-basic {
    border: 1px solid #ccc;
    border-radius: 0;
    padding: 0;
    text-align: left;
    background: url(../<?=admin_url?>/images/select.png) no-repeat right center;
    position: relative;
    top: -1px;
    left: 5px;
    padding: 2px 20px;
    margin-bottom: 10px;
}
.block-setting .add_more {
    text-align: center;
    border: 1px solid #ccc;
    padding: 7px;
    margin: 10px auto;
    cursor: pointer;
    color: #ccc;
    transition: color .3s ease, border-color .3s ease
}
.block-setting .add_more:hover {
    color: #7DBB02;
    border-color: #7DBB02;
    cursor: cell;
}
.sort_noid {padding-left: 0;}
.sort_noid > li {
    display: block;
    width: 100%;
    text-align: left;
    cursor: move;
}
.type-content textarea {
    width: 100%;
    resize: none !important;
}
.cmn-toggle {
  position: absolute;
  margin-left: -9999px;
  visibility: hidden;
}
.cmn-toggle + label {
  display: block;
  position: relative;
  cursor: pointer;
  outline: none;
  user-select: none;
}
input.cmn-toggle-round + label {
  padding: 2px;
  width: 60px;
  height: 30px;
  background-color: #dddddd;
  border-radius: 30px;
}
input.cmn-toggle-round + label:before,
input.cmn-toggle-round + label:after {
  display: block;
  position: absolute;
  top: 1px;
  left: 1px;
  bottom: 1px;
  content: "";
}
input.cmn-toggle-round + label:before {
  right: 1px;
  background-color: #f1f1f1;
  border-radius: 30px;
  transition: background 0.4s;
}
input.cmn-toggle-round + label:after {
  width: 30px;
  background-color: #fff;
  border-radius: 100%;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  transition: margin 0.4s;
}
input.cmn-toggle-round:checked + label:before {
  background-color: #8ce196;
}
input.cmn-toggle-round:checked + label:after {
  margin-left: 30px;
}
</style>
<?php
$tab = $_GET['tab'];
?>
<section class="content-header">
    <h1>System<small>Version 3.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">System</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="block-setting box-common box-green">
                <div class="box-header with-border">
                    <h3 class="box-title">SETTING</h3>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="col-sm-12">
                        <label>Default Create:</label>
                        <select class="btn btn-basic" id="type">
                            <option value="1">Input</option>
                            <option value="2">Textarea</option>
                            <option value="3">Check</option>
                        </select>
                    </div>
                            <script>
                            $(function(){
                                $('.sort_noid').sortable({
                                    axis: 'xy',
                                    opacity: 0.5,
                                    cursor: 'move',
                                    update: function(event, ui) {
                                        var data_id = $(this).sortable('toArray').toString(); //get id from li
                                        var table = "vn_bien"//$('#table_sortable').val(); //get value table from input had #table_sortable
                                        $.ajax({
                                            url: '<?=$domain?>/<?=admin_url?>/ajax/setting_sort.php',
                                            type: 'POST',
                                            data: {list_order:data_id,table:table},
                                            success: function(data) {
                                                window.location.href = data;
                                            },
                                        });
                                    }
                                });
                            });
                            </script>
                        <div class="col-md-6">
                            <ul class="list-sub">
                                <?
                                global $db;
                                $dem=0;
                                $qnn=$db->select("language","display=1","order by thu_tu");
                                while($rnn=$db->fetch($qnn)){
                                    $dem++;
                                ?>
                                <li><a href="#tab<?=$dem?>" <?php if(($dem==1&&$tab=='')||($tab!=''&&$tab=='GENERAL_'.$rnn['code'])||($tab!=''&&strpos($tab,"GENERAL")===false&&$dem==1)){echo 'class="active"';}?>><?='GENERAL ['.$rnn['code'].']'?></a></li>
                                <?}?>
                                <div class="clear"></div>
                            </ul>
                            <?php
                            global $db;
                            $dem1=0;
                            $qnn=$db->select("language","display=1","order by thu_tu");
                            while($rnn=$db->fetch($qnn)){
                                $dem1++;
                                $qnn1=$db->select("vn_bien","lang='".$rnn['code']."'","ORDER BY sort");
                            ?>
                            
                            <fieldset class="bg-form block-sub <?php if(($dem1==1&&$tab=='')||($tab!=''&&$tab=='GENERAL_'.$rnn['code'])||($tab!=''&&strpos($tab,"GENERAL")===false&&$dem1==1)){echo 'active';}?>" id="tab<?=$dem1?>">
                                <?php if($_SESSION["level"]==0){?>
                                <div class="add_more text-uppercase" onclick="setting_new('GENERAL','<?=$rnn['code']?>')"><i class="fa fa-plus" aria-hidden="true"></i> ADD</div>
                                <?php } ?>
                                <p id="GENERAL_<?=$rnn['code']?>"></p>
                                <ul class="sort_noid">
                                <?php while($rnn1=$db->fetch($qnn1)){ ?>
                                <li id="<?=$rnn1['id']?>">
                                    <div class="form-group <?=$rnn1['key_name']?>" style="display: inline-block; position: relative; width: 100%">
                                        <label class="control-label">
                                            <strong>
                                                <input placeholder="Enter here" class="border-no" value="<?php echo $rnn1['ten']?>" onchange="setting_edit(this.value,'<?=$rnn1['key_name']?>','ten','<?=$rnn['code']?>','GENERAL')" />
                                                <em>
                                                    <?php echo ($_SESSION["level"]==0)?"<i onclick=\"setting_del('".$rnn1['id']."')\" class='fa fa-trash-o' aria-hidden='true'></i> <i class='fa fa-user-secret' data-key='".$rnn1['key_name']."' data-lang='".$rnn['code']."' aria-hidden='true'></i>":'' ?>
                                                </em>
                                            </strong>
                                        </label>
                                        <label class="abc" id="<?=$rnn1['key_name'].$rnn['code'].'-toggle'?>" style="display: none;">
                                            <span>
                                            <?php echo ($_SESSION["level"]==0)?"<i class='fa fa-key' aria-hidden='true'></i><input onchange=\"setting_edit(this.value,'".$rnn1['key_name']."','key_name','".$rnn['code']."','GENERAL')\" class='border-no' value='".$rnn1['key_name']."' /> <i class='fa fa-users' aria-hidden='true'></i> <input onchange=\"setting_edit(this.value,'".$rnn1['key_name']."','nhom','".$rnn['code']."','GENERAL')\" class='border-no' value='".$rnn1['nhom']."' /><select class='btn btn-basic' onchange=\"setting_edit(this.value,'".$rnn1['key_name']."','type','".$rnn['code']."','GENERAL')\"><option ".((($rnn1['type'])=="1")?'selected':'')." value='1'>Input</option><option ".((($rnn1['type'])=="2")?'selected':'')." value='2'>Textarea</option><option ".((($rnn1['type'])=="3")?'selected':'')." value='3'>Check</option></select>":'' ?>
                                            </span>
                                        </label>
                                        <div class="type-content"> <!--Chọn kiểu hiển thị nội dung-->
                                        <?php
                                        if($rnn1['type']=="1"){?>
                                        <input placeholder="Enter here" onchange="setting_edit(this.value,'<?=$rnn1['key_name']?>','gia_tri','<?=$rnn['code']?>','GENERAL')" name="<?=$rnn1['key_name']?>" type="<?=(($rnn1['key_name'])=='pass_transport')?'password':'text'?>" value="<?=$rnn1['gia_tri']?>" class="form-control" />
                                        <?php }elseif($rnn1['type']=="2"){?>
                                        <textarea placeholder="Enter here" onchange="setting_edit(this.value,'<?=$rnn1['key_name']?>','gia_tri','<?=$rnn['code']?>','GENERAL')" name="<?=$rnn1['key_name']?>"><?=$rnn1['gia_tri']?></textarea>
                                        <?php }elseif($rnn1['type']=="3"){?>
                                        <input id="<?=$rnn1['key_name']."check"?>" <?php echo (($rnn1['gia_tri'])=="1")?'checked':''?> onchange="setting_edit(this.value,'<?=$rnn1['key_name']?>','gia_tri','<?=$rnn['code']?>','GENERAL')" name="<?=$rnn1['key_name']?>" class="setting_edit_value cmn-toggle cmn-toggle-round" onclick="setting_edit_value()" type="checkbox" value="<?php echo $rnn1['gia_tri']?>" />
                                        <label for="<?=$rnn1['key_name']."check"?>"></label>
                                        <?php } ?>
                                        </div>
                                    </div>
                                </li>
                                <?php } ?>
                                </ul>
                            </fieldset>
                            <?php } ?>
                        </div>
                        <?php
                            $qs = "SELECT DISTINCT nhom FROM vn_bien WHERE lang='none' ORDER BY nhom";
        	                $rs = $db->query($qs);
                            $demk = 0;
                        ?>
                        <div class="col-md-6">
                            <div class="col-sm-12">
                                <ul class="list-sub-option">
                                    <?php while($rnhom = $db->fetch($rs)){ 
                                        if(($_SESSION["level"]==0) || ($rnhom['nhom']!='PHPMAILER')){
                                            $demk++;
                                    ?>
                                    <li><a class="<?if(($demk==1&&$tab=='')||($tab!=''&&$tab==$rnhom['nhom'].'_none')||($demk==1&&$tab!=''&&strpos($tab,"GENERAL")!==false)){echo 'active';}?>" href="#tab-<?=$rnhom['nhom']?>"><?=$rnhom['nhom']?><?php echo (($_SESSION["level"]==0) && ($rnhom['nhom']=='PHPMAILER'))?$rnn1['key_name'].' <i class="fa fa-user-secret" aria-hidden="true"></i>':'' ?></a></li>
                                    <?php }} ?>
                                    <div class="clear"></div>
                                </ul>
                            </div>
                            <div class="col-sm-12">
                                
                                <?php 
                                $rs1 = $db->query($qs);
                                $demk1 = 0;
                                while($rnhom1 = $db->fetch($rs1)){
                                    if(($_SESSION["level"]==0) || ($rnhom1['nhom']!='PHPMAILER')){
                                        $demk1++;
                                ?>
                                    <fieldset class="bg-form block-sub-option <?if(($demk1==1&&$tab=='')||($tab!=''&&$tab==$rnhom1['nhom'].'_none')||($demk1==1&&$tab!=''&&strpos($tab,"GENERAL")!==false)){echo 'active';}?>" id="tab-<?=$rnhom1['nhom']?>">
                                        <div class="add_more_table">
                                            <div class="add_more text-uppercase" onclick="setting_new('<?=$rnhom1['nhom']?>','none')"><i class="fa fa-plus" aria-hidden="true"></i> ADD</div>
                                        </div>
                                        <p id="<?=$rnhom1['nhom']?>_none"></p>
                                        <ul class="sort_noid">
                                        <?php 
                                        $qnn2=$db->select("vn_bien","nhom='".$rnhom1['nhom']."'","ORDER BY sort");
                                        while($rnn2=$db->fetch($qnn2)){
                                        ?>
                                        <li id="<?=$rnn2['id']?>">
                                        <div class="form-group <?=$rnn2['key_name']?>" style="display: inline-block; position: relative; width: 100%">
                                            <label class="control-label">
                                                <strong>
                                                    <input placeholder="Enter here" class="border-no" value="<?php echo $rnn2['ten']?>" onchange="setting_edit(this.value,'<?=$rnn2['key_name']?>','ten','none','<?=$rnhom1['nhom']?>')" />
                                                    <em>
                                                        <?php echo ($_SESSION["level"]==0)?"<i onclick=\"setting_del('".$rnn2['id']."')\" class='fa fa-trash-o' aria-hidden='true'></i> <i class='fa fa-user-secret' data-key='".$rnn2['key_name']."' data-lang='none' aria-hidden='true'></i>":'' ?>
                                                    </em>
                                                </strong>
                                                
                                            </label>
                                            <label class="abc" id="<?=$rnn2['key_name'].'none'.'-toggle'?>" style="display: none;">
                                                <span>
                                                <?php echo ($_SESSION["level"]==0)?"<i class='fa fa-key' aria-hidden='true'></i>
 <input onchange=\"setting_edit(this.value,'".$rnn2['key_name']."','key_name','none','".$rnhom1['nhom']."')\" class='border-no' value='".$rnn2['key_name']."' /> <i class='fa fa-users' aria-hidden='true'></i> <input onchange=\"setting_edit(this.value,'".$rnn2['key_name']."','nhom','none','".$rnhom1['nhom']."')\" class='border-no' value='".$rnn2['nhom']."' /><select class='btn btn-basic' onchange=\"setting_edit(this.value,'".$rnn2['key_name']."','type','none','".$rnhom1['nhom']."')\"><option ".((($rnn2['type'])=="1")?'selected':'')." value='1'>Input</option><option ".((($rnn2['type'])=="2")?'selected':'')." value='2'>Textarea</option><option ".((($rnn2['type'])=="3")?'selected':'')." value='3'>Check</option></select>":'' ?>
                                                </span>
                                            </label>
                                            <div class="type-content"> <!--Chọn kiểu hiển thị nội dung-->
                                            <?php
                                            if($rnn2['type']=="1"){?>
                                            <input placeholder="Enter here" onchange="setting_edit(this.value,'<?=$rnn2['key_name']?>','gia_tri','none','<?=$rnhom1['nhom']?>')" name="<?=$rnn2['key_name']?>" type="<?=(($rnn2['key_name'])=='pass_transport')?'password':'text'?>" value="<?=$rnn2['gia_tri']?>" class="form-control" />
                                            <?php }elseif($rnn2['type']=="2"){?>
                                            <textarea placeholder="Enter here" onchange="setting_edit(this.value,'<?=$rnn2['key_name']?>','gia_tri','none','<?=$rnhom1['nhom']?>')" name="<?=$rnn2['key_name']?>"><?=$rnn2['gia_tri']?></textarea>
                                            <?php }elseif($rnn2['type']=="3"){?>
                                            <input id="<?=$rnn2['key_name']."check"?>" <?php echo (($rnn2['gia_tri'])=="1")?'checked':''?> onchange="setting_edit(this.value,'<?=$rnn2['key_name']?>','gia_tri','none','<?=$rnhom1['nhom']?>')" name="<?=$rnn2['key_name']?>" class="setting_edit_value cmn-toggle cmn-toggle-round" onclick="setting_edit_value()" type="checkbox" value="<?php echo $rnn2['gia_tri']?>" />
                                        <label for="<?=$rnn2['key_name']."check"?>"></label>
                                            <?php } ?>
                                            </div> <!--End tyle content-->
                                        </div>
                                        </li>
                                        <?php } ?>
                                        </ul>
                                    </fieldset>
                                    
                                <?php }} ?>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$('.fa-user-secret').click(function(){
    var get_key = $(this).attr('data-key');
    var lang = $(this).attr('data-lang');
    $('.abc').not('#'+get_key+lang+"-toggle").slideUp();
    $('#'+get_key+lang+"-toggle").slideToggle();
})
$('.border-no').click(function(){
    $(this).css({'border-bottom':'1px solid red','border-color':'red'});
    $(this).mouseleave(function(){
       $(this).css({'border':'0px solid transparent','border-color':'transparent'});
    });
});
function setting_del(key){
    $check = confirm('Chắc chắn xóa');
    if($check == true){
        $.ajax({
            type:"GET",
            url:"<?=$domain?>/<?=admin_url?>/ajax/setting_del.php",
            data:{ key : key},
            success	: function(data)
            {
                $('.'+key).remove();
                //window.location.reload(true);
            }
        });
    };
}
function setting_edit(value='',key,column,lang,nhom)
{
    $.ajax({
        type:"GET",
        url:"<?=$domain?>/<?=admin_url?>/ajax/setting_edit.php",
        data:{ value : value,key : key, column : column, lang : lang},
        success	: function(data)
        {
            $('.'+key).addClass('check_changed');
            setTimeout(function() {$(".check_changed").removeClass('check_changed');},1500);
            window.location.href = "?act=setting&tab="+nhom+"_"+lang;
            
        }
    });
};
function setting_new(nhom,lang)
{
    $check = confirm('Đã chọn Default create chưa ?!!');
    if($check == true){
        var type = $("#type").val();
        $.ajax({
            type:"GET",
            url:"<?=$domain?>/<?=admin_url?>/ajax/setting_new.php",
            data:{nhom : nhom, lang : lang,type:type},
            success	: function(data)
            {
                window.location.href = "?act=setting&tab="+nhom+"_"+lang;
            }
        });
    }
};
function setting_edit_value(){
    var $this = $(".setting_edit_value");
    if($this.is(":checked")){
        $this.val("1");
    }else{
        $this.val("0");
    }
}
</script>