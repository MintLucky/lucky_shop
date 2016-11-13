<?php include ROOT . '/views/layouts/header.php'; ?>

    <section class="height-screen">
        <div class="container background-hat-2">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-4">
                    <?php if (isset($result) && ($result)) : ?>
                        <h2 class="margin-bottom-20">Данные успешно отредактированы!</h2>
                    <?php else: ?>
                        <?php if (isset($errors) && is_array($errors)):?>
                            <?php foreach($errors as $error): ?>
                                <li class="red"> - <?php echo $error; ?> </li>
                            <?php endforeach; ?>
                        <?php endif;?>
                        <div class="signup-form"><!--sign up form-->
                            <h2>Редактирование личных данных</h2>
                            <form action="#" method="post">
                                <input type="text" name="name" placeholder="Имя" value="<?php echo $user['name'];?>"/>
                                <input type="password" name="password" placeholder="Пароль" value="<?php echo $user['password'];?>"/>
                                <input type="submit" name="submit" class="btn btn-default" value="Отредактировать" />
                            </form>
                        </div><!--/sign up form-->
                        <br/>
                        <br/>
                    <?php endif; ?>
                </div>

            </div>
            <a href="/cabinet/" class="btn btn-default back margin-bottom-20"><i class="fa fa-arrow-left"></i> Назад</a>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>