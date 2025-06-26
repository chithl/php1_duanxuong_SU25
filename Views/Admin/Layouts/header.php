<?php
ob_start();
//if(!isset($_SESSION['admin'])) {
//    header('Location: admin.php?page=login&action=form');
//    exit();
//}

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template"/>
	<meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework"/>
	<meta name="robots" content="noindex,nofollow"/>
	<title>Admin</title>
	<link rel="icon" type="image/png" href="Uploads/favicon.jpg">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="Assets/images/favicon.png"/>
	<!-- Custom CSS -->
	<link href="Assets/libs/flot/css/float-chart.css" rel="stylesheet"/>
	<!-- Custom CSS table -->
	<link rel="stylesheet" type="text/css" href="Assets/extra-libs/multicheck/multicheck.css"/>
	<link href="Assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet"/>
	<!-- Custom CSS form -->
	<link rel="stylesheet" type="text/css" href="Assets/Admin/libs/select2/dist/css/select2.min.css"/>
	<link rel="stylesheet" type="text/css" href="Assets/Admin/libs/jquery-minicolors/jquery.minicolors.css"/>
	<link rel="stylesheet" type="text/css" href="Assets/Admin/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"/>
	<link rel="stylesheet" type="text/css" href="Assets/Admin/libs/quill/dist/quill.snow.css"/>
	<!-- Custom CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
	<link href="Assets/Admin/dist/css/style.min.css" rel="stylesheet"/>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

	<![endif]-->
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
	<div class="lds-ripple">
		<div class="lds-pos"></div>
		<div class="lds-pos"></div>
	</div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
	<!-- ============================================================== -->
	<!-- Topbar header - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<header class="topbar" data-navbarbg="skin5">
		<nav class="navbar top-navbar navbar-expand-md navbar-dark">
			<div class="navbar-header" data-logobg="skin5">
				<!-- ============================================================== -->
				<!-- Logo -->
				<!-- ============================================================== -->
				<a class="navbar-brand" href="admin.php">
					<!-- Logo icon -->
					<b class="logo-icon ps-2">
						<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
						<!-- Dark Logo icon -->
						<img src="../Assets/Admin/images/logo-icon.png" alt="homepage" class="light-logo" width="25"/>
					</b>
					<!--End Logo icon -->
					<!-- Logo text -->
					<span class="logo-text ms-2">
              <!-- dark Logo text -->
                              <img src="../Assets/Admin/images/logo-text.png" alt="homepage" class="light-logo"/>
            </span>
					<!-- Logo icon -->
					<!-- <b class="logo-icon"> -->
					<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
					<!-- Dark Logo icon -->
					<!-- <img src="Assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

					<!-- </b> -->
					<!--End Logo icon -->
				</a>
				<!-- ============================================================== -->
				<!-- End Logo -->
				<!-- ============================================================== -->
				<!-- ============================================================== -->
				<!-- Toggle which is visible on mobile only -->
				<!-- ============================================================== -->
				<a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
			</div>
			<!-- ============================================================== -->
			<!-- End Logo -->
			<!-- ============================================================== -->
			<div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
				<!-- ============================================================== -->
				<!-- toggle and nav items -->
				<!-- ============================================================== -->
				<ul class="navbar-nav float-start me-auto">
					<li class="nav-item d-none d-lg-block">
						<a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
					</li>
					<!-- ============================================================== -->
					<!-- Search -->
					<!-- ============================================================== -->
					<li class="nav-item search-box">
						<a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-magnify fs-4"></i></a>
						<form class="app-search position-absolute">
							<input type="text" class="form-control" placeholder="Search &amp; enter"/>
							<a class="srh-btn"><i class="mdi mdi-window-close"></i></a>
						</form>
					</li>
				</ul>
				<div class="ml-auto d-flex align-items-center">
                    <?php if (isset($_SESSION['admin'])): ?>

					<span class="navbar-text text-white mr-3">
        👤 <?= $_SESSION['admin']['username'] ?? '' ?>
      </span>
				</div>
				<!-- ============================================================== -->
				<!-- Right side toggle and nav items -->
				<!-- ============================================================== -->
				<ul class="navbar-nav float-end">
					<!-- ============================================================== -->
					<!-- User profile and search -->
					<!-- ============================================================== -->

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="Assets/Admin/images/avatar.jpg" alt="user" class="rounded-circle" width="31"/>
						</a>
						<ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="?page=profile"><i class="mdi mdi-account me-1 ms-1"></i><?= $_SESSION['admin']['username'] ?? '' ?>
							</a>
							<a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-wallet me-1 ms-1"></i>
								Số dư của tôi</a>
							<a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-email me-1 ms-1"></i>
								Hộp thư</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-settings me-1 ms-1"></i> Cài đặt</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="?page=logout"><i class="fa fa-power-off me-1 ms-1"></i> Đăng
								xuất</a>
							<div class="dropdown-divider"></div>
							<div class="ps-4 p-10">
								<a href="?page=profile" class="btn btn-sm btn-success btn-rounded text-white">View
									Profile</a>
							</div>
						</ul>
					</li>
					<!-- ============================================================== -->
					<!-- User profile and search -->
					<!-- ============================================================== -->
				</ul>
                <?php else: ?>
					<span class="navbar-text text-white mr-3">
                        <a href="?page=auth&action=login">Đăng nhập</a>
                    </span>
                <?php endif; ?>
			</div>
		</nav>
	</header>
	<!-- ============================================================== -->
	<!-- End Topbar header -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Left Sidebar - style you can find in sidebar.scss  -->
	<!-- ============================================================== -->
	<aside class="left-sidebar" data-sidebarbg="skin5">
		<!-- Sidebar scroll-->
		<div class="scroll-sidebar">
			<!-- Sidebar navigation-->
			<nav class="sidebar-nav">
				<ul id="sidebarnav" class="pt-4">
					<li class="sidebar-item">
						<a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Thống kê</span></a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-blogger"></i><span class="hide-menu">Quản lý danh mục bài viết
                </span></a>
						<ul aria-expanded="false" class="collapse first-level">
							<li class="sidebar-item">
								<a href="admin.php?page=blog-category&action=index" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Danh sách </span></a>
							</li>
							<li class="sidebar-item">
								<a href="?page=blog-category&action=create" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Thêm </span></a>
							</li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Quản lý danh mục sản phẩm
                </span></a>
						<ul aria-expanded="false" class="collapse first-level">
							<li class="sidebar-item">
								<a href="admin.php?page=product-category&action=index" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Danh sách </span></a>
							</li>
							<li class="sidebar-item">
								<a href="?page=product-category&action=create" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Thêm </span></a>
							</li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-box"></i><span class="hide-menu">Quản lý sản phẩm
                </span></a>
						<ul aria-expanded="false" class="collapse first-level">
							<li class="sidebar-item">
								<a href="admin.php?page=product&action=index" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Danh sách </span></a>
							</li>
							<li class="sidebar-item">
								<a href="?page=product&action=create" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Thêm </span></a>
							</li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fab fa-wpforms"></i><span class="hide-menu">Quản lý bài viết
                </span></a>
						<ul aria-expanded="false" class="collapse first-level">
							<li class="sidebar-item">
								<a href="admin.php?page=blog&action=index" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Danh sách </span></a>
							</li>
							<li class="sidebar-item">
								<a href="?page=blog&action=create" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Thêm </span></a>
							</li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-user"></i><span class="hide-menu">Quản lý người dùng
                </span></a>
						<ul aria-expanded="false" class="collapse first-level">
							<li class="sidebar-item">
								<a href="admin.php?page=user&action=index" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Danh sách </span></a>
							</li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-paste"></i><span class="hide-menu">Quản lý đơn hàng
                </span></a>
						<ul aria-expanded="false" class="collapse first-level">
							<li class="sidebar-item">
								<a href="admin.php?page=order&action=index" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Danh sách </span></a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
			<!-- End Sidebar navigation -->
		</div>
		<!-- End Sidebar scroll-->
	</aside>
	<!-- ============================================================== -->
	<!-- End Left Sidebar - style you can find in sidebar.scss  -->
	<!-- ============================================================== -->
