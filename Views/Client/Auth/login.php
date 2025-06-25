<?php

$errors = $_SESSION["errors"] ?? [];
$old_data = $_SESSION["old_data"] ?? [];
unset($_SESSION["errors"], $_SESSION["old_data"]);

?>
<!-- Login Section Begin -->
<section class="login-section">
	<div class="container">
		<div class="login-container">
			<div class="row justify-content-center">
				<!-- Login Form -->
				<div class="col-lg-12 col-md-8">
					<div class="login-right">
						<h2 class="login-title">Đăng nhập</h2>

                        <form id="loginForm" method="post" action="?page=login&action=handle">
							<div class="mb-3">
								<label for="name" class="form-label">Tên người dùng</label>
                                <input type="text" class="form-control" id="text" name="username"
                                       placeholder="Nhập tên người dùng của bạn"
                                       value="<?= $old_data["username"] ?? "" ?>">
                                <?php if (isset($errors["username"])): ?>
                                    <div class="text-danger"><?= $errors["username"] ?></div>
                                <?php endif; ?>
							</div>

							<div class="mb-3">
								<label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Nhập mật khẩu" value="<?= $old_data["password"] ?? "" ?>">
                                <?php if (isset($errors["password"])): ?>
                                    <div class="text-danger"><?= $errors["password"] ?></div>
                                <?php endif; ?>
							</div>

							<div class="mb-3 d-flex justify-content-between align-items-center">
                                <a href="?page=forgot-password&action=index" class="forgot-password">Quên mật khẩu?</a>
							</div>

                            <button type="submit" name="login" class="btn btn-login">
								<i class="fa fa-sign-in me-2"></i>Đăng nhập
							</button>
						</form>

						<div class="login-links">
							<p class="mb-0">Chưa có tài khoản?
                                <a href="?page=register&action=index">Đăng ký ngay</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- Login Section End -->