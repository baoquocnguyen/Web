<?
function	template_edit($url,$func,$id,$txt_tieude,$txt_hinh,$txt_yahoo,$txt_skype,$txt_facebook,$txt_tel,$txt_email,$txt_hien_thi,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="POST" style="margin:0px;" />
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
    <fieldset class="bg-form">
        <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" name="txt_tieude" value="<?=$txt_tieude?>" class="form-control"/>
        </div>
        
        <div class="form-group">
            <label class="control-label">Hình ảnh</label>
            <div class="box-choosefile">
    			<input type="file" name="txt_hinh" id="file-1" class="form-control inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
    			<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span>
                </label>
            </div>
        </div>
        
        <?
        global $db;
        $q1=$db->select("vn_support","id='".$id."'","");
        $r1=$db->fetch($q1);
        {
        ?>
        <p style="text-align: left;background: #fff;margin: 10px 0;">
            <img src="../uploads/support/<?=$r1['hinh']?>" style="max-width: 100%;" alt="<?=$r1['ten']?>"  />
        </p>
        <?}?>
        
        <div class="form-group">
            <label class="control-label">Phone</label>
            <input type="text" name="txt_tel" value="<?=$txt_tel?>" class="form-control"/>
        </div>
        <!--<div class="form-group">
            <label class="control-label">Skype</label>
            <input type="text" name="txt_skype" value="<?=$txt_skype?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Facebook</label>
            <input type="text" name="txt_facebook" value="<?=$txt_facebook?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Yahoo</label>
            <input type="text" name="txt_yahoo" value="<?=$txt_yahoo?>" class="form-control"/>
        </div>-->
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
    </fieldset>
</form>
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
<script type="text/javascript" src="../admin/js/custom-file-input.js"></script>
<?
}
?>