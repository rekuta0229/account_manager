<?php $this->setLayoutVar('title', '貯金目標シート新規入力完了画面');?>

<h2>貯金目標シート入力完了画面</h2>

<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>

<h3>シートの登録が完了しました。</h3>

<a href = "<?php echo $base_url; ?>/save">シート画面へ移動</a>