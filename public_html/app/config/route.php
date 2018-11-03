<?
$kituzalo = array('?utm_source=zalo&utm_medium=zalo&utm_campaign=zalo&zarsrc=10',"?utm_source=zalo&utm_medium=zalo&utm_campaign=zalo&zarsrc=35","?utm_source=zalo&utm_medium=zalo&utm_campaign=zalo&zarsrc=30","?utm_source=zalo&utm_medium=zalo&utm_campaign=zalo");
$kitufixzalo = array('','','','');
$slug = str_replace($kituzalo,$kitufixzalo,$_SERVER['REQUEST_URI']);
$lang_code = '';
$lang_new=$db->select("language","display=1","order by thu_tu limit 1");
$rlang_new=$db->fetch($lang_new);
$lang_code = $rlang_new['code'];
$lecture = '';$callpage = '';$slugkh = '';
$id_slug = '';
$id_active = '';
$table = '';
$key_search = '';
$page=1;
$slugg = explode('?',$slug);
$search[]='';
//Check biến get
if(count($slugg)!=1){
    $key_search = '?'.$slugg[count($slugg)-1];
    $slug = str_replace($key_search,'',$slug);
}
$slug = trim($slug,'/');
//Check ngôn ngử
$slugl = explode('/',$slug);
$checklang=$db->select("language","code='".$slugl[0]."'","");
if($db->num_rows($checklang)==0){
    $slugk = $slugl;
    $root = "http://".$_SERVER['HTTP_HOST']."";
}else{
    $lang_code = $slugl[0];
    unset($slugl[0]);
    $slug = implode('/',$slugl);
    $slug = trim($slug,'/');
    $slugk = explode('/',$slug);
    $root = "http://".$_SERVER['HTTP_HOST']."/".$lang_code;
}
if($slug!=''){
    //Check .html
    if(strpos($slugk[count($slugk)-1],'page-')!== false){
        $page=str_replace("page-","",$slugk[count($slugk)-1]);
        $slug = str_replace($slugk[count($slugk)-1],'',$slug);
        $slug = trim($slug,'/');
        $slugk = explode('/',$slug);
    }
    if(strpos($slugk[count($slugk)-1],'.html')!== false){
        $slugnew = $slugk[count($slugk)-1];
        //Check page
        $checkpageslug=$db->selectpage("slug='".$slugnew."' and post_type<>''","");
        if($db->num_rows($checkpageslug)!=0){
            $rcheckpageslug = $db->fetch($checkpageslug);
            $post_type = $rcheckpageslug['post_type'];
            $id_slug = $rcheckpageslug['page_id'];
            $table='page';
            DEFINE("the_title",$rcheckpageslug['ten']);
            DEFINE("the_content",$rcheckpageslug['noi_dung']);
            DEFINE("the_note",$rcheckpageslug['chu_thich']);
            DEFINE("the_time",$rcheckpageslug['time']);
            DEFINE("the_view",$rcheckpageslug['luot_xem']);
            DEFINE("the_user",$rcheckpageslug['user']);
            DEFINE("the_slug",$root.'/'.$rcheckpageslug['slug']);
        }else{
            //Check post
            $checkpostslug=$db->selectpost("slug='".$slugnew."'","");
            if($db->num_rows($checkpostslug)!=0){
                $rcheckpostslug = $db->fetch($checkpostslug);
                $post_type = $rcheckpostslug['post_type'];
                $id_slug = $rcheckpostslug['post_id'];
                $table='post';
                DEFINE("the_parent",$rcheckpostslug['cat']);
                DEFINE("the_title",$rcheckpostslug['ten']);
                DEFINE("the_content",$rcheckpostslug['noi_dung']);
                DEFINE("the_note",$rcheckpostslug['chu_thich']);
                DEFINE("the_time",$rcheckpostslug['time']);
                DEFINE("the_view",$rcheckpostslug['luot_xem']);
                DEFINE("the_user",$rcheckpostslug['user']);
                DEFINE("the_slug",$root.'/'.$rcheckpostslug['slug']);
                DEFINE("the_price",$rcheckpostslug['old_price']);
                DEFINE("the_price1",$rcheckpostslug['new_price']);
            }else{
                $post_type = '404';
            }
        }
    //Check phân trang
    }else{
        $slugnew = $slugk[count($slugk)-1];
        //Check galery_menu
        $checkgalmenuslug=$db->selectgalmenu("slug='".$slugnew."'","");
        if($db->num_rows($checkgalmenuslug)!=0){
            $rcheckgalmenuslug = $db->fetch($checkpageslug);
            $post_type = $rcheckgalmenuslug['post_type'];
            $id_slug = $rcheckgalmenuslug['gallery_menu_id'];
            $table='gallery_menu';
        }else{
            //Check postcat
            $checkpostcatslug=$db->selectpostcat("slug='".$slugnew."'","");
            if($db->num_rows($checkpostcatslug)!=0){
                $rcheckpostcatslug = $db->fetch($checkpostcatslug);
                $post_type = $rcheckpostcatslug['post_type'];
                $id_slug = $rcheckpostcatslug['postcat_id'];
                $table='postcat';
                DEFINE("the_title",$rcheckpostcatslug['name']);
                DEFINE("the_note",$rcheckpostcatslug['note']);
                DEFINE("the_parent",$rcheckpostcatslug['cat']);
            }else{
                $post_type = '404';
            }
        }
    }
}

//echo $rcheckpageslug, $post_type, $id_slug, $lang_code, $slug
include "active-menu.php";
?>