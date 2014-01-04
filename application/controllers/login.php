<?php
class Login extends CI_Controller {
	
	public function index()
	{
	$debug = $this->input->get("debug");
	$input = $this->input;
	if($debug == "ttt"){
		header("Content-type:application/json");
		//echo(json_encode($res));
		echo(json_encode($input));
		exit;
	}
	//$this->smarty->assign("list",$result);
	$this->smarty->display("login.tpl");
	}
	public function loginAct(){
		//$input = $this->input->post;
		$debug = $this->input->get("debug");
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		//header("Content-type:application/json");
		//echo(json_encode($input));
		
		setcookie("login", "ok");
		echo $username;
		echo $password;
		exit;
	}
}