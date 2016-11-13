<?php include ROOT . '/views/layouts/header.php'; ?>

    <section class="height-screen">
        <div class="container background-hat-2">
            <div class="row">

                <div class="col-sm-9 col-sm-offset-1">

                    <h2 class="margin-bottom-20">Ваша история заказов:</h2>

                    <?php if($ordersList!=null): ?>
                    <table class="table-bordered table-striped table">
                        <tr>
                            <th>Номер заказа</th>
                            <th>Указанное имя</th>
                            <th>Дата заказа</th>
                            <th>Количество заказанных товаров</th>
                            <th>Статус заказа</th>
                            <th>Просмотреть заказ</th>
                        </tr>
                        <?php foreach ($ordersList as $order): ?>
                            <tr>
                                <td class="text-center"><?php echo $order['id']; ?></td>
                                <td><?php echo $order['user_name']; ?></td>
                                <td><?php echo $order['date']; ?></td>
                                <td class="text-center"><?php echo Product::getProductsOrderCount($order['products']); ?></td>
                                <td ><?php echo Order::getStatusText($order['status']); ?></td>
                                <td class="text-center"><a href="/cabinet/history/order/<?php echo $order['id']; ?>" title="Просмотреть"><i class="fa fa-eye" aria-hidden="true"></i>
                                    </a></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <?php else :?>
                        <h3 class="margin-bottom-30">В Вашей истории заказов заказы отсутствуют</h3>
                        <a href="/cabinet/" class="btn btn-default back margin-bottom-20"><i class="fa fa-arrow-left"></i> Назад в личный кабинет</a>
                        <a href="/catalog/" class="btn btn-default back margin-bottom-20">Перейти к выбору товаров <i class="fa fa-arrow-right"></i></a>
                    <?php endif ;?>
                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>