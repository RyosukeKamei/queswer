<h2><span class='muted'>過去問一覧</span></h2>
<br>
<?php if ($rounds): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>試験名</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
    <?php foreach ($rounds as $item): ?>
        <tr>
            <td>
                <?php echo $item['round_name']; ?>&nbsp;
                <?php echo $item['examination_name']; ?>
            </td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<!-- 試験を開始 -->
						<?php 
						  if(!$item['answer_id']) 
						  {
						  	echo 
								Html::anchor('question/solve/'.$item['round_id'],
						    	'<i class="icon-eye-open"></i> 試験を開始', 
						    	array('class' => 'btn btn-default btn-sm'));
						  }
						  elseif($item['answer_id'])
						  {
							echo
						    	Html::anchor('question/solve/'.$item['round_id'].'/'.$item['answer_id'],
						    	'<i class="icon-wrench"></i> 試験の続き',
						    	array('class' => 'btn btn-default btn-sm'));
						  }
						?>
						<!-- 履歴 -->
						<?php 
						  echo
						      Html::anchor('answerdetail/history/'.$item['round_id'],
						      '<i class="icon-trash icon-white"></i> 試験解答の履歴',
						      array('class' => 'btn btn-sm btn-primary')); ?>
					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Rounds.</p>

<?php endif; ?>