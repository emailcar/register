<?php include '../template/i_header.php';?>
<body>
	<div id="header">
		<h1>欢迎使用韵贵科技登记记人员管理系统</h1>
	</div><!--end header tag-->
	<div id="content">
		<div id="h_cont">
			<h3>
				所有登记人员信息
				总数：<?php 
				require "mysql.php";
				echo $number;?>
			</h3>
			<div id="new_batch">
				<form action="#" method="post">
					批量操作
					<select>
						<option></option>
						<option name="select_delete">删除</option>
						<option name="c_call">标记</option>
						<option name="c_call">取消标记</option>
					</select>
					<input type="submit" class="button" value="确认">
				</form>
			</div>
			<!--
				<div id="new_delete_a" class="new_delete"><a href="#">删除</a></div>
			-->
		</div><!--end _h_cont tag-->
		<div id="query_news" >
			<form action="#" method="post">
				<label>客户名：<input type="text" name="news_name"></label>
				<label>公司名：<input type="text" name="computer_name"></label>
				<label>状态：
					<select>
						<option></option>
						<option>已标记</option>
						<option>未标记</option>
					</select>
				</label>
				<input type="submit" class="button" value="查询">
			</form>
		</div>
		<div id="pag_content">
			<ul>
				<li id="user_news_o" class="user_news">
					<ul>
						<li id="user_news_a">
							<form action="" method="post">
								<input id="check1" type="checkbox" name="all_box">
							</form>
						</li>
						<li id="user_news_b">ID号</li>
						<li id="user_news_c">称谓</li>
						<li id="user_news_d">联系方式</li>
						<li id="user_news_e">公司信息</li>
						<li id="user_news_f">标记状态</li>
					</ul>
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