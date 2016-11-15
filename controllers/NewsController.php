<?php

class NewsController
{
    /**
     * Action для страницы всех новостей
     */
    public function actionIndex($page = 1)
    {
        // Список категорий для левого меню
        $categories = [];
        $categories = Category::getCategoriesList();
        
        // Получаем массив информации всех новостей
        $newsList = array();
        $newsList = News::getNewsList(News::SHOW_BY_DEFAULT, $page);
        
        // Общее количество новостей (для пагинации)
        $total = News::getTotalNewsCount();

        $pagination = new Pagination($total, $page, News::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT .'/views/news/index.php');

        return true;
    }

    /**
     * Action для определенной страницы новости
     */
    public function actionView($id)
    {
        // Список категорий для левого меню
        $categories = [];
        $categories = Category::getCategoriesList();
        
        // Получаем информации определенной новости
        if ($id) {
            $newsItem = News::getNewsItemById($id);

            require_once(ROOT .'/views/news/view.php');

        }
        
        return true;
    }
}