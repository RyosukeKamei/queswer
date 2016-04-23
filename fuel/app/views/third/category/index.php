<h2>Listing <span class='muted'>Third_categories</span></h2>
<br>
<?php if ($third_categories): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Third category name</th>
			<th>Top category id</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($third_categories as $item): ?>		<tr>

			<td><?php echo $item->third_category_name; ?></td>
			<td><?php echo $item->top_category_id; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('third/category/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('third/category/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('third/category/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Third_categories.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('third/category/create', 'Add new Third category', array('class' => 'btn btn-success')); ?>

</p>
