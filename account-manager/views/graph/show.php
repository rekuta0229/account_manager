<?php $this->setLayoutVar('title', '仕訳比較画面') ?>
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

<canvas id="myBarChart" width = "800" height = "400"></canvas>
<script type = "text/javascript">
	// 棒グラフ
	var ctx = document.getElementById("myBarChart").getContext('2d');
	var myBarChart = new Chart(ctx, {
		// グラフの種類
		type: 'bar',

		// データの設定
		data: {
			// 横軸のラベル
			labels: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
			// 表示データのセット
			datasets: [{
				// 凡例
				label: "入金額",
				// 背景色
				backgroundColor: "rgba(75,192,192,0.4)",
				// 枠線の色
				borderColor: "rgba(75,192,192,1)",
				// グラフのデータ
				data: <?php echo $deposit_arr;?>
				}, {
				// 凡例
				label: "出金額",
				// 背景色
				backgroundColor: "rgba(75,192,192,0.4)",
				// 枠線の色
				borderColor: "rgba(75,192,192,1)",
				// グラフのデータ
				data: <?php echo $payment_arr;?>
			}]
		},
		// オプション設定
		optipns: {
			// 軸の設定
			scales: {
				// 縦軸
				yAxes: [{
					// 目盛り
					ticks:{
						// 開始値は0
						beginAtZero:true,
					}
				}]
			}
		}
	});
</script>
</body>
</html>
</body>
</html>
