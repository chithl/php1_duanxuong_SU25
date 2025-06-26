<?php
$page        = isset($_GET['page']) ? $_GET['page'] : '';
$action      = isset($_GET['action']) ? $_GET['action'] : '';
$status      = isset($_GET['status']) ? $_GET['status'] : '';
$page_number = isset($_GET['page_number']) ? $_GET['page_number'] : '1';
?>
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
        <?php
        if (isset($_SESSION['success'])): ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<strong><?= $_SESSION['success'] ?? "" ?></strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
        <?php endif; ?>
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title">Quản lý danh mục sản phẩm</h4>
				<div class="ms-auto text-end">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Thống kê</a></li>
							<li class="breadcrumb-item active" aria-current="page">
								Danh sách danh mục sản phẩm
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
			<div class="col-12">

				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Danh sách danh mục sản phẩm</h5>
						<div class="table-responsive">
							<form action="" method="get" class="g-3 mb-3">
								<input type="hidden" name="page" value="<?= $page ?>">
								<input type="hidden" name="action" value="<?= $action ?>">
								<div class=" col-md-2 ">
									<select class=" form-control" name="status" onchange="this.form.submit();">
										<option value="">Tất cả trạng thái</option>
										<option value="0" <?= (isset($_GET['status']) && $_GET['status'] == '0') ? 'selected' : '' ?>>Ẩn
										</option>
										<option value="1" <?= (isset($_GET['status']) && $_GET['status'] == '1') ? 'selected' : '' ?>>Hiển
											thị
										</option>
									</select>
								</div>
							</form>
							<table id="zero_config" class="table table-striped table-bordered">
								<thead>
								<tr>
									<th>Mã danh mục</th>
									<th>Tên danh mục</th>
									<th>Mô tả</th>
									<th>Ảnh</th>
									<th>Trạng thái</th>
									<th>Hành động</th>
								</tr>
								</thead>
								<tbody id="tbody">
                                <?php foreach ($result as $pro):
                                    ?>
									<tr>
										<td><?= htmlspecialchars($pro['id']) ?></td>
										<td><?= htmlspecialchars($pro['name']) ?></td>
										<td><?= htmlspecialchars($pro['description']) ?></td>
										<td>
                                            <?php if ($pro['image']): ?>
												<img src="Uploads/Product-categories/<?= htmlspecialchars($pro['image']) ?>" alt="Image" style="width: 50px; height: 50px;">
                                            <?php else: ?>
												<span>No Image</span>
                                            <?php endif; ?>
										</td>
										<td><?= $pro['status'] == 'Hiển thị' ? 'Hiển thị' : 'Ẩn' ?></td>
										<td>
											<a href="?page=product-category&action=edit&id=<?= $pro['id'] ?>" class="btn btn-warning">Sửa</a>
											<a href="?page=product-category&action=delete&id=<?= $pro['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa danh mục sản phẩm đó ?');">Xóa</a>
										</td>
									</tr>
                                <?php endforeach;
                                ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
unset($_SESSION['success']);
?>
<!-- ============================================================== --><!-- End PAge Content --><!-- ============================================================== -->
