<?php
// core configuration
include_once "config/core.php";

// set page title
$page_title = "Login";

// include login checker
$require_login = false;
include_once "login_checker.php";

// include classes
include_once "config/database.php";
include_once "objects/user.php";
include_once "libs/php/pw-hashing/passwordLib.php";

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$access_denied = false;

// if the login form was submitted
if ($_POST) {
    // check if email and password are in the database
    $user->email = $_POST['email'];

    // check if email exists, also get user details using this emailExists() method
    $email_exists = $user->emailExists();

    // validate login
    if ($email_exists && password_verify($_POST['password'], $user->password) && $user->status == 1) {
        
        

        // if it is, set the session value to true
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user->id;
        $_SESSION['access_level'] = $user->access_level;
        $_SESSION['firstname'] = htmlspecialchars($user->firstname, ENT_QUOTES, 'UTF-8');
        $_SESSION['lastname'] = $user->lastname;

        // if access level is 'Admin', redirect to admin section
        if ($user->access_level == 'Admin') {
            header("Location: {$home_url}admin/index.php?action=login_success");
        }

        // else, redirect only to 'Customer' section
        else {
            header("Location: {$home_url}index.php?action=login_success");
        }
    }

    // if username does not exist or password is wrong
    else {
        $access_denied = true;
    }
}

$action = isset($_GET['action']) ? $_GET['action'] : "";

if ($access_denied) {
    $outPut = "<div class=\"alert alert-danger margin-top-40\" role=\"alert\">Access Denied.<br /><br />Your username or password maybe incorrect </div>";
} else {
    switch ($action) {
        case "email_verified":
            $outPut = "<div class='alert alert-success'><strong>Your email was verified. Thank you!</strong> Please login.</div>";
            break;
        case 'not_yet_logged_in':
            $outPut = "<div class=\"alert alert-danger margin-top-40\" role=\"alert\">Please login.</div>";
            break;
        case 'please_login':
            $outPut = "<div class='alert alert-info'><strong>Please login to access that page.</strong></div>";
            break;
    }
}

?>