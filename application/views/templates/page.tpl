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
<ul  id="aticleList" class="list list-group">
	{foreach $list as $item}
	<li class="list-group-item" data ='{$item.content}'>{$item.title}</li>
	{/foreach}
</ul>
<div class="detail-page" style="display:none">
	<ul id="commentList" class="list list-group">
		<li class="list-group-item"><h1>标题</h1></li>
		<li class="list-group-item">得得得</li>
		<li class="list-group-item">对方的所发生的</li>
	</ul>
</div>
<div class="comment-page" id="commentPage" style="display:none">
	<div class="jumbotron">
  		<div class="container">
  		<h1>标题</h1>	
    	<p>随碟附送发生的身份的所得税大风随碟附送发生的身份的所得税大风随碟附送发生的身份的所得税大风随碟附送发生的身份的所得税大风随碟附送发生的身份的所得税大风</p>
  		</div>
	</div>
</div>
<script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
	(function(){
		var aticleList = $("#aticleList"),
			aticleLists = aticleList.find("li"),
			commentList = $("#commentList"),
			detailPage = $(".detail-page");	
		aticleLists.each(function(i,item){
			var me = $(this);
			me.click(function(e){
				var data = jQuery.parseJSON(me.attr("data")),
				result = [],
				title = me.html();
				result.push('<li class="list-group-item"><h1>' + title + '</h1></li>');
				$(data).each(function(i,d){
					result.push('<li class="list-group-item comment" title="' + title + '" des="' + d.detail  + '">' + d.sun + '</li>');
				});
				commentList.html(result.join(""));
				detailPage.show();
			});
		});	

	})();
</script>
</body>