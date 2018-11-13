<?php $this->setLayoutVar('title', '仕訳グラフ') ?>

<h2>仕訳グラフ</h2>
<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>

<p>月々にどれくらい使ったのかをグラフで比較できます。</p>
<p>入金額と出金額の合計を比較して、あなたの節約志向を高めましょう!!!</p>


<form action="<?php echo $base_url; ?>/graph/show" method="post" >
<select name = "year">
<?php
for($year = 2010; $year <= date(Y) + 3; $year++){
    echo '<option value = ' . $year . '>' . $year . '年</option>';
}
?>
</select>
<input type="submit" name="date" value="表示する">
</form>

<?php if (isset($errors) && count($errors) > 0):?>
<?php echo $this->render('errors', array('errors' => $errors));?>
<?php endif;?>


