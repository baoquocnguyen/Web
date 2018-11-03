<?
function	template_edit($url,$func,$id,$txt_ten,$txt_loaima,$txt_chietkhau,$txt_solantong,$txt_solancon,$txt_thoigian,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="POST" style="margin:0px;" />
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="sanpham" value="<?=$sanpham?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
    <fieldset class="bg-form">
        <div class="form-group">
            <label class="control-label">Mã</label>
            <input type="text" name="txt_ten" value="<?=$txt_ten?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Loại mã</label><br />
			<input name="txt_loaima" type="radio" value="0" <?=$txt_loaima==0?"checked":""?> /> Chiết khấu *
			<input name="txt_loaima" type="radio" value="1" <?=$txt_loaima==1?"checked":""?> /> Tính giá sỉ 
        </div>
        <div class="form-group">
            <label class="control-label">Chiết khấu</label>
            <input type="text" name="txt_chietkhau" value="<?=$txt_chietkhau?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Số lần sử dụng</label>
            <input type="text" name="txt_solantong" value="<?=$txt_solantong?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Số lần còn</label>
            <input type="text" name="txt_solancon" <?if($func=='new'){echo 'readonly=""';}?> value="<?=$txt_solancon?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Thời gian hết hạn</label>
            <?if($func=='new'){?>
                <input type="text" name="txt_thoigian" value="" class="form-control" placeholder="Ngày/Tháng/Năm" /><br />
            <?}else{?>
            <input type="text" name="txt_thoigian" value="<?=lg_date::date($txt_thoigian,"mm/dd/yy");?>" class="form-control ngayma" /><br />
            <?}?>
            <label class="control-label">(*) Cú pháp: Tháng ngày năm. VD: 08/08/1800</label>
        </div>
        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-success" value="Thực hiện" />
        </div>
   </fieldset>
</form>
<?}?>