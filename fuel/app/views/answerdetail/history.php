
<?php if ($answerdetails): ?>
<?php foreach ($answerdetails as $answer_id => $answerdetail): ?>
	<?php 
		echo 
			$answers[$answer_id]['round_name'].'&nbsp;'.
			$answers[$answer_id]['examination_name'].'&nbsp;'.
			$answers[$answer_id]['frequency'].'回目'.'&nbsp;';
	?>
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
			<tr>
				<td><?php echo $question['question_number']; ?></td>
				<td><?php echo $question['first_category_name']; ?></td>
				<td><?php echo $question['second_category_name']; ?></td>
				<td><?php echo $question['third_category_name']; ?></td>
				<td
					<?php 
						if((int)$question['answer'] === (int)$question['choice_num'])
						{
							echo ' class="success" ';
							$correct_count++;
						}
					?>
				>
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
	<p>正解数 <?php echo $correct_count ?> / 80</p>
<?php endforeach; ?>


<?php else: ?>
<p>No Answerdetails.</p>

<?php endif; ?>
