SELECT 
    questions.`question_number` /* 問題 */
    , questions.`quesiton_title` /* 問題タイトル */
    , questions.`question_body` /* 問題 */
    , answers.`answer` /* 選択肢 */
    , answers.`correct_flag` /* 正解 */
    , divitions.`divition_name` /* 問題種別 */
    , rounds.`round_name` /* 試験実施 */
    , choice_types.`choice_name` /* 選択肢の記号 */
    , 1st_categories.`1st_category_name`
    , 2nd_categories.`2nd_category_name`
    , 3rd_categories.`3rd_category_name`
    , top_categories.`top_category_name`
    , examinations.`examination_name`
    
FROM questions 
INNER JOIN answers ON questions.question_id = answers.question_id 
INNER JOIN choice_types ON answers.`choice_id` = choice_types.`choice_id` AND choice_types.`choice_group_id` = 1
INNER JOIN divitions ON questions.`divition_id` = divitions.`divition_id`
INNER JOIN rounds ON questions.`round_id` = rounds.`id`
INNER JOIN examinations ON rounds.`examination_id` = examinations.`id`
INNER JOIN 1st_categories ON questions.1st_category_id = 1st_categories.`1st_category_id`
INNER JOIN 2nd_categories ON 1st_categories.2nd_category_id = 2nd_categories.`2nd_category_id`
INNER JOIN 3rd_categories ON 2nd_categories.3rd_category_id = 3rd_categories.`3rd_category_id`
INNER JOIN top_categories ON 3rd_categories.top_category_id = top_categories.`top_category_id`

WHERE questions.question_id = 2