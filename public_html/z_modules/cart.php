<div class="img_top">
    <?=get_single_image("28","post","avatar")?>
</div>
<div class="content__wrapper other_box">
    <div class="content_wrapper container">
            <div class="title-cart">
                <h1><span><?=$translate['Giỏ hàng'][$lang_code]?></span></h1>
                <span><?=$translate['Giỏ hàng của bạn có'][$lang_code]?>: <?=$cart->countItems()?> <?=$translate['sản phẩm'][$lang_code]?></span>
            </div>
            <div>
            <?
            //echo $magiamgia;
            //session_destroy();
            
            if (isset($_POST['update']))
            {
                foreach($cart->getItems() as $item)
                {
                    $id = $item->getId();
                    $qty = $_POST['qty_'.$id] + 0;
                    $cart->updateQuantity($id, $qty);   
                }
                ShoppingCart::updateInstance($cart);
                //admin_load_1("Cập nhật giỏ hàng",$domain.'/gio-hang/'.$magiamgia); 
                admin_load_1("",$root.'/'.show_infopage("cart","slug","15"));
                exit();
            }
            elseif (isset($_POST['delete']))
            {
                $tik = $_POST['tik'];
                for($i = 0; $i < count($tik); $i++){
                    $id = $tik[$i] + 0;
                    $cart->deleteItem($id);
                }   
                ShoppingCart::updateInstance($cart);
                admin_load_1("",$root.'/'.show_infopage("cart","slug","15"));
                exit();
            }
            ?>
            <?php
            if (!$cart->countItems())
            {
                ?>
                <div style="min-height: 200px;">
                    <p class="thongbaogiohangrong"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?=$translate['Giỏ hàng rỗng'][$lang_code]?></p>
                    <a class="thongbaogiohangrong-url" href="<?=$root?>"><i class="fa fa-chevron-left" aria-hidden="true"></i> <?=$translate['Tiếp tục mua hàng'][$lang_code]?></a>
                    <!--<meta http-equiv="Refresh" content="5; URL=<?=$root?>"/>-->
                </div>
                <?
            }
            else{
            ?>
            <form action="" method="post" id="cart" onSubmit="if(!confirm('Click OK to continue?')){return false;}">
                <div class="table-responsive">
                    <table id="cart" class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th style="width:35%"><?=$translate['Tên sản phẩm'][$lang_code]?></th>
                            <th style="width:10%"><?=$translate['Giá'][$lang_code]?></th>
                            <th style="width:8%"><?=$translate['Số lượng'][$lang_code]?></th>
                            <th style="width:12%" class="text-center"><?=$translate['Thành tiền'][$lang_code]?></th>
                            <th style="width:2%" class="text-center"><?=$translate['Xóa'][$lang_code]?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $totalAmount = 0;
                        foreach ($cart->getItems() as $item)
                        {
                            $id         = $item->getId();
                            $name       = $item->getName();
                            $desc       = $item->getDesc();
                            $price      = $item->getPrice();
                            $quantity   = $item->getQuantity();
                            $slug   = $item->getSlug();
                            $itemAmount = $price * $quantity;
                            $totalAmount += $itemAmount;
                            ?>
                            <tr class="cartlist<?=$id?>">
                                <td>
                                    <div class="car-product">
                                        <span><?=get_single_image($id,"post","avatar")?></span>
                                        <h4>
                                            <a href="<?=$root?>/<?=$slug?>" target="_blank"><?=$name?></a>
                                        </h4>
                                        <div class="clear"></div>
                                    </div>
                                </td>
                                <td class="cart_price"><?=numberFormatVN($price); ?> <sup>đ/sp</sup></td>
                                <td><input type="number" min="1" name="qty_<?=$id; ?>" class="text-center" value="<?=$quantity; ?>" onchange="getprice(<?=$price?>,<?=$id?>)" onkeyup="getprice(<?=$price?>,<?=$id?>)" id="quatity<?=$id?>" /></td>
                                <td class="cart_price text-center"><input id="tong<?=$id?>" readonly="" type="text" value="<?=numberFormatVN($itemAmount)?>" /> <sup>đ</sup></td>
                                <td class="actions text-center">
                                    <!--<a class="cartdel<?=$id?>" onclick="deletecart(<?=$id?>)" href="javascript:;return:false;" title="Xóa">Delete</a>-->
                                    <!--Xóa nhiều sản phẩm cùng lúc-->
                                    <div class="custom-checkbox">
                                        <input type="checkbox" name="tik[]" value="<?=$id;?>" id="<?=$id;?>"/>
                                        <label for="<?=$id;?>"></label>
                                     </div>
                                </td>
                            </tr>
                            <?}?>
                        </tbody>
                        <tfoot>
                       
                        <tr style="text-align: center;">
                            <td colspan="2">-</td>
                            <td><!--<button name="update" type="submit" class="btn btn-info btn-sm" title="Cập nhật giỏ hàng"><i class="fa fa-pencil-square"></i></button>--></td>
                            <td>-</td>
                            <td><button name="delete" type="submit" onclick="clicked();" class="btn btn-danger btn-sm deleter" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
                        </tr>
                        <tr>
                            <td ></td>
                            <td colspan="4" class="text-center tottal_text"><?=$translate['Tổng tiền'][$lang_code]?>: <input id="tongfix" value="<?=numberFormatVN($totalAmount)?>" readonly=""/> <sup>đ</sup></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="cart-checkout">
                    <div class="cart-checkout-left">
                        <a href="<?=$root?>" class="btn cart-continue"><i class="fa fa-caret-left" aria-hidden="true"></i> <?=$translate['Tiếp tục mua hàng'][$lang_code]?></a>
                    </div>
                    <div class="cart-checkout-right">
                        <a href="<?=$root?>/<?=show_infopage("order","slug","16")?>" class="boxton-box"><?=$translate['Đặt hàng'][$lang_code]?> <i class="fa fa-angle-right"></i></a>
                    </div>                        
                </div>
            </form>    
            <?}?>
        </div>
    </div>
</div>
