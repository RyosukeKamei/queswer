/*
 * キーワードと小項目・中項目・大項目名を取得
 */
SELECT 
      `keywords`      .`keyword_id`
    , `keywords`      .`keyword`
    , `keywords`      .`description`
    , `1st_categories`.`1st_category_name`
    , `2nd_categories`.`2nd_category_name`
    , `3rd_categories`.`3rd_category_name`
FROM `keywords` 
LEFT JOIN `keyword_categories` ON `keywords`      .`keyword_id`      = `keyword_categories`.`keyword_id`
LEFT JOIN `1st_categories`     ON `1st_categories`.`1st_category_id` = `keyword_categories`.`1st_category_id` 
LEFT JOIN `2nd_categories`     ON `2nd_categories`.`2nd_category_id` = `1st_categories`    .`2nd_category_id`
LEFT JOIN `3rd_categories`     ON `3rd_categories`.`3rd_category_id` = `2nd_categories`    .`3rd_category_id`
ORDER BY `1st_categories`.`1st_category_id`