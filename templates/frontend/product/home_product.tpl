
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous">
</script>
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
<!-- Script that gives the like and dislike options -->
<script type="text/javascript">

var deleteRequestUrl = '{SITE_URL}/product/delete_user_comment';
var voteRequestUrl = '{SITE_URL}/product/voting';

function voteRequest(action, commentId) {
	// This is where the comment id will go but it won't recognize it
	var requestSettings = {
		"data" : { 
			"action": action ,
			"id": commentId
				 },
		"method" : "POST"
	};

	if (action == 	'upVote' || action == 'downVote') {
		$.ajax(voteRequestUrl, requestSettings)
			.done(
				function(response)
					{
						var recievedData = $.parseJSON(response);
						console.debug(response); // enter console to see result 
						var voteSuccess = recievedData.success;
						var commentId = $(this).attr('commentId');
						var voteValue = recievedData.data.voteValue;
						$("#voteValue").text(voteValue);
					});

	} else {
		alert ('Unspecified action error!');
	}
}

function deleteComment(action,commentId) {
	// This is where the comment id will go but it won't recognize it
	var requestSettings = {
		"data" : { 
			"action": action ,
			"id": commentId
				 },
		"method" : "POST"
	};

	if (action == 'delete' || action == 'edit') {
		$.ajax(deleteRequestUrl, requestSettings)
			.done(
				function(response)
					{
						var recievedData = $.parseJSON(response);
						console.debug(response); // enter console to see result
						var deleteSuccess = recievedData.success; 
						var commentId = $(this).attr('commentId');
					});

	} else {
		alert ('Unspecified action error!');
	}
}

$(document).ready(function() {
    	$('.upvoteButton').click(function(event)
    	{
    		var commentClass = $(this).attr('class');
      		var commentId = $(this).attr('commentId');
      		// uncomment this and it will give you an alert that shows the class and id of the comment
      		// alert(commentClass+commentId);
    		event.preventDefault();
    		voteRequest('upVote', commentId);
    		// location.reload();
    	});
		$('.downvoteButton').click(function(event)
    	{
    		var commentClass = $(this).attr('class');
      		var commentId = $(this).attr('commentId');
      		// uncomment this and it will give you an alert that shows the class and id of the comment
      		// alert(commentClass+commentId);
    		event.preventDefault();
    		voteRequest('downVote', commentId);
    		// location.reload();
    	});
    	$('.deleteButton').click(function(event)
    	{
    		var commentClass = $(this).attr('class');
      		var commentId = $(this).attr('commentId');
      		// uncomment this and it will give you an alert that shows the class and id of the comment
      		// alert(commentClass+commentId);
    		event.preventDefault();
    		// location.reload();
    	});
});
</script>
<h2>
	<a href="{SITE_URL}/product/list"> Products </a>/
	<a href="{SITE_URL}/product/category/id/{PRODUCT_IDCATEGORY}"> {PRODUCT_CATEGORYNAME} </a>/
	<a href="{SITE_URL}/product/brand/id/{PRODUCT_IDBRAND}"> {PRODUCT_BRANDNAME} </a>/
	{PRODUCT_NAME}
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
					<h2 style="display: inline;">{PRODUCT_NAME}</h2> &nbsp; <h2 style=" color: red">{PRODUCT_PRICE} Lei</h2>
					<img src="{SITE_URL}/images/uploads/{PRODUCT_IMAGE}" height="300" width="300" >
				</td>
			</div>
		</thead>
		<tr>
			<td>
				<h2>Description</h2>
				<p style="padding: 20px">{PRODUCT_DESCRIPTION}</p>
			</td>
		</tr>
		<tr>
			<div>
				<td>
					<div><h2 style="font-size: 15px; display: inline;">Units:</h2>
					  <span id="stoc" style="font-size: 15px; display: inline;">
					 	{PRODUCT_STOC}
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
	<br>
	<div>
		<form method="POST"; style="display: inline;">
			Rating:
				<select name="rating" style="width: 50%; display: block; margin-left: auto; margin-right: auto;">
				  <option value="5">♥ ♥ ♥ ♥ ♥</option>
				  <option value="4">♥ ♥ ♥ ♥</option>
				  <option value="3">♥ ♥ ♥</option>
				  <option value="2">꒰ ꒡⌓꒡꒱</option>
				  <option value="1">୧༼ಠ益ಠ༽୨</option>
				</select>
			Title:
				<input name="title"; style="width: 50%; display: block; margin-left: auto; margin-right: auto;" min="1"; max="5"; type="text" value="Add text">
			Comment:
				<input name="comment"; style="width: 50%; display: block; margin-left: auto; margin-right: auto;"
			type="text" value="Add Review">
			<br>
			<input style=" display: block; margin-left: auto; margin-right: auto;" type="submit" value="Add Review">
		</form>
	</div>
	<hr>
	<div>
	{PAGINATION}
	<!-- BEGIN user_comment -->
	<div style="margin: 10px; margin-bottom: 50px;">
		<h2 style="display: inline;">
			<img src="{SITE_URL}/{COMMENT_IMAGE}" style="width: 30px; height: 25px;">
			{COMMENT_ID}
			{COMMENT_USERID} 
		</h2>
			<p style="display: inline; font-size: 20px;">{COMMENT_TITLE}</p>
			<p style="display: inline; font-size: 20px;">Rated {COMMENT_RATING}</p>
				<div style="margin: 5px;">
					<p style="text-align: justify-all;">
						{COMMENT_COMMENT}
					</p>
				</div>
				<div>
					<form>
						<span id="voteValue">{COMMENT_LIKE}</span>
						<span>{COMMENT_LIKETOTAL}</span>
						<button class="upvoteButton" commentId="{COMMENT_ID}" onclick="voteRequest('upVote'{COMMENT_ID})">Like</button>
						<button class="downvoteButton" commentId="{COMMENT_ID}" onclick="voteRequest('downVote'{COMMENT_ID})"">Unlike</button>
					</form>
				</div>
				<p style="text-align: justify;">
					{COMMENT_DATE}
				</p>
				<form>
					<div style="display: inline; margin-left: auto; margin-right: auto;">
						<input type="button" commentId="{COMMENT_ID}" value="Edit"  onclick="edit_row('')">
						<input type="button" commentId="{COMMENT_ID}" value="Save"  onclick="save_row('')">
						<button class="deleteButton" commentId="{COMMENT_ID}" onclick="deleteComment('delete',{COMMENT_ID})">Delete</button>
					</div>
				</form>
	</div>
	<!-- END user_comment -->
	</div>
	<hr>
</div>