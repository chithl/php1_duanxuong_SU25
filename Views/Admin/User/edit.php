<!-- ============================================================== -->
<!-- Page wrapper -->
<!-- ============================================================== -->
<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title">Quản lý người dùng </h4>
				<div class="ms-auto text-end">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Thống kê</a></li>
							<li class="breadcrumb-item active" aria-current="page">Quản lý người dùng</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>

	<!-- ============================================================== -->
	<!-- Container fluid -->
	<!-- ============================================================== -->
	<div class="container-fluid">
		<!-- ============================================================== -->
		<!-- Start Page Content -->
		<!-- ============================================================== -->
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<form action="?page=user&action=update" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <?php if (isset($_SESSION['errors']) && is_array($_SESSION['errors'])): ?>
	                        <div class="alert alert-danger">
		                        <ul>
                                    <?php foreach ($_SESSION['errors'] as $error): ?>
	                                    <li><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach; ?>
		                        </ul>
	                        </div>
                            <?php unset($_SESSION['errors']); ?><?php endif; ?>

						<div class="card-body">
							<h2 class="text-center">Sửa trạng thái</h2>
							<div class="form-group">
								<label for="id">ID</label>
								<input type="text" class="form-control" name="id" id="id" value="<?= $result['id'] ?>" readonly>
							</div>

							<label for="status">Trạng thái</label>
							<select name="status" id="status" class="form-control">
								<option value="" disabled <?= ($result['status']) ? 'selected' : '' ?>>Vui lòng
									chọn...
								</option>
								<option value="active" <?= ($result['status'] == 'active') ? 'selected' : '' ?>>Hoạt động</option>
								<option value="inactive" <?= ($result['status'] == 'inactive') ? 'selected' : '' ?>>Đã khóa</option>
							</select>


							<div class="border-top mt-4">
								<div class="card-body text-center">
									<input type="submit" class="btn btn-primary" name="edit" value="Cập nhật">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div><!-- ============================================================== --><!-- Scripts --><!-- ============================================================== -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>