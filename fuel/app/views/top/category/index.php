<h2>Listing <span class='muted'>Top_categories</span></h2>
<br>
<?php if ($top_categories): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Top category name</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($top_categories as $item): ?>		<tr>

			<td><?php echo $item->top_category_name; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('top/category/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('top/category/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('top/category/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Top_categories.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('top/category/create', 'Add new Top category', array('class' => 'btn btn-success')); ?>

</p>
