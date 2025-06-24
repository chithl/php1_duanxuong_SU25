<?php if (isset($_SESSION['error'])): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong><?= $_SESSION['error']['message'] ?? '' ?></strong>
	</div>
<?php endif; ?>
<div class="container">
	<div class="row justify-content-center align-items-center" style="min-height: 100vh;">
		<div class="col-md-6 col-lg-4">
			<div class="login-card">
				<div class="text-center mb-4">
					<i class="bi bi-shield-lock login-icon"></i>
					<div class="login-title">Đăng Nhập Quản Trị</div>
					<div class="login-subtext">Chào mừng trở lại 👋</div>
				</div>
                <form action="admin.php?page=auth&action=login" method="post">
	                <div class="form-group mb-3">
		                <label for="username">👤 Tên đăng nhập</label>
		                <input type="text" class="form-control" name="username" id="username" value="<?= $_SESSION['error']['username_old'] ?? '' ?>" placeholder="Nhập tên đăng nhập">
		                <small class="text-danger"><?= $_SESSION['error']['username_error'] ?? '' ?></small>
                    </div>
	                <div class="form-group mb-4">
		                <label for="password">🔒 Mật khẩu</label>
		                <input type="password" class="form-control" name="password" id="password" value="<?= $_SESSION['error']['password_old'] ?? '' ?>" placeholder="Nhập mật khẩu">
		                <small class="text-danger"><?= $_SESSION['error']['password_error'] ?? '' ?></small>
                    </div>
	                <div class="d-grid">
		                <button type="submit" name="login" class="btn btn-info btn-block text-white">
			                🚀 Đăng nhập
		                </button>
	                </div>
	                <div class="text-center mt-3">
		                <a href="admin.php?page=auth&action=forgotPassword" class="text-info">🔁 Quên mật khẩu?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
