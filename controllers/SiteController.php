<?php

class SiteController
{
    public function actionIndex()
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        $latestProducts = [];
        $latestProducts = Product::getLatestProducts(6);

        $recommendedProducts = [];
        $recommendedProducts = Product::getRecommendedProducts();

        require_once(ROOT . '/views/site/index.php');

        return true;
    }

    public function actionContact()
    {
        $userEmail = '';
        $userText = '';
        $result = false;

        if (isset($_POST['submit'])) {

            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            $errors = false;

            if(!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }

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
    
    public static function actionAbout()
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        $recommendedProducts = [];
        $recommendedProducts = Product::getRecommendedProducts();
        
        require_once(ROOT . '/views/site/about.php');

        return true;
    }

    
}