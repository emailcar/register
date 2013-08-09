<?php include '../template/i_header.php';?>
	<body>
		<div id="header">
			<h1>欢迎使用韵贵科技登记记人员管理系统</h1>
		</div>
		<div id="content">
			<div id="h_cont"><h3>账户管理</h3></div>
			<div id="pag_content">
				<div id="add_staff" class="page_c">
					<p>添加员工</p>
					<form action="#" method="post">
						<p>
							<label>员工姓名：<input type="text" name="staff_name"></label>
						</p>
						<p>
							<label>员工工号：<input type="text" name="staff_number" id="staff_number"></label>
						</p>
						<p>
							<label>初始密码：<input type="text" name="staff_password" id="nstaff_password"></label>
						</p>
						<p>
							<label>
								<input type="submit" name="add_staff_s" value="确认" class="button">
							</label>
						</p>
					</form>
				</div><!--end m_password tag-->
				<div id="m_password" class="page_c">
					<p>修改密码</p>
					<form action="#" method="post">
						<p>
							<label>当前密码：<input type="password" name="old_password"></label>
						</p>
						<p>
							<label>新密码：<input type="password" name="new_password_a" id="new_password_a"></label>
						</p>
						<p>
							<label>确认密码：<input type="password" name="new_password_b" id="new_password_b"></label>
						</p>
						<p>
							<label>
								<input type="submit" name="m_password_s" value="确认" class="button">
							</label>
						</p>
					</form>
				</div><!--end m_password tag-->
				
			</div><!--end pag_content tag-->
		</div>
		<div id="footer">
		</div>
	</body>
	</html>