<?php 
    require_once("templates/header.php");
    require_once("models/Movie.php");

    $movieData = new Movie;
    $userDao = new UserDAO($conn, $BASE_URL);

    if(!empty($_SESSION["token"])) {

       // $userData = $userDao->findByToken(true);

    } else {
        $message->setMessage("É nescessario realizar login.", "error", "login.php");
    }
?>
    <section class="normal-breadcrumb set-bg" data-setbg="<?= $BASE_URL ?>/img/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Adicione um Filme</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="login spad">
        <div class="container">
            <form action="movie_process.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="create">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="login__form">
                            <h3>Adicione um Filme.</h3>
                            <div class="input__item">
                                <input type="text" placeholder="Titulo" name="title" required>
                            </div>
                            <div class="input__item">
                                <input type="text" placeholder="Duração" name="length" required>
                            </div>
                            <div class="input__item">
                                <select name="quality" required>
                                    <option value="" disabled selected>Qualidade</option>
                                    <option value="SD">SD</option>
                                    <option value="HD">HD</option>
                                    <option value="Full HD">Full HD</option>
                                    <option value="4K">4K</option>
                                </select>
                            </div>
                            <div class="input__item">
                                <select name="category" required>
                                    <option value="" disabled selected>Categoria</option>
                                    <option value="Ação">Ação</option>
                                    <option value="Comédia">Comédia</option>
                                    <option value="Drama">Drama</option>
                                    <option value="Fantasia">Fantasia</option>
                                    <option value="Terror">Terror</option>
                                </select>
                            </div>
                            <div class="input__item">
                                <input type="text" placeholder="Link para dowload" name="link" required>
                            </div>
                            <div class="input__item">
                                <input type="date" placeholder="Data de lançamento" name="date" required>
                            </div>
                            <textarea name="description" placeholder="Descrição"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="login__register">
                            <h3>Escola uma imagem.</h4>
                            <input type="file" name="image">
                        </div>
                        <div>
                        </div>
                    </div>
                    <button type="submit" class="site-btn">Adicionar</button>
                </div>
            </form>
        </div>
    </section>
<?php 
    require_once("templates/footer.php");
?>