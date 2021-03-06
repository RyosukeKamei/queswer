<h2>Listing <span class='muted'>Beforequestions</span></h2>
<br>
<?php if ($beforequestions): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Question number</th>
			<th>Question body</th>
			<th>Question commentary</th>
			<th>First category id</th>
			<th>Divition id</th>
			<th>Round id</th>
			<th>Prefix id</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($beforequestions as $item): ?>		<tr>

			<td><?php echo $item->question_number; ?></td>
			<td><?php echo $item->question_body; ?></td>
			<td><?php echo $item->question_commentary; ?></td>
			<td><?php echo $item->first_category_id; ?></td>
			<td><?php echo $item->divition_id; ?></td>
			<td><?php echo $item->round_id; ?></td>
			<td><?php echo $item->prefix_id; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('beforequestion/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('beforequestion/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('beforequestion/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Beforequestions.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('beforequestion/create', 'Add new Beforequestion', array('class' => 'btn btn-success')); ?>

</p>
