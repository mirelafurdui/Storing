<div class="pagination clearfix">
	<p style="text-align: center; padding: 10px">
		{TOTAL_RECORDS} record(s) /
		{TOTAL_PAGES} page(s)
	</p>
	<ul style="padding: 10px">
		<!-- BEGIN first -->
			<li style="display: inline-block;" >
			<a href="{FIRST_LINK}">First</a>
			</li>
		<!-- END first -->
		<!-- BEGIN pages -->
			<!-- BEGIN current_page -->
				<li style="display: inline-block;">
					<p style="padding:7.5px; background-color: #38425D; color: white;">{PAGE_NUMBER}</p>
				</li>
			<!-- END current_page -->
			<!-- BEGIN other_page -->
				<li style="display: inline-block;">
					<a href="{PAGE_LINK}">{PAGE_NUMBER}</a>
				</li>
			<!-- END other_page -->
		<!-- END pages -->
		<!-- BEGIN last -->
			<li style="display: inline-block;">
				<a href="{LAST_LINK}">Last</a>
			</li>
		<!-- END last -->
	</ul>
</div>
