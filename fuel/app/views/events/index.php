<?php if ($events): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>試験名</th>
			<th>対象過去問</th>
			<th>イベント開始日時</th>
			<th>イベント終了日時</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($events as $event): ?>
		<tr>
			<td><?php echo $event->examination_id; ?></td>
			<td><?php echo $event->round_id; ?></td>
			<td><?php echo $event->start_datetime; ?></td>
			<td><?php echo $event->finish_datetime; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('events/edit/'.$event->id, '<i class="icon-wrench"></i> イベント編集', array('class' => 'btn btn-default btn-sm')); ?>
					</div>
				</div>

			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>イベントがありません。</p>
<?php endif; ?>
<p>
	<?php echo Html::anchor('events/create', 'イベントを追加', array('class' => 'btn btn-success')); ?>
</p>
