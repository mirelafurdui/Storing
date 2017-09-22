<!-- <div id="top_menu_button" class="menu_button" onclick="ShowTopMenu()">
	<span></span>
	<span></span>
	<span></span>
</div> -->
<ul id="top_menu" class="menu_top">
	<li class="{SEL_PRODUCT_HOME}">
		<a href="{SITE_URL}/product/home"><i class="glyphicon glyphicon-list"></i>Store</a>
	</li>
	<li class="{SEL_PRODUCT_ABOUT}">
		<a href="{SITE_URL}/product/about"><i class="glyphicon glyphicon-briefcase"></i>About</a>
	</li> 
	<!-- BEGIN top_menu_not_logged -->
	<li class="{SEL_USER_LOGIN}">
		<a href="{SITE_URL}/user/login"><i class="glyphicon glyphicon-log-in"></i>Log In</a>
	</li>
	<li class="{SEL_USER_REGISTER}">
		<a href="{SITE_URL}/user/register"><i class="glyphicon glyphicon-share"></i>Register</a>
	</li>
	<!-- END top_menu_not_logged -->
	<!-- BEGIN top_menu_logged -->
	<li class="{SEL_USER_ACCOUNT}">
		<a href="{SITE_URL}/user/account"><i class="glyphicon glyphicon-user"></i>Account {USERNAME}</a>
	</li>
	<li class="{SEL_CART_SHOW-CART}">
		<a href="{SITE_URL}/cart/show-cart"><span style="margin-right:10px;" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Cart <span class="cartNumerator">{CARTSUM}</span></a>
	</li>
	<li>
		<i class="glyphicon glyphicon-off"></i>
		<a href="{SITE_URL}/user/logout">Log Out</a>
	</li>
	<!-- END top_menu_logged -->
</ul>
