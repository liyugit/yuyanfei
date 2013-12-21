<?php
class Detail extends CI_Controller {
	
	public function index()
	{
	 $result = array();
	 $nowPic = $this->input->get("pic");
	 $keyword = $this->input->get("kw");
	 $data = file_get_contents("http://soyo.360.cn/pic/index?kw=".$keyword."&start=0&count=10&json=1");
	 $result["pic"] = $nowPic;
	 $result["data"] = json_decode($data,true);
	 $result["kw"] = $keyword;
	 $this->smarty->assign("result",$result);
	 $this->smarty->display('detail.tpl'); 	
	}
	public function getDate(){
	 $start = $this->input->get("start");
	 $start = $start?$start:0;
	 $keyword = $this->input->get("kw");
	 $keyword = $keyword?$keyword:"";
	 $data = file_get_contents("http://soyo.360.cn/pic/index?kw=".$keyword."&start=".$start."&count=10&json=1");
	 echo $data;
	}
}