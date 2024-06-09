<?php 
    require_once("templates/header.php");

    //If the user is already logged in they will be redirected
    if($userData) {
        $message->setMessage("Você já está logado. Para criar uma nova conta, por favor, saia da sua conta atual primeiro.", "error", "index.php");
    }
    
?>
    <!-- Start of registration section -->
    <section class="login spad">
        <div class="container">
            <div class="row" id="register">
                <div class="col-lg-6">
                    <div class="login__form register">
                        <h3>Registre-se</h3>
                        <form action="user_process.php" method="POST">
                            <input type="hidden" name="type" value="register">
                            <div class="input__item">
                            <input name="name" type="text" placeholder="Nome" required>
                            <span class="icon_profile"></span>
                            </div>
                            <div class="input__item">
                                <input name="lastname" type="text" placeholder="Sobrenome" required>
                                <span class="icon_profile"></span>
                            </div>
                            <div class="input__item">
                                <input name="email" type="email" placeholder="Email" required>
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input name="password" type="password" placeholder="Senha" required>
                                <span class="icon_lock"></span>
                            </div>
                            <div class="input__item">
                                <input name="confirmPassword" type="password" placeholder="Confirma senha" required>
                                <span class="icon_lock"></span>
                            </div>
                            <button type="submit" class="site-btn">Registrar</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                        <h3>Já tem uma conta?</h3>
                        <a href="<?= $BASE_URL ?>/login.php" class="primary-btn">Entrar</a>
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