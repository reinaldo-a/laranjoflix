<?php 
    require_once("templates/header.php");

    if($userData) {
        $message->setMessage("Você já está logado.", "error", "index.php");
    }
?>
    <section class="normal-breadcrumb set-bg" data-setbg="<?= $BASE_URL ?>/img/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Conecte-se</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Section Begin -->
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Conecte-se</h3>
                        <form action="user_process.php" method="POST">
                            <input type="hidden" name="type" value="login">
                            <div class="input__item">
                                <input type="email" placeholder="Email" name="email" required>
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" placeholder="Senha" name="password" required>
                                <span class="icon_lock"></span>
                            </div>
                            <button type="submit" class="site-btn">Entrar</button>
                        </form>
                        <a href="#" class="forget_pass">Esqueceu sua senha?</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                        <h3>Não está cadastrado?</h3>
                        <a href="<?= $BASE_URL ?>/register.php" class="primary-btn">cadastre-se</a>
                    </div>
                </div>
            </div>
            <div class="login__social">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="login__social__links">
                            <span>ou</span>
                            <ul>
                                <li><a href="#" class="facebook"><i class="fa fa-facebook"></i> Sign in With
                                Facebook</a></li>
                                <li><a href="#" class="google"><i class="fa fa-google"></i> Sign in With Google</a></li>
                                <li><a href="#" class="twitter"><i class="fa fa-twitter"></i> Sign in With Twitter</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Section End -->

    <?php 
        require_once("templates/footer.php");
    ?>