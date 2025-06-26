<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
	<!-- Alert Success -->

	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title">Danh sách bài viết</h4>
				<div class="ms-auto text-end">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Thống kê</a></li>
							<li class="breadcrumb-item active" aria-current="page">
								Danh sách bài viết
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
						<h5 class="card-title">Danh sách bài viết</h5>
						<div class="table-responsive">
							<table id="zero_config" class="table table-striped table-bordered">
								<thead>
								<tr>
									<th>ID</th>
									<th>Tiêu đề</th>
									<th>Nội dung</th>
									<th>Hình ảnh</th>
									<th>Mã danh mục</th>
									<th>Hành động</th>
								</tr>
								</thead>
								<tbody>
                                <?php foreach ($result as $key => $value):
                                    ?>
									<tr>
										<td><?= $value['id'] ?></td>
										<td><?= $value['title'] ?></td>
										<td><?= $value['content'] ?></td>
										<td>
											<img src="Uploads/<?= $value["image"] ?>" alt="" width="50px" height="50px">
										</td>
										<td><?= $value['blog_category_id'] ?></td>

										<td>
											<a class="btn btn-outline-danger" href="?page=blog&action=edit&id=<?= $value["id"] ?>">Sửa</a>
											<form action="?page=blog&action=delete&id=<?= $value["id"] ?>" method="post" enctype="multipart/form-data" onsubmit="return confirm('Xóa ?')" style="display: inline-block;">
												<input type="hidden" name="" value="">
												<button class="btn btn-outline-warning" name="delete">Xóa</button>
											</form>
										</td>
									</tr>
                                <?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>