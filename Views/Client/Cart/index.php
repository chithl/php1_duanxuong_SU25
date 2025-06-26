<style>
	.quantity-wrapper {
		display: inline-flex;
		align-items: center;
		border: 1px solid #ccc;
		border-radius: 8px;
		overflow: hidden;
		width: fit-content;
	}
	.quantity-button {
		background-color: #f0f0f0;
		border: none;
		padding: 8px 12px;
		font-size: 16px;
		cursor: pointer;
		transition: background 0.2s;
	}

	.quantity-button:hover {
		background-color: #e0e0e0;
	}

	.quantity-input {
		width: 50px;
		text-align: center;
		border: none;
		outline: none;
		font-size: 16px;
		padding: 8px;
	}

	/* Optional: Hide spinners in number input (for Chrome) */
	input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	#delete-icon {
		font-size: 30px;
	}

	#delete-icon:hover {
		color: black;
	}
	/*css model*/
	/* Overlay nền tối */
	.modal-overlay {
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: rgba(0, 0, 0, 0.5);
		opacity: 0;
		visibility: hidden;
		transition: opacity 0.3s ease;
	}

	/* Hộp modal */
	.modal-box {
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -60%);
		background-color: #fff;
		padding: 20px;
		border-radius: 10px;
		width: 90%;
		max-width: 400px;
		opacity: 0;
		transition: all 0.4s ease;
	}

	/* Hiện modal */
	.modal-overlay {
		position: fixed;
		top: 0; left: 0; right: 0; bottom: 0;
		background-color: rgba(0, 0, 0, 0.5);
		opacity: 0;
		visibility: hidden;
		transition: opacity 0.3s ease;
		z-index: 999;
	}

	.modal-box {
		position: fixed;
		top: 50%; left: 50%;
		transform: translate(-50%, -60%);
		background-color: #fff;
		padding: 20px;
		border-radius: 10px;
		width: 90%;
		max-width: 400px;
		opacity: 0;
		transition: all 0.4s ease;
		z-index: 1000;
	}

	.modal-overlay.active {
		opacity: 1;
		visibility: visible;
	}

	.modal-overlay.active .modal-box {
		transform: translate(-50%, -50%);
		opacity: 1;
	}

	.modal-header {
		font-size: 18px;
		font-weight: bold;
		margin-bottom: 10px;
	}

	.modal-footer {
		text-align: right;
		margin-top: 15px;
	}

	.btn-close {
		padding: 6px 12px;
		background-color: #6c757d;
		color: white;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}
</style><!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="Assets/Client/img/breadcrumb.jpg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="breadcrumb__text">
					<h2>Giỏ hàng</h2>
					<div class="breadcrumb__option">
						<a href="index.php">Trang chủ</a>
						<span>Giỏ hàng</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- Breadcrumb Section End --><!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
	<!--	start model-->
    <?php
    if (isset($_SESSION["messageSuccess"])):
        ?>
	    <div class="modal-overlay active" id="myModal">
		    <div class="modal-box">
			    <div class="modal-header">Thông báo</div>
			    <div class="modal-body">
                    <?= htmlspecialchars($_SESSION["messageSuccess"]) ?>
			    </div>
			    <div class="modal-footer">
				    <button class="btn-close" onclick="closeModal()">Đóng</button>
			    </div>
		    </div>
	    </div>
	    <script>
            function closeModal() {
                document.getElementById('myModal').classList.remove('active');
            }

            window.addEventListener('load', function () {
            });
	    </script>
    <?php endif; ?>
	<!--	end of modal-->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="shoping__cart__table">
					<table>
						<thead>
						<tr>
							<th class="shoping__product">Sản phẩm</th>
							<th>Giá</th>
							<th>Số lượng</th>
							<th>Tổng tiền</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
                        <?php
                        if ($result == ""){
                            return;
                        }

                        foreach ($result as $key => $value):
                            ?>
							<tr>
								<td class="shoping__cart__item">
									<img src="Uploads/Products<?= $result["image"] ?? '' ?>" alt="">
									<h5><?= $value["name"] ?? "" ?></h5>
								</td>
								<td class="shoping__cart__price">
                                    <?= $value["price"] ?? "" ?> VND
								</td>
								<td class="shoping__cart__quantity">
									<div class="quantity">
										<div class="quantity-wrapper">
											<a href="index.php?page=product-cart-decrement&id=<?= $value["id"] ?>" class="quantity-button">−</a>
											<input min="0" type="number" id="quantity" class="quantity-input" value="<?= $value["quantity"] ?? "" ?>" min="1">
											<a href="index.php?page=add-to-cart&id=<?= $value["id"] ?>" class="quantity-button">+</a>
										</div>
									</div>
								</td>
								<td class="shoping__cart__total">
                                    <?= $value["total"] ?? "" ?> VND
								</td>
								<td class="shoping__cart__item__close">
									<a id="delete-icon" href="index.php?page=delete-product-cart&id=<?= $value["id"] ?>" class="icon_close"></a>
								</td>
							</tr>
                        <?php
                        endforeach;
                        ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="shoping__cart__btns">
					<a href="index.php?page=product-list" class="primary-btn cart-btn">Tiếp tục mua sắm</a>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="shoping__continue">
					<div class="shoping__discount"></div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="shoping__checkout">
					<h5>Tổng giỏ hàng</h5>
					<ul>
						<li>Tổng cộng: <span>
								<?php
                                $totalCart = 0;
                                foreach ($result as $key => $value){
                                    $totalCart += $value["total"];
                                }

                                echo number_format($totalCart) . " VNĐ";
                                ?>
							</span></li>
					</ul>
					<a href="index.php?page=checkout" class="primary-btn">Thanh toán</a>
				</div>
			</div>
		</div>
	</div>
</section><!-- Shoping Cart Section End -->
<?php
unset($_SESSION["messageSuccess"]);
?>