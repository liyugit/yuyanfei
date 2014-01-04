<!DOCTYPE HTML>
<html>
<head>
    <title>mobile</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width",height="device-height" name="viewport" />
	<link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap-theme.min.css">
	<style type="text/css">
	.comment-page,
	.detail-page{
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		background: #fff;
	}
	.detail-page{
		z-index: 10;
	}
	.comment-page{
		z-index: 11;
	}
	.btn-primary{
		position: absolute;
		right: 10px;
		top: 0;
		z-index: 14;
	}
	</style>
</head>
<body>
<ul  id="aticleList" class="list list-group">
	{foreach $list as $item}
	<li class="list-group-item" title-str="{$item.title}">{$item.title}<span class="data" style="display:none">{$item.content}</span></li>
	{/foreach}
</ul>
<div class="detail-page" style="display:none">
	<button type="button" class="btn btn-primary">返回</button>
	<ul id="commentList" class="list list-group">
		<li class="list-group-item"><h1>标题</h1></li>
		<li class="list-group-item comment">得得得</li>
		<li class="list-group-item">对方的所发生的</li>
	</ul>
</div>
<div class="comment-page" id="commentPage" style="display:none">
	<button type="button" class="btn btn-primary">返回</button>
	<div class="jumbotron">
  		<div class="container">
  		<h1>标题</h1>	
    	<p id="comment">随碟附送发生的身份的所得税大风随碟附送发生的身份的所得税大风随碟附送发生的身份的所得税大风随碟附送发生的身份的所得税大风随碟附送发生的身份的所得税大风</p>
  		</div>
	</div>
</div>
<div id="debug">
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
				var data = jQuery.parseJSON(me.find(".data").html()),
				result = [],
				title = me.attr("title-str");
				result.push('<li class="list-group-item"><h1>' + title + '</h1></li>');
				$(data).each(function(i,d){
					result.push('<li class="list-group-item comment" title-str="' + title + '" des="' + d.detail  + '">' + d.sun + '</li>');
				});
				commentList.html(result.join(""));
				detailPage.show();
			});
		});	
		$("#commentList").delegate(".comment","click",function(e){
			var commentPage = $("#commentPage"),
				comment = $("#comment"),
				commentTitle = commentPage.find("h1"),
				me = $(this);
			commentTitle.html(me.attr("title-str"));
			comment.html(me.attr("des"));
			commentPage.show();
		});
		$("body").delegate(".btn-primary","click",function(e){
			var parent = this.parentNode;
			$(parent).hide();
		})
	})();
</script>
</body>