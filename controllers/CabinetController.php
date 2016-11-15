<?php

class CabinetController
{
    /**
     * Action для страницы личного кабинета пользователя
     */
    public function actionIndex()
    {   
        // Получаем информацию о пользователе
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        require_once (ROOT .'/views/cabinet/index.php');

        return true;
    }
    
}