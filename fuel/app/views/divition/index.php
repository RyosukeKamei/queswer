<h2>Listing <span class='muted'>Divitions</span></h2>
<br>
<?php if ($divitions): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Divition name</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($divitions as $item): ?>		<tr>

			<td><?php echo $item->divition_name; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('divition/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('divition/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('divition/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Divitions.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('divition/create', 'Add new Divition', array('class' => 'btn btn-success')); ?>

</p>
