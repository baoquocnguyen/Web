<?php
$cart = ShoppingCart::getInstance();
if(!$cart->countItems())
{   
	$thongbao = $translate['Giỏ hàng rỗng'][$lang_code];?>
    <meta http-equiv="Refresh" content="1; URL=<?=$root?>" /> 
<?}
elseif ($_POST['func'] == 'checkout')
{
	$txtContent	= htmlspecialchars($_POST['txtContent']);
	$txtName	= htmlspecialchars($_POST['txtName']);
    $txtAddress	= htmlspecialchars($_POST['txtAddress']);
	$txtEmail	= htmlspecialchars($_POST['txtEmail']);
	$txtTel		= htmlspecialchars($_POST['txtTel']);
    $txtCongty	= htmlspecialchars($_POST['txtCongty']);
    $payment	= htmlspecialchars($_POST['payment']);
	$thongbao = '';

	$hasError = false;
    if ($txtName=='')
    {
        $hasError = true;
        $thongbao = 'Name is not value!';
    }elseif ($txtAddress=='')
    {
        $hasError = true;
        $thongbao = 'Address is not value!';
    }
    elseif (!preg_match("/^(84|0)(1\d{9}|9\d{8})$/",$txtTel))
	{
		$hasError = true;
		$thongbao = 'Phone number incorrect!';
	}elseif (!ereg("[A-Za-z0-9_-]+([\.]{1}[A-Za-z0-9_-]+)*@[A-Za-z0-9-]+([\.]{1}[A-Za-z0-9-]+)+", $txtEmail)) {
        $hasError = true;
        $thongbao = "Your email incorrectly!";
    }
	if (!$hasError)
	{
            $cartContent = '<table width="100%" cellpadding="3" cellspacing="3" class="table table-hover table-condensed" >'.
            				'<tr>'.
            					'<th>'.$translate['Tên sản phẩm'][$lang_code].'</th>'.
                                '<th>'.$translate['Giá'][$lang_code].'</th>'.
            					'<th>'.$translate['Số lượng'][$lang_code].'</th>'.
            					'<th>'.$translate['Thành tiền'][$lang_code].'</th>'.
            				'</tr>';
            
    		$totalAmount = 0;
    		foreach ($cart->getItems() as $item)
    		{
    			$id			= $item->getId();
    			$name		= $item->getName();
                $hinh		= $item->getHinh();
                $code		= $item->getCode();
                $desc		= $item->getDesc();
    			$price		= $item->getPrice();
    			$quantity	= $item->getQuantity();
    			$itemAmount	= $price * $quantity;
    			$totalAmount += $itemAmount;

               
                    $cartContent .=	'<tr>'.
                                	'<td>'.$name.'</td>'.
                                	'<td>'.numberFormatVN($price).' <sup>đ/sp</sup></td>'.
                                	'<td>'.numberFormatVN($quantity).' </td>'.
                                	'<td>'.numberFormatVN($itemAmount).' <sup>đ</sup></td>'.
                                    '</tr>';
                
            }
           
            $cartContent .= '<tr>'.
                            '<td colspan="3"><b>'.$translate['Tổng cộng'][$lang_code].' </b><br /></td>'.
                            '<td><b style="font-weight: bold; font-size: 15px; color: #ff0000;">'.numberFormatVN($totalAmount).' <sup>đ</sup></b></td>'.
                            '</tr>';
            
            $cartContent.= '</table>';
           
    		if($payment==2){
                $tt='Thanh toán bằng tiền mặt';
            }elseif($payment==4){
                $tt='Thanh toán bằng hình thức chuyển khoản';
            }elseif($payment==6){
                $tt='Thanh toán bằng thẻ nội địa ATM (ONEPAY)';
            }
            $cartContent1 .= "<br /> <b style='text-transform: uppercase;display:block; margin-top:20px;text-decoration:underline;'>".$translate['Thông tin khách hàng'][$lang_code].":</b><br /><br />".
                (($txtName)?"".$translate['Họ và tên'][$lang_code]." : ".$txtName."<br /><br />":"").
                (($txtAddress)?"".$translate['Địa chỉ'][$lang_code]." : ".$txtAddress."<br /><br />":"").
                (($txtTel)?"".$translate['Điện thoại'][$lang_code]." : ".$txtTel."<br /><br />":"").
                (($txtCongty)?"".$translate['Đơn vị'][$lang_code]." : ".$txtCongty."<br /><br />":"").
                (($txtEmail)?"Email : ".$txtEmail."<br /><br />":"").
                (($txtContent)?"".$translate['Ghi chú'][$lang_code]." : ".$txtContent."<br /><br />":"").
                (($payment)?"Hình thức thanh toán : ".$tt."<br /><br />":"").
                '<b style="display:block; margin-top:20px;text-decoration:underline;">'.$translate['CHI TIẾT ĐƠN HÀNG'][$lang_code].':</b><p></p>'.$cartContent.'<br/>------------------------------------------<br/>'.  
                '<div style="color: #7e7e7e; font-size: 12px; text-align: left; font-weight: normal; line-height: 19px;" >'.$translate['Truy cập vào'][$lang_code].' <a target="_blank" href="'.$domain.'"> '.$domain.' </a> '.$translate['để biết thêm về sản phẩm - dịch vụ. Xin cảm ơn'][$lang_code].'.! <br/>Hotline: <b>  '.get_bien('hotline').' </b>Email: <b> '.get_bien('email').' </b> <br/> '.$translate['Bạn cũng có thể đến trực tiếp theo địa chỉ'][$lang_code].': <b> '.get_bien('address').' </b> </div>';
                //Nội dung liên hệ về email
                
                $OKK=$db->insert("donhang","ten,diachi,tel,email,yeu_cau,noi_dung,time,tien,congty,thanh_toan,custom_id","'".$txtName."','".$txtAddress."','".$txtTel."','".$txtEmail."','".$txtContent."','".$cartContent."','".time()."','".$totalAmount."','".$txtCongty."','".$tt."','".$_SESSION['lg_id']."'");

       if($OKK)
       {
            $mail = new PHPMailer();
            $mail->IsSMTP(); // set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // specify main and backup server
            $mail->Port = '465'; // set the port to use
            $mail->SMTPAuth = true; // turn on SMTP authentication
            $mail->SMTPSecure = 'ssl';
            $mail->Username = get_bien("email_transport",'none'); // your SMTP username or your gmail username
            $mail->Password = get_bien("pass_transport",'none'); // your SMTP password or your gmail password
            //$from = "trannhatbaoit@gmail.com"; // Reply to this email
            //$to= get_bien("email",'none'); // Recipients email ID
            $to= 'dev1.vinadesign@gmail.com'; // Recipients email ID
            $name=get_bien("title"); // Recipient's name
            $mail->From = $txtEmail;
            $mail->FromName = get_bien("title"); // Name to indicate where the email came from when the recepient received
            $mail->AddAddress($to,$name);                  // name is optional
            //$mail->AddAddress($to,$name);
            $mail->AddReplyTo($txtEmail,$txtName);
            $mail->WordWrap = 50; // set word wrap
            $mail->IsHTML(true); // send as HTML
            $mail->Subject = "".$translate['Đơn hàng từ khách'][$lang_code]." - ".$txtName." - ".$txtTel;
            $mail->Body = $cartContent1;
            $mail->AltBody = "Mail nay duoc gui bang PHP Mailer"; //Text Body
            //$mail->SMTPDebug = 2;
            if($mail->Send())
            {
                $cart->emptyCart();
    			ShoppingCart::updateInstance($cart);
    			$thongbao1 = "<i style='color:#6dd643;padding-right:10px' class='fa fa-check-circle' aria-hidden='true'></i><span style='color:#6dd643;'>".$translate['Đặt hàng thành công. Cám ơn bạn'][$lang_code]."!</span><br/>";
            }
            else
            {
                $thongbao1 = "<i style='color:yellow;padding-right:10px' class='fa fa-exclamation-triangle' aria-hidden='true'></i><span style='color:yellow;'>".$translate['Lỗi hệ thống máy chủ.<br/> Bạn vui lòng thử lại lần sau'][$lang_code].".</span>";
            }
        }
        else
        {
            $thongbao = "Có lỗi";
        }
	}
}
?>
<div class="img_top">
    <?=get_single_image("29","post","avatar")?>
</div>
<section  class="contact other_box">
    <div class="container">
<?
if (!empty($thongbao1)){?>
	<div style="text-align: center;display: block;padding: 30px 0;text-align: center;"><?=$thongbao1; ?></div>
<?php }?>
           
<?
if ($cart->countItems()){?>
    <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-7 order_left">
        <div class="box">
            <h2 class="title_order"><?=$translate['Thông tin khách hàng'][$lang_code]?></h2>
            
            <?php if(!empty($thongbao)){?>
            	<div style="color: #f00;text-align: center;display: block;padding-bottom: 10px;"><?=$thongbao; ?></div>
            <?php }?>
           
        	<form id="frmdk" action="<?=$root?>/<?=show_infopage("order","slug","16")?>" method="POST" name="frmdk">
            	<input type="hidden" name="func" value="checkout" />
                <fieldset class="payment-form">
                    <div class="form-group">	
                        <input  class="form-control " type="text" value="<?echo $txtName;?>" name="txtName" placeholder="<?=$translate['Họ và tên'][$lang_code]?> (*)" required="required" />
                    </div>
                    <div class="form-group">
                        <input  class="form-control" type="text" value="<?echo $txtAddress;?>" name="txtAddress" placeholder="<?=$translate['Địa chỉ'][$lang_code]?> (*)" />
                    </div>
                    <div class="form-group">
                        <input  class="form-control" type="text" value="<?echo $txtTel;?>" name="txtTel" placeholder="<?=$translate['Điện thoại'][$lang_code]?> (*)" required="required"  />
                    </div>
                    <div class="form-group">
                        <input  class="form-control" type="text" value="<?echo $txtEmail;?>" name="txtEmail" placeholder="E-mail*" />
                    </div>
                    <div class="form-group">
                        <input  class="form-control" type="text" value="<?echo $txtCongty;?>" name="txtCongty" placeholder="<?=$translate['Đơn vị'][$lang_code]?>" />	
                    </div>
                    <div class="form-group">
                        <textarea rows="4" class="form-control" name="txtContent" placeholder="<?=$translate['Ghi chú'][$lang_code]?>"><?=$txtContent?></textarea>
                    </div>
                </fieldset>
                <h2 class="title_order"><?=$translate['Hình thức thanh toán'][$lang_code]?></h2>
                    <div class="row">
                        <div class="custom-checkbox col-xs-12 col480 mgb15" style="margin-bottom: 20px">
                            <input class="payment" type="radio" name="payment" <?php if($payment==''||$payment==2){echo 'checked="checked"';}?> value="2" id="2" required="required"/>
                            <label for="2">&nbsp;<span><?=show_infopage("","ten","17")?></span></label>
                        </div>
                        <div class="custom-checkbox col-xs-12 col480 mgb15" style="margin-bottom: 20px">
                            <input <?php if($payment==4){echo 'checked="checked"';}?> class="payment" type="radio" name="payment" value="4" id="4"/>
                            <label for="4">&nbsp;<span><?=show_infopage("","ten","18")?></span></label>
                        </div>
                        <!-- <div class="custom-checkbox col-xs-12 col480 mgb15" style="margin-bottom: 20px">
                            <input <?php if($payment==6){echo 'checked="checked"';}?> class="payment" type="radio" name="payment" value="6" id="6"/>
                            <label for="6">&nbsp;<span><?=show_infopage("","ten","20")?></span></label>
                        </div> -->
                        <div class="col-xs-12">
                            <div id="payment_bank2" class="active_bank noi_dung"><?=show_infopage("","noi_dung","17")?></div>
                            <div id="payment_bank4" class="active_bank noi_dung" style="display: none;" ><?=show_infopage("","noi_dung","18")?></div> 
                            <!-- <div id="payment_bank6" class="active_bank noi_dung" style="display: none;" ><?=show_infopage("","noi_dung","20")?></div>    -->  
                        </div> 
                    </div>
                <div class="form-group">
                    <p class="comments">(*) <?=$translate['Là trường bắt buộc'][$lang_code]?></p>
                </div>
                <!-- <div class="dieu_khoan">
                    <label>
                        <input type="checkbox" name="agreement" id="agreement" required="required"> Tôi đã đọc và đồng ý điều khoản
                    </label>
                    <div class="noi_dung" style="width:100%;height:250px;overflow-y: scroll;padding: 20px;margin: 10px 0;border: 1px solid #ccc;">
                        <?=show_infopage("","noi_dung","21")?>
                    </div>
                </div> -->
                <a class="payment_order" onclick="submitform()"><?=$translate['Đặt hàng'][$lang_code]?></a>
            </form>
            <div class="clear"></div>
        </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 order_left">
            <div class="box">
            <h3 class="title_order"><?=$translate['Hóa đơn'][$lang_code]?></h3>
            <div class="table-responsive table-order">
            <table class="table" style="border-bottom: 3px solid #bababa;">
                <tbody>
                <?
                $totalAmount = 0;
                $so_luong = 0; 
                foreach ($cart->getItems() as $item)
                {
                $id         = $item->getId();
                $name       = $item->getName();
                $hinh       = $item->getHinh();
                $code       = $item->getCode();
                $desc       = $item->getDesc();
                $price      = $item->getPrice();
                            $slug   = $item->getSlug();
                $quantity   = $item->getQuantity();
                $itemAmount = $price * $quantity;
                $slug   = $item->getSlug();
                $so_luong   += $quantity;
                $totalAmount += $itemAmount;
                ?>
                <tr>
                    <td>
                        <div class="name_order">
                            <a class="img_order" href="<?=$root?>/<?=$slug?>" target="_blank"><?=get_single_image($id,"post","avatar")?>
                                <span> x <?=$quantity; ?></span>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="price_order">
                                <p><?=numberFormatVN($itemAmount); ?> <sup><u>đ</u></sup></p>
                            
                        </div>
                    </td>
                </tr>
                <?}?>
                </tbody>
            </table>
            </div>
            <div class="table-responsive table-order">
                <table class="table">
                    <tfoot>
                        <tr>
                            <td>
                                    <span class="payment-due-label-total"><?=$translate['Tổng cộng'][$lang_code]?></span>
                                
                            </td>
                            <td class="text-right" style="text-align: right;">
                                <span class="payment-due"><?=numberFormatVN($totalAmount); ?> <sup><u>đ</u></sup></span>
                               
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </div><!--./table-order--> 
            </div><!--./table-order-->
        </div>
    </div>
<?}else{?>
        
<?php }?>
</div>
<form id="frmonepay" action="https://www.google.com.vn/">
    
</form>
</section>
<script type="text/javascript">
    function submitform(){
        var checkne=0;
        var so_dt=document.frmdk.txtTel.value;
        var email=document.frmdk.txtEmail.value;
        if (document.frmdk.txtName.value == ''){
            alert("Name is not value.");
             document.frmdk.txtName.focus();
             checkne=1;
        }else if (document.frmdk.txtAddress.value == ''){
            alert("Address is not value.");
             document.frmdk.txtAddress.focus();
             checkne=1;
        }else if (!so_dt.match(/^[0-9-+]+$/)){
            alert("Your phone number is incorrect.");
             document.frmdk.txtTel.focus();
             checkne=1;
        }else if (!email.match(/^([-\d\w][-.\d\w]*)?[-\d\w]@([-\w\d]+\.)+[a-zA-Z]{2,6}$/)){
            alert("Your email is incorrect.");
             document.frmdk.txtEmail.focus();
             checkne=1;
        }else if ($('input#agreement').prop('checked')==false){
            alert("You have not read and accepted the terms.");
             document.frmdk.agreement.focus();
             checkne=1;
        }
        if(checkne==0){
            var txt = $("input[name='payment']:checked").val();
            //alert(txt);
            if(txt!=6){
                document.getElementById("frmdk").submit();
            }else{
                document.getElementById("frmonepay").submit();
            }
        }else{
            return false;
        }
    }
</script>