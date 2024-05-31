<?php 
    require_once("templates/header.php");
    require_once("models/Movie.php");
    require_once("dao/MovieDAO.php");

    $userDao = new UserDAO($conn, $BASE_URL);
    $movieDao = new MovieDAO($conn, $BASE_URL);
    $movieData = new Movie;

    if(!empty($_SESSION["token"])) {
        $userData = $userDao->findByToken(true);
    }

    $id = filter_input(INPUT_GET, "id");

    $movieData = $movieDao->findById($id);
?>
    <section class="normal-breadcrumb set-bg" data-setbg="<?= $BASE_URL ?>/img/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Editar Filme</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="login spad">
        <div class="container">
            <form action="movie_process.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="edit">
                <input type="hidden" name="image" value="<?= $movieData->image ?>">
                <input type="hidden" name="id" value="<?= $movieData->id ?>">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="login__form">
                            <h3>Editar Filme.</h3>
                            <div class="input__item">
                                <input type="text" placeholder="Titulo" name="title" value="<?= $movieData->title ?>">
                            </div>
                            <div class="input__item">
                                <input type="text" placeholder="Duração" name="length" value="<?= $movieData->length ?>">
                            </div>
                            <div class="input__item">
                                <select name="quality">
                                    <option value="<?= $movieData->quality ?>" selected><?= $movieData->quality ?></option>
                                    <option value="SD">SD</option>
                                    <option value="HD">HD</option>
                                    <option value="Full HD">Full HD</option>
                                    <option value="4K">4K</option>
                                </select>
                            </div>
                            <div class="input__item">
                                <select name="category">
                                    <option value="<?= $movieData->category ?>" selected><?= $movieData->category ?></option>
                                    <option value="Ação">Ação</option>
                                    <option value="Comédia">Comédia</option>
                                    <option value="Drama">Drama</option>
                                    <option value="Fantasia">Fantasia</option>
                                    <option value="Terror">Terror</option>
                                </select>
                            </div>
                            <div class="input__item">
                                <input type="text" placeholder="Link para dowload" name="link" value="<?= $movieData->link ?>">
                            </div>
                            <div class="input__item">
                                <input type="date" placeholder="Data de lançamento" name="date" value="<?= $movieData->date ?>">
                            </div>
                            <textarea name="description" placeholder="Descrição"><?= $movieData->description ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="login__register">
                            <h3>Mudae imagem.</h4>
                            <div class="product__item__pic set-bg col-lg-6" data-setbg="img/movies/<?= $movieData->image ?>" style="background-image: url(&quot;img/trending/trend-1.jpg&quot;);">
                            </div>
                            <input type="file" name="image">
                        </div>
                        <div>
                        </div>
                    </div>
                    <button type="submit" class="site-btn">Editar</button>
                </div>
            </form>
        </div>
    </section>
<?php 
    require_once("templates/footer.php");
?>