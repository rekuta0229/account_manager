<?php $this->setLayoutVar('title', '仕訳更新完了画面') ?>

<h2>仕訳更新完了</h2>

<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>

<h3>仕訳の更新が完了しました。</h3>

<ul>
	<li><a href = "<?php echo $base_url; ?>/balance/show">残高の照会</a></li>
	<li><a href = "<?php echo $base_url; ?>/balance/insert">残高の新規登録</a></li>
	<li><a href = "<?php echo $base_url; ?>/balance/update">残高の更新</a></li>
	<li><a href = "<?php echo $base_url; ?>/balance/delete">残高の削除</a></li>
</ul>
