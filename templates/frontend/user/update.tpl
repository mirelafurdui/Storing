<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
$(".btn-pref .btn").click(function () {
    $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    $(".tab").addClass("active"); // instead of this do the below 
    $(this).removeClass("btn-default").addClass("btn-primary");   
});
});
</script>


<script type="text/javascript">

    var deleteRequestUrl = '{SITE_URL}/user/delete_product_from_wishlist';

    function deleteProductFromWishlist(action,productId,userId) {
        var requestSettings = {
            "data" : {
                "action": action ,
                "id": productId,
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
                        var productId = $(this).attr('productId');
                    });
            } else {
                alert ('Unspecified action error!');
            }
        }

        var USER_TOKEN;
        $(document).ready(function() {
            sleep(50);
            USER_TOKEN = "{USER_TOKEN}";
            $('.deleteButton').click(function(event)
            {
                var productClass = $(this).attr('class');
                var productId = $(this).attr('productId');
                var userId = $(this).attr('userId');
//                event.preventDefault();
//                location.reload();
            });
        });
</script>

<div class="col-lg-6 col-sm-6" style="width: 100%">
    <div class="card hovercard">
        <div class="card-background">
            <img class="card-bkimg" src="{SITE_URL}/{IMAGE}">
        </div>
        <div class="useravatar">
            <img src="{SITE_URL}/{IMAGE}">
        </div>
        <div class="card-info"> <span class="card-title">{USERNAME}</span>

        </div>
    </div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="userinfo" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>

                <div class="hidden-xs">Info</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                <div class="hidden-xs">Wishlist</div>
            </button>
        </div>
    </div>

    <div class="well">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab1">
                <form action="{SITE_URL}/user/account/" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="userToken" value="{USERTOKEN}" >
                        <ul class="form">
                            <li class="clearfix">
                                <label>Change Image:</label>
                                 <input type="file" name="newImage" id="newImage">
                                 <input type="hidden" name="url" value="<?php echo htmlentities($_SERVER['REQUEST_URI'])>"/>
                            </li>
                            <li class="clearfix">
                                <label for="password">Password:</label>
                                <input type="password" name="password" value="{PASSWORD}" id="password" style="width: 80%" />
                            </li>
                            <li class="clearfix">
                                <label for="password2">Re-type Password:</label>
                                <input type="password" name="password2" value="{PASSWORD}" id="password2" style="width: 80%" />
                            </li>
                            <li class="clearfix">
                                <label for="email">Email:</label>
                                <input id="email" type="text" name="email" value="{EMAIL}" style="width: 80%"/>
                            </li>
                            <li class="clearfix">
                                <label for="firstName">First Name:</label>
                                <input type="text" name="firstName" value="{FIRSTNAME}" id="firstName" style="width: 80%"/>
                            </li>
                            <li class="clearfix">
                                <label for="lastName">Last Name:</label>
                                <input type="text" name="lastName" value="{LASTNAME}" id="lastName" style="width: 80%"/>
                            </li>
                            <li class="clearfix">
                                <label for="city">City:</label>
                                <input type="text" name="city" value="{CITY}" id="city" style="width: 80%"/>
                            </li>
                            <li class="clearfix">
                                <label for="address">Address:</label>
                                <input type="text" name="address" value="{ADDRESS}" id="address" style="width: 80%"/>
                            </li>
                            <li class="clearfix">
                                <label class="empty">&nbsp;</label>
                                <button type="submit" class="btn btn-block btn-primary btn-default" value="Update">
                                <i class="glyphicon glyphicon-repeat"></i> Update</button>
                           </li>
                        </ul>
                </form>
            </div>
            <div class="tab-pane fade in" id="tab2">
                <div>
                    <table class="table table-striped custab" style="text-align: center">
                        <thead>
                            <th style="text-align: center">NAME</th>
                            <th style="text-align: center">IMAGE</th>
                            <th style="text-align: center">PRICE</th>
                            <th style="text-align: center">ACTIONS</th>
                        </thead>
                <!-- BEGIN wishlist_list -->
                        <tbody>
                            <td style="vertical-align: middle"><a style="text-decoration: none; color: black;" href="{SITE_URL}/product/show/id/{WISHLIST_PRODUCTID}">{WISHLIST_NAME}</a></td>
                            <td style="vertical-align: middle"><a style="text-decoration: none; color: black;" href="{SITE_URL}/product/show/id/{WISHLIST_PRODUCTID}"><img src="{SITE_URL}/images/uploads/{WISHLIST_IMAGE}" width="80" height="80"></a></td>
                            <td style="vertical-align: middle">{WISHLIST_PRICE} Lei</td>
                            <td style="vertical-align: middle">
                                <a href="{SITE_URL}/user/account"><button class="btn btn-danger btn-xs" productId="{WISHLIST_PRODUCTID}" onclick="deleteProductFromWishlist('delete',{WISHLIST_PRODUCTID},{ID})"><span class="glyphicon glyphicon-remove"></span> Remove</button></a>
                                <!-- BEGIN wishlist_stoc -->
                                    <form method="post" action="{SITE_URL}/cart/cart/id/{WISHLIST_PRODUCTID}" style="display: inline-block">
                                        <a id="addProduct"><button class="btn btn-success btn-xs" id="addProduct"; style="width: 100px !important;" productId="{WISHLIST_PRODUCTID}"><span class="glyphicon glyphicon-plus"></span> Add to Cart</button></a>
                                    </form>
                                <!-- END wishlist_stoc -->

                                <!-- BEGIN wishlist_stoc_0 -->
                                    <button class="btn btn-block btn-xs";  style="width: 200px !important; display: inline-block;";><span class="glyphicon glyphicon-exclamation-sign"></span> This Product Is out of Stoc!</button>
                                <!-- END wishlist_stoc_0 -->
                            </td>

                        </tbody>
                <!-- END wishlist_list -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>