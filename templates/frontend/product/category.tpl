<link rel="stylesheet" href ="{SITE_URL}/templates/css/frontend/style.css" type="text/css" >

{PAGINATION}
<h2>
	<a href="{SITE_URL}/product/list"> Products </a>/
	Category
</h2>
<hr>
<!-- BEGIN category_list -->
<div style="display: inline; padding-bottom: 10px";>
	<table style="display: inline-block; padding: 20px;">
		<thead>
			<td>
				<a href="{SITE_URL}/product/category/id/{ID}" >
				<img style=" display: block; margin: 0 auto;" 
				src="{SITE_URL}/images/category/{IMAGE}" height="150" width="150" >
				</a>
			</td>
		</thead>
		<tr>
			<td>
				<a href="{SITE_URL}/product/category/id/{ID}" ><p style="text-align: center;  margin: 4px;">{NAME}</p></a>
				<!-- <p style="text-align: center; margin: 4px; color: red;">{PRICE} Lei</p> -->
			</td>
		</tr>
	</table>
</div>
<!-- END category_list -->
<hr>
{PAGINATION}
	