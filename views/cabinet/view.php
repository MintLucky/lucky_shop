<?php include ROOT . '/views/layouts/header.php'; ?>

    <section class="height-screen-admin">
        <div class="container">
            <div class="row">

                <br/>

                <h4>Просмотр заказа #<?php echo $order['id']; ?></h4>
                <br/>

                <h5>Информация о заказе</h5>
                <table class="table-admin-small table-bordered table-striped table">
                    <tr>
                        <td>Указанное имя</td>
                        <td><?php echo $order['user_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Указанный номер телефона</td>
                        <td><?php echo $order['user_phone']; ?></td>
                    </tr>
                    <tr>
                        <td>Комментарий к заказу</td>
                        <td><?php echo $order['user_comment']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Статус заказа</b></td>
                        <td><?php echo Order::getStatusText($order['status']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Дата заказа</b></td>
                        <td><?php echo $order['date']; ?></td>
                    </tr>
                </table>

                <h5>Товары в заказе</h5>

                <table class="table-admin-medium table-bordered table-striped table">
                    <tr>
                        <th>ID товара</th>
                        <th>Артикул товара</th>
                        <th>Производитель</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Количество</th>
                    </tr>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><?php echo $product['code']; ?></td>
                            <td><?php echo $product['mark']; ?></td>
                            <td><a href="/product/<?php echo $product['id']; ?>"> <?php echo $product['title']; ?></a></td>
                            <td>$<?php echo $product['price']; ?></td>
                            <td><?php echo $productsQuantity[$product['id']]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <a href="/cabinet/history/" class="btn btn-default back margin-bottom-20"><i class="fa fa-arrow-left"></i> Назад</a>
            </div>


    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>