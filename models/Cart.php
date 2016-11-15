<?php

class Cart
{

    /**
     * Добавление товара в корзину
     * @param $id
     * @param int $count
     * @return int
     */
    public static function addProduct($id, $count = 1)
    {
        $id = intval($id);

        // Пустой массив для товаров в корзине
        $productsInCart = array();

        // Если товары уже есть в корзине (они хранятся в сессии)
        if (isset($_SESSION['products'])) {
            // То заполним наш массив товарами
            $productsInCart = $_SESSION['products'];
        }

        // Если товар уже был в корзине добавляем количество
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] = $productsInCart[$id] + $count;
        }
        else {
            // Добавляем новый товар в корзину
            $productsInCart[$id] = $count;
        }

        
        $_SESSION['products'] = $productsInCart;

        return self::countItems();

    }


    /**
     * Подсчет колличества товаров в корзине (в сессии)
     * @return int
     */

    public static function countItems()
    {
        if(isset($_SESSION['products'])) {
            $count = 0;

            foreach($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        }
        else {
            return 0;
        }
    }

    /**
     * Возвращает массив товаров добавленных в корзину если он существует
     * в ином случае возвращает false
     * @return bool
     */
    public static function getProducts()
    {
        if(isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    /**
     * Возвращает общую сумму товаров в корзине
     * @param $products
     * @return int
     */
    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();

        $total = 0;

        if ($productsInCart) {
            foreach ($products as $productsItem) {
                $total += $productsItem['price'] * $productsInCart[$productsItem['id']];
            }
        }

        return $total;
    }

    /**
     * Очистка козины
     * @return bool
     */
    public static function cleanCart()
    {
        if(isset($_SESSION['products'])) {
            unset ($_SESSION['products']);
        }
        return true;
    }

    /**
     * Удаляет определенный товар из корзины по его id
     * @param $id
     * @return bool
     */
    public static function deleteProduct($id)
    {
        $id = intval($id);

        if(array_key_exists($id, $_SESSION['products'])) {
            unset ($_SESSION['products'][$id]);
        }
        return true;
    }
}