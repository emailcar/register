<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>FURNITURE CHINA 2013 - 第十九届中国国际家具展览会</title>
    <link href="css/cn_step.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
    	
    </script>
</head>
<body>
<form action="b.php" method="post">
	 <table cellpadding="0" cellspacing="0" style="width:99%; padding-top:15px; line-height:31px;">
                	    <tr>
                            <td class="red">*</td>
                            <td colspan="2">
                                称呼：
                                <select style="width:155px; margin-left:30px;" class="select" type="select" name="selTitle" require="true" message="请选择您的称呼！">
                                    <option value="先生">先生</option>
                                    <option value="小姐">小姐</option>
                                    <option value="女士">女士</option>
                                </select>
                                <span class="red" style="padding:0px 10px 0px 10px;">*</span>姓：<input type="text" style="width:150px;" maxlength="5" class="textbox" name="txtLastName" require="true" message="请输入您的姓！|请至少输入1位或以上的中文姓名。" />
                                <span class="red" style="padding:0px 10px 0px 10px;">*</span>名：<input type="text" style="width:150px;"  name="txtFirstName" class="textbox" require="true" message="请输入您的名！|请至少输入1位或以上的中文名字。" />
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15px;" class="red">*</td>
                            <td style="width:70px;">职位：</td>
                            <td><input type="text" style="width:350px;" class="textbox" name="txtJob" require="true" regex="/^[\u4E00-\u9FA5 a-zA-Z,.()｛｝]{2,}$/" message="请输入您的职位名称！|请至少输入2位或以上的英文字母、中文的职位名称。" /></td>
                        </tr>
                        <tr>
                            <td class="red">*</td>
                            <td>公司：</td>
                            <td><input type="text" style="width:350px;" class="textbox" name="txtCompany" require="true" message="请输入您的公司名称！|请至少输入2位或以上的英文字母、中文的公司名称。" /></td>
                        </tr>
                        <tr>
                            <td class="red">*</td>
                            <td>国家/地区：</td>
                            <td>
                                <span><input type="radio" name="radCountry" id="radCountry1" require="true" message="请选择您所在的国家/地区！" value="中国" /><label for="radCountry1">中国</label></span>
                                <span style="padding-left:5px;"><input type="radio" name="radCountry" id="radCountry2" value="香港" /><label for="radCountry2">香港</label></span>
                                <span style="padding-left:5px;"><input type="radio" name="radCountry" id="radCountry3" value="澳门" /><label for="radCountry3">澳门</label></span>
                                <span style="padding-left:5px;"><input type="radio" name="radCountry" id="radCountry4" value="台湾" /><label for="radCountry4">台湾</label></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="red">*</td>
                            <td>地址：</td>
                            <td><input type="text" class="textbox" name="txtAddress" require="true" message="请输入您的地址！|请至少输入10位或以上字符的联系地址。" style="width:350px;" /></td>
                        </tr>
                        <tr>
                            <td class="red">*</td>
                            <td>邮编：</td>
                            <td>
                                <input type="text" class="textbox" require="true" maxlength="10" name="txtPostalCode" message="请输入您所在地址的邮政编码！|请至少输入4位或以上的数字邮政编码。" style="width:350px;" />
                                （请填写精确到街道/村的邮编）
                            </td>
                        </tr>
                        <td>
                                <span><select style="width:180px;" class="select" type="select" require="true" name="selProvince" message="请选择您所在的省份名称！"><option value=""></option><option value="Anhui/安徽">Anhui/安徽</option><option value="Beijing/北京">Beijing/北京</option><option value="Chongqing/重庆">Chongqing/重庆</option><option value="Fujian/福建">Fujian/福建</option><option value="Gansu/甘肃">Gansu/甘肃</option><option value="Guangdong/广东">Guangdong/广东</option><option value="Guangxi/广西">Guangxi/广西</option><option value="Guizhou/贵州">Guizhou/贵州</option><option value="Hainan/海南">Hainan/海南</option><option value="Hebei/河北">Hebei/河北</option><option value="Heilongjiang/黑龙江">Heilongjiang/黑龙江</option><option value="Henan/河南">Henan/河南</option><option value="Hubei/湖北">Hubei/湖北</option><option value="Hunan/湖南">Hunan/湖南</option><option value="Jiangsu/江苏">Jiangsu/江苏</option><option value="Jiangxi/江西">Jiangxi/江西</option><option value="Jilin/吉林">Jilin/吉林</option><option value="Liaoning/辽宁">Liaoning/辽宁</option><option value="Neimenggu/内蒙古">Neimenggu/内蒙古</option><option value="Ningxia/宁夏">Ningxia/宁夏</option><option value="Qinghai/青海">Qinghai/青海</option><option value="Shaanxi/陕西">Shaanxi/陕西</option><option value="Shandong/山东">Shandong/山东</option><option value="Shanghai/上海">Shanghai/上海</option><option value="Shanxi/山西">Shanxi/山西</option><option value="Sichuan/四川">Sichuan/四川</option><option value="Tianjin/天津">Tianjin/天津</option><option value="Tibet/西藏">Tibet/西藏</option><option value="Xinjiang/新疆">Xinjiang/新疆</option><option value="Yunnan/云南">Yunnan/云南</option><option value="Yunnan/云南">Yunnan/云南</option><option value="Zhejiang/浙江">Zhejiang/浙江</option></select></span>
                                <span class="red" style="padding:0px 10px 0px 10px;">*</span> 城市：<input style="width:180px;" regex="/^[\u4E00-\u9FA5]{2,}$/" name="txtCity" class="textbox" type="text" require="true" message="请选择您所在的城市名称！|请至少输入2位或以上的中文城市名称。">
                            </td>
                            
                        </table>
<input type="submit" value="Submit" />
</form>
</body>
</html>