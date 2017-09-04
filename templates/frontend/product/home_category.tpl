<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="{SITE_URL}/externals/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href ="{SITE_URL}/templates/css/frontend/style.css" type="text/css" >
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

{PAGINATION}
<div class="well well-sm">
    <strong>Display</strong>
    <div class="btn-group">
        <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>List</a> 
        <a href="#" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span>Grid</a>
    </div>
</div>
<h2>
	<a style="text-decoration-line: none !important; " href="{SITE_URL}/product/list"> Products </a>/
	<a style="text-decoration-line: none !important; " href="{SITE_URL}/product/show_category"> Category </a>/
	{CATEGORYNAME}
</h2>
<hr>

<div id="products" class="row list-group">
<!-- BEGIN product_category_list -->
	<div class="item  col-xs-4 col-lg-4">
	    <div class="thumbnail">
	       <a href="{SITE_URL}/product/show/id/{ID}"><img class="group list-group-image" src="{SITE_URL}/images/uploads/{IMAGE}" height="300" width="300" alt="" /></a>
	        <div class="caption">
	            <h4 class="group inner list-group-item-heading" style="font-weight: bold;">
	                <a href="{SITE_URL}/product/show/id/{ID}" > {NAME}</a></h4>
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
<!-- END product_category_list -->
</div>
<hr>
{PAGINATION}
	