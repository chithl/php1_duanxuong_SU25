<!-- ============================================================== -->
<!-- Page wrapper  -->
<style>


	.chart-container {
		max-width: 800px;
		margin: auto;
		background: white;
		padding: 20px;
		border-radius: 10px;
	}
	}
</style><!-- ============================================================== -->
<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title">Dashboard</h4>
				<div class="ms-auto text-end">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">
								Library
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
		<!-- Sales Cards  -->
		<!-- ============================================================== -->
		<div class="row mb-3">
			<div class="col-md-6 col-lg-2 col-xlg-3">
				<form action="admin.php" method="post">
					<button type="submit" name="revenue" class="btn p-0 w-100">
						<div class="card card-hover" style="cursor: pointer">
							<div class="box bg-success text-center">
								<h1 class="font-light text-white">
									<i class="mdi mdi-view-dashboard"></i>
								</h1>
								<h6 class="text-white">Doanh thu</h6>
							</div>
						</div>
					</button>
				</form>
			</div>
			<div class="col-md-6 col-lg-2 col-xlg-3">
				<form action="admin.php" method="post">
					<button type="submit" name="best-selling" class="btn p-0 w-100">
						<div class="card card-hover" style="cursor: pointer">
							<div class="box bg-danger text-center">
								<h1 class="font-light text-white">
									<i class="mdi mdi-chart-areaspline"></i>
								</h1>
								<h6 class="text-white">Sản phẩm bán chạy</h6>
							</div>
						</div>
					</button>
				</form>
			</div>
		</div>

		<!-- ============================================================== -->
		<!-- Sales chart -->
		<!-- ============================================================== -->


		<div class="chart-container mb-3">
			<h2 class="text-center">Top 10 sản phẩm bán chạy</h2>
			<canvas id="bestSellerChart"></canvas>
		</div>


		<div class="row g-3">
			<!-- Total Users -->
			<div class="col-md-2 col-sm-4 col-6">
				<div class="bg-dark text-white text-center p-2 d-flex flex-column justify-content-center align-items-center" style="min-height: 120px;">
					<i class="mdi mdi-account fs-3 mb-1"></i>
					<h5 class="mb-0 mt-1"><?= $data['totalUsers'] ?></h5>
					<small class="font-light text-truncate">Số người dùng</small>
				</div>
			</div>

			<!-- New Users -->
			<div class="col-md-2 col-sm-4 col-6">
				<div class="bg-dark text-white text-center p-2 d-flex flex-column justify-content-center align-items-center" style="min-height: 120px;">
					<i class="mdi mdi-plus fs-3 mb-1"></i>
					<h5 class="mb-0 mt-1"><?= $data['newUsers'] ?></h5>
					<small class="font-light text-truncate">Người dùng mới</small>
				</div>
			</div>

			<!-- Total Products -->
			<div class="col-md-2 col-sm-4 col-6">
				<div class="bg-dark text-white text-center p-2 d-flex flex-column justify-content-center align-items-center" style="min-height: 120px;">
					<i class="mdi mdi-cart fs-3 mb-1"></i>
					<h5 class="mb-0 mt-1"><?= $data['totalProducts'] ?></h5>
					<small class="font-light text-truncate">Tổng sản phẩm</small>
				</div>
			</div>

			<!-- Total Orders -->
			<div class="col-md-2 col-sm-4 col-6">
				<div class="bg-dark text-white text-center p-2 d-flex flex-column justify-content-center align-items-center" style="min-height: 120px;">
					<i class="mdi mdi-tag fs-3 mb-1"></i>
					<h5 class="mb-0 mt-1"><?= $data['totalOrders'] ?></h5>
					<small class="font-light text-truncate">Tổng đơn hàng</small>
				</div>
			</div>

			<!-- Pending Orders -->
			<div class="col-md-2 col-sm-4 col-6">
				<div class="bg-dark text-white text-center p-2 d-flex flex-column justify-content-center align-items-center" style="min-height: 120px;">
					<i class="mdi mdi-table fs-3 mb-1"></i>
					<h5 class="mb-0 mt-1"><?= $data['pendingOrders'] ?></h5>
					<small class="font-light text-truncate">Chờ xác nhận</small>
				</div>
			</div>

			<!-- Completed Orders -->
			<div class="col-md-2 col-sm-4 col-6">
				<div class="bg-dark text-white text-center p-2 d-flex flex-column justify-content-center align-items-center" style="min-height: 120px;">
					<i class="mdi mdi-web fs-3 mb-1"></i>
					<h5 class="mb-0 mt-1"><?= $data['completedOrders'] ?></h5>
					<small class="font-light text-truncate">Đã thanh toán</small>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- Sales chart -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Recent comment and chats -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Recent comment and chats -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- End Container fluid  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- footer -->
		<!-- ============================================================== -->
		<footer class="footer text-center">
			All Rights Reserved by Matrix-admin. Designed and Developed by
			<a href="https://www.wrappixel.com">WrapPixel</a>.
		</footer>
		<!-- ============================================================== -->
		<!-- End footer -->
		<!-- ============================================================== -->
	</div><!-- ============================================================== --><!-- End Page wrapper  --><!-- ============================================================== -->
    <?php unset($_SESSION['old']);
    unset($_SESSION['errors']); ?>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
        const ctx = document.getElementById('bestSellerChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($bestSell, 'name'), JSON_UNESCAPED_UNICODE) ?>,
                datasets: [{
                    label: 'Số lượng bán',
                    data: <?= json_encode(array_column($bestSell, 'total_sold')) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'x',
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Top 10 sản phẩm bán chạy'
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });
	</script>

