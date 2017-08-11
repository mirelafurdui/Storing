<style>
	.info{
		margin:20px auto;
		background-color:#EEF2F5;
		padding:15px;
		line-height:25px;

		-moz-border-radius: 12px;
		-webkit-border-radius: 12px;
		border-radius: 12px;
		-moz-background-clip: padding; -webkit-background-clip: padding-box; background-clip: padding-box; 
	}
	#documentation{
		float:left;
		width:47%;
		word-wrap: break-word;
	}
	#download{
		float:right;
		width:47%;
		word-wrap: break-word;
	}
</style>
<h2>
	<a href="{SITE_URL}/product/list"> Products </a>/
	<a href="{SITE_URL}/product/category/id/{IDCATEGORY}"> {CATEGORYNAME} </a>/
	<a href="{SITE_URL}/product/brand/id/{IDBRAND}"> {BRANDNAME} </a>/
	{NAME}
</h2>
<hr>
<div>
	<table>
		<thead>
			<div>
				<td>
					<h2 style="display: inline;">{NAME}</h2> &nbsp; <h2 style=" color: red">{PRICE} Lei</h2>
					<img src="{SITE_URL}/images/uploads/{IMAGE}" height="300" width="300" >
				</td>
			</div>
		</thead>
		<tr>
			<td>
				<h2>Description</h2>
				<p style="padding: 20px">{DESCRIPTION}</p>
			</td>
		</tr>
		<tr>
			<div>
				<td>
					<form method="POST">
						<h2 style="display: inline; color: red; font-size: 15px;">Product </h2>
						<input style="display: inline;" type="number" value="1">
						<input  type="submit" value="Add to Cart">
						<!-- should make itself red if there are under 10 pieces -->
						<h2 style="color: Green; margin-left:20px;  display: inline; font-size: 20px"> &nbsp; STOCK {STOC}</h2>
					</form>
				</td>
			</div>
		</tr>
	</table>
</div>
<hr>
<div>
	<h2>Review</h2>
</div>