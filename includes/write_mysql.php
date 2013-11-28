<?php

function wirte_in_mysql($selTitle,$txtLastName,$txtFirstName,$txtJob,$txtCompany,$radCountry,$selProvince,$txtCity,$txtAddress,$txtPostalCode,$txtTelArea,$txtTel,$txtFaxArea,$txtFax,$txtMobile,$txtConfirmEmail,$txtIM,$txtWebsite,$chkQuestion1,$chkQuestion2,$chkQuestion3,$chkQuestion4,$user_source){
	require "data/config.php";
	$dbc = mysql_connect($db_host,$db_user,$db_pass);
	if($dbc){
		//echo "连接成功";
		mysql_select_db($mysql_list);
		mysql_query("SET NAMES 'utf8'");
		$query = 'INSERT INTO `'.$db_name.'`.`user_news` (`id`, `user_last_name`, `user_first_name`, `user_tltle`, `user_job`, `user_company`, `user_country`, `user_province`, `user_city`, `user_address`, `user_PostalCode`, `user_tel_area`, `user_tel`, `user_fax_area`, `user_fax`, `user_mobile`, `user_email`, `user_qq`, `user_websit`, `date`, `user_profession`, `user_objective`, `user_interest`, `user_road`, `user_source`) 
		VALUES (NULL,\''.$txtLastName.'\',\''.$txtFirstName.'\',0,\''.$txtJob.'\',\''.$txtCompany.'\',\''.$radCountry.'\',\''.$selProvince.'\',\''.$txtCity.'\',\''.$txtAddress.'\',\''.$txtPostalCode.'\',\''.$txtTelArea.'\',\''.$txtTel.'\',\''.$txtFaxArea.'\',\''.$txtFax.'\',\''.$txtMobile.'\',\''.$txtConfirmEmail.'\',\''.$txtIM.'\',\''.$txtWebsite.'\',CURRENT_TIMESTAMP,\''.$chkQuestion1.'\',\''.$chkQuestion2.'\',\''.$chkQuestion3.'\',\''.$chkQuestion4.'\',\''.$user_source.'\');';
		//echo $query;
		
		$f = mysql_query($query);
		$num = mysql_insert_id();
		if($f){
			return $num;
		}else{
			//echo '<script type="text/javascript">alert("提交失败");window.location.href="default.php?textcookie=";</script>';
		}
		mysql_close($dbc);
		
	}
}
?>