<?php
session_start();
require_once(__DIR__ . '/../../models/Database.php');

$success_message = '';
if (isset($_SESSION['signup_success'])) {
    $success_message = $_SESSION['signup_success'];
    unset($_SESSION['signup_success']);
}
?>

<!-- Auth Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="loginModalLabel">Login / Sign Up</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-fill mb-3" id="authTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active text-white" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-tab-pane" type="button" role="tab">Login</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-white" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup-tab-pane" type="button" role="tab">Sign Up</button>
                    </li>
                </ul>

                <!-- Success Message -->
                <?php if (!empty($success_message)): ?>
                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php endif; ?>

                <!-- Tab content -->
                <div class="tab-content" id="authTabContent">
                    <!-- Login Tab -->
                    <div class="tab-pane fade show active" id="login-tab-pane" role="tabpanel">
                        <form id="loginForm" method="post">
                            <div class="mb-3">
                                <label for="loginEmail" class="form-label">Email</label>
                                <input type="email" class="form-control bg-dark text-light" id="loginEmail" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">Password</label>
                                <input type="password" class="form-control bg-dark text-light" id="loginPassword" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>

                    <!-- Sign Up Tab -->
                    <div class="tab-pane fade" id="signup-tab-pane" role="tabpanel">
                        <form id="signupForm" method="post">
                            <div class="mb-3">
                                <label for="signupName" class="form-label">Name</label>
                                <input type="text" class="form-control bg-dark text-light" id="signupName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="signupEmail" class="form-label">Email</label>
                                <input type="email" class="form-control bg-dark text-light" id="signupEmail" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="signupPassword" class="form-label">Password</label>
                                <input type="password" class="form-control bg-dark text-light" id="signupPassword" name="password" required minlength="6">
                            </div>
                            <div class="mb-3">
                                <label for="signupConfirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control bg-dark text-light" id="signupConfirmPassword" name="re_pass" required minlength="6">
                            </div>
                            <button type="submit" class="btn btn-success w-100">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User Dropdown (shown when logged in) -->
<div class="dropdown d-none" id="userDropdown">
    <button class="btn btn-dark dropdown-toggle" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <span id="userName"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="userMenuButton">
        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#" id="logoutButton">Logout</a></li>
    </ul>
</div>

<!-- Auth Button (shown when logged out) -->
<button class="btn btn-outline-light" id="authButton" data-bs-toggle="modal" data-bs-target="#loginModal">
    Login / Sign Up
</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle form submissions
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');
    const loginModal = document.getElementById('loginModal');
    const authButton = document.getElementById('authButton');
    const userDropdown = document.getElementById('userDropdown');
    const userName = document.getElementById('userName');
    const logoutButton = document.getElementById('logoutButton');

    loginForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(loginForm);
        formData.append('action', 'login');
        
        try {
            const response = await fetch('/auth.php', {
                method: 'POST',
                body: formData
            });
            
            const rawResponse = await response.text();
            console.log('Raw login response:', rawResponse);

            let data;
            try {
                data = JSON.parse(rawResponse);
            } catch (parseError) {
                console.error('JSON parse error:', parseError);
                throw new Error('Server returned invalid response');
            }
            
            if (data.success) {
                // Hide modal and update UI
                bootstrap.Modal.getInstance(loginModal).hide();
                authButton.classList.add('d-none');
                userDropdown.classList.remove('d-none');
                userName.textContent = data.user.name;
                
                // Store user data
                localStorage.setItem('user', JSON.stringify(data.user));
                // Redirect to home page
                window.location.href = '/';
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error('Login error:', error);
            alert('An error occurred during login. Please try again.');
        }
    });

    signupForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(signupForm);
        formData.append('action', 'signup');
        
        try {
            const response = await fetch('/Movie-Theater-Ticket_WebPHP/public/auth.php', {
                method: 'POST',
                body: formData
            });
            
            const rawResponse = await response.text();
            console.log('Raw signup response:', rawResponse);

            let data;
            try {
                data = JSON.parse(rawResponse);
            } catch (parseError) {
                console.error('JSON parse error:', parseError);
                throw new Error('Server returned invalid response');
            }
            
            if (data.success) {
                // Show success message and switch to login tab
                alert('Account created successfully! Please login.');
                document.getElementById('login-tab').click();
                signupForm.reset();
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error('Signup error:', error);
            alert('An error occurred during signup. Please try again.');
        }
    });

    // Handle logout
    logoutButton.addEventListener('click', async function(e) {
        e.preventDefault();
        console.log('Logout button clicked');
        
        try {
            const formData = new FormData();
            formData.append('action', 'logout');

            const response = await fetch('/Movie-Theater-Ticket_WebPHP/public/auth.php', {
                method: 'POST',
                body: formData
            });

            // Log the raw response for debugging
            const rawResponse = await response.text();
            console.log('Raw logout response:', rawResponse);

            // Try to parse the response as JSON
            let data;
            try {
                data = JSON.parse(rawResponse);
            } catch (parseError) {
                console.error('JSON parse error:', parseError);
                throw new Error('Server returned invalid response');
            }

            console.log('Logout response:', data);
            
            if (data.success) {
                // Update UI
                userDropdown.classList.add('d-none');
                authButton.classList.remove('d-none');
                localStorage.removeItem('user');
                // Redirect to home page
                window.location.href = '/Movie-Theater-Ticket_WebPHP/';
            } else {
                throw new Error(data.message || 'Logout failed');
            }
        } catch (error) {
            console.error('Logout error:', error);
            alert('An error occurred during logout. Please try again.');
        }
    });

    // Check if user is logged in on page load
    const user = JSON.parse(localStorage.getItem('user'));
    if (user) {
        authButton.classList.add('d-none');
        userDropdown.classList.remove('d-none');
        userName.textContent = user.name;
    }
});
</script> 