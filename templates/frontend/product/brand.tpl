
<link rel="stylesheet" href ="{SITE_URL}/templates/css/frontend/style.css" type="text/css" >

{PAGINATION}
<h2>
	<a href="{SITE_URL}/product/list"> Products </a>/
	Brand
</h2>
<hr>
<!-- BEGIN brand_list -->
<div class="tableBCOuter">
	<div>
		<table class="tableBC">
			<thead>
				<td>
					<a href="{SITE_URL}/product/brand/id/{ID}" >
					<img style=" display: block; margin: 0 auto; border-radius: 20px"
					src="{SITE_URL}/images/brands/{IMAGE}" height="150" width="150" >
					</a>
				</td>
			</thead>
			<tr>
				<td>
					<a href="{SITE_URL}/product/brand/id/{ID}" style="color: black"><p style="text-align: center;  margin: 4px;">{NAME}</p>
					</a>
				</td>
			</tr>
		</table>
	</div>
</div>
<!-- END brand_list -->
<hr>
{PAGINATION}
	