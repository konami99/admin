<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link href="/css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="loginDiv">
	
	
	<?php
		$attributes = array('id'=>'loginForm'); 
		echo form_open('welcome/doLogin', $attributes); 
	?>
	<ul>
		<li>
			<div>
			<label>Username</label>
			</div>
			<?php echo form_input(array('name'=>'username')) ?>
		</li>
		<li>
			<div>
			<label>Password</label>
			</div>
			<?php echo form_password(array('name'=>'password')) ?>
		</li>
		<li>
			<?php echo form_submit('signInBtn', 'Sign in') ?>
		</li>
	</ul>
	<?php form_close() ?>
	
</div>
</body>
</html>