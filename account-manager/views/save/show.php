<?php $this->setLayoutVar('title', '貯金目標シート照会画面')?>

<h2>貯金目標シート　照会画面</h2>

<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>

<a href = "<?php echo $base_url; ?>/save">シート操作一覧へ移動</a>

<?php foreach ($save_result as $save):?>
    <table>
        <tr>
            <th>あなたが貯金する理由は何ですか</th>
            <td><?php echo $this->escape($save["save_reason"]);?></td>
    	</tr>
    	<tr>
    		<th>貯金目標金額はいくらですか</th>
    		<td><?php echo $this->escape($save["save_money"]);?></td>
    	</tr>
    	<tr>
    		<th>貯金したら叶えたいことは何ですか</th>
    		<td><?php echo $this->escape($save["save_wish"]);?></td>
    	</tr>
    	<tr>
    		<th>貯金をする時我慢しなければならないことは何ですか</th>
    		<td><?php echo $this->escape($save["save_patience"]);?></td>
    	</tr>
<?php endforeach;?>
<?php foreach ($image_result as $image):?>
    	<tr>
    		<th>具体的なイメージが浮かんでいれば画像もぜひ!!</th>
       		<td><a href ="<?php echo $base_url;?>/image/view">画像を表示する</a></td>
    	</tr>
<?php endforeach;?>
</table>