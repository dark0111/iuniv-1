<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

	//클릭시 새창 출력 옵션을 위하야~~
	$win=explode("-",$_REQUEST[win]);

	$width=$win[1];
	$height=$win[2];
	$top=$win[3];
	$left=$win[4];
	$winn=$win[0];	
?>

<? for ($i=0; $i<count($list); $i++) { ?>
            <?
			//그림위치			// 썸네일을 불러오진 않습니다....
			$xsql = " select bf_file from g4_board_file where wr_id='{$list[$i]['wr_id']}' and bo_table='$bo_table' order by bf_no ";
			$xresult = sql_query($xsql);
				if($xresult){
					while ($xrow = mysql_fetch_array($xresult)) {
						$xdata[] = $xrow;						
					}
				
				}
				for ($x=0; $x < sizeof($xdata); $x++) { 
				
				echo "
				<albuminfo><artLocation>$g4[path]/data/file/$bo_table/{$xdata[$x]['bf_file']}</artLocation>";
				
				//그림 제목
            if ($list[$i]['is_notice'])
                echo "<artist>{$list[$i]['subject']}</artist>";
            else
                echo "<artist>{$list[$i]['subject']}</artist>";

			if ($list[$i]['comment_cnt']=="") $list[$i]['comment_cnt'] ="..";
			echo "<albumName>{$list[$i]['comment_cnt']}</albumName>";
           //글자 클릭시 새창으냐 self냐 부분
		 
			if ($winn =="yes" && $winn !=""){
							echo  "<artistLink>javascript:window.open('{$list[$i]['href']}','flash','toolbar=0,resizable=no,status=0,scrollbars=yes,copyhistory=0,width=$width,height=$height,top=$top,left=$left');void(0);</artistLink>";
							
							echo "<albumLink>javascript:window.open('{$list[$i]['comment_href']}','flash','toolbar=0,resizable=no,status=0,scrollbars=yes,copyhistory=0,width=$width,height=$height,top=$top,left=$left');void(0);</albumLink></albuminfo>";

						}else{
							echo "<artistLink>{$list[$i]['href']}</artistLink>";
							echo "<albumLink>{$list[$i]['comment_href']}</albumLink></albuminfo>";;
			
						}
				}
           
            
	} ?>

