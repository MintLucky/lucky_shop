<?php

class UserController
{
    /**
     *  Action для страницы регистрации пользователя
     */
    public function actionRegister()
    {
        // Переменные для формы
        $name = '';
        $email = '';
        $password = '';
        
        
        // Обрабатываем форму
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;
            
            // Валидация полей формы
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 3-х символов';
            }

            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if (User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже используется';
            }
            
            
            // Если ошибок нет регистрируем пользователя
            if ($errors == false) {
                $result = User::register($name, $email, $password);
            }
        }

        require_once (ROOT .'/views/user/register.php');

        return true;
    }

    /**
     *  Action для страницы авторизации пользователя
     */
    public function actionLogin()
    {
        $email = '';
        $password = '';

        // Обрабатываем форму
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];


            $errors = false;
            
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            // Проверяем существует ли пользователь
            $userId = (User::checkUserData($email, $password));

            if ($userId == false) {
                $errors[] = 'Неправильный email и/или пароль';
            }
            else {
                // Если данные правильные запоминаем пользователя
                User::auth($userId);

                header("Location: /cabinet/");
            }
            
        }

        require_once (ROOT .'/views/user/login.php');

        return true;
    }

    /**
     *  Action для выхода залогиненного пользователя 
     */
    public function actionLogout()
    {
        unset($_SESSION["user"]);
        header("Location: /");
    }


    /**
     *  Action Для страницы редактирования профиля пользователя
     */
    public function actionEdit()
    {
        $name = '';
        $password = '';

        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];
            
            
            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 3-х символов';
            }
            

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            

            if ($errors == false) {
                $result = User::edit($name, $password, $userId);
            }

        }
        require_once (ROOT .'/views/cabinet/edit.php');

        return true;
    }


    /**
     *  Action для страницы просмотра истории заказов пользователя
     */
    public function actionHistory()
    {
        // Получаем информацию о пользователе
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        
        // Получаем список заказов пользователя
        $ordersList = Order::getOrdersListByUserId($userId);

        require_once (ROOT .'/views/cabinet/history.php');

        return true;
    }


    /**
     *  Action для страницы просмотра информации о конкретном заказе 
     *  пользователем в его истории заказов
     */
    public function actionViewOrder($orderId)
    {
        $orderId = intval($orderId);

        // Получаем информацию о заказе
        $order = Order::getOrderById($orderId);

        // Получаем информацию о товарах в заказе
        $productsQuantity = $order['products'];
        $productsQuantity = json_decode($productsQuantity, 1);
        $productsIds = array_keys($productsQuantity);
        $products = Product::getProductsByIds($productsIds);

        require_once (ROOT .'/views/cabinet/view.php');

        return true;

    }
}