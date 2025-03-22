<?php

require_once("users_db.php");

?>

<!-- Log in / Sign up modal -->
<div class="modal fade" id="login_dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
           
            <div class="modal-body signin-modal">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-login-tab" data-bs-toggle="tab" data-bs-target="#nav-login" 
                      type="button" role="tab" aria-controls="nav-login" aria-selected="true">Log In</button>
                      <button class="nav-link" id="nav-signup-tab" data-bs-toggle="tab" data-bs-target="#nav-signup" 
                      type="button" role="tab" aria-controls="nav-signup" aria-selected="false">Sign Up</button>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
<!--****************************** Login ******************************-->
                    <?php include'login.php' ?>
<!--****************************** End login ******************************-->

<!-- ******************************Sign up ******************************-->
                    <?php include'signup.php' ?>
<!-- ******************************End Sign up ******************************-->
                  </div>
            </div>
        </div>
        </div>
    </div>