<?php
require "DeliveryController.php";

$delivery = new DeliveryController();
//
$provinceId = $_POST["provinceid"] ?? "";

$districtId = $_POST["districtid"] ?? "";
//
$wardCode = $_POST["wardcode"] ?? "";
//
// $district = $delivery->getDistrict($provinceId);
// //
// $ward = $delivery->getWard($districtId);
//
// $data = [
//     "province" => $province,
//     "district" => $district,
//     "ward"     => $ward,
// ];

$data = [];


if ($provinceId){
    $data = $delivery->getProvince();
}

if ($districtId){
    $data = $delivery->getDistrict($provinceId);
}
if ($wardCode){
    $data = $delivery->getWard($districtId);
}

$data = json_encode($data);
echo $data;

// Tỉnh thành
//echo '<div class="checkout__input">';
//echo '<p>Tỉnh/Thành phố<span>*</span></p>';
//echo '<select onchange="selectProvince()" id="province" class="form-control" name="province">';
//echo '<option value="" selected disabled>Chọn tỉnh/thành phố</option>';
//foreach ($province as $d => $value){
//    $selected = ($value["ProvinceID"] == $provinceId) ? "selected" : "";
//    echo '<option value="' . $value["ProvinceID"] . '" ' . $selected . '>' . $value["ProvinceName"] . '</option>';
//}
//echo '</select>';
//echo '</div>';
////
//// Quận huyện
//echo '<div class="checkout__input">';
//echo '<p>Quận/Huyện<span>*</span></p>';
//echo '<select onchange="selectProvince()" id="district" class="form-control" name="district">';
//echo '<option value="" selected disabled>Chọn quận/huyện</option>';
//foreach ($district as $d => $value){
//    $selected = ($value["DistrictID"] == $districtId) ? "selected" : "";
//    echo '<option value="' . $value["DistrictID"] . '" ' . $selected . '>' . $value["DistrictName"] . '</option>';
//}
//echo '</select>';
//echo '</div>';
////
//// Phường/Xã
//echo '<div class="checkout__input">';
//echo '<p>Phường/Xã<span>*</span></p>';
//echo '<select onchange="selectProvince()" id="ward" class="form-control" name="ward">';
//echo '<option value="" selected disabled>Chọn phường/xã</option>';
//foreach ($ward as $w => $value){
//    $selected = ($value["WardCode"] == $wardCode) ? "selected" : "";
//    echo '<option value="' . $value["WardCode"] . '" ' . $selected . '>' . $value["WardName"] . '</option>';
//}
//echo '</select>';
//echo '</div>';
