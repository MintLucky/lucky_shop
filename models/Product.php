<?php

class Product
{
    // Количество отображаемых товаров на странице по умолчанию
    const SHOW_BY_DEFAULT = 9;

    /**
     * Возвращает массив последних товаров
     * @param int $count
     * @param int $page
     * @return array
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT, $page = 1)
    {
        
        $count = intval($count);
        $page = intval($page);

        // Расчитываем смещение для запроса
        $offset = ($page-1) * $count;

        $db = DB::getConnection();

        $productsList = [];

        $result = $db->query("SELECT id,title,price,picture, is_new FROM products   
                                WHERE status ='1' 
                                ORDER by id DESC 
                                LIMIT " . $count
                                .' OFFSET '. $offset);
        $i = 0;
        while ($row = $result->fetch())
        {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['title'] = $row['title'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['picture'] = $row['picture'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;

    }

    /**
     * Возвращает список товаров указанной категории по id категории
     * @param bool $categoryId
     * @param int $page
     * @return array
     */
    public static function getProductsListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {

            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = DB::getConnection();

            $products = [];

            $result = $db->query("SELECT id,title,price,picture, is_new FROM products   
                                WHERE status ='1' AND id_catalog = $categoryId 
                                ORDER by id ASC 
                                LIMIT " . self::SHOW_BY_DEFAULT
                                .' OFFSET '. $offset);
            $i = 0;
            while ($row = $result->fetch())
            {
                $products[$i]['id'] = $row['id'];
                $products[$i]['title'] = $row['title'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['picture'] = $row['picture'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }
            return $products;

            }
    }

    /**
     * Возвращает данные о товаре по id
     * @param $id
     * @return mixed
     */
    public static function getProductByID($id)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            $sql = 'SELECT * FROM products WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            $result->setFetchMode(PDO::FETCH_ASSOC);

            $result->execute();

            return $result->fetch();
        }
    }

    /**
     * Возвращает список товаров по казанным id товаров
     * @param $idsArray
     * @return array
     */
    public static function getProductsByIds($idsArray)
    {

        $products = [];

        $idsString = implode(',', $idsArray);

        $db = DB::getConnection();

        $result = $db->query("SELECT * FROM products WHERE status='1' AND id IN($idsString)");
        $result -> setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;

        while($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['title'] = $row['title'];
            $products[$i]['mark'] = $row['mark'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['code'] = $row['code'];
            $i++;
        }
        
        return $products;

    }

    /**
     * Возвращает количество товаров в указанной категории
     * @param $categoryId
     * @return mixed
     */
    public static function getTotalProductsInCategory($categoryId)
    {
        if ($categoryId) {
            $db = DB::getConnection();
            $sql = "SELECT count(id) AS count FROM products 
                    WHERE status = '1' AND id_catalog = :category_id";

            $result = $db->prepare($sql);
            $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

            $result->execute();

            // Возвращаем значение count - количество
            $row = $result->fetch();
            return $row['count'];
        }
    }

    /**
     * Возвращает количество всех не скрытых товаров
     * @return mixed
     */
    public static function getTotalProductsCount()
    {
         
        $db = DB::getConnection();
        $result = $db->query("SELECT count(id) AS count FROM products 
                            WHERE status = '1'" );

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
        
    }

    /**
     * Возвращает список всех рекомендуемых не скрытых товаров
     * @param int $count
     * @return array
     */
    public static function getRecommendedProducts($count = self::SHOW_BY_DEFAULT)
    {
        $db = DB::getConnection();
        
        $products = [];
        $result = $db->query("SELECT id,title,price,picture, mark, is_new FROM products WHERE status='1' 
                              AND is_recommended='1' LIMIT $count");
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i=0;
        
        while($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['title'] = $row['title'];
            $products[$i]['mark'] = $row['mark'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['picture'] = $row['picture'];
            $products[$i]['is_new'] = $row['is_new'];
            
            $i++;
        }
        
        return $products;
    }

    /**
     * Удаляет товар по id
     * @param $id
     * @return bool
     */
    public static function deleteProductById($id)
    {
        $db = DB::getConnection();

        $sql = 'DELETE FROM products WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Возвращает список всех товаров
     * @return array
     */
    public static function getProductsList()
    {

        $db = DB::getConnection();

        $productsList = [];

        $result = $db->query("SELECT id,title,price,mark FROM products ORDER by id ASC");
        $i = 0;
        while ($row = $result->fetch())
        {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['title'] = $row['title'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['mark'] = $row['mark'];
            $i++;
        }
        return $productsList;

    }

    /**
     * Создает товар
     * @param $options
     * @return int|string
     */
    public static function createProduct($options)
    {
        $db = DB::getConnection();

        $sql = 'INSERT INTO products 
                (id_catalog, code, title, mark, price, is_new, description, status, is_recommended, availability)
                VALUES (:id_catalog, :code, :title, :mark, :price, :is_new, :description, :status, :is_recommended, :availability)';

        $result = $db->prepare($sql);
        $result->bindParam(':id_catalog', $options['id_catalog'], PDO::PARAM_INT);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':mark', $options['mark'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);

        if($result->execute()) {
            // Если запрос выполнен возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    /**
     * Редактирует товар с указанным id
     * @param $id
     * @param $options
     * @return bool
     */
    public static function updateProductById($id, $options)
    {
        $db = DB::getConnection();

        $sql = 'UPDATE products 
                SET
                id_catalog = :id_catalog,
                code = :code,
                title = :title,
                mark = :mark,
                price = :price,
                is_new = :is_new,
                description = :description,
                status = :status,
                is_recommended = :is_recommended,
                availability = :availability
                WHERE id =:id';

        $result = $db->prepare($sql);
        $result->bindParam(':id_catalog', $options['id_catalog'], PDO::PARAM_INT);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':mark', $options['mark'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();

    }

    /**
     * Возвращает путь к картинке определенного товара с указанным id если она существует
     * @param $id
     * @return string
     */
    public static function getImage($id)
    {
        // Изображение-пустышка
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/products/';

        // Путь к изображению товара
        $pathToProductImage = $path .$id . '.jpg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение существует возвращаем путь к этому изображению
            return $pathToProductImage;
        }

        // Если не существует Возвращаем путь к изображению-пустышке
        return $path .$noImage;

    }

    /**
     * Возвращает общее количество заказанных товаров в заказе
     * @param $orderProductsJson
     * @return int
     */
    public static function getProductsOrderCount($orderProductsJson)
    {
        $orderProductsArray = json_decode($orderProductsJson);
        $count = 0;
        foreach($orderProductsArray as $id => $productCount) {
            $count += $productCount;
        }
        return $count;
    }
    
}