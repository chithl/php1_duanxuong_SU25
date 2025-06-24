<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
        <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong><?= $_SESSION['errors']['message'] ?? "" ?></strong>
			</div>
			<script>
                $(".alert").alert();
			</script>
        <?php endif; ?>
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title">Quản lý sản phẩm</h4>
				<div class="ms-auto text-end">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Thống kê</a></li>
							<li class="breadcrumb-item active" aria-current="page">
								Quản lý sản phẩm
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
					<form class="form-horizontal" action="?page=product&action=store" method="post" enctype="multipart/form-data">
						<div class="card-body">
							<h4 class="card-title">Thêm sản phẩm</h4>
							<div class="form-group row">
								<label for="category_name" class="col-sm-3 text-end control-label col-form-label">Mã
									loại</label>
								<div class="col-sm-9">
									<select class="form-control" name="category_id" id="category_id">
										<option value="">Vui lòng chọn ...</option>
                                        <?php foreach ($categories as $cate): ?>
											<option value="<?= $cate['id'] ?>"
                                                <?= (isset($_SESSION['errors']['category_id_old']) && $_SESSION['errors']['category_id_old'] == $cate['id']) ? 'selected' : '' ?>>
                                                <?= $cate['id'] ?>--<?= $cate['name'] ?>
											</option>
                                        <?php endforeach; ?>
									</select>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['category_id_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="name" class="col-sm-3 text-end control-label col-form-label">Tên
									sản phẩm</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm ..." value="<?= $_SESSION['errors']['name_old'] ?? "" ?>"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['name_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="name" class="col-sm-3 text-end control-label col-form-label">Mô tả
									sản phẩm</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="name" name="description" placeholder="Nhập mô tả sản phẩm ..." value="<?= $_SESSION['errors']['description_old'] ?? "" ?>"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['description_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="weight" class="col-sm-3 text-end control-label col-form-label">Trọng
									lượng</label>
								<div class="col-sm-9">
									<input type="number" class="form-control" id="weight" name="weight" placeholder="Nhập trọng lượng ..." value="<?= $_SESSION['errors']['weight_old'] ?? "" ?>"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['weight_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="price" class="col-sm-3 text-end control-label col-form-label">Giá
								</label>
								<div class="col-sm-9">
									<input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá sản phẩm ..." value="<?= $_SESSION['errors']['price_old'] ?? "" ?>"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['price_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="discount_price" class="col-sm-3 text-end control-label col-form-label">Giá
									khuyến mãi (nếu có)
								</label>
								<div class="col-sm-9">
									<input type="number" class="form-control" id="discount_price" name="discount_price" placeholder="Nhập giá giảm ..." value="<?= $_SESSION['errors']['discount_price_old'] ?? "" ?>"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['discount_price_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="view" class="col-sm-3 text-end control-label col-form-label">Lượt
									xem</label>
								<div class="col-sm-9">
									<input type="number" class="form-control" id="view" name="view" placeholder="Nhập số lượt xem ..." value="<?= $_SESSION['errors']['view_old'] ?? "" ?>"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['view_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="stock" class="col-sm-3 text-end control-label col-form-label">Số hàng
									còn</label>
								<div class="col-sm-9">
									<input type="number" class="form-control" id="stock" name="stock" placeholder="Nhập số lượng hàng còn ..." value="<?= $_SESSION['errors']['stock_old'] ?? "" ?>"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['stock_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="featured" class="col-sm-3 text-end control-label col-form-label">Sản phẩm
									nổi bật</label>
								<div class="col-sm-9">
									<select class="form-select" name="featured" id="featured">
										<option value="" selected>Vui lòng chọn</option>
										<option value="1" <?= (isset($_SESSION['errors']['featured_old']) && $_SESSION['errors']['featured_old'] === '1') ? 'selected' : '' ?>>
											Nổi bật
										</option>
										<option value="0" <?= (isset($_SESSION['errors']['featured_old']) && $_SESSION['errors']['featured_old'] === '0') ? 'selected' : '' ?>>
											Không nổi bật
										</option>
									</select>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['featured_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="price" class="col-sm-3 text-end control-label col-form-label">Thêm ảnh
								</label>
								<div class="col-sm-9">
									<input type="file" class="form-control" id="image" name="image"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['image_error'] ?? "" ?></small>
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
<?php unset($_SESSION['errors']); ?>
<!-- ============================================================== --><!-- End PAge Content --><!-- ============================================================== -->