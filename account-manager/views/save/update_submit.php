<?php $this->setLayoutVar('title', '貯金目標シート更新完了画面') ?>

<h2>貯金目標シート更新完了画面</h2>

<p>ユーザID:<a href="<?php echo $base_url; ?>/user/<?php echo $this->escape($user['user_name']); ?>">
        <strong><?php echo $this->escape($user['user_name']); ?></strong></a>
</p>

<ul>
    <li>
        <a href="<?php echo $base_url; ?>/account">ホーム</a>
    </li>
    <li>
        <a href="<?php echo $base_url; ?>/account/signout">ログアウト</a>
    </li>
</ul>

<h3>シートの更新が完了しました。</h3>

<a href = "<?php echo $base_url; ?>/save">シート画面へ移動</a>
