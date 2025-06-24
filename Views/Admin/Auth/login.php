<div class="page-wrapper">
    <?php
    if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?= $_SESSION['error']['message'] ?? '' ?></strong>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 offset-sm-4 mt-4">
                <form action="admin.php?page=auth&action=login" method="post">
                    <h1 class="text-center text-danger">ĐĂNG NHẬP</h1>
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= $_SESSION['error']['username_old'] ?? '' ?>">
                        <small class="form-text text-danger"><?= $_SESSION['error']['username_error'] ?? '' ?></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" id="password" value="<?= $_SESSION['error']['password_old'] ?? '' ?>">
                        <small class="form-text text-danger"><?= $_SESSION['error']['password_error'] ?? '' ?></small>
                    </div>
                    <div class="col-sm-4 offset-sm-4">
                        <button type="submit" class="btn btn-outline-info" name="login">Đăng nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
