<span style="color: #ff0000;">{ERROR}</span>

<!-- <form action="{SITE_URL}/user/authorize" method="post" >
	<ul class="form">
		<li class="clearfix">
			<label for="username">Username:</label>
			<input id="username" type="text" value="{USERNAME}" name="username">
		</li>
		<li class="clearfix">
			<label for="password">Password:</label>
			<input id="password" type="password" value="{PASSWORD}" name="password">
		</li>
		<li class="clearfix">
			<label class="empty">&nbsp;</label>
			<input type="submit" onclick="" class="button" value="Log In">
		</li>
		<li class="clearfix">
			<label class="empty">&nbsp;</label>
			<a href="{SITE_URL}/user/forgot-password" style="font-size:smaller">Password Recovery</a>
		</li>
	</ul>
</form> -->
<div style="width: 60%; text-align: center; margin: auto;">
	<form action="{SITE_URL}/user/authorize" method="post">
		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" id="uLogin" placeholder="Login" name="username">
				<label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
			</div>
		</div> <!-- /.form-group -->

		<div class="form-group">
			<div class="input-group">
				<input type="password" class="form-control" id="uPassword" placeholder="Password"  name="password">
				<label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
			</div> <!-- /.input-group -->
		</div> <!-- /.form-group -->

		<label class="empty">&nbsp;</label>
		<a href="{SITE_URL}/user/forgot-password" style="font-size:smaller">Password Recovery</a>
		<label class="empty">&nbsp;</label>
		<input type="submit" onclick="" class="form-control btn btn-primary" value="Log In">
	</form>
</div>
