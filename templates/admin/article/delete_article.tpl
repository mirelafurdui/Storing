<form action="{SITE_URL}/admin/article/delete/id/{ID}" method="post">
	<div class="box-shadow" style="width: 600px">
		<ul class="form delete">
			<li class="clearfix">
				<p>Are you sure you want to delete this article ?</p>
			</li>
			<li class="clearfix">
				<input type="checkbox" name="confirm"><label>Confirm deletion</label>
				<input type="submit" class="button" value="YES" style="float: left; margin-right:10px;">
				<input type="button" class="button" value="Cancel">
			</li>
		</ul>
	</div>
</form>
