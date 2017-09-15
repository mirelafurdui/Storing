<hr>
<div id="adminList" class="box-shadow">
<table class="big_table" frame="box" rules="all">
<thead>
	<tr>
		<th style="text-align: center;">Id</th>
		<th style="text-align: center;">Name</th>
		<th style="text-align: center;">Stoc</th>
		<th style="text-align: center;">Category</th>
		<th style="text-align: center;">Brand</th>
		<th style="text-align: center;">Date</th>
	</tr>
</thead>
		<td style="text-align: center;">{ID}</td>
		<td style="text-align: center;">{NAME}</td>
		<td style="text-align: center;">{STOC}</td>
		<td style="text-align: center;">{CATEGORYNAME}</td>
		<td style="text-align: center;">{BRANDNAME}</td>
		<td style="text-align: center;">{DATA}</td>	
</table>
</div>
<div style="text-align: center;">
	<table class="big_table" frame="box" rules="all">
		<thead>
			<tr>
				<th style="text-align: center;">Description</th>
			</tr>
		</thead>
			<td style="text-align: center;">{DESCRIPTION}</td>
	</table>	
	<table class="big_table" frame="box" rules="all">
		<thead>
			<tr>
				<th style="text-align: center;">Photo</th>
			</tr>
		</thead>
			<td><img style=" display: block; margin: 0 auto;" src="{SITE_URL}/images/uploads/{IMAGE}" height="300" width="300" ></td>
	</table>
</div>
<hr>
<a style="text-decoration: none;" href="{SITE_URL}/admin/product/list"><h2>Back</h2></a>