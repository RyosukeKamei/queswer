<h2>Listing <span class='muted'>Rounds</span></h2>
<br>
<?php if ($rounds): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Round name</th>
			<th>Examination id</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rounds as $item): ?>		<tr>

			<td><?php echo $item->round_name; ?></td>
			<td><?php echo $item->examination_id; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('round/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('round/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('round/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Rounds.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('round/create', 'Add new Round', array('class' => 'btn btn-success')); ?>

</p>
