<?php foreach ($result as $pro):
    ?>
	<tr>
		<td><?= $pro['id'] ?></td>
		<td><?= $pro['category_name'] ?></td>
		<td><?= $pro['name'] ?></td>
		<td><?= number_format($pro['price']) . "đ" ?></td>
		<td><?= $pro['stock'] ?></td>
		<td><img src="Uploads/Products/<?= $pro['image'] ?>" alt="" width="50" height="50">
		</td>

		<td><?php if ($pro['status'] == 'available'):
                ?>
				<span class="badge bg-success">Còn hàng</span>
            <?php
			elseif ($pro['status'] == 'out_of_stock'):
                ?>
				<span class="badge bg-warning">Hết hàng</span>
            <?php else: ?>
				<span class="badge bg-danger">Ngừng hoạt động</span>
            <?php endif; ?>
		</td>
		<td>
			<a href="?page=product&action=edit&id=<?= $pro['id'] ?>" class="btn btn-outline-warning">Sửa</a>
			<form action="?page=product&action=delete&id=<?= $pro['id'] ?>" method="post" onsubmit="return confirm('Bạn có chắc là muốn xóa')" style="display: inline-block;">
				<button type="submit" class="btn btn-outline-danger">Xóa</button>
			</form>
		</td>
	</tr>
<?php endforeach;
?>