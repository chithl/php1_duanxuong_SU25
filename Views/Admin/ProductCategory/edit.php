<?php
$error = $_SESSION['error'] ?? [];
?>
	<!-- ============================================================== --><!-- Page wrapper  --><!-- ============================================================== -->
	<div class="page-wrapper">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="page-breadcrumb">
			<div class="row">
				<div class="col-12 d-flex no-block align-items-center">
					<h4 class="page-title">Quản lý danh mục sản phẩm</h4>
					<div class="ms-auto text-end">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Thống kê</a></li>
								<li class="breadcrumb-item active" aria-current="page">
									Quản lý danh mục sản phẩm
								</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- End Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Container fluid  -->
		<!-- ============================================================== -->
		<div class="container-fluid">
			<!-- ============================================================== -->
			<!-- Start Page Content -->
			<!-- ============================================================== -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<form class="form-horizontal" action="?page=product-category&action=update" method="post" enctype="multipart/form-data">
							<div class="card-body">
								<h4 class="card-title">Sửa danh mục sản phẩm</h4>
								<div class="form-group row">
									<label for="id" class="col-sm-3 text-end control-label col-form-label">Mã
										danh mục</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="id" name="id" value="<?= htmlspecialchars($result['id']) ?>" readonly/>
									</div>
								</div>
								<div class="form-group row">
									<label for="name" class="col-sm-3 text-end control-label col-form-label">Tên
										danh mục</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($_SESSION['old']['name'] ?? $result['name']) ?? "" ?>"/>
                                        <?php if (!empty($error['name'])): ?>
											<small class="text-danger mt-1"><?= $error['name'] ?></small>
                                        <?php endif; ?>
									</div>
								</div>
								<div class="form-group row">
									<label for="description" class="col-sm-3 text-end control-label col-form-label">Mô tả danh mục sản phẩm
									</label>
									<div class="col-sm-9">
										<textarea name="description" id="description" rows="5" class="form-control"><?= $_SESSION['old']['description'] ?? $result['description'] ?? "" ?></textarea>
                                        <?php if (!empty($error['description'])): ?>
											<small class="text-danger mt-1"><?= $error['description'] ?></small>
                                        <?php endif; ?>
									</div>
								</div>
								<div class="form-group row">
									<label for="image" class="col-sm-3 text-end control-label col-form-label">Ảnh
									</label>
									<div class="col-sm-9">
										<input type="file" class="form-control" id="image" name="image"/>
                                        <?php if (!empty($result['image'])): ?>
											<div class="mb-2">
												<img src="Uploads/Product-categories/<?= htmlspecialchars($result['image']) ?>" alt="Current Image" width="120"/>
											</div>
                                        <?php endif; ?>
									</div>
								</div>
								<div class="form-group row">
									<label for="status" class="col-sm-3 text-end control-label col-form-label">Trạng thái</label>
									<div class="col-sm-9">
										<select class="form-select" name="status" id="status">
											<option value="" selected>Vui lòng chọn</option>
											<option value="Hiển thị" <?= (($_SESSION['old']['status'] ?? $result['status']) == 'Hiển thị' ? 'selected' : '') ?>>Hiển thị</option>
											<option value="Ẩn" <?= (($_SESSION['old']['status'] ?? $result['status']) == 'Ẩn' ? 'selected' : '') ?>>Ẩn</option>
										</select>
                                        <?php if (!empty($error['status'])): ?>
											<small class="text-danger mt-1"><?= $error['status'] ?></small>
                                        <?php endif; ?>
									</div>
								</div>
								<div class="form-group row">
									<label for="created_at" class="col-sm-3 text-end control-label col-form-label">Ngày tạo
									</label>
									<div class="col-sm-9">
										<input type="date" class="form-control" id="created_at" name="created_at" readonly value="<?= $_SESSION['created_at'] ?? "" ?>"/>
									</div>
								</div>
								<div class="form-group row">
									<label for="updated_at" class="col-sm-3 text-end control-label col-form-label">Ngày cập nhật
									</label>
									<div class="col-sm-9">
										<input type="date" class="form-control" id="updated_at" name="updated_at" readonly value="<?= $result['created_at'] ?? "" ?>"/>
									</div>
								</div>
							</div>
							<div class="border-top">
								<div class="card-body">
									<button type="submit" class="btn btn-primary" name="create">
										Cập nhật
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div><!-- ============================================================== --><!-- End PAge Content --><!-- ============================================================== -->
<?php
unset($_SESSION['old']);
unset($_SESSION['error']);
?>