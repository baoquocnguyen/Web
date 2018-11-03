<?php
$id_menu = '';
$menu_value = '';
$json = '';
function save_menu($item,$cat,$id_menu)
{
    global $db;
    foreach ($item as $data){
        $db->insert("vn_menu","menu_id,cat,post_type,menu_cat,name,slug,type_link","'".$data->id."','".$cat."','".$data->type."','".$id_menu."','".$data->name."','".$data->slug."','".$data->link."'");
        if($data->children){
            save_menu($data->children,$data->id,$id_menu);
        }
    }
}
function show_menu($menu_cat)
{
    global $db;
    $link = '';
    $txt = '<ol class="dd-list">';
    $q = $db->select("vn_menu","menu_cat='".$menu_cat."' and cat = '0'","");
    while($r=$db->fetch($q)){
        $txt .= show_sub_menu($r['type_link'],$r['menu_id'],$menu_cat,$r['slug'],$r['name'],$r['post_type']);
    }
    $txt .= '</ol>';
    return $txt;
}
function show_sub_menu($type_link,$id,$menu_cat,$slug,$name,$type)
{
    global $db;
        $txt = "<li class='dd-item' data-id='".$id."' data-link='".$type_link."' data-slug='".$slug."' data-type='".$type."' data-name='".$name."'>";
        $txt .= "<div class='dd-handle'>".$name."</div>";
        $qcount = $db->select("vn_menu","cat='".$id."'","");
        if($qcount){$countchiren = $db->num_rows($qcount);}
        if($countchiren>0){
            $txt .= "<ol class='dd-list'>";
                $q = $db->select("vn_menu","menu_cat='".$menu_cat."' and cat = '".$id."'","");
                while($r=$db->fetch($q)){
                    $txt .= show_sub_menu($r['type_link'],$r['menu_id'],$menu_cat,$r['slug'],$r['name'],$r['post_type']);
                }
            $txt .= '</ol>';
        }
        $txt .= '</li>';
    return $txt;
}
if(isset($_GET['submitselect'])){
    $id_menu = $_GET['id_menu'];
}
if(isset($_POST['submitsave'])){
    $id_menu = $_POST['id_menu'];
    $menu_value = $_POST['menu_value'];
    if($menu_value!=''){
        $db->delete("vn_menu","menu_cat = '".$id_menu."'");
        $menus_value = json_decode($menu_value);
        save_menu($menus_value,0,$id_menu);
    }
}

// $qjson=$db->select("vn_menu","menu_cat='".$id_menu."'","order by menu_cat limit 1");
// if($qjson){
//     $rjson = $db->fetch($qjson);
//     $json = $rjson['json'];
// }
?>

<section class="content-header">
    <h1>Custom Menu<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Menu</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách Menu</h3>
                    <div class="box-tools pull-right">
                        <span class="function">
                            <a href="?act=menu_new">Thêm menu</a>    
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
                        <form method="get" action="">
                            <input type="hidden" name="act" value="menu_list"> 
                            <label>Select menu: </label>
                            <select name="id_menu" style="padding: 2px 10px;width: 150px;margin-bottom: 10px">
                                <option <?php if($id_menu==1){echo 'selected=""';}?> value="1">Menu chính</option>
                                <option <?php if($id_menu==2){echo 'selected=""';}?> value="2">Menu phụ</option>
                            </select>
                            <button type="submit" name="submitselect" value="select">Ok</button>
                        </form>
                        <div class="cf nestable-lists">
                            <div class="left_menu">
                                <menu id="nestable-menu">
                                    <button type="button" data-action="expand-all">Expand All</button>
                                    <button type="button" data-action="collapse-all">Collapse All</button>
                                </menu>
                                <span style="text-transform: uppercase;font-weight: bold;">Page</span>
                                <div id="nestable1" class="box-select dd">
                                    <ol class="dd-list">
                                        <?php
                                        $demp=0;
                                            $q=$db->selectpage("hien_thi=1 and lang_id='vn' and alias=''","");
                                            while($r=$db->fetch($q)){
                                                if($r['home']==1){
                                                    $type_link = 1;
                                                }elseif($r['option1']==1){
                                                    $type_link = 2;                                      
                                                }else{
                                                    $type_link = 0; 
                                                }
                                                $qcheckp=$db->select("vn_menu","menu_id='p".$r['page_id']."' and post_type='page' and menu_cat='".$id_menu."'","");
                                                if($db->fetch($qcheckp)==0){
                                                    $demp++;
                                        ?>
                                        <li class="dd-item" data-id="p<?=$r['page_id']?>" data-link="<?=$type_link?>" data-slug="<?=$r['slug']?>" data-name="<?=$r['ten']?>" data-type="page"><div class="dd-handle"><?=$r['ten']?></div></li>
                                        <?php }}?>
                                        <?php if($demp==0){echo '<div class="dd-empty"></div>';}?>
                                    </ol>
                                </div>
                                <span style="text-transform: uppercase;font-weight: bold;margin-top: 15px;display: block;">Categories</span>
                                <div id="nestable3" class="box-select dd">
                                    <ol class="dd-list">
                                        <?php
                                        $demp1=0;
                                            $q=$db->selectpostcat("hien_thi=1 and lang_id='vn' and cat=0","order by post_type,thu_tu");
                                            while($r=$db->fetch($q)){
                                                $qcheckp1=$db->select("vn_menu","menu_id='".$r['postcat_id']."' and post_type='postcat' and menu_cat='".$id_menu."'","");
                                               
                                                $q1=$db->selectpostcat("hien_thi=1 and lang_id='vn' and cat='".$r['postcat_id']."'","order by thu_tu");
                                        ?>
                                        <?php if($db->fetch($qcheckp1)==0){$demp1++;?><li class="dd-item" data-id="<?=$r['postcat_id']?>" data-link="0" data-slug="<?=$r['slug']?>" data-name="<?=$r['name']?>" data-type="postcat"><div class="dd-handle"><?=$r['name']?></div><?php }?>
                                            <?php if($db->num_rows($q1)!=0){?>
                                            <ol class="dd-list">
                                                <?php while($r1=$db->fetch($q1)){
                                                $q2=$db->selectpostcat("hien_thi=1 and lang_id='vn' and cat='".$r1['postcat_id']."'","order by thu_tu");

                                                $qcheckp2=$db->select("vn_menu","menu_id='".$r1['postcat_id']."' and post_type='postcat' and menu_cat='".$id_menu."'","");
                                                ?>
                                                 <?php if($db->fetch($qcheckp2)==0){$demp1++;?><li class="dd-item" data-id="<?=$r1['postcat_id']?>" data-link="0" data-slug="<?=$r1['slug']?>" data-name="<?=$r1['name']?>" data-type="postcat"><div class="dd-handle"><?=$r1['name']?></div><?php }?>
                                                    <?php if($db->num_rows($q2)!=0){?>
                                                    <ol class="dd-list">
                                                        <?php while($r2=$db->fetch($q2)){
                                                            $qcheckp3=$db->select("vn_menu","menu_id='".$r2['postcat_id']."' and post_type='postcat' and menu_cat='".$id_menu."'","");
                                                        ?>
                                                        <?php if($db->fetch($qcheckp3)==0){$demp1++;?><li class="dd-item" data-id="<?=$r2['postcat_id']?>" data-slug="<?=$r2['slug']?>" data-link="0" data-name="<?=$r2['name']?>" data-type="postcat"><div class="dd-handle"><?=$r2['name']?></div><?php }?>
                                                        </li>
                                                        <?php }?>
                                                    </ol>
                                                    <?php }?>
                                                </li>
                                                <?php }?>
                                            </ol>
                                            <?php }?>
                                        </li>
                                        <?php }?>
                                        <?php if($demp1==0){echo '<div class="dd-empty"></div>';}?>
                                    </ol>
                                </div>
                            </div>
                            <?php if($id_menu!=''){?>
                            <div class="right_menu">
                                <span style="text-transform: uppercase;font-weight: bold;display: block;padding: 35px 0 0px;"><?php if($id_menu==1){echo 'Menu chính';}else{echo 'Menu phụ';}?></span>
                                <div class="dd" id="nestable2">
                                    <?php
                                    $qc=$db->select("vn_menu","menu_cat='".$id_menu."'","");
                                    if($db->num_rows($qc)==0){echo '<div class="dd-empty"></div>';}else{echo show_menu($id_menu);}
                                    ?>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <form method="post" action="?act=menu_list" style="width: 100%;text-align: right;padding-right: 20px;">
                                <input type="hidden" name="id_menu" value="<?=$id_menu?>">
                                <input id="menu_value" type="hidden" name="menu_value" value="">
                                <button type="submit" name="submitsave" value="save">Save</button>
                            </form>
                            <?php }?>
                        </div>
                        <div class="clear"></div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function()
{
    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    $('#nestable1').nestable({
        group: 1
    })
    $('#nestable2').nestable({
        group: 1
    })
    .on('change', updateOutput);
    $('#nestable3').nestable({
        group: 1
    })
    updateOutput($('#nestable2').data('output', $('#menu_value')));
    $('#nestable-menu').on('click', function(e) {
        var target = $(e.target),
            action = target.data('action');
        if(action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if(action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });
    
});

</script>