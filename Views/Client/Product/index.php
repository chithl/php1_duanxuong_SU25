<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="Assets/Client/img/breadcrumb.jpg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="breadcrumb__text">
					<h2>Danh sách sản phẩm</h2>
					<div class="breadcrumb__option">
						<a href="index.php">Trang chủ</a>
						<span>Danh sách sản phẩm</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
	<div class="container">
		<div class="row">

		</div>
	</div>
	</div>
	<div class="col-lg-9 col-md-10 mx-auto">
		<div class="product__discount">
			<div class="section-title product__discount__title">
				<h2>Giảm giá</h2>
			</div>
			<div class="row">
				<div class="product__discount__slider owl-carousel">
                    <?php foreach ($products as $pro):
                        if ($pro['status'] === 'available' && $pro['discount_price'] > 0) : ?>
					<div class="col-lg-4">
						<div class="product__discount__item">
							<div class="product__discount__item__pic set-bg" data-setbg="Uploads/Products/<?= $pro['image']; ?>">
								<div class="product__discount__percent"> - <?= round(100 - $pro['discount_price'] / $pro['price'] * 100,
                                        1) ?>%
								</div>
								<ul class="product__item__pic__hover">
									<li><a href="#"><i class="fa fa-heart"></i></a></li>
									<li><a href="#"><i class="fa fa-retweet"></i></a></li>
									<li><a href="index.php?page=add-to-cart&id=<?= $pro['id'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
								</ul>
							</div>
							<div class="product__discount__item__text">
								<span><?= $pro['category_name'] ?></span>
								<h5>
									<a href="?page=product-detail&id=<?= $pro['id'] ?>"><?= $pro['name'] ?></a>
								</h5>
								<div class="product__item__price"><?= number_format($pro['discount_price']) ?> đ
									<span><?= number_format($pro['price']) ?> đ</span></div>
							</div>
						</div>
					</div>
                        <?php endif; endforeach; ?>
				</div>
			</div>
		</div>

		<div class="section-title product__discount__title">
			<h2>Tất cả sản phẩm</h2>
		</div>
		<div class="row">
            <?php foreach ($products as $pro) :
                if ($pro['status'] === 'available' && $pro['discount_price'] === 0) : ?>
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="product__item">
					<div class="product__item__pic set-bg" data-setbg="Uploads/Products/<?= $pro['image']; ?>">
						<ul class="product__item__pic__hover">
							<li><a href="#"><i class="fa fa-heart"></i></a></li>
							<li><a href="#"><i class="fa fa-retweet"></i></a></li>
							<li><a href="index.php?page=add-to-cart&id=<?= $pro['id'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
						</ul>
					</div>
					<div class="product__item__text">
						<h6>
							<a href="?page=product-detail&id=<?= $pro['id'] ?>"><?= $pro['name'] ?></a>
						</h6>
						<h5><?= number_format($pro['price']) ?>đ</h5>
					</div>
				</div>
			</div>
                <?php endif; endforeach; ?>
		</div>
	</div>
	</div>
	</div>
</section><!-- Product Section End -->