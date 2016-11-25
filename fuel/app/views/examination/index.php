<br>
<?php if ($examinations): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>資格試験名称</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($examinations as $examination): ?>		<tr>

			<td><?php echo $examination->examination_name; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('round/list/'.$examination->id, '<i class="icon-eye-open"></i> 過去問にチャレンジ！', array('class' => 'btn btn-primary btn-sm')); ?>
						<?php echo Html::anchor('round/pastlist/'.$examination->id, '<i class="icon-wrench"></i> 過去問解説', array('class' => 'btn btn-info btn-sm')); ?>
					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>[FATAL ERROR] 試験がありません。</p>

<?php endif; ?>