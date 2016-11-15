<?php

class Category
{
    /**
     * Возвращает массив категорий (для левого меню)
     * @return array
     */
    public static function getCategoriesList()
    {
        $db=DB::getConnection();

        $categoriesList = [];
        $result = $db->query('SELECT id, title FROM category ORDER BY sort_order ASC');

        $i = 0;
        while($row = $result->fetch())
        {
            $categoriesList[$i]['id'] = $row['id'];
            $categoriesList[$i]['title'] = $row['title'];
            $i++;
        }
        return $categoriesList;

    }

    /**
     * Возвращает массив категорий для админпанели
     * при этом в список попадаю как включенные так и выключенные категории
     * @return array
     */
    public static function getCategoriesListAdmin()
    {
        $db=DB::getConnection();

        $categoriesList = [];
        $result = $db->query('SELECT id, title, sort_order, status FROM category ORDER BY sort_order ASC');

        $i = 0;
        while($row = $result->fetch())
        {
            $categoriesList[$i]['id'] = $row['id'];
            $categoriesList[$i]['title'] = $row['title'];
            $categoriesList[$i]['sort_order'] = $row['sort_order'];
            $categoriesList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoriesList;

    }

    /**
     * Удаляет категорию с заданным id
     * @param $id
     * @return bool
     */
    public static function deleteCategoryById($id)
    {
        $db = DB::getConnection();

        $sql = 'DELETE FROM category WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Создает новую категорию
     * @param $options
     * @return bool
     */
    public static function createCategory($options)
    {
        $db = DB::getConnection();

        $sql = 'INSERT INTO category 
                (title, status, sort_order)
                VALUES (:title, :status, :sort_order)';

        $result = $db->prepare($sql);
        $result->bindParam(':title', $options['title'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * Возвращает категорию с указанным id
     * @param $id
     * @return mixed
     */
    public static function getCategoryByID($id)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            $sql = 'SELECT * FROM category WHERE id = :id';
            
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            $result->execute();
            
            return $result->fetch();
        }
    }

    /**
     * Получаем название категории по id
     * @param $id
     * @return mixed
     */
    public static function getCategoriesNameById($id)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            $result = $db->query("SELECT title FROM category WHERE id = '$id'" );

            $result->setFetchMode(PDO::FETCH_ASSOC);

            $categoryName = $result->fetch();
            
            return $categoryName = $categoryName['title'];
        }
    }

    /**
     * Обновляет информацию в категории с указанным id
     * @param $id
     * @param $options
     * @return bool
     */
    public static function updateCategoryById($id, $options)
    {
        $db = DB::getConnection();

        $sql = 'UPDATE category 
                SET
                title = :title,
                sort_order = :sort_order,
                status = :status
                WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();

    }

    /**
     * Возвращает статус категории в виде текста
     * @param $status
     */
    public static function getStatusText($status)
    {
        switch($status) {
            case 0:
                echo 'скрыто';
                break;
            case 1:
                echo 'отображается';
                break;
        }
    }

}