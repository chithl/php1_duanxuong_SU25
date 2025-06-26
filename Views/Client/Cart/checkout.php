<?php
$errors = $_SESSION["errors"] ?? [];
?>
	<!-- Breadcrumb Section Begin -->
	<section class="breadcrumb-section set-bg" data-setbg="Assets/Client/img/breadcrumb.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="breadcrumb__text">
						<h2>Thanh toán</h2>
						<div class="breadcrumb__option">
							<a href="index.php">Trang chủ</a>
							<span>Thanh toán</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- Breadcrumb Section End -->

	<!-- Checkout Section Begin -->
	<section class="checkout spad">
        <?php
        if (isset($_SESSION["messageError"])):
            ?>
			<div class="alert alert-warning d-flex align-items-center" role="alert">
				<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
					<use xlink:href="#check-circle-fill"/>
				</svg>
				<div>
                    <?= $_SESSION["messageError"] ?? "" ?>
				</div>
			</div>
        <?php
        endif;
        ?>
		<div class="container">
			<div class="row">

			</div>
			<div class="checkout__form">
				<h4>Hóa đơn chi tiết</h4>
				<form action="index.php?page=checkout-action" method="post">
					<div class="row">
						<div class="col-lg-8 col-md-6">
							<div class="row">
								<div class="col-lg-12">
									<div class="checkout__input">
										<p>Tên người dùng<span>*</span></p>
										<input type="text" name="name" id="name" placeholder="Vui lòng nhập họ và tên" value="<?= $errors["name_old"] ?? "" ?>">
										<small id="helpId" class="text-danger"><?= $errors['name_error'] ?? "" ?></small>
									</div>
								</div>
							</div>

							<div class="checkout__input">
								<p>Địa chỉ chi tiết<span>*</span></p>
								<input type="text" name="address" placeholder="Vui lòng nhập địa chỉ chi tiết" class="checkout__input__add" value="<?= $errors["address_old"] ?? "" ?>">
								<small id="helpId" class="text-danger"><?= $errors['address_error'] ?? "" ?></small>
							</div>
							<div class="checkout__input">
								<p>Số điện thoại<span>*</span></p>
								<input type="text" name="phone" placeholder="Vui lòng nhập số điện thoại" class="checkout__input__add" value="<?= $errors["phone_old"] ?? "" ?>">
								<small id="helpId" class="text-danger"><?= $errors['phone_error'] ?? "" ?></small>
							</div>

							<div id="address">
								<div class="checkout__input">
									<p>Tỉnh/Thành phố<span>*</span></p>
									<select name="province" onchange="selectProvince()" id="province" class="form-control"">
									<option value="" selected disabled>Chọn tỉnh/thành phố</option>
                                    <?php if (isset($province) && is_array($province)): ?><?php foreach ($province as $key => $value): ?>
										<option value="<?php echo $value["ProvinceID"]; ?>"><?php echo $value["ProvinceName"]; ?></option>
                                    <?php endforeach; ?><?php endif; ?>
									</select>
									<small id="helpId" class="text-danger"><?= $errors['province_error'] ?? "" ?></small>
								</div>

								<div class="checkout__input">
									<p>Quận/Huyện<span>*</span></p>
									<select onchange="selectDistrict()" id="district" name="district" class="form-control">
										<option value="" selected disabled>Chọn quận/huyện</option>
									</select>
									<small id="helpId" class="text-danger"><?= $errors['district_error'] ?? "" ?></small>
								</div>

								<div class="checkout__input">
									<p>Phường/Xã<span>*</span></p>
									<select onchange="selectDistrict()" id="ward" name="ward" class="form-control">
										<option value="" selected disabled>Chọn phường/xã</option>
									</select>
									<small id="helpId" class="text-danger"><?= $errors['ward_error'] ?? "" ?></small>
								</div>
							</div>


						</div>
						<div class="col-lg-4 col-md-6">
							<div class="checkout__order">
								<h4>Đơn hàng của bạn</h4>
								<div class="checkout__order__products">Sản phẩm
									<span>Tổng cộng</span>
								</div>
								<ul>
                                    <?php
                                    if (isset($_COOKIE["cart"]) && $_COOKIE["cart"] != ""):
                                        $products = json_decode($_COOKIE["cart"], TRUE);
                                        $totalPrice = 0;
                                        foreach ($products as $key => $value):
                                            $totalPrice += $value["total"];
                                            ?>
											<li><?php echo $value["name"]; ?>
												<span><?php echo number_format($value["price"]); ?> VND</span>
											</li>
                                        <?php
                                        endforeach;
                                    endif;
                                    ?>
								</ul>

								<div class="checkout__order__total">Tổng cộng <span>
										<?php if (isset($totalPrice)){
                                            echo number_format($totalPrice);
                                        }else{
                                            echo "0 ";
                                        } ?>
										VND
									</span>
								</div>
								<div class="checkout__input__checkbox">

								</div>

								<div class="checkout__input__checkbox">
									<label for="paypal">
										COD
										<input type="checkbox" id="paypal" checked>
										<span class="checkmark"></span>
									</label>
								</div>
								<button type="submit" class="site-btn">Đặt hàng</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section><!-- Checkout Section End -->

	<script>


        function selectProvince() {
            var provinceId = $("#province").val();
            // var wardId = $("#ward").val();
            $.post(
                "Controllers/Client/AddressAjax.php", {
                    provinceid: provinceId,
                    // districtid: districtId,
                    // wardcode: wardId,
                },

                function (data) {
                    console.log(data);

                    // $("#address").html(data);
                    // document.querySelector("#address").innerHTML = data;
                    var data = JSON.parse(data);
                    console.log(data);

                    var district = data;
                    // var ward = data.ward;
                    //
                    var getDistrictSelect = document.querySelector("#district");
                    // // var getWardSelect = document.querySelector("#ward");
                    // //
                    for (var districtKey of district) {
                        console.log(districtKey);
                        var option = document.createElement("option");
                        option.value = districtKey["DistrictID"];
                        option.text = districtKey["DistrictName"];
                        getDistrictSelect.appendChild(option);
                    }
                    //
                    // for (var wardKey of ward) {
                    //     console.log(wardKey);
                    //     var option = document.createElement("option");
                    //     option.value = wardKey["WardCode"];
                    //     option.text = wardKey["WardName"];
                    //     if (wardKey["WardCode"] == wardId) {
                    //         option.selected = true;
                    //     }
                    //     getWardSelect.appendChild(option);
                    // }
                }
            )
        }

        function selectDistrict() {
            var districtId = $("#district").val();

            $.post(
                "Controllers/Client/AddressAjax.php", {
                    districtid: districtId,
                },

                function (data) {
                    console.log(data);

                    var data = JSON.parse(data);
                    console.log(data);

                    var ward = data;

                    var getWardSelect = document.querySelector("#ward");
                    var getDistrictSelect = document.querySelector("#district");

                    //

                    for (var districtKey of getDistrictSelect) {
                        if (districtKey["DistrictID"] == districtId) {
                            option.selected = true;
                        }
                    }

                    for (var wardKey of ward) {
                        console.log(wardKey);
                        var option = document.createElement("option");
                        option.value = wardKey["WardCode"];
                        option.text = wardKey["WardName"];

                        if (districtKey["WardCode"] == districtId) {
                            option.selected = true;
                        }

                        getWardSelect.appendChild(option);
                    }
                    //
                    // for (var wardKey of ward) {
                    //     console.log(wardKey);
                    //     var option = document.createElement("option");
                    //     option.value = wardKey["WardCode"];
                    //     option.text = wardKey["WardName"];
                    //     if (wardKey["WardCode"] == wardId) {
                    //         option.selected = true;
                    //     }
                    //     getWardSelect.appendChild(option);
                    // }
                }
            )
        }
	</script>

<?php
unset($_SESSION["errors"]);
unset($_SESSION["messageError"]);
unset($_SESSION["messageCartError"]);
?>