<?php include ROOT . '/views/layouts/header.php'; ?>

    <section class="height-screen">
        <div class="container background-hat">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-4">
                    <?php if (isset($errors) && is_array($errors)):?>
                        <?php foreach($errors as $error): ?>
                            <ul>
                                <li class="red"> - <?php echo $error; ?> </li>
                            </ul>
                        <?php endforeach; ?>
                    <?php endif;?>
                    <div class="signup-form"><!--sign up form-->
                        <h2>Вход на сайт</h2>
                        <form action="#" method="post">
                            <input type="email" name="email" placeholder="E-mail" value="<?php echo $email;?>"/>
                            <input type="password" name="password" placeholder="Пароль" value="<?php echo $password;?>"/>
                            <input type="submit" name="submit" class="btn btn-default" value="Вход" />
                        </form>
                    </div><!--/sign up form-->
                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>