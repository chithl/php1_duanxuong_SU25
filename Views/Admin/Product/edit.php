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
					<form class="form-horizontal" action="?page=product&action=update" method="post" enctype="multipart/form-data">
						<div class="card-body">
							<h4 class="card-title">Cập nhật sản phẩm</h4>
							<div class="form-group row">
								<label for="" class="col-sm-3 text-end control-label col-form-label">Mã sản phẩm
								</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="id" id="id" placeholder="Nhập mã sản phẩm ..." value="<?= $result['id'] ?>" readonly/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['id_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 text-end control-label col-form-label">Mã loại sản phẩm
								</label>
								<div class="col-sm-9">
									<select class="form-control" name="category_id" id="category_id">
										<option value="">Vui lòng chọn ...</option>
                                        <?php foreach ($categories as $cate): ?>
											<option value="<?= $cate['id'] ?>" <?= ($result['product_category_id'] == $cate['id']) ? 'selected' : '' ?>>
                                                <?= $cate['id'] ?>--<?= $cate['name'] ?>
											</option>
                                        <?php endforeach; ?>
									</select>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['category_id_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 text-end control-label col-form-label">Tên sản phẩm
								</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên sản phẩm ..." value="<?= $_SESSION['errors']['name_old'] ?? $result['name'] ?>"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['name_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="description" class="col-sm-3 text-end control-label col-form-label">Mô
									tả</label>
								<div class="col-sm-9">
                                            <textarea class="form-control" name="description" id="description" placeholder="Nhập mô tả ..." rows="3"><?= $_SESSION['errors']['description_old'] ?? $result['description'] ?></textarea>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['description_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="price" class="col-sm-3 text-end control-label col-form-label">Giá sản phẩm
								</label>
								<div class="col-sm-9">
									<input type="number" class="form-control" name="price" id="price" placeholder="Nhập giá sản phẩm ..." value="<?= $result['price'] ?>"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['price_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="price" class="col-sm-3 text-end control-label col-form-label">Giá khuyến mãi
								</label>
								<div class="col-sm-9">
									<input type="number" class="form-control" name="discount_price" id="discount_price" placeholder="Nhập giá khuyến mãi ..." value="<?= $result['discount_price'] ?>"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['discount_price_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="price" class="col-sm-3 text-end control-label col-form-label">Trọng lượng
									sản phẩm
								</label>
								<div class="col-sm-9">
									<input type="number" class="form-control" name="weight" id="weight" placeholder="Nhập trọng lượng sản phẩm ..." value="<?= $result['weight'] ?>"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['weight_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="price" class="col-sm-3 text-end control-label col-form-label">Ảnh sản phẩm
								</label>
								<div class="col-sm-9">
									<img src="Uploads/Products/<?= $result['image'] ?>" alt="" width="100" height="100" class="mt-2 mb-2">
									<input type="file" class="form-control" id="image" name="image"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['image_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="price" class="col-sm-3 text-end control-label col-form-label">Lượt xem
								</label>
								<div class="col-sm-9">
									<input type="number" class="form-control" name="view" id="view" value="<?= $result['view'] ?>" readonly/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['view_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="price" class="col-sm-3 text-end control-label col-form-label">Số lượng
									sản phẩm
								</label>
								<div class="col-sm-9">
									<input type="number" class="form-control" name="stock" id="stock" placeholder="Nhập số lượng sản phẩm ..." value="<?= $result['stock'] ?>"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['stock_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="lname" class="col-sm-3 text-end control-label col-form-label">Đặc trưng sản
									phẩm
								</label>
								<div class="col-sm-9">
									<select class="form-select" name="featured">
										<option selected disabled>Vui lòng chọn trạng thái</option>
										<option value="1" <?= $result['is_featured'] === 1 ? 'selected' : '' ?>>Nổi bậc
										</option>
										<option value="0" <?= $result['is_featured'] === 0 ? 'selected' : '' ?>>Không
											nổi bậc
										</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="lname" class="col-sm-3 text-end control-label col-form-label">Trạng thái
								</label>
								<div class="col-sm-9">
									<select class="form-select" required name="status">
										<option selected disabled>Vui lòng chọn trạng thái</option>
										<option value="available" <?= $result['status'] === 'available' ? 'selected' : '' ?>>
											Còn hàng
										</option>
										<option value="out_of_stock" <?= $result['status'] === 'out_of_stock' ? 'selected' : '' ?>>
											Hết hàng
										</option>
										<option value="discontinued" <?= $result['status'] === 'discontinued' ? 'selected' : '' ?>>
											Ngừng hoạt động
										</option>
									</select>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['status_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="price" class="col-sm-3 text-end control-label col-form-label">Ngày tạo
									sản phẩm
								</label>
								<div class="col-sm-9">
									<input type="datetime-local" class="form-control" name="created_at" id="created_at" readonly value="<?= $result['created_at'] ?>"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['created_at_error'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="price" class="col-sm-3 text-end control-label col-form-label">Ngày cập nhật
								</label>
								<div class="col-sm-9">
									<input type="datetime-local" class="form-control" name="updated_at" id="updated_at" readonly value="<?= $result['updated_at'] ?>"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['updated_at_error'] ?? "" ?></small>
								</div>
							</div>
						</div>

						<div class="border-top">
							<div class="card-body">
								<button type="submit" class="btn btn-primary" name="update">
									Cập nhật
								</button>
							</div>
						</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div></div>
<?php unset($_SESSION['errors']); ?>
<!-- ============================================================== --><!-- End PAge Content --><!-- ============================================================== -->