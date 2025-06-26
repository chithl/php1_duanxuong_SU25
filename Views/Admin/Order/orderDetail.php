<div class="page-wrapper">
	<div class="container py-5">
		<div class="card shadow mb-4">
			<div class="card-header py-3 bg-dark text-white">
				<h3 class="m-0 text-center">Chi tiết đơn hàng #<?= $order['id'] ?></h3>
			</div>

			<div class="card-body">
				<div class="row mb-4">
					<div class="col-md-6">
						<h5>Thông tin giao hàng</h5>
						<ul class="list-group">
							<li class="list-group-item"><strong>Người
									đặt:</strong> <?= $order['user_name'] ?? 'Ẩn danh' ?></li>
							<li class="list-group-item">
								<strong>Số điện thoại:</strong> <?= $order['phone'] ?></li>
							<li class="list-group-item">
								<strong>Địa chỉ:</strong> <?= $order['shipping_address'] ?></li>
							<li class="list-group-item"><strong>Ngày giao hàng dự
									kiến:</strong> <?= !empty($order['shipping_date_estimated']) ? date('d/m/Y',
                                    strtotime($order['shipping_date_estimated'])) : '<i>Không có</i>' ?>
							</li>
						</ul>
					</div>
					<div class="col-md-6">
						<h5>Thông tin đơn hàng</h5>
						<ul class="list-group">
							<li class="list-group-item">
								<strong>Mã vận đơn:</strong> <?= $order['tracking_code'] ?></li>
							<li class="list-group-item"><strong>Phương thức thanh
									toán:</strong> <?= $order['payment_method'] ?></li>
							<li class="list-group-item"><strong>Trạng thái thanh toán:</strong>
                                <?php
                                if ($order['payment_status'] === 'completed'){
                                    echo '<span class="badge bg-success text-white">Đã thanh toán</span>';
                                }elseif ($order['payment_status'] === 'canceled'){
                                    echo '<span class="badge bg-danger text-white">Đã hủy</span>';
                                }elseif ($order['payment_status'] === 'expired'){
                                    echo '<span class="badge bg-secondary text-white">Đã quá hạn</span>';
                                }else{
                                    echo '<span class="badge bg-warning text-white">Chờ xác nhận</span>';
                                }
                                ?>
							</li>

							<li class="list-group-item"><strong>Trạng thái giao hàng:</strong>
                                <?php
                                if ($order['shipping_status'] === 'shipped'){
                                    echo '<span class="badge bg-success text-white">Hoàn tất</span>';
                                }elseif ($order['shipping_status'] === 'shipping'){
                                    echo '<span class="badge bg-primary text-white">Đang giao</span>';
                                }elseif ($order['shipping_status'] === 'failed'){
                                    echo '<span class="badge bg-danger text-white">Giao thất bại</span>';
                                }else{
                                    echo '<span class="badge bg-warning text-white">Chờ xác nhận</span>';
                                }
                                ?>
							</li>
							<li class="list-group-item"><strong>Tổng tiền:</strong>
								<span class="text-danger fw-bold"><?= number_format($order['total_price']) ?>₫</span>
							</li>
						</ul>
					</div>
				</div>

				<h5 class="mt-4 mb-3">Sản phẩm trong đơn hàng</h5>
				<div class="table-responsive">
					<table class="table table-bordered align-middle text-center">
						<thead class="table-light">
						<tr>
							<th>#</th>
							<th>Hình ảnh</th>
							<th>Tên sản phẩm</th>
							<th>Giá</th>
							<th>Số lượng</th>
							<th>Thành tiền</th>
							<th>Chi tiết</th>
						</tr>
						</thead>
						<tbody>
                        <?php foreach ($orderDetails as $index => $item): ?>
							<tr>
								<td><?= $index + 1 ?></td>
								<td><img src="Uploads/Products/<?= $item['image'] ?>" width="60"></td>
								<td><?= $item['product_name'] ?></td>
								<td><?= number_format($item['price']) ?>₫</td>
								<td><?= $item['quantity'] ?></td>
								<td class="fw-bold text-danger"><?= number_format($item['price'] * $item['quantity']) ?>₫</td>
								<td>
									<button class="btn btn-sm btn-info" type="button" data-toggle="collapse" data-target="#detail<?= $index ?>">
										Xem chi tiết
									</button>
								</td>
							</tr>
							<tr class="collapse" id="detail<?= $index ?>">
								<td colspan="7" class="bg-light text-start">
									<div class="d-flex flex-column pl-3 py-2">

										<div><strong>Trọng lượng:</strong> <?= $item['weight'] ?> kg
										</div>
										<div><strong>Mô tả:</strong> <?= $item['description'] ?? 'Không có mô tả' ?></div>
									</div>
								</td>
							</tr>
                        <?php endforeach; ?>
						</tbody>

					</table>
				</div>

				<!-- FORM CẬP NHẬT TRẠNG THÁI -->
				<div class="mt-4 border-top pt-4">
					<div class="text-end mb-2">
						<button class="btn btn-warning" onclick="toggleStatusForm()">✏️ Sửa trạng thái</button>
					</div>

					<form action="?page=order&action=updateStatus" method="post" id="statusForm" style="display:none;">
						<input type="hidden" name="id" value="<?= $order['id'] ?>">

						<div class="row mb-3">
							<div class="col-md-6">
								<label for="payment_status" class="form-label">Trạng thái thanh toán</label>
								<select name="payment_status" id="payment_status" class="form-control">
									<option value="Chờ xác nhận" <?= $order['payment_status'] == 'Chờ xác nhận' ? 'selected' : '' ?>>
										Chờ xác nhận
									</option>
									<option value="Đã thanh toán" <?= $order['payment_status'] == 'Đã thanh toán' ? 'selected' : '' ?>>
										Đã thanh
										toán
									</option>
									<option value="Đã hủy" <?= $order['payment_status'] == 'Đã hủy' ? 'selected' : '' ?>>
										Đã hủy
									</option>
									<option value="Đã quá hạn" <?= $order['payment_status'] == 'Đã quá hạn' ? 'selected' : '' ?>>
										Đã quá hạn
									</option>
								</select>
							</div>
							<div class="col-md-6">
								<label for="shipping_status" class="form-label">Trạng thái giao hàng</label>
								<select name="shipping_status" id="shipping_status" class="form-control">
									<option value="Chờ xác nhận" <?= $order['shipping_status'] == 'Chờ xác nhận' ? 'selected' : '' ?>>Chờ xác nhận</option>
									<option value="Đã giao" <?= $order['shipping_status'] == 'Đã giao' ? 'selected' : '' ?>>Đã giao</option>
									<option value="Đang giao" <?= $order['shipping_status'] == 'Đã giao' ? 'selected' : '' ?>>Đang giao</option>
									<option value="Thất bại" <?= $order['shipping_status'] == 'Thất bại' ? 'selected' : '' ?>>Thất bại</option>
								</select>
							</div>
						</div>

						<div class="text-end">
							<button type="submit" class="btn btn-success">💾 Lưu trạng thái</button>
						</div>
					</form>

					<script>
                        function toggleStatusForm() {
                            const form = document.getElementById('statusForm');
                            form.style.display = form.style.display === 'none' ? 'block' : 'none';
                        }
					</script>
				</div>

				<div class="text-start mt-4">
					<a href="?page=order&action=index&status=" class="btn btn-secondary">← Quay lại danh sách</a>
				</div>
			</div>
		</div>
	</div>
</div><!-- jQuery (bắt buộc) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Popper.js (cần cho dropdown/collapse) -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Bootstrap 4 JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
