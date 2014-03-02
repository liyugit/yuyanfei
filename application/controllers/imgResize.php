<?php
class ImgResize extends CI_Controller {
	private function my_image_resize($src_file, $dst_file, $dst_width=32, $dst_height=32){ 
		if($dst_width <1 || $dst_height <1) { 
			echo "params width or height error !"; 
			exit(); 
		} 
		if(!file_exists($src_file)) { 
			echo $src_file . " is not exists !"; 
			exit(); 
		} 
		$type=exif_imagetype($src_file); 
		$support_type=array(IMAGETYPE_JPEG , IMAGETYPE_PNG , IMAGETYPE_GIF); 
		if(!in_array($type, $support_type,true)) { 
			echo "this type of image does not support! only support jpg , gif or png"; 
			exit(); 
		} 
		switch($type) { 
			case IMAGETYPE_JPEG : 
			$src_img=imagecreatefromjpeg($src_file); 
			break; 
			case IMAGETYPE_PNG : 
			$src_img=imagecreatefrompng($src_file); 
			break; 
			case IMAGETYPE_GIF : 
			$src_img=imagecreatefromgif($src_file); 
			break; 
			default: 
			echo "Load image error!"; 
			exit(); 
		}
		$src_w=imagesx($src_img); 
		$src_h=imagesy($src_img); 
		$ratio_w=1.0 * $dst_width/$src_w; 
		$ratio_h=1.0 * $dst_height/$src_h; 
		if ($src_w<=$dst_width && $src_h<=$dst_height) { 
			$x = ($dst_width-$src_w)/2; 
			$y = ($dst_height-$src_h)/2; 
			$new_img=imagecreatetruecolor($dst_width,$dst_height); 
			imagecopy($new_img,$src_img,$x,$y,0,0,$dst_width,$dst_height); 
			switch($type) { 
				case IMAGETYPE_JPEG : 
				imagejpeg($new_img,$dst_file,100); 
				break; 
				case IMAGETYPE_PNG : 
				imagepng($new_img,$dst_file); 
				break; 
				case IMAGETYPE_GIF : 
				imagegif($new_img,$dst_file); 
				break; 
				default: 
				break; 
			} 
		} 
		else { 
			$dstwh = $dst_width/$dst_height; 
			$srcwh = $src_w/$src_h; 
			if ($ratio_w <= $ratio_h) { 
				$zoom_w = $dst_width; 
				$zoom_h = $zoom_w*($src_h/$src_w); 
				} else { 
				$zoom_h = $dst_height; 
				$zoom_w = $zoom_h*($src_w/$src_h); 
			} 
			$zoom_img=imagecreatetruecolor($zoom_w, $zoom_h); 
			imagecopyresampled($zoom_img,$src_img,0,0,0,0,$zoom_w,$zoom_h,$src_w,$src_h); 
			$new_img=imagecreatetruecolor($dst_width,$dst_height); 
			$x = ($dst_width-$zoom_w)/2; 
			$y = ($dst_height-$zoom_h)/2+1; 
			imagecopy($new_img,$zoom_img,$x,$y,0,0,$dst_width,$dst_height); 
			switch($type) { 
				case IMAGETYPE_JPEG : 
				imagejpeg($new_img,$dst_file,100); 
				break; 
				case IMAGETYPE_PNG : 
				imagepng($new_img,$dst_file); 
				break; 
				case IMAGETYPE_GIF : 
				imagegif($new_img,$dst_file); 
				break; 
				default: 
				break; 
			} 
		} 
	} 
	public function index()
	{
		

	}
}