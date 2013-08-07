<?php
function swith_1($chkQuestion1){
		if($chkQuestion1=="MAN"){
			$chkQuestion1 = '民用家具制造商';
		}elseif($chkQuestion1=='OFM'){
			$chkQuestion1 = '办公家具制造商';
		}elseif($chkQuestion1=='UFM'){
			$chkQuestion1 = '软木家具制造商';
		}elseif($chkQuestion1=='CHF'){
			$chkQuestion1 = '整体橱柜制造商';
		}elseif($chkQuestion1=='TRD'){
			$chkQuestion1 = '代理';
		}elseif($chkQuestion1=='WHO'){
			$chkQuestion1 = '批发商/零售商/分销商';
		}elseif($chkQuestion1=='IEX'){
			$chkQuestion1 = '进出口商';
		}elseif($chkQuestion1=='FML'){
			$chkQuestion1 = '家具商场';
		}elseif($chkQuestion1=='IDG'){
			$chkQuestion1 = '室内设计师';
		}elseif($chkQuestion1=='ARC'){
			$chkQuestion1 = '建筑师';
		}elseif($chkQuestion1=='DDG'){
			$chkQuestion1 = '陈列设计师';
		}elseif($chkQuestion1=='PDG'){
			$chkQuestion1 = '产品设计师';
		}elseif($chkQuestion1=='FMA'){
			$chkQuestion1 = '媒体';
		}elseif($chkQuestion1=='PTY'){
			$chkQuestion1 = '房地产商';
		}elseif($chkQuestion1=='HTL'){
			$chkQuestion1 = '酒店/饭店';
		}elseif($chkQuestion1=='CBH'){
			$chkQuestion1 = '餐饮/酒吧/高档娱乐场所';
		}elseif($chkQuestion1=='STA'){
			$chkQuestion1 = '体育场馆/医院/电影院/学校';
		}elseif($chkQuestion1=='COP'){
			$chkQuestion1 = '公司企业/金融银行';
		}else{
			$chkQuestion1 = $chkQuestion1;
		}
		return $chkQuestion1;
	}
	function swith_2($chkQuestion2){
		if($chkQuestion2=="F-PU"){
			$chkQuestion2 = '采购';
		}elseif($chkQuestion2=='F-GI'){
			$chkQuestion2 = '获取最新行业和产品信息';
		}elseif($chkQuestion2=='F-JV'){
			$chkQuestion2 = '寻找业务代理或合作伙伴';
		}
		elseif($chkQuestion2=='F-NS'){
			$chkQuestion2 = '应展商邀请前来参观其展位';
		}elseif($chkQuestion2=='F-EP'){
			$chkQuestion2 = '考虑下次参展';
		}else{
			$chkQuestion2 = $chkQuestion2;
		}
		return $chkQuestion2;
	}
	function swith_3($chkQuestion3){
		if($chkQuestion3=="FCOF157"){
			$chkQuestion3 = '现代家具';
		}elseif($chkQuestion3=='FUPF152'){
			$chkQuestion3 = '软体家具';
		}elseif($chkQuestion3=='FHTR159'){
			$chkQuestion3 = '餐桌椅';
		}elseif($chkQuestion3=='FOTF153'){
			$chkQuestion3 = '户外休闲家具';
		}elseif($chkQuestion3=='FCSF154'){
			$chkQuestion3 = '欧式古典家具';
		}elseif($chkQuestion3=='FTCF155'){
			$chkQuestion3 = '传统仿古家具';
		}elseif($chkQuestion3=='FCDF156'){
			$chkQuestion3 = '儿童家具';
		}elseif($chkQuestion3=='FIEN998'){
			$chkQuestion3 = '室内装饰';
		}elseif($chkQuestion3=='FDCP157'){
			$chkQuestion3 = '装饰画';
		}elseif($chkQuestion3=='FILE060'){
			$chkQuestion3 = '家具室内灯饰';
		}elseif($chkQuestion3=='FCPT158'){
			$chkQuestion3 = ' 装饰地毯';
		}elseif($chkQuestion3=='FFBD159'){
			$chkQuestion3 = '布艺/床上用品';
		}elseif($chkQuestion3=='FSAP160'){
			$chkQuestion3 = '工艺品';
		}elseif($chkQuestion3=='OFMS01'){
			$chkQuestion3 = ' 办公椅';
		}elseif($chkQuestion3=='OFCS01'){
			$chkQuestion3 = '文件柜';
		}elseif($chkQuestion3=='OFSW01'){
			$chkQuestion3 = '系统办公家具';
		}elseif($chkQuestion3=='OFMT01'){
			$chkQuestion3 = '办公桌';
		}elseif($chkQuestion3=='OFSP01'){
			$chkQuestion3 = '高隔断/屏风';
		}elseif($chkQuestion3=='OFPT01'){
			$chkQuestion3 = '公共座椅';
		}elseif($chkQuestion3=='FKKC010'){
			$chkQuestion3 = '整体橱柜';
		}elseif($chkQuestion3=='FKEA012'){
			$chkQuestion3 = '衣柜';
		}elseif($chkQuestion3=='FKCD010'){
			$chkQuestion3 = '浴柜';
		}elseif($chkQuestion3=='FKCD013'){
			$chkQuestion3 = '橱柜门板及材料';
		}elseif($chkQuestion3=='FKCD014'){
			$chkQuestion3 = '鞋柜';
		}else{
			$chkQuestion3 = $chkQuestion3;
		}
		return $chkQuestion3;
	}
	function swith_4($chkQuestion4){
		if($chkQuestion4=="Organizer"){
			$chkQuestion4 = '主办方的邀请或宣传品';
		}elseif($chkQuestion4=='Exhibitor'){
			$chkQuestion4 = '展商的邀请';
		}elseif($chkQuestion4=='Website'){
			$chkQuestion4 = '网络';
		}elseif($chkQuestion4=='Friend'){
			$chkQuestion4 = '朋友推荐';
		}elseif($chkQuestion4=='Advertisement'){
			$chkQuestion4 = '报纸或杂志上的展会广告';
		}elseif($chkQuestion4=='Visited'){
			$chkQuestion4 = '之前曾经参观过';
		}elseif($chkQuestion4=='Exhibited'){
			$chkQuestion4 = '之前曾经参展过';
		}else{
			$chkQuestion4 = $chkQuestion4;
		}
		return $chkQuestion4;
	}
	?>