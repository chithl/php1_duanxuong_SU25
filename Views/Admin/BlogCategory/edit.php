<?php
$errors = $_SESSION['errors'] ?? "";
$old    = $_SESSION['old'] ?? "";
?>
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
				<strong><?=$_SESSION["messageError"]?></strong>
			</div>
			<script>
                $(".alert").alert();
			</script>
        <?php endif; ?>
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title">Quản lí danh mục bài viết</h4>
				<div class="ms-auto text-end">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Thống kê</a></li>
							<li class="breadcrumb-item active" aria-current="page">
								Quản lí danh mục bài viết
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
					<form class="form-horizontal" action="?page=blog-category&action=update" method="post" enctype="multipart/form-data">
						<div class="card-body">
							<h4 class="card-title">Thêm danh mục bài viết</h4>
							<div class="form-group row">
								<label for="name" class="col-sm-3 text-end control-label col-form-label">ID</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="id" name="id" value="<?= $result['id'] ?? '' ?>" readonly />
									<small id="helpId" class="text-danger"><?= $errors['id'] ?? "" ?></small>
								</div>
							</div>

							<div class="form-group row">
								<label for="name" class="col-sm-3 text-end control-label col-form-label">Tên danh mục</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="name" name="name" value="<?= $result['name'] ?? '' ?>"/>
									<small id="helpId" class="text-danger"><?= $errors['name'] ?? "" ?> </small>
								</div>
							</div>

							<div class="form-group row">
								<label for="description" class="col-sm-3 text-end control-label col-form-label">Mô tả danh mục</label>
								<div class="col-sm-9">
									<textarea class="form-control" id="description" name="description"><?= $result['description'] ?? '' ?></textarea>

									<small id="helpId" class="text-danger"><?= $errors['description'] ?? "" ?></small>
								</div>
							</div>

							<div class="form-group row">
								<label for="name" class="col-sm-3 text-end control-label col-form-label">Ngày tạo</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="created_at" name="created_at" value="<?= $result['created_at'] ?? '' ?>" readonly/>
								</div>
							</div>

							<div class="form-group row">
								<label for="name" class="col-sm-3 text-end control-label col-form-label">Ngày sửa</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="updated_at" name="updated_at" value="<?= $result['updated_at'] ?? '' ?>" readonly/>
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
unset($_SESSION['errors']);
unset($_SESSION['old']);
unset($_SESSION["messageError"]);
?>
<!-- ============================================================== --><!-- End PAge Content --><!-- ============================================================== -->
