<?php
require("components/AuthService.php");
session_start();

require 'includes/header.php';




$input_username = $_POST["username"];
$input_password = $_POST["password"];

$authService = new AuthService();

echo '
<div class="hero fullscreen">
            <div class="hero-body">
                <div class="content">


';

if($authService->signin($input_username, $input_password)){
	
	$_SESSION["user"] = $input_username;
	$_SESSION["fullName"] = $authService->getFullName($input_username);

	echo '



<div class="toast toast--success">
    <button class="btn-close"></button>
    <p><b>Info:</b> logged in sucessfully, redirecting...</p>
</div>


';
}else{
	echo '
<div class="toast toast--warning">
    <button class="btn-close"></button>
    <p><b>Error:</b> incorrect username or password, redirecting...</p>
</div>

';
}

echo '<meta http-equiv="refresh" content="2;url=login.php" />
<p style="text-align:center">Click <a href="login.php">here</a> if you are not automatically redirected.</p>
				<br><br><br><br>
                </div>
            </div>
        </div>

';

require 'includes/footer.php';
