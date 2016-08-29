<?

//공지사항
$notice_sql = " SELECT `wr_id`,`wr_subject`,`wr_content` FROM `g4_write_notice` WHERE wr_is_comment = '0' order by wr_id desc limit 0, 7 ";
$ds_notice_list = mysql_Query($notice_sql, $connection) or die('notice_sql error');
for ($i=0; $row = mysql_fetch_array($ds_notice_list); $i++) {  
				$st_noticeboard .="<li><a href='./board/bbs/board.php?bo_table=notice&wr_id=".$row[wr_id]."' title='".$row[wr_subject]."'>".cut_str($row[wr_subject],100,'..')."</a></li>";
}

//자유게시판
$free_sql = " SELECT `wr_id` , `wr_subject` , `wr_content` 
				FROM `g4_write_board1` 
				WHERE wr_is_comment = '0'
				ORDER BY wr_id DESC 
				LIMIT 0 , 7  ";
$ds_free_list = mysql_Query($free_sql, $connection) or die('free_sql error');
for ($i=0; $row = mysql_fetch_array($ds_free_list); $i++) { 
	$st_freeboard .="<li><a href='./board/bbs/board.php?bo_table=board1&wr_id=".$row[wr_id]."' title='".$row[wr_subject]."'>".cut_str($row[wr_subject],100,'..')."</a></li>";
}

//helpTalk
$helptalk_sql = " SELECT a.id, a.c_id, a.t_id, a.secret, a.name, a.content, a.comment_count, a.vote, a.regdate, a.regtime, b.mb_id, c.mb_sex, c.mb_1
					FROM `g4_talk` AS a, g4_talk_info AS b, g4_member AS c
					WHERE a.name = b.talk_about
					AND b.mb_id = c.mb_id
					ORDER BY id DESC 
					LIMIT 0 , 10  ";
$ds_helptalk = mysql_Query($helptalk_sql, $connection) or die('helptalk_sql error');
for ($i=0; $row = mysql_fetch_array($ds_helptalk); $i++) { 
	if(file_exists('./board/data/talk/profile_image/'.$row[mb_id])){
		$user_icon_img="./board/data/talk/profile_image/".$row[mb_id];
	}else{
		if($row[mb_sex]=="F"){//이미지 학교별 세팅
			$user_icon_img="./css/img/tools/user_female";
		}elseif($row[mb_sex]=="M"){
			$user_icon_img="./css/img/tools/user_male";
		}else{
			$user_icon_img="./css/img/tools/user_anymore";
		}
		if($row[mb_1]=="82"){
			$user_icon_img.="2";
		}
		$user_icon_img.=".png";
	}
	$st_helptalk .="<a class='boxen' href='./board/talk/mytalk.php?t_id=".$row[t_id]."&id=".$row[id]."' title='Talk!!'><img class='btn_write' src='./css/img/pencil.png' align=left style='cursor:pointer;'></a><div><div class='user_talk_box'><h4>".$row[content]."</h4><img class='user_icon' src='".$user_icon_img."' width='100' height='100'><h5>".$row[name]."</h5></div>
						<div class='user_talk_answer'><table width='300'>";
		//helpTalk_Comment
		$helptalk_comm_sql = " SELECT b.id, b.t_id, b.num, b.mb_id, b.name, b.secret, b.content, b.regdate, d.mb_sex, d.mb_1
								FROM g4_talk_comment AS b, (
								SELECT id, regdate, regtime, name
								FROM g4_talk
								ORDER BY regdate, regtime DESC 
								LIMIT 0 , 10
								) AS a, g4_talk_info AS c, g4_member AS d
								WHERE b.id=$row[id]
								AND a.id = b.id
								AND a.name = c.talk_about
								AND c.mb_id = d.mb_id
								ORDER BY b.num DESC  ";
		$ds_helptalk_comm = mysql_Query($helptalk_comm_sql, $connection) or die('ds_helptalk_comm error');
		for ($j=0; $row2 = mysql_fetch_array($ds_helptalk_comm); $j++) { 
			if(file_exists('./board/data/talk/profile_image/'.$row2[mb_id])){
				$user_icon_img2="./board/data/talk/profile_image/".$row2[mb_id];
			}else{
				if($row[mb_sex]=="F"){//이미지 학교별 세팅
					$user_icon_img2="./css/img/tools/user_female";
				}elseif($row[mb_sex]=="M"){
					$user_icon_img2="./css/img/tools/user_male";
				}else{
					$user_icon_img2="./css/img/tools/user_anymore";
				}
				if($row[mb_1]=="82"){
					$user_icon_img2.="2";
				}
				$user_icon_img2.=".png";
			}
			
			//$st_helptalk .="<img class='user_icon2' src='./css/img/tools/".$user_icon_img_25."'>".$row2[name]." : ".$row2[content]."<br>";
			$st_helptalk .="<tr align='top'><td width='25'><img class='user_icon2' src='".$user_icon_img2."' width='25' height='25'></td><td width='70'><b>".$row2[name]."</b></td><td width='5'>:</td><td width='200'>".$row2[content]."</td></tr>";
		}
	$st_helptalk .="</table></div></div>";
}

//룸메이트
$roommate_sql = " SELECT wr_id, wr_comment, ca_name, wr_subject, wr_content, wr_name, mb_id, wr_datetime
				FROM `g4_write_room_mate` 
				WHERE wr_is_comment = '0'
				ORDER BY wr_id DESC 
				LIMIT 0 , 10   ";
$ds_roommate = mysql_Query($roommate_sql, $connection) or die('free_sql error');
$st_roommate="<table border=0 cellpadding=0 cellspacing=0 width=100%>";
for ($i=0; $row = mysql_fetch_array($ds_roommate); $i++) { 
	$st_roommate .="<tr ><td height=30 width=350><a href='./board/bbs/board.php?bo_table=room_mate&wr_id=".$row[wr_id]."' title='".$row[wr_subject]."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".cut_str($row[wr_subject],110,'..')."</a></td><td>".cut_str($row[wr_name],20,'')."</td><td>".cut_str($row[wr_datetime],10,'')."</td></tr><tr><td colspan=3 bgcolor=#cccccc style='height:1px'></td></tr>";
}
$st_roommate.="</table>";
//방거래
$marketroom_sql = " SELECT wr_id, wr_comment, ca_name, wr_subject, wr_content, wr_name, mb_id, wr_datetime
				FROM g4_write_house_deal 
				WHERE wr_is_comment = '0'
				ORDER BY wr_id DESC 
				LIMIT 0 , 10   ";
$ds_marketroom = mysql_Query($marketroom_sql, $connection) or die('marketroom_sql error');
$st_marketroom="<table border=0 cellpadding=0 cellspacing=0 width=100%>";
for ($i=0; $row = mysql_fetch_array($ds_marketroom); $i++) { 
	$st_marketroom .="<tr ><td height=30 width=350><a href='./board/bbs/board.php?bo_table=room_mate&wr_id=".$row[wr_id]."' title='".$row[wr_subject]."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".cut_str($row[wr_subject],110,'..')."</a></td><td>".cut_str($row[wr_name],20,'')."</td><td>".cut_str($row[wr_datetime],10,'')."</td></tr><tr><td colspan=3 bgcolor=#cccccc style='height:1px'></td></tr>";
}
$st_marketroom.="</table>";


//질문답변

$qna_sql = " SELECT wr_id, wr_comment, ca_name, wr_subject, wr_content, wr_name, mb_id, wr_datetime
				FROM g4_write_qna 
				WHERE wr_is_comment = '0'
				ORDER BY wr_id DESC 
				LIMIT 0 , 10   ";
$ds_qna = mysql_Query($qna_sql, $connection) or die('qna_sql error');
$st_qna="<table border=0 cellpadding=0 cellspacing=0 width=100%>";
for ($i=0; $row = mysql_fetch_array($ds_qna); $i++) { 
//	$st_qna .="<tr ><td height=30 width=350><a href='./board/bbs/board.php?bo_table=qna&wr_id=".$row[wr_id]."' title='".$row[wr_subject]."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".cut_str($row[wr_subject],110,'..')."</a></p>";
	$st_qna .="<tr ><td height=30 width=350><a href='./board/bbs/board.php?bo_table=qna&wr_id=".$row[wr_id]."' title='".$row[wr_subject]."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".cut_str($row[wr_subject],110,'..')."</a></td><td>".cut_str($row[wr_name],20,'')."</td><td>".cut_str($row[wr_datetime],10,'')."</td></tr><tr><td colspan=3 bgcolor=#cccccc style='height:1px'></td></tr>";
}
$st_qna.="</table>";
//생활정보

$lifeinfo_sql = " SELECT wr_id, wr_comment, ca_name, wr_subject, wr_content, wr_name, mb_id, wr_datetime
				FROM g4_write_life 
				WHERE wr_is_comment = '0'
				ORDER BY wr_id DESC 
				LIMIT 0 , 10   ";
$ds_lifeinfo = mysql_Query($lifeinfo_sql, $connection) or die('lifeinfo_sql error');
$st_lifeinfo="<table border=0 cellpadding=0 cellspacing=0 width=100%>";
for ($i=0; $row = mysql_fetch_array($ds_lifeinfo); $i++) { 
	//$st_lifeinfo .="<p><a href=./board/bbs/board.php?bo_table=house_deal&wr_id=".$row[wr_id]."' title='".$row[wr_subject]."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".cut_str($row[wr_subject],110,'..')."</a></p>";
	$st_lifeinfo .="<tr ><td height=30 width=350><a href='./board/bbs/board.php?bo_table=house_deal&wr_id=".$row[wr_id]."' title='".$row[wr_subject]."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".cut_str($row[wr_subject],110,'..')."</a></td><td>".cut_str($row[wr_name],20,'')."</td><td>".cut_str($row[wr_datetime],10,'')."</td></tr><tr><td colspan=3 bgcolor=#cccccc style='height:1px'></td></tr>";
}
$st_lifeinfo.="</table>";
/*
//강의정보
$classinfo_sql = " SELECT wr_id, wr_comment, ca_name, wr_subject, wr_content, wr_name, mb_id, wr_datetime
				FROM g4_write_class 
				WHERE wr_is_comment = '0'
				ORDER BY wr_id DESC 
				LIMIT 0 , 10   ";
$ds_classinfo = mysql_Query($classinfo_sql, $connection) or die('classinfo_sql error');
for ($i=0; $row = mysql_fetch_array($ds_classinfo); $i++) { 
	$st_classinfo .="<p><a href=./board/bbs/board.php?bo_table=house_deal&wr_id=".$row[wr_id]."' title='".$row[wr_subject]."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".cut_str($row[wr_subject],110,'..')."</a></p>";
}
*/
//알바정보
$albainfo_sql = " SELECT wr_id, wr_comment, ca_name, wr_subject, wr_content, wr_name, mb_id, wr_datetime
				FROM g4_write_alba 
				WHERE wr_is_comment = '0'
				ORDER BY wr_id DESC 
				LIMIT 0 , 10   ";
$ds_albainfo = mysql_Query($albainfo_sql, $connection) or die('albainfo_sql error');
$st_albainfo="<table border=0 cellpadding=0 cellspacing=0 width=100%>";
for ($i=0; $row = mysql_fetch_array($ds_albainfo); $i++) { 
	//$st_albainfo .="<p><a href=./board/bbs/board.php?bo_table=alba&wr_id=".$row[wr_id]."' title='".$row[wr_subject]."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".cut_str($row[wr_subject],110,'..')."</a></p>";
	$st_albainfo .="<tr ><td height=30 width=350><a href='./board/bbs/board.php?bo_table=alba&wr_id=".$row[wr_id]."' title='".$row[wr_subject]."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".cut_str($row[wr_subject],110,'..')."</a></td><td>".cut_str($row[wr_name],20,'')."</td><td>".cut_str($row[wr_datetime],10,'')."</td></tr><tr><td colspan=3 bgcolor=#cccccc style='height:1px'></td></tr>";
}
$st_albainfo.="</table>";
//최근 코멘트
$cquery="
SELECT max(udate) as udate,h_id,comment FROM h_comment GROUP BY h_id order by udate desc limit 15";
$ds_comment = mysql_Query($cquery);
for($i=0;$row = mysql_fetch_array($ds_comment);$i++)
{		
	$cquery1="
		select 
		H.phone,
		H.mphone,
		H.add1,
		H.add2,
		H.h_cd,
		H.h_nm,
		B.wdate,
		B.udate,
		B.comment
	from 
		room_house as H,
		h_comment as B
	where 
		H.h_cd=B.h_id and
		H.open='yes' and
		B.h_id=$row[h_id]
	order by B.id desc limit 1
	";

	$cq_result = mysql_Query($cquery1);
	$house_row=mysql_fetch_array($cq_result);
	$comment_row[$house_row[udate]][]=$house_row;
	
}

$sql_common = "  ";

$sql_order = " ";

$colspan = 5;

	foreach($comment_row as $key1=>$value1)
	{
		foreach($value1 as $key2=>$value2)
		{
			
			if($value2[h_cd])
			{
				$tel_info="";
				if($value2[phone])
				{
					$tel_info.=$value2[phone];
				}
				if($value2[mphone])
				{
					if($tel_info)$tel_info.="<br>";
					$tel_info.=$value2[mphone];
				}
			
				$comment_count_temp=mysql_Fetch_row(mysql_query("select count(*) from h_comment where h_id='$value2[h_cd]'"));
				$comment_count=$comment_count_temp[0];
				$address_info=$value2[add1].$value2[add2];
				$img_sql = " select I_id, I_classify, I_classify_id, I_filename from room_imageinfo where I_classify ='H' and I_classify_id='$value2[h_cd]' order by priority desc,I_id asc limit 1";	
				$result_img_sql = mysql_Query($img_sql);
				$row_img = mysql_fetch_array($result_img_sql);
				$row_img[I_filename]=str_replace('gif','jpg',$row_img[I_filename]);
				if($row_img[I_filename]!=""){
					$img_path="./imageData/thumbOpen2/".$row_img[I_filename];
				}else{
					$img_path="./board/img/no_img.gif";
				}
				
				$st_comment .= "<li><center><a href={$IU[url]}/index.php?mode=house_view&h_cd=".$value2[h_cd]." title='".$value2[h_nm]."'>"."<img src='".$img_path."' width='100' height='80' style='border:1 #E7E7E7 solid' style=' CURSOR: pointer'>".cut_str($value2[h_nm],20,'..')."($comment_count)</a></center></li>";
			}
			else
			{
				$tmp_write_table = $g4['write_prefix'] . $value2['bo_table'];
				if ($value2['wr_id'] == $value2['wr_parent'])continue;
				//$comment = "[코] ";
				

				$comment_link = "#c_{$value2[wr_id]}";
				//부모글
				$row2 = sql_fetch(" select * from $tmp_write_table where wr_id = '$value2[wr_parent]' ");
				
				//코멘트글
				$row3 = sql_fetch(" select wr_subject,mb_id, wr_name, wr_email, wr_homepage, wr_datetime from $tmp_write_table where wr_id = '$value2[wr_id]' ");


				$name = get_sideview($row3['mb_id'], cut_str($row3['wr_name'], $config['cf_cut_name']),$row3['wr_email'], $row3['wr_homepage']);
				
				$comment_count_temp=mysql_Fetch_row(mysql_query("select count(*) from $g4[board_new_table] where bo_table='restaurant' and wr_id!=wr_parent and wr_parent='$value2[wr_parent]'"));
				//echo"select count(*) from $g4[board_new_table] where bo_table='restaurant' and wr_id!=wr_parent and wr_parent='$value2[wr_parent]' <br>";
				$comment_count=$comment_count_temp[0];
				//$file_info= get_file($value2['bo_table'],$value2['wr_parent']);
				//$image=$file_info[0][file];
				//$thumbsource="$g4[path]/data/file/$bo_table/" . $image;
				//http://iuniv.kr/board/data/file/restaurant/img/102.thumb
				//<a href='./board/bbs/board.php?bo_table=$value2[bo_table]'>".cut_str($value2['bo_subject'],20)."</a>
				$thumbdir ="./board/data/file/".$value2['bo_table']."/img";
				$img_path= $thumbdir."/".$value2['wr_parent'].".thumb";
				if(file_exists("$img_path")){
					$img_path= $thumbdir."/".$value2['wr_parent'].".thumb";
				}else{
					$img_path="./board/img/no_img.gif";
					
				}
					$st_comment .="
					<li><center><a href='./board/bbs/board.php?bo_table=$value2[bo_table]&wr_id=$row2[wr_id]{$comment_link}'><img src='".$img_path."' width='100' height='80' style='border:1 #E7E7E7 solid' style=' CURSOR: pointer'></a>
						<a href='./board/bbs/board.php?bo_table=$value2[bo_table]&wr_id=$row2[wr_id]{$comment_link}'>".conv_subject($row2['wr_subject'], 100)."($comment_count)</a>
					</center></li>
				
				";
			}
		}
	}
?>