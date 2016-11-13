<?php include ROOT . '/views/layouts/header.php'; ?>

    <section class="height-screen">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Каталог</h2>
                        <div class="panel-group category-products">
                            <?php foreach ($categories as $categoryItem): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="/category/<?php echo $categoryItem['id'];?>">
                                                <?php echo $categoryItem['title'];?>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <h2 class="title text-center">Корзина</h2>

                        <?php if ($productsInCart): ?>
                            <p>Вы выбрали такие товары:</p>
                            <table class="table-bordered table-striped table">
                                <tr>
                                    <th>Название</th>
                                    <th>Марка производителя</th>
                                    <th>Количество, шт</th>
                                    <th>Стоимость $</th>
                                    <th>Удалить</th>
                                </tr>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td>
                                            <a href="/product/<?php echo $product['id'];?>">
                                                <?php echo $product['title'];?>
                                            </a>
                                        </td>
                                        <td><?php echo $product['mark'];?></td>
                                        <td><?php echo $product['price'];?></td>
                                        <td><?php echo $productsInCart[$product['id']];?></td>
                                        <td>
                                            <a class="btn btn-default checkout" href="/cart/delete/<?php echo $product['id'];?>">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="3">Общая стоимость:</td>
                                    <td><strong><?php echo $totalPrice;?> $</strong></td>
                                </tr>

                            </table>

                            <a class="btn btn-default checkout" href="/cart/checkout"><i class="fa fa-shopping-cart"></i> Оформить заказ</a>

                            <a href="/cart/clean/" class="btn btn-primary unset-button pull-right margin-bottom-20">Очистить корзину</a>

                        <?php else: ?>
                            <h4>Корзина пуста</h4>

                            <a class="btn btn-default checkout margin-bottom-20" href="/"><i class="fa fa-shopping-cart"></i> Вернуться к покупкам</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>