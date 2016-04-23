<h2>Listing <span class='muted'>Keywords</span></h2>
<br>
<?php if ($keywords): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Keyword</th>
			<th>Desctiption</th>
			<th>Deleted at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($keywords as $item): ?>		<tr>

			<td><?php echo $item->keyword; ?></td>
			<td><?php echo $item->desctiption; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('keyword/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('keyword/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('keyword/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Keywords.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('keyword/create', 'Add new Keyword', array('class' => 'btn btn-success')); ?>

</p>
