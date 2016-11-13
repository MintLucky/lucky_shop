<?php

class AdminProductController extends AdminBase
{
    /**
     *  Action Для страницы "Управление товарами"
     */
    public function actionIndex()
    {
        self::checkAdmin();

        // Получаем список товаров
        $productsList = Product::getProductsList();

        require_once (ROOT . '/views/admin_product/index.php');
        return true;
    }

    /**
    * Action для страницы "Удалить товар"
    */
    public function actionDelete($id)
    {
        self::checkAdmin();

        // Обработка формы
        if(isset($_POST['submit'])) {
            // Если форма отправлена удаляем товар
            Product::deleteProductById($id);

            // Перенаправляем пользователя на страницу управления товарами
            header("Location: /admin/product");
        }

        require_once (ROOT .'/views/admin_product/delete.php');
        return true;
    }

    /**
     * Action для страницы "Добавить товар"
     */
    public function actionCreate()
    {
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $categoriesList = Category::getCategoriesListAdmin();
        $options = [];
        $options['title'] = '';
        $options['code'] = '';
        $options['price'] = '';
        $options['id_catalog'] = '';
        $options['mark'] = '';
        $options['availability'] = '';
        $options['description'] = '';
        $options['is_new'] = '';
        $options['is_recommended'] = '';
        $options['status'] = '';

        // Обработка формы
        if(isset($_POST['submit'])) {
            // Если форма отправлена получаем данные формы
            $options['title'] = $_POST['title'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['id_catalog'] = $_POST['id_catalog'];
            $options['mark'] = $_POST['mark'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            
            // Флаг ошибок в форме
            $errors = false;

            // Валидация полей
            if(!isset($options['title']) || empty($options['title'])) {
                $errors[] = 'Заполните поле с именем товара';
            }

            if ($errors == false) {
                $id = Product::createProduct($options);

                // Если запись добавлена
                if($id) {
                    // Проверим, загружалось ли через форму изображение
                    if(is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папку, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                    }
                }

                // Перенаправляем пользователя на страницу управления товарами
                header("Location: /admin/product");
            }
        }

        require_once (ROOT .'/views/admin_product/create.php');
        return true;
    }


    /**
     * Action для страницы "Редактировать товар"
     */
    public function actionUpdate($id)
    {
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $categoriesList = Category::getCategoriesListAdmin();

        // Получаем данные о конкретном товаре
        $product = Product::getProductByID($id);

        $options = [];
        $options['title'] = '';
        $options['code'] = '';
        $options['price'] = '';
        $options['id_catalog'] = '';
        $options['mark'] = '';
        $options['availability'] = '';
        $options['description'] = '';
        $options['is_new'] = '';
        $options['is_recommended'] = '';
        $options['status'] = '';

        // Обработка формы
        if(isset($_POST['submit'])) {
            // Если форма отправлена получаем данные формы
            $options['title'] = $_POST['title'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['id_catalog'] = $_POST['id_catalog'];
            $options['mark'] = $_POST['mark'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // Валидация полей
            if(!isset($options['title']) || empty($options['title'])) {
                $errors[] = 'Заполните поле с именем товара';
            }

            if ($errors == false) {
                if (Product::updateProductById($id, $options)) {



                    // Проверим, загружалось ли через форму изображение
                    if(is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папку, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                    }
                }

                // Перенаправляем пользователя на страницу управления товарами
                header("Location: /admin/product");
            }
        }

        require_once (ROOT .'/views/admin_product/update.php');
        return true;
    }


}