<?
function	template_edit($url,$func,$id,$txt_ten,$txt_hien_thi,$txt_code,$txt_order,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="post" style="margin:0px;" />
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
    <fieldset class="bg-form">
        <div class="form-group">
            <label class="control-label">Name</label>
            <input required="" type="text" name="txt_ten" value="<?=$txt_ten?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Code</label>
            <input required="" type="text" name="txt_code" value="<?=$txt_code?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Order</label>
            <input required="" type="number" name="txt_order" value="<?=$txt_order?>" class="form-control" style="width: 10%;"/>
        </div>
        <div class="form-group">
            <label class="control-label">Show</label>
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

<?php
}
?>