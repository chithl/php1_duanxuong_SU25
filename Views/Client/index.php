<!-- Categories Section Begin -->
<section class="categories">
	<div class="container">
		<div class="row">
			<div class="categories__slider owl-carousel">
                <?php
                foreach ($category as $item => $value):
                    ?>
					<div class="col-lg-3">
						<div class="categories__item set-bg" data-setbg="Uploads/Category/<?= $value['image'] ?>">
							<h5><a href="#"><?= $value["name"] ?></a></h5>
						</div>
					</div>
                <?php
                endforeach;
                ?>
			</div>
		</div>
	</div>
</section><!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2>Sản phẩm nổi bật</h2>
				</div>
			</div>
		</div>
		<div class="row featured__filter">
			<div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
				<?php
					foreach($product as $key => $value):
				?>
				<div class="featured__item">
					<div class="featured__item__pic set-bg" data-setbg="Uploads/Products/<?= $value["image"] ?? "" ?>">
						<ul class="featured__item__pic__hover">
							<li><a href="#"><i class="fa fa-heart"></i></a></li>
							<li><a href="#"><i class="fa fa-retweet"></i></a></li>
							<li><a href="index.php?page=add-to-cart&id=<?= $value["id"] ?>"><i class="fa fa-shopping-cart"></i></a></li>
						</ul>
					</div>
					<div class="featured__item__text">
						<h6><a href="#"><?= $value["name"] ?></a></h6>
						<h5><?= number_format($value["price"]) ?> đ</h5>
					</div>
				</div>
				<?php
					endforeach;
				?>
			</div>
		</div>
	</div>
</section><!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="banner__pic">
					<img src="../Assets/Client/img/banner/banner-1.jpg" alt="">
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="banner__pic">
					<img src="../Assets/Client/img/banner/banner-2.jpg" alt="">
				</div>
			</div>
		</div>
	</div>
</div><!-- Banner End -->

<!-- Latest Product Section Begin -->
<!--<section class="latest-product spad">-->
<!--	<div class="container">-->
<!--		<div class="row">-->
<!--			<div class="col-lg-4 col-md-6">-->
<!--				<div class="latest-product__text">-->
<!--					<h4>Latest Products</h4>-->
<!--					<div class="latest-product__slider owl-carousel">-->
<!--						<div class="latest-prdouct__slider__item">-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-1.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-2.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-3.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--						</div>-->
<!--						<div class="latest-prdouct__slider__item">-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-1.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-2.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-3.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="col-lg-4 col-md-6">-->
<!--				<div class="latest-product__text">-->
<!--					<h4>Top Rated Products</h4>-->
<!--					<div class="latest-product__slider owl-carousel">-->
<!--						<div class="latest-prdouct__slider__item">-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-1.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-2.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-3.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--						</div>-->
<!--						<div class="latest-prdouct__slider__item">-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-1.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-2.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-3.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="col-lg-4 col-md-6">-->
<!--				<div class="latest-product__text">-->
<!--					<h4>Review Products</h4>-->
<!--					<div class="latest-product__slider owl-carousel">-->
<!--						<div class="latest-prdouct__slider__item">-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-1.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-2.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-3.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--						</div>-->
<!--						<div class="latest-prdouct__slider__item">-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-1.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-2.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--							<a href="#" class="latest-product__item">-->
<!--								<div class="latest-product__item__pic">-->
<!--									<img src="../Assets/Client/img/latest-product/lp-3.jpg" alt="">-->
<!--								</div>-->
<!--								<div class="latest-product__item__text">-->
<!--									<h6>Crab Pool Security</h6>-->
<!--									<span>$30.00</span>-->
<!--								</div>-->
<!--							</a>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</section><!-- Latest Product Section End -->-->