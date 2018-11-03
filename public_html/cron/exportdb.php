<?php
include "../app/config/config.php";
function EXPORT_TABLES($host,$user,$pass,$name,$tables=false, $backup_name=false){
    date_default_timezone_set('Asia/Ho_Chi_Minh');    
    set_time_limit(3000); $mysqli = new mysqli($host,$user,$pass,$name); $mysqli->select_db($name); $mysqli->query("SET NAMES 'utf8'");
    $queryTables = $mysqli->query('SHOW TABLES'); 
    if (!$mysqli->set_charset("utf8")) {
        printf("Error loading character set utf8: %s\n", $mysqli->error);
        exit();
    } else {
        printf("Current character set: %s\n", $mysqli->character_set_name());
    }
    while($row = $queryTables->fetch_row()) { $target_tables[] = $row[0]; }   if($tables !== false) { $target_tables = array_intersect( $target_tables, $tables); }
    $content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `".$name."`\r\n--\r\n\r\n\r\n";
    foreach($target_tables as $table){
        if (empty($table)){ continue; } 
        $result = $mysqli->query('SELECT * FROM `'.$table.'`');     $fields_amount=$result->field_count;  $rows_num=$mysqli->affected_rows;     $res = $mysqli->query('SHOW CREATE TABLE '.$table); $TableMLine=$res->fetch_row(); 
        $content .= "\n\n".$TableMLine[1].";\n\n";
        for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
            while($row = $result->fetch_row())  { //when started (and every after 100 command cycle):
                if ($st_counter%100 == 0 || $st_counter == 0 )  {$content .= "\nINSERT INTO ".$table." VALUES";}
                    $content .= "\n(";    for($j=0; $j<$fields_amount; $j++){ $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); if (isset($row[$j])){$content .= '"'.$row[$j].'"' ;}  else{$content .= '""';}     if ($j<($fields_amount-1)){$content.= ',';}   }        $content .=")";
                //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {$content .= ";";} else {$content .= ",";} $st_counter=$st_counter+1;
            }
        } $content .="\n\n\n";
    }
    $content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
    $backup_name = $backup_name ? $backup_name : $name."_(".date('d-m-Y')."_".date('H-i-s').")__rand".rand(1,11111111).".sql";
    //ob_get_clean(); 
    //header('Content-Type: application/octet-stream');   header("Content-Transfer-Encoding: Binary"); header("Content-disposition: attachment; filename=\"".$backup_name."\"");
    echo $content;
    //save file
	$handle = gzopen($backup_name.'.gz','w');
	gzwrite($handle,$content);
	gzclose($handle);
    
}      //see import.php too
EXPORT_TABLES($host,$dbuser,$dbpass,$csdl);
?>

<?php
//function backup_tables($host,$dbuser,$dbpass,$csdl,$tables = '*')
//{
//	
//	$link = mysql_connect($host,$user,$pass);
//	mysql_select_db($csdl,$link);
//	
//	//get all of the tables
//	if($tables == '*')
//	{
//		$tables = array();
//		$result = mysql_query('SHOW TABLES');
//		while($row = mysql_fetch_row($result))
//		{
//			$tables[] = $row[0];
//		}
//	}
//	else
//	{
//		$tables = is_array($tables) ? $tables : explode(',',$tables);
//	}
//	
//	//cycle through
//	foreach($tables as $table)
//	{
//		$result = mysql_query('SELECT * FROM '.$table);
//		$num_fields = mysql_num_fields($result);
//		
//		$return.= 'DROP TABLE '.$table.';';
//		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
//		$return.= "\n\n".$row2[1].";\n\n";
//		
//		for ($i = 0; $i < $num_fields; $i++) 
//		{
//			while($row = mysql_fetch_row($result))
//			{
//				$return.= 'INSERT INTO '.$table.' VALUES(';
//				for($j=0; $j < $num_fields; $j++) 
//				{
//					$row[$j] = addslashes($row[$j]);
//					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
//					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
//					if ($j < ($num_fields-1)) { $return.= ','; }
//				}
//				$return.= ");\n";
//			}
//		}
//		$return.="\n\n\n";
//	}
//	
//	//save file
//	$handle = fopen('db-backup-'.time().'.sql','w+');
//	fwrite($handle,$return);
//	fclose($handle);
//}

?>
