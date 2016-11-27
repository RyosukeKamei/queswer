<h2>Listing <span class='muted'>Gotcards</span></h2>
<br>
<?php if ($gotcards): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>User id</th>
			<th>Card id</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($gotcards as $item): ?>		<tr>

			<td><?php echo $item->user_id; ?></td>
			<td><?php echo $item->card_id; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('gotcards/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('gotcards/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('gotcards/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Gotcards.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('gotcards/create', 'Add new Gotcard', array('class' => 'btn btn-success')); ?>

</p>
