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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Script that changes the color of the number based on the if functions -->
<script type="text/javascript">
	$(document).ready(function() {
  var stoc = $("#stoc").text();
  if (stoc <= 10) {
    $('#stoc').css('color', 'red');
  } else if (stoc > 10 && stoc <= 100) {
    $('#stoc').css('color', 'orange');
  } else if (stoc => 300) {
    $('#stoc').css('color', 'green');
  }
});
</script>

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
					<div style="border: solid; 1px;">
						<p style="font-size: 30px; color: red;">THIS IS WHERE THE RATING WILL BE</p>
					</div>
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
					<div><h2 style="font-size: 15px; display: inline;">Units:</h2>
					  <span id="stoc" style="font-size: 15px; display: inline;">
					 	{STOC}
					  </span>
					<form method="POST" style="display: inline;">
						<h2 style="display: inline; font-size: 15px;">Product </h2>
						<input style="display: inline;" type="number" value="1" min="1" max="{STOC}">
						<input style="display: inline;" type="submit" value="Add to Cart">
					</form>
					</div>
				</td>
			</div>
		</tr>
	</table>
</div>
<hr>
<div>
	<h2>Review</h2>
	<div style="border: solid; 1px;">
	<p style="font-size: 30px; color: red;">THIS IS WHERE THE RATING WILL BE</p>
	<p style="font-size: 30px; color: red;">THIS IS WHERE THE REVIEWS WILL BE</p>
	</div>
	<div style="border: solid; 1px;">
	<form method="POST" style="display: inline;">
		<input style="display: inline;" type="text" value="THIS IS THE REVIEW">
		<input style="display: inline;" type="submit" value="Add Review">
	</form>
	</div>
</div>