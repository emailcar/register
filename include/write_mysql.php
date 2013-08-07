<?php

function wirte_in_mysql($selTitle,$txtLastName,$txtFirstName,$txtJob,$txtCompany,$radCountry,$selProvince,$txtCity,$txtAddress,$txtPostalCode,$txtTelArea,$txtTel,$txtFaxArea,$txtFax,$txtMobile,$txtConfirmEmail,$txtIM,$txtWebsite,$chkQuestion1,$chkQuestion2,$chkQuestion3,$chkQuestion4) {
	require "common.inc";
	$dbc = $mysql_c;
	if($dbc){
		//echo "连接成功";
		mysql_select_db($mysql_list);
		$query = 'INSERT INTO `'.$mysql_list.'`.`user_news` (`id`, `user_last_name`, `user_first_name`, `user_tltle`, `user_job`, `user_company`, `user_country`, `user_province`, `user_city`, `user_address`, `user_PostalCode`, `user_tel_area`, `user_tel`, `user_fax_area`, `user_fax`, `user_mobile`, `user_email`, `user_qq`, `user_websit`, `data`, `user_profession`, `user_objective`, `user_interest`, `user_road`) 
		VALUES (NULL,\''.$txtLastName.'\',\''.$txtFirstName.'\',\''.$selTitle.'\',\''.$txtJob.'\',\''.$txtCompany.'\',\''.$radCountry.'\',\''.$selProvince.'\',\''.$txtCity.'\',\''.$txtAddress.'\',\''.$txtPostalCode.'\',\''.$txtTelArea.'\',\''.$txtTel.'\',\''.$txtFaxArea.'\',\''.$txtFax.'\',\''.$txtMobile.'\',\''.$txtConfirmEmail.'\',\''.$txtIM.'\',\''.$txtWebsite.'\',CURRENT_TIMESTAMP,\''.$chkQuestion1.'\',\''.$chkQuestion2.'\',\''.$chkQuestion3.'\',\''.$chkQuestion4.'\');';
		//echo $query;
		$f = mysql_query($query);
		if($f){
			//echo "添加成功";
		}
	}
	mysql_close($dbc);
}

?>