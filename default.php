<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>FURNITURE CHINA 2013 - 第十九届中国国际家具展览会</title>
    <link href="css/cn_step.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php 
if(!empty($_POST['selTitle']))
	{
		$selTitle = $_POST['selTitle'];
		//get seltitle（获取称呼）
	}
	if(!empty($_POST['txtLastName'])){
		$txtLastName = $_POST['txtLastName'];
		//get lastname （获取姓）
	}
	if(!empty($_POST['txtFirstName'])){
		$txtFirstName = $_POST['txtFirstName'];
		//get FirstName (获取名)
	}
	if(!empty($_POST['txtJob'])){
		$txtJob = $_POST['txtJob'];
		//get job name（获取职称）
	}
	if(!empty($_POST['txtCompany'])){
		$txtCompany = $_POST['txtCompany'];
		//get txCompany (获取公司名)
	}
	if(!empty($_POST['radCountry'])){
		$radCountry = $_POST['radCountry'];
		//get Country (获取地区)
		if($radCountry == "中国"){
			if(!empty($_POST['selProvince'])){
				$selProvince = $_POST['selProvince'];
				//get province（获取省份）
			}
			if(!empty($_POST['txtCity'])){
				$txtCity = $_POST['txtCity'];
				//get city(获取城市)
			}
		}
	}
	if(!empty($_POST['txtAddress'])){
		$txtAddress = $_POST['txtAddress'];
		//get address（获取地址）
	}
	if(!empty($_POST['txtPostalCode'])){
		$txtPostalCode = $_POST['txtPostalCode'];
		//get PostalCode（获取邮编）
	}
	if(!empty($_POST['txtTelArea'])){
		$txtTelArea = $_POST['txtTelArea'];
		//get tel area（获取电话区号）
	}
	if(!empty($_POST['txtTel'])){
		$txtTel = $_POST['txtTel'];
		//get tel（获取电话号）
	}
	
	if(!empty($_POST['txtFaxArea'])){
		$txtFaxArea = $_POST['txtFaxArea'];
		//get fax area（获取传真区号）
	}
	if(!empty($_POST['txtFax'])){
		$txtFax = $_POST['txtFax'];
		//get fax (获取传真)
	}
	if(!empty($_POST['txtMobile'])){
		$txtMobile = $_POST['txtMobile'];
		//get mobile（获取手机号）
	}
	if(!empty($_POST['txtConfirmEmail'])){
		$txtConfirmEmail = $_POST['txtConfirmEmail'];
		//get email （获取邮箱）
	}
	if(!empty($_POST['txtIM'])){
		$txtIM = $_POST['txtIM'];
		//get QQ (获取QQ号)
	}
	if(!empty($_POST['txtWebsite'])){
		$txtWebsite = $_POST['txtWebsite'];
		//get websit（获取公司网址）
	}
	if(!empty($_POST['chkQuestion1'])){
		$chkQuestion1 = $_POST['chkQuestion1'];
		//get profession（获取业务性质）
	}
	if(!empty($_POST['chkQuestion2'])){
		$chkQuestion2 = $_POST['chkQuestion2'];
		//get objective (获取用户参展目的)
	}
	if(!empty($_POST['chkQuestion3'])){
		$chkQuestion3 = $_POST['chkQuestion3'];
		//get interest （获取用户感兴趣产品）
	}
	if(!empty($_POST['chkQuestion4'])){
		$chkQuestion4 = $_POST['chkQuestion4'];
		//get road （获取用户了解途径）
	}
	require "include/write_mysql.php";
	wirte_in_mysql($selTitle,$txtLastName,$txtFirstName,$txtJob,$txtCompany,$radCountry,$selProvince,$txtCity,$txtAddress,$txtPostalCode,$txtTelArea,$txtTel,$txtFaxArea,$txtFax,$txtMobile,$txtConfirmEmail,$txtIM,$txtWebsite,$chkQuestion1,$chkQuestion2,$chkQuestion3,$chkQuestion4);
?>	
</form>
</body>
</html>