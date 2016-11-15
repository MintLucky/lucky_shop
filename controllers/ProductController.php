<?php

class ProductController
{
    /**
     * Action для страницы определенного товара
     */
    public function actionView($productId)
    {
        // Список категорий для левого меню
        $categories = [];
        $categories = Category::getCategoriesList();
        
        // Получаем информацию о конкретном товаре
        $product = Product::getProductByID($productId);

        include (ROOT. '/views/product/view.php');
        return true;
    }
    
}