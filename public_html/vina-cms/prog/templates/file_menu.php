<script>
function CheckForm()
{
        code=document.frm_edit.codelang.value;
    if (document.getElementById('check'+code).value==''){
        alert('Name is not value.');
        document.getElementById('check'+code).focus();
        return false;
    }
    return true;
}
</script>
<?
function	template_edit($url,$func,$id,$txt_cat,$txt_hien_thi,$post_type,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="get" style="margin:0px;" onsubmit="return CheckForm()" />
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="post_type" value="<?=$post_type?>" />
<input type="hidden" name="func" value="<?=$func?>" />
    <div class="col-md-8">
    <ul class="list-sub">
        <?
        global $db;
        $dem=0;
        $qnn=$db->select("language","display=1","order by thu_tu");
        while($rnn=$db->fetch($qnn)){
            $dem++;
        ?>
        <li><a href="#tab<?=$dem?>" <?if($dem==1){echo 'class="active"';}?>><?=$rnn['name']?></a></li>
        <?}?>
        <div class="clear"></div>
    </ul>
    <?
    global $db;
    $dem1=0;
    $qnn=$db->select("language","display=1","order by thu_tu");
    while($rnn=$db->fetch($qnn)){
        $dem1++;
        $qnn1=$db->select("vn_file_menu_lang","file_menu_id='".$id."' and lang_id='".$rnn['code']."'","order by id");
        $rnn1=$db->fetch($qnn1);
    ?>
    <fieldset class="bg-form block-sub <?if($dem1==1){echo 'active';}?>" id="tab<?=$dem1?>">
        <div class="form-group">
            <label class="control-label">Name</label>
            <input id="check<?=$rnn['code']?>" <?if($dem1==1){echo 'required=""';}?> type="text" name="txt_ten[<?=$rnn['code']?>]" value="<?=$rnn1['ten']?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Chú thích</label>
            <textarea name="txt_chu_thich[<?=$rnn['code']?>]" class="form-control" rows="5"><?=$rnn1['chu_thich']?></textarea>
        </div>
        
    </fieldset>
    <?}?>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Group</label>
            <? show_cat("txt_cat",$txt_cat); ?>
        </div>
        <div class="form-group">
            <label class="control-label">Display</label>
            <div class="radio-list">
    			<input name="txt_hien_thi" type="radio" value="0" <?=$txt_hien_thi==0?"checked":""?> /> Off&nbsp;&nbsp;
    			<input name="txt_hien_thi" type="radio" value="1" <?=$txt_hien_thi==1?"checked":""?> /> On *&nbsp;&nbsp;
            </div>
        </div>
        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-success" value="Submit" />
        </div>
    </div>
    <div class="clear"></div>
</form>
<?
}
function	show_cat($name,$id)
{
	global $db;
	
$r = $db->select("vn_cat","_file = 1","order by thu_tu asc");
?>
<select name="<?=$name?>" class="form-control">
<?php
while ($row = $db->fetch($r))
{
	echo "<option value='".$row["id"]."'";
	if ($id == $row["id"]) echo " selected ";
	echo ">".$row["ten"]."</option>";
}
?>
</select>
<?php
}
function	cat_count($id)
{
	global $db;
	
	$r	=	$db->select("vn_file_menu","cat = '".$id."'");
	return $db->num_rows($r);
}
?>