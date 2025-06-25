<!-- Login Section Begin -->
<section class="login-section">
	<div class="container">
		<div class="login-container">
			<div class="row justify-content-center">
				<!-- Login Form -->
				<div class="col-lg-12 col-md-8">
					<div class="login-right">
						<h2 class="login-title">Đăng nhập</h2>

						<form id="loginForm" method="post" action="">
							<div class="mb-3">
								<label for="name" class="form-label">Tên người dùng</label>
								<input type="text" class="form-control" id="text" name="username" placeholder="Nhập tên người dùng của bạn">
							</div>

							<div class="mb-3">
								<label for="password" class="form-label">Mật khẩu</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
							</div>

							<div class="mb-3 d-flex justify-content-between align-items-center">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="remember" name="remember">
									<label class="form-check-label" for="remember">
										Ghi nhớ đăng nhập
									</label>
								</div>
								<a href="?page=forgot-password" class="forgot-password">Quên mật khẩu?</a>
							</div>

							<button type="submit" class="btn btn-login">
								<i class="fa fa-sign-in me-2"></i>Đăng nhập
							</button>
						</form>

						<div class="login-links">
							<p class="mb-0">Chưa có tài khoản?
								<a href="?page=register">Đăng ký ngay</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- Login Section End -->