<?
function	template_edit($url,$func,$id,$cat,$catalog,$txt_ten,$txt_noi_dung,$txt_hien_thi,$post_type,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="POST" style="margin:0px;" />
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
<input type="hidden" name="cat" value="<?=$cat?>" />
<input type="hidden" name="catalog" value="<?=$catalog?>" />
<input type="hidden" name="post_type" value="<?=$post_type?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
    <fieldset class="bg-form">
        <div class="form-group">
            <label class="control-label">Tên</label>
            <input type="text" name="txt_ten" value="<?=$txt_ten?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Hình ảnh</label>
            <div class="box-choosefile">
    			<input type="file" name="txt_hinh" id="file-1" class="form-control inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
    			<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Chú thích</label>
            <textarea name="txt_noi_dung" class="form-control" rows="2"><?=$txt_noi_dung?></textarea>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>
                        <?
                        global $db;
                        $q1=$db->select("post_album","id='".$id."'","");
                        $r1=$db->fetch($q1);
                        {
                        ?>
                        <p style="text-align: center;background: #fff;margin: 10px 0;">
                            <img src="../uploads/<?=$r1['dir'].$r1['hinh']?>" style="max-width: 200px;" alt="<?=$r1['ten']?>"  />
                        </p>
                        <?}?>
                        </td>
                        <td>
                            <div class="form-group">
                                <label class="control-label">Display</label>
                                <div class="radio-list">
                        			<input name="txt_hien_thi" type="radio" value="0" <?=$txt_hien_thi==0?"checked":""?> /> Off *&nbsp;&nbsp;
                        			<input name="txt_hien_thi" type="radio" value="1" <?=$txt_hien_thi==1?"checked":""?> /> On&nbsp;&nbsp;
                                </div>
                            </div>                           
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-success" value="Submit" />
        </div>
    </fieldset>
</form>
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
<script type="text/javascript" src="../admin/js/custom-file-input.js"></script>
<?
}
function	show_catalog($name,$id)
{
    global $db;	
    $r2 = $db->select("post_album_menu"," ","order by id asc");
?>
<select name="<?=$name?>" class="form-control">
<?php
while ($row2 = $db->fetch($r2))
{
		echo "<option value='".$row2["id"]."'";
		if ($id == $row2["id"]) echo " selected ";
		echo ">".$row2["ten"]."</option>";
}
?>
</select>
<?php
}
function	show_cat($name,$id)
{
    global $db;	
    $r22 = $db->select("post"," ","order by id asc");
?>
<select name="<?=$name?>" class="form-control">
<?php
while ($row22 = $db->fetch($r22))
{
		echo "<option value='".$row22["id"]."'";
		if ($id == $row22["id"]) echo " selected ";
		echo ">".$row22["ten"]."</option>";
}
?>
</select>
<?php
}
?>