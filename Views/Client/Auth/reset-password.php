<?php

$errors = $_SESSION["errors"] ?? [];
$old_data = $_SESSION["old_data"] ?? [];
unset($_SESSION["errors"], $_SESSION["old_data"]);

?>
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

                        <form id="resetPasswordForm" method="post" action="?page=reset-password&action=handle">
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
								<label for="reset_token" class="form-label">Mã xác thực</label>
                                <input type="text" class="form-control" id="reset_token" name="reset_token"
                                       placeholder="Nhập mã xác thực từ email"
                                       value="<?= $old_data["reset_token"] ?? "" ?>">
                                <?php if (isset($errors["reset_token"])): ?>
                                    <div class="text-danger"><?= $errors["reset_token"] ?></div>
                                <?php endif; ?>
							</div>


							<div class="mb-3">
								<label for="new_password" class="form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                       placeholder="Nhập mật khẩu mới">
                                <?php if (isset($errors["password"])): ?>
                                    <div class="text-danger"><?= $errors["password"] ?></div>
                                <?php endif; ?>
								<div id="password-strength" class="password-strength"></div>
							</div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Mật lại khẩu mới</label>
                                <input type="password" class="form-control" id="confirm_password"
                                       name="confirm_password" placeholder="Nhập lại mật khẩu mới">
                                <?php if (isset($errors["password"])): ?>
                                    <div class="text-danger"><?= $errors["password"] ?></div>
                                <?php endif; ?>
                                <div id="password-strength" class="password-strength"></div>
                            </div>


                            <button type="submit" name="reset-password" class="btn btn-reset-password">
								<i class="fa fa-check me-2"></i>Đặt lại mật khẩu
							</button>
						</form>

						<div class="reset-password-links">
							<p class="mb-0">
                                <a href="?page=login&action=index">Quay lại đăng nhập</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- Reset Password Section End -->