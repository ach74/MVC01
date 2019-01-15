<?php
include_once 'MVC/login_controlador.php';
include_once "layout_head.php";

?>
<div class="col-sm-6 col-md-4 col-md-offset-4">
    
    <?php
    echo $outPut;
    ?>

    <!-- actual HTML login form -->
    <div class="account-wall">
        <div id="my-tab-content" class="tab-content">
            <div class="tab-pane active" id="login">
                <img class="profile-img" src="images/login-icon.png">
                <form class="form-signin" action="login" method="post">
                    <input type="text" name="email" class="form-control" placeholder="Email" required autofocus />
                    <input type="password" name="password" class="form-control" placeholder="Password" required />
                    <input type="submit" class="btn btn-lg btn-primary btn-block" value="Log In" />
                </form>
            </div>

            <!-- give user other options -->
            <div style='text-align:center;'>
                <a href='<?php echo $home_url; ?>register'>Sign up</a> • <a href='<?php echo $home_url; ?>forgot_password'>Forgot password?</a>
            </div>

        </div>
    </div>
</div>

<?php
// footer HTML and JavaScript codes
include_once "layout_foot.php";
?>
