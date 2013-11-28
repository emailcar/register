<?php
define('YSPAY', true);
if(isset($_REQUEST['mailid'])){
$mailid=$_REQUEST['mailid'];
update_email_open($mailid,1);
}
header("Content-type:image/jpeg");
$img=imagecreatefromjpeg("paypal.jpg");
imagejpeg($img);
imagedestroy($img);

/**
 * 根据邮件id更改邮件的打开状态
 *
 * @param $id  邮件ID
 *
 * @return array 
 */
function update_email_open($id,$open)
{
	$db_host = "localhost:3306";// database host
	$db_name = "marryys";// database name
	$db_user = "root";// database username
	$db_pass = 'MYCQ@jl2$ajkl23';// database password
	 $db = mysql_connect($db_host, $db_user, $db_pass);                        
     mysql_select_db($db_name,$db); 
	 $sql = "update `ys_email` set open='$open' where id='$id'";
	 mysql_query($sql,$db);
}

?>
