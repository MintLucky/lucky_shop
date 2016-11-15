<?php

class SiteController
{
    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {
        // Список категорий для левого меню
        $categories = [];
        $categories = Category::getCategoriesList();
        
        // Список последних товаров
        $latestProducts = [];
        $latestProducts = Product::getLatestProducts(6);

        // Список рекомендуемых товаров (товаров для слайдера)
        $recommendedProducts = [];
        $recommendedProducts = Product::getRecommendedProducts();

        require_once(ROOT . '/views/site/index.php');

        return true;
    }

    /**
     * Action для страницы "Контакты"
     */
    public function actionContact()
    {
        $userEmail = '';
        $userText = '';
        $result = false;
        
        // Обрабатываем форму
        if (isset($_POST['submit'])) {

            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            $errors = false;
            
            // Валидация
            if(!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }
            
            // Если ошибок нет - отправляем письмо на нужный email
            if ($errors == false) {
                $adminEmail = 'only4jobmail@gmail.com';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Сообщение с сайта  '. $_SERVER['SERVER_NAME'];
                $result = mail($adminEmail, $subject, $message);
                $result = true;
                
            }
        }

        require_once(ROOT . '/views/site/contacts.php');

        return true;
    }

    /**
     * Action для страницы "О магазине"
     */
    public static function actionAbout()
    {
        // Список категорий для левого меню
        $categories = [];
        $categories = Category::getCategoriesList();

        // Список рекомендуемых товаров (товаров для слайдера)
        $recommendedProducts = [];
        $recommendedProducts = Product::getRecommendedProducts();
        
        require_once(ROOT . '/views/site/about.php');

        return true;
    }

    
}