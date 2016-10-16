<?php if ($answerdetails): ?>
<?php 
	$answerdetails_count = 0;
	foreach ($answerdetails as $answerdetail_by_answer): 
?>
<p>試験 
	<?php 
		echo
			$answerdetail_by_answer[$answerdetails_count]['round_name'].
			$answerdetail_by_answer[$answerdetails_count]['examination_name'].'&nbsp;'.
			$answerdetail_by_answer[$answerdetails_count]['frequency'].'回目';
		
		$answerdetails_count++;
	?>
</p>
<table class="table table-striped">
	<thead>
		<tr>
			<th>大項目</th>
			<th>中項目</th>
			<!-- <th>小項目</th> -->
			<th>問題番号</th>
			<th>解答</th>
			<th>答え</th>
			<th>正解</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($answerdetail_by_answer as $answerdetail): ?>
		<tr>
			<td><?php echo $answerdetail['third_category_name']; ?></td>
			<td><?php echo $answerdetail['second_category_name']; ?></td>
			<!-- <td><?php echo $answerdetail['first_category_name']; ?></td> -->
			<td><?php echo $answerdetail['question_number']; ?></td>
			<td>
				<?php 
					if((int)$answerdetail['answer'] === 1) {
						echo('ア');
					} elseif((int)$answerdetail['answer'] === 2) {
						echo('イ');
					} elseif((int)$answerdetail['answer'] === 3) {
						echo('ウ');
					} elseif((int)$answerdetail['answer'] === 4) {
						echo('エ');
					} 
				?>
			</td>
			<td>
				<?php 
					if((int)$answerdetail['choice_num'] === 1) {
						echo('ア');
					} elseif((int)$answerdetail['choice_num'] === 2) {
						echo('イ');
					} elseif((int)$answerdetail['choice_num'] === 3) {
						echo('ウ');
					} elseif((int)$answerdetail['choice_num'] === 4) {
						echo('エ');
					} 
				?>
			</td>
			<td>
				<?php 
					if((int)$answerdetail['answer'] === (int)$answerdetail['choice_num']) {
						echo '○';
					}
				?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
<?php endforeach; ?>

<?php else: ?>
<p>No Answerdetails.</p>

<?php endif; ?>