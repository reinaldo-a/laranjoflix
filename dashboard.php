<?php 

    require_once("templates/header.php");
    require_once("dao/MovieDAO.php");
    require_once("models/Movie.php");

    // instantiating objects
    $movieData = new Movie;
    $userDao = new UserDAO($conn, $BASE_URL);
    $movieDao = new MovieDAO($conn, $BASE_URL);


    /* checking validity of the user's token, if it is not valid the user will be redirected to carry out something */
    if(!empty($_SESSION["token"])) {

        $userData = $userDao->findByToken(true);

    } else {
        $message->setMessage("É nescessario realizar login.", "error", "login.php");
    }

    // user movie search 
    $movies = $movieDao->findByUsers_id($userData->id);

?>

    <!-- Checking whether the user has films registered to be shown, if not, the user will be redirected to add a new film -->
    <?php if(!empty($movies)): ?>
        <div class="Movies col-lg-12">
            <div class="trending__product">
                <div class="row">
                    <?php foreach($movies as $movieData): ?>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <a href="viewMovie.php?id=<?= $movieData->id ?>">
                                                <div class="product__item__pic set-bg" data-setbg="img/movies/<?= $movieData->image ?>" style="background-image: url(&quot;img/trending/trend-1.jpg&quot;);">
                                                    <div class="ep"><?= $movieData->length ?></div>
                                                    <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                                    <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                                </div>
                                            </a>
                                            <div>
                                                <a href="<?= $BASE_URL ?>/editmovie.php?id=<?= $movieData->id ?>"><i class="fa fa-edit">Editar</i></a>
                                                <form action="movie_process.php" method="POST">
                                                    <input type="hidden" name="type" value="delete">
                                                    <input type="hidden" name="id" value="<?= $movieData->id ?>">
                                                    <button type="submit" class="delete-btn">
                                                    <i class="fa fa-trash"></i> Deletar
                                                    </button>
                                                </form>
                                                <h5><a href="viewMovie.php?id=<?= $movieData->id ?>"><?= $movieData->title ?></a></h5>
                                            </div>
                                        </div>
                                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p>Você não possui nenhum filme, <a href="<?= $BASE_URL ?>/newMovie.php">click aq para add um novo filme.</a></p>
    <?php endif; ?>
<?php 
    require_once("templates/footer.php");
?>