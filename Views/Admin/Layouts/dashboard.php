<!-- ============================================================== -->
<!-- Page wrapper  -->
<style>


	.dashboard-container {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
		gap: 20px;
	}

	.card-dashboard {
		background-color: white;
		padding: 20px;
		border-radius: 12px;
		box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
	}

	.card h3 {
		margin: 0;
		font-size: 16px;
		color: #555;
	}

	.card p {
		font-size: 22px;
		color: #2c3e50;
		margin-top: 8px;
	}

	.chart-container {
		margin-top: 40px;
		background: white;
		padding: 20px;
		border-radius: 12px;
		box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
	}

	table {
		margin-top: 20px;
		border-collapse: collapse;
		width: 100%;
		background: white;
		box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
	}

	table th,
	table td {
		border: 1px solid #ddd;
		padding: 12px;
		text-align: center;
	}

	table th {
		background-color: #f0f0f0;
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

		<div class="dashboard-container">
			<div class="card-dashboard">
				<h3>Doanh thu hôm nay</h3>
				<p><?= number_format($todayRevenue) ?> đ</p>
			</div>
			<div class="card-dashboard">
				<h3>Doanh thu tháng này</h3>
				<p><?= number_format($monthRevenue) ?> đ</p>
			</div>
			<div class="card-dashboard">
				<h3>Đơn hàng hôm nay</h3>
				<p><?= $todayOrders ?> đơn</p>
			</div>
			<div class="card-dashboard">
				<h3>Đơn đang xử lý</h3>
				<p><?= $pendingOrders ?> đơn</p>
			</div>
		</div>

		<div class="chart-container">
			<h3>Doanh thu 7 ngày gần nhất</h3>
			<canvas id="revenueChart" height="100"></canvas>
		</div>

		<table class="mb-3">
			<thead>
			<tr>
				<th>Ngày</th>
				<th>Doanh thu</th>
			</tr>
			</thead>
			<tbody>
            <?php foreach ($revenueByDay as $row): ?>
				<tr>
					<td><?= htmlspecialchars($row['day']) ?></td>
					<td><?= number_format($row['revenue']) ?> đ</td>
				</tr>
            <?php endforeach; ?>
			</tbody>
		</table>
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
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($revenueByDay, 'day')) ?>,
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: <?= json_encode(array_column($revenueByDay, 'revenue')) ?>,
                    borderColor: '#27ae60',
                    backgroundColor: 'rgba(39, 174, 96, 0.1)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                },
                scales: {
                    y: {
                        ticks: {
                            callback: value => value.toLocaleString('vi-VN') + ' đ'
                        }
                    }
                }
            }
        });
	</script>

