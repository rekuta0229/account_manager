<?php $this->setLayoutVar('title', '貯金目標シート') ?>

<h2>貯金目標　画像表示</h2>

<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>

<?php
// 画像の拡張子を指定
if($extension === "image/jpeg"){
    header("Content-Type :" . $extension);
    header("X-Content-Type-Options: nosniff");
}
if($extension === "image/png"){
    header("Content-Type :" . $extension);
    header("X-Content-Type-Options: nosniff");
}
<img src= "data:".<?php echo $extension;?>.";base64,".<?php echo base64_encode($image);>>>

?>