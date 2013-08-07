<?php include '../template/i_header.php';?>
	<style type="text/css">
		li {
				list-style: none;
				font-size: 12px;
				padding: 10px 20px;
				border: 1px dotted #A7A7A7;
			}
		</style>
<body>
	<div id="header">
		<h1>欢迎使用韵贵科技登记记人员管理系统</h1>
	</div><!--end header tag-->
	<div id="content">
		<div id="h_cont">
			<h3><?php
					echo "信息ID:";
					echo $_REQUEST['user_id']; ?>
			</h3>
			<div id="new_delete"><a href="#">删除</a></div>
		</div><!--end _h_cont tag-->
<?php
$user_id = $_REQUEST['user_id'];
require "common.inc";
$dbc = $mysql_c;
	if($dbc)
	{
		mysql_select_db($mysql_list);
		$dbc_w = "SELECT * FROM `$mysql_title` where id = '$user_id'";
		$f = mysql_query($dbc_w);
		if($f){
			$number = mysql_num_rows($f);
			for($i=0;$i<$number;$i++){
				$user_news = mysql_fetch_array($f,MYSQL_NUM);
				require "common.inc";
				require "switch.php";
					echo '<ul>
							<li>ID号：'.$id.' </li>
							<li>称呼：'.$user_last_name.$user_first_name.'-'.$user_title.' </li>
							<li>职位：'.$user_job .'</li> 
							<li>公司：'.$user_company.'</li>
							<li>手机号：'.$user_mobile.'</li>
							<li>国家/地区：'.$user_country.'</li>
							<li>地址：'.$user_address.'</li>
							<li>邮编：'.$user_postalcode.'</li>
							<li>电话：'.$user_tel_area.'-'.$user_tel.'</li>
							<li>传真：'.$user_fax_area.'-'.$user_fax.'</li>
							<li>邮箱：'.$user_email.'</li>
							<li>QQ：'.$user_qq.'</li>
							<li>公司网址：<a href="'.$user_websit.'">'.$user_websit.'</a></li>
							<li>业务性质：'.swith_1($user_profession).'</li>
							<li>参观展会的目的：'.swith_2($user_objective).'</li>
							<li>最感兴趣的产品：'.swith_3($user_interest).'</li>
							<li>通过哪种途径得知的中国国际家具展览会：'.swith_4($user_road).'</li>
							';
			}
		}
	}
	else{
		echo "bu neng cha xun";
	}
	mysql_close($dbc);
?>
</div>
</body>
</html>