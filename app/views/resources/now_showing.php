
<!-- Now showing start -->
<div class="container">
        <!-- Now showing title -->
        <div class="home-title">
            <h2 class="text-white" id="home-title">Now showing</h2>
        </div>
        <!-- Showing available movies -->
        <div class="row now-show-poster">
            <?php 
            if ($film_available) {
                foreach ($film_available as $p) {
                    $name = $p['name'];
                    $genre = $p['genre'];
                    $age = $p['age'];
                    $sub = $p['sub'];
                    $release_date = $p['release_date'];
                    $timeline = $p['timeline'];
                    $trailer = $p['trailer'];
                    $image = $p['image'];
                    $id = $p['id']; 
                    ?>
                        <div class="col-3 card">
                            <img class="card-img-top" src="../assets/images/Poster/<?= ($image) ?>" alt="<?= ($name) ?>">
                            <div class="description">
                                <p class="title"><?= ($name) ?></p>
                                <div class="sub-strict">
                                    <img class="strict" src="../assets/images/strict/<?= ($age) ?>" alt="<?= ($age) ?>">
                                    <p class="sub"><?= ($sub) ?></p>
                                </div>
                                <p class="release"><?= ($release_date) ?> </p>
                                <p class="duration"><?= ($timeline) ?> </p>
                                <button class="text-black buy-ticket" type="submit"><a href="../pages/booking.php?id=<?= $id;?>"
                                style="text-decoration: none; color: black">Booking</a></button>
                                <button id="<?= $id ?>" class="text-black view-trailer"><a href="../pages/detail.php?id=<?= $id;?>"
                                style="text-decoration: none; color: black">Details</a></button>
                            </div>
                        </div>
                    <?php
                }
            }
            ?>
        </div>
        </div>
        <!-- Now showing end -->