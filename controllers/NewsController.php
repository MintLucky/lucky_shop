<?php

class NewsController
{
    public function actionIndex($page = 1)
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        $newsList = array();
        $newsList = News::getNewsList(News::SHOW_BY_DEFAULT, $page);

        $total = News::getTotalNewsCount();

        $pagination = new Pagination($total, $page, News::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT .'/views/news/index.php');

        return true;
    }

    public function actionView($id)
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        if ($id) {
            $newsItem = News::getNewsItemById($id);

            require_once(ROOT .'/views/news/view.php');

        }
        
        return true;
    }
}