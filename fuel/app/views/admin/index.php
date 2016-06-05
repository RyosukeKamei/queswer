<h2>管理者一覧</span></h2>
<br>

<p><?php echo Html::anchor('admin/create', '新規追加', array('class' => 'btn btn-success')); ?></p>

<?php if ($admins): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>ユーザー名</th>
			<th>試験ID</th>
			<th>削除日</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
    <?php foreach ($admins as $item): ?>
		<tr>
			<td><?php echo $item->id; ?></td>
			<td><?php echo $item->username; ?></td>
			<td><?php echo $item->examination_id; ?></td>
			<td>
			    <?php if (!is_null($item->deleted_at)): ?>
			        <?php echo date("Y/m/d H:i:s", $item->deleted_at); ?>
			    <?php endif; ?>
			</td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
					    <?php if (is_null($item->deleted_at)): ?>
						<?php //echo Html::anchor('admin/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>
						<?php echo Html::anchor('admin/edit/'.$item->id
								, '<i class="icon-wrench"></i> 編集'
								, array('class' => 'btn btn-default btn-sm')); ?>
						<?php echo Html::anchor('admin/delete/'.$item->id
								, '<i class="icon-trash icon-white"></i> 削除'
								, array('class' => 'btn btn-sm btn-danger'
								, 'onclick' => "return confirm('" . $item->username . "を削除します。よろしいですか?')")); ?>
					    <?php endif; ?>
					</div>
				</div>
			</td>
		</tr>
    <?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>管理者情報がありません。</p>

<?php endif; ?>
