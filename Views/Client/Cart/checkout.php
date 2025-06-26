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
									<input type="text" name="name" id="name" placeholder="Vui lòng nhập họ và tên">
									<small id="helpId" class="text-danger"><?= $errors['name_error'] ?? "" ?></small>
								</div>
							</div>

						</div>

						<div id="listne">

						</div>

						<div class="checkout__input">
							<p>Địa chỉ chi tiết<span>*</span></p>
							<input type="text" name="address" placeholder="Vui lòng nhập địa chỉ chi tiết" class="checkout__input__add">
							<small id="helpId" class="text-danger"><?= $errors['address_error'] ?? "" ?></small>
						</div>
						<div class="checkout__input">
							<p>Số điện thoại<span>*</span></p>
							<input type="text" name="phone" placeholder="Vui lòng nhập số điện thoại" class="checkout__input__add">
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
								<select onchange="selectProvince()" id="district" name="district" class="form-control">
									<option value="" selected disabled>Chọn quận/huyện</option>
								</select>
								<small id="helpId" class="text-danger"><?= $errors['district_error'] ?? "" ?></small>
							</div>

							<div class="checkout__input">
								<p>Phường/Xã<span>*</span></p>
								<select onchange="selectProvince()" id="ward" name="ward" class="form-control">
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
								<li>Vegetable’s Package <span>$75.99</span></li>
								<li>Fresh Vegetable <span>$151.99</span></li>
								<li>Organic Bananas <span>$53.99</span></li>
							</ul>

							<div class="checkout__order__total">Tổng cộng <span>$750.99</span>
							</div>
							<div class="checkout__input__checkbox">

							</div>
							<p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
								ut labore et dolore magna aliqua.</p>

							<div class="checkout__input__checkbox">
								<label for="paypal">
									COD
									<input type="checkbox" id="paypal">
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
        // var districtId = $("#district").val();
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

                // var district = data.district;
                // var ward = data.ward;
				//
                // var getDistrictSelect = document.querySelector("#district");
                // var getWardSelect = document.querySelector("#ward");
				//
                // for (var districtKey of district) {
                //     console.log(districtKey);
                //     var option = document.createElement("option");
                //     option.value = districtKey["DistrictID"];
                //     option.text = districtKey["DistrictName"];
                //     if (districtKey["DistrictID"] == districtId) {
                //         option.selected = true;
                //     }
                //     getDistrictSelect.appendChild(option);
                // }
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
        // var districtId = $("#district").val();
        // var wardId = $("#ward").val();
        $.post(
            "Controllers/Client/AddressAjax.php", {
                // provinceid: provinceId,
                districtid: districtId,
                // wardcode: wardId,
            },

            function (data) {
                console.log(data);

                // $("#address").html(data);
                // document.querySelector("#address").innerHTML = data;
                var data = JSON.parse(data);
                console.log(data);

                // var district = data.district;
                // var ward = data.ward;
                //
                // var getDistrictSelect = document.querySelector("#district");
                // var getWardSelect = document.querySelector("#ward");
                //
                // for (var districtKey of district) {
                //     console.log(districtKey);
                //     var option = document.createElement("option");
                //     option.value = districtKey["DistrictID"];
                //     option.text = districtKey["DistrictName"];
                //     if (districtKey["DistrictID"] == districtId) {
                //         option.selected = true;
                //     }
                //     getDistrictSelect.appendChild(option);
                // }
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