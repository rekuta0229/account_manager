<?php

/**
 * AccountManagerApplication.
 */
class AccountManagerApplication extends Application{

    protected $login_action = array(
        'account',
        'signin'
    );

    public function getRootDir(){
        return dirname(__FILE__);
    }

    // アプリ内のルーティング
    // AccountManagerApplication::registerRoutes()
    protected function registerRoutes(){
        return array(
            '/account' => array(
                'controller' => 'account',
                'action' => 'index'
            ),
            '/account/:action' => array(
                'controller' => 'account'
            ),
            '/balance' => array(
                'controller' => 'balance',
                'action' => 'index'
            ),
            '/balance/:action' => array(
                'controller' => 'balance'
            ),
            'balance/insert' => array(
                'controller' => 'balance',
                'action' => 'insert'
            ),
            'balance/insert/confirm' => array(
                'controller' => 'balance',
                'action' => 'insertConfirm'
            ),
            'balance/insert/submit' => array(
                'controller' => 'balance',
                'action' => 'insertSubmit'
            ),
            'balance/update' => array(
                'controller' => 'balance',
                'action' => 'update'
            ),
            'balance/update/input' => array(
                'controller' => 'balance',
                'action' => 'updateInput'
            ),
            'balance/update/confirm' => array(
                'controller' => 'balance',
                'action' => 'updateConfirm'
            ),
            'balance/update/submit' => array(
                'controller' => 'balance',
                'action' => 'updateSubmit'
            ),
            'balance/delete' =>array(
                'controller' => 'balance',
                'action' => 'delete'
            ),
            'balance/delete/confirm' => array(
                'controller' => 'balance',
                'action' => 'deleteConfirm'
            ),
            'balance/delete/submit' => array(
                'controller' => 'balance',
                'action' => 'deleteSubmit'
            ),
            'image/view' => array(
                'controller' => 'save',
                'action' => 'imageView'
            ),
            'save' => array(
                'controller' => 'save',
                'action' => 'index'
            ),
            'save/:action' => array(
                'controller' => 'save'
            ),
            '/save/insert' => array(
                'controller' => 'save',
                'action' => 'insert'
            ),
            '/save/insert/confirm' => array(
                'controller' => 'save',
                'action' => 'insertConfirm'
            ),
            '/save/insert/submit' => array(
                'controller' => 'save',
                'action' => 'insertSubmit'
            ),
            'save/update' => array(
                'controller' => 'save',
                'action' => 'update'
            ),
            'save/update/confirm' => array(
                'controller' => 'save',
                'action' => 'updateConfirm'
            ),
            'save/update/submit' => array(
                'controller' => 'save',
                'action' => 'updateSubmit'
            ),
            'graph' => array(
                'controller' => 'graph' ,
                'action' => 'index'
            ),
            '/graph/show' => array(
                'controller' => 'graph',
                'action' => 'graphShow'
            )
            );
    }
    // DBの接続管理
    protected function configure(){
        $this->db_manager->connect('master', array(
            'dsn' => 'mysql:dbname=account_manager;host=localhost:8889;charset=utf8;',
            'user' => 'testuser',
            'password' => '38iVhE8iSaV6BYTT'
        ));
    }
}
?>