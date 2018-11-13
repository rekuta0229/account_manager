<?php $this->setLayoutVar('title', '仕訳新規登録') ?>

<h2>仕訳 新規登録</h2>

<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>

<?php if (isset($errors) && count($errors) > 0):?>
<?php echo $this->render('errors', array('errors' => $errors));?>
<?php endif;?>

<form action = "<?php echo $base_url; ?>/balance/insert/confirm" method = "post">
	<table>
		<tr>
			<th>日付</th>
			<td><input type = "date" name = "date"></td>
		</tr>
		<tr>
			<th>用途</th>
			<td><input type = "text" name = "contents"></td>
		</tr>
		<tr>
			<th>入金額</th>
			<td><input type = "number" name = "deposit"></td>
		</tr>
		<tr>
			<th>出金額</th>
			<td><input type = "number" name = "payment"></td>
		</tr>
	</table>
	<input type = "submit" name = "insert_confirm" value = "入力内容を確認する">
</form>