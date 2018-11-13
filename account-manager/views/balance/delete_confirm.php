<?php $this->setLayoutVar('title', '仕訳削除確認画面') ?>

<h2>仕訳 削除確認</h2>

<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>


<h3>下記の内容を削除します。よろしいですか?</h3>
<form action = "<?php echo $base_url; ?>/balance/delete/submit" method = "post">
    <table>
    <?php foreach ($delete_flag as $balance_id):?>
     	<input type = "hidden" name = "balance_id" value = "<?php echo $this->escape($balance_id);?>">;
    <?php endforeach;?>
    <?php foreach($result as $balance):?>
        <tr>
        <th>日付</th>
        <td><?php echo $this->escape($balance["date"]);?></td>
        </tr>
        <tr>
        <th>用途</th>
      	<td><?php echo $this->escape($balance["contents"]);?></td>
        </tr>
        <tr>
        	<th>入金額</th>
        	<td><?php echo $this->escape($balance["deposit"]);?></td>
        </tr>
        <tr>
        	<th>出金額</th>
			<td><?php echo $this->escape($balance["payment"]);?></td>
        </tr>
    <?php endforeach;?>
    </table>
    <input type = "submit" name = "delete_recall" value = "選択画面に戻る">
    <input type = "submit" name = "delete_submit" value = "内容を削除する">
</form>