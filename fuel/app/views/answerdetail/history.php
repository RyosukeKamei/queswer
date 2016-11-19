
<?php if ($answers && $answerdetails): ?>
<?php foreach ($answerdetails as $answer_id => $answerdetail): ?>
	<h3 class="text-primary">
	<?php 
		echo $answers[$answer_id]['frequency'].'回目'.'&nbsp;'.'正解数 80問中 '.$summary[$answer_id]['all'].'問'; 
		if((int)$summary[$answer_id]['all'] >= 60) 
		{
	?>
			<span class="text-primary">合格</span>
	<?php
		} 
		else
		{
	?>
			<span class="text-danger">不合格</span>
	<?php
		}
	?>
	<?php 
		if((int)$summary[$answer_id]['all'] >= 70) 
		{
	?>
			<span class="text-success">安全圏！</span>
	<?php
		} 
		elseif((int)$summary[$answer_id]['all'] >= 60 && (int)$summary[$answer_id]['all'] < 70)
		{
	?>
			<span class="text-info">合格ぎりぎり…</span>
	<?php
		} 
		elseif((int)$summary[$answer_id]['all'] >= 50 && (int)$summary[$answer_id]['all'] < 60)
		{
	?>
			<span class="text-warning">もう少しで合格！！！</span>
	<?php
		}
		else
		{
	?>
			<span class="text-danger">がんばりましょう…</span>
	<?php
		}
	?>
	</h3>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>中項目ごとの出題数と正解数</th>
				<th>得意・並み・不得意</th>
				<th>正解率</th>
				<th>正解数</th>
				<th>出題数</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$correct_count = 0;
			foreach ($summary[$answer_id]['secondcategory'] as $second_categories => $second_category): 
		?>
			<tr>
				<td><?php echo $second_category['second_category_name']; ?></td>
				<td>
					<?php 
						/*
						 * 正解率を算出
						 */
						$correct_rate = (int)((int)$second_category['second_category_correct_count']/(int)$second_category['second_category_count']*100);
						/*
						 * 正解率により表示を切り替え
						 */
						
						if((int)$correct_rate >= 70)
						{
					?>
							<span class="text-success">得意</span>
					<?php 
						}
						elseif((int)$correct_rate >= 40 && (int)$correct_rate < 70)
						{
					?>
							並み
					<?php 
						}
						elseif((int)$correct_rate > 0 && (int)$correct_rate < 40)
						{
					?>
							<span class="text-warning">不得意</span>
					<?php 
						}
						else
						{
							
						} 
					?>
				</td>
				<td>
					<?php 
						echo $correct_rate.'&nbsp;%' ;
					?>
				</td>
				<td><?php echo $second_category['second_category_correct_count']; ?></td>
				<td><?php echo $second_category['second_category_count']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<h4>解答の詳細 <span class="text-primary">緑の背景色が正解している問題です！</span></h4>
	<p class="text-info">問題番号をクリックすると、解説ページに遷移します！</p>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>問題番号</th>
				<th>小項目</th>
				<th>中項目</th>
				<th>大項目</th>
				<th>解答</th>
				<th>正解</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$correct_count = 0;
			foreach ($answerdetail as $question): 
		?>
			<tr
				<?php 
					if((int)$question['answer'] === (int)$question['choice_num'])
					{
						echo ' class="success" ';
					}
				?>		
			>
				<td>
					<?php 
						echo Html::anchor(
								  "question/commentary/".$question['question_number']."/".$question['round_id']
								, $question['question_number']
								, array(
										  "target" => "_blank"
										, "class"  => "cell_link"
								  )
							);
					?>
				</td>
				<td><?php echo $question['first_category_name']; ?></td>
				<td><?php echo $question['second_category_name']; ?></td>
				<td><?php echo $question['third_category_name']; ?></td>
				<td>
					<?php 
						if((int)$question['answer'] === 1) 
						{
							echo 'ア';
						}
						elseif((int)$question['answer'] === 2)
						{
							echo 'イ';
						}
						elseif((int)$question['answer'] === 3)
						{
							echo 'ウ';
						}
						elseif((int)$question['answer'] === 4)
						{
							echo 'エ';
						}
					?>
				</td>
				<td>
					<?php 
						if((int)$question['choice_num'] === 1) 
						{
							echo 'ア';
						}
						elseif((int)$question['choice_num'] === 2)
						{
							echo 'イ';
						}
						elseif((int)$question['choice_num'] === 3)
						{
							echo 'ウ';
						}
						elseif((int)$question['choice_num'] === 4)
						{
							echo 'エ';
						}
					?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endforeach; ?>


<?php else: ?>
<h3>問題の履歴がありません。</h3>
<h3>
	<?php 
		echo Html::anchor(
		  	  "question/solve/".$rounds[0]['id']
			, $rounds[0]['round_name'].$rounds[0]['examination_name']."の問題を開始する"
		);
	?>	
</h3>

<?php endif; ?>
