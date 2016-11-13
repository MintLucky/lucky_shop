<?php

//include_once ROOT .'/models/Category.php';
//include_once ROOT .'/models/Product.php';

class BlogController
{
    public function actionIndex()
    {
        require_once(ROOT . '/views/blog/index.php');

        return true;
    }
}