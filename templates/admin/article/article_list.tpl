<!-- <style type="text/css">

</style>
{PAGINATION}
<div id="adminList" class="box-shadow">
<table>
<th>
	<tr>Id</tr>
	<tr>Title</tr>
	<tr>Content</tr>
	<tr>Date</tr>
	
</th> -->
	
<!-- BEGIN carticle_list -->
<!-- <br>
	<td>
		<tr> <a href="http://localhost/internship1/admin/article/show/id/{ID}" rel="bookmark">{ID}</a></tr>
		<tr>{TITLE}</tr>
		<tr>{CONTENT}</tr>
		<tr>{DATE}</tr>
	</td>

<br> -->
<!-- END carticle_list -->
<!-- </table>
</div> -->


{PAGINATION}
<div id="adminList" class="box-shadow">
	<table class="big_table" frame="box" rules="all">
		<thead>
			<tr>
	
				<th>Id</th>
				<th>Title</th>
				<th>Content</th>
				<th>Creation Date</th>
				<th>Edit</th>



			</tr>
		</thead>
		<tbody>
		<!-- BEGIN article_list -->
			<tr>
				<!-- <td style="text-align: center;">{ID}</td>
				<td><a href="{SITE_URL}/admin/admin/update/id/{ID}">{USERNAME}</a></td> -->
				<td>{ID}</td>
				<td><a href="{SITE_URL}/admin/article/show/id/{ID}" >{TITLE}</a></td>
				<td>{CONTENT}</td>
				<td>{DATE}</td>
				
				<td>
					<table  class="action_table">
						<tr>
							<td width="25%"><a href="{SITE_URL}/admin/article/edit/id/{ID}/" title="Edit/Update" class="edit_state">Edit</a></td>
							<td width="25%"><a href="{SITE_URL}/admin/article/delete/id/{ID}/"" title="Delete" class="delete_state">Delete</a></td>
							
						</tr>
					</table>
				</td>
			</tr>
		<!-- END article_list -->
		</tbody>
	</table>
</div>