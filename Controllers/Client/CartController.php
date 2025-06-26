<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'Models/Order.php';

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
        if($product['discount_price'] > 0){
            $product['price'] = $product['discount_price'];
        }
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

            if (count($cart) <= 0){
                setcookie("cart", "", time() - 3600, "/");
                header("Location: index.php?page=cart");
                exit;
            }

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

    public function deleteProductFromCart(){
        $id = $_GET["id"] ?? "";

        if (!$id){
            echo "Thiếu ID sản phẩm.";

            return;
        }

        // Xử lý giỏ hàng
        $cart = [];

        if (isset($_COOKIE["cart"])){
            $cart = json_decode($_COOKIE["cart"], TRUE);

            foreach ($cart as $key => $item){
                if ($item["id"] == $id){
                    unset($cart[$key]);

                    if (count($cart) <= 0){
                        // Nếu giỏ hàng trống, xoá cookie
                        setcookie("cart", "", time() - 3600, "/");
                        header("Location: index.php?page=cart");
                        exit;
                    }
                    break;
                }
            }
        }

        // Cập nhật lại cookie
        setcookie("cart", json_encode(array_values($cart)), time() + 3600 * 24 * 30, "/");
        header("Location: index.php?page=cart");
        exit;
    }

    public function checkoutAction(){
        if (!isset($_SESSION['login'])){
            $messageLogin             = "Vui lòng đăng nhập để thanh toán.";
            $_SESSION["messageLogin"] = $messageLogin;
            header("Location: index.php?page=login&action=index");
            exit;
        }

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

        if (empty($provinceId)){
            $errors["province_error"] = "Vui lòng chọn quận tình thành phố.";
        }

        if (empty($districtId)){
            $errors["district_error"] = "Vui lòng chọn quận huyện.";
        }

        if (empty($wardCode)){
            $errors["ward_error"] = "Vui lòng chọn phường xã.";
        }

        $products = json_decode($_COOKIE["cart"], TRUE) ?? "";

        if (!is_array($products)){
            $_SESSION["messageError"] = "Giỏ hàng của bạn không có sản phẩm nào.";
            header("location: index.php?page=checkout");
            exit;
        }

        if (count($errors) > 0){
            $errors["name_old"]    = $name;
            $errors["phone_old"]   = $phone;
            $errors["address_old"] = $address;

            // Nếu có lỗi, lưu vào session và chuyển hướng về trang checkout
            $_SESSION["messageError"] = "Vui lòng kiểm tra lại thông tin bạn đã nhập.";
            $_SESSION["errors"]       = $errors;
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
        $delivery    = new DeliveryController();
        $result      = $delivery->createOrder($name, $phone, $address, $filteredProducts,
            $districtId,
            $wardCode);
        $total_price = 0;
        foreach ($filteredProducts as $item){
            $total_price += $item['price'] * $item['quantity'];
        }
        if ($result["code"] == 200){
            $orderCode = $result["data"]["order_code"];

            // Lưu vào bảng orders
            $orderModel   = new Order(); // class model xử lý bảng orders
            $orderId      = $orderModel->store([
                'user_id'                 => $_SESSION['userId'],
                'order_code'              => $orderCode,
                'total_price'             => $total_price,
                'address'                 => $address,
                'phone'                   => $phone,
                'shipping_date_estimated' => date('Y-m-d H:i:s',
                    strtotime('+3 days')), // Ngày giao hàng dự kiến
                'created_at'              => date('Y-m-d H:i:s')

            ]);
            $trackingCode = $orderModel->generateTrackingCode($orderId);
            $orderModel->updateTrackingCode($orderId, $trackingCode);
            // Lưu vào bảng order_details
            $orderDetailModel = new Order(); // class model xử lý bảng order_details
            foreach ($filteredProducts as $item){
                $orderDetailModel->storeDetail([
                    'order_id'   => $orderId,
                    'product_id' => $item['id'], // bạn cần chắc chắn `$item['id']` tồn tại
                    'name'       => $item['name'],
                    'price'      => $item['price'],
                    'quantity'   => $item['quantity'],
                    'weight'     => $item['weight']
                ]);
            }

            // Gửi mail và xóa giỏ hàng
            if (isset($_SESSION["userId"])){
                $this->sendMail($_SESSION["userId"], $address);
                setcookie("cart", "", time() - 3600);
            }

            echo "Đặt hàng thành công!";

            $messageSuccess             = "Đặt hàng thành công! Mã đơn hàng: " . $result["data"]["order_code"];
            $_SESSION["messageSuccess"] = $messageSuccess;
            header("location: index.php?page=cart");
            exit;
        }else{
            file_put_contents("Logs/delivery.log", $result["message"], FILE_APPEND);
            $messageError             = "Lỗi hệ thống không thể đặt hàng được. Vui lòng thử lại sau.";
            $_SESSION["messageError"] = $messageError;
            header("location: index.php?page=checkout");
            exit;
        }
    }

    public function sendMail($userId, $address){
        require_once "Models/User.php";
        $userModel = new User();
        echo $userId;
        $account = $userModel->getEmailByUserId($userId);

        $email = $account["email"];

        echo $account["username"];

        require_once 'Assets/PHPMailer-6.10.0/src/PHPMailer.php';
        require_once 'Assets/PHPMailer-6.10.0/src/SMTP.php';
        require_once 'Assets/PHPMailer-6.10.0/src/Exception.php';

        $mail = new PHPMailer(TRUE);
        //        $mail->charSet = 'UTF-8';
        $mail->setLanguage('vi');
        $mail->CharSet = "UTF-8";

        try{
            $mail->SMTPDebug   = 2;
            $mail->Debugoutput = 'html';

            // Cấu hình SMTP Gmail
            $mail->isSMTP();
            $mail->Host     = 'smtp.gmail.com';
            $mail->SMTPAuth = TRUE;

            // Gmail của tôi
            $mail->Username = 'baolmq05@gmail.com';

            // App Password Google
            $mail->Password = 'oahm irqv pzsl cuvb';

            $mail->SMTPSecure = 'tls';  // hoặc: PHPMailer::ENCRYPTION_STARTTLS
            $mail->Port       = 587;
            // Người gửi
            $mail->setFrom('baolmq05@gmail.com', 'Đặt hàng thành công');

            // Người nhận
            $mail->addAddress($email, 'Client Bao');

            // Nội dung
            $mail->Subject = 'Đặt hàng thành công';

            $body0 = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Hóa đơn</title>
            <style>
                body { font-family: Arial, sans-serif; color: #333; padding: 20px; }
                .invoice-box { max-width: 700px; margin: auto; border: 1px solid #eee; padding: 30px; background-color: #f9f9f9; }
                h2 { text-align: center; color: #2c3e50; }
                .info { margin-bottom: 20px; }
                .info p { margin: 5px 0; }
                table { width: 100%; border-collapse: collapse; }
                th, td { padding: 8px 12px; text-align: left; border-bottom: 1px solid #ddd; }
                th { background-color: #f0f0f0; }
                .total { text-align: right; font-weight: bold; padding-top: 10px; }
            </style>
        </head>
        <body>
            <div class="invoice-box">
                <h2>HÓA ĐƠN MUA HÀNG</h2>
        
                <div class="info">
                ';

            $body1 = '<p><strong>Tên người nhận:</strong>' . ' ' . $account["username"] . '</p>
                    <p><strong>Số điện thoại:</strong>' . ' ' . $account["phone"] . '</p>
                    <p><strong>Địa chỉ:</strong>' . ' ' . $address . '</p>
                </div>
        
                <table>
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>';


            $order = json_decode($_COOKIE["cart"], TRUE) ?? "";
            $body2 = "";

            foreach ($order as $key => $value){
                $item = "<tr>" . "<td>" . $value["name"] . "</td>"
                        . "<td>" . $value["quantity"] . "</td>" .
                        "<td>" . $value["price"] . "</td>" .
                        "<td>" . $value["total"] . "</td>" .
                        "</tr>";

                $body2 .= $item;
            }

            $totalPrice = 0;

            foreach ($order as $key => $value){
                $totalPrice += $value["total"];
            }


            $body3 = "</tbody></table>" . "<p class='total'>Tổng tiền: " . $totalPrice . "</p>" .
                     "</div>
        </body>
        </html>";

            $mail->Body = $body0 . $body1 . $body2 . $body3;

            $mail->isHTML(TRUE);
            $mail->send();


        }catch (Exception $e){
            $error = "Send Mail Fail When " . date("Ymd_His") . " with messageError: " . $e->getMessage() . PHP_EOL;
            file_put_contents("Logs/delivery.log", $error, FILE_APPEND);
        }
    }
}