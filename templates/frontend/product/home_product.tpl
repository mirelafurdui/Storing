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

<!-- Script that changes the color and adds a text if the conditions have been met -->
<script type="text/javascript">
	$(document).ready(function() {
  var stoc = $("#stoc").text();
  var stoc2 = {PRODUCT_STOC};
  if (stoc2 == 0) {
  	$('#stoc').css('background-color', '#c10200');
    $('#stoc').text("EMPTY");
  } else if (stoc2 <= 10) {
    $('#stoc').css('background-color', '#e07102');
    $('#stoc').text("LIMITED");
  } else if (stoc2 > 10 && stoc2 <= 100) {
    $('#stoc').css('background-color', '#9ae200');
    $('#stoc').text("IN STOCK");
  } else if (stoc2 => 200) {
    $('#stoc').css('background-color', '#0ba500');
    $('#stoc').text("IN STOCK");
  }
});
</script>

<!-- Script that gives the like and dislike options -->
<script type="text/javascript">

var deleteRequestUrl = '{SITE_URL}/product/delete_user_comment';
var deleteRequestUrl = '{SITE_URL}/product/edit_user_comment';
var addWishListRequestUrl = '{SITE_URL}/user/';
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
function deleteComment(action,commentId,userId) {
	var requestSettings = {
		"data" : { 
			"action": action ,
			"id": commentId,
			"userId": userId
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
	if (action == 'edit') {
		$.ajax(editRequestUrl, requestSettings)
			.done(
				function(response)
				{
					var recievedData = $.parseJSON(response);
					console.debug(response); // enter console to see result
					var editSuccess = recievedData.success;
					var commentId = $(this).attr('commentId');
				});

	} else {
		alert ('Unspecified action error!');
	}
}

function addToWishlist(productId) {
	var requestSettings = {
		"data" : {
			"productId": productId,
			"validation": 1
		},
		"method" : "POST"
	};
	$.ajax(addWishListRequestUrl, requestSettings)
	.done(
		function(response) {
			var recievedData = $.parseJSON(response);
			console.debug(resonse);
		}
	);
}
var USER_TOKEN;
$(document).ready(function() {
	sleep(50);
	USER_TOKEN = "{USER_TOKEN}";
    	$('.upvoteButton').click(function(event)
    	{
    		var commentClass = $(this).attr('class');
      		var commentId = $(this).attr('commentId');
      		// uncomment this and it will give you an alert that shows the class and id of the comment
      		// alert(commentClass+commentId);
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
      		var userId = $(this).attr('userId');
      		// uncomment this and it will give you an alert that shows the class and id of the comment
      		// alert(commentClass+commentId);
    		event.preventDefault();
    		location.reload();
			
    	});
    	$('#wishlist').click(function(event)
    	{
    		event.preventDefault();
    		addToWishlist($(this).attr('productId'));
    	});
});
</script>

<h2 style="text-align: center">
	<a href="{SITE_URL}/product/list"> Products </a>/
	<a href="{SITE_URL}/product/category/id/{PRODUCT_IDCATEGORY}"> {PRODUCT_CATEGORYNAME} </a>/
	<a href="{SITE_URL}/product/brand/id/{PRODUCT_IDBRAND}"> {PRODUCT_BRANDNAME} </a>/
	{PRODUCT_NAME}
</h2>

<!-- This is where the product is shown START --> 
 <div class="container">
	<div class="row">
        <div class="col-xs-4 item-photo" style="float: left">
            <img src="{SITE_URL}/images/uploads/{PRODUCT_IMAGE}" height="300" width="300">
        </div>
        <div class="col-xs-5" style="border:0px solid gray; border-left: solid 2px gray; margin-top: 30px">
            <!-- This is where the rating is displayed START -->
			<div style="width: 236px; display: inline-block;">
				<div id="averageStars" style="border: 1px solid #7caeff; background-color: #ccc;  padding-left: 5px;">
					<svg width="20" height="20">
					    <defs>
					    	<linearGradient id="rating1">
					            <stop offset="0" id='ratingStop1' stop-color="#FD4"/>
					            <stop offset="0"  stop-color="white"/>
					        </linearGradient>
					    </defs>
					    <polygon points="10,1 4,20 19,8 1,8 16,20"
					  fill="url(#rating1)"/>
					</svg>
					<svg id="clickMe" width="20" height="20">
					    <defs>
					    	<linearGradient id='rating2'>
					            <stop offset="0" id='ratingStop2' stop-color="#FD4"/>
					            <stop offset="0"  stop-color="white"/>
					        </linearGradient>
					    </defs>
					    <polygon points="10,1 4,20 19,8 1,8 16,20"
					  fill="url(#rating2)" />
					</svg>
					<svg width="20" height="20">
					    <defs>
					    	<linearGradient id='rating3'>
					            <stop offset="0" id='ratingStop3' stop-color="#FD4"/>
					            <stop offset="0"  stop-color="white"/>
					        </linearGradient>
					    </defs>
					    <polygon points="10,1 4,20 19,8 1,8 16,20"
					  fill="url(#rating3)" />
					</svg>
					<svg width="20" height="20">
					    <defs>
					    	<linearGradient id='rating4'>
					            <stop offset="0" id='ratingStop4' stop-color="#FD4"/>
					            <stop offset="0"  stop-color="white"/>
					        </linearGradient>
					    </defs>
					    <polygon points="10,1 4,20 19,8 1,8 16,20"
					  fill="url(#rating4)" />
					</svg>
					<svg width="30" height="20">
					    <defs>
					    	<linearGradient id='rating5'>
					            <stop offset="0" id='ratingStop5' stop-color="#FD4"/>
					            <stop offset="0"  stop-color="white"/>
					        </linearGradient>
					    </defs>
					    <polygon points="10,1 4,20 19,8 1,8 16,20"
					  fill="url(#rating5)"/> 
					</svg>
						<span style="display:inline; margin-left: 20px;" id="averageValue">No rating</span>
				</div>
			</div>
			<!-- This is where the rating is displayed FINISH -->

            <h5 style="color:#337ab7">Product by <a href="{SITE_URL}/product/brand/id/{PRODUCT_IDBRAND}">{PRODUCT_BRANDNAME}</a></h5>

            <!-- Price -->
            <h6 class="title-price"><small>PRICE</small></h6>
            <h3 style="margin-top:0px; ">{PRODUCT_PRICE} Lei</h3>

            <div class="section">
                <h6 class="title-attr" style="margin-top:15px;" ><small></small></h6>                    
            </div>
            <div class="section" style="padding-bottom:5px;">
                <h6 class="title-attr"><small></small></h6>                    
            </div>   
            <div class="section" style="padding-bottom:20px;">
            <!-- Quantity -->
                <h6 class="title-attr" style="display: inline-block;"><small>Product Stock {PRODUCT_STOC}</small></h6>
            </div>                
    
            <form method="post" action="{SITE_URL}/cart/cart/id/{PRODUCT_ID}">
                <!-- Button to buy -->
                <div class="section" style="padding-bottom:20px;">
                	<div>
                		<span id="stoc" stockId="{PRODUCT_STOC}" style="font-size: 15px; color: white; text-align: center; padding-top: 8px; width: 100px;">NO STOCK</span>
	                    <button style="display: inline-block;" class="btn btn-success" id="addProduct">
	                    	<span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" id="addProduct"></span>
	                 		<a style="text-decoration: none; color: white; display: inline-block;" id="addProduct">Add to cart</a>
	                    </button>
                	</div> 
                </div>                                        
            </form>
			<form method="post" name="addToWishlist" action="{SITE_URL}/user/">
				<button class="btn-wish" id="wishlist" productId="{PRODUCT_ID}"><i class="fa fa-heart-o"></i></button>
				<input type="hidden" value="{PRODUCT_ID}">
			</form>
        </div>                              
        <div class="col-xs-9">
            <ul class="menu-items">
                <li class="active">Description</li>
            </ul>
            <div style="width:100%;border-top:1px solid silver">
                <p style="padding:15px;">
                    <small>
               			{PRODUCT_DESCRIPTION}
                    </small>
                </p>
            </div>
        </div>		
    </div>
</div>
<!-- This is where the product is shown ENDING --> 
<hr>
<!-- This is where you leave a review START -->
<div>
	<h2>Review</h2>
		<div id="add-comment">
            <form method="post" class="form-horizontal" name="review" action="{SITE_URL}/product/show/id/{PRODUCT_ID}">
            <div class="form-group">
                <div class="stars" style="margin-left: 36.9%">
                	<div>
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
				</div>
                <div class="form-group">
                    <div style="width: 80%; margin-left: 10%;">
                      <textarea class="form-control" name="title" placeholder="Add a Title" minlength="1" maxlength="90" rows="1" style="resize:none;" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div style="width: 80%; margin-left: 10%;">
                      <textarea class="form-control" name="comment" placeholder="Write your Review" rows="5" style="resize:none;" required></textarea>
                    </div>
                </div>
                <div style="width: 300px; margin-left: 33%">
                    <div class="col-sm-offset-2 col-sm-10">                    
                        <button class="btn btn-success btn-circle text-uppercase" type="submit"><span class="glyphicon glyphicon-send"></span>Add Review</button>
                    </div>
                </div>
            </form>
        </div>
	<hr>
</div>
<!-- This is where you leave a review ENDING -->
{PAGINATION}
<div class="comment-tabs" >
    <!-- BEGIN user_comment -->
        <div class="tab-pane active" id="comments-logout">
            <ul class="media-list">
            	<li class="media">
                <div class="media-body">
                		<a class="pull-left">
                    		<img class="media-object img-circle" src="{SITE_URL}/{COMMENT_IMAGE}" alt="profile" style="width: 80px !important; height: 80px !important; margin-top: 20px !important; margin-left: 86px !important; margin-right: 70px; margin-bottom: 5px !important;">
                    	</a>
                	<div class="well well-lg">
                		<div class="form-group">
                			<div class="stars" commentId="{COMMENT_ID}" commentValue="{COMMENT_RATING}">
							    <input id="5_{COMMENT_ID}" class="star star-5" commentId="{COMMENT_ID}" type="radio" name="singleRating_{COMMENT_ID}" value="5" disabled="" {CHECK_5} />
							    <label class="star star-5" for="5_{COMMENT_ID}" style="transform: none !important;"></label>
							    <input id="4_{COMMENT_ID}" class="star star-4" commentId="{COMMENT_ID}" type="radio" name="singleRating_{COMMENT_ID}" value="4" disabled="" {CHECK_4} />
							    <label class="star star-4" for="4_{COMMENT_ID}" style="transform: none !important;"></label>
							    <input id="3_{COMMENT_ID}" class="star star-3" commentId="{COMMENT_ID}" type="radio" name="singleRating_{COMMENT_ID}" value="3" disabled="" {CHECK_3} />
							    <label class="star star-3" for="3_{COMMENT_ID}" style="transform: none !important;"></label>
							    <input id="2_{COMMENT_ID}" class="star star-2" commentId="{COMMENT_ID}" type="radio" name="singleRating_{COMMENT_ID}" value="2" disabled="" {CHECK_2}/>
							    <label class="star star-2" for="2_{COMMENT_ID}" style="transform: none !important;"></label>
							    <input id="1_{COMMENT_ID}" class="star star-1" commentId="{COMMENT_ID}" type="radio" name="singleRating_{COMMENT_ID}" value="1" disabled="" {CHECK_1}/>
							    <label class="star star-1" for="1_{COMMENT_ID}" style="transform: none !important;"></label>
							</div>
                    	</div>
                        <ul class="media-date text-uppercase reviews list-inline">
                        	<li>{COMMENT_DATE}</li>
                        </ul>
                        	<p class="mediaUser" style="width: 200px">{COMMENT_USERNAME} <p class="mediaTitle">{COMMENT_TITLE} </p></p>
                      		<textarea class="mediaComment" disabled="" wrap=""> {COMMENT_COMMENT} </textarea><br>
							<form>
								<table>
									<thead>
									<th><button class="upvoteButton" commentId="{COMMENT_ID}" onclick="voteRequest('upVote',{COMMENT_ID},1)"><span class="glyphicon glyphicon-chevron-up"></span>Like</button></th>
									<th><button class="downvoteButton" commentId="{COMMENT_ID}" onclick="voteRequest('downVote',{COMMENT_ID},-1)">
								<span class="glyphicon glyphicon-chevron-down"></span>Unlike</button></th>
									<th><button id="totalLikes" style="text-align: center;" disabled="">{LIKES}</button></th>
									<th><button class="deleteButton" commentId="{COMMENT_ID}" onclick="deleteComment('delete',{COMMENT_ID},{COMMENT_USERID})">Delete</button></th>
									<th><button class="editButton" commentId="{COMMENT_ID}" onclick="deleteComment('edit',{COMMENT_ID},{COMMENT_USERID})">Edit</button></th>
									</thead>
								</table>
							</form>
                	</div>              
                </div>
                </li>
            </ul> 
        <!-- END user_comment -->
   		</div>
	</div>
</div>
<script type="text/javascript">
// average 4.22 - this rounds the average for better use
var average = (Math.round( {AVERAGERATING} * 100 )/100 ).toString() ;
// average from 4.22 to 4 - this is a full star
var intAverage = parseInt(average);
// difference with 0.12000 - this is the percentage from 0 to 100%
var diff = average - intAverage;
if (diff >= 0.5) {
	intAverage++;
}
// average rating
$('input[type="radio"][name="rating"][value='+intAverage+']').attr('checked','checked');
// Average rating for stars that works properly but it's just a lot of code
// Can't figure out how to make it dynamic and smaller
$( document ).ready(function() {
	if(intAverage == '5')
	{
		$('#ratingStop1').attr("offset","1");
		$('#ratingStop2').attr("offset","1");
		$('#ratingStop3').attr("offset","1");
		$('#ratingStop4').attr("offset","1");
		$('#ratingStop5').attr("offset","1");
	}
	if(intAverage == '4')
	{
		$('#ratingStop1').attr("offset","1");
		$('#ratingStop2').attr("offset","1");
		$('#ratingStop3').attr("offset","1");
		$('#ratingStop4').attr("offset","1");
		$('#ratingStop5').attr("offset",diff);
	}
	if(intAverage == '3')
	{
		$('#ratingStop1').attr("offset","1");
		$('#ratingStop2').attr("offset","1");
		$('#ratingStop3').attr("offset","1");
		$('#ratingStop4').attr("offset",diff);
		$('#ratingStop5').attr("offset","0");
	}
	if(intAverage == '2')
	{
		$('#ratingStop1').attr("offset","1");
		$('#ratingStop2').attr("offset","1");
		$('#ratingStop3').attr("offset",diff);
		$('#ratingStop4').attr("offset","0");
		$('#ratingStop5').attr("offset","0");
	}
	if(intAverage == '1')
	{
		$('#ratingStop1').attr("offset","1");
		$('#ratingStop2').attr("offset",diff);
		$('#ratingStop3').attr("offset","0");
		$('#ratingStop4').attr("offset","0");
		$('#ratingStop5').attr("offset","0");
	}
	if(intAverage <= '1')
	{
		$('#ratingStop1').attr("offset",diff);
		$('#ratingStop2').attr("offset","0");
		$('#ratingStop3').attr("offset","0");
		$('#ratingStop4').attr("offset","0");
		$('#ratingStop5').attr("offset","0");
	}
	// This shows the average in the span with the id "averageValue" 
	// It's meant to increase visibility
	$('#averageValue').text(average).css('color','black').css('margin-left','16%').css('padding-right','5%').css('font-size','15px' );
});
</script>
