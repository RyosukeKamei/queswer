<h2>Listing <span class='muted'>Topcategories</span></h2>
<br>
<?php if ($topcategories): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Organization id</th>
			<th>Top category name</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($topcategories as $item): ?>		<tr>

			<td><?php echo $item->organization_id; ?></td>
			<td><?php echo $item->top_category_name; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('topcategories/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('topcategories/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('topcategories/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Topcategories.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('topcategories/create', 'Add new Topcategory', array('class' => 'btn btn-success')); ?>

</p>
