<?php
$page   = isset($_GET['page']) ? $_GET['page'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
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
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong><?= $_SESSION['success'] ?? "" ?></strong>
			</div>
        <?php endif; ?>
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title">Quản lý sản phẩm</h4>
				<div class="ms-auto text-end">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Thống kê</a></li>
							<li class="breadcrumb-item active" aria-current="page">
								Danh sách sản phẩm
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
						<h5 class="card-title">Danh sách sản phẩm</h5>
						<div class="table-responsive">
							<form action="" method="get" class="g-3 mb-3">
								<input type="hidden" name="page" value="<?= $page ?>">
								<input type="hidden" name="action" value="<?= $action ?>">
								<div class=" col-md-2 ">
									<select class=" form-control" name="status" onchange="this.form.submit()">
										<option value="">Tất cả trạng thái</option>
										<option value="available" <?= (isset($_GET['status']) && $_GET['status'] == 'available') ? 'selected' : '' ?>>
											Còn hàng
										</option>
										<option value="out_of_stock" <?= (isset($_GET['status']) && $_GET['status'] == 'out_of_stock') ? 'selected' : '' ?>>
											Hết hàng

										</option>
										<option value="discontinued" <?= (isset($_GET['status']) && $_GET['status'] == 'discontinued') ? 'selected' : '' ?>>
											Ngừng hoạt động

										</option>
									</select>
								</div>
							</form>
							<table id="zero_config" class="table table-striped table-bordered">
								<thead>
								<tr>
									<th>Mã sản phẩm</th>
									<th>Mã loại sản phẩm</th>
									<th>Tên sản phẩm</th>
									<th>Giá</th>
									<th>Số hàng còn</th>
									<th>Hình ảnh</th>
									<th>Trạng thái</th>
									<th>Hành động</th>
								</tr>
								</thead>
								<tbody id="tbody">
                                <?php foreach ($result as $pro):
                                    ?>
									<tr>
										<td><?= $pro['id'] ?></td>
										<td><?= $pro['category_name'] ?></td>
										<td><?= $pro['name'] ?></td>
										<td><?= number_format($pro['price']) . "đ" ?></td>
										<td><?= $pro['stock'] ?></td>
										<td>
											<img src="Uploads/Products/<?= $pro['image'] ?>" alt="" width="50" height="50">
										</td>

										<td><?php if ($pro['status'] == 'available'):
                                                ?>
												<span class="badge bg-success">Còn hàng</span>
                                            <?php
											elseif ($pro['status'] == 'out_of_stock'):
                                                ?>
												<span class="badge bg-warning">Hết hàng</span>
                                            <?php else: ?>
												<span class="badge bg-danger">Ngừng hoạt động</span>
                                            <?php endif; ?>
										</td>
										<td>
											<a href="?page=product&action=edit&id=<?= $pro['id'] ?>" class="btn btn-outline-warning">Sửa</a>
											<form action="?page=product&action=delete&id=<?= $pro['id'] ?>" method="post" onsubmit="return confirm('Bạn có chắc là muốn xóa')" style="display: inline-block;">
												<button type="submit" class="btn btn-outline-danger">Xóa</button>
											</form>
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

