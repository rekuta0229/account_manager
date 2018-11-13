<?php $this->setLayoutVar('title', '仕訳新規登録確認画面') ?>

<h2>仕訳 新規登録確認</h2>

<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>
<h3>下記の内容を登録します。よろしいですか?</h3>

<form action="<?php echo $base_url; ?>/balance/insert/submit" method="post">
<table>
    <tr>
    	<th>日付</th>
    	<td><?php echo $this->escape($date);?></td>
    	<input type = "hidden" name = "date" value ="<?php echo $this->escape($date);?>">
	</tr>
	<tr>
		<th>用途</th>
		<td><?php echo $this->escape($contents);?></td>
    	<input type = "hidden" name = "date" value ="<?php echo $this->escape($contents);?>">
	</tr>
	<tr>
		<th>入金額</th>
		<td><?php echo $this->escape($deposit);?></td>
		<input type = "hidden" name = "deposit" value ="<?php echo $this->escape($deposit);?>">
	</tr>
	<tr>
		<th>出金額</th>
		<td><?php echo $this->escape($payment);?></td>
		<input type = "hidden" name = "payment" value ="<?php echo $this->escape($payment);?>">
	</tr>
</table>
<p><input type="submit" name="insert_back" value="入力画面に戻る"></p>
<p><input type="submit" name="register" value= "入力内容を登録する"></p>
</form>