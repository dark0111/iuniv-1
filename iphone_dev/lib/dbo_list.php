<?
	//SELECT a.wr_id, a.ca_name, a.wr_subject, a.wr_content, a.wr_hit, a.wr_good, a.wr_nogood, a.wr_2, a.wr_4, a.wr_5, a.wr_7, a.wr_8, a.wr_9, a.wr_10, b.bf_file
$hit_food_sql = " SELECT a.wr_id, a.ca_name, a.wr_subject, a.wr_content, a.wr_hit, a.wr_good, a.wr_nogood, a.wr_2, a.wr_4, a.wr_5, a.wr_7, a.wr_8, a.wr_9, a.wr_10, b.bf_file
					FROM g4_write_restaurant AS a, g4_board_file AS b
					WHERE a.wr_is_comment = '0' 
					AND a.wr_2 NOT LIKE '%배달불가%'
					AND a.wr_id = b.wr_id
					AND b.bf_no =0
					AND b.bo_table = 'restaurant'
					ORDER BY a.wr_hit DESC 
					LIMIT 0 , 50  ";

$ds_hit_food = mysql_Query($hit_food_sql, $connection) or die('hit_food_sql error');
$temp_hit_food = "";
	for ($i=0; $row = mysql_fetch_array($ds_hit_food); $i++) {  		
		if($i>0)
		$temp_hit_food .="<hr>";
		$temp_hit_food .='<li class="food_list"><table cellpadding=0 cellspacing=5 border=0 width=100%><tr><td width=80><a href="./lib/food_sub2.php?r_cd='.$row[wr_id].'"><img src="../'.$img_path_restaurant.$row[bf_file].'"></a></td><td width="*"> <a href="./lib/food_sub2.php?r_cd='.$row[wr_id].'">'.cut_str($row[wr_subject],20,'..').'<br>'.trim($row[wr_4]).'</a></td><td align=center width=60 background="./img/telephoneButton.png" style="background-repeat:no-repeat;"><a href="tel:'.trim($row[wr_4]).'" target="_blank"><br><br><br>전화걸기</a></td></tr></table><input type="hidden" name="h_cd" value="444"></li>';						
		
	}
	

?>