<!-- Upcomming start -->
<div class="container">
                    <div class="home-title">
                        <h2 class="text-white" id="home-title">Up comming movies</h2>
                    </div>
                <div class=" row now-show-poster">
                    <?php 
                        if ($film_upcoming) {
                            foreach ($film_upcoming as $u) {
                                $name = $u['name'];
                                $genre = $u['genre'];
                                $age = $u['age'];
                                $sub = $u['sub'];
                                $release_date = $u['release_date'];
                                $timeline = $u['timeline'];
                                $trailer = $u['trailer'];
                                $image = $u['image'];
                                ?>

                            <div class="col-3 card">
                                <img class="card-img-top" src="../assets/images/Poster/<?= ($image) ?>" alt="<?= ($name) ?>">
                                <div class="description">
                                    <p class="title"><?= ($name) ?></p>
                                    <div class="sub-strict">
                                        <img class="strict" src="../assets/images/strict/<?= ($age) ?>" alt="<?= ($age) ?>">
                                        <p class="sub"><?= ($sub) ?></p>
                                    </div>
                                    <p class="duration"><?= ($timeline) ?> </p>
                                    
                                </div>
                            </div>
                        <?php
                    }
                }
                ?>
            </div>
            </div>
<!-- Upcomming end -->