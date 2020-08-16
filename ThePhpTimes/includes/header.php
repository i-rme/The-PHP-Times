<?php

require_once 'components/NewsService.php';
$newsService = new NewsService();

if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $fullName = $_SESSION["fullName"];
    $user_status = 'Logged in as '.$user;
    $menu_actions = '<div class="nav-item">
                        <a href="doLogout.php">Log out</a>
                    </div>';

} else {
    $user_status = 'You are not logged in';
    $menu_actions = '<div class="nav-item">
                        <a href="login.php">Login</a>
                    </div>
                    <div class="nav-item">
                        <a href="signup.php">Sign up</a>
                    </div>';
}

$categories = $newsService->getCategories();

$categories_html = '';

foreach ($categories as &$category) {
    $categories_html .= '<li role="menu-item"><a href="index.php?category='.$category[0].'">'.$category[0].'</a></li>
    ';
}


echo '<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        
        <link href="./css/cirrus.min.css" type="text/css" rel="stylesheet" />
        <link href="./css/fontawesome.css" type="text/css" rel="stylesheet" />
        <link href="./css/app.css" type="text/css" rel="stylesheet" />

        <!-- Custom CSS made by Raúl -->
        <!-- Remove it to see the before -->
        <link href="./css/custom.css" type="text/css" rel="stylesheet" />

        <link rel="icon" type="image/vnd.microsoft.icon" href="./favicon.ico">
        <link rel="Shortcut Icon" href="./favicon.ico" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
        
        <script src="./js/jquery-2.2.4.min.js"></script>

        <title>The PHP Times - Raúl Martínez</title>

        <style>
	        @media screen and (max-width: 768px) {
	            .divider {
	                display: none;
	            }
	        }
	    </style>
        
    </head>

    <body>
        <div class="header header-fixed unselectable header-animated">
            <div class="header-brand">
                <div class="nav-item no-hover">
                    <a href="index.php"><h6 class="title">The <span class="tag tag--link text-light">PHP</span> Times</h6></a>
                </div>
                <div class="nav-item nav-btn" id="header-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="header-nav" id="header-menu">
                <div class="nav-left">
                    '.$menu_actions.'                    
                    <div class="nav-item has-sub toggle-hover" id="dropdown">
                        <a class="nav-dropdown-link">Categories</a>
                        <ul class="dropdown-menu dropdown-animated" role="menu">
                            '.$categories_html.'
                        </ul>
                    </div>
                </div>
                
                <div class="nav-right">
                    <div class="form-group">
                    <b>'.$user_status.'</b>
                    </div>
                </div>
            </div>
        </div>
';