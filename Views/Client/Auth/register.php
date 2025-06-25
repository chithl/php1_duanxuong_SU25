<?php

$errors = $_SESSION["errors"] ?? [];
$old_data = $_SESSION["old_data"] ?? [];
unset($_SESSION["errors"], $_SESSION["old_data"]);

?>
<!-- Register Section Begin -->
<section class="register-section">
	<div class="container">
		<div class="register-container">
			<div class="row justify-content-center">
				<div class="col-lg-11 col-md-10">
					<div class="register-right">
						<h2 class="register-title text-center mb-4">Đăng ký tài khoản</h2>
                        <form id="registerForm" method="post" action="?page=register&action=handle"
                              enctype="multipart/form-data">
							<div class="row">
								<div class="col-12 mb-3">
                                    <label for="username" class="form-label">Tên tài khoản</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                           placeholder="Nhập tên tài khoản" value="<?= $old_data["username"] ?? "" ?>">
                                    <?php if (isset($errors["username"])): ?>
                                        <div class="text-danger"><?= $errors["username"] ?></div>
                                    <?php endif; ?>
								</div>
								<div class="col-12 mb-3">
									<label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Nhập địa chỉ email" value="<?= $old_data["email"] ?? "" ?>">
                                    <?php if (isset($errors["email"])): ?>
                                        <div class="text-danger"><?= $errors["email"] ?></div>
                                    <?php endif; ?>
								</div>
								<div class="col-12 mb-3">
									<label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                           placeholder="Nhập số điện thoại" value="<?= $old_data["phone"] ?? "" ?>">
                                    <?php if (isset($errors["phone"])): ?>
                                        <div class="text-danger"><?= $errors["phone"] ?></div>
                                    <?php endif; ?>
								</div>
								<div class="col-12 mb-3">
									<label for="birth" class="form-label">Năm sinh</label>
                                    <input type="date" class="form-control" id="birth" name="birth"
                                           value="<?= $old_data["birth"] ?? "" ?>">
                                    <?php if (isset($errors["birth"])): ?>
                                        <div class="text-danger"><?= $errors["birth"] ?></div>
                                    <?php endif; ?>
								</div>
                                <div class="col-12 mb-3">
                                    <label for="avatar" class="form-label">Ảnh đại diện</label>
                                    <input type="file" class="form-control" id="avatar" name="avatar"
                                           value="<?= $old_data["avatar"] ?? "" ?>">
                                    <?php if (isset($errors["avatar"])): ?>
                                        <div class="text-danger"><?= $errors["avatar"] ?></div>
                                    <?php endif; ?>
                                </div>
								<div class="col-12 mb-3">
                                    <label for="password" class="form-label">Mật khẩu</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Nhập mật khẩu" value="<?= $old_data["password"] ?? "" ?>">
                                    <?php if (isset($errors["password"])): ?>
                                        <div class="text-danger"><?= $errors["password"] ?></div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" name="register" class="btn btn-register">
										<i class="fa fa-user-plus me-2"></i>Đăng ký tài khoản
									</button>
								</div>
							</div>
						</form>
						<div class="register-links text-center mt-3">
							<p class="mb-0">Đã có tài khoản?
                                <a href="?page=login&action=index">Đăng nhập ngay</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- Register Section End -->