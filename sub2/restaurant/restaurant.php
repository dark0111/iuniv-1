<link href="../../css/boxlist.css" type="text/css" rel="stylesheet" />
<?
$tool_restaurant_sql = " SELECT a.id, a.cata_cd, a.restaurant_id, a.order_by, b.ca_name, b.wr_subject, wr_content, wr_hit, wr_good, b.wr_4, b.wr_8, wr_10, c.bf_file
							FROM tools_restaurant AS a, g4_write_restaurant AS b, 
								(SELECT bf_file, wr_id
									FROM `g4_board_file` 
									WHERE bo_table = 'restaurant'
									AND bf_no =0) as c
							WHERE a.cata_cd = '$order'
							AND b.wr_is_comment =0
							AND c.wr_id = a.restaurant_id
							AND a.restaurant_id = b.wr_id ";
//echo $tool_restaurant_sql;
$ds_tool_restaurant_sql = mysql_Query($tool_restaurant_sql, $connection) or die('tool_restaurant_sql error');

?>
<ul class="siteList"> 
<?
for ($i=1; $row = mysql_fetch_array($ds_tool_restaurant_sql); $i++) {  
	if(($i%4)==0){
echo'<li class="normal last">';
	}else{
echo'<li class="normal">';
	}
?>
		<div class="rating2"><p><strong><a href="<?=$IU[board]?>/bbs/board.php?bo_table=restaurant&wr_id=<?=$row[restaurant_id]?>"><?=$row[wr_subject]?></a></strong></p>
		</div>
		<a href="<?=$IU[board]?>/bbs/board.php?bo_table=restaurant&wr_id=<?=$row[restaurant_id]?>">
		<img src="<?=$IU[restaurant_thum2].$row[bf_file]?>" width="180" height="142" alt=" h MAG, Hoboken NJ's Premiere Lifestyle Magazine" /></a>
		<div class="rating">
			<div class="ratingblock">
				<div id="unit_long3214">
					<ul id="unit_ul3214" class="unit-rating" style="width: 150px;">
						<li  style="width: 92.1px;">Currently 3.07/5</li>			
					</ul>
					<p>Rating: <strong>3.07</strong>/5 (961 votes)</p>
				</div>
			</div>
		</div>
	</li>
<?
}
?>
</ul>