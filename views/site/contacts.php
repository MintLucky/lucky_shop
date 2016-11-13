<?php include ROOT . '/views/layouts/header.php'; ?>

    <section class="height-screen">
        <div class="container background">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-4">

                    <?php if ($result): ?>
                        <h2 class="background-white padding-20">Сообщение отправлено! Мы ответим Вам на указанный email.</h2>
                    <?php else: ?>
                        <?php if (isset($errors) && is_array($errors)): ?>
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li class="red"> - <?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <div class="signup-form"><!--sign up form-->
                            <h2>Обратная связь</h2>
                            <h5>Есть вопрос? Напишите нам</h5>
                            <br/>
                            <form action="#" method="post">
                                <p>Ваша почта</p>
                                <input type="email" name="userEmail" placeholder="E-mail" value="<?php echo $userEmail; ?>"/>
                                <p>Сообщение</p>
                                <textarea rows="7" class="margin-bottom-20" name="userText" placeholder="Сообщение" value="<?php echo $userText; ?>"></textarea></textarea>
                                <br/>
                                <input type="submit" name="submit" class="btn btn-default" value="Отправить" />
                            </form>
                        </div><!--/sign up form-->
                    <?php endif; ?>

                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>