<?php
    $id = $_GET['id'];
    $page = $_GET['page'];
    $func = $_POST['func'];
    $tik = $_POST['tik'];
	
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("post_meta_key","id = '".$tik[$i]."'");
		}
		admin_load("","?act=post_meta_list");
		die();
	}
    
?>
<section class="content-header">
    <h1>list<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Option Field</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">list</h3>
                    <div class="box-tools pull-right">
                        <span class="function">
                            <a href="?act=post_meta_new">Add new</a>
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
                        <form action="?act=post_meta_list" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
                        <input type="hidden" name="func" value="del" />
                        <table  class="table table-striped">
                        <thead>
                        <tr>
                        	<th>#</th>
                        	<th>Name</th>
                            <th>Meta_key</th>
                            <th>Rows</th>
                            <th>Width</th>
                            <th>Deciption</th>
                            <th>Type</th>
                            <th>Post type</th>
                            <th>Edit</th>
                        	<th>Del</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        
                        $r		=	$db->select("post_meta_key","","order by post_type asc,thu_tu asc");
                        while ($row = $db->fetch($r))
                        {
                        	$count++;
                        ?>
                        <tr>
                        	<th><?=$count?></th>
                            <td><?=$row["name"]?></td>
                            <td><?=$row["meta_key"]?></td>
                            <td><?=$row["rows"]?></td>
                            <td><?=$row["width"]?></td>
                            <td><?=$row["chu_thich"]?></td>
                            <td>
                            <?if($row["type"]==1){
                                echo 'Input type="text"';
                            }elseif($row["type"]==2){
                                echo 'Textarea';
                            }elseif($row["type"]==4){
                                echo 'Radio';
                            }else{
                                echo 'Textarea CKEDITOR';
                            }?>
                            </td>
                            <td><?=$row["post_type"]?></td>
                        	<td><a href="?act=post_meta_edit&id=<?=$row["id"]?>">Edit</a></td>
                        	<td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
                        </tr>
                        <?
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                        	<td colspan="9">
                        		<strong>Page ::1:</strong>
                        		
                        	</td>
                        	<td colspan="1"><input type="submit" value="Del" class="btn btn-success" /></td>
                        </tr>
                        </tfoot>
                        </table>
                        </table>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>