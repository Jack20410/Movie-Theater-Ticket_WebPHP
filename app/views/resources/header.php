<?php
session_start();
$error = "";

if (isset($_SESSION["error"]) && $_SESSION["error"] !="") {
    $error = $_SESSION["error"];
    $email = $_SESSION["email"];
    unset($_SESSION['error']);
    unset($_SESSION['email']);
}

?>

<!-- Header start -->
<div class="container-fluid " >
        <nav class="navbar fixed-top navbar-expand-lg nav-header" style="font-weight:700;">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li><a class="text-white navbar-brand" style="margin-left: 20px;" href="../resources/index.php">Online Movie Booking</a></li>
            </ul>
            <span>
                <ul class="navbar-nav me-auto mt-2 mt-lg-0 nav-header" >

                    <?php if(isset($_SESSION['email'])){ ?>
                    <li class="nav-item right">
                    <a class="nav-link text-white header-item active" 
                        style="margin-right: 20px;" href="#">My ticket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white header-item"
                        style="margin-right: 20px;" href="logout.php" >Log out</a></li>
                    <?php } else { ?>
                    <li class="nav-item">
                        <a id="login" class="nav-link text-white header-item"
                        style="margin-right: 20px;" href="#" data-bs-toggle="modal" data-bs-target="#login_dialog">Log in</a></li>
                        <?php } ?>
                </ul>
            </span>
        </nav>
    </div>
    <!-- Login/SignUp dialog -->

    <?php include 'loginSignup.php' ?>