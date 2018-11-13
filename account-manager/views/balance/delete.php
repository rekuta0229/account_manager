
<?php $this->setLayoutVar('title', '仕訳削除画面') ?>

<h2>仕訳削除</h2>

<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>
<ul>
	<li><a href = "<?php echo $base_url; ?>/balance/show">残高の照会</a></li>
	<li><a href = "<?php echo $base_url; ?>/balance/insert">残高の新規登録</a></li>
	<li><a href = "<?php echo $base_url; ?>/balance/update">残高の更新</a></li>
</ul>

<form action="<?php echo $base_url; ?>/balance/delete" method="post" >
<select name = "year">
<?php
for($year = 2010; $year <= date(Y) + 3; $year++){
    echo '<option value = ' . $year . '>' . $year . '年</option>';
}
?>
</select>
<select name = "month">
<?php
for($month = 1; $month <= 12; $month++){
    echo '<option value =' . $month . '>' . $month . '月</option>';
}
?>
</select>
<input type="submit" name="date" value="表示する">
</form>

<form action = "<?php echo $base_url; ?>/balance/delete/confirm" method = "post">
<?php if (isset($errors) && count($errors) > 0):?>
<?php echo $this->render('errors', array('errors' => $errors));?>
<?php else:?>
<?php foreach ($result as $balance):?>
<table>
	<tr>
		<th>チェック欄</th>
		<th>日付</th>
		<th>用途</th>
		<th>入金額</th>
		<th>出金額</th>
	</tr>
	<tr>
		<td><input type = "checkbox" name = "delete_flag[]" value ="<?php echo $this->escape($balance["balance_id"]);?>"></td>';
		<td><?php echo $this->escape($balance["date"]);?></td>
		<td><?php echo $this->escape($balance["contents"]);?></td>
		<td><?php echo $this->escape($balance["deposit"]);?></td>
		<td><?php echo $this->escape($balance["payment"]);?></td>
	</tr>
</table>
<?php endforeach;?>
<input type = "submit" name = "delete" value = "内容を削除する">
<?php endif;?>
</form>