<div class="page-wrapper">
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h4 style="text-align: center">Chi tiết người dùng: <?= htmlspecialchars($result['username']) ?></h4>
            </div>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show text-center">
                    <?= $_SESSION['success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            <div class="card-body">
                <div class="row">
                    <!-- Ảnh đại diện -->
                    <div class="col-md-4 text-center">
                        <?php if (!empty($result['avatar']) && file_exists('Uploads/Avatars/' . $result['avatar'])): ?>
                            <img src="Uploads/Avatars/<?= htmlspecialchars($result['avatar']) ?>" width="200" class="img-thumbnail">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/200?text=No+Image" class="img-thumbnail">
                        <?php endif; ?>
                    </div>

                    <!-- Thông tin chi tiết -->
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <td><?= $result['id'] ?></td>
                            </tr>
                            <tr>
                                <th>Tên đăng nhập</th>
                                <td><?= htmlspecialchars($result['username']) ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= htmlspecialchars($result['email']) ?></td>
                            </tr>
                            <tr>
                                <th>Số điện thoại</th>
                                <td><?= htmlspecialchars($result['phone']) ?></td>
                            </tr>
                            <tr>
                                <th>Ngày sinh</th>
                                <td><?= htmlspecialchars($result['birth']) ?></td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td>
                                <span class="badge <?= $result['status'] === 'active' ? 'bg-success' : 'bg-danger' ?>">
                                    <?= ucfirst($result['status']) ?>
                                </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Vai trò</th>
                                <td>
                                <span class="badge <?= $result['role'] === 'admin' ? 'bg-primary' : 'bg-secondary' ?>">
                                    <?= ucfirst($result['role']) ?>
                                </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Mã khôi phục</th>
                                <td><?= htmlspecialchars($result['reset_token']) ?: '<i>Không có</i>' ?></td>
                            </tr>
                            <tr>
                                <th>Hạn mã khôi phục</th>
                                <td><?= htmlspecialchars($result['reset_token_expiry']) ?: '<i>Không có</i>' ?></td>
                            </tr>
                            <tr>
                                <th>Ngày tạo</th>
                                <td><?= $result['created_at'] ?></td>
                            </tr>
                            <tr>
                                <th>Ngày cập nhật</th>
                                <td><?= $result['updated_at'] ?></td>
                            </tr>
                        </table>
                        <a href="?page=user" class="btn btn-secondary">Quay lại danh sách</a>
                        <a href="?page=user&action=edit&id=<?= $result['id'] ?>"
                        class="btn btn-outline-warning">Sửa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


