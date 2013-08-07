<?php
	function query_user_news($print_number,$x){
		require "common.inc";
		$dbc = $mysql_c;

			if($dbc)
			{
				mysql_select_db($mysql_list);
				if($print_number!=0){
					$print_number_up = $print_number*10 - $quire_number+1;
					$print_number_down = $print_number*10;
						if($x=='all'){
						$dbc_w = 'SELECT * FROM '.$mysql_title.' ORDER BY  `data` DESC LIMIT '.$print_number_up.','.$quire_number.'';
					}else{
						$dbc_w = 'SELECT * FROM `'.$mysql_title.'`  WHERE date(data)=\''.$time.'\' ORDER BY  `data` DESC LIMIT '.$print_number_up.','.$quire_number.'';

					}
				}else{
					if($x=="all"){
						$dbc_w = 'SELECT * FROM '.$mysql_title.' ORDER BY  `data` DESC LIMIT 0,'.$quire_number.'';
					}else {
						$dbc_w = 'SELECT * FROM `'.$mysql_title.'`  WHERE date(data)=\''.$time.'\' ORDER BY  `data` DESC LIMIT 0,10';
					}
				}
				$f = mysql_query($dbc_w);
				if($x=="all"){
						$dbc_n = 'SELECT * FROM '.$mysql_title.' ORDER BY  `data`';
					}else{
						$dbc_n = 'SELECT * FROM `'.$mysql_title.'`  WHERE date(data)=\''.$time.'\' ORDER BY  `data`';
					}
					/*
					echo "$dbc_w";
					echo "$dbc_n";
					echo $x.'这是x';
					//测试数据库查询函数
					*/
				$n = mysql_query($dbc_n);
				$number = mysql_num_rows($n);
				if($f){
					$number_a = mysql_num_rows($f);
					for($i=0;$i<$number_a;$i++){
						$user_news = mysql_fetch_array($f,MYSQL_NUM);
						require 'common.inc';
							echo '<li id="user_news_'.$id.'" class="user_news" value="'.$id.'">';
								echo '<a href="user_news.php?user_id='.$id.'">';
									echo '<p><input type="checkbox" value="1" name="box"/>';
										echo '&nbspID号：'.$id.' 称呼：'.$user_last_name.$user_first_name.'-'.$user_title.' 职位：'.$user_job .' 手机号：'.$user_mobile.'';
									echo '<p style="margin: 0px 0 0 25px;"> 公司：'.$user_company.' 电话：'.$user_tel_area.'-'.$user_tel.' 电子邮件：'.$user_email = $user_news['16'].' </p>';
							echo '</a></li>';
					}
				}
				if($print_number==''){
					$print_number=1;
				}
				$page_number = ($number - $number%$quire_number)/$quire_number +1;
					$page_number_back_number = $print_number-1;//上一页
					$page_number_up_number = $print_number+1;//下一页
				echo '<div id="page_set">';
					if($page_number_back_number>0&&$page_number_back_number<=$page_number){
						echo '<li>';
							echo '<ul>';
								echo '<li id="page_number_down_numbe" class="back_p_3"><a href="'.$x.'.php?page_number='.$page_number_back_number.'&x='.$x.'">上一页</a></li>';
								echo '<li id="page_number_down_numbe" class="back_p"><a href="'.$x.'.php?page_number='.$page_number_back_number.'&x='.$x.'">'.$page_number_back_number.'页</a></li>';
							echo '</ul>';
						echo '</li>';
					}
					/*
					for($i=1;$i<=$page_number;$i++){
						echo '<li class="back_p"><a href="all.php?page_number='.$i.'">'.$i.'页</a></li>';
					}
					*/
					echo '<li><ul><li id="print_p" class="back_p">'.$print_number.'页</li></ul></li>';
					if($page_number_up_number>0&&$page_number_up_number<=$page_number){
						echo '<li>';
							echo '<ul>';
								echo '<li id="page_number_down_numbe" class="back_p"><a href="'.$x.'.php?page_number='.$page_number_up_number.'&x='.$x.'">'.$page_number_up_number.'页</a></li>';
								echo '<li class="back_p_3" id="page_number_up_number"><a href="'.$x.'.php?page_number='.$page_number_up_number.'&x='.$x.'">下一页</a></li>';
							echo '</ul>';
						echo '</li>';
					}
					echo '<li>';
						echo '<ul>';
							echo '<li class="back_p" id="back_p_i"><form action=""method="post">转到&nbsp<input type="text" name="page_post">&nbsp页</form></li>';
							echo '<li class="back_p_4">总页数：'.$page_number.'</li>';
						echo '</ul>';
					echo '</li>';
				echo "</div><!--end page_set tag-->";
			}
			else{
				echo "数据库查询失败！！！";
			}
			mysql_close($dbc);

		
	}
		if($x){
		}else{
			$x = $_REQUEST['x'];
		}
		if(!empty($_POST['page_post'])){
			$quire_number = $_POST['page_post'];
		}else{
			$quire_number = $_REQUEST['page_number'];
		}
		query_user_news($quire_number,$x);
?>