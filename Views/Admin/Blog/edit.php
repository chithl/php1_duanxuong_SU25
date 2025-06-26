<?php
$errors = $_SESSION['errors'] ?? "";
$old = $_SESSION['old'] ?? "";
?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
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
				<strong><?= $_SESSION['messageError'] ?? "" ?></strong>
			</div>
			<script>
                $(".alert").alert();
			</script>
        <?php endif; ?>
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title">Quản lý bài viết</h4>
				<div class="ms-auto text-end">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Thống kê</a></li>
							<li class="breadcrumb-item active" aria-current="page">
								Quản lý bài viết
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
					<form class="form-horizontal" action="?page=blog&action=update" method="post" enctype="multipart/form-data">
						<div class="card-body">
							<h4 class="card-title">SỬA BÀI VIẾT</h4>

							<div class="form-group row">
								<label for="name" class="col-sm-3 text-end control-label col-form-label">ID</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="id" name="id"value="<?= $result['id'] ?? '' ?>"/>
									<small id="helpId" class="text-danger"><?= $errors['id'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="name" class="col-sm-3 text-end control-label col-form-label">Tiêu đề</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="title" name="title" placeholder="Nhập vào tiêu đề bài viết ..." value="<?= $result['title'] ?? '' ?>"/>
									<small id="helpId" class="text-danger"><?= $errors['title'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="name" class="col-sm-3 text-end control-label col-form-label">Nội dung</label>
								<div class="col-sm-9">
									<textarea type="text" class="form-control" id="content" name="content" placeholder="Nhập nội dung bài viết ..."><?= $result['content'] ?>"</textarea>
									<small id="helpId" class="text-danger"><?= $errors['content'] ?? "" ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="blog_category_id" class="col-sm-3 text-end control-label col-form-label">Mã danh mục</label>
								<div class="col-sm-9">
									<?php
									$selectedCategoryId = $result['blog_category_id'] ?? "";
									?>
									<select class="form-control" name="blog_category_id" id="blog_category_id">
										<option value="" disabled>--- Vui lòng chọn ---</option>
                                        <?php foreach ($categories as $cate): ?>
											<option value="<?= $cate['id'] ?? '' ?>" <?= $selectedCategoryId == $cate["id"] ? "selected" : "" ?>"><?= $cate["name"] ?></option>
                                        <?php endforeach; ?>
									</select>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['category_id_error'] ?? "" ?></small>
								</div>
							</div>

							<div class="form-group row">
								<label for="price" class="col-sm-3 text-end control-label col-form-label">Ảnh sản phẩm
								</label>
								<div class="col-sm-9">
									<input type="file" class="form-control" id="image" name="image"/>
									<small id="helpId" class="text-danger"><?= $_SESSION['errors']['image_error'] ?? "" ?></small>
								<img src="Uploads/<?= $result['image'] ?>" alt="" width="100" height="100" class="mt-2 mb-2">
								</div>
							</div>
						<div class="border-top">
							<div class="card-body">
								<button type="submit" class="btn btn-primary">Cập nhật</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });
</script>
<?php unset($_SESSION['errors']); ?>
<!-- ============================================================== --><!-- End PAge Content --><!-- ============================================================== -->
