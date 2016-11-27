<h3>
	第
	<?php echo $event_infos[0]['id']; ?>
	回目イベント
	&nbsp;
	<?php echo $event_infos[0]['round_name'].$event_infos[0]['examination_name']; ?>
</h3>
<?php if ($event_rankings): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>順位</th>
			<th>ユーザ名</th>
			<th>解答数</th>
			<th>解答率</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($event_rankings as $key => $event_ranking): ?>
		<tr>
			<td><?php echo (int)$key + 1; ?></td>
			<td><?php echo $event_ranking['username']; ?></td>
			<td><?php echo $event_ranking['correct_count']; ?></td>
			<td><?php echo round($event_ranking['correct_count'] / (int)$event_ranking['question_count'] * 100 , 0); ?>%</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>イベントの結果がありません。</p>
<?php endif; ?>