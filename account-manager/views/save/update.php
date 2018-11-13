<?php $this->setLayoutVar('title', '貯金目標シート更新画面') ?>

<h2>貯金目標シート更新画面</h2>
<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>

<?php if (isset($errors) && count($errors) > 0): ?>
<?php echo $this->render('errors', array('errors' => $errors)) ?><br>
<?php endif; ?>

<form action="<?php echo $base_url; ?>/save/update/confirm"
	method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token"
		value="<?php echo $this->escape($_token); ?>" />
<?php if (isset($errors) && count($errors) > 0): ?>
    <a href="<?php echo $base_url; ?>/save/insert">シート登録画面へ移動</a>
<?php else:?>
<?php foreach ($result as $save):?>
<table>
		<input type="hidden" name="save_id" value="<?php echo $this->escape($save["save_id"]);?>">
		<tr>
			<th>あなたが貯金する理由は何ですか</th>
			<td><textarea name="save_reason" rows="5" cols="80"></textarea></td>
		</tr>
		<tr>
			<th>貯金目標金額はいくらですか</th>
			<td><input type="number" name="save_money" size="15"></td>
		</tr>
		<tr>
			<th>貯金したら叶えたいことは何ですか</th>
			<td><textarea name="save_wish" rows="5" cols="80"></textarea></td>
		</tr>
		<tr>
			<th>貯金をする時我慢しなければならないことは何ですか</th>
			<td><textarea name="save_patience" rows="5" cols="80"></textarea></td>
		</tr>
		<tr>
			<th>具体的なイメージが浮かんでいれば画像もぜひ!!</th>
			<td><input type="file" name="save_image"></td>
		</tr>
	</table>
<?php endforeach;?>
<p>
		<input type="submit" name="update_confirm" value="入力内容を確認する" />
	</p>
<?php endif;?>
</form>
