<?php 
    require_once("templates/header.php");
    require_once("dao/MovieDAO.php");
    require_once("dao/ReviewDAO.php");
    require_once("models/Movie.php");

    // instantiating objects
    $movieData = new Movie;
    $message = new Message($BASE_URL);  
    $userDao = new UserDAO($conn, $BASE_URL);
    $user = new User;
    $movieDao = new MovieDAO($conn, $BASE_URL);
    $reviewDao = new ReviewDAO($conn, $BASE_URL);

    /* checking validity of the user's token, if it is not valid the user will be redirected to carry out something */
    if(!empty($_SESSION["token"])) {

        $userData = $userDao->findByToken(true);

    } else {
        $message->setMessage("É necessario fazer login!", "error", "login.php ");
    }

    //getting movie id
    $id = filter_input(INPUT_GET, "id");

    //searching for movie data
    $movieData = $movieDao->findById($id);
    
    //looking for movie review
    $reviews = $reviewDao->findByMovieId($movieData->id);

    //var_dump($reviews);exit;


?>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./categories.html">Categories</a>
                        <span>Romance</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="img/movies/<?= $movieData->image ?>">
                            <div class="comment"><i class="fa fa-comments"></i> 11</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3><?= $movieData->title ?></h3>
                            </div>
                            <div class="anime__details__rating">
                                <div>
                                    <div class="rating estrelas-static nota-3">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <span>1.029 Votes</span>
                            </div>
                            <div class="scroll_description">
                                <p> <?= $movieData->description ?></p>
                            </div>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <ul>
                                            <li><span>Avaliação:</span> 8.5 / 161 times</li>
                                            <li><span>Qualidade:</span> <?= $movieData->quality ?></li>
                                            <li><span>Visualisções:</span> 131,541</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Lançamento</span><?= $movieData->date ?></li>
                                            <li><span>Genero:</span><?= $movieData->category ?></li>
                                            <li><span>Duração:</span> <?= $movieData->length ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <a href="#" class="follow-btn"><i class="fa fa-heart-o"></i> Follow</a>
                                <a href=" <?= $movieData->link ?> ?>" class="watch-btn"><span>Link para Dowload</span> <i
                                    class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="anime__details__review">
                            <div class="section-title">
                                <h5>Avaliações</h5>
                            </div>
                            <div class="scroll_eview">
                                <?php foreach($reviews as $review): ?>
                                    <?php $userReview = $userDao->findById($review->user_id); ?>
                                    <div class="anime__review__item">
                                        <div class="anime__review__item__pic">
                                            <img src="img/users/<?= $userReview->image ?>" alt="">
                                        </div>
                                        <div class="anime__review__item__text">
                                            <h6><?= $user->getFullName($userReview) ?> - <span>1 Hour ago</span></h6>
                                            <!-- Exibir nota armazenada -->
                                            <div>
                                                <div class="estrelas-static nota-<?= $review->rating ?>">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p> <?= $review->review ?></p>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                        <div class="anime__details__form">
                            <div class="section-title">
                                <h5>FAÇA SUA AVALIAÇÃO</h5>
                            </div>
                            <form action="review_process.php" method="POST">
                                <input type="hidden" name="type" value="review">
                                <input type="hidden" name="user_id" value="<?= htmlspecialchars($userData->id) ?>">
                                <input type="hidden" name="movie_id" value="<?= htmlspecialchars($movieData->id) ?>">
                                <div class="estrelas">
                                <input type="radio" id="cm_star-empty" name="rating" value="" checked/>
                                    <label for="cm_star-1"><i class="fa fa-star"></i></label>
                                    <input type="radio" id="cm_star-1" name="rating" value="1"/>
                                    <label for="cm_star-2"><i class="fa fa-star"></i></label>
                                    <input type="radio" id="cm_star-2" name="rating" value="2"/>
                                    <label for="cm_star-3"><i class="fa fa-star"></i></label>
                                    <input type="radio" id="cm_star-3" name="rating" value="3"/>
                                    <label for="cm_star-4"><i class="fa fa-star"></i></label>
                                    <input type="radio" id="cm_star-4" name="rating" value="4"/>
                                    <label for="cm_star-5"><i class="fa fa-star"></i></label>
                                    <input type="radio" id="cm_star-5" name="rating" value="5"/>
                                </div>
                                <textarea placeholder="Escreva seu comentáro" name="createReview"></textarea>
                                <button type="submit"><i class="fa fa-location-arrow"></i> Enviar</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="anime__details__sidebar">
                            <div class="section-title">
                                <h5>you might like...</h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-1.jpg">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">Boruto: Naruto next generations</a></h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-2.jpg">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">The Seven Deadly Sins: Wrath of the Gods</a></h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-3.jpg">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">Sword art online alicization war of underworld</a></h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-4.jpg">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">Fate/stay night: Heaven's Feel I. presage flower</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Anime Section End -->
<?php 
    require_once("templates/footer.php");
?>