<link rel="stylesheet" href="{SITE_URL}/externals/bootstrap/css/bootstrap.min.css" type="text/css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

<link rel="stylesheet" href="{SITE_URL}/externals/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script type="text/javascript">
 $( document ).ready(function() {
    $("#plus_one").click(function () {
        $('#plusminus').val( function(i, oldval) {
            return parseInt( oldval, 10) + 1;
        });
    });
    $("#minus_one").click(function () {
        $('#plusminus').val( function(i, oldval) {
            if (oldval == 0) {
                return 0;
            } else {
                return parseInt( oldval, 10) - 1;
            }
        });
    });
});
</script>

<div class="container" style="width: 100%; margin-top: 20px;">
    <table class="table table-striped table-hover table-bordered">
        <tbody>
            <tr>

                <th class="tdFix">Item</th>

                <th class="tdFix">Quantity</th>

                <th class="tdFix">Action</th>

                <th class="tdFix">Unit Price</th>

                <th class="tdFix">Total Price</th>

            </tr>
            <form method="post">
            <!-- BEGIN cart_list -->
                        <tr>
                            <td class="tdFix" style="vertical-align: middle">{NAME}</td>

                            <td>
                                 <div class="tdFix">

                                     <a class="tdFix"; style="text-decoration: none; color: white; display: inline-block" href="{SITE_URL}/cart/addq/id/{PRODUCTID}">
                                         <span style="cursor: pointer; cursor: hand; background-color: green; color: white; height: 35px" class="input-group-addon"; id="plus_one">
                                             <i class="glyphicon glyphicon-plus"></i>
                                         </span>
                                     </a>

                                     <div class="tdFix" style="display: inline-block;"><input type="text" style="text-align: center;" class="form-control" name="qty" value="{QUANTITY}" aria-describedby="sizing-addon2" id="plusminus" required=""></div>

                                     <a class="tdFix"; style="text-decoration: none; color: white; display: inline-block" href="{SITE_URL}/cart/delq/id/{PRODUCTID}">
                                       <span style="cursor: pointer; cursor: hand;  background-color:red; color: white; height: 35px" class="input-group-addon" id="minus_one" required="">
                                           <i class="glyphicon glyphicon-minus"></i>
                                       </span>
                                     </a>

                                 </div>
                             </td>

                            <td class="tdFix" style="vertical-align: middle"><a href="{SITE_URL}/cart/delete/id/{PRODUCTID}"><button type="button" class="btn btn-danger" >Delete</button></a></td>

                            <td class="tdFix" style="vertical-align: middle">{PRICE}</td>

                            <td class="tdFix" style="vertical-align: middle">{PRICE_F}</td>

                        </tr>
            <!-- END cart_list -->
            </form>

            <tr>
                <th colspan="4"><span class="pull-right">Total Price</span></th>
                <th class="tdFix">{TOTAL_PRICE} Lei</th>
            </tr>

            <tr>
                <th colspan="4"><span class="pull-right">TVA 20%</span></th>
                <th class="tdFix">{TVA} Lei</th>
            </tr>

            <tr>
                <th colspan="4"><span class="pull-right">Total</span></th>
                <th class="tdFix">{TOTAL_PRICE_TVA} lei</th>
            </tr>

            <tr>
                <td><a href="{SITE_URL}/product" class="btn btn-primary" style="color: white; width: 300px">Continue Shopping</a></td>
                <td colspan="4"><a style="text-decoration: none; color: white;" href="{SITE_URL}/cart/checkout" class="pull-right btn btn-success">Checkout</a></td>
            </tr>
        </tbody>
    </table>
</div>