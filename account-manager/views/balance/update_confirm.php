<?php $this->setLayoutVar('title', '仕訳更新確認画面') ?>

<h2>仕訳更新確認</h2>

<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>

<h3>下記の内容で更新します。よろしいですか?</h3>
<form action = "<?php echo $base_url; ?>/balance/update/submit" method = "post">
        <table>
        	<tr>
        		<input type = "hidden" name = "balance_id" value="<?php echo $this->escape($balance_id);?>">
        	</tr>
        	<tr>
        		<th>日付</th>
        		<td><?php echo $this->escape($date);?></td>
        		<input type = "hidden" name = "date" value="<?php echo $this->escape($date);?>">
        	</tr>
        	<tr>
        		<th>用途</th>
        		<td><?php echo $this->escape($contents)?></td>
        		<input type = "hidden" name = "contents" value="<?php echo $this->escape($contents)?>">
        	</tr>
        	<tr>
        		<th>入金額</th>
        		<td><?php echo $this->escape($deposit);?></td>
        		<input type = "hidden" name = "deposit" value="<?php echo $this->escape($deposit);?>">
        	</tr>
        	<tr>
        		<th>出金額</th>
        		<td><?php echo $this->escape($payment);?></td>
        		<input type = "hidden" name = "payment" value="<?php echo $this->escape($payment);?>">
        	</tr>
        </table>
        <input type = "submit" name = "update_recall" value = "入力画面に戻る">
        <input type = "submit" name = "update_submit" value = "更新内容を登録する">
</form>