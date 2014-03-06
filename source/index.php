<!DOCTYPE html>
<?php

$nav_index = 1;
$nav_login = 0;
require 'nav.php';
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4 col-md-offset-4 panel">
			<h2 class="margin-base-vertical">Login 登录</h2>
			<p>
            Someone told me long ago there's a calm before the storm. I know, It's been comin for some time.
            </p>
			<div class="input-group">
				<label  class="sr-only"  for="user_login">Username</label>
				<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
				<input type="text" class="form-control" id="user_login" placeholder="Username">
			</div>
			<br/>
			<div class="input-group">
				<label  class="sr-only"  for="user_pass">Password</label>
				<span class="input-group-addon"><img width="14" height="14" src="img/key3.png"/></span>
				<input type="password" class="form-control" id="user_pass" placeholder="Password">
			</div>
			<br/>
			<div>
                    <p class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">登录</button>
                    </p>
			</div>
                    <p class="help-block text-center"><small>We won't send you spam. Unsubscribe at any time.</small></p>
		</div>
	</div>
</div>
</body>
</html>