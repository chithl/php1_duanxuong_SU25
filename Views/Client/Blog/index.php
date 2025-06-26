<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="Assets/Client/img/breadcrumb.jpg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="breadcrumb__text">
					<h2>Bài viết</h2>
					<div class="breadcrumb__option">
						<a href="index.php">Trang chủ</a>
						<span>Bài viết</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-5">
				<div class="blog__sidebar">
					<div class="blog__sidebar__search">
						<form method="GET" action="">
							<input type="hidden" name="page" value="blog-list">
							<input type="hidden" name="action" value="blogList">
							<!--							<input type="hidden" name="category" value="--><?php //= htmlspecialchars($_GET['category'] ?? '') ?><!--">-->
                            <?php if (!empty($_GET['category'])): ?>
								<input type="hidden" name="category" value="<?= htmlspecialchars($_GET['category']) ?>">
                            <?php endif; ?>

							<input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
							<button type="submit"><span class="icon_search"></span></button>
						</form>
					</div>

					<div class="blog__sidebar__item">
						<h4>Loại sản phẩm</h4>
						<ul>
							<li><a href="?page=blog-list&action=blogList">Tất cả</a></li>
                            <?php foreach ($blogs_categories as $cat): ?>
								<li>
									<a href="?page=blog-list&action=blogList&category=<?= $cat['id'] ?>">
                                        <?= htmlspecialchars($cat['name']) ?> (<?= $cat['count'] ?>)
									</a>
								</li>
                            <?php endforeach; ?>

						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-8 col-md-7">
				<div class="row">
                    <?php if (empty($blogs)): ?>
						<div class="col-12 text-center">
							<p>Không có sản phẩm nào phù hợp.</p>
						</div>
                    <?php else: ?><?php foreach ($blogs as $blog): ?>
						<!-- existing blog item code -->
                    <?php endforeach; ?><?php endif; ?>
                    <?php foreach ($blogs as $blog): ?>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="blog__item">
								<div class="blog__item__pic">
									<img src="Uploads/Blogs/<?= htmlspecialchars($blog['image']) ?>" alt="">
								</div>
								<div class="blog__item__text">
									<ul>
										<li>
											<i class="fa fa-calendar-o"></i>
                                            <?= date('d/m/Y', strtotime($blog['created_at'])) ?>
										</li>
									</ul>
									<h5>
										<a href="?page=blog-detail&action=blogDetail&id=<?= $blog['id'] ?>">
                                            <?= htmlspecialchars($blog['title']) ?>
										</a>
									</h5>
									<p><?= htmlspecialchars(mb_strimwidth($blog['content'], 0, 100,
                                            '...')) ?></p>
									<a href="?page=blog-detail&action=blogDetail&id=<?= $blog['id'] ?>" class="blog__btn">
										Đọc thêm <span class="arrow_right"></span>
									</a>
								</div>
							</div>
						</div>
                    <?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>