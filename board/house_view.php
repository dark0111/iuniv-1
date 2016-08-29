<?
include_once("./_common.php");
$g4['title'] = "";
include_once("./_head.php");
$sql_c = " select * from room_house where h_cd='$h_cd'";
$result_c = sql_query($sql_c);
$row_c = sql_fetch_array($result_c);

$width=680;

?>

<table width="100%" cellpadding=0 cellspacing=0>
<tr>
	<td align=center>
		<style type="text/css">
		tr.01 {background-color:#F7F8F9}
		td.01 {text-align:right; padding:0 10 0 0}
		td.02 {background-color:#FFFFFF}
		td.03 {background-color:#6B7783}
		</style>
		<!-- 게시글 보기 시작 -->
		<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0" border=0>
		<tr>
			<td>
				<div style="clear:both; height:30px;">
					<div style="float:left; margin-top:6px;">
						<img src="<?=$g4[path]?>/img/icon_date.gif" align=absmiddle>
						<span style="color:#888888;">작성일 : <?=date("y-m-d H:i", strtotime($view[wr_datetime]))?></span>
					</div>

					<!-- 링크 버튼 -->
					<div style="float:right;">
						<?
						ob_start();
						?>
						<? if ($copy_href) { echo "<a href=\"$copy_href\"><img src='$board_skin_path/img/btn_copy.gif' border='0' align='absmiddle'></a> "; } ?>
						<? if ($move_href) { echo "<a href=\"$move_href\"><img src='$board_skin_path/img/btn_move.gif' border='0' align='absmiddle'></a> "; } ?>

						<? if ($search_href) { echo "<a href=\"$search_href\"><img src='$board_skin_path/img/btn_list_search.gif' border='0' align='absmiddle'></a> "; } ?>
						<? echo "<a href=\"$list_href\"><img src='$board_skin_path/img/btn_list.gif' border='0' align='absmiddle'></a> "; ?>
						<? if ($update_href) { echo "<a href=\"$update_href\"><img src='$board_skin_path/img/btn_modify.gif' border='0' align='absmiddle'></a> "; } ?>
						<? if ($delete_href) { echo "<a href=\"$delete_href\"><img src='$board_skin_path/img/btn_delete.gif' border='0' align='absmiddle'></a> "; } ?>
						<? if ($reply_href) { echo "<a href=\"$reply_href\"><img src='$board_skin_path/img/btn_reply.gif' border='0' align='absmiddle'></a> "; } ?>
						<? if ($write_href) { echo "<a href=\"$write_href\"><img src='$board_skin_path/img/btn_write.gif' border='0' align='absmiddle'></a> "; } ?>
						<?
						$link_buttons = ob_get_contents();
						ob_end_flush();
						?>
					</div>
				</div>

				<div style="border:1px solid #ddd; clear:both; height:34px; background:url(<?=$g4[path]?>/img/title_bg.gif) repeat-x;">
					<table border=0 cellpadding=0 cellspacing=0 width=100%>
					<tr>
						<td style="padding:8px 0 0 10px;" width=70%>
							<div style="color:#505050; font-size:13px; font-weight:bold; word-break:break-all;">
								<? if ($is_category) { echo ($category_name ? "[$view[ca_name]] " : ""); } ?>
								<?=cut_hangul_last(get_text($view[wr_subject]))?>
							</div>
						</td>
						<td align="right" style="padding:6px 6px 0 0;" width=30%>
							<? if ($scrap_href) { echo "<a href=\"javascript:;\" onclick=\"win_scrap('$scrap_href');\"><img src='$board_skin_path/img/btn_scrap.gif' border='0' align='absmiddle'></a> "; } ?>
							<? if ($trackback_url) { ?><a href="javascript:trackback_send_server('<?=$trackback_url?>');" style="letter-spacing:0;" title='주소 복사'><img src="<?=$g4[path]?>/img/btn_trackback.gif" alt="" align="absmiddle"></a><?}?>

							<img src="<?=$g4[path]?>/img/icon_view.gif" align=absmiddle> 조회 : <?=number_format($view[wr_hit])?>
							<? if ($is_good) { ?>&nbsp;<img src="<?=$g4[path]?>/img/icon_good.gif" align=absmiddle> 추천 : <?=number_format($view[wr_good])?><? } ?>
							<? if ($is_nogood) { ?>&nbsp;<img src="<?=$g4[path]?>/img/icon_nogood.gif" align=absmiddle> 비추천 : <?=number_format($view[wr_nogood])?><? } ?>
							&nbsp;

						</td>
					</tr>
					</table>
				</div>
				<div style="height:3px; background:url(<?=$g4[path]?>/img/title_shadow.gif) repeat-x; line-height:1px; font-size:1px;"></div>


				<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
				<!--
		<tr>
			<td height=30 background="<?=$g4[path]?>/img/view_dot.gif" style="color:#888;">
				<div style="float:left;">
				&nbsp;글쓴이 :
				<?=$view[name]?><? if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>
				</div>
				<div style="float:right;">
				<img src="<?=$g4[path]?>/img/icon_view.gif" align=absmiddle> 조회 : <?=number_format($view[wr_hit])?>
				<? if ($is_good) { ?>&nbsp;<img src="<?=$g4[path]?>/img/icon_good.gif" align=absmiddle> 추천 : <?=number_format($view[wr_good])?><? } ?>
				<? if ($is_nogood) { ?>&nbsp;<img src="<?=$g4[path]?>/img/icon_nogood.gif" align=absmiddle> 비추천 : <?=number_format($view[wr_nogood])?><? } ?>
				&nbsp;
				</div>
			</td>
		</tr>
		-->
				<tr><td><img src="<?=$g4[path]?>/img/a02.gif" align=absmiddle><font color=#A402AA><b>기본정보</b></font></td></tr>
				<?
				// 가변 파일
				$cnt = 0;
				for ($i=0; $i<count($view[file]); $i++) {
				if ($view[file][$i][source] && !$view[file][$i][view]) {
				$cnt++;
				echo "<tr><td height=30 background=\"$board_skin_path/img/view_dot.gif\">";
				echo "&nbsp;&nbsp;<img src='{$board_skin_path}/img/icon_file.gif' align=absmiddle>";
				echo "<a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'>";
				echo "&nbsp;<span style=\"color:#888;\">{$view[file][$i][source]} ({$view[file][$i][size]})</span>";
				echo "&nbsp;<span style=\"color:#ff6600; font-size:11px;\">[{$view[file][$i][download]}]</span>";
				echo "&nbsp;<span style=\"color:#d3d3d3; font-size:11px;\">DATE : {$view[file][$i][datetime]}</span>";
				echo "</a></td></tr>";
				}
				}
				?>

				<tr>
					<td colspan=2>
						<table width=100% cellpadding=2 cellspacing=0>
						<tr>
							<td bgcolor=#EEEEEE>
								<table width=100% cellpadding=5 cellspacing=1 style="border:1px solid #CCCCCC">
								<tr>
									<td height=28 width=20% class="02">업종</td><td width=30% class="02"><? if ($is_category) { echo ($category_name ? "[$view[ca_name]] " : ""); } ?></td>
									<td height=28 width=20% class="02">전화번호</td><td width=30% class="02"><?=$view[wr_4]?></td>
								</tr>

								<tr>
									<td height=28 width=20% class="02">주차시설</td><td width=30% class="02"><?=$two01?></td>
									<td height=28 width=20% class="02">영업시간</td><td width=30% class="02"><?=$two11?></td>
								</tr>

								<tr>
									<td height=28 width=20% bgcolor=#FFFFFF>휴일</td><td width=30% class="02"><?=$view[wr_5]?></td>
									<td height=28 width=20% class="02">홈페이지</td>
									<td width=30% class="02">

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

								<tr><td height=28 class="02">배달가능지역</td><td class="02" colspan=3><?=$two02?><font color=#FF0000><?=$two03?></font><font color=#0000FF><?=$two04?></font><font color=#008000><?=$two05?></font><font color=#FF8000><?=$two06?></font><font color=#808000><?=$two07?></font><font color=#FF00FF><?=$two08?></font><font color=#800000><?=$two09?></font><font color=#800080><?=$two10?></font></td></tr>

								<tr>
									<td height=28 class="02">주소</td>
									<td class="02" colspan=3>
										<?
										$address = substr($view[wr_8], 8); // 3번 여유 필드에 저장 되어 있는 주소의 우편번호를 삭제
										$adrress1 = str_replace("|","",$address); // | 태그 삭제
										{
										echo "$adrress1" ;
										}
										?>

									</td>
								</tr>
								</table>
							</td>
						</tr>

						<tr><td height=10 colspan=2></td></tr>

						<tr><td height=28><img src="<?=$g4[path]?>/img/a02.gif" align=absmiddle><font color=#A402AA><b>사진정보</b></font></td></tr>

						<tr>
							<td align=center>


								<?
								if ($view[file][0][view]) {
								echo "<table width=100% border=0 cellspacing=0 cellpadding=0 style='border:1 solid #dddddd;' background='{$board_skin_path}/img/a01.gif'>";
								echo "<tr><td align=center style='word-break:break-all; padding:5px;'>";
								if($a == "1") {
								include $board_skin_path."/vertical_view.php";
								}
								else if($a == "2"){
								include $board_skin_path."/horizontal_view.php";
								}
								else {
								include $board_skin_path."/vertical_view.php";
								}
								echo "</td></tr></table>";
								}
								else {
								//echo "<img src='{$board_skin_path}/img/a03.gif' align=absmiddle>";
								echo "사진이 없습니다.";
								}

								?>

							</td>
						</tr>

						<tr><td height=10></td></tr>
						<tr><td height=28><img src="<?=$g4[path]?>/img/a02.gif" align=absmiddle><font color=#A402AA><b>메뉴판</b></font></td></tr>

						<tr>
							<td align=center>
								<table width=620 border="0" cellspacing="0" cellpadding="0" style="border:1 solid #dddddd;">
								<tr>
									<td height=31 width=188 background="<?=$g4[path]?>/img/td_bg.gif" align=center><b>메뉴</b></td>
									<td width=4></td>
									<td width=116 background="<?=$g4[path]?>/img/td_bg.gif" align=center><b>가격</b></td>
									<td width=4 class="02"></td>
									<td width=188 background="<?=$g4[path]?>/img/td_bg.gif" align=center><b>메뉴</b></td>
									<td width=4></td>
									<td width=116 background="<?=$g4[path]?>/img/td_bg.gif" align=center><b>가격</b></td>
								</tr>

								<tr class="01">
									<td height=28 class="01"><?=$seven01?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven02?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$seven03?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven04?>&nbsp;원</td>
								</tr>

								<tr>
									<td height=28 class="01"><?=$seven05?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven06?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$seven07?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven08?>&nbsp;원</td>
								</tr>

								<tr class="01">
									<td height=28 class="01"><?=$seven09?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven10?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$seven11?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven12?>&nbsp;원</td>
								</tr>

								<?if ($seven13) { ?>
								<tr>
									<td height=28 class="01"><?=$seven13?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven14?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$seven15?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven16?>&nbsp;원</td>
								</tr>
								<?}?>

								<?if ($seven17) { ?>
								<tr class="01">
									<td height=28 class="01"><?=$seven17?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven18?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$seven19?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven20?>&nbsp;원</td>
								</tr>
								<?}?>

								<?if ($seven21) { ?>
								<tr>
									<td height=28 class="01"><?=$seven21?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven22?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$seven23?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven24?>&nbsp;원</td>
								</tr>
								<?}?>

								<?if ($seven25) { ?>
								<tr class="01">
									<td height=28 class="01"><?=$seven25?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven26?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$seven27?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven28?>&nbsp;원</td>
								</tr>
								<?}?>

								<?if ($seven29) { ?>
								<tr>
									<td height=28 class="01"><?=$seven29?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$seven30?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$nine01?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine02?>&nbsp;원</td>
								</tr>
								<?}?>

								<?if ($nine03) { ?>
								<tr class="01">
									<td height=28 class="01"><?=$nine03?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine04?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$nine05?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine06?>&nbsp;원</td>
								</tr>
								<?}?>

								<?if ($nine07) { ?>
								<tr>
									<td height=28 class="01"><?=$nine07?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine08?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$nine09?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine10?>&nbsp;원</td>
								</tr>
								<?}?>

								<?if ($nine11) { ?>
								<tr class="01">
									<td height=28 class="01"><?=$nine11?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine12?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$nine13?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine14?>&nbsp;원</td>
								</tr>
								<?}?>

								<?if ($nine15) { ?>
								<tr>
									<td height=28 class="01"><?=$nine15?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine16?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$nine17?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine18?>&nbsp;원</td>
								</tr>
								<?}?>

								<?if ($nine19) { ?>
								<tr class="01">
									<td height=28 class="01"><?=$nine19?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine20?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$nine21?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine22?>&nbsp;원</td>
								</tr>
								<?}?>

								<?if ($nine23) { ?>
								<tr>
									<td height=28 class="01"><?=$nine23?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine24?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$nine25?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine26?>&nbsp;원</td>
								</tr>
								<?}?>

								<?if ($nine27) { ?>
								<tr class="01">
									<td height=28 class="01"><?=$nine27?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine28?>&nbsp;원</td>
									<td class="03"></td>
									<td class="01"><?=$nine29?></td>
									<td width=4 class="02"></td>
									<td class="01"><?=$nine30?>&nbsp;원</td>
								</tr>
								<?}?>
								</table>

							</td>
						</tr>


						<tr><td height=10></td></tr>

						<tr><td height=28><img src="<?=$g4[path]?>/img/a02.gif" align=absmiddle><font color=#A402AA><b>소개글</b></font></td></tr>

						<tr>
							<td>

								<table width=100% border="0" cellspacing="0" cellpadding="0" style="border:1 solid #dddddd;">
								<tr>
									<td style='word-break:break-all; padding:10px;' bgcolor=#F8F8F9>

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
						</table>
					</div>

					<?//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
					<!-- 테러 태그 방지용 --></xml></xmp><a href=""></a><a href=''></a>

					<? if ($nogood_href) {?>
					<div style="width:72px; height:55px; background:url(<?=$g4[path]?>/img/good_bg.gif) no-repeat; text-align:center; float:right;">
						<div style="color:#888; margin:7px 0 5px 0;">비추천 : <?=number_format($view[wr_nogood])?></div>
						<div><a href="<?=$nogood_href?>" target="hiddenframe"><img src="<?=$g4[path]?>/img/icon_nogood.gif" align="absmiddle"></a></div>
					</div>
					<? } ?>

					<? if ($good_href) {?>
					<div style="width:72px; height:55px; background:url(<?=$g4[path]?>/img/good_bg.gif) no-repeat; text-align:center; float:right;">
						<div style="color:#888; margin:7px 0 5px 0;"><span style='color:crimson;'>추천 : <?=number_format($view[wr_good])?></span></div>
						<div><a href="<?=$good_href?>" target="hiddenframe"><img src="<?=$g4[path]?>/img/icon_good.gif" align="absmiddle"></a></div>
					</div>
					<? } ?>

				</td>
			</tr>
			<? if ($is_signature) { echo "<tr><td align='center' style='border-bottom:1px solid #E7E7E7; padding:5px 0;'>$signature</td></tr>"; } // 서명 출력 ?>

			</table>

			<br>
		</td>
		</tr>

		<tr>
		<td align=center>

			<? if ($view[wr_8]) { // 임시필드인 wr_8에 주소가 있다면 네이버 api 지도를 출력 ?>
			<table width=100% cellpadding=0>
			<tr><td height=28><img src="<?=$g4[path]?>/img/a02.gif" align=absmiddle><font color=#A402AA><b>찾아오시는 길</b></font></td></tr>
		</td>
		</tr>
		</table>
		<div align='center' style="padding:10px 0 0 0;">
		<?
		// 지도 표시
		include_once "$board_skin_path/map.php";
		?>
		</div>
		<? } ?>
		</td>
		</tr>
		<tr><td height=10></td></tr>
		<tr>
		<td>
		<?
		// 코멘트 입출력
		include_once("./view_comment.php");
		?>

		<div style="height:1px; line-height:1px; font-size:1px; background-color:#ddd; clear:both;">&nbsp;</div>

		<div style="clear:both; height:43px;">
		<div style="float:left; margin-top:10px;">
			<? if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\"><img src='$board_skin_path/img/btn_prev.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
			<? if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\"><img src='$board_skin_path/img/btn_next.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
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
include_once("./_tail.php");
?>
