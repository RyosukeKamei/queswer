<h2>Listing <span class='muted'>Second_categories</span></h2>
<br>
<?php if ($second_categories): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Second category name</th>
			<th>Third category id</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($second_categories as $item): ?>		<tr>

			<td><?php echo $item->second_category_name; ?></td>
			<td><?php echo $item->third_category_id; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('second/category/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('second/category/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('second/category/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Second_categories.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('second/category/create', 'Add new Second category', array('class' => 'btn btn-success')); ?>

</p>
