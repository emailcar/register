<?php
	$googleurl = 'https://chart.googleapis.com/chart?cht=qr&chs=200*200';
	//reference    https://developers.google.com/chart/infographics/docs/qr_codes
	//cht=qr is Specifies a QR code.
	//chs=<width>x<height> is img size
	//chl=<data> is data 
	//choe=<output_encoding> is endcode the data in the code 选择二维码中的数据编码
	//chld=<error_correction_level>|<margin> 纠错水平与边界空白
	$cht = 'qr';
	$chs = '200';
	$chl = $code_content;
	$choe = 'UTF-8';
	$chld = 'Q|2';
	$logo = 'images/logo.jpg';
	class MyQrcode{
		public function creta_qr($cht,$chs,$chl,$choe,$chld){
			$qr = 'https://chart.googleapis.com/chart?cht='.$cht.'&chs='.$chs.'x'.$chs.'&chld='.$chld.'&chl='.urlencode($chl).'&choe='.$choe.'';
			//example : https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=Hello%20world&choe=UTF-8
			//echo 'google不带logo<br/><img src="'.$qr.'"><br/>二维码<br/>';
			return $qr;
		}
		public function creta_img($cht,$chs,$chl,$choe,$chld,$logo){
			$logo = imagecreatefromstring(file_get_contents($logo));
			$qr_png = $this->creta_qr($cht,$chs,$chl,$choe,$chld);
			if($qr_png){
				$qr_png = imagecreatefrompng($qr_png);
				$qr_width = imagesx($qr_png);
				$qr_height = imagesy($qr_png);
				$logo_width = imagesx($logo);
				$logo_height = imagesy($logo);
				$logo_create_width = $qr_width/5;//logo create width
				$logo_qr_scale = $logo_width/$logo_create_width;
				$logo_create_height = $logo_height/$logo_qr_scale;//logo create height
				$dst_x = ($qr_width - $logo_create_width)/2;//目标x坐标
				$dst_y = ($qr_height-$logo_create_height)/2;//目标Y坐标
				//echo $qr_png.'>>'.$logo.'>>'.$dst_x.'>>'.$dst_y.'>>'.$qr_width.'>>'.$qr_height.'>>'.$logo_create_width.'>>'.$logo_create_height;
				imagecopyresampled($qr_png,$logo,$dst_x,$dst_x,0,0,$logo_create_width,$logo_create_height,$logo_width,$logo_height);
	            //imagecreatefromstring($qr_png);
	            imagepng($qr_png,'x.png');
	            imagedestroy($qr_png);
	        }
		}
		
	}
	$googleapi = new MyQrcode();
	$height = $googleapi->creta_img($cht,$chs,$chl,$choe,$chld,$logo);
?>
<div><img src="x.png" style="width:<?php echo $chs;?>;height:<?php echo $chs?>;"></img></div>