<link rel="stylesheet" href="{SITE_URL}/externals/bootstrap/css/bootstrap.min.css" type="text/css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">

<link rel="stylesheet" href ="{SITE_URL}/templates/css/frontend/style.css" type="text/css" >

<!-- link with images for stars --> 
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

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
var average = (Math.round( {AVERAGERATING} * 100 )/100 ).toString() ;

var deleteRequestUrl = '{SITE_URL}/product/delete_user_comment';
var voteRequestUrl = '{SITE_URL}/product/voting';

function voteRequest(action, commentId,info) {
	var requestSettings = {
		"data" : { 
			"action": action ,
			"id": commentId,
			"info": info
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

function deleteComment(action,commentId,info) {
	var requestSettings = {
		"data" : { 
			"action": action ,
			"id": commentId,
			"info": info
				 },
		"method" : "POST"
	};

	if (action == 'delete') {
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
      		alert(average);
    		event.preventDefault();
    		// voteRequest('upVote', commentId, 1);
    		location.reload();
    	});
		$('.downvoteButton').click(function(event)
    	{
    		var commentClass = $(this).attr('class');
      		var commentId = $(this).attr('commentId');
      		// uncomment this and it will give you an alert that shows the class and id of the comment
      		// alert(commentClass+commentId);
    		event.preventDefault();
    		// voteRequest('downVote', commentId, -1);
    		location.reload();
    	});
    	$('.deleteButton').click(function(event)
    	{
    		var commentClass = $(this).attr('class');
      		var commentId = $(this).attr('commentId');
      		// uncomment this and it will give you an alert that shows the class and id of the comment
      		// alert(commentClass+commentId);
    		event.preventDefault();
    		location.reload();
    	});
});
</script>
<h2>
	<a style="text-decoration-line: none !important; " href="{SITE_URL}/product/list"> Products </a>/
	<a style="text-decoration-line: none !important; " href="{SITE_URL}/product/category/id/{PRODUCT_IDCATEGORY}"> {PRODUCT_CATEGORYNAME} </a>/
	<a style="text-decoration-line: none !important; " href="{SITE_URL}/product/brand/id/{PRODUCT_IDBRAND}"> {PRODUCT_BRANDNAME} </a>/
	{PRODUCT_NAME}
</h2>
<hr>
<div>
	<table>
		<thead>
			<div>
				<td>
					<div>
						<p> REMOVED WHEN RATING WORKS PROPERLY : (RATING AVG) {AVERAGERATING}</p>
						<div class="stars">
							<input class="star star-rating" id="star-5s" type="radio" name="rating" value="5" disabled=""/>
				    		<label class="star star-rating" for="star-5s" value="5" style="transform: none !important;"></label>

				    		<input class="star star-rating" id="star-4s" type="radio" name="rating" value="4" disabled=""/>
				    		<label class="star star-rating" for="star-4s" value="4" style="transform: none !important;"></label>

				    		<input class="star star-rating" id="star-3s" type="radio" name="rating" value="3" disabled=""  />
				    		<label class="star star-rating" for="star-3s" value="3" style="transform: none !important;"></label>

				    		<input class="star star-rating" id="star-2s" type="radio" name="rating" value="2" disabled=""/>
				    		<label class="star star-rating" for="star-2s" value="2" style="transform: none !important;"></label>

				    		<input class="star star-rating" id="star-1s" type="radio" name="rating" value="1" disabled=""/>
				    		<label class="star star-rating" for="star-1s" value="1" style="transform: none !important;"></label>
						</div>
						<!-- <p style="font-size: 30px; color: black;">RATING :{AVERAGERATING}</p> -->
						<br>
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
			<div class="stars" style="margin-left: 36%">
			    <input class="star star-5" id="star-5" type="radio" name="rating" value="5.0" />
			    <label class="star star-5" for="star-5" value="5"></label>
			    <input class="star star-4" id="star-4" type="radio" name="rating" value="4.0"/>
			    <label class="star star-4" for="star-4" value="4"></label>
			    <input class="star star-3" id="star-3" type="radio" name="rating" value="3.0"/>
			    <label class="star star-3" for="star-3" value="3"></label>
			    <input class="star star-2" id="star-2" type="radio" name="rating" value="2.0"/>
			    <label class="star star-2" for="star-2" value="2"></label>
			    <input class="star star-1" id="star-1" type="radio" name="rating" value="1.0"/>
			    <label class="star star-1" for="star-1" value="1"></label>
			</div>
			<br>
			Title:
				<input name="title"; style="width: 50%; display: block; margin-left: auto; margin-right: auto; text-align: center;" min="1"; max="5"; type="text" placeholder="Add a Title">
			Comment:
				<input name="comment"; style="width: 50%; display: block; margin-left: auto; margin-right: auto; text-align: center;"
			type="text" placeholder="Add your Review">
			<br>
			<input style=" display: block; margin-left: auto; margin-right: auto; " type="submit" value="Add Review">
		</form>
	</div>
	<hr>
	<div>
	{PAGINATION}
	<!-- BEGIN user_comment -->
	<div style="margin: 10px; margin-bottom: 50px;">
		<h2 style="display: inline;">
			<img src="{SITE_URL}/{COMMENT_IMAGE}" style="width: 30px; height: 25px;">
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
						<button class="upvoteButton" commentId="{COMMENT_ID}" onclick="voteRequest('upVote',{COMMENT_ID},1)">Like</button>
						<button class="downvoteButton" commentId="{COMMENT_ID}" onclick="voteRequest('downVote',{COMMENT_ID},-1)">Unlike</button>
						<p>{LIKES}</p>
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

<script type="text/javascript">
var average = (Math.round( {AVERAGERATING} * 100 )/100 ).toString() ;
var intAverage = parseInt(average);
var diff = average - intAverage;
if (diff >= 0.5) {
	intAverage++;
}

	$('input[type="radio"][name="rating"][value='+intAverage+']').attr('checked','checked');
</script>
