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
                <div class="hidden-xs">Favorites</div>
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
                <h3>THIS IS WHERE THE FAVORITE LIST WILL BE</h3>
            </div>
        </div>
    </div>
</div>