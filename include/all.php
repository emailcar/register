<html>
<head>
	<meta http-equiv="Content-Type" content="text/html">
    <meta charset="utf-8">
	<style type="text/css">
		body{
			font-family: "宋体","Times New Roman",Georgia,Serif;
		}
		#header p{
			font-size: 1em;
			font-weight: 700;
			padding-top: 10px;
			color: #690303;
		}
	</style>
</head>
	<body>
<div id="header">
	<p>
			所有登陆人员信息
			总数：<?php 
			require "mysql.php";
			echo $number;?>
	</p>
</div>
<div id="content">
	<div id="header_content">
		<ul>
			<li>某某</li>
			<li>某某</li>
			<li>某某</li>
			<li>某某</li>
			<li>某某</li>
			<li>某某</li>
			<li>某某</li>
			<li>某某</li>
			<li>某某</li>
			<li>某某</li>
			<li>某某</li>
		</ul>
	</div><!--end header_content tag-->
</div><!--end content-->
<?php 
	require "common.inc";
?>
</body>