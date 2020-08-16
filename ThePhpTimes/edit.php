<?php
session_start();
require 'includes/header.php';

require_once 'components/NewsService.php';
$newsService = new NewsService();

$input_newsid = htmlentities($_GET["id"]);

if (!isset($_SESSION["user"])) {
  header("Location: index.php");
  exit;
}

echo '
        <div class="hero">
            <div class="hero-body u-center">

                <div class="content"><br/>

                <h1 class="u-text-center">The <span class="tag tag--link text-light">PHP</span> Times</h1>
                <p class="u-text-center">Your newspaper - '.$date = date('l \t\h\e jS\, Y', time()).'</p>
                <div class="divider"></div>

';

$news = $newsService->getNewsInfo($input_newsid);
$newspiece = $news['news'];

if($newspiece == null){
    //New newspiece
    $explanation = 'You are adding a new newspiece. To create a new category just type a new word and it will be created. To add a picture you have to input a valid url.';
    $newspiece = new News($input_newsid, "", "", "", "", "", "");
    $button_status = 'disabled';
}else{
    $explanation = '';
    $button_status = '';
}


echo '<p>'.$explanation.'</p>';


echo '	    <form action="doEdit.php?id='.$input_newsid.'" method="POST">
            <input type="text" class="input-xlarge" placeholder="A nice title goes here" value="'.$newspiece->title.'" name="title" required>

            <input type="text" class="input-xsmall" placeholder="Date is generated automagically" value="'.date("Y-m-d H:i:s").'" name="datetime" disabled>

			<p class="tile__subtitle">Category: 
			<input type="text" class="input-xsmall" placeholder="category" value="'.$newspiece->category.'" name="category" required>
			</p>

			<p class="tile__subtitle">Picture: 
			<input type="text" class="input-xsmall" placeholder="http://somehost/image.jpg" value="'.$newspiece->picture.'" name="picture" required>
			</p>

            <textarea name="text" rows="12">'.($newspiece->text).'</textarea>

            <div class="row">
                <div class="col-3">
                    <a href="newspiece.php?id='.$newspiece->id.'" style="display: inline"><div style="display: inline" class="btn btn-link btn-animated"><i class="fa-wrapper fa fa-chevron-left pad-right"></i>Return</div></a>
                </div>
                <div class="col-3">
                    <a style="display: inline"><button style="display: inline" class="btn-light btn-info">Edit</button></a>
                </div>
                <div class="col-6">';
                if($button_status != 'disabled'){
                    echo '
                    <a href="doEdit.php?id='.$newspiece->id.'&delete" style="display: inline"><div style="display: inline" class="btn btn-light btn-warning">Remove</div></a>';
                }

echo '
                </div>
            </div>

            
            
            </form>
';



//print_r($newspiece);


echo '
			</div>	<!-- content -->
        </div>	<!-- hero-body -->
    </div>	<!-- hero -->
';


require 'includes/footer.php';