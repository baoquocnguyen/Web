<?php
ob_start();
session_start();
ob_start();
include "../_CORE/index.php";
include "../app/config/config.php";
$db		=	new	lg_mysql($host,$dbuser,$dbpass,$csdl);
include("../app/start/func.php");
include "../app/packages/shopping-cart/cart_item.class.php"; 
include "../app/packages/shopping-cart/shopping_cart.class.php";

$id = $_GET['id'] + 0;
$so_luong=$_GET['so_luong']+0;
if($so_luong==''){$so_luong=1;}
if (!$id)
{
	return;
}
$q = $db->selectpost("post_id=".$id,"");
if ($r = $db->fetch($q))
{
	$cart = ShoppingCart::getInstance();
	$gia=0;
	if($r['old_price']==''){
        $gia = 0;
    }elseif($r['new_price']!=''){
        $gia = (int)$r['new_price'];
    }else{
        $gia = (int)$r['old_price'];
    }
	$item = new CartItem($r['post_id'], $r['ten'],'', '', $r['chu_thich'], $gia, $so_luong,$r['slug']); 
    
	$cart->addItem($item);
    ShoppingCart::updateInstance($cart);
    $cart->updateQuantity($r['post_id'], $so_luong);
    ShoppingCart::updateInstance($cart);
    
    echo $cart->countItems();
}
?>
