<?php

abstract class AdminBase
{
    // Метод, который проверяет является пользователь админом или нет
    public static function checkAdmin()
    {
        // Проверяем авторизован ли пользователь. Если нет, он будет переадресован
        $userId = User::checkLogged();

        // Получаем информацию о текущем пользователе
        $user = User::getUserById($userId);

        // Если роль текущего пользователя "admin" , пускаем его в админку
        if ($user['role'] == 'admin' ) {
            return true;
        }
        // Иначе завершаем работу с сообщением об отказе в доступе
        die('Access denied');
    }
}