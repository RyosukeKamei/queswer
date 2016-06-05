<h2>Listing <span class='muted'>Keywordcategories</span></h2>
<br>
<?php if ($keywordcategories): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Firstcategory id</th>
			<th>Keyword id</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($keywordcategories as $item): ?>		<tr>

			<td><?php echo $item->firstcategory_id; ?></td>
			<td><?php echo $item->keyword_id; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('keywordcategories/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('keywordcategories/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('keywordcategories/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Keywordcategories.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('keywordcategories/create', 'Add new Keywordcategory', array('class' => 'btn btn-success')); ?>

</p>
