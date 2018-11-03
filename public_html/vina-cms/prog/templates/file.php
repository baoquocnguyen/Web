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
<script type="text/javascript">	
$(function(){
    $('img').error(function(){
        $(this).attr('src', 'images/no-img.png');
    });
});
</script>
<?
function	template_edit($url,$func,$id,$txt_cat,$txt_loai,$txt_file,$txt_hien_thi,$txt_noi_bat,$post_type,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="POST" onsubmit="return CheckForm()"/>
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="post_type" value="<?=$post_type?>" />
<input type="hidden" name="func" value="<?=$func?>" />
<?$post_type_me=str_replace("_detail","",$post_type);?>
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
        $qnn1=$db->select("vn_file_lang","file_id='".$id."' and lang_id='".$rnn['code']."'","order by id");
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
        <div class="form-group">
            <label class="control-label">Url</label>
            <input type="text" name="txt_lien_ket[<?=$rnn['code']?>]" value="<?=$rnn1['lien_ket']?>" class="form-control" />
        </div>
        
    </fieldset>
    <?}?>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Group</label>
            <? show_cat("txt_cat",$txt_cat,$post_type_me); ?>
        </div>
        <div class="form-group">
            <label class="control-label">File</label>
            <div class="box-choosefile">
    			<input type="file" name="txt_file" id="file-1" class="form-control inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
    			<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span>
                </label>
            </div>
        </div>
        <?
        global $db;
        $q1=$db->select("vn_file","id='".$id."'","");
        $r1=$db->fetch($q1);
        {
        ?>
        <p style="text-align: center;background: #fff;margin: 10px 0;">
            <a href="../uploads/<?=$r1['dir'].$r1['file']?>"><?=$r1['ten']?></a>
        </p>
        <?}?>
        <div class="form-group">
            <label class="control-label">Display</label>
            <div class="radio-list">
    			<input name="txt_hien_thi" type="radio" value="0" <?=$txt_hien_thi==0?"checked":""?> /> Off&nbsp;&nbsp;
    			<input name="txt_hien_thi" type="radio" value="1" <?=$txt_hien_thi==1?"checked":""?> /> On *&nbsp;&nbsp;
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Highlights</label>
            <div class="radio-list">
    			<input name="txt_noi_bat" type="radio" value="0" <?=$txt_noi_bat==0?"checked":""?> /> Off *&nbsp;&nbsp;
    			<input name="txt_noi_bat" type="radio" value="1" <?=$txt_noi_bat==1?"checked":""?> /> On&nbsp;&nbsp;
            </div>
        </div>
        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-success" value="Submit" />
        </div>
    </div>
    <div class="clear"></div>
</form>
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
<script type="text/javascript" src="../admin/js/custom-file-input.js"></script>
<?
}
function	show_cat($name,$id,$post_type)
{
	global $db;
	
$r2 = $db->select("vn_cat","_file = 1","order by thu_tu asc");
?>
<select name="<?=$name?>" class="form-control">
<?php
while ($row2 = $db->fetch($r2))
{
	echo "<optgroup label='".$row2["ten"]."'>";
	$r	=	$db->select("vn_file_menu","cat = '".$row2["id"]."' and post_type='".$post_type."' ","order by thu_tu asc");
	while ($row = $db->fetch($r))
	{
	   $qc1	= $db->select("vn_file_menu_lang","file_menu_id = '".$row['id']."'","order by id limit 1");
        $rc1 = $db->fetch($qc1);
        
		echo "<option value='".$row["id"]."'";
		if ($id == $row["id"]) echo " selected ";
		echo ">".$rc1["ten"]."</option>";
	}
	echo "</optgroup>";
}
?>
</select>
<?php
}
?>