<?php

class CartController
{
    /**
     * Action для добавления товара в корзину (не используется, оставлен на всякий случай)
     */
    public function actionAdd($id)
    {
        if($id)
        {
            // Добавляем товар в корзину
            Cart::addProduct($id);

            // Возвращаем пользователя на страницу
            $referrer = $_SERVER['HTTP_REFERER'];
            header("Location: $referrer");
        }
    }

    /**
     * Action для добавления товара в корзину с помощью Ajax(используется)
     */
    public function actionAddAjax($id)
    {
        // По умолчанию количство добавляемых товаров = 1
        $count = 1;

        if($id)
        {
            // Если передается параметр с количством добавляемых товаров записываем его в
            // $count вместо параметров по умолчанию
            if(isset($_POST['count'])) {
                $count = $_POST['count'];
            }
            // Добавляем товар в корзину
            echo Cart::addProduct($id, $count);

            return true;
        }
    }

    /**
     * Action для страницы "Корзина"
     */
    public function actionIndex()
    {   
        
        $categories = [];
        $categories = Category::getCategoriesList();
        
        // Получим данные из корзины
        $productsInCart = Cart::getProducts();
        
        
        if($productsInCart) {
            // Получаем полную информацию о товарах
            $productIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productIds);
            
            // Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }
        
        require_once (ROOT .'/views/cart/index.php');
        
        return true;
    }

    /**
     * Action для полной очистки корзины
     */
    public function actionClean()
    {
        Cart::cleanCart();
        
        header("Location: /cart/index/");
    }


    /**
     * Action для страницы оформления заказа
     */
    public function actionCheckout()
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        // Статус успешного оформления заказа
        $result = false;


        $productsInCart = Cart::getProducts();
        $productsIds = array_keys($productsInCart);
        $products = Product::getProductsByIds($productsIds);
        $totalPrice = Cart::getTotalPrice($products);
        $totalQuantity = Cart::countItems();
        
        // Отправлена ли форма?
        if(isset($_POST['submit'])) {
            // Да отправлена

            // Считываем данные формы
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];

            // Валидация полей
            $errors = [];
            if (!User::checkName($userName))
                $errors[] = 'Неправильное имя';
            if (!User::checkPhone($userPhone))
                $errors[] = 'Укажите корректный номер телефона';


            // Форма заполнена корректно?
            if ($errors == false) {
                // Да корректно
                // Сохраняем заказ в базе данных

                // Собираем информацию о заказе
                $productsInCart = Cart::getProducts();
                if (User::isGuest()) {
                    $userId = false;
                } else {
                    $userId = User::checkLogged();
                }

                // Сохраняем заказ в БД
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                if($result) {
                    // Отправляем администратору email о заказе
                    $adminEmail = 'only4jobmail@gmail.com';
                    $message = 'Новый заказ на сайте' .$_SERVER['SERVER_NAME']. 'Зайдите в админпанель сайта для просмотра детальной информации';
                    $subject = 'Новый заказ на сайте'.$_SERVER['SERVER_NAME'];
                    mail($adminEmail, $subject, $message);

                    // Очищаем корзину
                    Cart::cleanCart();
                }
            }
        }
        
        // Форма не отправлена
        else {

            // Получаем данные из корзины
            $productsInCart = Cart::getProducts();

            // Есть ли товары в корзине?
            if ($productsInCart == false) {
                // В корзине нет товаров, перенаправляем пользователя на главную
                header("Location: /");
            }
            else {
                // В корзине есть товары

                // Итоги: общая стоимость, количество товаров

                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();

                $userName = false;
                $userPhone = false;
                $userComment = false;

                // Пользователь авторизован?
                if(User::isGuest()) {
                    // Нет. Значения для формы пустые
                }
                else {
                    // Да авторизован. Получаем инфориацию о пользователе из БД по id
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);

                    // Подставляем в форму
                    $userName = $user['name'];
                }
            }
        }

        require_once (ROOT .'/views/cart/checkout.php');
    }

    /**
     * Action для удаления конкретного товара из корзины
     */    
    public function actionDelete($id)
    {
        if($id) {
            Cart::deleteProduct($id);
        }
        header("Location: /cart/index/");
    }

    
}