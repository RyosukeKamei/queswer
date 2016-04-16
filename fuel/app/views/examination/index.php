<h2>Listing <span class='muted'>Examinations</span></h2>
<br>
<?php if ($examinations): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Examination name</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($examinations as $item): ?>		<tr>

			<td><?php echo $item->examination_name; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('examination/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('examination/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('examination/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Examinations.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('examination/create', 'Add new Examination', array('class' => 'btn btn-success')); ?>

</p>
