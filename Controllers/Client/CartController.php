<?php

/**
 * Class CartController
 *
 * Lớp CartController quản lý các chức năng hiển thị giỏ hàng và thanh toán phía client.
 */
class CartController{

    /**
     * CartController constructor.
     * Khởi tạo đối tượng CartController.
     */
    public function __construct(){
    }

    /**
     * Hiển thị trang giỏ hàng.
     *
     * Nạp giao diện giỏ hàng cho người dùng.
     */
    public function cart(){
        if (isset($_COOKIE["cart"])){
            $result = json_decode($_COOKIE["cart"], TRUE);
        }else{
            $result = [];
        }

        include 'Views/Client/Cart/index.php';
    }

    /**
     * Hiển thị trang thanh toán.
     *
     * Nạp giao diện thanh toán cho người dùng.
     */
    public function checkout(){
        require_once "Controllers/Client/DeliveryController.php";
        $delivery = new DeliveryController();
        $province = $delivery->getProvince();
        include 'Views/Client/Cart/checkout.php';
    }

    public function addProductToCart(){
        require "Models/Product.php";

        $productModel = new Product();
        $id           = $_GET["id"] ?? "";

        if (!$id){
            echo "Thiếu ID sản phẩm.";

            return;
        }

        // Lấy sản phẩm từ DB
        $product = $productModel->getOne($id);

        if (!is_array($product)){
            echo "Sản phẩm không tồn tại.";

            return;
        }

        $product["quantity"] = 1;
        $product["total"]    = $product["price"] * $product["quantity"];

        // Xử lý giỏ hàng
        $cart = [];

        if (isset($_COOKIE["cart"])){
            $cart  = json_decode($_COOKIE["cart"], TRUE);
            $found = FALSE;

            foreach ($cart as $key => $item){
                if ($item["id"] == $id){
                    $cart[$key]["quantity"] += 1;
                    $cart[$key]["total"]    = $cart[$key]["quantity"] * $item["price"];
                    $found                  = TRUE;
                    break;
                }
            }

            if (!$found){
                $cart[] = $product;
            }
        }else{
            $cart[] = $product;
        }

        // Cập nhật lại cookie
        setcookie("cart", json_encode($cart), time() + 3600 * 24 * 30, "/");
        header("Location: index.php?page=cart");
        exit;
    }

    public function productCartDecrement(){
        require "Models/Product.php";

        $productModel = new Product();
        $id           = $_GET["id"] ?? "";

        if (!$id){
            echo "Thiếu ID sản phẩm.";

            return;
        }

        // Lấy sản phẩm từ DB
        $product = $productModel->getOne($id);

        if (!is_array($product)){
            echo "Sản phẩm không tồn tại.";

            return;
        }

        $product["quantity"] = 1;
        $product["total"]    = $product["price"] * $product["quantity"];

        // Xử lý giỏ hàng
        $cart = [];

        if (isset($_COOKIE["cart"])){
            $cart  = json_decode($_COOKIE["cart"], TRUE);
            $found = FALSE;

            foreach ($cart as $key => $item){
                if ($item["id"] == $id){
                    if ($cart[$key]["quantity"] <= 0){
                        // Nếu số lượng sản phẩm đã bằng 0, không cần giảm nữa
                        $cart[$key]["quantity"] = 0;
                        $cart[$key]["total"]    = 0;
                        unset($cart[$key]); // Xoá sản phẩm khỏi giỏ hàng nếu số lượng bằng 0
                        setcookie("cart", json_encode(array_values($cart)), time() + 3600 * 24 * 30,
                            "/");
                        header("Location: index.php?page=cart");
                        exit;
                    }
                    $cart[$key]["quantity"] -= 1;
                    $cart[$key]["total"]    = $cart[$key]["quantity"] * $item["price"];
                    $found                  = TRUE;
                    break;
                }
            }

            if (!$found){
                $cart[] = $product;
            }
        }else{
            $cart[] = $product;
        }

        // Cập nhật lại cookie
        setcookie("cart", json_encode($cart), time() + 3600 * 24 * 30, "/");
        header("Location: index.php?page=cart");
        exit;
    }

    public function checkoutAction(){
        $name    = $_POST["name"] ?? "";
        $phone   = $_POST["phone"] ?? "";
        $address = $_POST["address"] ?? "";

        $provinceId = $_POST["province"] ?? "";
        $districtId = $_POST["district"] ?? "";
        $wardCode   = $_POST["ward"] ?? "";

        $errors = [];

        if ($name == ""){
            $errors["name_error"] = "Vui lòng nhập họ và tên.";
        }

        if ($phone == ""){
            $errors["phone_error"] = "Vui lòng nhập số điện thoại.";
        }elseif (!preg_match('/^\d{10,11}$/', $phone)){
            $errors["phone_error"] = "Số điện thoại không hợp lệ. Vui lòng nhập 10 hoặc 11 chữ số.";
        }

        if ($address == ""){
            $errors["address_error"] = "Vui lòng nhập địa chỉ chi tiết.";
        }

        if(empty($provinceId)) {
            $errors["province_error"] = "Vui lòng chọn quận tình thành phố.";
        }

        if(empty($districtId)) {
            $errors["district_error"] = "Vui lòng chọn quận huyện.";
        }

        if(empty($wardCode)) {
            $errors["ward_error"] = "Vui lòng chọn phường xã.";
        }

        $products = json_decode($_COOKIE["cart"], TRUE) ?? "";

        if(!is_array($products)) {
            $_SESSION["messageError"] = "Giỏ hàng của bạn không có sản phẩm nào.";
            header("location: index.php?page=checkout");
            exit;
        }

        if(count($errors) > 0){
            $errors["name_old"] = $name;
            $errors["phone_old"] = $phone;
            $errors["address_old"] = $address;

            // Nếu có lỗi, lưu vào session và chuyển hướng về trang checkout
            $_SESSION["messageError"] = "Vui lòng kiểm tra lại thông tin bạn đã nhập.";
            $_SESSION["errors"] = $errors;
            header("Location: index.php?page=checkout");
            exit;
        }

        //      Tùy chỉnh lại các trường cần thiết từ sản phẩm
        $wantedKeys       = ['name', 'quantity', 'price', 'weight'];
        $filteredProducts = [];

        foreach ($products as $p){
            $filteredProducts[] = array_intersect_key($p, array_flip($wantedKeys));
        }

        require_once "Controllers/Client/DeliveryController.php";
        $delivery = new DeliveryController();
        $result   = $delivery->createOrder($name, $phone, $address, $filteredProducts, $districtId,
            $wardCode);

        if ($result["code"] == 200){
            echo "Đặt hàng thành công!";
            setcookie("cart", "", time()-3600);

            $messageSuccess = "Đặt hàng thành công! Mã đơn hàng: " . $result["data"]["order_code"];
            $_SESSION["messageSuccess"] = $messageSuccess;
            header("location: index.php?page=cart");
            exit;
        }else{
            echo "Đặt hàng thất bại: " . $result["message"];
        }
    }
}