<?php

/*
 * 貯金目標入力シートの項目の管理
 *
 */
class SaveRepository extends DbRepository{

    // 貯金目標シートの入力項目の照会処理
    public function showSave($user_id){
        $save_sql = "SELECT * FROM save AS S LEFT JOIN user AS U ON S.user_id = U.id WHERE user_id = :user_id";
        $save_stmt = $this->fetchAll($save_sql, array(
            ':user_id' => $user_id
        ));

        return $save_stmt;
    }

    // 貯金目標シートの画像を表示する
    public function showImageInSave($user_id){
        $image_sql = "SELECT * FROM image WHERE user_id = :user_id";
        $image_stmt = $this->fetchAll($image_sql, array(
            ':user_id' => $user_id
        ));
        return $image_stmt;
    }

    // 貯金目標シートの入力項目の登録処理
    public function insertSave($user_id, $reason, $money, $wish, $patience, $extension, $image){

        // saveテーブルの新規追加
        $save_sql = "INSERT INTO save (user_id, save_reason, save_money, save_wish, save_patience)
                VALUES(:user_id, :save_reason, :save_money, :save_wish, :save_patience)";

        $save_stmt = $this->execute($save_sql, array(
            ':user_id' => $user_id,
            ':save_reason' => $reason,
            ':save_money' => $money,
            ':save_wish' => $wish,
            ':save_patience' => $patience,
        ));

        $image_sql = "INSERT INTO image (user_id, extension, image) VALUES(:user_id, :extension, :image)";
        $image_stmt = $this->execute($image_sql, array(
            ':user_id' => $user_id,
            ':extension' => $extension,
            ':image' => $image
        ));
    }

    // 貯金目標シートの更新処理
    public function updateSave($user_id, $save_id, $reason, $money, $wish, $patience){
        $sql = "UPDATE save SET save_reason = :save_reason, save_money = :save_money, save_wish = :save_wish,
                save_patience = :save_patience WHERE save_id = :save_id";

        $stmt = $this->execute($sql , array(
            ':save_reason' => $reson,
            ':save_money' => $money,
            ':save_wish' => $wish,
            ':save_patience' => $patience,
            ':save_id' => $save_id,
        ));
    }

    // 貯金目標シートの入力項目を取得
    public function fetchPersonalSaveByUserId($user_id){
        $sql = "SELECT * FROM save JOIN user ON save.user_id = user.id WHERE user_id = :user_id";
        return $this->fetch($sql, array(':user_id' => $user_id));
    }
}
?>