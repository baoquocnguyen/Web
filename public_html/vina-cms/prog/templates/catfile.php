<?
function template_edit($url,$func,$id,$txt_ten,$txt_ten_en,$txt_hien_thi,$txt_noi_bat,$txt_hinh,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="post" />
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
    <fieldset class="bg-form">
        <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" name="txt_ten" value="<?=$txt_ten?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Name (EN)</label>
            <input type="text" name="txt_ten_en" value="<?=$txt_ten_en?>" class="form-control" />
        </div>
        <!--<div class="form-group">
            <label class="control-label">Images</label>
            <div class="box-choosefile">
    			<input type="file" name="txt_hinh" id="file-1" class="form-control inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
    			<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span>
                </label>
            </div>
        </div>-->
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
    </fieldset>
</form>

<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
<script type="text/javascript" src="../admin/js/custom-file-input.js"></script>

<?}?>