<p>
	<?php echo $keyword->description; ?>
</p>
<p>
    <!-- 広告 -->
</p>
<h3>
    合わせて覚えてしまおう！同じ小項目「
    <?php 
    echo $keyword_datas->firstcategory->first_category_name
    ?>
    」出てくるキーワード
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
// 	               .' '
//                    .$keywordcategory->firstcategory->first_category_name
	               .'" title="'
	               .$keywordcategory->keyword->keyword
	               .'">'
	               .$keywordcategory->keyword->keyword
// 	               .' '
//                    .$keywordcategory->firstcategory->first_category_name
	               .'</a>'
	               .'</li>';
    	   }
    	   echo '</ul>';
	   }
	?>
<p>応用情報技術者試験・基本情報技術者試験・セキュリティマネジメント試験・ITパスポート試験に出題されるキーワードを動画で解説！</p>
