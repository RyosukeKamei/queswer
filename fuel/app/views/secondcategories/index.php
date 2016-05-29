<h2>Listing <span class='muted'>Secondcategories</span></h2>
<br>
<?php if ($secondcategories): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Thirdcategory id</th>
			<th>Second category name</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($secondcategories as $item): ?>		<tr>

			<td><?php echo $item->thirdcategory_id; ?></td>
			<td><?php echo $item->second_category_name; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('secondcategories/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('secondcategories/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('secondcategories/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Secondcategories.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('secondcategories/create', 'Add new Secondcategory', array('class' => 'btn btn-success')); ?>

</p>
