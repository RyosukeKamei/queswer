<h2>Listing <span class='muted'>Cards</span></h2>
<br>
<?php if ($cards): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Card name</th>
			<th>Point distribution</th>
			<th>Topcategory id</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($cards as $item): ?>		<tr>

			<td><?php echo $item->card_name; ?></td>
			<td><?php echo $item->point_distribution; ?></td>
			<td><?php echo $item->topcategory_id; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('cards/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('cards/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('cards/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Cards.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('cards/create', 'Add new Card', array('class' => 'btn btn-success')); ?>

</p>
