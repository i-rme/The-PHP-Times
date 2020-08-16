<?php
require_once 'components/NewsService.php';
$newsService = new NewsService();

$input_newsid = htmlentities($_GET["id"]);

$news = $newsService->getNewsInfo($input_newsid);
$newspiece = $news['news'];

if($newspiece == null){
  header("Location: index.php");
  exit;
}

session_start();
require 'includes/header.php';

if (isset($_SESSION["user"])) {
    $user_message = 'As you are logged in you can edit and create news.';
    $buton_status = '';
} else {
    $user_message = 'To be able to edit and create news you have to log in.';
    $buton_status = 'disabled';
}





echo '
        <div class="hero">
            <div class="hero-body u-center">

                <div class="content"><br/>

                <h1 class="u-text-center">The <span class="tag tag--link text-light">PHP</span> Times</h1>
                <p class="u-text-center">Your newspaper - '.$date = date('l \t\h\e jS\, Y', time()).'</p>
                <div class="divider"></div>

';




echo '
            <h2><a href="newspiece.php?id='.$newspiece->id.'" class="doc-link">#</a>'.$newspiece->title.'</h2>

            <p>'.$newspiece->datetime.'</p>
			<p class="tile__subtitle">Categories: <a href="index.php?category='.$newspiece->category.'"><span class="tag tag--link text-light">'.$newspiece->category.'</span></a> </p>

            <div class="row">
                <img class="img-stretch" src="'.$newspiece->picture.'" />
            </div>

            <p>'.nl2br($newspiece->text).'</p>

            <a onclick="window.history.back();" style="display: inline"><button style="display: inline" class="btn-link btn-animated"><i class="fa-wrapper fa fa-chevron-left pad-right"></i>Return</button></a>
            <a href="edit.php?id='.$newspiece->id.'" style="display: inline"><button style="display: inline" class="btn-light btn-info" '.$buton_status.'>Edit</button></a>

            <p><b>'.$user_message.'</b></p>
';



//print_r($newspiece);


echo '
			</div>	<!-- content -->
        </div>	<!-- hero-body -->
    </div>	<!-- hero -->
';


require 'includes/footer.php';