<?php
function	template_edit($url,$func,$id,$name,$meta_key,$rows,$type,$post_type,$idmenu,$thu_tu,$width,$chu_thich,$error)
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
            <input required="" type="text" name="name" value="<?=$name?>" class="form-control"style="width: 50%;"/>
        </div>
        <div class="form-group">
            <label class="control-label">Meta key</label>
            <input required="" type="text" name="meta_key" value="<?=$meta_key?>" class="form-control" style="width: 50%;"/>
        </div>
        <div class="form-group">
            <label class="control-label">Rows</label>
            <input type="text" name="rows" value="<?=$rows?>" class="form-control" style="width: 15%;"/>
        </div>
        <div class="form-group">
            <label class="control-label">Type</label><br />
            <select name="type" style="padding: 2px 10px;width: 15%;">
                <option <?if($type==1){echo 'selected=""';}?> value="1">Input type="text"</option>
                <option <?if($type==2){echo 'selected=""';}?> value="2">Textarea</option>
                <option <?if($type==3){echo 'selected=""';}?> value="3">Textarea CKEDITOR</option>
                <option <?if($type==4){echo 'selected=""';}?> value="4">Radio</option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">Post type</label><br />
            <select name="post_type" style="padding: 2px 10px;width: 15%">
                <?
                    global $db;
                    $q=$db->select("post","hien_thi=1","group by post_type");
                    while($r=$db->fetch($q)){
                ?>
                <option <?if($post_type==$r['post_type']){echo 'selected=""';}?> value="<?=$r['post_type']?>"><?=$r['post_type']?></option>
                <?}?>
                
            </select>
        </div>
        <!--<div class="form-group">
            
            <label class="control-label">Danh mục</label><br />
            <select <?=($func=='new')?"class='multiselect hide' multiple name='idmenu[]'":"name='idmenu'"?> style="padding: 2px 10px;width: 15%">
                <?
                    global $db;
                    $q1=$db->select("postcat_lang","lang_id='vn'","");
                    while($r1=$db->fetch($q1)){
                ?>
                <!--<option <?if($idmenu==$r1['postcat_id']){echo 'selected=""';}?> value="<?=$r1['postcat_id']?>"><?=$r1['name']?></option>
                <?}?>
                
            </select>
        </div>-->
        <script type="text/javascript">
        $(document).ready(function() {
            $('.multiselect').multiselect();
        });
        </script>
        <div class="form-group">
            <label class="control-label">Sort</label>
            <input type="text" name="thu_tu" value="<?=$thu_tu?>" class="form-control" style="width: 10%;"/>
        </div>
        <div class="form-group">
            <label class="control-label">Width</label>
            <input type="text" name="width" value="<?=$width?>" class="form-control" style="width: 15%;"/>
        </div>
        <div class="form-group">
            <label class="control-label">Decripton</label>
            <input type="text" name="chu_thich" value="<?=$chu_thich?>" class="form-control" style="width:50%;"/>
        </div>
        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-success" value="Submit" />
        </div>
    </fieldset>
</form>

<?php
}
?>