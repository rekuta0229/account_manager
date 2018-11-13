<?php $this->setLayoutVar('title', '貯金目標シート更新確認画面') ?>

<h2>貯金目標シート 更新確認画面</h2>
<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>

<form action="<?php echo $base_url; ?>/save/update/submit" method="post" enctype = "multipart/form-data">
    <input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />
    <table>
    	<input type = "hidden" name = "save_id" value ="<?php echo $this->escape($save_id);?>">
    	<tr>
    		<th>あなたが貯金する理由は何ですか</th>
    		<td><?php echo $this->escape($save_reason);?>/td>
    	</tr>
    	<tr>
    		<th>貯金目標金額はいくらですか</th>
    		<td><?php echo $this->escape($save_money);?></td>
    	</tr>
    	<tr>
    		<th>貯金したら叶えたいことは何ですか</th>
    		<td><?php echo $this->escape($save_wish);?></td>
    	</tr>
    	<tr>
    		<th>貯金をする時我慢しなければならないことは何ですか</th>
    		<td><?php echo $this->escape($save_patience);?>></td>
    	</tr>
    	<tr>
    		<th>具体的なイメージが浮かんでいれば画像もぜひ!!</th>
    		<td><<?php echo $this->escape($save_image);?>></td>
    	</tr>
    </table>
    <p>
    	<input type = "submit" name = "update_back" value = "入力画面に戻る">
    </p>
    <p>
        <input type="submit" name = "update_submit"value="入力内容を登録する" />
    </p>
</form>