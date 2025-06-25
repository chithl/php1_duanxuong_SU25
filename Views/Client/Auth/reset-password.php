<!-- Reset Password Section Begin -->
<section class="reset-password-section">
	<div class="container">
		<div class="reset-password-container">
			<div class="row justify-content-center">
				<!-- Reset Password Form -->
				<div class="col-lg-12 col-md-10">
					<div class="reset-password-right">
						<h2 class="reset-password-title">Đặt lại mật khẩu</h2>

						<p class="reset-password-description">
							Nhập thông tin bên dưới để đặt lại mật khẩu mới cho tài khoản của bạn. </p>

						<form id="resetPasswordForm" method="post" action="">
							<div class="mb-3">
								<label for="username" class="form-label">Tên người dùng</label>
								<input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên người dùng của bạn" required>
							</div>

							<div class="mb-3">
								<label for="reset_token" class="form-label">Mã xác thực</label>
								<input type="text" class="form-control" id="reset_token" name="reset_token" placeholder="Nhập mã xác thực từ email" required>
							</div>


							<div class="mb-3">
								<label for="new_password" class="form-label">Mật khẩu mới</label>
								<input type="password" class="form-control" id="new_password" name="new_password" placeholder="Nhập mật khẩu mới" required>
								<div id="password-strength" class="password-strength"></div>
							</div>


							<button type="submit" class="btn btn-reset-password">
								<i class="fa fa-check me-2"></i>Đặt lại mật khẩu
							</button>
						</form>

						<div class="reset-password-links">
							<p class="mb-0">
								<a href="login.html">Quay lại đăng nhập</a> |
								<a href="forgot-password.html">Gửi lại mã xác thực</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- Reset Password Section End -->