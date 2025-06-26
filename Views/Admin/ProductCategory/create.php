<?php
$error = $_SESSION['error'] ?? [];
?>
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
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
					<form class="form-horizontal" action="?page=product-category&action=store" method="post" enctype="multipart/form-data">
						<div class="card-body">
							<h4 class="card-title">Thêm danh mục sản phẩm </h4>
							<div class="form-group row">
								<label for="name" class="col-sm-3 text-end control-label col-form-label">Tên
									danh mục <span class="text-danger">*</span></label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="name" name="name" value="<?= $_SESSION['old']['name'] ?? '' ?>" placeholder="Nhập tên danh mục ..."/>
                                    <?php if (!empty($error['name'])): ?>
										<small class="text-danger mt-1"><?= $error['name'] ?></small>
                                    <?php endif; ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="description" class="col-sm-3 text-end control-label col-form-label">Mô tả danh mục sản phẩm
									<span class="text-danger">*</span></label>
								<div class="col-sm-9">
									<textarea name="description" id="description" rows="5" class="form-control"><?= $_SESSION['old']['description'] ?? $result['description'] ?? "" ?></textarea>
                                    <?php if (!empty($error['description'])): ?>
										<small class="text-danger mt-1"><?= $error['description'] ?></small>
                                    <?php endif; ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="image" class="col-sm-3 text-end control-label col-form-label">Ảnh
									<span class="text-danger">*</span></label>
								<div class="col-sm-9">
									<input type="file" class="form-control" id="image" name="image"/>
                                    <?php if (!empty($error['image'])): ?>
										<small class="text-danger mt-1"><?= $error['image'] ?></small>
                                    <?php endif; ?>
								</div>
							</div>


							<div class="form-group row">
								<label for="status" class="col-sm-3 text-end control-label col-form-label">Trạng thái
									<span class="text-danger">*</span></label>
								<div class="col-sm-9">
									<select class="form-select" name="status" id="status">
										<option value="" selected>Vui lòng chọn</option>
										<option value="Hiển thị">Hiển thị</option>
										<option value="Ẩn">Ẩn</option>
									</select>
                                    <?php if (!empty($error['status'])): ?>
										<small class="text-danger mt-1"><?= $error['status'] ?></small>
                                    <?php endif; ?>
								</div>
							</div>
						</div>
						<div class="border-top">
							<div class="card-body">
								<button type="submit" class="btn btn-primary" name="create">
									Thêm
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
unset($_SESSION['old']);
unset($_SESSION['error']);
?>
<!-- ============================================================== --><!-- End PAge Content --><!-- ============================================================== -->