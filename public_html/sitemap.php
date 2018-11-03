<?php
//header('Content-type: application/xml');
include "_CORE/index.php";
include("app/config/config.php");
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include("app/config/route.php");
  
$xmlString = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$xmlString .= '<urlset   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
                        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" 
                        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
//echo $xmlString;
$xmlString.='<url>';
$xmlString.='
  <loc>'.$root.'</loc>
  <changefreq>daily</changefreq>
  <priority>1</priority>
';
$query = $db->selectpostcat("hien_thi='1'","order by postcat_lang.postcat_id desc");
while($row = $db->fetch($query)){   
    $date = date("Y-m-d");
    $xmlString.= '
        <loc>'.$root."/".$row['slug'].'/</loc>';
    if($row['hinh']!=''){
    $xmlString.= '    <image:image>
            <image:loc>'.$root."/uploads/".$row['dir'].$row['hinh'].'</image:loc>
        </image:image>';
    }
    $xmlString.= '    <lastmod>'. $date .'</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
';}

$query = $db->selectpost("hien_thi='1'","order by post_lang.post_id desc");
while($row = $db->fetch($query)){
    $date = date("Y-m-d");
    $xmlString.= '
        <loc>'.$root."/".$row['slug'].'</loc>';
    if($row['hinh']!='no'){
    $xmlString.= '    <image:image>
            <image:loc>'.$root."/uploads/".$row['dir'].$row['hinh'].'</image:loc>
        </image:image>';
    }
    $xmlString.= '    <lastmod>'. $date .'</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    ';}
    $xmlString .= '</url></urlset>';
?>


<?
$dom = new DOMDocument;
$dom->preserveWhiteSpace = FALSE;
$dom->loadXML($xmlString);

//Save XML as a file
$dom->save('xml/sitemap.xml');

//View XML document
$dom->formatOutput = TRUE;
echo $dom->saveXml();
echo "</br></br>Cập nhật thành công!";
?>

<!--
loc: url trang web
lastmod: ngày cập nhật theo thứ tự: Năm,tháng,ngày
monthly: mức độ cập nhật thường xuyên của web theo tháng. Có thể thay bằng daily,hour,weekly
priority: mức độ ưu tiên. Mức ưu tiên này được xếp từ 0-1 trong đó 0 là nhỏ nhất và 1 lớn lớn nhất. 
-->