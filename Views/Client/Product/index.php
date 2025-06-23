<div class="container">
	<div class="row">
        <?php foreach ($products as $pro): ?>

			<div class="col-sm-4">
				<div class="card text-left">
					<a href="?page=product-detail">
						<img class="card-img-top" src="Uploads/Products/<?= $pro['image'] ?>" alt="">
					</a>
					<div class="card-body">
						<h4 class="card-title"><?= $pro['name'] ?></h4>
						<h4 class="card-title"><?= number_format($pro['price']) ?></h4>
						<p class="card-text"><?= $pro['description'] ?></p>
					</div>


				</div>
			</div>

        <?php endforeach; ?>
	</div>
</div>