<?php
session_start();
session_destroy();

require 'includes/header.php';

echo '
<div class="hero fullscreen">
            <div class="hero-body">
                <div class="content">


';

	echo '

<div class="toast toast--info">
    <button class="btn-close"></button>
    <p><b>Info:</b> Logged out, redirecting...</p>
</div>

';

echo '<meta http-equiv="refresh" content="2;url=index.php" />
<p style="text-align:center">Click <a href="index.php">here</a> if you are not automatically redirected.</p>
				<br><br><br><br>
                </div>
            </div>
        </div>
';

require 'includes/footer.php';
