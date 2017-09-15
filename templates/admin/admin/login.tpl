<style>
	.wrapper #logo {
		display: none;
	}
	.wrapper .content h1{
		display: none;
	}
	.footer {
		border-top: 0px;
	}
	.wrapper .content .container {
		padding-top: 300px;
	}
	a:hover { color: #985f0d; text-decoration: none;}
	a { text-decoration: none; color: #1A2D42; }
</style>

<div class="login_box clearfix">
	<h2>{SITE_NAME}</h2>

	<form action="{SITE_URL}/admin/admin/authorize" method="post" class="login clearfix">
		<div class="text_imputs">
			<input type="text" name="username" class="medium" placeholder="Username...">
			<input type="password" name="password" class="medium" placeholder="Password...">
		</div>
		<input type="submit" class="button" value="Log In">
	</form>
	<h2><a href="https://www.youtube.com/watch?v=kNS4t5UCBfI">"Unlimited power"</a></h2>
</div>