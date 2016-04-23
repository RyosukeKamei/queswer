<h2>Listing <span class='muted'>Organizations</span></h2>
<br>
<?php if ($organizations): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Organization name</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($organizations as $item): ?>		<tr>

			<td><?php echo $item->organization_name; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('organization/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('organization/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('organization/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Organizations.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('organization/create', 'Add new Organization', array('class' => 'btn btn-success')); ?>

</p>
