/*
 * 問題の傾向を集計
 * 小項目 firstcategories
 * 中項目 secondcategories
 * 大項目 thirdcategories
 * カテゴリ topcategories
 * 問題種別 divitions
 */
SELECT 
      `divitions`.`id`                   # 可変
    , `divitions`.`divition_name`        # 可変
    , COUNT(`questions`.`id`) AS `count`
FROM `questions` 
INNER JOIN `divitions`        ON `questions`       .`divition_id`       = `divitions`       .`id` 
INNER JOIN `firstcategories`  ON `questions`       .`firstcategory_id`  = `firstcategories` .`id` 
INNER JOIN `secondcategories` ON `firstcategories` .`secondcategory_id` = `secondcategories`.`id` 
INNER JOIN `thirdcategories`  ON `secondcategories`.`thirdcategory_id`  = `thirdcategories` .`id` 
INNER JOIN `topcategories`    ON `thirdcategories` .`topcategory_id`    = `topcategories`   .`id` 
GROUP BY 
      `divitions`.`id` # 可変