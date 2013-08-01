<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>FURNITURE CHINA 2013 - 第十九届中国国际家具展览会</title>
    <link href="css/cn_step.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<p>提交的数据:</p>
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
		//get PostalCode（获取邮编）
		if(!empty($_POST['txtFax'])){
			$txtFax = $_POST['txtFax'];
			//get Fax（获取电话号）
		}
	}
	echo "您好".$txtLastName.$txtFirstName.$selTitle.$txtCompany;
	echo "<br/>";
	echo "国家/地区：".$radCountry;
	echo "<br/>";
	echo "省份：".$selProvince;
	echo "<br/>";
	echo "城市：".$txtCity;
	echo "<br/>";
	echo "地址：".$txtAddress;
	echo "<br/>";
	echo "邮编：".$txtPostalCode;
	echo "<br/>";
	echo "区号：".$txtTelArea;
	echo "<br/>";
	echo "区号：".$txtFax;
?>
</form>
</body>
</html>