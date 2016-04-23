<h2>Listing <span class='muted'>Keyword_categories</span></h2>
<br>
<?php if ($keyword_categories): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>First category id</th>
			<th>Keyword id</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($keyword_categories as $item): ?>		<tr>

			<td><?php echo $item->first_category_id; ?></td>
			<td><?php echo $item->keyword_id; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('keyword/category/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('keyword/category/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('keyword/category/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Keyword_categories.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('keyword/category/create', 'Add new Keyword category', array('class' => 'btn btn-success')); ?>

</p>
