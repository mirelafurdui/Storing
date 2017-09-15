<!-- <div id="top_menu_button" class="menu_button" onclick="ShowTopMenu()">
	<span></span>
	<span></span>
	<span></span>
</div> -->
<ul id="top_menu" class="menu_top">
	<li class="{SEL_PRODUCT_HOME}">
		<a href="{SITE_URL}/product/home">Store</a>
	</li>
	<li class="{SEL_PRODUCT_ABOUT}">
		<a href="{SITE_URL}/product/about">About</a> 
	</li> 
	<!-- BEGIN top_menu_not_logged -->
	<li class="{SEL_USER_LOGIN}">
		<a href="{SITE_URL}/user/login">Log In</a>
	</li>
	<li class="{SEL_USER_REGISTER}">
		<a href="{SITE_URL}/user/register">Register</a>
	</li>
	<!-- END top_menu_not_logged -->
	<!-- BEGIN top_menu_logged -->
	<li class="{SEL_USER_ACCOUNT}">
		<a href="{SITE_URL}/user/account">Account {USERNAME}</a>
	</li>
	<li class="{SEL_CART_SHOWCART}">
		<a href="{SITE_URL}/cart/showCart"><span style="margin-right:10px;" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Cart <span class="cartNumerator">{CARTSUM}</span></a>
	</li>
	<li>
		<a href="{SITE_URL}/user/logout">Log Out</a>
	</li>
	<!-- END top_menu_logged -->
</ul>
