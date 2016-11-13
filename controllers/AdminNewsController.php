<?php

class AdminNewsController extends AdminBase
{
    /**
     *  Action Для страницы "Управление новостями"
     */
    public function actionIndex()
    {
        self::checkAdmin();

        // Получаем список товаров
        $newsList = News::getNewsListAdmin();

        require_once (ROOT . '/views/admin_news/index.php');
        return true;
    }

    /**
     * Action для страницы "Удалить новость"
     */
    public function actionDelete($id)
    {
        self::checkAdmin();

        // Обработка формы
        if(isset($_POST['submit'])) {
            // Если форма отправлена удаляем категорию
            News::deleteNewsById($id);

            // Перенаправляем пользователя на страницу управления категориями
            header("Location: /admin/news");
        }

        require_once (ROOT .'/views/admin_news/delete.php');
        return true;
    }

    /**
     * Action для страницы "Добавить новость"
     */
    public function actionCreate()
    {
        self::checkAdmin();

        $options['short_content'] = '';
        $options['content'] = '';
        $options['title'] = '';

        // Обработка формы
        if(isset($_POST['submit'])) {
            // Если форма отправлена получаем данные формы
            $options['title'] = $_POST['title'];
            $options['status'] = $_POST['status'];
            $options['short_content'] = $_POST['short_content'];
            $options['content'] = $_POST['content'];

            // Флаг ошибок в форме
            $errors = false;

            // Валидация полей
            if(!isset($options['title']) || empty($options['title'])) {
                $errors[] = 'Заполните поле с именем новости';
            }

            if ($errors == false) {
                $id = News::createNews($options);

                // Если запись добавлена
                if($id) {
                    // Проверим, загружалось ли через форму изображение
                    if(is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папку, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/news/{$id}.jpg");
                    }
                }

                // Перенаправляем пользователя на страницу управления товарами
                header("Location: /admin/news");
            }
        }

        require_once (ROOT .'/views/admin_news/create.php');
        return true;
    }


    /**
     * Action для страницы "Редактировать новость"
     */
    public function actionUpdate($id)
    {
        self::checkAdmin();
        
        // Получаем данные о конкретной новости
        $news = News::getNewsItemById($id);

        $options['short_content'] = '';
        $options['content'] = '';
        $options['title'] = '';
        $options['status'] = '';

        // Обработка формы
        if(isset($_POST['submit'])) {
            // Если форма отправлена получаем данные формы
            $options['title'] = $_POST['title'];
            $options['short_content'] = $_POST['short_content'];
            $options['content'] = $_POST['content'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // Валидация полей
            if(!isset($options['title']) || empty($options['title'])) {
                $errors[] = 'Заполните поле с именем новости';
            }

            if ($errors == false) {

//                var_dump( News::updateNewsItemById($id, $options));
//                die();
                if (News::updateNewsItemById($id, $options)) {
                    
                    // Проверим, загружалось ли через форму изображение
                    if(is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папку, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/news/{$id}.jpg");
                    }
                }

                // Перенаправляем пользователя на страницу управления товарами
                header("Location: /admin/news");
            }
        }

        require_once (ROOT .'/views/admin_news/update.php');
        return true;
    }


}