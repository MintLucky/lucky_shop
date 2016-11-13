<?php

class AdminOrderController extends AdminBase
{
    /**
     *  Action Для страницы "Управление заказами"
     */
    public function actionIndex()
    {
        self::checkAdmin();

        // Получаем список товаров
        $ordersList = Order::getOrdersList();
        
        require_once (ROOT . '/views/admin_order/index.php');
        return true;
    }


    /**
     * Action для страницы "Просмотреть информацию о заказе"
     */

    public function actionView($id)
    {
        self::checkAdmin();

        // Получаем информацию о заказе
        $order = Order::getOrderById($id);
        
        // Получаем информацию о товарах в заказе
        $productsQuantity = $order['products'];
        $productsQuantity = json_decode($productsQuantity, 1);

        $productsIds = array_keys($productsQuantity);

        $products = Product::getProductsByIds($productsIds);
        
        
        require_once (ROOT . '/views/admin_order/view.php');
        return true;
    }

    /**
     * Action для страницы "Удалить заказ"
     */
    public function actionDelete($id)
    {
        self::checkAdmin();

        // Обработка формы
        if(isset($_POST['submit'])) {
            // Если форма отправлена удаляем товар
            Order::deleteOrderById($id);

            // Перенаправляем пользователя на страницу управления товарами
            header("Location: /admin/order");
        }

        require_once (ROOT .'/views/admin_order/delete.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать заказ"
     */
    public function actionUpdate($id)
    {
        self::checkAdmin();

        // Получаем данные о конкретной категории
        $order = Order::getOrderById($id);


        // Обработка формы
        if(isset($_POST['submit'])) {
            // Если форма отправлена получаем данные формы
            $options = [];
            $options['user_name'] = $_POST['userName'];
            $options['user_phone'] = $_POST['userPhone'];
            $options['user_comment'] = $_POST['userComment'];
            $options['date'] = $_POST['date'];
            $options['status'] = $_POST['status'];

            Order::updateOrderById($id, $options);
            
            // Перенаправляем пользователя на страницу управления товарами
            header("Location: /admin/order");
            
        }

        require_once (ROOT .'/views/admin_order/update.php');
        return true;
    }
}