<link rel="stylesheet" href="{SITE_URL}/externals/bootstrap/css/bootstrap.min.css" type="text/css">
 <table class="table table-condensed">
    <thead>
      <tr>
        <th>ID</th>
        <th>Brand Name</th>
        <th>Image</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <!-- BEGIN brand -->
      <tr>
        <td>{BRAND_ID}</td>
        <td>{BRAND_NAME}</td>
        <td><img src="{SITE_URL}/images/brands/{BRAND_IMAGE}" height="30px" width="25px" ></td>
        <td><a href="{SITE_URL}/admin/product/deleteb/id/{BRAND_ID}/"" title="Delete" class="delete_state">Delete</a></td>
      </tr>
     <!-- END brand -->
    </tbody>
  </table>

<form method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Brand Name</label>
		<input type="text" name="name" class="form-control" id = "name" required="">
	</div>
  <div class="form-group">
    <label>Select image to upload:</label>
      <input type="file" name="image" id="fileToUpload">
    </div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>