<?php

class BalanceController extends Controller{

    protected $auth_actions = array(
        'index',
        'getDate',
        'show',
        'insert',
        'insertConfirm',
        'insertSubmit',
        'update',
        'updateInput',
        'updateConfirm',
        'updateSubmit',
        'delete',
        'deleteCofirm',
        'deleteSubmit'
    );

    public function indexAction(){
        $user = $this->session->get('user');
        return $this->render(array(
            'user' => $user,
            '_token' => $this->generateCsrfToken('balance/index')
        ), 'index');
    }

    // 残高の照会
    public function showAction(){
        $user = $this->session->get('user');
        $user_id = $user['id'];
        $year = $this->request->getPost('year');
        $month = $this->request->getPost('month');
        if($month >= 10){
            $date = $year . $month;
        } else {
            $date = $year . '0'. $month;
        }


        // 初期画面と日付選択後の画面表示切り替え
        $errors = array();
        $result = array();
        if(!isset($date)){
            $errors[] = '残高を表示する年月を選択してください。';
        }else{
            $result = $this->db_manager->get('Balance')->showBalance($user_id, $date);
            if(!isset($result)){
                $errors[] = '照会するデータがありません。';
            }
        }

        return $this->render(array(
            'errors' => $errors,
            'user' => $user,
            'result' => $result,
            '_token' => $this->generateCsrfToken('balance/show')
        ), 'show');
    }

    // 残高の新規登録入力画面
    public function insertAction(){
        $user = $this->session->get('user');
        $token = $this->request->getPost('_token');
        return $this->render(array(
            'user' => $user,
            '_token' => $this->generateCsrfToken('balance/insert')
        ), 'insert');
    }

    // 残高の新規登録確認画面
    public function insertConfirmAction(){
        $user = $this->session->get('user');
        $token = $this->request->getPost('_token');

        $date = $this->request->getPost('date');
        $contents = $this->request->getPost('contents');
        $deposit = $this->request->getPost('deposit');
        $payment = $this->request->getPost('payment');


        var_dump($date);
        var_dump($contents);
        var_dump($deposit);
        var_dump($payment);
        $errors = array();

        if(empty($date)){
            $errors[] = '仕訳が発生した日時を入力してください。';
        }
        if(empty($contents)){
            $errors[] = '用途を入力してください。';
        }
        if(empty($deposit) && empty($payment)){
            $errors[] = '入金額もしくは出金額を入力してください。';
        }

        if(count($errors) > 0){
            return $this->render(array(
                'errors' => $errors,
                'user' => $user,
                '_token' => $this->generateCsrfToken('balance/insert')
            ), 'insert');
        }
        return $this->render(array(
            'user' => $user,
            'date' => $date,
            'contents' => $contents,
            'deposit' => $deposit,
            'payment' => $payment,
            '_token' => $this->generateCsrfToken('balance/insert/confirm')
        ), 'insert_confirm');
    }

    // 残高の新規登録完了画面
    public function insertSubmitAction(){
        $user = $this->session->get('user');

        // 確認画面で戻るボタンを押された時の動作
        $insert_back = $this->request->getPost('insert_back');
        if(isset($insert_back)){
            return $this->render(array(
                'user' => $user,
                '_token' => $this->generateCsrfToken('balance/insert')
            ), 'insert');
        }

        $user_id = $user['id'];
        $date = $this->request->getPost('date');
        $contents = $this->request->getPost('contents');
        $deposit = $this->request->getPost('deposit');
        $payment = $this->request->getPost('payment');


        if($deposit === ""){
            $deposit = null;
        }
        if($payment === ""){
            $payment = null;
        }

        // 文字列型を整数に変換
        $pre_deposit = intval($deposit);
        $pre_payment = intval($payment);

        $this->db_manager->get('Balance')->insertBalance($user_id, $date, $contents, $pre_deposit, $pre_payment);

        return $this->render(array(
            'user' => $user
        ), 'insert_submit');
    }

    // 残高の更新初期画面
    public function updateAction(){
        $user = $this->session->get('user');
        $user_id = $user['id'];
        $year = $this->request->getPost('year');
        $month = $this->request->getPost('month');
        if($month >= 10){
            $date = $year . $month;
        } else {
            $date = $year . '0'. $month;
        }

        $errors = array();

        // 日付入力と入出金データのチェック
        if(!isset($date)){
            $errors['date'] = '残高を更新する年月を選択してください。';
        }

        $result = $this->db_manager->get('Balance')->showBalance($user_id, $date);

        if(!isset($result)){
            $errors['result'] = '更新するデータがありません。';
        }
        return $this->render(array(
            'errors' => $errors,
            'user' => $user,
            'result' => $result,
            '_token' => $this->generateCsrfToken('balance/update')
        ), 'update');
    }

    // 残高の更新入力処理
    public function updateInputAction(){
        $token = $this->request->getPost('_token');
        $user = $this->session->get('user');
        $user_id = $user['id'];
        $update_flag = $this->request->getPost('update_flag');

        // 確認画面から戻った際に設定する更新フラグ
        if(empty($update_flag)){
            $update_flag = $this->session->get('update_flag');
        }
        $errors = array();

        // チェックボックスからのフラグの取得
        if(count($update_flag) > 1){
            $errors[] = '一回で更新できるのは1つのデータのみです。';
        }

        if(empty($update_flag) && count($update_flag) === 0){
            $errors[] = '更新したいデータを1つ選択してください。';
        }

        return $this->render(array(
            'errors' => $errors,
            'user' => $user,
            'update_flag' => $update_flag,
            '_token' => $this->generateCsrfToken('balance/update/input')
        ), 'update_input');
    }

    // 残高の更新確認画面
    public function updateConfirmAction(){
        $token = $this->request->getPost('_token');
        $user = $this->session->get('user');
        $user_id = $user['id'];

        $balance_id = $this->request->getPost('balance_id');
        $date = $this->request->getPost('date');
        $contents = $this->request->getPost('contents');
        $deposit = $this->request->getPost('deposit');
        $payment = $this->request->getPost('payment');

        // 戻るボタンを押された時の動作
        $update_back = $this->request->getPost('update_back');
        if(isset($update_back)){
            $this->redirect('balance/update');
            return $this->render(array(
                'user' => $user,
                'balance_id' => $balance_id,
                'result' => $result,
                '_token' => $this->generateCsrfToken('balance/update')
            ), 'update');
        }

        // エラーメッセージを格納する配列
        $errors = array();

        // 入力値のチェック
        if(empty($date)){
            $errors['date'] = '仕訳が発生した日時を入力してください。';
        }
        if(empty($contents)){
            $errors['contents'] = '用途を入力してください。';
        }
        if(empty($deposit) && empty($payment)){
            $errors['money'] = '入金額か出金額を入力してください。';
        }

        // エラーがあれば入力画面でエラーを表示。なければ確認画面を表示。
        if(count($errors) > 1){
            return $this->render(array(
                'errors' => $errors,
                'user' => $user,
                'balance_id' => $balance_id,
                '_token' => $this->generateCsrfToken('balance/update/input')
            ), 'update_input');
        }

        return $this->render(
                array(
                    'user' => $user,
                    'balance_id' => $balance_id,
                    'date' => $date,
                    'contents' => $contents,
                    'deposit' => $deposit,
                    'payment' => $payment,
                    '_token' => $this->generateCsrfToken('balance/update/confirm')
                ), 'update_confirm');
    }

    // 残高の更新完了画面
    public function updateSubmitAction(){
        $user = $this->session->get('user');
        $user_id = $user['id'];

        $balance_id = $this->request->getPost('balance_id');
        $date = $this->request->getPost('date');
        $contents = $this->request->getPost('contents');
        $deposit = $this->request->getPost('deposit');
        $payment = $this->request->getPost('payment');

        // 確認画面で戻るボタンが押された場合
        $update_recall = $this->request->getPost('update_recall');
        if(isset($update_recall)){
            $update_flag = $this->session->set('update_flag', $balance_id);
            $this->redirect('balance/update/input');
            return $this->render(array(
                'user' => $user,
                'update_flag' => $update_flag,
                '_token' => $this->generateCsrfToken('balance/update/input')
            ), 'update_input');
        }

        // 入金額&出金額の調整
        if($deposit === ""){
            $deposit = null;
        }
        if($payment === ""){
            $payment = null;
        }
        $pre_deposit = intval($deposit);
        $pre_payment = intval($payment);

        // 更新処理
        $this->db_manager->get('Balance')->updateBalance($balance_id, $user_id, $date, $contents, $pre_deposit, $pre_payment);

        // 処理が完了した際に、設定したセッションを取り除く
        $update_flag = $this->session->get('update_flag');
        if(isset($update_flag)){
            $this->session->remove($update_flag);
        }

        return $this->render(array(
            'user' => $user,
            '_token' => $this->generateCsrfToken('balance/update/submit')
        ), 'update_submit');
    }

    // 残高の削除初期画面
    public function deleteAction(){
        $user = $this->session->get('user');
        $user_id = $user['id'];
        $year = $this->request->getPost('year');
        $month = $this->request->getPost('month');
        if($month >= 10){
            $date = $year . $month;
        } else {
            $date = $year . '0'. $month;
        }

        $errors = array();

        if(!isset($date)){
            $errors = '仕訳を削除する年月を選択してください。';
        }
        $user_id = $user['id'];
        $result = $this->db_manager->get('Balance')->showBalance($user_id, $date);
        if(!isset($result)){
            $errors = '削除するデータがありません。';
        }
        return $this->render(array(
            'errors' => $errors,
            'user' => $user,
            'result' => $result,
            '_token' => $this->generateCsrfToken('balance/delete')
        ), 'delete');
    }

    // 残高の削除確認画面
    public function deleteConfirmAction(){
        $token = $this->request->getPost('_token');
        $user = $this->session->get('user');
        $user_id = $user['id'];
        $delete_flag = $this->request->getPost('delete_flag');
        var_dump($delete_flag);

        // エラーメッセージを格納する配列
        $errors = array();

        if(count($delete_flag) === 0){
            $errors[] = '削除するデータを選択してください。';
        }
        if(count($delete_flag) > 1){
            $errors[] = '1回の操作で削除できるデータは1つまでです。';
        }
        if(count($errors) > 0){
            return $this->render(array(
                'errors' => $errors,
                'user' => $user,
                '_token' => $this->generateCsrfToken('balance/delete')
            ), 'delete');
        }
        // 削除フラグからidを取り出す
        $balance_id = $delete_flag[0];
        $result = $this->db_manager->get('Balance')->showBalanceById($user_id, $balance_id);

        return $this->render(array(
            'user' => $user,
            'delete_flag' => $delete_flag,
            'result' => $result,
            '_token' => $this->generateCsrfToken('balance/delete/confirm')
        ), 'delete_confirm');
    }

    // 残高の削除完了画面
    public function deleteSubmitAction(){
        $token = $this->request->getPost('_token');
        $user = $this->session->get('user');
        $user_id = $user['id'];
        $balance_id = $this->request->getPost('balance_id');

        // 確認画面で戻るボタンが押された場合
        $delete_recall = $this->request->getPost('delete_recall');
        if(isset($delete_recall)){
            $result = null;
            return $this->render(array(
                'user' => $user,
                'result' => $result,
                '_token' => $this->generateCsrfToken('balance/delete')
            ), 'delete');
        }

        // 削除処理
        $this->db_manager->get('Balance')->deleteBalance($user_id, $balance_id);

        return $this->render(array(
            'user' => $user,
            '_token' => $this->generateCsrfToken('balance/delete/submit')
        ), 'delete_submit');
    }
}
?>