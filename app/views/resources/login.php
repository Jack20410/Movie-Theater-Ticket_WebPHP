<?php
require_once('users_db.php');


    $error = '';
    $l_email = '';
    $l_password = '';

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $l_email = $_POST['email'];
        $l_password = $_POST['password'];

        if (empty($l_email)) {
            $error = 'Please enter your email';
        }
        else if (empty($l_password)) {
            $error = 'Please enter your password';
        }
        else if (strlen($l_password) < 6) {
            $error = 'Password must have at least 6 characters';
        }
        else if (login($l_email, $l_password)) {
            // success
            $_SESSION['email'] = $l_email;
            header('Location: index.php');
            exit();
        }else {
            $error = 'Invalid email or password';
        }
    }

?>
<div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab" tabindex="0">
    <h4 class="modal-title text-center">Log In</h4>
        <form action="" method="post">
            <div class="form-group mt-3 ">
                <label for="Email">Email</label>
                <input type="text" name="email" placeholder="Email" class="form-control text-black" id="email" value="<?= $l_email?>"/>
            </div>
            
            <div class="form-group mt-3 mb-3">
                <label for="name">Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control" id="password" value="<?= $l_password?>"/>
            </div>
            <?php
                if (!empty($error)) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }?>

            <div class="login-section">
                <button name="submit" id="login-submit" type="submit" class="btn btn-success mt-3 mb-3" data-dismiss="modal">Log in</button>
            </div>
        </form>
</div>