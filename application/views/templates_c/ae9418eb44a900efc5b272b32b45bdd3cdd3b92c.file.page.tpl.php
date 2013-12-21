<?php /* Smarty version Smarty-3.1.14, created on 2013-12-15 13:15:41
         compiled from "application\views\templates\page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4831529e0531679772-58016488%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae9418eb44a900efc5b272b32b45bdd3cdd3b92c' => 
    array (
      0 => 'application\\views\\templates\\page.tpl',
      1 => 1387105167,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4831529e0531679772-58016488',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_529e05316d7399_38352772',
  'variables' => 
  array (
    'list' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529e05316d7399_38352772')) {function content_529e05316d7399_38352772($_smarty_tpl) {?><!DOCTYPE HTML>
<html>
<head>
    <title>mobile</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width",height="device-height" name="viewport" />
	<link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap-theme.min.css">
</head>
<body>
<ul class="list list-group">
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
	<li class="list-group-item" data ="<?php echo $_smarty_tpl->tpl_vars['item']->value['content'];?>
" ><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</li>
	<?php } ?>
</ul>
<script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
</body><?php }} ?>