<?php

$errors = $_SESSION["errors"] ?? [];
$old_data = $_SESSION["old_data"] ?? [];
unset($_SESSION["errors"], $_SESSION["old_data"]);

?>
<!-- Forgot Password Section Begin -->
<section class="forgot-password-section">
	<div class="container">
		<div class="forgot-password-container">
			<div class="row justify-content-center">
				<!-- Forgot Password Form -->
				<div class="col-lg-12 col-md-10">
					<div class="forgot-password-right">
						<h2 class="forgot-password-title">Quên mật khẩu</h2>

						<p class="forgot-password-description">
							Nhập tên người dùng và email của bạn để nhận liên kết đặt lại mật khẩu. </p>


                        <form id="forgotPasswordForm" method="post" action="?page=forgot-password&action=handle">
							<div class="mb-3">
								<label for="username" class="form-label">Tên người dùng</label>
                                <input type="text" class="form-control" id="username" name="username"
                                       placeholder="Nhập tên người dùng của bạn"
                                       value="<?= $old_data["username"] ?? "" ?>">
                                <?php if (isset($errors["username"])): ?>
                                    <div class="text-danger"><?= $errors["username"] ?></div>
                                <?php endif; ?>
							</div>

							<div class="mb-3">
								<label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Nhập email của bạn" value="<?= $old_data["email"] ?? "" ?>">
                                <?php if (isset($errors["email"])): ?>
                                    <div class="text-danger"><?= $errors["email"] ?></div>
                                <?php endif; ?>
							</div>

                            <button type="submit" name="forgot-password" class="btn btn-forgot-password">
                                <i class="fa fa-paper-plane me-2"></i>Gửi mã xác nhận
							</button>
						</form>

						<div class="forgot-password-links">
							<p class="mb-0">
								<a href="?page=login">Quay lại đăng nhập</a> |
								<a href="?page=register">Đăng ký tài khoản mới</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- Forgot Password Section End -->