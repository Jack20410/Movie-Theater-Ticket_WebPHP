<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Theater</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <style>
        /* Navbar styles */
        .navbar {
            background-color: rgba(18, 18, 18, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1030;
        }
        .navbar-brand {
            font-size: 1.5rem;
        }
        .nav-link {
            font-size: 1rem;
            padding: 0.5rem 1rem !important;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #007bff !important;
        }

        /* Auth Modal Styles */
        .modal-content {
            background-color: #1e1e1e;
            color: #fff;
        }

        .modal-header {
            border-bottom: 1px solid #333;
            padding: 1rem 1.5rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .nav-tabs {
            border-bottom: 1px solid #333;
        }

        .nav-tabs .nav-link {
            color: #fff;
        }

        .nav-tabs .nav-link.active {
            background-color: transparent;
            border-color: #0d6efd;
            color: #0d6efd;
        }

        .form-control {
            background-color: #2d2d2d;
            border-color: #444;
            color: #fff;
        }

        .form-control:focus {
            background-color: #2d2d2d;
            border-color: #0d6efd;
            color: #fff;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .form-label {
            color: #fff;
        }

        /* Fix modal backdrop */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1040;
        }

        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .modal {
            z-index: 1050;
        }
    </style>
</head>
<body>
    <!-- Include Navbar -->
    <?php include __DIR__ . '/../components/navbar.php'; ?>
    
    <!-- Main Content -->
    <main>
        <?php echo $content ?? ''; ?>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Bootstrap components
        const modalElement = document.getElementById('loginModal');
        const loginModal = modalElement ? new bootstrap.Modal(modalElement, {
            backdrop: 'static',
            keyboard: false
        }) : null;

        // Initialize all dropdowns
        const dropdownElementList = document.querySelectorAll('.dropdown-toggle');
        const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl));

        const loginTab = document.getElementById('login-tab');
        const signupTab = document.getElementById('signup-tab');
        const loginForm = document.getElementById('loginForm');
        const signupForm = document.getElementById('signupForm');
        const logoutBtn = document.getElementById('logoutBtn');

        // Function to show error message
        function showError(form, message) {
            clearMessages(form);
            const errorDiv = document.createElement('div');
            errorDiv.className = 'alert alert-danger mt-3';
            errorDiv.textContent = message;
            form.appendChild(errorDiv);
        }

        // Function to show success message
        function showSuccess(form, message) {
            clearMessages(form);
            const successDiv = document.createElement('div');
            successDiv.className = 'alert alert-success mt-3';
            successDiv.textContent = message;
            form.appendChild(successDiv);
        }

        // Function to clear form messages
        function clearMessages(form) {
            const alerts = form.querySelectorAll('.alert');
            alerts.forEach(alert => alert.remove());
        }

        // Function to handle form submission
        async function handleFormSubmit(form, action) {
            clearMessages(form);

            const formData = new FormData(form);
            formData.append('action', action);

            try {
                const response = await fetch('/Movie-Theater-Ticket_WebPHP/public/auth.php', {
                    method: 'POST',
                    body: formData
                });

                // Log the raw response for debugging
                const rawResponse = await response.text();
                console.log('Raw response:', rawResponse);

                // Try to parse the response as JSON
                let data;
                try {
                    data = JSON.parse(rawResponse);
                } catch (parseError) {
                    console.error('JSON parse error:', parseError);
                    throw new Error('Server returned invalid response');
                }

                console.log(`${action} response:`, data);

                if (data.success) {
                    showSuccess(form, data.message);
                    
                    if (action === 'login') {
                        // On successful login
                        setTimeout(() => {
                            if (loginModal) {
                                loginModal.hide();
                            }
                            window.location.href = '/Movie-Theater-Ticket_WebPHP/';
                        }, 1500);
                    } else if (action === 'signup') {
                        // On successful signup
                        setTimeout(() => {
                            form.reset();
                            if (loginTab) {
                                loginTab.click();
                            }
                        }, 1500);
                    }
                } else {
                    showError(form, data.message);
                }
            } catch (error) {
                console.error(`${action} error:`, error);
                showError(form, `An error occurred during ${action}. Please try again.`);
            }
        }

        // Handle login form submission
        if (loginForm) {
            loginForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                await handleFormSubmit(this, 'login');
            });
        }

        // Handle signup form submission
        if (signupForm) {
            signupForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                await handleFormSubmit(this, 'signup');
            });
        }

        // Handle logout
        if (logoutBtn) {
            logoutBtn.addEventListener('click', async function(e) {
                e.preventDefault();
                console.log('Logout button clicked'); // Debug log
                
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
                        window.location.href = '/Movie-Theater-Ticket_WebPHP/';
                    } else {
                        alert(data.message || 'Logout failed');
                    }
                } catch (error) {
                    console.error('Logout error:', error);
                    alert('An error occurred during logout. Please try again.');
                }
            });
        }

        // Handle tab switching
        if (loginTab && signupTab) {
            [loginTab, signupTab].forEach(tab => {
                tab.addEventListener('click', function() {
                    clearMessages(loginForm);
                    clearMessages(signupForm);
                });
            });
        }
    });
    </script>
</body>
</html> 