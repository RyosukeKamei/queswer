<h2>Listing <span class='muted'>Choices</span></h2>
<br>
<?php if ($choices): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Question id</th>
			<th>Choice num</th>
			<th>Choice body</th>
			<th>Correct flag</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($choices as $item): ?>		<tr>

			<td><?php echo $item->question_id; ?></td>
			<td><?php echo $item->choice_num; ?></td>
			<td><?php echo $item->choice_body; ?></td>
			<td><?php echo $item->correct_flag; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('choice/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('choice/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('choice/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Choices.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('choice/create', 'Add new Choice', array('class' => 'btn btn-success')); ?>

</p>
