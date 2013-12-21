<?php
class GetData extends CI_Controller {
	
	public function index()
	{
	$debug = $this->input->get("debug");
	$postStr = file_get_contents('static/js/data/zhihu_movie.js');
	$postStr = strip_tags($postStr);
	//$postStr = file_get_contents('http://localhost/yuyanfei/static/js/item.js');
	$res = json_decode($postStr,true);
	$result = array();
	foreach ($res as $key => $item) {
		$it = array();
		$it["title"] = $item["title"];
		$content = $item["item-content"];
		$contArray = array();
		foreach ($content as $key => $cont) {
			$cnt = array();
			if(strlen($cont)>50){
				//echo mb_substr($cont,0,50);
				$cnt["sun"] =  mb_substr($cont,0,50).".....";
			}
			else{
				$cnt["sun"] = $cont;
			}
			$cnt["detail"] = $cont;
			array_push($contArray,$cnt);
		}
		$it["content"] =  json_encode($contArray);
		array_push($result,$it);
	}
	if($debug == "ttt"){
		header("Content-type:application/json");
		//echo(json_encode($res));
		echo(json_encode($result));
		exit;
	}
	$this->smarty->assign("list",$result);
	$this->smarty->display("page.tpl");
	}
}