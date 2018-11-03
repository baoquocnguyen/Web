<?
function	template_edit($url,$func,$id,$txt_ten,$txt_noi_dung,$txt_traloi,$txt_hien_thi,$txt_date,$txt_email,$txt_kiemduyet,$sanpham,$danhgia,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="POST" style="margin:0px;" />
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="sanpham" value="<?=$sanpham?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
<div class="col-md-8" style="text-align: left;">
<fieldset class="bg-form">
    <div class="form-group">
        <label class="control-label">Người đánh giá</label>
        <input type="text" name="txt_ten" value="<?=$txt_ten?>"  class="form-control" />
    </div>
    <div class="form-group">
        <label class="control-label">Email</label>
        <input type="text" name="txt_email" value="<?=$txt_email?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label class="control-label">Người đánh giá</label>
        <select name="sanpham" class="form-control" style="width:52%">
            <option value="0" >--Chọn Sản phẩm--</option>
            <?
            global $db;
            $q13=$db->selectpost("hien_thi=1 and post_type='catproduct_detail'","order by post_id");
            while($r13=$db->fetch($q13)){
            ?>
            <option <?if($sanpham==$r13['post_id']){echo 'selected="selected"';}?> value="<?=$r13['post_id']?>"><?=$r13['ten']?></option>
            <?}?>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label">Stars</label>
        <div class="clear"></div>
     	<fieldset id='demo1' class="rating">
            <input <?php if($danhgia==5){echo 'checked=""';}?> class="stars" type="radio" id="star5" name="danhgia" value="5" />
            <label class = "full" for="star5" title="Awesome - 5 stars"></label>
            <input <?php if($danhgia==4){echo 'checked=""';}?> class="stars" type="radio" id="star4" name="danhgia" value="4" />
            <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
            <input <?php if($danhgia==3){echo 'checked=""';}?> class="stars" type="radio" id="star3" name="danhgia" value="3" />
            <label class = "full" for="star3" title="Meh - 3 stars"></label>
            <input <?php if($danhgia==2){echo 'checked=""';}?> class="stars" type="radio" id="star2" name="danhgia" value="2" />
            <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
            <input <?php if($danhgia==1){echo 'checked=""';}?> class="stars" type="radio" id="star1" name="danhgia" value="1" />
            <label class = "full" for="star1" title="Sucks big time - 1 star"></label>
        </fieldset> 
        <div class="clear"></div>
    </div>
    <div class="form-group">
        <label class="control-label">Nội dung</label>
        <textarea id="txt_noi_dung" name="txt_noi_dung" rows="30" cols="80"><?=$txt_noi_dung?></textarea>
        <script type="text/javascript">
        // This is a check for the CKEditor class. If not defined, the paths must be checked.
        if ( typeof CKEDITOR == 'undefined' ){document.write('') ;}
        else
        {
            var editor = CKEDITOR.replace( 'txt_noi_dung' );
            CKFinder.setupCKEditor( editor, '../app/packages/ckfinder' );
        }
        </script>
    </div>
    <div class="form-group">
        <label class="control-label">Quản trị trả lời</label>
        <textarea id="txt_traloi" name="txt_traloi" rows="30" cols="80"><?=$txt_traloi?></textarea>
        <script type="text/javascript">
        // This is a check for the CKEditor class. If not defined, the paths must be checked.
        if ( typeof CKEDITOR == 'undefined' ){document.write('') ;}
        else
        {
            var editor = CKEDITOR.replace( 'txt_traloi' );
            CKFinder.setupCKEditor( editor, '../app/packages/ckfinder' );
        }
        </script>
    </div>
    </fieldset>
</div>
<div class="col-md-4">
	<fieldset>
	<div class="form-group">
        <label class="control-label">Duyệt bình luận</label>
        <div class="radio-list">
			<input name="txt_kiemduyet" type="radio" value="0" <?=$txt_kiemduyet==0?"checked":""?> /> <a style="color: #ff0000; text-decoration: none;">Không duyệt (*) </a>
			<input name="txt_kiemduyet" type="radio" value="1" <?=$txt_kiemduyet==1?"checked":""?> /> 
                <a style="color: #0fc417; text-decoration: none;">
                    Duyệt
                </a>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label">Ngày đăng</label>
        <div class="radio-list">
			<input type="text" name="txt_date" value="<?=$txt_date?>" class="form-control" style="width:30%" /> (dd/mm/YYYY)
        </div>
    </div>
    <div class="form-group">
        <input name="submit" type="submit" class="btn btn-success" value="Submit" />
    </div>
</fieldset>
</div>
<div class="clear"></div>
</form>
<?
}
function	show_cat($name,$id)
{
	global $db;
	
$r2 = $db->select("tgp_cat","_cms = 1","order by thu_tu asc");
?>
<select name="<?=$name?>" class="input_sp" style="width:50%;">
<?php
while ($row2 = $db->fetch($r2))
{
	echo "<optgroup label='".$row2["ten"]."'>";
	$r	=	$db->select("tgp_cms_menu","cat = '".$row2["id"]."'","order by thu_tu asc");
	while ($row = $db->fetch($r))
	{
		echo "<option value='".$row["id"]."'";
		if ($id == $row["id"]) echo " selected ";
		echo ">".$row["ten"]."</option>";
	}
	echo "</optgroup>";
}
?>
</select>
<?php
}
?>