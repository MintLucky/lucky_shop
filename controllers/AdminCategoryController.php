<?php

class AdminCategoryController extends AdminBase
{
    /**
     *  Action Для страницы "Управление категориями"
     */
    public function actionIndex()
    {
        self::checkAdmin();

        // Получаем список товаров
        $categoriesList = Category::getCategoriesListAdmin();

        require_once (ROOT . '/views/admin_category/index.php');
        return true;
    }

    /**
     * Action для страницы "Удалить категорию"
     */
    public function actionDelete($id)
    {
        self::checkAdmin();

        // Обработка формы
        if(isset($_POST['submit'])) {
            // Если форма отправлена удаляем категорию
            Category::deleteCategoryById($id);

            // Перенаправляем пользователя на страницу управления категориями
            header("Location: /admin/category");
        }

        require_once (ROOT .'/views/admin_category/delete.php');
        return true;
    }

    /**
     * Action для страницы "Добавить категорию"
     */
    public function actionCreate()
    {
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $categoriesList = Category::getCategoriesListAdmin();
        $options = [];
        $options['title'] = '';
        $options['status'] = '';
        $options['sort_order'] = '';

        // Обработка формы
        if(isset($_POST['submit'])) {
            // Если форма отправлена получаем данные формы
            $options['title'] = $_POST['title'];
            $options['status'] = $_POST['status'];
            $options['sort_order'] = $_POST['sort_order'];
            
            // Флаг ошибок в форме
            $errors = false;

            // Валидация полей
            if(!isset($options['title']) || empty($options['title'])) {
                $errors[] = 'Заполните поле с именем категории';
            }

            if ($errors == false) {
                Category::createCategory($options);

                // Перенаправляем пользователя на страницу управления товарами
                header("Location: /admin/category");
            }
        }

        require_once (ROOT .'/views/admin_category/create.php');
        return true;
    }


    /**
     * Action для страницы "Редактировать категорию"
     */
    public function actionUpdate($id)
    {
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $categoriesList = Category::getCategoriesListAdmin();

        // Получаем данные о конкретной категории
        $category = Category::getCategoryByID($id);

        $options = [];
        $options['title'] = '';
        $options['status'] = '';
        $options['sort_order'] = '';

        // Обработка формы
        if(isset($_POST['submit'])) {
            // Если форма отправлена получаем данные формы
            $options['title'] = $_POST['title'];
            $options['status'] = $_POST['status'];
            $options['sort_order'] = $_POST['sort_order'];

            // Флаг ошибок в форме
            $errors = false;

            // Валидация полей
            if(!isset($options['title']) || empty($options['title'])) {
                $errors[] = 'Заполните поле с именем категории';
            }

            if ($errors == false) {
                Category::updateCategoryById($id, $options);

                // Перенаправляем пользователя на страницу управления товарами
                header("Location: /admin/category");
            }
        }

        require_once (ROOT .'/views/admin_category/update.php');
        return true;
    }


}