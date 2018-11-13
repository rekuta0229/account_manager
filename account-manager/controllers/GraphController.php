<?php

class GraphController extends Controller{

    protected $auth_actions = array(
        'index'
    );

    public function indexAction(){
        $user = $this->session->get('user');
        $user_id = $user['id'];

        return $this->render(array(
            'user' => $user,
            '_token' => $this->generateCsrfToken('/graph')
        ), 'index');
    }

    public function  graphShowAction(){
        $user = $this->session->get('user');
        $user_id = $user['id'];
        $year = $this->request->getPost('year');

        $errors = array();

        if(!isset($year)){
            $errors['year'] = 'グラフに表示する年を選択してください。';
        }


        $amount_deposit = $this->db_manager->get('Balance')->getAmountDeposit($user_id, $year);
        $amount_payment = $this->db_manager->get('Balance')->getAmountPayment($user_id, $year);


        // 画面に渡す値を格納する配列
        $result_deposit = array();
        $result_payment = array();

        // 1ヶ月ごとの入金額を取り出す
        foreach ($amount_deposit as $amount){
            foreach ($amount as $sum){
                foreach ($sum as $deposit){
                    $sum_deposit = intval($deposit["SUM(deposit)"]);
                    array_push($result_deposit, $sum_deposit);
                }
            }
        }

        // 1ヶ月ごとの出金額を取り出す
        foreach ($amount_payment as $amount){
            foreach ($amount as $sum){
                foreach ($sum as $payment){
                    $sum_payment = intval($payment["SUM(payment)"]);
                    array_push($result_payment, $sum_payment);
                }
            }
        }

        $deposit_arr = json_encode($result_deposit);
        $payment_arr = json_encode($result_payment);

        if(empty($amount_deposit) && empty($amount_payment)){
            $errors{'data'} = 'グラフに表示するデータがありません。';
        }

        if(count($error) >= 1){
            return $this->render(array(
                'user' => $user,
                'errors' => $errors,
                'result' => $result,
                '_token' => $this->generateCsrfToken('/graph')
            ), 'index');
        }
        return $this->render(array(
            'user' => $user,
            'deposit_arr' => $deposit_arr,
            'payment_arr' => $payment_arr,
            '_token' => $this->generateCsrfToken('/graph/show')
        ), 'show');
    }

}