<?php
$page = isset($_GET['page']) ? $_GET['page'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$page_number = isset($_GET['page_number']) ? $_GET['page_number'] : '1';
?>
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <?php
        if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['success'] ?? "" ?></strong>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Quản lý đơn hàng</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Thống kê</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Danh sách đơn hàng
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
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Danh sách đơn hàng</h5>
                        <div class="table-responsive">
                            <form action="" method="get" class="g-3 mb-3">
                                <input type="hidden" name="page" value="<?= $page ?>">
                                <input type="hidden" name="action" value="<?= $action ?>">
                                <div class=" col-md-2 ">
                                    <select class=" form-control" name="payment_status" onchange="this.form.submit();">
                                        <option value="">Tất cả trạng thái</option>
                                        <option value="pending" <?= (isset($_GET['payment_status']) && $_GET['payment_status'] == 'pending') ? 'selected' : '' ?>>
                                            Đang chờ xác nhận
                                        </option>
                                        <option value="completed" <?= (isset($_GET['payment_status']) && $_GET['payment_status'] == 'completed') ? 'selected' : '' ?>>
                                            Đã thanh toán
                                        </option>
                                        <option value="canceled" <?= (isset($_GET['payment_status']) && $_GET['payment_status'] == 'canceled') ? 'selected' : '' ?>>
                                            Đã hủy
                                        </option>
                                        <option value="expired" <?= (isset($_GET['payment_status']) && $_GET['payment_status'] == 'expired') ? 'selected' : '' ?>>
                                            Đã quá hạn
                                        </option>
                                    </select>
                                </div>
                            </form>
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr class="text-center">
                                    <th>Mã ĐH</th>
                                    <th>Mã KH</th>
                                    <th>SĐT</th>
                                    <th>Địa chỉ</th>
                                    <th>Tổng tiền</th>
                                    <th>Hình thức TT</th>
                                    <th>Trạng thái TT</th>
                                    <th>Trạng thái GH</th>
                                    <th>Ngày GH dự kiến</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                                <?php foreach ($result as $od):
                                    ?>
                                    <tr>
                                        <td><?= $od['id'] ?></td>
                                        <td><?= $od['user_id'] ?></td>
                                        <td><?= $od['phone'] ?></td>
                                        <td><?= $od['shipping_address'] ?></td>
                                        <td><?= number_format($od['total_price']) . "đ" ?></td>
                                        <td><?= $od['payment_method'] ?></td>
                                        <td><?= $od['payment_status'] ?></td>
                                        <td><?= $od['shipping_status'] ?></td>
                                        <td><?= !empty($od['shipping_date_estimated']) ? date('d/m/Y', strtotime($od['shipping_date_estimated'])) : '<i>Không có</i>' ?></td>

                                        <td>
                                            <a href="?page=order&action=detail&id=<?= $od['id'] ?>"
                                               class="btn btn-outline-warning">Chi tiết</a>
                                            <form action="?page=order&action=delete&id=<?= $od['id'] ?>"
                                                  method="post" onsubmit="return confirm('Bạn có chắc là muốn xóa')"
                                                  style="display: inline-block;">
                                                <button type="submit" class="btn btn-outline-danger">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach;
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
unset($_SESSION['success']);
?>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
