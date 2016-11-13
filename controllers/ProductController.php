<?php
//include_once(ROOT .'/models/Category.php');
//include_once(ROOT .'/models/Product.php');

class ProductController
{

    public function actionView($productId)
    {
        $categories = [];
        $categories = Category::getCategoriesList();
        
        $product = Product::getProductByID($productId);

        include (ROOT. '/views/product/view.php');
        return true;
    }
    
}