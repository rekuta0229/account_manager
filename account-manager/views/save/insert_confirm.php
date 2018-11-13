<?php $this->setLayoutVar('title', '貯金目標シート新規入力確認画面') ?>

<h2>貯金目標シート 新規入力確認画面</h2>

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

<form action="<?php echo $base_url; ?>/save/insert/submit" method="post" enctype = "multipart/form-data">
<input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />
<table>
	<tr>
		<th>あなたが貯金する理由は何ですか</th>
		<td><?php echo $this->escape($save_reason);?></td>
		<input type = "hidden" name = "save_reason" value ="<?php echo $this->escape($this->escape($save_reason));?>">
	</tr>
	<tr>
		<th>貯金目標金額はいくらですか</th>
		<td><?php echo $this->escape($save_money);?></td>
        <input type = "hidden" name = "save_money" value ="<?php echo $this->escape($save_money);?>">
	</tr>
	<tr>
		<th>貯金したら叶えたいことは何ですか</th>
		<td><?php echo $this->escape($save_wish);?></td>
		<input type = "hidden" name = "save_wish" value ="<?php echo $this->escape($save_wish);?>">
	</tr>
	<tr>
		<th>貯金をする時我慢しなければならないことは何ですか</th>
		<td><?php echo $this->escape($save_patience);?></td>
		<input type = "hidden" name = "save_patience" value ="<?php echo $this->escape($save_patience);?>">
	</tr>
	<tr>
		<th>具体的なイメージが浮かんでいれば画像もぜひ!!</th>
		<td><?php echo $this->escape($save_img);?></td>
    	<input type = "hidden" name = "image" value ="<?php echo $this->escape($save_image);?>">
    	<input type = "hidden" name = "extension" value ="<?php echo $this->escape($extension);?>">
	</tr>
</table>
<p><input type = "submit" name = "insert_back" value = "入力画面に戻る"></p>
<p><input type = "submit" name = "insert_submit" value ="入力内容を登録する" /></p>
</form>
