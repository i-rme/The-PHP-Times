<?php
session_start();
require 'includes/header.php';

require_once 'components/NewsService.php';
$newsService = new NewsService();

if(!isset($_GET['category'])){
	$news = $newsService->getAll();
	$maintitle = '<a href="index.php" class="doc-link">#</a>Index';
}else{
	$category = htmlentities($_GET['category']);
	$news = $newsService->getCategory($category);
	$maintitle = '<a href="index.php?category='.$category.'" class="doc-link">#</a>Category: '.$category;
}

if (isset($_SESSION["user"])) {
    $buton_status = '';
} else {
    $buton_status = 'disabled';
}

echo '

        <div class="hero">
            <div class="hero-body u-center">

                <div class="content"><br/>

                <h1 class="u-text-center">The <span class="tag tag--link text-light">PHP</span> Times</h1>
                <p class="u-text-center">Your newspaper - '.$date = date('l \t\h\e jS\, Y', time()).'</p>
                <div class="divider"></div>

<div class="row">
    <div class="col-10">
        <h2>'.$maintitle.'</h2>
    </div>
    <div class="col-2">
    <a href="edit.php?id='.$newsService->getNewId().'">
    <button class="btn-small btn-primary" '.$buton_status.'>Add newspiece</button>
    </a>
    </div>
</div>

            
            
';

$i = 1;	// Mysql auto-increment starts on 1, sorry
foreach ($news as $newspiece) {

	if($i == 1){	//For the first newspiece we display it on full width
		echo '
				<div class="row">
					<div class="col-12">';
	}else{
		if($i % 2 == 0){	//For the rest we open a row 1 every 2 newspieces
			echo '
				<div class="row">';
		}
		echo '
					<div class="col-6">';	//Half width newspiece
	}

		echo '
						<div class="card slide-up">
	                        <div class="card-head">
	                            <p class="card-head-title">'.$newspiece->title.'</p>

	                        </div>
	                        <div class="card-container">
	                            <a href="newspiece.php?id='.$newspiece->id.'">
	                            <div class="card-image" style="background-image: url('.$newspiece->picture.')"></div>
	                            </a>
	                        </div>
	                        <div class="mobile-title">
	                            <div class="content">
	                                <div class="tile tile--center">
	                                    <div class="tile__icon">
	                                        <figure class="avatar">
	                                            <img src="'.$newspiece->picture.'" alt="picture">
	                                        </figure>
	                                    </div>
	                                    
	                                    <div class="tile__container">
	                                        <a href="newspiece.php?id='.$newspiece->id.'"><p class="tile__title">'.$newspiece->title.'</p></a>
	                                        <p class="tile__subtitle">Categories: <a href="index.php?category='.$newspiece->category.'"><span class="tag tag--link text-light">'.$newspiece->category.'</span></a> </p>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="card-body content">
	                            <p>'.substr($newspiece->summary, 0, 128).'...</p>
	                            <a href="newspiece.php?id='.$newspiece->id.'"><button class="btn-info btn-animated">Read more<i class="fa-wrapper fa fa-chevron-right pad-left "></i></button></a>
	                        </div>
	                        <div class="card-footer content">
	                            '.$newspiece->datetime.'
	                        </div>
	                    </div> <!-- card slide-up -->';

	echo '
					</div> <!-- col -->';

		if($i % 2 == 1){		//We have to close the row
			echo '
				</div> <!-- row -->';
		}




	$i++;
}

if($i % 2 == 1){	// Close the row if not closed yet ($i have just been incremented)
	echo '
				</div> <!-- row -->';
}

	echo '
			</div>	<!-- content -->
        </div>	<!-- hero-body -->
    </div>	<!-- hero -->
	';

require 'includes/footer.php';