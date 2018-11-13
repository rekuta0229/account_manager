<?php

/**
 * UserRepository.
 * ユーザID関連の処理を管理する
 */
class UserRepository extends DbRepository{

    // ユーザの新規登録処理
    public function insertUserId($user_name, $password){
        $password = $this->hashPassword($password);

        $sql = "
            INSERT INTO user(user_name, password)
                VALUES(:user_name, :password)
        ";

        $stmt = $this->execute($sql, array(
            ':user_name' => $user_name,
            ':password' => $password,
        ));
    }

    // パスワードの暗号化
    public function hashPassword($password){
        return sha1($password);
    }

    // パスワードの変更処理
    public function updatePasswrd($password){

        $password = $this->hashPassword($password);

        $sql = "UPDATE user SET password = :password WHERE user_name = :user_name";

        $stmt = $this->execute($sql, array(
            ':user_name' => $user_name,
            ':password' => $password,
        ));

    }
    // ユーザIDに紐付く列を検索
    public function fetchByUserName($user_name){
        $sql = "SELECT * FROM user WHERE user_name = :user_name";

        return $this->fetch($sql, array(
            ':user_name' => $user_name
        ));
    }

    // 同一のユーザIDのレコードがあるかを判定
    public function isUniqueUserName($user_name){
        $sql = "SELECT COUNT(id) as count FROM user WHERE user_name = :user_name";

        $row = $this->fetch($sql, array(
            ':user_name' => $user_name
        ));
        if($row['count'] === '0'){
            return true;
        }

        return false;
    }
}
