<?php

class SaveController extends Controller{

    protected $auth_actions = array(
        'index',
        'show',
        'insert',
        'insertConfirm',
        'insertSubmit',
        'update',
        'updateConfirm',
        'updateSubmit'
    );

    public function indexAction(){
        $user = $this->session->get('user');
        $token = $this->request->getPost('_token');
        return $this->render(array(
            'user' => $user,
            '_token' => $this->generateCsrfToken('save/index')
        ), 'index');
    }

    public function showAction(){
        $user = $this->session->get('user');
        $user_id = $user['id'];
        $save_result = $this->db_manager->get('Save')->showSave($user_id);

        return $this->render(array(
            'user' => $user,
            'save_result' => $save_result,
            '_token' => $this->generateCsrfToken('save/show')
        ), 'show');
    }

    public function imageViewAction(){
        $user = $this->session->get('user');
        $user_id = $user['id'];

        $result = $this->db_manager->get('Save')->showImageInSave($user_id);

        // 画面に渡す画像データ
        $extension = $result[0];
        $image = $result[1];

        // BLOBに変換

        return $this->render(array(
            'extension' => $extension,
            'image' => $image,
            '_token' => $this->generateCsrfToken('save/image')
        ), 'image_view');
    }

    public function insertAction(){
        $user = $this->session->get('user');
        $user_id = $user['id'];
        $save = $this->db_manager->get('Save')->showSave($user_id);
        $save_id = $save['save_id'];

        // 1ユーザがシート登録できるのは1つまで
        if(isset($save_id)){
            $error[] = '1ユーザが登録できるシートは1つまでです。既存のシートを更新してください。';
        }
        return $this->render(array(
            'user' => $user,
            'error' => $error,
            '_token' => $this->generateCsrfToken('save/insert')
        ), 'insert');
    }

    public function insertConfirmAction(){
        $save_reason = $this->request->getPost('save_reason');
        $save_money = $this->request->getPost('save_money');
        $save_wish = $this->request->getPost('save_wish');
        $save_patience = $this->request->getPost('save_patience');
        $save_img = $_FILES['save_image']['name'];

        $errors = array();

        if(empty($save_reason)){
            $errors['save_reason'] = '貯金する理由を入力してください。';
        }

        if(empty($save_money)){
            $errors['save_money'] = '貯金目標金額を入力してください';
        }

        if(empty($save_wish)){
            $errors['save_wish'] = '貯金して叶えたいことを入力してください。';
        }

        if(empty($save_patience)){
            $errors['save_patience'] = '貯金する時に我慢すべきことを入力してください。';
        }

        // アップロードした画像データを格納する変数
        // 画像ファイル名・画像のバイナリーデータ・画像の拡張子
        $save_fname = null;
        $save_image = null;
        $extension = null;

        // 画像ファイルがアップロードされた時のチェック
        if(!empty($save_img)){
            $max_size = 4 * 1024 * 1024;
            $file_upload = false;
            $tmp_name = $_FILES['save_image']['tmp_name'];
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $type = $finfo->file($tmp_name);
            if($type !== 'image/jpeg' && $type !== 'image/png'){
                $errors['extension'] = 'ファイルの拡張子はJPEGかPNGでアップロードしてください。';
            }else if($_FILES['save_image']['size'] > $max_size){
                $errors['size'] = 'ファイルのサイズは4MB以下でアップロードしてください。';
            }elseif(!$file = fopen($_FILES['save_image']['tmp_name'], 'rb')){
                $errors['fopen'] = '他の原因で画像を開けませんでした。';
            }else{
                $image = fread($file, $_FILES['save_image']['size']);
                $save_image = $this->session->set('image', $image);
                $tmp_name = $_FILES['save_image']['tmp_name'];
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $extension = $finfo->file($tmp_name);
                fclose($file);
                if(!$image){
                    $errors['image'] = '画像を開けませんでした。';
                }else{
                    $file_upload = true;
                }
            }
        }

        if(count($errors) >= 1){
            return $this->render(array(
                'user' => $user,
                'errors' => $errors,
                '_token' => $this->generateCsrfToken('save/insert')
            ), 'insert');
        }

        return $this->render(array(
                    'user' => $user,
                    'save_reason' => $save_reason,
                    'save_money' => $save_money,
                    'save_wish' => $save_wish,
                    'save_patience' => $save_patience,
                    'save_img' => $save_img,
                    'image' => $save_image,
                    'extension' => $extension,
                    '_token' => $this->generateCsrfToken($token)
                ), 'insert_confirm');
    }

    public function insertSubmitAction(){
        $user = $this->session->get('user');
        $user_id = $user['id'];

        // 確認画面で戻るボタンが押された場合
        $insert_back = $this->request->getPost('insert_back');
        if(isset($insert_back)){
            return $this->render(array(
                'user' => $user,
                '_token' => $this->generateCsrfToken('save/insert')
            ), 'insert');
        }


        $save_reason = $this->request->getPost('save_reason');
        $save_money = $this->request->getPost('save_money');
        $save_wish = $this->request->getPost('save_wish');
        $save_patience = $this->request->getPost('save_patience');
        $extension = $this->request->getPost('extension');
        $image = $this->request->getPost('image');
        $save_image = $this->session->get('image');

        $this->db_manager->get('Save')->insertSave($user_id, $save_reason, $save_money, $save_wish, $save_patience, $extension, $save_image);

        if(isset($save_image)){
            $this->session->remove('image');
        }
        return $this->render(array(
            'user' => $user
        ), 'insert_submit');
    }

    public function updateAction(){
        $user = $this->session->get('user');
        $user_id = $user['id'];

        $result = $this->db_manager->get('Save')->showSave($user_id);

        // エラーメッセージを格納する
        $errors = array();
        if(empty($result)){
            $errors[] = '更新できるシートがありません。登録処理を行ってください。';
        }
        return $this->render(array(
            'user' => $user,
            'errors' => $errors,
            'result' => $result,
            '_token' => $this->generateCsrfToken('save/update')
        ), 'update');
    }

    public function updateConfirmAction(){
        $user = $this->session->get('user');
        $user_id = $user['id'];
        $token = $this->request->getPost('_token');
        $save_id = $this->request->getPost('save_id');
        $save_reason = $this->request->getPost('save_reason');
        $save_money = $this->request->getPost('save_money');
        $save_wish = $this->request->getPost('save_wish');
        $save_patience = $this->request->getPost('save_patience');
        $save_img = $_FILES['image']['name'];

        // エラーメッセージを格納する
        $errors = array();

        if(empty($save_reason)){
            $errors['save_reason'] = '貯金する理由を入力してください。';
        }

        if(empty($save_money)){
            $errors['save_money'] = '貯金目標金額を入力してください';
        }

        if(empty($save_wish)){
            $errors['save_wish'] = '貯金して叶えたいことを入力してください。';
        }

        if(empty($save_patience)){
            $errors['save_patience'] = '貯金する時に我慢すべきことを入力してください。';
        }

        // 画像ファイルがアップロードされた時のチェック
        if(isset($save_image)){
            $max_size = 4 * 1024 * 1024;
            $file_upload = false;
            if(isset($_FILES['image'])){
                if(check_image() == false){
                    $errors['extension'] = 'ファイルの拡張子はJPEGかPNGでアップロードしてください。';
                }else if($_FILES['image']['size'] > $max_size){
                    $errors['size'] = 'ファイルのサイズは4MB以下でアップロードしてください。';
                }elseif(!$file = fopen($_FILES['image']['tmp_name'], 'rb')){
                    $errors['fopen'] = '画像を開けませんでした。';
                }else{
                    $image = fread($file, $_FILES['image']['size']);
                    $tmp_name = $_FILES['image']['tmp_name'];
                    $finfo = new finfo(FILEINFO_MIME_TYPE);
                    $extension = $finfo->file($tmp_name);
                    fclose($file);
                    if(!$image){
                        $errors['image'] = '画像を開けませんでした。';
                    }else{
                        $file_upload = true;
                    }
                }
                $fname = $_FILES['image']['name'];
            }
        }

        if(count($errors) > 1){
            $result = $this->db_manager->showSave($user_id);
            return $this->render(array(
                'user' => $user,
                'errors' => $errors,
                'result' => $result,
                '_token' => $this->generateCsrfToken('save/update')
            ), 'update');
        }

        return $this->render(
                array(
                    'user' => $user,
                    'save_id' => $save_id,
                    'save_reason' => $save_reason,
                    'save_money' => $save_money,
                    'save_wish' => $save_wish,
                    'save_patience' => $save_patience,
                    'save_img' => $save_img,
                    '_token' => $this->generateCsrfToken('save/update/confirm')
                ), 'update_confirm');
    }

    public function updateSubmitAction(){
        $user = $this->session->get('user');
        $user_id = $user['id'];
        $update_back = $this->request->getPost('update_back');

        // 確認画面で戻るボタンが押された場合
        if(isset($update_back)){
            $result = $this->db_manager->showSave($user_id);
            $this->redirect('save/update');
            return $this->render(array(
                'user' => $user,
                'result' => $result,
                '_token' => $this->generateCsrfToken('save/update/confirm')
            ), 'update');
        }

        $save_id = $this->request->getPost('save_id');

        // 更新処理を実行
        $this->db_manager->get('Save')->updateSave($user_id, $save_id);

        return $this->render(array(
            'user' => $user,
            '_token' => $this->generateCsrfToken('save/update/submit')
        ), 'update_submit');
    }
}
?>