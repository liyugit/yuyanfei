<!DOCTYPE HTML>
<html>
<head>
    <title>mobile</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width",height="device-height" name="viewport" />
	<link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap-theme.min.css">
	<style type="text/css">

	body,html{
		height: 100%;
	}
	body{
		padding-top: 40px;
	}
	.comment-page,
	.detail-page{
		position: absolute;
		left: 0;
		top: 40px;
		width: 100%;
		min-height: 100%;
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
		top: 6px;
		z-index: 14;
	}
	.jumbotron{
		font-size: 14px;
		padding: 0;
		background: none;
		background-color: none;
	}
	
	.jumbotron .title{
		font-size: 16px;
		padding: 17px 0;
		padding-right: 54px;
	}
	.title{
		padding: 5px 0;
		margin: 0;
		font-size: 16px;
		padding-right: 54px;
		font-weight: bold;
	}
	.toggle-expand{
		display: none;
	}
	#nav{
		background: #428BCA;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		z-index: 100;
	}
	#nav a{
		color: #fff;
	}
	#nav a:hover{
		background: #0D77E4;
	}
	#nav .active a{
		background: #0D77E4;
	}
	</style>
</head>
<body>
<ul id="nav" class="nav nav-pills">
  <li class="{if $type == 1}active{/if}">
    <a href="?type=1">电影</a>
  </li>
  <li class="{if $type == 2}active{/if}"><a href="?type=2">足球</a></li>
  <li class="{if $type == 3}active{/if}"><a href="?type=3">电子商务</a></li>
  <li class="{if $type == 4}active{/if}"><a href="?type=4">投资</a></li>
  <li class="{if $type == 5}active{/if}"><a href="?type=5">个人情感</a></li>
  <li></li>
</ul>
<ul  id="aticleList" class="list aticle-list list-group">
	{foreach $list as $item}
	<li class="list-group-item" title-str="{$item.title}">{$item.title}
		<textarea class="data" style="display:none">{$item.content}</textarea>
	</li>
	{/foreach}
</ul>
<div class="detail-page" style="display:none">
	<button type="button" class="btn btn-primary" page="aticle-list">返回</button>
	<ul id="commentList" class="list list-group">
		<li class="list-group-item"><h1 class="title">标题</h1></li>
		<li class="list-group-item comment"></li>
		<li class="list-group-item"></li>
	</ul>
</div>
<div class="comment-page" id="commentPage" style="display:none">
	<button type="button" class="btn btn-primary" page="detail-page">返回</button>
	<div class="jumbotron">
  		<div class="container">
  		<h1 class="title"></h1>	
    	<p id="comment"></p>
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
				var data = jQuery.parseJSON(me.find(".data").val()),
				result = [],
				title = me.attr("title-str");
				result.push('<li class="list-group-item"><h1 class="title">' + title + '</h1></li>');
				$(data).each(function(i,d){
					result.push('<li class="list-group-item comment" title-str="' + title + '">');
					result.push('<textarea style="display:none">' + d.detail + '</textarea>');
					result.push(d.sun + '</li>');
				});
				commentList.html(result.join(""));
				detailPage.show();
				document.body.scrollTop = 0;
				//document.documentElement.scrollTop = 0;
				aticleList.hide();
			});
		});	
		$("#commentList").delegate(".comment","click",function(e){
			var commentPage = $("#commentPage"),
				comment = $("#comment"),
				commentTitle = commentPage.find("h1"),
				me = $(this);
			commentTitle.html(me.attr("title-str"));
			comment.html(me.find("textarea").val());
			document.body.scrollTop = 0;
			detailPage.hide();
			commentPage.show();
		});
		$("body").delegate(".btn-primary","click",function(e){
			var parent = this.parentNode;
			$(parent).hide();
			$("."+$(this).attr("page")).show();
		})
	})();
</script>
</body>