<?php

class News
{
    // Количество новостей выводимых на страницу по умлолчанию
    const SHOW_BY_DEFAULT = 3;

    /**
     * Возвращает новость по id
     * @param $id
     * @return bool|mixed
     */
    public static function getNewsItemById($id)
    {
        $id = intval($id);

        $db = DB::getConnection();

        $sql='SELECT * FROM news WHERE id=:id';

        $result = $db->prepare($sql);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $newsItem = $result->fetch();

        return $newsItem;

    }

    /**
     * Возвращает количество всех отображаемых новостей
     * @return mixed
     */
    public static function getTotalNewsCount()
    {
        $db = DB::getConnection();
        $result = $db->query("SELECT count(id) AS count FROM news 
                            WHERE status = '1'" );

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    /**
     * Возвращает список всех новостей
     * @param $count
     * @param $page
     * @return array
     */
    public static function getNewsList($count, $page)
    {
        $newsList = array();

        $count = intval($count);
        $page = intval($page);
        
        $offset = ($page-1) * $count;

        $db = DB::getConnection();
        $result = $db->query("SET NAMES 'utf8'");
//        $result = $db->query("SET CHARACTER SET 'utf8'");
//        $result = $db->query("SET SESSION collation_connection = 'utf8_general_ci'");
        $result = $db->query("SELECT id, title, short_content, date FROM news   
                                WHERE status ='1' 
                                ORDER by date DESC 
                                LIMIT " . self::SHOW_BY_DEFAULT
                                .' OFFSET '. $offset);
        $i = 0;

        while ($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $i++;
        }

        return $newsList;
    }

    /**
     * Возвращает список всех новостей для админпанели
     * причем как видимых так и скрытых
     * @return array
     */
    public static function getNewsListAdmin()
    {

        $newsList = array();

        $db = DB::getConnection();
        $result = $db->query("SET NAMES 'utf8'");
        $result = $db->query('SELECT * FROM news ORDER BY date DESC');
        $i = 0;

        while ($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $newsList[$i]['author_name'] = $row['author_name'];
            $newsList[$i]['content'] = $row['content'];
            $newsList[$i]['preview'] = $row['preview'];
            $newsList[$i]['status'] = $row['status'];
            $i++;
        }

        return $newsList;
    }

    /**
     * Создает новость
     * @param $options
     * @return int|string
     */
    public static function createNews($options)
    {
        $db = DB::getConnection();

        $sql = 'INSERT INTO news 
                (title, status, short_content, content)
                VALUES (:title, :status, :short_content, :content)';

        $result = $db->prepare($sql);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':short_content', $options['short_content'], PDO::PARAM_STR);
        $result->bindParam(':content', $options['content'], PDO::PARAM_STR);

        if($result->execute()) {
            // Если запрос выполнен возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    /**
     * Удаляет новость по id
     * @param $id
     * @return bool
     */
    public static function deleteNewsById($id)
    {
        $db = DB::getConnection();

        $sql = 'DELETE FROM news WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редактирует новость по id
     * @param $id
     * @param $options
     * @return bool
     */
    public static function updateNewsItemById($id, $options)
    {
        $db = DB::getConnection();

        $sql = 'UPDATE news 
                SET
                short_content = :short_content,
                content = :content,
                title = :title,
                status = :status
                WHERE id =:id';

        $result = $db->prepare($sql);
        $result->bindParam(':short_content', $options['short_content'], PDO::PARAM_STR);
        $result->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * Возвращает путь к картинке (если она существует) определенной новости с указанным id
     * @param $id
     * @return bool|string
     */
    public static function getImage($id)
    {
        // Изображение-пустышка
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/news/';

        // Путь к изображению товара
        $pathToProductImage = $path .$id . '.jpg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение существует возвращаем путь к этому изображению
            return $pathToProductImage;
        }

        return true;
    }
}