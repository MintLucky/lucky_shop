<?php
class User
{
    /**
     * Регистрация нового пользователя
     * @param $name
     * @param $email
     * @param $password
     * @return bool
     */
    public static function register($name, $email, $password)
    {
        $db = DB::getConnection();

        $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * Проверка валидности имени
     * @param $name
     * @return bool
     */
    public static function checkName($name)
    {
        if (strlen($name) >= 3) {
            return true;
        }
        return false;
    }

    /**
     * Проверка валидности номера телефона
     * @param $phone
     * @return bool
     */
    public static function checkPhone($phone)
    {

        if (preg_match('/[^\s\(\)\-\+\d]/', $phone) || (strlen($phone) <= 5)) {
            return false;
        }
        return true;
    }

    /**
     * Проверка валидности пароля
     * @param $password
     * @return bool
     */
    public static function  checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * проверка валидности email
     * @param $email
     * @return bool
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Проверка пароля на существование в базе
     * @param $email
     * @return bool
     */
    public static function checkEmailExists($email)
    {

        $db = DB::getConnection();

        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn())
            return true;
        return false;
    }

    /**
     * Проверка существования пользователя с указанными email и паролем
     * @param $email
     * @param $password
     * @return bool
     */
    public static function checkUserData($email, $password)
    {
        $db = DB::getConnection();

        $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        
        $user = $result->fetch();

        if($user) {
            return $user['id'];
        }
        return false;
    }

    /**
     * авторизация пользователя
     * @param $userId
     * @return bool
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
        return true;
    }

    /**
     * Проверяет залогинен ли пользователь
     * @return mixed
     */
    public static function checkLogged()
    {
        // Если сессия есть, возвращаем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /user/login");
    }
    
    /*
     * Проверяет является ли пользователем гостем (не залогинен)
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        else return true;
    }

    /**
     * Возвращает массив данных о пользователе с указанным id
     * @param $userId
     * @return mixed
     */
    public static function getUserById($userId) 
    {
        if ($userId) {
            $db = DB::getConnection();
            
            $sql = 'SELECT * FROM users WHERE id = :id';
            $result = $db->prepare($sql);
            $result->bindParam(':id', $userId, PDO::PARAM_INT);
            
            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            
            return $result->fetch();
        }
    }

    /**
     * Редактирует данные пользователя с указанным id
     * @param $name
     * @param $password
     * @param $userId
     * @return bool
     */
    public static function edit($name, $password, $userId)
    {
        $db = DB::getConnection();

        $sql = 'UPDATE users SET name = :name, password = :password WHERE id =:id';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);
        
        return $result->execute();
    }
    
}