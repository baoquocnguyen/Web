<?php
function active_page($cat)
{
    global $db;
    $qk=$db->select("vn_menu","menu_id='".$cat."'","");
    $rk=$db->fetch($qk);
    $txt = $rk['menu_id'];
    if($rk['cat']!='0'){
        active_page($rk['cat']);
    }
    return $txt;
}
function active_postcat($cat)
{
    global $db;
    $qk=$db->select("vn_menu","menu_id='".$cat."'","");
    $rk=$db->fetch($qk);
    $txt = $rk['menu_id'];
    if($rk['cat']!='0'){
        active_postcat($rk['cat']);
    }
    return $txt;
}
if($table=='page'){
    $qq=$db->select("vn_menu","menu_id='p".$id_slug."'","");
    $rr=$db->fetch($qq);
    if($db->num_rows($qq)!=0){
        if($rr['cat']=='0'){
            $id_active=$rr['menu_id'];
        }else{
            $id_active = active_page($rr['cat']);
        }
    }
}elseif($table=='postcat'){
    $qq=$db->select("vn_menu","menu_id='".$id_slug."'","");
    if($db->num_rows($qq)!=0){
        $rr=$db->fetch($qq);
        if($rr['cat']=='0'){
            $id_active=$rr['menu_id'];
        }else{
            $id_active = active_postcat($rr['cat']);
        }
    }else{
        $ql=$db->select("postcat","id='".$id_slug."'","");
        $rl=$db->fetch($ql);
        $ql1=$db->select("postcat","id='".$rl['cat']."'","");
        $rl1=$db->fetch($ql1);
        $qq1=$db->select("vn_menu","menu_id='".$rl1['id']."'","");
        if($db->num_rows($qq1)!=0){
            $rr1=$db->fetch($qq1);
            if($rr1['cat']=='0'){
                $id_active=$rr1['menu_id'];
            }else{
                $id_active = active_postcat($rr1['cat']);
            }
        }else{
            $ql2=$db->select("postcat","id='".$rl1['cat']."'","");
            $rl2=$db->fetch($ql2);
            $qq2=$db->select("vn_menu","menu_id='".$rl2['id']."'","");
            if($db->num_rows($qq2)!=0){
                $rr2=$db->fetch($qq2);
                if($rr2['cat']=='0'){
                    $id_active=$rr2['menu_id'];
                }else{
                    $id_active = active_postcat($rr2['cat']);
                }
            }
        }
        //dừng lại menu cấp 3
    }
}elseif($table=='post'){
    $qpost=$db->select("post","id='".$id_slug."'","");
    $rpost=$db->fetch($qpost);
    $qq=$db->select("vn_menu","menu_id='".$rpost['cat']."'","");
    if($db->num_rows($qq)!=0){
        $rr=$db->fetch($qq);
        if($rr['cat']=='0'){
            $id_active=$rr['menu_id'];
        }else{
            $id_active = active_postcat($rr['cat']);
        }
    }else{
        $ql=$db->select("postcat","id='".$rpost['cat']."'","");
        $rl=$db->fetch($ql);
        $ql1=$db->select("postcat","id='".$rl['cat']."'","");
        $rl1=$db->fetch($ql1);
        $qq1=$db->select("vn_menu","menu_id='".$rl1['id']."'","");
        if($db->num_rows($qq1)!=0){
            $rr1=$db->fetch($qq1);
            if($rr1['cat']=='0'){
                $id_active=$rr1['menu_id'];
            }else{
                $id_active = active_postcat($rr1['cat']);
            }
        }else{
            $ql2=$db->select("postcat","id='".$rl1['cat']."'","");
            $rl2=$db->fetch($ql2);
            $qq2=$db->select("vn_menu","menu_id='".$rl2['id']."'","");
            if($db->num_rows($qq2)!=0){
                $rr2=$db->fetch($qq2);
                if($rr2['cat']=='0'){
                    $id_active=$rr2['menu_id'];
                }else{
                    $id_active = active_postcat($rr2['cat']);
                }
            }
        }
        //dừng lại menu cấp 3
    }
}
?>