
<?php 
define('YSPAY', true);
require(dirname(__FILE__) . '/includes/init.php');
if(!empty($_POST['submit'])){
		if(!empty($_POST['selTitle']))
		{
			$selTitle = $_POST['selTitle'];
			//get seltitle（获取称呼）
		}else{
			$selTitle = null;
		}
		if(!empty($_POST['txtLastName'])){
			$txtLastName = $_POST['txtLastName'];
			//$txtLastName = iconv("gb2312","utf-8",$txtLastName);
			//get lastname （获取姓）
		}else{
			$txtLastName = null;
		}
		if(!empty($_POST['txtFirstName'])){
			$txtFirstName = $_POST['txtFirstName'];
			//get FirstName (获取名)
		}else{
			$txtFirstName = null;
		}
		if(!empty($_POST['txtJob'])){
			$txtJob = $_POST['txtJob'];
			//get job name（获取职称）
		}else{
			$txtJob = null;
		}
		if(!empty($_POST['txtCompany'])){
			$txtCompany = $_POST['txtCompany'];
			//$txtCompany = iconv("gb2312","utf-8",$txtCompany);
			//get txCompany (获取公司名)
		}else{
			$txtCompany = null;
		}
		if(!empty($_POST['radCountry'])){
			$radCountry = $_POST['radCountry'];
			//get Country (获取地区)
			if($radCountry == "中国"){
				if(!empty($_POST['selProvince'])){
					$selProvince = $_POST['selProvince'];
					//get province（获取省份）
					}else{
				$selProvince = null;
		}
				if(!empty($_POST['txtCity'])){
					$txtCity = $_POST['txtCity'];
					//get city(获取城市)
				}else{
					$txtCity = null;
				}
			}
		}else{
			$radCountry = null;
			$selProvince = null;
			$txtCity = null;
		}
		if(!empty($_POST['txtAddress'])){
			$txtAddress = $_POST['txtAddress'];
			//get address（获取地址）
		}else{
			$txtAddress = null;
		}
		if(!empty($_POST['txtPostalCode'])){
			$txtPostalCode = $_POST['txtPostalCode'];
			//get PostalCode（获取邮编）
		}else{
			$txtPostalCode = '';
		}
		if(!empty($_POST['txtTelArea'])){
			$txtTelArea = $_POST['txtTelArea'];
			//get tel area（获取电话区号）
		}else{
			$txtTelArea = '';
		}
		if(!empty($_POST['txtTel'])){
			$txtTel = $_POST['txtTel'];
			//get tel（获取电话号）
		}else{
			$txtTel = '0';
		}
		
		if(!empty($_POST['txtFaxArea'])){
			$txtFaxArea = $_POST['txtFaxArea'];
			//get fax area（获取传真区号）
		}else{
			$txtFaxArea = NULL;
		}
		if(!empty($_POST['txtFax'])){
			$txtFax = $_POST['txtFax'];
			//get fax (获取传真)
		}else{
			$txtFax = '0';
		}
		if(!empty($_POST['txtMobile'])){
			$txtMobile = $_POST['txtMobile'];
			//get mobile（获取手机号）
		}else{
			$txtMobile = '0';
		}
		if(!empty($_POST['txtConfirmEmail'])){
			$txtConfirmEmail = $_POST['txtConfirmEmail'];
			//get email （获取邮箱）
		}else{
			$txtConfirmEmail = null;
		}
		if(!empty($_POST['txtIM'])){
			$txtIM = $_POST['txtIM'];
			//get QQ (获取QQ号)
		}else{
			$txtIM = '0';
		}
		if(!empty($_POST['txtWebsite'])){
			$txtWebsite = $_POST['txtWebsite'];
			//get websit（获取公司网址）
		}else{
			$txtWebsite = null;
		}
		if(!empty($_POST['chkQuestion1'])){
			$chkQuestion1 = $_POST['chkQuestion1'];
			//get profession（获取业务性质）
		}else{
			$chkQuestion1 = null;
		}
		if(!empty($_POST['e'])){
			$chkQuestion2 = $_POST['else'].$_POST['aofls'].$_POST['le'].$_POST['ledin'].$_POST['dleasl'].$_POST['easl'].$_POST['ofice'].$_POST['aael'].$_POST['others'];
			//get objective (获取用户参展目的)
		}else{
			$chkQuestion2 = null;	}
		if(!empty($_POST['chkQuestion3'])){
			$chkQuestion3 = $_POST['chkQuestion3'];
			//get interest （获取用户感兴趣产品）
		}else{
			$chkQuestion3 = null;
		}
		if(!empty($_POST['chkQuestion4'])){
			$chkQuestion4 = $_POST['chkQuestion4'];
			//get road （获取用户了解途径）
		}else{
			$chkQuestion4 = null;
		}
		if(!empty($_POST['txtLanguage'])){
			$txtLanguage = $_POST['txtLanguage'];
		}
		if(!empty($_POST['user_source'])){
			$user_source = $_POST['user_source'];
		}else{
			$user_source = '0';
		}

		if(!empty($_POST['txtLastName'])){
				if(!empty($_POST['txtConfirmEmail'])){
					require "includes/write_mysql.php";
					if(isset($_COOKIE['user_id'])){
						$x = $_COOKIE['user_id'];
						/*
						$user_news['name'] = $_COOKIE['user_name'];
						$user_news['email'] = $_COOKIE['email'];
						$user_news['mobile'] = $_COOKIE['mobile'];
						$user_news['selTitle'] = $_COOKIE['selTitle'];
						$user_news['txtLanguage'] = $_COOKIE['txtLanguage'];
						
						if($user_news['txtLanguage']=='en'){
							echo '<script type="text/javascript">alert("You have successfully submitted this information!")</script>';	
					}else{
						//require_once('../woyaocanguan/zaixianyudengji/default_en.html');
						*/
						//$user_array = find_rigister_news($x);
						header('Location: templates/default.html?id='.$x.'');
						//echo '<script type="text/javascript">alert("您已经成功提交过该信息！")</script>';
					
					}else{
						$x = wirte_in_mysql($selTitle,$txtLastName,$txtFirstName,$txtJob,$txtCompany,$radCountry,$selProvince,$txtCity,$txtAddress,$txtPostalCode,$txtTelArea,$txtTel,$txtFaxArea,$txtFax,$txtMobile,$txtConfirmEmail,$txtIM,$txtWebsite,$chkQuestion1,$chkQuestion2,$chkQuestion3,$chkQuestion4,$user_source);
						if($x){
							//echo $user_source;
							
							/*
							$user_id = $x;
							$user_news = array();
							$user_news['name'] = $txtLastName;
							$user_news['id'] = $user_id;
							$user_news['company'] = $txtCompany;
							$user_news['mobile'] = $txtMobile;
							$user_news['email'] = $txtConfirmEmail;
							$user_news['tel'] = $txtTel;
							$user_news['selTitle'] = $selTitle;
							$user_news['txtLanguage'] = $txtLanguage;
							$user_news['id'] = mktime();
							*/
							setcookie("user_id",$x,time()+100);
							/*
							setcookie("user_name",$user_news['name'],time()+10);
							setcookie("email",$user_news['email'],time()+10);
							setcookie("mobile",$user_news['mobile'],time()+10);
							setcookie("selTitle",$user_news['selTitle'],time()+10);
							setcookie("txtLanguage",$user_news['txtLanguage'],time()+10);
							*/
							if($txtLanguage=="ch"){
								header('Location: templates/default.php?id='.$x.'');
							}elseif($txtLanguage=="en"){
								require_once('../woyaocanguan/zaixianyudengji/default_en.html');
							}else{
								header('Location: index.html');
								exit();
							}
							echo '<script type="text/javascript">alert("提交成功！")</script>';
						}
					}
				}else{
					echo '<script type="text/javascript">alert("没有填写邮箱！");window.location.href="index.html";</script>';
			
				}
			}else{
				echo '<script type="text/javascript">alert("没有填写姓名");window.location.href="index.html";</script>';
			}
	}else{
			//echo '<script type="text/javascript">alert("提交失败")</script>';
			//require "includes/write_mysql.php";
			//wirte_in_mysql($selTitle,$txtLastName,$txtFirstName,$txtJob,$txtCompany,$radCountry,$selProvince,$txtCity,$txtAddress,$txtPostalCode,$txtTelArea,$txtTel,$txtFaxArea,$txtFax,$txtMobile,$txtConfirmEmail,$txtIM,$txtWebsite,$chkQuestion1,$chkQuestion2,$chkQuestion3,$chkQuestion4);
			require_once('templates/default_submit.html');
		}
?>