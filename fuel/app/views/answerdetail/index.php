<h2>Listing <span class='muted'>Answerdetails</span></h2>
<br>
<?php if ($answerdetails): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Question num</th>
			<th>Answer id</th>
			<th>Answer</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($answerdetails as $item): ?>		<tr>

			<td><?php echo $item->question_num; ?></td>
			<td><?php echo $item->answer_id; ?></td>
			<td><?php echo $item->answer; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('answerdetail/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('answerdetail/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('answerdetail/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Answerdetails.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('answerdetail/create', 'Add new Answerdetail', array('class' => 'btn btn-success')); ?>

</p>
