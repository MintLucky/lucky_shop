<?php

class CatalogController
{
    
    public function actionIndex($page = 1)
    {
        
        $categories = [];
        $categories = Category::getCategoriesList();

        $latestProducts = [];
        
        $latestProducts = Product::getLatestProducts(Product::SHOW_BY_DEFAULT, $page);
        
        $total = Product::getTotalProductsCount();

        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/catalog/index.php');

        return true;
    }

    public function actionCategory($categoryId, $page = 1)
        {

        $categories = [];
        $categories = Category::getCategoriesList();
            
        $categoryName = Category::getCategoriesNameById($categoryId);
            
        $categoryProducts = [];
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);
            
        $total = Product::getTotalProductsInCategory($categoryId);
                        
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/catalog/category.php');

        return true;
    }


}