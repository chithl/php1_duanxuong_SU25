<?php if (isset($_SESSION['errors'])): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Đã xảy ra lỗi. Vui lòng kiểm tra lại các trường bên dưới.</strong>
	</div>
<?php endif; ?>

<?php
$old    = $_SESSION['old_data'] ?? [];
$errors = $_SESSION['errors'] ?? [];
?>

<div class="container">
	<div class="row">
		<div class="col-sm-6 offset-sm-3 mt-5">
			<form action="admin.php?page=auth&action=storeResetPassword" method="post">
				<h2 class="text-center text-warning">Đặt lại mật khẩu</h2>

				<div class="form-group">
					<label for="username">Tên đăng nhập</label>
					<input type="text" class="form-control" id="username" name="username" value="<?= $old["username"] ?? "" ?>">
                    <?php if (isset($errors["username"])): ?>
						<div class="text-danger"><?= $errors["username"] ?></div>
                    <?php endif; ?>
				</div>

				<div class="form-group">
					<label for="reset_token">Mã xác thực</label>
					<input type="text" class="form-control" id="reset_token" name="reset_token" value="<?= htmlspecialchars($old['reset_token'] ?? '') ?>">
					<small class="form-text text-danger"><?= $errors['reset_token'] ?? '' ?></small>
				</div>

				<div class="form-group">
					<label for="new_password">Mật khẩu mới</label>
					<input type="password" class="form-control" id="new_password" name="new_password">
					<small class="form-text text-danger"><?= $errors['new_password'] ?? '' ?></small>
				</div>

				<div class="form-group">
					<label for="confirm_password">Xác nhận mật khẩu</label>
					<input type="password" class="form-control" id="confirm_password" name="confirm_password">
					<small class="form-text text-danger"><?= $errors['confirm_password'] ?? '' ?></small>
				</div>

				<div class="text-center mt-4">
					<button type="submit" class="btn btn-outline-primary" name="resset_password">Đặt lại mật khẩu</button>
				</div>
			</form>
		</div>
	</div>
</div>
