<?php
return array (

    'product/([0-9]+)' => 'product/view/$1', // actionView   in  ProductController
    'catalog/page-([0-9]+)' => 'catalog/index/$1',   // actionIndex  in  CatalogController
    'catalog'         => 'catalog/index',   // actionIndex  in  CatalogController
    'category/([0-9]+)/page-([0-9]+)'=> 'catalog/category/$1/$2',
    'category/([0-9]+)'=> 'catalog/category/$1',

    // Новости
    'news/index/page-([0-9]+)'  => 'news/index/$1',
    'news/([0-9]+)'       => 'news/view/$1',
    'news/index'          => 'news/index',


    // Корзина
    'cart/index'            => 'cart/index',
    'cart/clean'            => 'cart/clean',
    'cart/add/([0-9]+)' => 'cart/add/$1',
    'cart/checkout'       => 'cart/checkout',
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    'cart/delete/([0-9]+)' => 'cart/delete/$1',
//    'cart/deleteAjax/([0-9]+)'  => 'cart/deleteAjax/$1',


    'contacts'          =>     'site/contact',
    'about'             =>     'site/about',

    // Пользователь:
    'user/register'  =>  'user/register',
    'user/login'     =>  'user/login',
    'user/logout'    =>  'user/logout',
    'cabinet/edit'   =>  'user/edit',
    'cabinet/history/order/([0-9]+)' => 'user/viewOrder/$1',
    'cabinet/history' => 'user/history',
    'cabinet'        =>  'cabinet/index',

    // Управление товарами:
    'admin/product/create'  => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',

    // Управление категориями:
    'admin/category/create'  => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',

    // Управление заказами:
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)'   => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',
    
    // Управление новостями
    'admin/news/create'   => 'adminNews/create',
    'admin/news/update/([0-9]+)' => 'adminNews/update/$1',
    'admin/news/delete/([0-9]+)' => 'adminNews/delete/$1',
    'admin/news'  => 'adminNews/index',

    // Админпанель:
    'admin'   =>   'admin/index',

    // Главная страница
    ''            =>  'site/index',
);