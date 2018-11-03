<?
function	template_edit($url,$func,$id,$txt_ten,$txt_address,$txt_tel,$txt_email,$txt_status,$txt_yeu_cau,$txt_noi_dung,$txt_time,$txt_congty,$txt_thanhtoan,$txt_ma,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<div id="printsection">
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="POST" style="margin:0px;" />
<input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
    <input type="hidden" name="txt_ma" value="<?=$txt_ma?>" />
    <fieldset class="bg-form">
        <div class="form-group">
            <img class="img-responsive img_log_donhang" src="../images/logo.png" />
        </div>
        <div class="title_donhang">Ngày xuất đơn hàng: <?=date('d/m/Y');?></div>

        <div class="title_muc_giohang">Thông tin khách hàng</div>
        <div class="form-group">
            <label class="control-label">Tên Khách</label>
            <input type="text" name="txt_ten" value="<?=$txt_ten?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Địa chỉ</label>
            <input type="text" name="txt_address" value="<?=$txt_address?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Số điện thoại</label>
            <input type="text" name="txt_tel" value="<?=$txt_tel?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Email</label>
            <input type="text" name="txt_email" value="<?=$txt_email?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Đơn vị</label>
            <input type="text" name="txt_congty" value="<?=$txt_congty?>" class="form-control" />
        </div>
        <div class="form-group">
            <label class="control-label">Ngày đặt hàng</label>
            <input readonly="" value="<?=lg_date::vn_time($txt_time)?> " class="form-control" />
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <label class="control-label">Tổng tiền đơn hàng</label>
                    <? $gia_full=get_sql("select tien from donhang where id =".$id)?>
                    <p class="gia_full_donhang"><?=lg_number::fix_number($gia_full)?> <sup>đ</sup></p>                
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Hình thức thanh toán</label>
            <input type="text" value="<?=$txt_thanhtoan?>" readonly="readonly" class="form-control" />
        </div>
        <div class="form-group check-tinhtrang">
            <label class="control-label">Tình trạng đơn hàng</label><br />
			<input name="txt_status" type="radio" value="0" <?=$txt_status==0?"checked":""?> /><span class="do">Đơn hàng mới (*)</span>
			<input name="txt_status" type="radio" value="1" <?=$txt_status==1?"checked":""?> /><span class="xanh">Đang xử lý</span>
            <input name="txt_status" type="radio" value="2" <?=$txt_status==2?"checked":""?> /><span class="den">Đã xử lý</span>
        </div>
        <div class="form-group">
            <label class="control-label">Yêu cầu khách hàng</label>
            <textarea readonly="" name="txt_yeu_cau" class="form-control" rows="3"><?=$txt_yeu_cau?></textarea>
        </div>
        <div class="form-group">
            <p class="title_muc_giohang">Chi tiết đơn hàng</p>
            <div><?=$txt_noi_dung?></div>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-success" value="Cập nhật" />
    		<input type="button" value="Danh sách đơn hàng" class="btn btn-btn-default" onClick="Forward('?act=donhang_list');"/>  
            <input type="button" value="Print Div" class="btn btn-danger" onclick="PrintElem('#printsection')" />
        </div>
    </fieldset>
</form>
</div>
<?
}
?>
<script>
function PrintElem(elem)
{
    Popup($(elem).html());
}
function Popup(data) 
{
    var mywindow = window.open('', 'printsection', 'height=auto,width=100%');
    mywindow.document.write('<html><head><title>Đơn hàng số #<?=$id?> | Ngày xuất đơn hàng: <?=date('d/m/Y');?></title>');
    /*optional stylesheet*/ 
    //mywindow.document.write('<link rel="stylesheet" href="../page.css" type="text/css" />');
    mywindow.document.write('</head><body >');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10

    mywindow.print();
    mywindow.close();
    return true;
}
</script>