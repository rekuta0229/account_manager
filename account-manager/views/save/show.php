<?php $this->setLayoutVar('title', '貯金目標シート照会画面')?>

<h2>貯金目標シート 照会画面</h2>

<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>

<a href="<?php echo $base_url; ?>/save">シート操作一覧へ移動</a>


<?php
// 画面に表示する値を格納する
$reason = null;
$money = null;
$wish = null;
$patience = null;
$image = null;
foreach($save_result as $save){
    $reason = $save["save_reason"];
    $money = $save["save_money"];
    $wish = $save["save_wish"];
    $patience = $save["save_patience"];
    $extension = $save["save_extension"];
    $image = $save["save_image"];
}
?>

<table>
	<tr>
		<th>あなたが貯金する理由は何ですか</th>
		<td><?php echo $this->escape($reason);?></td>
	</tr>
	<tr>
		<th>貯金目標金額はいくらですか</th>
		<td><?php echo $this->escape($money);?></td>
	</tr>
	<tr>
		<th>貯金したら叶えたいことは何ですか</th>
		<td><?php echo $this->escape($wish);?></td>
	</tr>
	<tr>
		<th>貯金をする時我慢しなければならないことは何ですか</th>
		<td><?php echo $this->escape($patience);?></td>
	</tr>
	<tr>
		<th>画像ファイル</th>
		<td><input type="button" id = "file1" value = "保存した画像を表示" onClick="imageView()" multiple/></td>
	</tr>
</table>

<img id = "img1" src"" />

<script type = "text/javascript">
function imageView(){
	var xhr = new XMLHttpRequest();
	xhr.open('GET' , fp , true);
	xhr.responseType = 'blob';
	xhr.onload = (e) =>{

		// Blobを取得
		var blob = e.target.response;

		// BLOBwoURLスキームに変換して、img要素にセット
		var blob_url = window.URL.createObjectURL(blob);
		$('#img1').attr('src' ,blob_url);
	};
	xhr.send();
}
</script>
