<script>
	var SITE_URL = '{SITE_URL}';
</script>
<script type="text/javascript" src="{TEMPLATES_URL}/js/frontend/user.js"></script>
<div class="message_error" style="display:none" id="msgError"></div>
<br/>
<div style="width: 60%; text-align: center; margin: auto;">
	 <form id="userRegister"  method="post" enctype='multipart/form-data'>
		<div class="form-group">
			<div class="input-group">
				<input id="username" class="form-control" type="text"  value="{USERNAME}" name="username" placeholder="Add Username">
				<label for="username" class="input-group-addon glyphicon glyphicon-user"></label>
			</div>
		</div>

		<div class="form-group">
			<div class="input-group">
				<input type="password" class="form-control" name="password" value="{PASSWORD}" id="password" placeholder="Add Password"/>
				<label for="password" class="input-group-addon glyphicon glyphicon-lock"></label>
			</div>
		</div>

		<div class="form-group">
			<div class="input-group">
				<input type="password" class="form-control" name="password2" value="{PASSWORD}" id="password2" placeholder="Add Password Again"/>
				<label for="password2" class="input-group-addon glyphicon glyphicon-lock"></label>
			</div>
		</div>

		<div class="form-group">
			<div class="input-group">
				<input id="email" class="form-control" type="text" name="email" value="{EMAIL}" placeholder="Add Email"/>
				<label for="email" class="input-group-addon glyphicon glyphicon-envelope"></label>
			</div>
		</div>

		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" name="firstName" value="{FIRSTNAME}" id="firstName" placeholder="Add First Name"/>
				<label for="firstName" class="input-group-addon glyphicon glyphicon-list"></label>
			</div>
		</div>

		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" name="lastName" value="{LASTNAME}" id="lastName" placeholder="Add Last Name"/>
				<label for="lastName" class="input-group-addon glyphicon glyphicon-list"></label>
			</div>
		</div>

		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" name="city" value="{CITY}" id="city" placeholder="Add City"/>
				<label for="city" class="input-group-addon glyphicon glyphicon-bookmark"></label>
			</div>
		</div>

		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" name="address" value="{ADDRESS}" id="address"  placeholder="Add Address"/>
				<label for="address" class="input-group-addon glyphicon glyphicon-home"></label>
			</div>
		</div>

		<div class="form-group">
			<div class="input-group">
				<input type="file" name="file_upload" id="file_upload" class="form-control"/>
				<input type="hidden" name="url" value="<?php echo htmlentities($_SERVER['REQUEST_URI'])>"/>
				<label for="address" class="input-group-addon glyphicon glyphicon-picture"></label>
			</div>
		</div>
		<label class="empty">&nbsp;</label>
		<a href="{SITE_URL}/user/forgot-password" style="font-size:smaller">Password Recovery</a>

		<label class="empty">&nbsp;</label>
		<input type="submit"  class="form-control btn btn-primary" value="Register" >

	</form>
</div>

