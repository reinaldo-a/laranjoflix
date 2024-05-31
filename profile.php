<?php 
    require_once("templates/header.php");

?>
    <!-- Start of registration section -->
    <section class="login spad">
        <div class="container">
            <div class="row" id="register">
                <div class="col-lg-6">
                    <div class="login__form register">
                        <h3><?= $userData->name ?></h3>
                        <form action="user_process.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="edit">
                            <input type="hidden" name="image" value="<?= $userData->image ?>">
                            <input type="hidden" name="id" value="<?= $userData->id ?>">
                            <div class="input__item">
                            <input name="name" type="text" placeholder="Nome" value="<?= $userData->name ?>" required>
                            <span class="icon_profile"></span>
                            </div>
                            <div class="input__item">
                                <input name="lastname" type="text" placeholder="Sobrenome" value="<?= $userData->lastname ?>" required>
                                <span class="icon_profile"></span>
                            </div>
                            <div class="input__item">
                                <input name="email" type="email" placeholder="Email" value="<?= $userData->email ?>" required>
                                <span class="icon_mail"></span>
                            </div>
                            <button type="submit" class="site-btn">Editar</button>
                        </div>
                    </div>
                    <div class="col-lg-6 img">
                        <?php if(!empty($userData->image)): ?>
                            <a href="<?= $BASE_URL ?>/profile.php"><img id="profile-image-container" src="<?= $BASE_URL ?>/img/users/<?= $userData->image ?>" alt="user image"></a>
                        <?php else: ?>
                            <a href="<?= $BASE_URL ?>/profile.php"><span class="icon_profile"></span></a>
                        <?php endif; ?>
                        <input type="file" name="image" id="image">
                    </div>
                </form>
                <div class="col-lg-6">
                    <div class="login__form register">
                        <form action="user_process.php" method="post">
                            <input type="hidden" name="type" value="editPassword">
                            <input type="hidden" name="id" value="<?= $userData->id ?>">
                            <div class="input__item">
                                <input name="password" type="password" placeholder="Senha" required>
                                <span class="icon_lock"></span>
                            </div>
                            <div class="input__item">
                                <input name="confirmPassword" type="password" placeholder="Confirma senha" required>
                                <span class="icon_lock"></span>
                            </div>
                            <button type="submit" class="site-btn">Editar</button>
                        </form>
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