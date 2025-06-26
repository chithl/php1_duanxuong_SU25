<!-- Profile Section Begin -->
<section class="profile-section">
	<div class="container">
		<div class="profile-container">
			<!-- Profile Header -->
			<div class="profile-header">
				<div class="avatar-placeholder">
					<img src="Uploads/Avatars/<?= $user['avatar'] ?>" alt="Avatar" class="profile-avatar"
                         style="margin-top: 20px; height: 111px;"/>
				</div>
                <h2 class="profile-name"><?= $user['username'] ?></h2>
			</div>                <!-- Profile Content -->
			<div class="profile-content">
				<!-- Profile Info Section -->
				<div class="profile-info-section">
					<div class="row">
						<div class="col-md-6">
							<div class="info-group">
								<label class="info-label">ID tài khoản</label>
                                <span class="info-value readonly"><?= $user['id'] ?></span>
							</div>

							<div class="info-group">
								<label class="info-label">Email</label>
                                <span class="info-value"><?= $user['email'] ?></span>
							</div>

							<div class="info-group">
								<label class="info-label">Số điện thoại</label>
                                <span class="info-value"><?= $user['phone'] ?></span>
							</div>
						</div>

						<div class="col-md-6">
							<div class="info-group">
								<label class="info-label">Ngày sinh</label>
                                <span class="info-value"><?= $user['birth'] ?></span>
							</div>

							<div class="info-group">
								<label class="info-label">Vai trò</label>
                                <span class="info-value readonly">
                                    <?php if ($user['role'] === 'admin'): ?>
                                        Quản trị viên
                                    <?php elseif ($user['role'] === 'customer'): ?>
                                        Khách hàng
                                    <?php else: ?>
                                        Không xác định
                                    <?php endif; ?>
                                </span>
							</div>

							<div class="info-group">
								<label class="info-label">Ngày tạo tài khoản</label>
                                <span class="info-value readonly"><?= $user['created_at'] ?></span>
							</div>

                        </div>
					</div>
					<div class="security-info">
						<h6><i class="fa fa-shield-alt me-2"></i>Bảo mật tài khoản</h6>
						<p>Tài khoản của bạn được bảo vệ bằng mật khẩu mạnh. Để đảm bảo an toàn, hãy thường xuyên cập nhật mật khẩu và không chia sẻ thông tin đăng nhập với người khác.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- Profile Section End -->