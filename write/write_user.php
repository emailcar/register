<?php
include "write_mysql.php";
	$file_name = $_POST['file_name'];
	echo "导入文件名：".$file_name."<br/>";
	$file = fopen($file_name,"r");
	$num = count(fgetcsv($file));
	$row=1;
	date_default_timezone_set("Asia/Shanghai");
	//start time set
		if(!empty($_POST['start_hour'])){
			$start_hour = $_POST['start_hour'];
		}else{
			$start_hour = date("H");
		}
		if(!empty($_POST['start_minute'])){
			$start_minute = $_POST['start_minute'];
		}else{
			$start_minute = date("i");
		}
		if(!empty($_POST['start_second'])){
			$start_second = $_POST['start_second'];
		}else{
			$start_second = date("s");
		}
		if(!empty($_POST['start_year'])){
			$start_year = $_POST['start_year'];
		}else{
			$start_year = date("Y");
		}
		if(!empty($_POST['start_month'])){
			$start_month = $_POST['start_month'];
		}else{
			$start_month = date("m");
		}
		if(!empty($_POST['start_day'])){
			$start_day = $_POST['start_day'];
		}else{
			$start_day = date("d");
		}
	//end time set
		if(!empty($_POST['end_hour'])){
			$end_hour = $_POST['end_hour'];
		}else{
			$end_hour ="0";
		}
		if(!empty($_POST['end_minute'])){
			$end_minute = $_POST['end_minute'];
		}else{
			$end_minute ="0";
		}
		if(!empty($_POST['end_second'])){
			$end_second = $_POST['end_second'];
		}else{
			$end_second ="0";
		}
		if(!empty($_POST['end_year'])){
			$end_year = $_POST['end_year'];
		}else{
			$end_year ="1970";
		}
		if(!empty($_POST['end_month'])){
			$end_month = $_POST['end_month'];
		}else{
			$end_month ="0";
		}
		if(!empty($_POST['end_day'])){
			$end_day = $_POST['end_day'];
		}else{
			$end_day ="0";
		}
		/*
			$start_second = "02";
			$start_year = "2013";
			$start_month = "9";//不能有前导0例如9月你要写成9，而不是09。
			$start_day = "5";//不能有前导0例如5号你要写成5，而不是05。
			//end time set
			$end_hour = "01";
			$end_minute = "02";
			$end_second = "02";
			$end_year = "2013";
			$end_month = "9";//不能有前导0例如9月你要写成9，而不是09。
			$end_day = "8";//不能有前导0例如5号你要写成5，而不是05。
			*/
			$start_time = mktime($start_hour,$start_minute,$start_second,$start_month,$start_day,$start_year);
			$end_time = mktime($end_hour,$end_minute,$end_second,$end_month,$end_day,$end_year);
			echo "您设置的上限时间：".date("Y-m-d H:i:s",$start_time)."<br/>";
			echo "您设置的结束时间：".date("Y-m-d H:i:s",$end_time)."<br/>";
	//$sql = "INSERT INTO `ecshop`.`ecs_comment` (`comment_id`, `comment_type`, `id_value`, `email`, `user_name`, `content`, `comment_rank`, `add_time`, `ip_address`, `status`, `parent_id`, `user_id`) VALUES (NULL, '0', '53', 'iscod@gmial.com', '', '不错', '5', '1378184917', '121.239.244.207', '1', '0', '0')";
	if($num==0){
		echo "没有数据";
		$rand = rand($start,$end);
				while(date("H",$rand)<9){
					$rand = rand($start_time,$end_time);
					}
			$time = date("Y-m-d H:i:s",$rand);
		}else{

	while(!feof($file)){
		$data = fgetcsv($file);
			//print_r($data);
			//for($c=0;$c<$num;$c++){
				//echo $c;
				//$data[$c] = iconv($data[$c]);
				//echo $data[$c].'<br/>';
			//}
		if(!empty($_POST['selTitle']))
		{
			$selTitle = $_POST['selTitle'];
			//get seltitle（获取称呼）
		}else{
			$selTitle = null;
		}
		if(!empty($data['1'])){
			$txtLastName = iconv("gb2312","utf-8",$data['1']);
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
		if(!empty($data['0'])){
			$txtCompany = iconv("gb2312","utf-8",$data['0']);
			//get txCompany (获取公司名)
		}else{
			$txtCompany = iconv("gb2312","utf-8",$data['0']);
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
			$selTitle = null;
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
		if(!empty($data['2'])){
			$txtTel = iconv("gb2312","utf-8",$data['2']);
			//get tel（获取电话号）
		}else{
			$txtTel = '000000';
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
			$txtFax = '000000';
		}
		if(!empty($data['3'])){
			$txtMobile = iconv("gb2312","utf-8",$data['3']);
			//get mobile（获取手机号）
		}else{
			$txtMobile = '000000';
		}
		if(!empty($data['4'])){
			$txtConfirmEmail = iconv("gb2312","utf-8",$data['4']);
			//get email （获取邮箱）
		}else{
			$txtConfirmEmail = null;
		}
		if(!empty($_POST['txtIM'])){
			$txtIM = $_POST['txtIM'];
			//get QQ (获取QQ号)
		}else{
			$txtIM = '000';
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
		if(!empty($_POST['chkQuestion2'])){
			$chkQuestion2 = $_POST['chkQuestion2'];
			//get objective (获取用户参展目的)
		}else{
			$chkQuestion2 = null;
		}
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
			//echo "lastname:".$txtLastName.iconv("gb2312","utf-8",$data['1']).$data['1'];
			//echo "company:".$txtCompany;
			
			$rand = rand($start,$end);
				while(date("H",$rand)<9){
					$rand = rand($start_time,$end_time);
					}
					echo $txtLastName;
			$time = date("Y-m-d H:i:s",$rand);
			echo $time."时间<br/>";
			$x = wirte_in_mysql($selTitle,$txtLastName,$txtFirstName,$txtJob,$txtCompany,$radCountry,$selProvince,$txtCity,$txtAddress,$txtPostalCode,$txtTelArea,$txtTel,$txtFaxArea,$txtFax,$txtMobile,$txtConfirmEmail,$txtIM,$txtWebsite,$chkQuestion1,$chkQuestion2,$chkQuestion3,$chkQuestion4,$time);
			//$sql = "INSERT INTO  `user_news` (`id`, `user_last_name`, `id_value`, `email`, `user_name`, `content`, `comment_rank`, `add_time`, `ip_address`, `status`, `parent_id`, `user_id`) VALUES (NULL, '0', '$id_value', 'iscod@gmial.com', '$username', '$content', '5', '1378184917', '121.239.244.207', '1', '0', '0');";
			//$query = 'INSERT INTO `user_news` (`id`, `user_last_name`, `user_first_name`, `user_tltle`, `user_job`, `user_company`, `user_country`, `user_province`, `user_city`, `user_address`, `user_PostalCode`, `user_tel_area`, `user_tel`, `user_fax_area`, `user_fax`, `user_mobile`, `user_email`, `user_qq`, `user_websit`, `date`, `user_profession`, `user_objective`, `user_interest`, `user_road`) 
			//echo $sql;
			//$x = get_one($query);
			if($x){
				echo "第".$row."行,执行成功！<br/>";
			}else{
				echo "第".$row."行,执行错误！<br/>";
			}

			$row++;
			/*
			if($row%30=='0'){
				echo "<br/><br/><br/><br/>sql语句<br/><br/><br/>";
				$sql = $sql.";";
				echo $sql;
				$sql = "INSERT INTO `ecshop`.`ecs_comment` (`comment_id`, `comment_type`, `id_value`, `email`, `user_name`, `content`, `comment_rank`, `add_time`, `ip_address`, `status`, `parent_id`, `user_id`) VALUES (NULL, '0', '53', 'iscod@gmial.com', '', '不错', '5', '1378184917', '121.239.244.207', '1', '0', '0')";
			}
			*/
		}

	}
	

//echo "<br/><br/><br/><br/>sql语句<br/><br/><br/>";
//echo $sql;
fclose($file);
//$sql = "INSERT INTO `ecshop`.`ecs_comment` (`comment_id`, `comment_type`, `id_value`, `email`, `user_name`, `content`, `comment_rank`, `add_time`, `ip_address`, `status`, `parent_id`, `user_id`) VALUES (NULL, '0', '57', 'dieke1573@gmial.com', '', '不错', '5', '1378184917', '121.239.244.207', '1', '0', '0');"
//include_once("templates/to_comment.html");
