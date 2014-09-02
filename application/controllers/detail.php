<?php
class Detail extends CI_Controller {
	private function toImage(){
	 $result = "";	
	 $src_file = "http://p2.zhimg.com/97/08/9708fc368206bdb52ad85657b5acd054_r.jpg";
	 $type=exif_imagetype($src_file); 
	 $support_type=array(IMAGETYPE_JPEG , IMAGETYPE_PNG , IMAGETYPE_GIF); 
	 if(!in_array($type, $support_type,true)) { 
		echo "this type of image does not support! only support jpg , gif or png"; 
		exit(); 
	 }  
	 // switch($type) { 
		// case IMAGETYPE_JPEG : 
		// $src_img=imagecreatefromjpeg($src_file); 
		// break; 
		// case IMAGETYPE_PNG : 
		// $src_img=imagecreatefrompng($src_file); 
		// break; 
		// case IMAGETYPE_GIF : 
		// $src_img=imagecreatefromgif($src_file); 
		// break; 
		// default: 
		// echo "Load image error!"; 
		// exit(); 
	 // }
	 $src_img=imagecreatefromjpeg($src_file); 
	 //$res = imagecreatefromjpeg('http://p2.zhimg.com/97/08/9708fc368206bdb52ad85657b5acd054_r.jpg');	 
	 // $src_w=imagesx($src_img); 
	 // $src_h=imagesy($src_img); 
	 // $zoom_img=imagecreatetruecolor(1000, 80); 
	 // imagecopyresampled($zoom_img,$src_img,0,0,0,0,1000,80,$src_w,$src_h); 
	 imagejpeg($src_img);
	//  switch($type) { 
	// 	case IMAGETYPE_JPEG : 
	// 	$result = imagejpeg($zoom_img); 
	// 	break; 
	// 	case IMAGETYPE_PNG : 
	// 	$result = imagepng($zoom_img); 
	// 	break; 
	// 	case IMAGETYPE_GIF : 
	// 	$result = imagegif($zoom_img); 
	// 	break; 
	// 	default: 
	// 	break; 
	// } 
	 //return $result;
	}
	public function fetch_image($url) {
	    $curl = curl_init($url); //初始化
	    curl_setopt($curl, CURLOPT_HEADER, FALSE);
	    //将结果输出到一个字符串中，而不是直接输出到浏览器
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	    //最重要的一步，手动指定Referer
	    curl_setopt($curl, CURLOPT_REFERER, 'http://m.so.com');
	    $re = curl_exec($curl); //执行
	    if (curl_errno($curl)) {
	        return NULL;
	    }
	    return $re;
	}
	public function getImages(){
	$this->output->set_header("Content-Type:image/jpeg");
	$src_file = "http://p1.so.qhimg.com/bdr/238__/t01ca8afff4022509fb.jpg";
	//$src_img=imagecreatefromjpeg($src_file); 
	//imagejpeg($src_img);
	echo $this->fetch_image($src_file);
	}
}