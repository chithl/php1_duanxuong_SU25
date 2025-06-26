<?php
$errors = $_SESSION['errors'] ?? "";
$old = $_SESSION['old'] ?? "";
?>
<div class="page-wrapper">
	<!-- Alert Success -->

	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title">Thêm bài viết</h4>
				<div class="ms-auto text-end">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Thống kê</a></li>
							<li class="breadcrumb-item active" aria-current="page">
								Thêm bài viết
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
						<h5 class="card-title">Thêm bài viết</h5>
                        <?php
                        $errors = $_SESSION['errors'] ?? "";
                        $old    = $_SESSION['old'] ?? "";
                        ?>
                        <?php
                        if (isset($_SESSION["messageError"]) && $_SESSION["messageError"] != ""):
                            ?>
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								<strong><?= $_SESSION["messageError"] ?? "" ?></strong>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
                        <?php
                        endif;
                        ?>
						<h1 class="text-center">THÊM BÀI VẾT</h1>

						<div class="container w-50">
							<div class="border rounded p-4 shadow-sm bg-light">
								<form action="?page=blog&action=store" method="post" enctype="multipart/form-data">
									<!-- title -->
									<div class="mb-3">
										<label for="title" class="form-label">Title</label>
										<input type="text" name="title" id="title" class="form-control" value="<?= $old['title'] ?? '' ?>">
										<div class="text-danger">
											<small><?= $errors['title'] ?? "" ?></small></div>
									</div>

									<!-- content -->
									<div class="mb-3">
										<label for="content" class="form-label">Content</label>
										<input type="text" name="content" id="content" class="form-control" value="<?= $old['content'] ?? '' ?>">
										<div class="text-danger">
											<small> <?= $errors['content'] ?? "" ?> </small></div>
									</div>

									<!-- blog_category_id -->
									<div class="mb-3">
										<label for="blog_category_id" class="form-label">Blog category id</label>
										<input type="text" name="blog_category_id" id="blog_category_id" class="form-control" value="<?= $old['blog_category_id'] ?? '' ?>">
										<div class="text-danger">
											<small><?= $errors['blog_category_id'] ?? "" ?></small></div>
									</div>

									<!-- Image -->
									<div class="mb-3">
										<label for="image" class="form-label">Hình ảnh</label>
										<input type="file" name="image" id="image" class="form-control">
										<div class="text-danger">
											<small><?= $errors['image'] ?? "" ?></small></div>
									</div>

									<button type="submit" name="create" class="btn btn-outline-dark w-100">Thêm bài viết
									</button>
								</form>
							</div>
<?php
unset($_SESSION['errors']);
unset($_SESSION['old']);
unset($_SESSION["messageError"]);
?>