<?php
require("components/AuthService.php");
session_start();

require 'includes/header.php';


$input_username = $_POST["username"];
$input_password = $_POST["password"];
$input_fullName = "";

$authService = new AuthService();

echo '
<div class="hero fullscreen">
            <div class="hero-body">
                <div class="content">


';

if($authService->signup($input_username, $input_password, $input_fullName)){

	echo '
	<div class="toast toast--success">
    <button class="btn-close"></button>
    <p><b>Info:</b> signed up sucessfully, log in now, redirecting...</p>
</div>

';
}else{
	echo '
	<div class="toast toast--warning">
    <button class="btn-close"></button>
    <p><b>Error:</b> incorrect username or already registered, redirecting...</p>
</div>
';
}

echo '<meta http-equiv="refresh" content="2;url=index.php" />
<p style="text-align:center">Click <a href="index.php">here</a> if you are not automatically redirected.</p>
				<br><br><br><br>
                </div>
            </div>
        </div>
';

require 'includes/footer.php';
