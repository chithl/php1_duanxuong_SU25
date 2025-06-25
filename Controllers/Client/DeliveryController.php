<?php

class DeliveryController{
    private $ch;

    public function __construct(){
        $this->ch = curl_init();

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        curl_setopt($this->ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Token: 3976dec8-5124-11f0-928a-1a690f81b498"
        ]);
    }

    /**
     * Hiển thị trang thanh toán.
     *
     * Nạp giao diện thanh toán cho người dùng.
     */
    public function getProvince(){
        curl_setopt($this->ch, CURLOPT_URL,
            "https://online-gateway.ghn.vn/shiip/public-api/master-data/province");

        // Thực thi CURL
        $response = curl_exec($this->ch);
        $response = json_decode($response, TRUE);

        if ($response["code"] == "200"){
            return $response["data"];
        }else{
            header("location: index.php");
            exit;
        }
    }

    public function getDistrict($provinceId){
        curl_setopt($this->ch, CURLOPT_URL, "https://online-gateway.ghn.vn/shiip/public-api/master-data/district");

        $response = curl_exec($this->ch);
        $response = json_decode($response, true);

        $district = [];

        foreach ($response["data"] as $key => $value) {
            if ($value["ProvinceID"] == $provinceId) {
                array_push($district, $response["data"][$key]);
            }
        }

        return $district;
    }

    public function getWard($districtId){
        curl_setopt($this->ch, CURLOPT_URL, "https://online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id=" . $districtId);

        $response = curl_exec($this->ch);
        $response = json_decode($response, true);

        if ($response["code"] == "200"){
            return $response["data"];
        }else{
            echo "Error";
        }
    }

    public function createOrder($toName, $toPhone, $toAddress, $products, $toDistrictId, $toWardCode)
    {
        // DEFAULT SHOP INFORMATION
        $shopId = 4792933;
        $fromName = "Lê Minh Quốc Bảo";
        $fromPhone = "0792846735";
        $fromAddress = "Phong Điền, Cần Thơ";
        $fromWardName = "Xã Mỹ Khánh";
        $fromDistrictName = "Huyện Phong Điền";
        $fromProvinceName = "Cần Thơ";

        $totalPrice = 0;

        $totalWeight = 0;

        foreach($products as $key => $value) {
            $totalPrice += $value["price"] * $value["quantity"];
        }

        foreach($products as $key => $value) {
            $totalWeight += $value["weight"] * $value["quantity"];
        }

        $data = [
            "shop_id" => $shopId,
            "from_name" => $fromName, //string
            "from_phone" => $fromPhone, //string
            "from_address" => $fromAddress, //string
            "from_ward_name" => $fromWardName, //string
            "from_district_name" => $fromDistrictName, //string
            "from_province_name" => $fromProvinceName, //string
            "to_name" => $toName, //string
            "to_phone" => $toPhone, //string
            "to_address" => $toAddress, //string
            "to_ward_code" => $toWardCode, // lấy từ API Get Ward
            "to_district_id" => $toDistrictId,  // lấy từ API Get District
            "cod_amount" => $totalPrice, //TOTAL PRICE
            "content" => "Đây là nội dung đơn hàng",
            "weight" => $totalWeight,
            "length" => 30,
            "width" => 20,
            "height" => 5,
            "payment_type_id" => 2, //Người nhận trả
            "required_note" => "CHOTHUHANG",
            "service_type_id" => 5, //Vận chuyển theo kiểu truyền thống
            "note" => "Gọi trước khi giao",
            "items" => $products,
        ];

        curl_setopt($this->ch, CURLOPT_URL, "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create");
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($this->ch);

        if (curl_errno($this->ch)) {
            echo 'Lỗi CURL: ' . curl_error($this->ch);
        } else {
            echo "Phản hồi từ GHN:\n";
            // header("location: index.php");
            $result = json_decode($response, true)["code"];

            if($result == 200) {
                echo "Thành công";
            }
        }

        curl_close($this->ch);
    }
}
?>