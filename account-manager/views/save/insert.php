<?php $this->setLayoutVar('title', '貯金目標シート新規入力画面') ?>

<h2>貯金目標シート新規入力画面</h2>

<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>

<a href="<?php echo $base_url;?>/save">シート操作一覧へ移動</a>

<?php if (isset($errors) && count($errors) > 0): ?>
<?php echo $this->render('errors', array('errors' => $errors)) ?>
<?php endif; ?>

<form action="<?php echo $base_url; ?>/save/insert/confirm" method="post" enctype = "multipart/form-data">
    <table>
    	<tr>
    		<th>あなたが貯金する理由は何ですか</th>
    		<td><textarea name = "save_reason" rows = "5" cols = "80" ></textarea></td>
    	</tr>
    	<tr>
    		<th>貯金目標金額はいくらですか</th>
    		<td><input type = "number" name = "save_money" size = "15" ></td>
    	</tr>
    	<tr>
    		<th>貯金したら叶えたいことは何ですか</th>
    		<td><textarea name = "save_wish" rows = "5" cols = "80" ></textarea></td>
    	</tr>
    	<tr>
    		<th>貯金をする時我慢しなければならないことは何ですか</th>
    		<td><textarea name = "save_patience" rows = "5" cols = "80" ></textarea></td>
    	</tr>
    	<tr>
    		<th>具体的なイメージが浮かんでいれば画像もぜひ!!</th>
    		<td><input type = "file" name = "save_image"></td>
    	</tr>
    </table>
    <p><input type="submit" name = "save_confirm" value="入力内容を確認する" /></p>
</form>