<script>
function myFunction() {
    if (confirm("Congratulation!!!") == true) {
    } 
}
</script>
<link rel="stylesheet" href="{SITE_URL}/externals/bootstrap/css/bootstrap.min.css" type="text/css">
<form method="POST" >
	<div class="form-group">
		<label>Category Name</label>
		<input type="text" name="name" class="form-control" id = "name">
	</div>
	<button onclick="myFunction()" type="submit" class="btn btn-primary">Submit</button>
</form>