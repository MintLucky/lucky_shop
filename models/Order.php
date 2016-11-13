<?php

class Order
{
    public static function save($userName, $userPhone, $userComment, $userId, $productsInCart)
    {
        $productsJson = json_encode($productsInCart);

        $db = DB::getConnection();

        $sql = 'INSERT INTO product_orders(user_name, user_phone, user_comment, user_id, products) 
                VALUES (:userName, :userPhone, :userComment, :userId, :products)';

        $result = $db->prepare($sql);
        $result->bindParam(':userName',$userName, PDO::PARAM_STR);
        $result->bindParam(':userPhone',$userPhone, PDO::PARAM_STR);
        $result->bindParam(':userComment',$userComment, PDO::PARAM_STR);
        $result->bindParam(':userId',$userId, PDO::PARAM_INT);
        $result->bindParam(':products',$productsJson, PDO::PARAM_STR);

        return $result->execute();
    }


    public static function getStatusText($status)
    {
        switch($status){
            case 0:
                echo 'Новый заказ';
                break;
            case 1:
                echo 'Заказ обрабатывается';
                break;
            case 2:
                echo 'Заказ на доставке';
                break;
            case 3:
                echo 'Завершенный заказ';
                break;
        }
    }

    public static function getOrdersList()
    {

        $db = DB::getConnection();

        $ordersList = [];

        $result = $db->query("SELECT id,user_name,user_phone, date, user_comment,status, user_id, products 
                              FROM product_orders ORDER by id ASC");
        $i = 0;
        while ($row = $result->fetch())
        {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['user_comment'] = $row['user_comment'];
            $ordersList[$i]['status'] = $row['status'];
            $ordersList[$i]['user_id'] = $row['user_id'];
            $ordersList[$i]['products'] = $row['products'];
            $i++;
        }
        return $ordersList;

    }

    public static function getOrderById($id)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            $result = $db->query("SELECT * FROM product_orders WHERE id = '$id'" );

            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetch();
        }
    }

    public static function deleteOrderById($id)
    {
        $db = DB::getConnection();

        $sql = 'DELETE FROM product_orders WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function updateOrderById($id, $options)
    {
        $db = DB::getConnection();

        $sql = 'UPDATE product_orders 
                SET
                user_name = :user_name,
                user_phone = :user_phone,
                user_comment = :user_comment,
                status = :status,
                date = :date
                WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $options['user_name'], PDO::PARAM_STR);
        $result->bindParam(':user_phone', $options['user_phone'], PDO::PARAM_STR);
        $result->bindParam(':user_comment', $options['user_comment'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':date', $options['date'], PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function getOrdersListByUserId($id)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();

            $ordersList = array();

            $sql = "SELECT * FROM product_orders WHERE user_id = " .$id;
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();

            $i = 0;
            while ($row = $result->fetch()) {
                $ordersList[$i]['id'] = $row['id'];
                $ordersList[$i]['user_name'] = $row['user_name'];
                $ordersList[$i]['date'] = $row['date'];
                $ordersList[$i]['status'] = $row['status'];
                $ordersList[$i]['products'] = $row['products'];
                $i++;
            }
            return $ordersList;
        }
    }
}