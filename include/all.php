<?php include '../template/i_header.php';?>
<body>
	<div id="header">
		<h1>欢迎使用韵贵科技登记记人员管理系统</h1>
	</div><!--end header tag-->
	<div id="content">
		<div id="h_cont">
			<h3>
				所有登陆人员信息
				总数：<?php 
				require "mysql.php";
				echo $number;?>
			</h3>
			<div id="new_delete"><a href="#">删除</a></div>
		</div><!--end _h_cont tag-->
		<div id="pag_content">
			<ul>
				<li class="user_news">
					<form action="" method="post">
						<input id="check1" type="checkbox" name="all_box">全选
						<input type="text">
					</form>
				</li>

				<?php
				$x = 'all'; 
				require 'function.php';?>
			</ul>
		</div><!--end page_content tag-->
	</div>
	<div id="footer">
	</div>
</body>