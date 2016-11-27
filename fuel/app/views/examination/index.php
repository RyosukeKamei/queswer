<p>
	<?php 
		/*
		 * ユーザページへの遷移
		 */
		echo Html::anchor('gotcards/usergot/', '<i class="icon-eye-open"></i> ゲットしたカード', array('class' => 'btn btn-primary btn-sm')); 
	?>
</p>
<p>
	<?php 
		/*
		 * 最新のイベントランキングページへの遷移
		 */
		echo Html::anchor('events/ranking/'.$event->id, '<i class="icon-eye-open"></i> 最新イベントランキング', array('class' => 'btn btn-primary btn-sm')); 
	?>
</p>
<p>
	<?php 
		/*
		 * 最新のイベント開始する
		 * /question/solve/{$round_id}/0/1
		 * 第1引数は$round_id 15 平成28年度春
		 * 第2引数は$answer_idで、0だと新規作成をする
		 * 第3引数は$event_idで、イベントIDを渡すと、解答(answer)にevent_idが入る
		 */
		echo Html::anchor('question/solve/'.$start_event->round_id.'/0/'.$start_event->id, '<i class="icon-eye-open"></i> イベントにチャレンジ！', array('class' => 'btn btn-primary btn-sm')); 
	?>
</p>
<?php if ($examinations): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>資格試験名称</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($examinations as $examination): ?>
		<tr>
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