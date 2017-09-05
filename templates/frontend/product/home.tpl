<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<link rel="stylesheet" href="{SITE_URL}/externals/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href ="{SITE_URL}/templates/css/frontend/style.css" type="text/css" >

<script type="text/javascript">
var voteRequestURL = "http://localhost/Storing/product/home";
    function voteRequest(action){

        var requestSettings = {
            'data': {
                    'action':action
                    },
            'method': 'POST'
        };
            if (action == "9" || action == "15" || action == "21" || action == "24") {
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
    $("#9").click(function(event){
        event.preventDefault();
        voteRequest("9");
        location.reload();
    });
    $("#15").click(function(event){
        event.preventDefault();
        voteRequest("15");
        location.reload();
    });
    $("#21").click(function(event){
        event.preventDefault();
        voteRequest("21");
        location.reload();
    });
    $("#24").click(function(event){
        event.preventDefault();
        voteRequest("24");
        location.reload();
    });
    
    $(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#products .item').removeClass('grid-group-item');$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
});
    
//   if (typeof jQuery != 'undefined') {  
//     // jQuery is loaded => print the version
//     alert(jQuery.fn.jquery);
// }
});
</script>

<script type="text/css">

<!-- div#product:hover 
{
    background: #428bca;
} -->
</script>

<!-- <hr> -->
<div class="container">
 <div class="dropdown">
    <button id="btn" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Items Per Page</button>
    <ul class="dropdown-menu">
      <li><a id="9" href="#">9</a></li>
      <li><a id="15" href="#">15</a></li>
      <li><a id="21" href="#">21</a></li>
      <li><a id="24" href="#">24</a></li>
    </ul>
        <a class="btn btn-primary" href="{SITE_URL}/product/show_brand">Brands</a>
        <a class="btn btn-primary" href="{SITE_URL}/product/show_category">Category</a>
     
  </div>

{PAGINATION}
    <div class="well well-sm">
        <strong>Display</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>List</a> 
            <a href="#" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
    </div>

        <form  role="search" method="POST">
            <div class="input-group add-on">
                <input class="form-control" placeholder="Search" name="srch" id="srch-term" type="text">
                <div class="input-group-btn">
                   <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </form>
    <div id="products" class="row list-group">
    
<!-- BEGIN product_list -->

        <div class="item  col-xs-4 col-lg-4" id="product">

            <div class="thumbnail">
               <a href="{SITE_URL}/product/show/id/{ID}"><img class="group list-group-image" src="{SITE_URL}/images/uploads/{IMAGE}" height="300px" width="300px" alt="" /></a>
                <div class="caption">
                    <h4 class="group inner list-group-item-heading" style="font-weight: bold;">
                        <a href="{SITE_URL}/product/show/id/{ID}" > {NAME}</a></h4>
                    <p class="group inner list-group-item-text" >
                        {DESCRIPTION}</p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <p class="lead" style="color: blue">
                                {PRICE} Lei</p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a class="btn btn-success" href="{SITE_URL}/product/show/id/{ID}">View</a>
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
    
