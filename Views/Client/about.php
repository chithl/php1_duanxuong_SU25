<!-- About Hero Section Begin -->
<style>
	.slide {
		display: none;
		display: flex;
		justify-content: center; /* ngang */
		align-items: center; /* dọc */
		height: 500px;
		background-color: #000;
	}

	.slide img {
		max-width: 100%;
		max-height: 100%;
		object-fit: contain;
	}

	.slideshow-container {
		position: relative;
		max-width: 600px;
		height: 400px;
		margin: 60px auto;
		overflow: hidden;
		border-radius: 12px;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
		background-size: cover;
		background-position: center;
	}

	.slide {
		display: none;
	}

	.slide img {
		width: 100%;
		height: auto;
		object-fit: cover;
	}

	.fade {
		animation: fade 1s ease-in-out;
	}

	@keyframes fade {
		from { opacity: 1; }
		to { opacity: 1; }
	}

	.prev, .next {
		cursor: pointer;
		position: absolute;
		top: 50%;
		transform: translateY(-50%);
		padding: 12px;
		font-size: 24px;
		background-color: rgba(0, 0, 0, 0.5);
		color: #fff;
		border: none;
		border-radius: 50%;
		z-index: 10;
		user-select: none;
	}

	.prev:hover, .next:hover {
		background-color: rgba(0, 0, 0, 0.8);
	}

	.prev { left: 20px; }
	.next { right: 20px; }

	.dots {
		text-align: center;
		padding: 12px;
	}

	.dot {
		height: 10px;
		width: 10px;
		margin: 0 4px;
		background-color: #bbb;
		border-radius: 50%;
		display: inline-block;
		transition: background 0.3s;
		cursor: pointer;
	}

	.dot.active {
		background-color: #333;
	}

</style>
<section class="about-hero">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1>Về chúng tôi</h1>
				<p>Chúng tôi cam kết mang đến những sản phẩm thực phẩm hữu cơ tươi ngon, an toàn và chất lượng cao nhất cho gia đình Việt Nam</p>
			</div>
		</div>
	</div>
</section><!-- About Hero Section End -->

<!-- Our Story Section Begin -->
<section class="about-section">
	<div class="container">
		<div class="section-title">
			<h2>Câu chuyện của chúng tôi</h2>
			<p>Từ những ý tưởng nhỏ đến việc xây dựng một thương hiệu thực phẩm hữu cơ uy tín</p>
		</div>

		<div class="story-content">
			<div class="story-text">
				<h3>Khởi đầu từ đam mê</h3>
				<p>Ogani được thành lập vào năm 2018 với sứ mệnh mang đến cho người tiêu dùng Việt Nam những sản phẩm thực phẩm hữu cơ chất lượng cao. Chúng tôi bắt đầu từ việc nhận thấy nhu cầu ngày càng tăng của người dân về thực phẩm an toàn, sạch và có nguồn gốc rõ ràng.</p>
				<p>Với đội ngũ sáng lập có kinh nghiệm lâu năm trong ngành nông nghiệp và thực phẩm, chúng tôi đã xây dựng mạng lưới đối tác nông dân tin cậy trên khắp cả nước, đảm bảo mọi sản phẩm đều đạt tiêu chuẩn hữu cơ quốc tế.</p>
			</div>
			<div class="story-image">

				<div class="slideshow-container" id="slideshow"></div>

				<div class="dots" id="dots"></div>

			</div>
		</div>

		<div class="story-content">
			<div class="story-text">
				<h3>Phát triển bền vững</h3>
				<p>Trải qua hơn 6 năm hoạt động, Ogani đã phục vụ hàng nghìn gia đình Việt Nam với các sản phẩm rau củ, trái cây, thịt cá và các thực phẩm chế biến hữu cơ. Chúng tôi không ngừng mở rộng danh mục sản phẩm và cải tiến chất lượng dịch vụ.</p>
				<p>Hệ thống cửa hàng và dịch vụ giao hàng tận nơi của chúng tôi hiện có mặt tại các thành phố lớn, giúp khách hàng dễ dàng tiếp cận với thực phẩm hữu cơ chất lượng cao mọi lúc, mọi nơi.</p>
			</div>
			<div class="story-image">
				<img src="Uploads/Avatars/anh5.jpg" alt="Phát triển Ogani">
			</div>
		</div>
	</div>
</section><!-- Our Story Section End -->

<!-- Values Section Begin -->
<section class="values-section about-section">
	<div class="container">
		<div class="section-title">
			<h2>Giá trị cốt lõi</h2>
			<p>Những nguyên tắc định hướng mọi hoạt động của chúng tôi</p>
		</div>
		<div class="row" style="row-gap: 30px;">
			<div class="col-lg-4 col-md-6">
				<div class="value-item">
					<div class="value-icon">
						<i class="fa fa-leaf"></i>
					</div>
					<h4>Hữu cơ 100%</h4>
					<p>Tất cả sản phẩm đều được sản xuất theo tiêu chuẩn hữu cơ nghiêm ngặt, không sử dụng hóa chất độc hại, đảm bảo an toàn cho sức khỏe.</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="value-item">
					<div class="value-icon">
						<i class="fa fa-heart"></i>
					</div>
					<h4>Tận tâm phục vụ</h4>
					<p>Chúng tôi luôn đặt khách hàng làm trung tâm, cam kết mang đến trải nghiệm mua sắm tốt nhất và dịch vụ chăm sóc khách hàng chu đáo.</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="value-item">
					<div class="value-icon">
						<i class="fa fa-shield"></i>
					</div>
					<h4>Chất lượng đảm bảo</h4>
					<p>Hệ thống kiểm soát chất lượng nghiêm ngặt từ nguồn gốc đến tay người tiêu dùng, đảm bảo mọi sản phẩm đều đạt tiêu chuẩn cao nhất.</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="value-item">
					<div class="value-icon">
						<i class="fa fa-globe"></i>
					</div>
					<h4>Thân thiện môi trường</h4>
					<p>Cam kết bảo vệ môi trường thông qua việc sử dụng bao bì tái chế, hỗ trợ nông nghiệp bền vững và giảm thiểu lãng phí.</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="value-item">
					<div class="value-icon">
						<i class="fa fa-truck"></i>
					</div>
					<h4>Giao hàng nhanh chóng</h4>
					<p>Hệ thống logistics hiện đại, đảm bảo giao hàng nhanh chóng và giữ nguyên độ tươi ngon của sản phẩm đến tay khách hàng.</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="value-item">
					<div class="value-icon">
						<i class="fa fa-users"></i>
					</div>
					<h4>Cộng đồng hỗ trợ</h4>
					<p>Xây dựng mối quan hệ bền vững với nông dân địa phương, hỗ trợ phát triển nông nghiệp hữu cơ và cải thiện sinh kế.</p>
				</div>
			</div>
		</div>
	</div>
</section><!-- Values Section End -->

<!-- Team Section Begin -->
<section class="team-section">
	<div class="container">
		<div class="section-title">
			<h2>Đội ngũ lãnh đạo</h2>
			<p>Những con người tài năng đứng sau thành công của Ogani</p>
		</div>

		<div class="row">
			<div class="col-lg-4 col-md-6">
				<div class="team-member">
					<div class="member-photo">
						<img src="Uploads/Avatars/anh2.jpg" alt="CEO">
					</div>
					<h4>Lê Minh Quốc Bảo</h4>
					<div class="position">Tổng Giám đốc & Người sáng lập</div>
					<p>Với hơn 15 năm kinh nghiệm trong ngành nông nghiệp, anh Bảo là người đặt nền móng cho tầm nhìn phát triển nông nghiệp hữu cơ tại Việt Nam.</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="team-member">
					<div class="member-photo">
						<img src="Uploads/Avatars/anh7.jpg" alt="CTO">
					</div>
					<h4>Nguyễn Hoàng Bảo</h4>
					<div class="position">Giám đốc Vận hành</div>
					<p>Chịu trách nhiệm quản lý chuỗi cung ứng và đảm bảo chất lượng sản phẩm từ trang trại đến bàn ăn của khách hàng.</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="team-member">
					<div class="member-photo">
						<img src="Uploads/Avatars/anh8.jpg" alt="Marketing Director">
					</div>
					<h4>Phạm Huy Bền</h4>
					<div class="position">Giám đốc Marketing</div>
					<p>Chuyên gia marketing với kinh nghiệm phát triển thương hiệu và kết nối với cộng đồng yêu thích thực phẩm hữu cơ.</p>
				</div>
			</div>
		</div>
	</div>
</section><!-- Team Section End -->
<section class="team-section">
	<div class="container">
		<div class="section-title">
			<h2>Đội ngũ nhân viên</h2>
			<p>Những con người tài năng đứng sau thành công của Ogani</p>
		</div>

		<div class="row">
			<div class="col-lg-4 col-md-6">
				<div class="team-member">
					<div class="member-photo">
						<img src="Uploads/Avatars/anh1.jpg" alt="CEO">
					</div>
					<div class="position">Nhân Viên</div>
					<h4>Nguyễn Thị Như Ngọc</h4>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="team-member">
					<div class="member-photo">
						<img src="Uploads/Avatars/anh6.jpg" alt="CEO">
					</div>
					<div class="position">Nhân Viên</div>
					<h4>Phạm Xuân Bắc</h4>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="team-member">
					<div class="member-photo">
						<img src="Uploads/Avatars/anh9.jpg" alt="CEO">
					</div>
					<div class="position">Nhân Viên</div>

					<h4>Đinh Quốc Toàn</h4>
				</div>
			</div>
			<div class="col-lg-7 col-md-6">
				<div class="team-member">
					<div class="member-photo">
						<img src="Uploads/Avatars/anh11.jpg" alt="CEO">
					</div>
					<div class="position">Nhân Viên</div>

					<h4>Nguyễn Công Ben</h4>
				</div>
			</div>
			<div class="col-lg-2 col-md-6">
				<div class="team-member">
					<div class="member-photo">
						<img src="Uploads/Avatars/anh4.jpg" alt="CEO">
					</div>
					<div class="position">Nhân Viên</div>

					<h4>Ong Tuấn Nghĩa</h4>
				</div>
			</div>
		</div>
</section><!-- Team Section End -->

<!-- Stats Section Begin -->
<section class="stats-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="stat-item">
					<div class="stat-number">50,000+</div>
					<div class="stat-label">Khách hàng hài lòng</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="stat-item">
					<div class="stat-number">500+</div>
					<div class="stat-label">Sản phẩm chất lượng</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="stat-item">
					<div class="stat-number">200+</div>
					<div class="stat-label">Đối tác nông dân</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="stat-item">
					<div class="stat-number">25+</div>
					<div class="stat-label">Tỉnh thành phục vụ</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- Stats Section End -->

<!-- Contact CTA Section Begin -->
<section class="contact-cta">
	<div class="container">
		<div class="cta-content">
			<h2>Sẵn sàng trải nghiệm cùng chúng tôi?</h2>
			<p>Hãy để Ogani đồng hành cùng gia đình bạn trong hành trình chăm sóc sức khỏe với thực phẩm hữu cơ tươi ngon nhất</p>
			<a href="./shop-grid.html" class="btn-primary-custom">Khám phá sản phẩm</a>
			<a href="./contact.html" class="btn-primary-custom" style="margin-left: 20px;">Liên hệ với chúng tôi</a>
		</div>
	</div>
</section><!-- Contact CTA Section End -->
<script>
    const totalImages = 10;
    const slideshowContainer = document.getElementById('slideshow');
    const dotsContainer = document.getElementById('dots');

    // Tạo slide từ ảnh anh1.jpg -> anh13.jpg
    for (let i = 1; i <= totalImages; i++) {
        const slide = document.createElement('div');
        slide.className = 'slide fade';
        slide.innerHTML = `<img src="Uploads/Avatars/anh${i}.jpg" alt="Ảnh ${i}">`;
        slideshowContainer.appendChild(slide);

        const dot = document.createElement('span');
        dot.className = 'dot';
        dot.onclick = () => currentSlide(i);
        dotsContainer.appendChild(dot);
    }

    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        const slides = document.getElementsByClassName('slide');
        const dots = document.getElementsByClassName('dot');

        if (n > slides.length) {
            slideIndex = 1;
        }
        if (n < 1) {
            slideIndex = slides.length;
        }

        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = 'none';
        }

        for (let i = 0; i < dots.length; i++) {
            dots[i].classList.remove('active');
        }

        slides[slideIndex - 1].style.display = 'block';
        dots[slideIndex - 1].classList.add('active');
    }

    // Tự động chạy
    setInterval(() => {
        plusSlides(1);
    }, 1000);
</script>
