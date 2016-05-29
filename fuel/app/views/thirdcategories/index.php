<h2>Listing <span class='muted'>Thirdcategories</span></h2>
<br>
<?php if ($thirdcategories): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Topcategory id</th>
			<th>Third category name</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($thirdcategories as $item): ?>		<tr>

			<td><?php echo $item->topcategory_id; ?></td>
			<td><?php echo $item->third_category_name; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('thirdcategories/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('thirdcategories/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('thirdcategories/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Thirdcategories.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('thirdcategories/create', 'Add new Thirdcategory', array('class' => 'btn btn-success')); ?>

</p>
