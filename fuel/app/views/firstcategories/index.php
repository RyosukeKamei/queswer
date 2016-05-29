<h2>Listing <span class='muted'>Firstcategories</span></h2>
<br>
<?php if ($firstcategories): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Secondcategory id</th>
			<th>First category name</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($firstcategories as $item): ?>		<tr>

			<td><?php echo $item->secondcategory_id; ?></td>
			<td><?php echo $item->first_category_name; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('firstcategories/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('firstcategories/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('firstcategories/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Firstcategories.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('firstcategories/create', 'Add new Firstcategory', array('class' => 'btn btn-success')); ?>

</p>
