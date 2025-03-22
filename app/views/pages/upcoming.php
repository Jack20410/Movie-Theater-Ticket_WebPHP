<?php
require_once('../models/Database.php');

// Get upcoming movies
$db = new \App\Models\Database();
$upcoming = $db->query("SELECT * FROM film_upcoming ORDER BY release_date ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Theater - Coming Soon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../movies.php">Movie Theater</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../movies.php">Now Showing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="upcoming.php">Coming Soon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="theaters.php">Theaters</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">Sign Up</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <h2 class="mb-4 text-white">Coming Soon</h2>
        <div class="row">
            <?php if ($upcoming && $upcoming->num_rows > 0): ?>
                <?php while ($movie = $upcoming->fetch_assoc()): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <img src="/images/Poster/<?= htmlspecialchars($movie['image']) ?>" 
                                 class="card-img-top" 
                                 alt="<?= htmlspecialchars($movie['name']) ?>"
                                 style="height: 400px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-white"><?= htmlspecialchars($movie['name']) ?></h5>
                                <p class="card-text">
                                    <small class="text-muted">
                                        Genre: <?= htmlspecialchars($movie['genre']) ?><br>
                                        Duration: <?= htmlspecialchars($movie['timeline']) ?><br>
                                        Release Date: <?= date('d M Y', strtotime($movie['release_date'])) ?>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center text-white">No upcoming movies.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-6">
                    <h5>Movie Theater</h5>
                    <p>Your ultimate destination for movie entertainment.</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="../movies.php" class="text-white">Movies</a></li>
                        <li><a href="theaters.php" class="text-white">Theaters</a></li>
                        <li><a href="contact.php" class="text-white">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                        <li>Email: info@movietheater.com</li>
                        <li>Phone: (123) 456-7890</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center py-3 border-top">
            <p class="mb-0">&copy; <?= date('Y') ?> Movie Theater. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 