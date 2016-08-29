<?
include_once("house_config.php");

$sql_u = " update room_house set h_visit=h_visit+1 where h_cd='$h_cd'";
sql_query($sql_u);

/*
if($is_admin)
{
	$p_exp="월세금 350 보증금 60과 같은 형태는, 월게금과 보증금을 1년 선납하고 보증금은 1년뒤 돌려 받는 것입니다.보증금 60만원에서 개별전기료 및 공동전기료는 자동 납부되고 퇴실시 차액을 돌려 받게 됩니다.";
	$sql_c1 = "update room_room set price_ext='$p_exp' where r_cd='87'";
	$result_c = sql_query($sql_c1);
}
*/
/*
if($is_admin)
{
	$sql2="select distinct h_id from h_comment";
	$r2 = sql_query($sql2);
	while($row2 = sql_fetch_array($r2))
	{
		$sql3="select * from h_comment where h_id='$row2[h_id]' and commnet_reply=''";
		$r3 = sql_query($sql3);
		while($row3 = sql_fetch_array($r3))
		{
			$upsql1="update h_comment set parent_id=0 where id='$row3[id]'";
			sql_query($upsql1);
			
			$sql4="select * from h_comment where h_id = $row2[h_id] order by reply_count,comment_reply";
		}

		
	}

	//update h_comment set parent_id=id where comment_reply like 'A%'
}*/

$sql_c = " select * from room_house where h_cd='$h_cd'";
$result_c = sql_query($sql_c);
$view = sql_fetch_array($result_c);

$sql_map = " select h_cd, h_nm, gx, gy, add1, add2, phone from room_house where gx!='' and gy!='' ";
$ds_map = sql_query($sql_map);

$search_str=urlencode($search_str);
$qstr = "search_str=$search_str&house_ym_type=$house_ym_type&room_type=$room_type&room_size=$room_size&price_1=$price_1&price_2=$price_2&page=$page&order=$order";
if($is_admin)
{
	$delete_href = "$IU[url]/sub/house/house_delete.php?h_cd=$h_cd&".$qstr;
	$update_href = "$IU[home_file]?mode=house_write&w=u&h_cd=$h_cd&".$qstr;
}

$list_href="$IU[home_file]?mode=house_list&".$qstr;
$width=680;
?>
<script type="text/javascript" src="<?=$IU[url]?>/sub/house/thumbnailviewer2.js" defer="defer"></script>

<table width="100%" cellpadding=0 cellspacing=0>
<tr>
	<td align=center>
		<style type="text/css">
		tr.01 {background-color:#F7F8F9}
		td.01 {text-align:right; padding:0 10 0 0}
		td.02 {background-color:#FFFFFF}
		td.03 {background-color:#6B7783}
		td.04 {background-color:#cccccc}
		td.05 {background-color:#efefef}
		</style>
		<!-- 게시글 보기 시작 -->

		<table width="100%" align="center" cellpadding="0" cellspacing="0" border=0>
		<tr>
			<td>
				<div style="clear:both; height:30px;">
					

					<!-- 링크 버튼 -->
					<div style="float:right;">
						<?
						ob_start();
						?>
						<a href='#map_point'><img src='<?=$IU[url]?>/sub/house/img/go_map_btn.jpg' border='0' align='absmiddle'></a>
						<? if ($copy_href) { echo "<a href=\"$copy_href\"><img src='$IU[url]/sub/house/img/btn_copy.gif' border='0' align='absmiddle'></a> "; } ?>
						<? if ($move_href) { echo "<a href=\"$move_href\"><img src='$IU[url]/sub/house/img/btn_move.gif' border='0' align='absmiddle'></a> "; } ?>

						<? if ($search_href) { echo "<a href=\"$search_href\"><img src='$IU[url]/sub/house/img/btn_list_search.gif' border='0' align='absmiddle'></a> "; } ?>
						<? echo "<a href=\"$list_href\"><img src='$IU[url]/sub/house/img/btn_list.gif' border='0' align='absmiddle'></a> "; ?>
						<? if ($update_href) { echo "<a href=\"$update_href\"><img src='$IU[url]/sub/house/img/btn_modify.gif' border='0' align='absmiddle'></a> "; } ?>
						<? if ($delete_href) { echo "<a href=\"$delete_href\"><img src='$IU[url]/sub/house/img/btn_delete.gif' border='0' align='absmiddle'></a> "; } ?>
						<? if ($reply_href) { echo "<a href=\"$reply_href\"><img src='$IU[url]/sub/house/img/btn_reply.gif' border='0' align='absmiddle'></a> "; } ?>
						<? if ($write_href) { echo "<a href=\"$write_href\"><img src='$IU[url]/sub/house/img/btn_write.gif' border='0' align='absmiddle'></a> "; } ?>
						<?
						$link_buttons = ob_get_contents();
						ob_end_flush();
						?>
					</div>
				</div>

				<div style="border:1px solid #ddd; clear:both; height:34px; background:url(<?=$IU[url]?>/sub/house/img/title_bg.gif) repeat-x;">
					<table border=0 cellpadding=0 cellspacing=0 width=100%>
					<tr>
						<td style="padding:8px 0 0 10px;" width=70%>
							<div style="color:#505050; font-size:13px; font-weight:bold; word-break:break-all;">
								<?=cut_hangul_last(get_text($view[h_nm]))?>
							</div>
						</td>
						<td align="right" style="padding:6px 6px 0 0;" width=30%>
							<? if ($scrap_href) { echo "<a href=\"javascript:;\" onclick=\"win_scrap('$scrap_href');\"><img src='<?=$IU[url]?>/sub/house/img/btn_scrap.gif' border='0' align='absmiddle'></a> "; } ?>
							<? if ($trackback_url) { ?><a href="javascript:trackback_send_server('<?=$trackback_url?>');" style="letter-spacing:0;" title='주소 복사'><img src="<?=$IU[url]?>/sub/house/img/btn_trackback.gif" alt="" align="absmiddle"></a><?}?>

							<img src="<?=$IU[url]?>/sub/house/img/icon_view.gif" align=absmiddle> 조회 : <?=number_format($view[wr_hit])?>
							<? if ($is_good) { ?>&nbsp;<img src="<?=$IU[url]?>/sub/house/img/icon_good.gif" align=absmiddle> 추천 : <?=number_format($view[wr_good])?><? } ?>
							<? if ($is_nogood) { ?>&nbsp;<img src="<?=$IU[url]?>/sub/house/img/icon_nogood.gif" align=absmiddle> 비추천 : <?=number_format($view[wr_nogood])?><? } ?>
							&nbsp;

						</td>
					</tr>
					</table>
				</div>
				<div style="height:3px; background:url(<?=$IU[url]?>/sub/house/img/title_shadow.gif) repeat-x; line-height:1px; font-size:1px;"></div>
					<link rel="stylesheet" type="text/css" href="<?=$IU[url]?>/css/scrollable-horizontal.css" />
			<link rel="stylesheet" type="text/css" href="<?=$IU[url]?>/css/scrollable-buttons.css" />

			<?

			include_once("tool_view.php");	//섬넬일 생성 부분

			?>

				<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>

				
				<tr><td><img src="<?=$IU[url]?>/sub/house/img/a02.gif" align=absmiddle><font color=#A90000><b>실재 거래정보는 변경 되었을수 있습니다. </b></font></td></tr>
				
				<?
				if($view[research_date] >2008)
				{
				?>
				<tr><td><img src="<?=$IU[url]?>/sub/house/img/a02.gif" align=absmiddle><font color=#A90000><b>아래 정보는 <?=$view[research_date]?>에 조사된 정보 입니다. </b></font></td></tr>
				<?
				}
				else
				{
				?>
				<tr><td><img src="<?=$IU[url]?>/sub/house/img/a02.gif" align=absmiddle><font color=#A90000><b>아래 정보는 참고만 하시고 정확한 정보는 전화를 통해 확인하시기 바랍니다.</b></font></td></tr>
				<?
				}
				?>
				<tr><td><img src="<?=$IU[url]?>/sub/house/img/a02.gif" align=absmiddle><font color=#A402AA><b>기본정보</b></font></td></tr>
				<?
				// 가변 파일
				$cnt = 0;
				for ($i=0; $i<count($view[file]); $i++) {
					if ($view[file][$i][source] && !$view[file][$i][view]) {
					$cnt++;
					echo "<tr><td height=30 background=\"<?=$IU[url]?>/sub/house/img/view_dot.gif\">";
					echo "&nbsp;&nbsp;<img src='{$IU[house_path]}/img/icon_file.gif' align=absmiddle>";
					echo "<a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'>";
					echo "&nbsp;<span style=\"color:#888;\">{$view[file][$i][source]} ({$view[file][$i][size]})</span>";
					echo "&nbsp;<span style=\"color:#ff6600; font-size:11px;\">[{$view[file][$i][download]}]</span>";
					echo "&nbsp;<span style=\"color:#d3d3d3; font-size:11px;\">DATE : {$view[file][$i][datetime]}</span>";
					echo "</a></td></tr>";
					}
				}
				$phone="";
				if($view[phone]){$phone.=$view[phone];}
				
				if($view[phone] && $view[mphone]){$phone.="<br>".$view[mphone];}
				elseif($view[mphone]){$phone.=$view[mphone];}
				?>

				<tr>
					<td colspan=2>
						<table width=100% cellpadding=2 cellspacing=0>
						<tr>
							<td bgcolor=#EEEEEE>
								<table width=100% cellpadding=5 cellspacing=1 style="border:1px solid #CCCCCC">
								<tr>
									<td height=28 width=20% class="02" bgcolor=#FFFFFF>건축일</td><td width=30% class="02" bgcolor=#FFFFFF><?=$view[build_year]?></td>
									<td height=28 width=20% class="02" bgcolor=#FFFFFF>연락처</td><td width=30% class="02" bgcolor=#FFFFFF><?=$phone?></td>
								</tr>

								<tr>
									<td height=28 width=20% class="02" bgcolor=#FFFFFF>방형태</td><td width=30% class="02" bgcolor=#FFFFFF><?=$house_v[room_type][$view[room_type]]?></td>
									<td height=28 width=20% class="02" bgcolor=#FFFFFF>주인거주형태</td><td width=30% class="02" bgcolor=#FFFFFF><?=$house_v[owner_location][$view[owner_stay_type]]?></td>
								</tr>

								<tr>
									<td height=28 width=20% class="02" bgcolor=#FFFFFF>지역</td><td width=30% class="02" bgcolor=#FFFFFF><?=$house_v[add_div][$view[add_div]]?></td>
									<td height=28 width=20% class="02" bgcolor=#FFFFFF>홈페이지</td>
									<td width=30% class="02" bgcolor=#FFFFFF>

										<?
										// 링크
										$cnt = 0;
										for ($i=1; $i<=$g4[link_count]; $i++) {
										if ($view[link][$i]) {
										$cnt++;
										$link = cut_str($view[link][$i], 70);
										echo "<a href='{$view[link_href][$i]}' target=_blank>";
										echo "&nbsp;<span style=\"color:#888;\">{$link}</span>";
										echo "&nbsp;<span style=\"color:#ff6600; font-size:11px;\">[{$view[link_hit][$i]}]</span>";
										echo "</a>";
										}
										}
										?>
									</td>
								</tr>


								<tr>
									<td height=28 class="02" bgcolor=#FFFFFF>주소</td>
									<td class="02" colspan=3 bgcolor=#FFFFFF>
										<?
										$address="";
										if($view[zipcode])
										{
											$address.=$view[zipcode]."<br>";
										}
										$address.=$view[add1].$view[add2];
										{
										echo "$address" ;
										}
										?>

									</td>
								</tr>
								</table>
							</td>
						</tr>

						<tr><td height=10 colspan=2></td></tr>
					
						<tr><td height=10></td></tr>
						<tr><td height=28><img src="<?=$IU[url]?>/sub/house/img/a02.gif" align=absmiddle><font color=#A402AA><b>위치지도 보기</b></font><a name='map_point'></a></td></tr>
						<tr>
							<td bgcolor=#EEEEEE>
								<!-- 지도 출력 -->
								<table width=100% cellpadding=1 cellspacing=1 style="border:1px solid #CCCCCC"><tr><td><div id='big_map' name='big_map' style="width:710px; height:350px;position:relative"></div></td></tr></table>
								<!-- 지도 출력 끝 -->
								<?if($is_admin == 'super'){?><br>
									<button onclick=addClick()>click event 등록</button><!-- <button onclick=removeClick()>click event 제거</button> -->
								<?}?>
							</td>
						</tr>
						<tr><td height=15><iframe id=t_frame width=0 height=0></iframe></td></tr>
						<?
							
					$room_sql=" 
						select 
							r.h_cd as h_cd, 
							r.r_cd as r_cd, 
							r.r_nm as r_nm,
							r.type as type, 
							IFNULL(r.charter_yn,'무') as charter_yn, 
							IFNULL(r.monthly_yn,'무') as monthly_yn, 						
							r.charter_price as charter_price, 
							r.charter_price as charter_price, 
							r.c_credit_yn as c_credit_yn, 
							r.c_credit_price as c_credit_price, 							
							r.monthly_price as monthly_price, 
							r.m_credit_yn as m_credit_yn, 
							r.m_credit_price as m_credit_price, 
							r.price_ext as price_ext, 
							r.size1 as size1, 
							r.size2 as size2, 
							r.desk_yn as desk_yn, 
							r.aircon_yn as aircon_yn, 
							r.option_info as option_info,
							r.refri_yn as refri_yn, 				
							r.water_tax_type as water_tax_type, 
							r.water_tax_exp as water_tax_exp,
							r.elec_tax_type as elec_tax_type,							
							r.elec_tax_exp as elec_tax_exp, 
							r.boiler_type as boiler_type, 							
							r.boiler_exp as boiler_exp, 
							r.row_size as row_size,
							r.col_size as col_size, 
							r.brightness as brightness, 							
							r.bathroom as bathroom,  							
							r.bathroom_exp as bathroom_exp, 
							r.shower as shower, 							
							r.shower_exp as shower_exp, 
							r.kichen as kichen, 							
							r.kichen_exp as kichen_exp, 
							r.balcony as balcony, 							
							r.balcony_exp as balcony_exp, 
							r.boiler_control as boiler_control, 							
							r.boiler_control_exp as boiler_control_exp,
							r.water_control as water_control, 							
							r.water_control_exp as water_control_exp,   
							rt.cd_value as rtype, 
							wcon.cd_value as wcontype, 
							bcon.cd_value as bcontype, 
							balt.cd_value as balcony_type,
							kicht.cd_value as kichen_type, 
							showt.cd_value as shower_type, 
							batht.cd_value as bathroom_type,
							wt.cd_value as elec_type, 
							bt.cd_value boiltype, 
							lt.cd_value as brighttype, 
							wt.cd_value as watertype
						from  room_room r, 
						(SELECT cd, cd_value FROM room_common_cd WHERE post_cd = 'room_type') rt,						
						(SELECT cd, cd_value FROM room_common_cd WHERE post_cd = 'water_tax_type') wt,
						(SELECT cd, cd_value FROM room_common_cd WHERE post_cd = 'elec_tax_type') et,
						(SELECT cd, cd_value FROM room_common_cd WHERE post_cd = 'boiler_type') bt,
						(SELECT cd, cd_value FROM room_common_cd WHERE post_cd = 'brightness_type') lt,
						(SELECT cd, cd_value FROM room_common_cd WHERE post_cd = 'boiler_control') bcon,
						(SELECT cd, cd_value FROM room_common_cd WHERE post_cd = 'shower_type') showt,
						(SELECT cd, cd_value FROM room_common_cd WHERE post_cd = 'bathroom_type') batht,
						(SELECT cd, cd_value FROM room_common_cd WHERE post_cd = 'kichen_type') kicht,
						(SELECT cd, cd_value FROM room_common_cd WHERE post_cd = 'balcony_type') balt,
						(SELECT cd, cd_value FROM room_common_cd WHERE post_cd = 'water_control') wcon
						where r.h_cd = '$view[h_cd]'
						and r.type = rt.cd
						and r.water_tax_type = wt.cd
						and r.elec_tax_type = et.cd
						and r.boiler_type = bt.cd
						and r.boiler_control = bcon.cd
						and r.brightness = lt.cd
						and r.shower = showt.cd
						and r.bathroom = batht.cd
						and r.kichen = kicht.cd
						and r.balcony = balt.cd
						and r.water_control= wcon.cd ";
					
					#################################################

						//echo $room_sql;
						$ds_room_sql = sql_query($room_sql);
						?>
						<tr><td height=10></td></tr>
						<tr><td height=28><img src="<?=$IU[url]?>/sub/house/img/a02.gif" align=absmiddle><font color=#A402AA><b>세부 방정보</b></font></td></tr>
						<tr>
							<td>
								<table width=100% cellpadding=2 cellspacing=0>
									<?
									for ($i=0; $row = sql_fetch_array($ds_room_sql); $i++) {  
									?>
									<tr>
										<td bgcolor=#EEEEEE>
											<table width=100% cellpadding=5 cellspacing=1 style="border:1px solid #CCCCCC">
												<tr>
													<td colspan=6  height=28  class="04" bgcolor=#cccccc>
														<table border=0 cellpadding=0 cellspacing=0 width=100%>
														<tr>
															<td align=center><b><?
															if($row[r_nm])
															{
															?>
																<?=$row[r_nm]?>
															<?
															}
															else
															{
															?>
																<?=$i+1?>번째
															<?
															}
															?> </b></td>
															<td width=100 align=right><a style='cursor:pointer' onclick="popup_window('<?=$IU[url]?>/sub/house/room_image_view.php?r_cd=<?=$row[r_cd]?>&h_cd=<?=$row[h_cd]?>&r_nm=<?=$row[r_nm]?>','popimg','width=800,height=768,scrollbars=yes');"><b>이미지 보기</b></td>
														</tr>
														</table>
													</td>
												</tr>
												<tr height=28>
													<td width='14%' class="05" bgcolor=#efefef>방형태</td>
													<td width='20%' class="02" bgcolor=#FFFFFF><?=$row[rtype]?></td>
													<td width='13%' class="05" bgcolor=#efefef>전세유무</td>
													<td width='20%' class="02" bgcolor=#FFFFFF><?if($row[charter_yn]=='Y'){echo"유";}else{echo"무";}?></td>
													<td width='13%' class="05" bgcolor=#efefef>월세유무</td>
													<td width='20%' class="02" bgcolor=#FFFFFF><?if($row[monthly_yn]=='Y'){echo"유";}else{echo"무";}?></td>
												</tr>
												<tr height=28>
													<td width='14%' class="05" bgcolor=#efefef>전기세타입</td>
													<td width='20%' class="02" bgcolor=#FFFFFF><?=$house_v[elec_tax_type][$row[elec_tax_type]]?><Br><?=$row[elec_tax_exp]?></td>
													<td width='13%' class="05" bgcolor=#efefef>전세가격</td>
													<td width='20%' class="02" bgcolor=#FFFFFF><?=$row[charter_price]?>만원</td>
													<td width='13%' class="05" bgcolor=#efefef>월세가격</td>
													<td width='20%' class="02" bgcolor=#FFFFFF>월 세 <?=$row[monthly_price]?>만원<br>보증금 <?=$row[m_credit_price]?>만원</td>
												</tr>
												<tr height=28>
													<td width='14%' class="05" bgcolor=#efefef>방크기<br>평방미터</td>
													<td width='20%' class="02" bgcolor=#FFFFFF><?=$row[size1]?>평<br><?=$row[size2]?>m²</td>
													<td width='13%' class="05" bgcolor=#efefef>가로X세로<br>(단위:cm)</td>
													<td width='20%' class="02" bgcolor=#FFFFFF><?=$row[col_size]?>X<?=$row[row_size]?>cm</td>
													<td width='13%' class="05" bgcolor=#efefef>욕실타입</td>
													<td width='20%' class="02" bgcolor=#FFFFFF><?=$row[bathroom_type]?><br><?=$row[bathroom_exp]?></td>
												</tr>
												<tr height=28>
													<td width='14%' class="05" bgcolor=#efefef>수도세</td>
													<td width='20%' class="02" bgcolor=#FFFFFF><?=$house_v[water_tax_type][$row[water_tax_type]]?><br><?=$row[water_tax_exp]?></td>
													<td width='13%' class="05" bgcolor=#efefef>수도컨트롤</td>
													<td width='20%' class="02" bgcolor=#FFFFFF><?=$row[wcontype]?><br><?=$row[water_control_exp]?></td>
													<td width='13%' class="05" bgcolor=#efefef>채광도</td>
													<td width='20%' class="02" bgcolor=#FFFFFF><?=$row[brighttype]?></td>
												</tr>
												<tr height=28>
													<td width='14%' class="05" bgcolor=#efefef>보일러타입</td>
													<td width='20%' class="02" bgcolor=#FFFFFF><?=$row[boiltype]?><br><?=$row[boiltype_exp]?></td>
													<td width='13%' class="05" bgcolor=#efefef>보일러컨드롤</td>
													<td width='20%' class="02" bgcolor=#FFFFFF><?=$row[bcontype]?><br><?=$row[boiler_control_exp]?></td>
													<td width='13%' class="05" bgcolor=#efefef>샤워시설</td>
													<td width='20%' class="02" bgcolor=#FFFFFF><?=$row[shower_type]?><br><?=$row[shower_exp]?></td>
												</tr>
												<tr height=28>
													<td width='14%' class="05" bgcolor=#efefef>주방</td>
													<td width='20%' class="02" bgcolor=#FFFFFF ><?=$row[kichen_type]?><br><?=$row[kichen_exp]?></td>
													<td width='13%' class="05" bgcolor=#efefef>발코니</td>
													<td width='20%' class="02" bgcolor=#FFFFFF ><?=$row[balcony_type]?><br><?=$row[balcony_exp]?></td>
													<td width='13%' class="05" bgcolor=#efefef>기타옵션</td>
													<td width='20%' class="02" bgcolor=#FFFFFF >
													<?if($row[desk_yn]=='Y'){echo"책상";}?><br>
													<?if($row[aircon_yn]=='Y'){echo"에어콘";}?><br>
													<?if($row[refri_yn]=='Y'){echo"냉장고";}?>
													<br><?if($row[option_info]){echo"<br> $row[option_info]";}?>
													</td>
												</tr>
												<tr height=28>
													<td width='14%' class="05" bgcolor=#efefef>가격설명</td>
													<td width='50%' class="02" bgcolor=#FFFFFF colspan=5>
													<?
													if($row[price_ext])			
													{
														echo"$row[price_ext]";
													}
													else
													{
													?>
													월세 300 보증금 30 과 같은 형태는 월세금을 1년 선납하고 보증금은 1년뒤 돌려 받는것입니다. <br>
													월세 30 보증금 300 과 같은 형태는 매달 30을 내고 계약이 끝나는 시기에 보증금을 돌려 받는것입니다.<br>
													<?
													}	
													?>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<?
									}
									?>
								</table>
							</td>
						</tr>
						<?
						if($view[content]){
						?>
						<tr><td height=10></td></tr>
						<tr><td height=28><img src="<?=$IU[url]?>/sub/house/img/a02.gif" align=absmiddle><font color=#A402AA><b>소개글</b></font></td></tr>
						<tr>
							<td>

								<table width=100% border="0" cellspacing="0" cellpadding="0" style="border:1 solid #dddddd;">
								<tr>
									<td style='word-break:break-all; padding:10px;' bgcolor=#F8F8F9 align=left>

										<!-- 내용 출력 -->
										<span class="ct lh"><?=$view[content];?></span>

										<?//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
										<!-- 테러 태그 방지용 --></xml></xmp><a href=""></a><a href=''></a>

										<? if ($is_signature) { echo "<tr><td align='center' style='border-bottom:1px solid #E7E7E7; padding:5px 0;'>$signature</td></tr>"; } // 서명 출력 ?>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						<?}?>
						</table>
					</div>

					<?//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
					<!-- 테러 태그 방지용 --></xml></xmp><a href=""></a><a href=''></a>

					<? if ($nogood_href) {?>
					<div style="width:72px; height:55px; background:url(<?=$IU[url]?>/sub/house/img/good_bg.gif) no-repeat; text-align:center; float:right;">
						<div style="color:#888; margin:7px 0 5px 0;">비추천 : <?=number_format($view[wr_nogood])?></div>
						<div><a href="<?=$nogood_href?>" target="hiddenframe"><img src="<?=$IU[url]?>/sub/house/img/icon_nogood.gif" align="absmiddle"></a></div>
					</div>
					<? } ?>

					<? if ($good_href) {?>
					<div style="width:72px; height:55px; background:url(<?=$IU[url]?>/sub/house/img/good_bg.gif) no-repeat; text-align:center; float:right;">
						<div style="color:#888; margin:7px 0 5px 0;"><span style='color:crimson;'>추천 : <?=number_format($view[wr_good])?></span></div>
						<div><a href="<?=$good_href?>" target="hiddenframe"><img src="<?=$IU[url]?>/sub/house/img/icon_good.gif" align="absmiddle"></a></div>
					</div>
					<? } ?>

				</td>
			</tr>
			<? if ($is_signature) { echo "<tr><td align='center' style='border-bottom:1px solid #E7E7E7; padding:5px 0;'>$signature</td></tr>"; } // 서명 출력 ?>

			</table>

			<br>
		</td>
		</tr>
		<tr><td height=10></td></tr>
		<tr>
            <td height=1 colspan=3 align=left style='color:red'>근거 없는 비방의 글이나 적합하지 않은 글의 경우 관리자 임으로 수정/삭제 됩니다.</td>
        </tr>
		<tr>
            <td height=1 colspan=3 align=left style='color:red'>일부 글의 경우 관리자 임의로 수정 하였습니다. 댓글에 실명 및 연락처 남겨 주시면 원본 글 공개 하도록 하겠습니다.</td>
        </tr>
		<tr><td height=10></td></tr>
		<tr>
			<td>
		<?
		// 코멘트 입출력
		include_once("view_comment.php");
		?>

		<div style="height:1px; line-height:1px; font-size:1px; background-color:#ddd; clear:both;">&nbsp;</div>

		<div style="clear:both; height:43px;">
		<div style="float:left; margin-top:10px;">
			<? if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\"><img src='<?=$IU[url]?>/sub/house/img/btn_prev.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
			<? if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\"><img src='<?=$IU[url]?>/sub/house/img/btn_next.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
		</div>

		<!-- 링크 버튼 -->
		<div style="float:right; margin-top:10px;">
			<?=$link_buttons?>
		</div>
		</div>

		<div style="height:2px; line-height:1px; font-size:1px; background-color:#dedede; clear:both;">&nbsp;</div>

		</td>
		</tr>
		</table>

	</td>
</tr>
<tr><td height=15></td></tr>
</table>

<?


if($view[gx]==""||$view[gy]==""){
	$view[gx]=336456;
	$view[gy]=445768;

}
?>

<script type="text/javascript" src="http://map.naver.com/js/naverMap.naver?key=d936531c200b41d1373eda2efc370f04"></script>
<SCRIPT LANGUAGE="JavaScript">
<!--
	//기본설정
	var mapObj = new NMap(document.getElementById('big_map')); // 지도창
	//alert("//"+'<?=$view[gx]?>');
	var loc_center = new NPoint(<?=$view[gx]?>,<?=$view[gy]?>);  // 지도 중앙 좌표
	
	var zoomlevel = 0// 축적
	//기본설정 끝
	var x_point = new Array();
	var y_point = new Array();
	var infobox = new Array();
	var url = new Array();
	var loc = new Array();
	var cat = new Array();
	var con = new Array();
	var cat_size1 = new Array();
	var cat_size2 = new Array();
		<?
		for ($i=0; $map_row = sql_fetch_array($ds_map); $i++) { 
			if($map_row[h_cd]==$view[h_cd]){
		?>
				cat[<?=$i?>] = "ic_spot.png";	
				cat_size1[<?=$i?>] = 74;
				cat_size2[<?=$i?>] = 80;
		<?
			}else{
		?>
				cat[<?=$i?>] = "map_home.gif";	
				cat_size1[<?=$i?>] = 20;
				cat_size2[<?=$i?>] = 20;
		<?
			}
		?>
		x_point[<?=$i?>] = '<?=$map_row[gx]?>';
		y_point[<?=$i?>] = '<?=$map_row[gy]?>';
		infobox[<?=$i?>] = '<?=$map_row[h_nm]?>';
		url[<?=$i?>] = "<?=$IU[home_file]?>?mode=house_view&h_cd=<?=$map_row[h_cd]?>";	
		con[<?=$i?>] = '연락처:<?=$map_row[phone]?>';
		<?}?>

		for (i=0; i< x_point.length; i++)
		{
			loc[i] = new NPoint(x_point[i],y_point[i]);
			write_map(x_point[i], y_point[i], infobox[i], url[i], cat[i], con[i], cat_size1[i], cat_size2[i]);
		}
	mapObj.setCenterAndZoom(loc_center,zoomlevel); // 지도 중앙과 줌레벨 결정해서 보여준다!
///* 줌버튼 표시 하려면 주석을 풀어주세요
	var zoom = new NZoomControl();
	zoom.setAlign("right"); // 줌 조절 버튼 왼쪽에 위치
	zoom.setValign("bottom"); // 줌 조절 버튼 아래에 위치
	mapObj.addControl(zoom);
	//mapObj.enableWheelZoom(); // 지도 안에서 휠로 줌 조절 가능하게 하려면 주석을 풀어주세요
//*/
//-->
	/* 지도 모드 변경 버튼 생성 */
	var mapBtns = new NMapBtns();
	mapBtns.setAlign("right");
	mapBtns.setValign("top");
	mapObj.addControl(mapBtns);

	//마커 표시 및 마우스 오버 이벤트 등록용
	function write_map(map_x, map_y, map_content, go_href, icon, content, icon_size1, icon_size2) {
		var icon = new NIcon("<?=$IU[url]?>/sub/house/img/map/"+icon+"", new NSize(icon_size1,icon_size2)); // 아이콘파일
		var infowin = new NInfoWindow();
		var loc_point = new NPoint(map_x, map_y);
		var map_mark = new NMark(loc_point, icon );
		var info_box = ' \
						<div style="width:150px;border: 2px solid #cccccc; background:#ffffff;padding:5px 5px 5px 5px;"> \
							<div style="text-align:left;"> \
								<dt>'+map_content+'</dt> \
								<dt>'+content+'</dt> \
							</div> \
						</div> \
						';
		NEvent.addListener(map_mark,"mouseover",function(){infowin.set(loc_point,info_box);infowin.showWindow()});
//		NEvent.addListener(map_mark,"mouseout",function() {infowin.hideWindow();});
		NEvent.addListener(map_mark,"mouseout",function() {infowin.delayHideWindow(250);});
		NEvent.addListener(map_mark, "click", function() {location.href = go_href;} );
		//NEvent.addListener(map_mark, "click", function() {SLB(go_href,'iframe', 508, 400, true, true);} );
		
		mapObj.addOverlay(map_mark); // 지도에 마크표시
		// map_mark.setTargeturl(go_href); //마커 클릭시 새창
		mapObj.addOverlay(infowin);
	}
	function movepoint(go_x_point, go_y_point)
	{
	var go_point = new NPoint(go_x_point, go_y_point);
	mapObj.setCenter(go_point);
	}

	var regFlag = false;
	function removeClick123()
	{
		NEvent.removeListener(mapObj,"click",clicked);
		regFlag  = false;
	}
	function addClick()
	{
	
		if (!regFlag)
		{
	
			NEvent.addListener(mapObj,"click",clicked);
			regFlag  = true;
		}
	}

	function clicked(pos)
	{
		alert(pos+" clicked");
		var xy = String(pos);
		
		var arrxy = xy.split(",");
		var url='<?=$IU[url]?>/sub2/house/house_mapxy_update.php?h_cd=<?=$view[h_cd]?>&gx='+arrxy[0]+'&gy='+arrxy[1];
		
		//popupOpenWindow(url,400,100);
		t_frame.location.href=url;
		
	}
</SCRIPT>