<h3>大項目
	<?php echo $questions->firstcategory->secondcategory->thirdcategory->third_category_name; ?>
</h3>
<h3>問題種別
	<?php echo $questions->divition->divition_name; ?>
</h3>
<h3>問題</h3>
<p><?php echo $questions->question_body; ?></p>
<ul style="list-style-type: katakana">
	<?php 
	   /*
		* 答えはchoiceが持っている
		*/
	   $answer = 0;
	   foreach($choices AS $key => $choice) {
		   if((int)$choice->correct_flag === 1)
		   {
			   $answer = $choice->choice_num;
		   }
		   echo '<li>'.$choice->choice_body.'</li>';
	   }
	?>
</ul>
<hr>
<h3>正解：
	<?php 
		if((int)$answer === 1) 
		{
			echo 'ア';
		} elseif((int)$answer === 2) 
		{
			echo 'イ';
		} elseif((int)$answer === 3) 
		{
			echo 'ウ';
		} elseif((int)$answer === 4) 
		{
			echo 'エ';
		} 
	?>
</h3>
<h3>解説</h3>
<p>
	<?php echo $questions->question_commentary; ?>
</p>
<h3>問題文に出てくるキーワード</h3>
	<?php 
		if($question_keywords) {
			foreach($question_keywords AS $key => $question_keyword) {
				echo '<h4>●'.$question_keyword['keyword'].'</h4>';
				echo $question_keyword['description'];
			}
		}
	?>
	<?php 
		if($choice_keywords) {
			foreach($choice_keywords AS $key => $choice_keyword) {
				echo '<h4>●'.$choice_keyword['keyword'].'</h4>';
				echo $choice_keyword['description'];
			}
		}
	?>
	
<p>
	<?php 
		if($questions->question_number > 1) {
			$prev_question_number = (int)$questions->question_number-1;
			echo 
			 '<a href="/question/commentary/'
			.$prev_question_number
			.'/'
			.$questions->round_id
			.'" title="'
			.$questions->round->round_name
			.' ' .$questions->round->examination->examination_name
			.' 過去問'.$prev_question_number
			.'">'
			.'前の問題 '
			.$questions->round->round_name
			.' ' .$questions->round->examination->examination_name
			.' 過去問'.$prev_question_number
			.'</a>';
		}
	?>
</p>
<p>		
	<?php 
		if($questions->question_number < 80) {
			$next_question_number = (int)$questions->question_number+1;
			echo 
			'<a href="/question/commentary/'
			.$next_question_number
			.'/'
			.$questions->round_id
			.'" title="'
			.$questions->round->round_name
			.' ' .$questions->round->examination->examination_name
			.' 過去問'
			.$next_question_number
			.'">'
			.'次の問題 '
			.$questions->round->round_name
			.' ' .$questions->round->examination->examination_name
			.' 過去問'.$next_question_number
			.'</a>';
			$next_question_number = null;
		}
	?>
	
	
</p>
<!-- 同じ小項目の過去問一覧 -->
<h3>
	同じ小項目：
	<?php echo $questions->firstcategory->first_category_name; ?>
	の過去問一覧
</h3>
	<?php 
	   if($firstcategories && is_array($firstcategories))
	   {
		   echo '<ul>';
		   foreach($firstcategories AS $key => $firstcategory) {
			   echo 
				   '<li>'
				   .'<a href="/question/commentary/'
				   .$firstcategory->question_number
				   .'/'
				   .$firstcategory->round_id
				   .'" title="'
				   .$firstcategory->round->round_name
				   .' ' .$firstcategory->round->examination->examination_name
				   .' 過去問'.$firstcategory->question_number
				   .'">'
				   .$firstcategory->round->round_name
				   .' ' .$firstcategory->round->examination->examination_name
				   .' 過去問'.$firstcategory->question_number
				   .'</a>'
				   .'</li>';
		   }
		   echo '</ul>';
	   }
	?>
<h3>
	同じ中項目
	<?php echo $questions->firstcategory->secondcategory->second_category_name; ?>
	に出てくるキーワード
</h3>
	<?php 
	   if($keywordcategories && is_array($keywordcategories))
	   {
		   echo '<ul>';
		   foreach($keywordcategories AS $key => $keywordcategory) {
			   /*
				* @todo
				* キーワード表示画面
				*/
			   echo 
				   '<li>'
				   .'<a href="/keyword/view/'
				   .$keywordcategory->keyword->id
// 				   .' '
//					.$keywordcategory->firstcategory->first_category_name
				   .'" title="'
				   .$keywordcategory->keyword->keyword
				   .'">'
				   .$keywordcategory->keyword->keyword
// 				   .' '
//					.$keywordcategory->firstcategory->first_category_name
				   .'</a>'
				   .'</li>';
		   }
		   echo '</ul>';
	   }
	?>
<h3>
	<?php 
	echo 
		$questions->round->round_name
		.' ' .$questions->round->examination->examination_name
		.'の過去問一覧';
   ?>
</h3>
<ul>
<?php 
	for($question_number = 1; $question_number <= 80; $question_number++) {
	    echo 
	    '<li>'
		.'<a href="/question/commentary/'
		.$question_number
		.'/'
		.$questions->round_id
		.'" title="'
		.$questions->round->round_name
		.' '
        .$questions->round->examination->examination_name
		.' 過去問'.$question_number
		.'">'
	    .$questions->round->round_name
	    .' ' .$questions->round->examination->examination_name
	    .'過去問'
        .$question_number
	    .'</a>'	        
	    .'</li>';
	}
?>
</ul>
