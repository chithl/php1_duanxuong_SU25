<?php if (isset($_SESSION['error'])): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong><?= $_SESSION['error']['message'] ?? '' ?></strong>
	</div>
<?php endif; ?>
<?php

$errors   = $_SESSION["errors"] ?? [];
$old_data = $_SESSION["old_data"] ?? [];
unset($_SESSION["errors"], $_SESSION["old_data"]);

?>
<div class="container">
	<div class="row">
		<div class="col-sm-6 offset-sm-3 mt-5">
			<form action="admin.php?page=auth&action=storeForgotPassword" method="post">
				<h2 class="text-center text-primary">Khôi phục mật khẩu</h2>
				<p class="text-center">Vui lòng nhập tên đăng nhập và email để nhận mã xác thực.</p>

				<div class="form-group">
					<label for="username">Tên đăng nhập</label>
					<input type="text" class="form-control" id="username" name="username" value="<?= $old_data["username"] ?? "" ?>">
                    <?php if (isset($errors["username"])): ?>
						<div class="text-danger"><?= $errors["username"] ?></div>
                    <?php endif; ?>
				</div>

				<div class="form-group">
					<label for="email">Email đã đăng ký</label>
					<input type="email" class="form-control" id="email" name="email" value="<?= $old_data["email"] ?? "" ?>">
                    <?php if (isset($errors["email"])): ?>
						<div class="text-danger"><?= $errors["email"] ?></div>
                    <?php endif; ?>
				</div>

				<div class="text-center mt-4">
					<button type="submit" class="btn btn-outline-success" name="reset">Gửi mã xác thực</button>
				</div>

				<div class="text-center mt-3">
					<a href="admin.php?page=auth&action=login" class="text-muted">Quay lại đăng nhập</a>
				</div>
			</form>
		</div>
	</div>
</div>
