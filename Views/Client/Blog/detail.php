<!-- Blog Details Hero Begin -->
<section class="blog-details-hero set-bg" data-setbg="Assets/Client/img/blog/details/details-hero.jpg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="blog__details__hero__text">
					<h2><?= htmlspecialchars($blog['title']) ?></h2>
					<ul>
						<li> <?= date('d/m/Y', strtotime($blog['created_at'])) ?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section><!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-10">
				<div class="blog__details__text text-center">
					<img src="Uploads/Blogs/<?= htmlspecialchars($blog['image']) ?>" alt="" style="width: 100%; height: auto; object-fit: cover; margin-bottom: 20px;">
                    <?= html_entity_decode($blog['content']) ?>
				</div>
			</div>
		</div>
	</div>
</section><!-- Blog Details Section End -->

<!-- Related Blog Section Begin -->
<section class="related-blog spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title related-blog-title">
					<h2>Bài đăng bạn có thể thích</h2>
				</div>
			</div>
		</div>
		<div class="row">
            <?php foreach ($blogs as $blog): ?>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="blog__item">
						<div class="blog__item__pic">
							<img src="Uploads/Blogs/<?= htmlspecialchars($blog['image']) ?>" alt="">
						</div>
						<div class="blog__item__text">
							<ul>
                                <?= date('d/m/Y', strtotime($blog['created_at'])) ?>
							</ul>
							<h5><a href="?page=blog-detail&action=blogDetail&id=<?= $blog['id'] ?>">
                                <?= htmlspecialchars($blog['title']) ?></h5>
							<p><?= htmlspecialchars(mb_strimwidth($blog['content'], 0, 100,
                                    '...')) ?></p>
						</div>
					</div>
				</div>
            <?php endforeach; ?>
		</div>
	</div>
</section><!-- Related Blog Section End -->