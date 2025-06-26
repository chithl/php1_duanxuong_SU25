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
				<h4 class="page-title">Sửa bài viết</h4>
				<div class="ms-auto text-end">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Thống kê</a></li>
							<li class="breadcrumb-item active" aria-current="page">
								Sửa bài viết
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
						<h5 class="card-title">Sửa bài viết</h5>
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
						<h2 class="text-center">Sửa bài viết</h2>
						<div class="container w-50">
							<form action="?page=blog&action=update" method="post" enctype="multipart/form-data">
								<!-- ID -->
								<div class="mb-3">
									<label for="id" class="form-label">ID</label>
									<input type="text" name="id" id="id" class="form-control" value="<?= $result['id'] ?>" readonly>
								</div>

								<!-- Name -->
								<div class="mb-3">
									<label for="title" class="form-label">Title</label>
									<input type="text" name="title" id="title" class="form-control" value="<?= $result['title'] ?? '' ?>">
									<div class="text-danger">
										<small><?= $errors['title'] ?? "" ?></small></div>
								</div>

								<!-- price -->
								<div class="mb-3">
									<label for="content" class="form-label">Content</label>
									<input type="text" name="content" id="content" class="form-control" value="<?= $result['content'] ?? '' ?>">
									<div class="text-danger">
										<small> <?= $errors['content'] ?? "" ?> </small></div>
								</div>

								<!-- quantity -->
								<div class="mb-3">
									<label for="blog_category_id" class="form-label">Blog category id</label>
									<input name="blog_category_id" id="blog_category_id" class="form-control" value="<?= $result['blog_category_id'] ?? '' ?>">
									<div class="text-danger">
										<small><?= $errors['blog_category_id'] ?? "" ?></small></div>
								</div>

								<!-- Hình ảnh -->
								<div class="mb-3">
									<label for="image" class="form-label">Hình ảnh</label>
									<input type="file" name="image" id="image" class="form-control">
									<img src="Uploads/<?= $result['image'] ?>" alt="" width="100px" height="100px">

								</div>


								<button type="submit" class="btn btn-dark">Sửa</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
