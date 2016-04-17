<h2>Listing <span class='muted'>Admins</span></h2>
<br>
<?php if ($admins): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>User id</th>
			<th>Password</th>
			<th>Examination id</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($admins as $item): ?>		<tr>

			<td><?php echo $item->user_id; ?></td>
			<td><?php echo $item->password; ?></td>
			<td><?php echo $item->examination_id; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('admin/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('admin/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('admin/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Admins.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/create', 'Add new Admin', array('class' => 'btn btn-success')); ?>

</p>
