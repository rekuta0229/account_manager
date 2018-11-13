<?php $this->setLayoutVar('title', '仕訳更新') ?>

<h2>仕訳更新</h2>
<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>

<form action="<?php echo $base_url; ?>/balance/update" method="post">
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

<form action = "<?php echo $base_url; ?>/balance/update/input" method = "post">
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
		<td><input type = "checkbox" name = "update_flag[]" value = "<?php echo $this->escape($balance["balance_id"]);?>"></td>
		<td><?php echo $this->escape($balance["date"]);?></td>
		<td><?php echo $this->escape($balance["contents"]);?></td>
		<td><?php echo $this->escape($balance["deposit"]);?></td>
		<td><?php echo $this->escape($balance["payment"]);?></td>
	</tr>
</table>
<?php endforeach;?>
<?php endif;?>
<input type = "submit" name = "update_input" value = "更新内容の入力">
</form>