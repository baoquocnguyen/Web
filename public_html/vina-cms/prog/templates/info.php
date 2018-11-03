<script>
function CheckForm()
{
        code=document.frm_edit.codelang.value;
    if (document.getElementById('check'+code).value==''){
        alert('Name is not value.');
        document.getElementById('check'+code).focus();
        return false;
    }
    return true;
}
</script>
<script type="text/javascript">	
$(function(){
    $('img').error(function(){
        $(this).attr('src', 'images/no-img.png');
    });
});
</script>
<?
function	template_edit($url,$func,$id,$txt_alias,$option1,$txt_ten,$txt_chu_thich,$txt_noi_dung,$txt_url,$txt_hinh,$error)
{
    global $domain;
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="POST" style="margin:0px;" onsubmit="return CheckForm()" />
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
    <div class="col-md-8">
    <ul class="list-sub">
        <?
        global $db;
        $dem=0;
        $qnn=$db->select("language","display=1","order by thu_tu");
        while($rnn=$db->fetch($qnn)){
            $dem++;
        ?>
        <li><a href="#tab<?=$dem?>" <?if($dem==1){echo 'class="active"';}?>><?=$rnn['name']?></a></li>
        <?}?>
        <div class="clear"></div>
    </ul>
    <?
    global $db;
    $dem1=0;
    $qnn=$db->select("language","display=1","order by thu_tu");
    while($rnn=$db->fetch($qnn)){
        $dem1++;
        $qnn1=$db->select("vn_page_lang","page_id='".$id."' and lang_id='".$rnn['code']."'","order by id");
        $rnn1=$db->fetch($qnn1);
    ?>
    <fieldset class="bg-form block-sub <?if($dem1==1){echo 'active';}?>" id="tab<?=$dem1?>">
        <?if($dem1==1){?>
        <input type="hidden" name="codelang" value="<?=$rnn['code']?>" />
        <?}?>
        <div class="form-group">
            <label class="control-label">Tên</label>
            <input id="check<?=$rnn['code']?>"  <?if($dem1==1){echo 'required=""';}?> type="text" name="txt_ten[<?=$rnn['code']?>]" value="<?=$rnn1['ten']?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label class="control-label">Chú thích</label>
            <textarea name="txt_chu_thich[<?=$rnn['code']?>]" class="form-control" rows="5"><?=$rnn1['chu_thich']?></textarea>
        </div>
        <div class="form-group">
            <label class="control-label">Nội dung</label>
            <textarea id="txt_noi_dung[<?=$rnn['code']?>]" name="txt_noi_dung[<?=$rnn['code']?>]" rows="30" cols="100" class="form-control"><?=$rnn1['noi_dung']?></textarea>
            <script type="text/javascript">
            // This is a check for the CKEditor class. If not defined, the paths must be checked.
            if ( typeof CKEDITOR == 'undefined' ){document.write('') ;}
            else
            {
                var editor = CKEDITOR.replace( 'txt_noi_dung[<?=$rnn['code']?>]' );
                CKFinder.setupCKEditor( editor, '../app/packages/ckfinder' );
            }
            </script>
        </div>
        <!--<div class="form-group">
            <label class="control-label">Url</label>
            <input id="txt_url[<?=$rnn['code']?>]" type="text" name="txt_url[<?=$rnn['code']?>]" value="<?=$rnn1['url']?>" class="form-control"/>
        </div>-->
        <style>
        .form-seo{display: inline-block;padding: 10px;margin: 10px 0 20px;background: #3399FF;color:#fff}
        .form-seo,.form-seo:link,.form-seo:active,.form-seo:focus{color:#fff;}
        .form-seo:hover{background: #196ec3;}
        .show-form-seo{display: none;}
        </style>
        <a class="form-seo" href="javascript:;">Click show info SEO</a>
        <div class="show-form-seo">
            <div class="form-group">
                <label class="control-label">Title-Tiêu đề SEO</label>
                <input type="text" name="title_seo[<?=$rnn['code']?>]" value="<?=$rnn1['title_seo']?>" class="form-control" />
            </div>
            <div class="form-group">
                <label class="control-label">Keywords-Từ khóa SEO</label>
                <input type="text" name="keywords[<?=$rnn['code']?>]" value="<?=$rnn1['keywords']?>" class="form-control" />
            </div>
            <div class="form-group">
                <label class="control-label">Description-Mô tả SEO</label>
                <input type="text" name="description[<?=$rnn['code']?>]" value="<?=$rnn1['description']?>" class="form-control" />
            </div>
        </div>
        
    </fieldset>
    <?}?>
    </div>
    <div class="col-md-4">
        
        <div class="form-group">
            <label class="control-label">Alias</label>
            <input <?if($_SESSION["level"]!=0){echo 'readonly=""';}?> type="text" name="txt_alias" value="<?=$txt_alias?>" class="form-control"/>
        </div>
        <div class="form-group">
        <a class="fancybox fancybox.ajax btn btn-danger" href="<?=$domain?>/<?=admin_url?>/prog/templates/block_media.php" id="set_single" data-key='single'><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload Image&hellip;</a> <!--#media contain on main.php-->
        <input class="hidden" id="set_id" name="media_id" value="" />
        <?php echo get_image($id,"info","avatar")?> 
        </div>
        <?if($_SESSION["level"]==0||$id==19){?>
        <div class="form-group">
            <label class="control-label">Option</label>
            <div class="radio-list">
    			<input name="option1" type="radio" value="0" <?=$option1==0?"checked":""?> /> Off *&nbsp;&nbsp;
    			<input name="option1" type="radio" value="1" <?=$option1==1?"checked":""?> /> On&nbsp;&nbsp;
            </div>
        </div>
        <?}?>
        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-success" value="Submit" />
        </div>
    </div>
    <div class="clear"></div>
</form>
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
<script type="text/javascript" src="../admin/js/custom-file-input.js"></script>
<?
}
?>