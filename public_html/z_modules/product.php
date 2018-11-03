<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="718" id="AutoNumber12">
  <?
	include("inc/connect_db.php");
	if (isset($_GET['page'])){
		if (isset($_GET['id'])){
			if (isset($_GET['id1'])){
				$c1 = $_GET['id1'];
			}else{
				$c1 = $_GET['id'];
		}
		}else{
			$c1 = $_GET['page'];
		}
	}
	else
		$c1 = 2;
	$sqlcontent1 = "select ".$m." from menu where menuID = ".$c1;
	//echo $sqlcontent;
	$rscontent1 = mysql_query($sqlcontent1);
	$rowcontent1 = mysql_fetch_array($rscontent1);
?>
  <tr>
    <td width="517" height="22" align="center"><font color="#BCD3EC" style="text-transform:uppercase"> <b>
      <?=$rowcontent1[1]?>
      </b></font></td>
    <td width="1" height="22" align="center"></td>
    <? if (isset($_GET['page'])) echo '<td width="200" height="22" align="center"><font color="#BCD3EC"><b>'.chucnangbotro.'</b></font></td>';
		 	else echo '<td width="200" height="22" align="center"><font color="#BCD3EC"><b>'.news.'</b></font></td>';
		 ?>
  </tr>
  <tr>
    <td width="517"><img border="0" src="<?=$image?>/line1.gif" width="500" height="1"></td>
    <td width="1"></td>
    <td width="200"><img border="0" src="<?=$image?>/line2.gif" width="195" height="1"></td>
  </tr>
  <tr>
    <td width="517" valign="top"><table border="0" cellpadding="4" cellspacing="0" style="border-collapse: collapse" width="90%" id="AutoNumber14" align="center">
        <tr>
          <td width="100%" colspan="2" height="30"><? if (($_GET['id'] == 16) || (!isset($_GET['id']))) {
					  		echo maintitle;
						}else {
							echo maintitle1;
						} 
						?></td>
        </tr>
        <tr>
          <?	
						if (!isset($_GET['id'])){
							$_GET['id']=16;
						}
						$sqlmain = "select ".$m1." from products where menuID=".$_GET['id'];
						$rsmain = mysql_query($sqlmain);
						//echo $sqlmain;
						$i =0;
						while ($rowmain = mysql_fetch_array($rsmain)){
							$i++;
							if ($_GET['id'] == 16){
					?>
          <td width="50%" align="center"><table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td width="100%" align="center"><a href="/<?=$lang?>/2/16/product/<?=$rowmain[0]?>.html"><img border="0" src="<?=$rowmain[3]?>" width="220" height="120"></a></td>
              </tr>
              <tr>
                <td width="50%" align="center"><a href="/<?=$lang?>/2/16/product/<?=$rowmain[0]?>.html"><b>
                  <?=$rowmain[1]?>
                  </b></a></td>
              </tr>
            </table></td>
          <?
						if ($i >= 2) {
							echo "</tr><tr>";
							$i=0;
						}
						else
							echo "";
					}
					else {
						?>
          <td width="30%" align="center"><table width="100%" cellpadding="0" cellspacing="0" style="border: 1px solid #6a8db3" height="150">
              <tr>
                <td width="100%" align="center" onMouseOver="showtrail('<?=$rowmain[3]?>','<h2><?=$pname_mosthot?></h2>','',400,200)" onMouseOut="hidetrail()"><img border="0" src="<?=$rowmain[3]?>"></td>
              </tr>
              <tr>
                <td width="50%" align="center" bgcolor="#404F64" height="20"><?=$rowmain[1]?>
                  </b></a></td>
              </tr>
            </table></td>
          <?
						if ($i >=3) {
							echo "</tr><tr>";
							$i=0;
						}
						else
							echo "";
					}
					}
				?>
        </tr>
      </table>
    <td width="1" bgcolor="#2C3646" valign="top"></td>
    <td width="200" valign="top"><?
		include ("newsindex.php");
  ?>
    </td>
  </tr>
  <tr>
    <td width="517">&nbsp;</td>
    <td width="1"></td>
    <td width="200">&nbsp;</td>
  </tr>
</table>
