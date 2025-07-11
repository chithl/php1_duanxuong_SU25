<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="UTF-8">
	<meta name="description" content="Ogani Template">
	<meta name="keywords" content="Ogani, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Ogani | Template</title>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

	<!-- Css Styles -->
	<link rel="stylesheet" href="Assets/Client/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="Assets/Client/css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="Assets/Client/css/elegant-icons.css" type="text/css">
	<!--	<link rel="stylesheet" href="Assets/Client/css/nice-select.css" type="text/css">-->
	<link rel="stylesheet" href="Assets/Client/css/jquery-ui.min.css" type="text/css">
	<link rel="stylesheet" href="Assets/Client/css/owl.carousel.min.css" type="text/css">
	<link rel="stylesheet" href="Assets/Client/css/slicknav.min.css" type="text/css">
	<link rel="stylesheet" href="Assets/Client/css/style.css" type="text/css">
	<link rel="stylesheet" href="Assets/Client/css/register.css" type="text/css">
	<link rel="stylesheet" href="Assets/Client/css/login.css" type="text/css">
	<link rel="stylesheet" href="Assets/Client/css/forgot-password.css" type="text/css">
	<link rel="stylesheet" href="Assets/Client/css/reset-password.css" type="text/css">
	<link rel="stylesheet" href="Assets/Client/css/profile.css" type="text/css">
	<link rel="stylesheet" href="Assets/Client/css/about.css" type="text/css">
	<link rel="stylesheet" href="Assets/Client/css/checkout.css" type="text/css">

</head>

<body>


<!-- Header Section Begin -->
<header class="header">
	<div class="header__top">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="header__top__left">
						<ul>
							<li><i class="fa fa-envelope"></i> FPoly2025@gmail.com</li>

						</ul>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="header__top__right">


						<div class="header__top__right__auth">
                            <?php if (isset($_SESSION['login'])): ?>
								<span><a href="?page=profile&id=<?= htmlspecialchars($_SESSION['login']['id']) ?>"><i class="fa fa-user"></i> <?= htmlspecialchars($_SESSION['login']['username']) ?></a></span>
								<a href="?page=logout">Đăng xuất</a>
                            <?php else: ?>
								<a href="?page=login&action=index"><i class="fa fa-user"></i> Đăng nhập</a>
                            <?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-2">
				<div class="header__logo">
					<a href="index.php"><img src="Assets/Client/img/logo.png" alt=""></a>
				</div>
			</div>
			<div class="col-lg-8">
				<nav class="header__menu">
					<ul>
						<li class="active"><a href="index.php">Trang chủ</a></li>
						<li><a href="?page=product-list">Sản phẩm</a></li>
						<li><a href="?page=blog-list">Bài viết</a></li>
						<li><a href="?page=contact">Liên Hệ</a></li>
						<li><a href="?page=about">Về chúng tôi</a></li>
					</ul>
				</nav>
			</div>
			<div class="col-lg-2">
				<div class="header__cart">
					<ul>
						<li><a href="?page=cart"><i class="fa fa-shopping-bag"></i> </a></li>
					</ul>
                    <?php
                    if (isset($_COOKIE['cart'])){
                        $cart       = json_decode($_COOKIE['cart'], TRUE);
                        $totalPrice = 0;

                        foreach ($cart as $key => $value){
                            $totalPrice += $value['total'];
                        }
                    }
                    ?>
					<div class="header__cart__price">Giỏ hàng:
						<span>
							<?php
                            if (isset($totalPrice)){
                                echo number_format($totalPrice) . ' VND';
                            }else{
                                echo '0 VND';
                            }
                            ?>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="humberger__open">
			<i class="fa fa-bars"></i>
		</div>
	</div>
</header>
<!-- Hero Section Begin -->
<section class="hero">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="hero__search w-100">
					<div class="hero__search__form w-100">
						<form action="index.php?page=product-list" class="d-flex w-100">
							<input type="hidden" name="page" value="product-list">
							<input type="text" name="name" class="form-control" placeholder="Bạn đang tìm kiếm gì?" style="flex:1;" value="<?= $_GET['name'] ?? ''; ?>">>

							<button type="submit" class="site-btn" style="min-width:120px;">Tìm</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Hero Section End -->
