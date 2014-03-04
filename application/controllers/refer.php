<?php
class Refer extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$string = file_get_contents("http://shouyou.360.cn/detail?id=bcgXZ1QzSyivQx&src=img&debug=shouyou");
		$debug = $this->input->get("debug");
		$res = json_decode($string,true);
		$iosIndex = array("2","3");
		$platInfo = $res["platInfo"];
		$androidIndex = "1";
		$refer = $_SERVER['HTTP_REFERER'];
		$result = array();
		//echo $refer;
		if($refer){
			$urlParam = parse_url($refer);
			$path = $urlParam["path"];
			if($path && $path == "/game/web"){
				foreach ($platInfo as $key => $value) {
					if(in_array($key,$iosIndex)){
						$result[$key] = $value;
						continue;
					}
					$android = $value;
				}
				$result[$androidIndex] = $android;
				$platInfo = $result;
			}
			
		}
		if($debug == "ttt"){
			header("Content-type:application/json");
			//echo(json_encode($res));
			echo(json_encode($platInfo));
			exit;
		}
	}
}