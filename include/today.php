<?php include '../template/i_header.php';?>
<body>
	<div id="header">
		<h1>欢迎使用韵贵科技登记记人员管理系统</h1>
	</div><!--end header tag-->
	<div id="content">
		<div id="h_cont">
			<h3>今日预登记人员信息<?php 
				require 'common.inc';
				echo "&nbsp&nbsp&nbsp&nbsp今天是：".$time;?>
			</h3>
			<div id="new_delete"><a href="#">删除</a></div>
		</div><!--end _h_cont tag-->
		<?php
		$x = 'today';
		require "function.php";//查询数据库并输出
	?>
	</div>
	<div id="footer"></div>
</body>
</html>