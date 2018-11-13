<?php $this->setLayoutVar('title', '残高操作一覧') ?>

<h2>仕訳操作一覧</h2>
<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>

<input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />

<div class = "balance">

<div class = "balance_show">
	<h3>仕訳の照会</h3>
	<p>あなたが登録している仕訳を<br>
	一覧で確認できます。</p>
	<a href = "<?php echo $base_url; ?>/balance/show">仕訳の照会</a>
</div>
<div class = "balance_insert">
	<h3>仕訳の登録</h3>
	<p>入金や出金の内容や額を<br>
	新規で追加できます。</p>
	<a href = "<?php echo $base_url; ?>/balance/insert">仕訳の新規登録</a>
</div>
<div class = "balance_update">
	<h3>仕訳の更新</h3>
	<p>既に登録されている仕訳を<br>
	修正できます。</p>
	<a href = "<?php echo $base_url; ?>/balance/update">仕訳の更新</a>
</div>
<div class = "balance_delete">
	<h3>仕訳の削除</h3>
	<p>既に登録されている仕訳を<br>
	修正できます。</p>
	<a href = "<?php echo $base_url; ?>/balance/delete">仕訳の削除</a>
</div>
</div>