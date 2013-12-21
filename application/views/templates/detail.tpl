<!DOCTYPE HTML>
<html>
<head>
    <title>{$result.kw}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width",height="device-height" name="viewport" />
    <link rel="stylesheet" href="http://s0.qhimg.com/static/518151ee68172c98.css"/>
	<style type="text/css">
        .clearfix:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }
		#wrapper {
			width:500px;
			margin:0 auto;
			overflow:hidden;
		}
		#wrapper ul{
			width:2100000px;
		}
		#wrapper ul li{
			float:left;
			width:500px;
		}
		#wrapper ul li img{
			width:100%;
		}
    </style>
</head>
<body>
<div id="doc">
    <div id="hd">
    </div>
    <div id="bd">
        <div class="content">
			<div id="wrapper">
				<ul class="clearfix pic-list">
				{foreach $result.data as $item}
					<li><img src="{$item.bigurl}"></li>
				{/foreach}
				</ul>
			</div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/static/js/iscroll.js"></script>
<script type="text/javascript">
function loaded() {
	myScroll = new iScroll('wrapper', {
		snap: true,
		momentum: false,
		hScrollbar: false,
		onScrollEnd: function (data) {
			alert(this.currPageX);
		}
	 });
}
 window.addEventListener("load",loaded,false);
</script>
</body>
</html>
