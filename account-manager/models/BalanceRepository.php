<?php
/**
 * 入出金テーブルの管理
 *
 */
class BalanceRepository extends DbRepository{

    // 入出金を照会する
    public function showBalance($user_id,$date){
        $sql = "SELECT * FROM balance AS B LEFT OUTER JOIN user AS U ON B.user_id = U.id
                WHERE user_id = :user_id AND DATE_FORMAT(date, '%Y%m') = :date ORDER BY date asc";


        $stmt = $this->fetchAll($sql, array(
            ':user_id' => $user_id,
            ':date' => $date
        ));
        return $stmt;

    }

    // 入出金を新規登録する
    public function insertBalance($user_id, $date, $usage, $deposit, $payment){
        $balance_id = null;
        $sql = "INSERT INTO balance (balance_id, user_id ,date, contents, deposit, payment)
                VALUES(:balance_id, :user_id ,cast(:date as date), :contents, :deposit, :payment)";
        $stmt = $this->execute($sql, array(
            ':balance_id' => $balance_id,
            ':user_id' => $user_id,
            ':date' => $date,
            ':contents' => $usage,
            ':deposit' => $deposit,
            ':payment' => $payment,
        ));
    }

    // (更新・削除画面専用)チェックボックスから入出金データを照会
    public function showBalanceById($user_id ,$balance_id){
        $sql = "SELECT * FROM balance AS B LEFT OUTER JOIN user AS U ON B.user_id = U.id
                WHERE user_id = :user_id AND balance_id = :balance_id ORDER BY date asc";
        $stmt = $this->fetchAll($sql, array(
            ':user_id' => $user_id,
            ':balance_id' => $balance_id
        ));
        return $stmt;
    }
    // 既存の入出金データを修正する
    public function updateBalance($balance_id, $user_id, $date,$contents,$deposit,$payment){
        $sql = "UPDATE balance AS B LEFT JOIN user AS U ON B.user_id = U.id
                SET date = cast(:date as date), contents = :contents, deposit = :deposit, payment = :payment WHERE balance_id = :balance_id AND user_id = :user_id";
        $stmt = $this->execute($sql, array(
            ':date' => $date,
            ':contents' => $contents,
            ':deposit' => $deposit,
            ':payment' => $payment,
            ':balance_id' => $balance_id,
            ':user_id' => $user_id
        ));
    }

    // 既存の入出金データを削除する
    public function deleteBalance($user_id, $balance_id){
        $sql = "DELETE FROM balance WHERE user_id = :user_id AND balance_id = :balance_id";
        $stmt = $this->execute($sql, array(
            ':user_id' => $user_id,
            ':balance_id' => $balance_id
        ));
    }

    // 指定の年で12ヶ月分のそれぞれの入金額の合計を取得(グラフ表示用)
    public function getAmountDeposit($user_id, $year){

        // 取得結果(12ヵ月分)
        $amount_deposit = array();

        for($month = 1; $month<=12; $month++){
            if($month >= 10){
                $date = $year . $month;
            } else {
                $date = $year . '0'.$month;
            }
            $sql = "SELECT SUM(deposit) FROM balance AS B LEFT OUTER JOIN user AS U
                    ON B.user_id = U.id WHERE user_id = :user_id AND DATE_FORMAT(date, '%Y%m') = :date ";
            $stmt = $this->fetchAll($sql , array(
                ':user_id' => $user_id,
                ':date' => $date
            ));

            $key = $month . '月';
            $value = $stmt;

            $data = array(
                $key => $value
            );
            array_push($amount_deposit, $data);
        }
        return $amount_deposit;
    }

    // 指定の年で12ヶ月分のそれぞれの入金額の合計を取得(グラフ表示用)
    public function getAmountPayment($user_id, $year){

        // 取得結果(12ヵ月分)
        $amount_payment = array();

        for($month = 1; $month<=12; $month++){
            if($month >= 10){
                $date = $year . $month;
            } else {
                $date = $year . '0'.$month;
            }

            $sql = "SELECT SUM(payment) FROM balance AS B LEFT OUTER JOIN user AS U
                    ON B.user_id = U.id WHERE user_id = :user_id AND DATE_FORMAT(date, '%Y%m') = :date ";
            $stmt = $this->fetchAll($sql , array(
                ':user_id' => $user_id,
                ':date' => $date
            ));

            $key = $month . '月';
            $value = $stmt;

            $data = array(
                $key => $value
            );
            array_push($amount_payment, $data);
        }
        return $amount_payment;

    }
}
?>