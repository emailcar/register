<?php
function wirte_in_mysql($selTitle,$txtLastName,$txtFirstName,$txtJob,$txtCompany,$radCountry,$selProvince,$txtCity,$txtAddress,$txtPostalCode,$txtTelArea,$txtTel,$txtFaxArea,$txtFax,$txtMobile,$txtConfirmEmail,$txtIM,$txtWebsite,$chkQuestion1,$chkQuestion2,$chkQuestion3,$chkQuestion4,$time) {
	require "../data/config.php";
	$dbc = mysql_connect($db_host,$db_user,$db_pass);
	if($dbc){
		echo "lianjie chenggong<br/>";
		mysql_select_db($mysql_list);
		mysql_query("SET NAMES 'gb2312'");
		$query = 'INSERT INTO `'.$db_name.'`.`user_news` (`id`, `user_last_name`, `user_first_name`, `user_tltle`, `user_job`, `user_company`, `user_country`, `user_province`, `user_city`, `user_address`, `user_PostalCode`, `user_tel_area`, `user_tel`, `user_fax_area`, `user_fax`, `user_mobile`, `user_email`, `user_qq`, `user_websit`, `date`, `user_profession`, `user_objective`, `user_interest`, `user_road`) 
		VALUES (NULL,\''.$txtLastName.'\',\''.$txtFirstName.'\',0,\''.$txtJob.'\',\''.$txtCompany.'\',\''.$radCountry.'\',\''.$selProvince.'\',\''.$txtCity.'\',\''.$txtAddress.'\',\''.$txtPostalCode.'\',\''.$txtTelArea.'\',\''.$txtTel.'\',\''.$txtFaxArea.'\',\''.$txtFax.'\',\''.$txtMobile.'\',\''.$txtConfirmEmail.'\',\''.$txtIM.'\',\''.$txtWebsite.'\',\''.$time.'\',\''.$chkQuestion1.'\',\''.$chkQuestion2.'\',\''.$chkQuestion3.'\',\''.$chkQuestion4.'\');';
		echo $query;
		$num = mysql_query('SELECT LAST_INSERT_ID();');
		//$f = mysql_query($query);
		//$f = true;
		if($f){
			return $num;
		}else{
			return false;
		}
		mysql_close($dbc);
	}
}
?>