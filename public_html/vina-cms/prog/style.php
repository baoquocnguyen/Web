<section class="content-header">
    <h1>Style<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Style</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-green">
                <div class="box-header with-border">
                    <h3 class="box-title">Style</h3>
                    <div class="clear"></div>
                </div>
            <div class="paddinglr10">
<?php
$act            = $_GET['act'];
$color_1        = $_POST['color_1'];
$color_2        = $_POST['color_2'];
$color_3        = $_POST['color_3'];
$color_4        = $_POST['color_4'];
$color_5        = $_POST['color_5'];
$color_6        = $_POST['color_6'];
if (empty($func)) $func = $_POST['func'];    
if ($func == "update")
{
    $db->update("vn_style","value",$color_1,"name = 'color_1'");
    $db->update("vn_style","value",$color_2,"name = 'color_2'");
    $db->update("vn_style","value",$color_3,"name = 'color_3'");
    $db->update("vn_style","value",$color_4,"name = 'color_4'");
    $db->update("vn_style","value",$color_5,"name = 'color_5'");
    $db->update("vn_style","value",$color_6,"name = 'color_6'");
	admin_load("","?act=style");
}
else
{
    //admin_load("","?act=style");
}
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?$url?>" enctype="multipart/form-data" method="POST" style="margin:0px;" />
    <input type="hidden" name="act" value="<?=str_replace("?act=","",$url)?>" />
	<input type="hidden" name="func" value="update" />
        <div class="col-sm-6 col-xs-12">
            <div class="form-full">
                <fieldset>
                    <div class="form-group">
                        <label>Backgroud color</label>
                        <div class="cp2 input-group colorpicker-component">
                            <input type="text" name="color_1" value="<?=get_style("color_1")?>" class="form-control" />
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Backgroud content</label>
                        <div class="cp2 input-group colorpicker-component">
                            <input type="text" name="color_2" value="<?=get_style("color_2")?>" class="form-control" />
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Color one</label>
                        <div class="cp2 input-group colorpicker-component">
                            <input type="text" name="color_3" value="<?=get_style("color_3")?>" class="form-control" />
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Color two</label>
                        <div class="cp2 input-group colorpicker-component">
                            <input type="text" name="color_4" value="<?=get_style("color_4")?>" class="form-control" />
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Color three</label>
                        <div class="cp2 input-group colorpicker-component">
                            <input type="text" name="color_5" value="<?=get_style("color_5")?>" class="form-control" />
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Color four</label>
                        <div class="cp2 input-group colorpicker-component">
                            <input type="text" name="color_6" value="<?=get_style("color_6")?>" class="form-control" />
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div><!-- end block-left -->
        <div class="col-sm-6 col-xs-12">
            <div class="form-full">
                <fieldset>
                    <div class="form-group">
                        <label>....</label>
                        <input type="text" name="" value="" />
                    </div>
                </fieldset>
            </div>
        </div><!-- end block-right -->
        <div class="clear"></div>
        <div class="form-group" style="padding: 10px;">
    		<input name="submit" type="submit" class="btn btn-success" value="Thực hiện" />       
        </div>
</form>
                </div>
            </div>
        </div>
    </div>
</section>