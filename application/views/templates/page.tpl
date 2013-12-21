<!DOCTYPE HTML>
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
	{foreach $list as $item}
	<li class="list-group-item" data ="{$item.content}" >{$item.title}</li>
	{/foreach}
</ul>
<div class="detail-page" style="display:none">
</div>
<script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>

</body>