<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9">
	<title>{PAGE_TITLE}</title>
	<link rel="icon" href="{SITE_URL}/images/favicon.png">
	<!-- <link rel="apple-touch-icon" href="{SITE_URL}/images/apple-touch-icon.png"> -->
	<meta name="keywords" content="{PAGE_KEYWORDS}" >
	<meta name="description" content="{PAGE_DESCRIPTION}" >
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="canonical" href="{CANONICAL_URL}" >
	<link rel="stylesheet" href="{TEMPLATES_URL}/css/frontend/style.css" type="text/css" >
	<link rel="stylesheet" href="{SITE_URL}/externals/fonts/stylesheet.css" type="text/css" >	
	<script src="{SITE_URL}/externals/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="{TEMPLATES_URL}/js/frontend/main.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!--[if lt IE 9]>
	<script src="{TEMPLATES_URL}/js/frontend/html5shim.js"></script>
	<![endif]-->
</head>
<body>
	<div id="wrapper">
		<header  style="background-image: url({SITE_URL}/images/frontend/menu.jpg);">
			<div id="header-content" class="clearfix">
				<a href="{SITE_URL}/"><img class="logoMenu" src="{SITE_URL}/images/favicon.png"></a>
				<div id="logo">
					<h1 class="logoTitle">
						<a href="{SITE_URL}/">{SITE_NAME}</a>
					</h1>
				</div>
				{MENU_TOP}
			</div>
		</header>
		<div id="body">
			<!-- <nav id="sidebar">
				{MENU_SIDEBAR}
			</nav> -->
				<h1>{PAGE_CONTENT_TITLE}</h1>
				{MESSAGE_BLOCK}
				{MAIN_CONTENT}
			<div class="clear"></div>
		</div>
		<div id="push"></div>
	</div>
	<footer>
		<div class="debugger">
			{DEBUGGER}
		</div>
	</footer>
</body>
</html>