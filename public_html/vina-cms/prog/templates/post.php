
<script type="text/javascript">
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

$(document).ready(function(){
    $(".txtboxToFilter").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});

function formatNumber(num){
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}
function edValueKeyPress()
{
    var edValue = document.getElementById("edValue");
    var s = edValue.value;
    var lblValue = document.getElementById("lblValue");
    lblValue.innerText = formatNumber(s);
}
function giamoiValueKeyPress()
{   
    var giamoivalue = document.getElementById("giamoivalue");
    var g = giamoivalue.value;
    var vgiamoi = document.getElementById("vgiamoi");
    vgiamoi.innerText = formatNumber(g); 
}
function giasiValueKeyPress()
{   
    var giasivalue = document.getElementById("giasivalue");
    var g = giasivalue.value;
    var vgiasi = document.getElementById("vgiasi");
    vgiasi.innerText = formatNumber(g); 
}

function edit_url(url,lng)
{   
    $('.xanh_'+lng).addClass('xam');
    $('.replace_here_'+lng).html('<input id="input_edit_'+lng+'" class="input_edit" black" value="'+url+'" />'+' .html');
    $('.button_edit_'+lng).html('<a class="btn btn-success" onclick="replace_url('+"'"+lng+"'"+')" class="edit_url" href="javascript:;return false;">Ok</a> <a class="btn btn-default" onclick="huy_url('+"'"+url+"'"+','+"'"+lng+"'"+')" class="huy_url" href="javascript:;return false;">Hủy</a>');
    $('.input_edit').focus();
}
function huy_url(url,lng)
{   

    $('.xanh'+lng).removeClass('xam');
    $('.replace_here_'+lng).html(url+'.html');
    $('.button_edit_'+lng).html('<a class="btn btn-default" onclick="edit_url('+"'"+url+"'"+','+"'"+lng+"'"+')" class="edit_url" href="javascript:;return false;"><i title="Edit" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>');
}
function replace_url(lng)
{   
    var id = <?=$id?>;
    var url = $('#input_edit_'+lng).val();
    if(url!=''){
        $.ajax({
            type:'GET',
            url:'<?=$domain?>/<?=admin_url?>/replace_url.php',
            data:{ url:url,id:id,lng:lng},
            success:function(qq){
                $('.xanh_'+lng).removeClass('xam');
                $('.replace_here_'+lng).html(qq);
                var qqk = qq.replace(".html", "")
                $('.button_edit_'+lng).html('<a onclick="edit_url('+"'"+qqk+"'"+','+"'"+lng+"'"+')" class="edit_url" href="javascript:;return false;"><i title="Edit" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>');
            }
        });
    }else{
        alert('Please enter value!');
        $('#input_edit_'+lng).focus();
    }
}
</script>
<script type="text/javascript" src="<?=$domain?>/admin/js/jquery.number.js"></script>			
<script type="text/javascript">	
$(function(){
    $('img').error(function(){
        $(this).attr('src', 'images/no-img.png');
    });
});
</script>

<?
function template_edit($url,$func,$id,$txt_cat,$txt_hien_thi,$txt_noi_bat,$post_type,$txt_option1,$txt_option2,$error)
{
    global $domain;
?>

<?

foreach($error as $v){
    echo "<div align=center style='color:#990000;'><strong>".$v."</strong></div>";
}
?>
<style type="text/css">
    .edit_url{display: inline-block;background: #eee;border:1px solid #999;border-radius: 3px;padding: 2px 8px;margin-left: 10px;font-size: 12px;color: #777;}
    .huy_url{text-decoration: underline!important;font-size: 12px;color: #00a0d2;}
    .xanh{color: #0073aa;}
    .xam{color: #666;}
    .xam b{font-weight: normal;}
</style>
<?//=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="post" onsubmit="return CheckForm()">
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="post_type" value="<?=$post_type?>" />
<input type="hidden" name="func" value="<?=$func?>" />
<?$post_type_me=str_replace("_detail","",$post_type);?>
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
        <?if($id!='0'){?>
        <?$qcat01 = $db->select("post","id=".$id);$rcat01=$db->fetch($qcat01);$qcat02 = $db->select("postcat","id=".$rcat01['cat']);$rcat02=$db->fetch($qcat02);$qlang0	= $db->select("postcat_lang","postcat_id = '".$rcat02['id']."'","");$rlang0 = $db->fetch($qlang0);$qlang01	= $db->select("post_lang","post_id = '".$rcat01['id']."'","");$rlang01 = $db->fetch($qlang01);?>
            <li><a href="?act=album_mana_list&cat=<?=$id?>&post_type=<?=$post_type?>&type=album&parent_type=post" class="active bg-primary"><span>[ <i>Album</i> ]</span> <?=$rlang01['ten']?></a></li>
        <?}?>
        <div class="clear"></div>
    </ul>
    <?
    global $db,$domain;
    $dem1=0;
    $qnn=$db->select("language","display=1","order by thu_tu");
    while($rnn=$db->fetch($qnn)){
        $dem1++;
        $qnn1=$db->select("post_lang","post_id='".$id."' and lang_id='".$rnn['code']."'","order by id");
        $rnn1=$db->fetch($qnn1);
    ?>
    <fieldset class="bg-form block-sub <?if($dem1==1){echo 'active';}?>" id="tab<?=$dem1?>">
        <?if($dem1==1){?>
        <input type="hidden" name="codelang" value="<?=$rnn['code']?>" />
        <?}?>
        <input type="hidden" name="lang[<?=$rnn['code']?>]" value="<?=$rnn['code']?>" />
        <div class="form-group" style="margin-bottom: 8px;">
            <label class="control-label">Tên</label>
            <input id="check<?=$rnn['code']?>" style="font-size: 18px;" <?if($dem1==1){echo 'required=""';}?> type="text" name="ten[<?=$rnn['code']?>]" value="<?=$rnn1['ten']?>" class="form-control" />
        </div>
        <?php if($rnn1['ten']!=''){?>
        <div class="form-group" style="font-family: arial;font-size: 13px">
            <label style="font-weight: normal;font-weight: bold;color: #666;padding-left: 15px;">Url: </label>
            <span class="xanh xanh_<?=$rnn['code']?>"><?=$domain?>/<b class="replace_here_<?=$rnn['code']?>"><?=str_replace('.html','',$rnn1['slug'])?>.html</b></span>
            <span class="button_edit_<?=$rnn['code']?>">
            <a class="btn btn-default" onclick="edit_url('<?=str_replace('.html','',$rnn1['slug'])?>','<?=$rnn['code']?>')" class="edit_url edit_url_<?=$rnn['code']?>" href="javascript:;return false;"><i title="Edit" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            </span>
            <span style="float: right;"><a class="btn btn-default" href="<?=$domain.'/'.str_replace('.html','',$rnn1['slug']).'.html'?>"><i class="fa fa-link" aria-hidden="true"></i> Preview</a></span>
        </div>
        <?php }?>
        <div class="form-group">
            <label class="control-label">Chú thích</label>
            <textarea name="chu_thich[<?=$rnn['code']?>]" class="form-control" rows="5"><?=$rnn1['chu_thich']?></textarea>
        </div>
        <?if($post_type=='catproduct_detail'){?>
        <div class="form-group" style="position: relative;">
            <label class="control-label">Giá</label>
            <input type="text" id="edValue" onkeypress="edValueKeyPress()" onkeyup="edValueKeyPress()" name="old_price[<?=$rnn['code']?>]" value="<?=$rnn1['old_price']?>" class="form-control txtboxToFilter" />
            <span class="tutip" id="lblValue"></span>
        </div>
        <!-- <div class="form-group" style="position: relative;">
            <label class="control-label">Giá sỉ</label>
            <input type="text" id="giasivalue" onkeypress="giasiValueKeyPress()" onkeyup="giasiValueKeyPress()" name="wholesale_price[<?=$rnn['code']?>]" value="<?=$rnn1['wholesale_price']?>" class="form-control txtboxToFilter" />
            <span class="tutip" id="vgiasi"></span>
        </div> -->
        <?}?>

        <?if($post_type=='catproduct_detail'){?>
        <div class="form-group" style="position: relative;">
            <label class="control-label">Giá khuyến mãi</label>
            <input type="text" id="giamoivalue" onkeypress="giamoiValueKeyPress()" onkeyup="giamoiValueKeyPress()" name="new_price[<?=$rnn['code']?>]" value="<?=$rnn1['new_price']?>" class="form-control txtboxToFilter" />
            <span class="tutip" id="vgiamoi"></span>
        </div>        
        <?}?>
        <style>
        .form-seo{display: inline-block;padding: 10px;margin: 10px 0 20px;background: #3399FF;color:#fff}
        .form-seo,.form-seo:link,.form-seo:active,.form-seo:focus{color:#fff;}
        .form-seo:hover{background: #196ec3;}
        .show-form-seo{display: none;}
        .btn_showoption{width:100%;display: block;border-bottom:4px solid #ddd;text-transform: uppercase;color:#555;font-weight:600;font-size:14px;padding-bottom:4px;margin-bottom:10px;}
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
        
        
        <div class="form-group">
            <label class="control-label">Nội dung</label>
            <textarea id="noi_dung[<?=$rnn['code']?>]" name="noi_dung[<?=$rnn['code']?>]"><?=$rnn1['noi_dung']?></textarea>
            <script type="text/javascript">
            // This is a check for the CKEditor class. If not defined, the paths must be checked.
            if ( typeof CKEDITOR == 'undefined' ){document.write('') ;}
            else
            {
                var editor = CKEDITOR.replace( 'noi_dung[<?=$rnn['code']?>]' );
                CKFinder.setupCKEditor( editor, '../app/packages/ckfinder' );
            }
            </script>
        </div>
        
        
        <ul class="list-sub-option">
            <?
            $c=0;
            $qtab=$db->select("post_meta_key","post_type='".$post_type."'","order by thu_tu");
            while($rtab=$db->fetch($qtab)){
                $c++;
                $d=$c.$rnn['code'];                
            ?>
            <li><a href="#tabslug<?=$d?>" <?if(($d=='1vn')||($d=='1en')){echo 'class="active"';}?>><?=$rtab['name']?></a></li>
            <?}?>
            <div class="clear"></div>
        </ul>
        <?
        $c1=0;
        $qop=$db->select("post_meta_key","post_type='".$post_type."'","order by thu_tu");
        if($db->num_rows($qop)!=0){
        while($rop=$db->fetch($qop)){$c1++;
            $d1=$c1.$rnn['code'];                
            ?>
            <div class="bg-form block-sub-option <?if(($d1=='1vn')||($d1=='1en')){echo 'active';}?>" id="tabslug<?=$c1.$rnn['code']?>">
            <?
            $qop1=$db->select("post_meta","meta_key='".$rop['meta_key']."' and post_id='".$id."' and lang_id='".$rnn['code']."'","order by id");
            $rop1=$db->fetch($qop1);
            if($rop['type']==1){?>
                <div class="form-group">
                    <input type="text" name="meta_key[<?=$rop['meta_key']?>][<?=$rnn['code']?>]" value="<?=$rop1['meta_value']?>" class="form-control" style="width: <?=$rop['width']?>%;" /><span style="color:#4e4d4d;padding: 5px 0;display: inline-block;"><?=$rop['chu_thich']?></span>
                </div>
            <?}elseif($rop['type']==2){?>
                <div class="form-group">
                    <textarea name="meta_key[<?=$rop['meta_key']?>][<?=$rnn['code']?>]" class="form-control" rows="<?=$rop['rows']?>"  style="width: <?=$rop['width']?>%;"><?=$rop1['meta_value']?></textarea><span style="color:#4e4d4d;padding: 5px 0;display: inline-block;"><?=$rop['chu_thich']?></span>
                </div>
            <?}elseif($rop['type']==4){?>
                <div class="form-group">
                    <div class="radio-list">
                        <input name="meta_key[<?=$rop['meta_key']?>][<?=$rnn['code']?>]" type="radio" value="0" <?=$rop1['meta_value']=='0'?"checked":""?> /> Off *&nbsp;&nbsp;
                        <input name="meta_key[<?=$rop['meta_key']?>][<?=$rnn['code']?>]" type="radio" value="1" <?=$rop1['meta_value']=='1'?"checked":""?> /> On&nbsp;&nbsp;
                    </div>
                </div>
            <?}else{?>
                <div class="form-group">
                    <textarea id="meta_key[<?=$rop['meta_key']?>][<?=$rnn['code']?>]" name="meta_key[<?=$rop['meta_key']?>][<?=$rnn['code']?>]"><?=$rop1['meta_value']?></textarea>
                    <script type="text/javascript">
                    // This is a check for the CKEditor class. If not defined, the paths must be checked.
                    if ( typeof CKEDITOR == 'undefined' ){document.write('') ;}
                    else
                    {
                        var editor = CKEDITOR.replace( 'meta_key[<?=$rop['meta_key']?>][<?=$rnn['code']?>]' );
                        CKFinder.setupCKEditor( editor, '../app/packages/ckfinder' );
                    }
                    </script>
                </div>
            <?php }?>
            </div>  
        <?}}?>
    </fieldset>
    <?}?>
        <div class="form-group text-right">
            <input name="submit" type="submit" class="btn btn-success" value="Submit" />
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Categories</label>
            <? show_cat("txt_cat",$txt_cat,$post_type_me); ?>
        </div>
        <div class="form-group">
            <!--Ajax example will not run from your local computer and requires a server to run.-->
            <a class="fancybox fancybox.ajax btn btn-danger" href="<?=$domain?>/<?=admin_url?>/prog/templates/block_media.php" id="set_single" data-key='single'><i class="fa fa-cloud-upload" aria-hidden="true"></i> <?php if($post_type!='catalogue_detail'){?>Upload Image&hellip;<?php }else{?>Upload file catalogue&hellip;<?php }?></a> <!--#media contain on main.php-->
        </div>
        <input class="hidden" id="set_id" name="media_id" value="" />
        <?php echo get_image($id,"post","avatar")?> 
        <div class="form-group">
            <label class="control-label">Hiển thị</label>
            <div class="radio-list">
    			<input name="txt_hien_thi" type="radio" value="0" <?=$txt_hien_thi==0?"checked":""?> /> Off *&nbsp;&nbsp;
    			<input name="txt_hien_thi" type="radio" value="1" <?=$txt_hien_thi==1?"checked":""?> /> On&nbsp;&nbsp;
            </div>
        
        </div>
        <div class="form-group">
            <label class="control-label">Nổi bật</label>
            <div class="radio-list">
                <input name="txt_noi_bat" type="radio" value="0" <?=$txt_noi_bat==0?"checked":""?> /> Off *&nbsp;&nbsp;
                <input name="txt_noi_bat" type="radio" value="1" <?=$txt_noi_bat==1?"checked":""?> /> On&nbsp;&nbsp;
            </div>
        </div>
       </div>
    
    
    <div class="clear"></div>
</form>

<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
<script type="text/javascript" src="../admin/js/custom-file-input.js"></script>

<?
}

function show_cat($name,$cat,$post_type)
{
    global $db;
    ?>
    <select class="form-control" name="<?=$name?>">
        <?
        $q=$db->select("postcat","cat=0 and post_type='".$post_type."'","order by thu_tu, id");
        while($r=$db->fetch($q))
        {
            $qc1	= $db->select("postcat_lang","postcat_id = '".$r['id']."'","order by id limit 1");
            $rc1 = $db->fetch($qc1);
            ?>
            <option value="<?=$r['id']?>" <?if($cat==$r['id']){echo 'selected';}?>><?=$rc1['name']?></option>
            <?
            $q1=$db->select("postcat","cat=".$r['id']." and post_type='".$post_type."'","order by thu_tu, id");
            while($r1=$db->fetch($q1))
            {
                $qc2	= $db->select("postcat_lang","postcat_id = '".$r1['id']."'","order by id limit 1");
                $rc2 = $db->fetch($qc2);
            ?>
            <option value="<?=$r1['id']?>" <?if($cat==$r1['id']){echo 'selected';}?>>==== <?=$rc2['name']?></option>
                <?
                $q2=$db->select("postcat","cat=".$r1['id']." and post_type='".$post_type."'","order by thu_tu, id");
                while($r2=$db->fetch($q2))
                {
                    $qc3	= $db->select("postcat_lang","postcat_id = '".$r2['id']."'","order by id limit 1");
                    $rc3 = $db->fetch($qc3);
                ?>
                <option value="<?=$r2['id']?>" <?if($cat==$r2['id']){echo 'selected';}?>>======== <?=$rc3['name']?></option>
                <?
                }
            }
        }
    ?>
    </select>
    <?}?>
    
<style>
.tutip{position: absolute;bottom:60%;right:0px;background: transparent;color:#555;display: inline-block;line-height: 30px;padding: 0 20px;z-index: 9;}

.ulinput{padding:0px;}
.ulinput li{list-style-type: none;padding: 5px 0px}
label.css-label{
-webkit-touch-callout: none;
-webkit-user-select: none;
-khtml-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
}
input[type=checkbox].css-checkbox{
    position: absolute; 
    overflow: hidden; 
    clip: rect(0 0 0 0); 
    height:1px; 
    width:1px; 
    margin:-1px; 
    padding:0;
    border:0;
}
input[type=radio].css-radio{
    position: absolute; 
    overflow: hidden; 
    clip: rect(0 0 0 0); 
    height:1px; 
    width:1px; 
    margin:-1px; 
    padding:0;
    border:0;
}
input[type=checkbox].css-checkbox + label.css-label{
    padding-left:20px;
    height:15px; 
    display:inline-block;
    line-height:15px;
    background-repeat:no-repeat;
    background-position: 0 0;
    font-size:12px;
    vertical-align:middle;
    cursor:pointer;
}
input[type=radio].css-radio + label.css-label{
    padding-left:20px;
    height:15px; 
    display:inline-block;
    line-height:15px;
    background-repeat:no-repeat;
    background-position: 0 0;
    font-size:12px;
    vertical-align:middle;
    cursor:pointer;
}
input[type=checkbox].css-checkbox:checked + label.css-label{
    background-position: 0 -15px;
}
input[type=radio].css-radio:checked + label.css-label{
    background-position: 0 -15px;
}
.css-label{background-image:url(images/dark-check-cyan.png);}
</style>
