<?
function	template_edit($url,$func,$id,$name,$slug,$post_type,$error)
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
            <input required="" type="text" name="name" value="<?=$name?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Slug</label>
            <input required="" type="text" name="slug" value="<?=$slug?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Post type</label>
            <input required="" type="text" name="post_type" value="<?=$post_type?>" class="form-control" style="width: 10%;"/>
        </div>
        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-success" value="Submit" />
        </div>
    </fieldset>
</form>

<?php
}
?>