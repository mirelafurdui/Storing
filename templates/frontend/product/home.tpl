<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="{SITE_URL}/externals/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href ="{SITE_URL}/templates/css/frontend/style.css" type="text/css" >
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

<script type="text/javascript">
var voteRequestURL = "http://localhost/StoringC/product/home";
	function voteRequest(action){

		var requestSettings = {
			'data': {
					'action':action
					},
			'method': 'POST'
		};
			if (action == "ten" || action == "fifteen" || action == "twenty" || action == "twentyfive") {
			$.ajax(voteRequestURL, requestSettings).done(function(response){
				var receiveData = $.parseJSON(response);
				var voteSuccess = receiveData.success;
				var voteValue = receiveData.data.voteValue;
				$('span').text(voteValue);
			});
			
		}else {
			alert("!!");
		}
	}
</script>
<script>
$(document).ready(function(){
    $("#ten").click(function(event){
        event.preventDefault();
        voteRequest("ten");
        location.reload();
    });
    $("#fifteen").click(function(event){
        event.preventDefault();
        voteRequest("fifteen");
        location.reload();
    });
    $("#twenty").click(function(event){
        event.preventDefault();
        voteRequest("twenty");
        location.reload();
    });
    $("#twentyfive").click(function(event){
        event.preventDefault();
        voteRequest("twentyfive");
        location.reload();
    });
    
    
//   if (typeof jQuery != 'undefined') {  
//     // jQuery is loaded => print the version
//     alert(jQuery.fn.jquery);
// }
});
</script>

<script type="text/javascript">
	$(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
});
</script>
<!-- <hr> -->
<div class="container">
 <div class="dropdown">
    <button id="btn" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Items Per Page</button>
    <ul class="dropdown-menu">
      <li><a id="ten" href="#">9</a></li>
      <li><a id="fifteen" href="#">15</a></li>
      <li><a id="twenty" href="#">21</a></li>
      <li><a id="twentyfive" href="#">24</a></li>
    </ul>
  </div>
{PAGINATION}
    <div class="well well-sm">
        <strong>Display</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>List</a> 
            <a href="#" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
    </div>

    <div id="products" class="row list-group">
    
<!-- BEGIN product_list -->

        <div class="item  col-xs-4 col-lg-4">

            <div class="thumbnail">
                <img class="group list-group-image" src="{SITE_URL}/images/uploads/{IMAGE}" height="300" width="300" alt="" />
                <div class="caption">
                    <h4 class="group inner list-group-item-heading" style="font-weight: bold;">
                         {NAME}</h4>
                    <p class="group inner list-group-item-text" >
                        {DESCRIPTION}</p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <p class="lead">
                                {PRICE} Lei</p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a class="btn btn-success" href="#">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- END product_list -->
    </div>
<hr>
{PAGINATION}
</div>
	
