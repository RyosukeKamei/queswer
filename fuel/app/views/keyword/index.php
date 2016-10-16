<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('キーワード', 'keyword', array('class'=>'control-label')); ?>
			<?php echo Form::input('keyword', Input::post('keyword', isset($keyword) ? $keyword->keyword : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'監査')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', '検索', array('class' => 'btn btn-primary')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>
<br>
<?php if ($keywords): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>キーワード</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($keywords as $item): ?>		<tr>

			<td><?php echo $item->id; ?></td>
			<td><?php echo $item->keyword; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('keyword/view/'.$item->id, '<i class="icon-eye-open"></i> 詳細', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('keyword/edit/'.$item->id, '<i class="icon-wrench"></i> 編集', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('keyword/delete/'.$item->id, '<i class="icon-trash icon-white"></i> 削除', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
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
