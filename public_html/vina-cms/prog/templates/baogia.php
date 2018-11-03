<?
function    template_edit($url,$func,$id,$txt_cat,$txt_ten,$txt_chu_thich,$txt_hien_thi,$post_type,$txt_soluong,$txt_vungin,$txt_loaigiay,$txt_gia,$txt_thoigian,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="POST" style="margin:0px;" />
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="post_type" value="<?=$post_type?>" />
<input type="hidden" name="func" value="<?=$func?>" />
    <fieldset class="bg-form">
        <div class="form-group">
            <label class="control-label">Tên</label>
            <input type="text" name="txt_ten" value="<?=$txt_ten?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Số lượng</label>
            <input type="text" name="txt_soluong" value="<?=$txt_soluong?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Chú thích</label>
            <textarea name="txt_chu_thich" class="form-control" rows="5"><?=$txt_chu_thich?></textarea>
        </div>
        <div class="form-group">
            <label class="control-label">Vùng in</label>
            <input type="text" name="txt_vungin" value="<?=$txt_vungin?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Loại giấy</label>
            <input type="text" name="txt_loaigiay" value="<?=$txt_loaigiay?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Giá</label>
            <input type="text" name="txt_gia" value="<?=$txt_gia?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Thời gian</label>
            <input type="text" name="txt_thoigian" value="<?=$txt_thoigian?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Display</label>
            <div class="radio-list">
    			<input name="txt_hien_thi" type="radio" value="0" <?=$txt_hien_thi==0?"checked":""?> /> Off *&nbsp;&nbsp;
    			<input name="txt_hien_thi" type="radio" value="1" <?=$txt_hien_thi==1?"checked":""?> /> On&nbsp;&nbsp;
            </div>
        </div>
        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-success" value="Submit" />
        </div>
    </fieldset>
</form>
<?
}
?>