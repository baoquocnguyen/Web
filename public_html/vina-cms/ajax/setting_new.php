<?
session_start();
@error_reporting(0);
@set_time_limit(0);
include "../../_CORE/index.php";
include "../../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);

$query = '';// $ten ='';$giatri ='';$nhom ='';$lang ='';$key ='';
$nhom = $_GET['nhom'];
$lang = $_GET['lang'];
$type = $_GET['type'];

function passGen($length,$nums){
$lowLet = "abcdefghijklmnopqrstuvwxyz";
$highLet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$numbers = "123456789";
$pass = "";
$i = 1;
While ($i <= $length){
    $type = rand(0,1);
    if ($type == 0){
        if (($length-$i+1) > $nums){
            $type2 = rand(0,1);
            if ($type2 == 0){
                $ran = rand(0,25);
                $pass .= $lowLet[$ran];
            }else{
                $ran = rand(0,25);
                $pass .= $highLet[$ran];
            }
        }else{
            $ran = rand(0,8);
            $pass .= $numbers[$ran];
            $nums--;
        }
    }else{
        if ($nums > 0){
            $ran = rand(0,8);
            $pass .= $numbers[$ran];
            $nums--;
        }else{
            $type2 = rand(0,1);
            if ($type2 == 0){
                $ran = rand(0,25);
                $pass .= $lowLet[$ran];
            }else{
                $ran = rand(0,25);
                $pass .= $highLet[$ran];
            }
        }
    }
    $i++;
}
return $pass;
}

$qs = "SELECT nhom FROM vn_bien WHERE nhom='".$nhom."'";
$rs = $db->query($qs);
$rnhom = $db->num_rows($rs);
$rand = passGen(10,5);
//echo $query;
$db->insert("vn_bien","key_name, lang, nhom, type","'".$nhom.$rand."','".$lang."','".$nhom."','".$type."'");
$qnn1=$db->select("vn_bien","key_name='".$nhom.$rand."'","");
$rnn1=$db->fetch($qnn1);
?>
<div class="form-group <?=$rnn1['key_name']?>" style="display: inline-block; position: relative; width: 100%">
    <label class="control-label">
        <strong>
            <input placeholder="Enter here" class="border-no" value="<?php echo $rnn1['ten']?>" onchange="setting_edit(this.value,'<?=$rnn1['key_name']?>','ten')" />
            <em>
                <?php echo ($_SESSION["level"]==0)?"<i onclick=\"setting_del('".$rnn1['key_name']."')\" class='fa fa-trash-o' aria-hidden='true'></i> <i class='fa fa-user-secret bbbb' data-key='".$rnn1['key_name']."' aria-hidden='true'></i>":'' ?>
            </em>
        </strong>
    </label>
    <label class="abc" id="<?=$rnn1['key_name'].'-toggle'?>" style="display: none;">
        <span>
        <?php echo ($_SESSION["level"]==0)?"<i class='fa fa-key' aria-hidden='true'></i>
<input onchange=\"setting_edit(this.value,'".$rnn1['key_name']."','key_name','".$lang."')\" class='border-no' value='".$rnn1['key_name']."' /> <i class='fa fa-users' aria-hidden='true'></i> <input onchange=\"setting_edit(this.value,'".$rnn1['key_name']."','nhom','".$lang."')\" class='border-no' value='".$rnn1['nhom']."' /><select class='btn btn-basic' onchange=\"setting_edit(this.value,'".$rnn1['key_name']."','type','".$lang."')\"><option ".((($rnn1['type'])=="1")?'selected':'')." value='1'>Input</option><option ".((($rnn1['type'])=="2")?'selected':'')." value='2'>Textarea</option><option ".((($rnn1['type'])=="3")?'selected':'')." value='3'>Check</option></select>":'' ?>
        </span>
    </label>
    <div class="type-content"> <!--Chọn kiểu hiển thị nội dung-->
    <?php
    if($rnn1['type']=="1"){?>
    <input placeholder="Enter here" onchange="setting_edit(this.value,'<?=$rnn1['key_name']?>','gia_tri','<?=$lang?>')" name="<?=$rnn1['key_name']?>" type="<?=(($rnn1['key_name'])=='pass_transport')?'password':'text'?>" value="<?=$rnn1['gia_tri']?>" class="form-control" />
    <?php }elseif($rnn1['type']=="2"){?>
    <textarea placeholder="Enter here" onchange="setting_edit(this.value,'<?=$rnn1['key_name']?>','gia_tri','<?=$lang?>')" name="<?=$rnn1['key_name']?>"><?=$rnn1['gia_tri']?></textarea>
    <?php }elseif($rnn1['type']=="3"){?>
    <input id="<?=$rnn1['key_name']."check"?>" <?php echo (($rnn1['gia_tri'])=="1")?'checked':''?> onchange="setting_edit(this.value,'<?=$rnn1['key_name']?>','gia_tri','<?=$lang?>')" name="<?=$rnn1['key_name']?>" class="setting_edit_value cmn-toggle cmn-toggle-round" onclick="setting_edit_value()" type="checkbox" value="<?php echo $rnn1['gia_tri']?>" />
    <label for="<?=$rnn1['key_name']."check"?>"></label>
    <?php } ?>
    </div>
</div>
<script type="text/javascript">
	$('.bbbb').click(function(){
    var get_key = $(this).attr('data-key');
    $('.abc').not('#'+get_key+"-toggle").slideUp();
    $('#'+get_key+"-toggle").slideToggle();
})
$('.border-no').click(function(){
    $(this).css({'border-bottom':'1px solid red','border-color':'red'});
    $(this).mouseleave(function(){
       $(this).css({'border':'0px solid transparent','border-color':'transparent'});
    });
});

</script>
