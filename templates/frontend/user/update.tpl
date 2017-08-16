<form action="{SITE_URL}/user/account/" method="post">
<input type="hidden" name="userToken" value="{USERTOKEN}">
	<ul class="form">
		<li class="clearfix">
			<label>Image:</label>
			<img src="{SITE_URL}/images/user_image/{IMAGE}" width="200" height="200">
		</li>
		<li class="clearfix">
			<label>Username:</label>
			<strong>{USERNAME}</strong>
		</li>
		<li class="clearfix">
			<label for="password">Password:</label>
			<input type="password" name="password" value="{PASSWORD}" id="password" />
		</li>
		<li class="clearfix">
			<label for="password2">Re-type Password:</label>
			<input type="password" name="password2" value="{PASSWORD}" id="password2" />
		</li>
		<li class="clearfix">
			<label for="email">Email:</label>
			<input id="email" type="text" name="email" value="{EMAIL}" />
		</li>
		<li class="clearfix">
			<label for="firstName">First Name:</label>
			<input type="text" name="firstName" value="{FIRSTNAME}" id="firstName" />
		</li>
		<li class="clearfix">
			<label for="lastName">Last Name:</label>
			<input type="text" name="lastName" value="{LASTNAME}" id="lastName" />
		</li>
		<li class="clearfix">
			<label for="lastName">City:</label>
			<input type="text" name="city" value="{CITY}" id="city" />
		</li>
		<li class="clearfix">
			<label for="lastName">Address:</label>
			<input type="text" name="address" value="{ADDRESS}" id="address" />
		</li>
		<li class="clearfix">
			<label class="empty">&nbsp;</label>
			<input type="submit" class="button" value="Update your Account data" />
		</li>
	</ul>
</form>