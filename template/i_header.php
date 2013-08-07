<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html">
        <meta charset="utf-8">
		<title>欢迎使用登记人员管理系统</title>
		<link rel="stylesheet" type="text/css" href="../css/index.css"/>
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>
        <script src="js/url.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
		        $("input[name='all_box']").click(function(){
		            if($("input[name='all_box']").attr("checked")){
		                //全选
		            $("input[name='box']").each(function(){
		                $(this).attr("checked",true)
		            })
		        }else{
		            //取消全选
		            $("input[name='box']").each(function(){
		                $(this).attr("checked",false)
		            })
		        }
		        })
		    })
		</script>
	</head>