<link rel="stylesheet" href="{SITE_URL}/externals/bootstrap/css/bootstrap.min.css" type="text/css">
 <table class="table table-condensed">
    <thead>
      <tr>
        <th>ID</th>
        <th>Brand Name</th>
      </tr>
    </thead>
    <tbody>
    <!-- BEGIN brand -->
      <tr>
        <td>{BRAND_ID}</td>
        <td>{BRAND_NAME}</td>
      </tr>
     <!-- END brand -->
    </tbody>
  </table>

<form method="POST">
	<div class="form-group">
		<label>Brand Name</label>
		<input type="text" name="name" class="form-control" id = "name" required="">
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>