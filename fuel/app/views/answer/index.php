<h2>Listing <span class='muted'>Answers</span></h2>
<br>
<?php if ($answers): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Round id</th>
			<th>User id</th>
			<th>Finish flag</th>
			<th>Frequency</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($answers as $item): ?>		<tr>

			<td><?php echo $item->round_id; ?></td>
			<td><?php echo $item->user_id; ?></td>
			<td><?php echo $item->finish_flag; ?></td>
			<td><?php echo $item->frequency; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('answer/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('answer/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('answer/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Answers.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('answer/create', 'Add new Answer', array('class' => 'btn btn-success')); ?>

</p>
