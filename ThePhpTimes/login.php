<?php
session_start();
require 'includes/header.php';

if (!isset($_SESSION["user"])) {
  echo '
<div class="hero fullscreen">
            <div class="row u-no-padding">
                <div class="col-6 u-no-padding level">
                    <div class="u-text-left w-100">
                        <div class="content">
                            <h4>Login in The PHP Times</h4>
                            <h6 class="font-alt">Nice to see you again 👋</h6>

                            <div class="divider"></div>

                            <form action="doLogin.php" method="POST" class="form-signin">
                            <div class="form-section">
                                <label>Username</label>
                                <div class="input-control">
                                    <input class="input-contains-icon" placeholder="Username" name="username" type="text" required value="">
                                    <span class="icon">
                                        <i class="far fa-wrapper fa-envelope-open small"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-section">
                                <label>Password</label>
                                <div class="input-control">
                                    <input class="input-contains-icon" id="password" name="password" placeholder="Password" type="password" required value="">
                                    <span class="icon">
                                        <i class="fas fa-wrapper fa-key small"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-ext-control form-ext-checkbox">
                                <input id="check1" class="form-ext-input" type="checkbox">
                                <label class="form-ext-label" for="check1">Remember me</label>

                                <div class="u-pull-right">
                                    <a href="signup.php">Create new account</a>
                                </div>
                            </div>

                            <div class="form-section u-text-right">
                                <div class="btn-container u-inline-block">
                                    <button class="btn-info">
                                        Login
                                    </button>
                                </div>
                                <div class="btn-container u-inline-block">
                                    <button class="btn-light">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6 u-no-padding">
                    <div class="h-100" style="background: url(img/login.jpg); background-size: cover; background-position: center; box-shadow: inset 5px 0px 9px 1px #00000017; min-height: 300px;">
                    </div>
                </div>
            </div>
        </div>
  ';
} else {
  header("Location: index.php");
  exit;
}



require 'includes/footer.php';