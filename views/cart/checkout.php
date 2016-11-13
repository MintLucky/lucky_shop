<?php include ROOT . '/views/layouts/header.php'; ?>

    <section xmlns="http://www.w3.org/1999/html" class="height-screen">
        <div class="container">
            <div class="row">

                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Каталог</h2>
                        <div class="panel-group category-products">

                            <?php foreach($categories as $category):?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a href="/category/<?php echo $category['id']?>" class="<?php if ($category['id']==$categoryId) echo 'active'?>"><?php echo $category['title']?></a></h4>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6">

                    <?php if (isset($result) && ($result)) : ?>
                        <h2 class="margin-bottom-20">Заказ успешно оформлен!</h2>
                        
                        
                    <?php else: ?>
                        <h4>Заказано товаров: <?php echo $totalQuantity;?> шт., на общую сумму: <?php echo $totalPrice;?> $</h4>
                        <br>
                        <p>Для оформления заказа заполните форму. Наш менеджер свяжется с Вами.</p>
                        <br>
                        <?php if (isset($errors) && is_array($errors)):?>
                            <?php foreach($errors as $error): ?>
                                <li class="red"> - <?php echo $error; ?> </li>
                            <?php endforeach; ?>
                        <?php endif;?>


                        <div class="signup-form"><!--sign up form-->
                            <h2>Оформление заказа</h2>
                            <form action="#" method="post">
                                <p>Ваше имя</p>
                                <input type="text" name="userName" placeholder="Имя" value="<?php echo $userName;?>"/>
                                <p>Номер телефона</p>
                                <input type="text" name="userPhone" placeholder="Телефон" value="<?php echo $userPhone;?>"/>
                                <p>Комментарии к заказу</p>
                                <textarea rows="7" class="margin-bottom-20" placeholder="Комментарий к заказу" name="userComment"><?php echo $userComment;?></textarea>
                                <input type="submit" name="submit" class="btn btn-default" value="Оформить" />
                            </form>
                        </div><!--/sign up form-->
                        <br/>
                        <br/>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>