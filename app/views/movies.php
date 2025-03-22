<?php
// The $showing and $upcoming variables are now passed from the controller
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Theater</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <?php
    ob_start();
    ?>

    <!-- Carousel Section -->
    <div class="container-fluid p-0">
        <div id="movieCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3000">
                    <img src="/images/Carousel/1.jpg" 
                         class="d-block w-100" 
                         alt="First slide">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="/images/Carousel/2.jpg" 
                         class="d-block w-100" 
                         alt="Second slide">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="/images/Carousel/3.jpg" 
                         class="d-block w-100" 
                         alt="Third slide">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#movieCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#movieCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Now Showing Section -->
        <section class="mb-5">
            <div class="home-title">
                <h2 class="text-white" id="home-title">Now showing</h2>
            </div>
            <div class="row g-4">
                <?php if ($showing && $showing->num_rows > 0): ?>
                    <?php while ($movie = $showing->fetch_assoc()): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card h-100">
                                <img class="card-img-top" src="/images/Poster/<?= htmlspecialchars($movie['image']) ?>" alt="<?= htmlspecialchars($movie['name']) ?>">
                                <div class="description">
                                    <div class="movie-header">
                                        <p class="title"><?= htmlspecialchars($movie['name']) ?></p>
                                        <img class="strict" src="/images/strict/<?= htmlspecialchars($movie['age']) ?>" alt="<?= htmlspecialchars($movie['age']) ?>">
                                    </div>
                                    <p class="sub"><?= htmlspecialchars($movie['sub']) ?></p>
                                    <p class="release"><?= htmlspecialchars($movie['release_date']) ?></p>
                                    <p class="duration"><?= htmlspecialchars($movie['timeline']) ?></p>
                                    <button class="buy-ticket" type="submit">
                                        <a href="pages/booking.php?id=<?= $movie['id'] ?>" style="text-decoration: none; color: white">Booking</a>
                                    </button>
                                    <button class="view-trailer">
                                        <a href="pages/detail.php?id=<?= $movie['id'] ?>" style="text-decoration: none; color: white">Details</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="text-center text-white">No movies currently showing.</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Upcoming Movies Section -->
        <section class="mb-5">
            <div class="home-title">
                <h2 class="text-white" id="home-title">Coming Soon</h2>
            </div>
            <div class="row g-4">
                <?php if ($upcoming && $upcoming->num_rows > 0): ?>
                    <?php while ($movie = $upcoming->fetch_assoc()): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card h-100">
                                <img class="card-img-top" src="/images/Poster/<?= htmlspecialchars($movie['image']) ?>" alt="<?= htmlspecialchars($movie['name']) ?>">
                                <div class="description">
                                    <div class="movie-header">
                                        <p class="title"><?= htmlspecialchars($movie['name']) ?></p>
                                        <img class="strict" src="/images/strict/<?= htmlspecialchars($movie['age']) ?>" alt="<?= htmlspecialchars($movie['age']) ?>">
                                    </div>
                                    <p class="sub"><?= htmlspecialchars($movie['sub']) ?></p>
                                    <p class="genre"><?= htmlspecialchars($movie['genre']) ?></p>
                                    <p class="duration"><?= htmlspecialchars($movie['timeline']) ?></p>
                                    <p class="release">Release Date: <?= date('d M Y', strtotime($movie['release_date'])) ?></p>
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
        </section>
    </div>

    <?php
    $content = ob_get_clean();
    require_once __DIR__ . '/layouts/main.php';
?>

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
                        <li><a href="movies.php" class="text-white">Movies</a></li>
                        <li><a href="pages/theaters.php" class="text-white">Theaters</a></li>
                        <li><a href="pages/contact.php" class="text-white">Contact Us</a></li>
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