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

<?
function	template_edit($url,$func,$id,$txt_cat,$txt_thu_tu,$txt_hien_thi,$txt_noi_bat,$level,$post_type,$error)
{   
    global $domain;
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="POST" style="margin:0px;" onsubmit="return CheckForm()"/>
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="post_type" value="<?=$post_type?>" />
<input type="hidden" name="func" value="<?=$func?>" />
    <div class="bg-form">
        <div class="col-sm-<?=($_GET['act']=='postcat_edit')?'8':'12'?>">
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
            $qnn1=$db->select("postcat_lang","postcat_id='".$id."' and lang_id='".$rnn['code']."'","order by id");
            $rnn1=$db->fetch($qnn1);
        ?>
        <fieldset class="bg-form block-sub <?if($dem1==1){echo 'active';}?>" id="tab<?=$dem1?>" style="padding:0;">
            <div class="form-group">
                <label class="control-label"><span>[ <i>Name</i> ]</span></label>
                <input id="check<?=$rnn['code']?>" <?if($dem1==1){echo 'required=""';}?> type="text" name="txt_ten[<?=$rnn['code']?>]" value="<?=$rnn1['name']?>" class="form-control"/>
            </div>
            <div class="form-group">
                <label class="control-label"><span>[ <i>Đường dẫn</i> ]</span></label>
                <input type="text" name="txt_url[<?=$rnn['code']?>]" value="<?=$rnn1['slug']?>" class="form-control"/>
            </div>
            <div class="form-group">
                <label class="control-label"><span>[ <i>Note</i> ]</span></label>
                <textarea name="txt_note[<?=$rnn['code']?>]" class="form-control" rows="3"><?=$rnn1['note']?></textarea>
            </div>
            
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
        <div class="col-sm-<?=($_GET['act']=='postcat_edit')?'4':'12'?>">
            <div class="form-group">
                <p class="btn-danger btn">Vui lòng kiểm tra mục "Categories" trước khi submit</p><br /><br />
                <label class="control-label">Categories</label>
                <?php
                    $deml=1;
                    $q=$db->select("postcat","cat='".$id."'","order by thu_tu");
                    if($db->num_rows($q)!=0){
                        $deml=$deml+1;
                        while ($r=$db->fetch($q)) {
                            $q1=$db->select("postcat","cat='".$r['id']."'","order by thu_tu");
                            if($db->num_rows($q1)!=0){
                                $deml=$deml+1;
                                if($deml==3){break;}
                            }
                        }
                    }
                    if($func=='new'){$deml=1;}
                ?>
                <?=show_cat('txt_cat',$txt_cat,$level,$deml,$post_type,$id)?>
            </div>
            <div class="form-group">
                <a class="fancybox fancybox.ajax btn btn-danger"  href="<?=$domain?>/<?=admin_url?>/prog/templates/block_media.php" id="set_single" data-key='single'><i class="fa fa-cloud-upload" aria-hidden="true"></i> <span>Upload Image&hellip;</a> <!--#media contain on main.php-->
                <input class="hidden" id="set_id" name="media_id" value="" />
                <?php echo get_image($id,"postcat","avatar")?>
            </div>
            <div class="form-group">
                <label class="control-label">Show</label>
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
        </div>
        <div class="clear"></div>
    </div>
</form>

<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
<script type="text/javascript" src="../admin/js/custom-file-input.js"></script>

<?}
function show_cat($name,$cat,$level,$deml,$post_type,$id)
{
global $db;
?>
<select name="<?=$name?>" class="form-control">
    <option value="0">-- Danh mục gốc --</option>
    <?
    $q=$db->select("postcat","cat=0 and level<='".$level."' and level<='".(3-$deml)."' and id!='".$id."' and post_type='".$post_type."'","order by thu_tu, id");
    while($r=$db->fetch($q))
    {$ql = $db->select("postcat_lang","postcat_id = '".$r['id']."'","order by id limit 1");
     $rl = $db->fetch($ql);
    ?>
    <option value="<?=$r['id']?>" <?if($cat==$r['id']){echo 'selected';}?>>===== <?=$rl['name']?></option>
    <?
    $q1=$db->select("postcat","cat=".$r['id']." and level<='".$level."' and level<='".(3-$deml)."' and id!='".$id."' and post_type='".$post_type."'","order by thu_tu, id");
    while($r1=$db->fetch($q1))
    {$ql1	= $db->select("postcat_lang","postcat_id = '".$r1['id']."'","order by id limit 1");
     $rl1 = $db->fetch($ql1);
    ?>
    <option value="<?=$r1['id']?>" <?if($cat==$r1['id']){echo 'selected';}?>>============ <?=$rl1['name']?></option>
    <?
    }
    }
    ?>
</select>
<?}?>