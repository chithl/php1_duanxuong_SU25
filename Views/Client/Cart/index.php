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
    <?php
    if (isset($_SESSION["messageSuccess"])):
        ?>
		<div class="alert alert-success d-flex align-items-center" role="alert">
			<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
				<use xlink:href="#check-circle-fill"/>
			</svg>
			<div>
                <?= $_SESSION["messageSuccess"] ?? "" ?>
			</div>
		</div>
    <?php
    endif;
    ?>
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
                                    <?= $value["price"] ?? "" ?>
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
                                    <?= $value["total"] ?? "" ?>
								</td>
								<td class="shoping__cart__item__close">
									<span class="icon_close"></span>
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