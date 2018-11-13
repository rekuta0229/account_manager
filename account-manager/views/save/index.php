<?php $this->setLayoutVar('title', '貯金目標シート') ?>

<h2>貯金目標入力一覧</h2>

<nav>
	<ul>
		<li><a href="<?php echo $base_url; ?>/account">ホーム</a></li>
		<li><a href="<?php echo $base_url; ?>/balance">入出金管理</a></li>
		<li><a href="<?php echo $base_url; ?>/save">貯金目標入力</a></li>
		<li><a href="<?php echo $base_url; ?>/graph">入出金グラフ</a></li>
		<li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
	</ul>
</nav>

<p>貯金目標シートを登録したり、更新できます。</p>
<p>日々の入出金の管理も重要ですが、目標を持ってお金の管理をすることも大事です。</p>
<p>将来叶えたい夢や理想的な生活を手に入れたい!!!</p>
<p>目標を持って、入出金管理をして行きましょう!!</p>

<div class="save">
	<div class="save_show">
		<h3>目標シートの照会</h3>
		<p>
			あなたが登録している貯金目標の<br> シートを一覧で確認できます。
		</p>
		<a href="<?php echo $base_url; ?>/save/show">シートの照会画面</a>
	</div>
	<div class="save_insert">
		<h3>目標シートの登録</h3>
		<p>
			まだ貯金目標を立ててないなら、<br> 是非ともシートを入力してください。
		</p>
		<a href="<?php echo $base_url; ?>/save/insert">シートの新規入力画面</a>
	</div>
</div>