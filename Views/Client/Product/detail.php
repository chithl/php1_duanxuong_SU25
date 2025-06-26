<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="Assets/Client/img/breadcrumb.jpg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="breadcrumb__text">
					<h2>Chi tiết sản phẩm</h2>
					<div class="breadcrumb__option">


					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="product__details__pic">
					<div class="product__details__pic__item">
						<img class="product__details__pic__item--large" src="Uploads/Products/<?= $product['image'] ?>" alt="">
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="product__details__text">
					<h3><?= $product['name'] ?></h3>

					<div class="product__details__price"><?= ($product['discount_price'] == 0) ? number_format($product['price']) : number_format($product['discount_price']) ?> đ</div>
					<p><?= $product['description'] ?></p>
					<div class="product__details__quantity">
						<div class="quantity">
							<div class="pro-qty">
								<input type="text" value="1">
							</div>
						</div>
					</div>
					<a href="#" class="primary-btn">Thêm vào giỏ hàng</a>
					<ul>
						<li><b>Thời gian giao hàng</b>
							<span>3 ngày</span></li>
						<li><b>Trọng lượng</b> <span><?= $product['weight'] ?> kg</span></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="product__details__tab">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Mô tả</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tabs-1" role="tabpanel">
							<div class="product__details__tab__desc">
								<h6>Thông tin sản phẩm</h6>
								<p> <?= $product['description'] ?></p>
							</div>
						</div>
					</div>

					<div class="container">
						<div class="row">
							<div class="col-lg-12">
								<div class="section-title related-blog-title">
									<h2>Sản phẩm liên quan</h2>
								</div>
							</div>
						</div>
						<div class="row">
                            <?php foreach ($products as $product) : ?>
								<div class="col-lg-4 col-md-4 col-sm-6">
									<div class="blog__item">
										<div class="blog__item__pic">
											<img src="Uploads/Products/<?= $product['image'] ?>" alt="">
										</div>
										<div class="blog__item__text">
											<h5>
												<a href="?page=product-detail&id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
											</h5>
											<p><?= $product['description'] ?> </p>
										</div>
									</div>
								</div>
                            <?php endforeach; ?>
					</div>

					</div>
			</div>
		</div>
	</div>
</section><!-- Product Details Section End -->

