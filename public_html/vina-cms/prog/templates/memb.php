<?
function	template_edit($url, $func, $id,$txt_email,$txt_ten,$txt_dien_thoai,$txt_dia_chi,$yahoo,$facebook,$skype,$txt_trang_thai, $error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="POST">
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
    <fieldset class="bg-form">
        <div class="form-group">
            <label class="control-label">Email</label>
            <input type="text" name="txt_email" value="<?=$txt_email?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Mật khẩu mới</label>
            <input type="password" name="txt_password" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Nhập lại mật khẩu</label>
            <input type="password" name="txt_password2" class="form-control" />
        </div>

        <div class="form-group">
            <label class="control-label">Họ và tên</label>
            <input type="text" name="txt_ten" value="<?=$txt_ten?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Điện thoại</label>
            <input type="text" name="txt_dien_thoai" value="<?=$txt_dien_thoai?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Địa chỉ</label>
            <input type="text" name="txt_dia_chi" value="<?=$txt_dia_chi?>" class="form-control" />
        </div>
       
        <div class="form-group">
            <label class="control-label">Kiểm duyệt</label>
            <div class="radio-list">
    			<input name="txt_trang_thai" type="radio" value="0" <?=$txt_trang_thai==0?"checked":""?> /> Tắt&nbsp;&nbsp;
    			<input name="txt_trang_thai" type="radio" value="1" <?=$txt_trang_thai==1?"checked":""?> /> Mở *&nbsp;&nbsp;
            </div>
        </div>
        <div class="form-group">
    		<input name="submit" type="submit" class="btn btn-success" value="Thực hiện" />          
        </div>
    </fieldset>
</form>
<?}?>
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
<script type="text/javascript" src="../admin/js/custom-file-input.js"></script>