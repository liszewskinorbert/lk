<header>
	<ul class="d-flex justify-content-end nav bg-light">
		<?php foreach ($menu as $key => $value): ?>
			<li class="nav-item">
				<a class="nav-link active" href="<?= $value ?>"><?= $key ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</header>