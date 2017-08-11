{PAGINATION}
<h2>
	<a href="{SITE_URL}/product/list"> Products </a>/
	<a href="{SITE_URL}/product/show_category"> Category </a>/
	{CATEGORYNAME}
</h2>
<hr>
<!-- BEGIN product_category_list -->
<div style="display: inline; padding-bottom: 10px";>
	<table style="display: inline-block; padding: 20px;">
		<thead>
			<td>
				<a href="{SITE_URL}/product/show/id/{ID}" >
				<img style=" display: block; margin: 0 auto;" 
				src="{SITE_URL}/images/uploads/{IMAGE}" height="150" width="150" >
				</a>
			</td>
		</thead>
		<tr>
			<td>
				<a href="{SITE_URL}/product/show/id/{ID}" ><p style="text-align: center;  margin: 4px;">{NAME}</p></a>
				<p style="text-align: center; margin: 4px; color: red;">{PRICE} Lei</p>
			</td>
		</tr>
	</table>
</div>
<!-- END product_category_list -->
<hr>
{PAGINATION}
	