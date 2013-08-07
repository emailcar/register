<?php   setcookie('$user_name',$_POST['login_name'],time()+3600);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html">
        <meta charset="utf-8">
        <title>登陆</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <style type="text/css">
        body {
        	margin: 0 auto;
        }
        input {
        	margin: 10px 0px 10px 20px;
        }
        </style>
        <script src="js/query_password.js"></script>
    </head>
<body>
<div id="header">
    <h1>登记人员后台管理系统</h1>
</div><!--end header tag-->
<div id="content">
	<div id="left">
		<div id="login_c">
		<?php 
		if (isset($_POST['wp_submit']))
		{
			if((!empty($_POST['login_name']))&&(!empty($_POST['login_password'])))
			{	

				$user_name = $_POST['login_name'];
				$user_pass = $_POST['login_password'];
				
				include ('include/common.inc');
				$dbc = $mysql_c;
				if($dbc)
					{
						/*检测数据库使用print '成功连接到数据库'.$user_name.$user_pass.'<br/>';*/
						mysql_select_db($mysql_list);
						$query = "SELECT * FROM admin WHERE admin_name = '$user_name' AND admin_password = md5('$user_pass')";
						/*print '语句执行正常'.$query.'<br/>';检测数据使用*/
							if($r = mysql_query($query))
							{	
								$x = mysql_query($query,$dbc);
								/*
								$ = print_r(mysql_fetch_array($x));//print_r()将查询结果以数组形式输入（前提是查询成功）
								*/
								$row = mysql_fetch_array($x);
								$id = $row['0'];
								/*检测数据使用
								print '数据查询正常'.$.'<br/>';
								*/
								//session_start();
								//$_SESSION['user_admin'] = array($_POST['login_name'],$_POST['login_password'],$id);
										if($id)
											{		session_start();
													$_SESSION['user_admin'] = array($id,$_POST['login_name'],$_POST['login_password']);
													header('location:admin.php');
													exit();
											}else
											{
												print '您的用户名或密码错误，请在试一遍';
											}

							}else {
									print '用户名不存在';
								}
							mysql_close();
						
					}else
					{
						 print '连接失败';
					}
				}else
					{
					print '请您同时填写用户名与密码';
				}
		}else
		{
			print  '
					<form name="logoinform"  id="loginform" action="login.php" method="post" onsubmit="return login_user()">
						<p>
							<label for="user_login">
								用户名：<br/>
								<input type="text" name="login_name" id="user_login" class="input" value size="20">
							</label>
						</p>
						<p>
							<label for="user_pass">
								密码：<br/>
								<input type="password" name="login_password" id="user_password" class="input" value size="20">
							</label>
						</p>
						<p>
							<input type="submit" name="wp_submit" id="wp_submit" class="button" value="登陆">
							<input type="hidden" name="textcookie" id="wp_user_id" class="button" value='.$id.'>
						</p>
					</form>';
				}
		?>
	</div><!--end login_c tag-->
	</div><!--end left tag-->
	<?php include('footer.php'); ?>