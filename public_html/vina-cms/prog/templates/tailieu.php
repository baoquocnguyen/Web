<?
function	template_edit($url,$func,$id,$txt_cat,$txt_ten,$txt_chu_thich,$txt_file,$txt_hien_thi,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="POST" style="margin:0px;" />
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
    <fieldset class="bg-form">
        <div class="form-group">
            <label class="control-label">Tên</label>
            <input type="text" name="txt_ten" value="<?=$txt_ten?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">File</label>
            <div class="box-choosefile">
    			<input type="file" name="txt_file" id="file-1" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Chú thích</label>
            <textarea name="txt_chu_thich" class="form-control" rows="5"><?=$txt_chu_thich?></textarea>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                    <tr>
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
?>