<?php

class CatalogController
{
    /**
     * Action для страницы "Каталог товаров"
     */
    public function actionIndex($page = 1)
    {
        // Список категорий для левого меню
        $categories = [];
        $categories = Category::getCategoriesList();
        
        // Список последних товаров
        $latestProducts = [];
        $latestProducts = Product::getLatestProducts(Product::SHOW_BY_DEFAULT, $page);

        // Общее количество товаров (для пагинации)
        $total = Product::getTotalProductsCount();
        
        // пагинация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/catalog/index.php');

        return true;
    }


    /**
     * Action для страницы определенной категории товаров
     */
    public function actionCategory($categoryId, $page = 1)
    {

        // Список категорий для левого меню
        $categories = [];
        $categories = Category::getCategoriesList();
            
        // Получаем имя категории
        $categoryName = Category::getCategoriesNameById($categoryId);
        
        // Получаем все товары категории
        $categoryProducts = [];
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);
            
        $total = Product::getTotalProductsInCategory($categoryId);
                        
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/catalog/category.php');

        return true;
    }

}