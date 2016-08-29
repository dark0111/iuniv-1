<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>
					</td>						<!-- 하단부분 -->
				</tr>
				</table>
			</td>						<!-- 하단부분 -->
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td width="100%" align="center">
		<table border="0" cellspacing="0" cellpadding="0" width="950" bgcolor="#F6F6F6">
		<tr>
			<td width="59" height="108"></td>
			<td width="664">
				<!-- 하단메뉴 -->
				<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td><a href="<?=$g4[path]?>/index.php?mode=intro"><img src="<?=$g4['path']?>/main/image/btm_menu01.gif" border="0" alt="동그라미소개"></a></td>
					<td><a href='<?=$g4[path]?>/privacy.php'><img src="<?=$g4['path']?>/main/image/btm_menu02.gif" border="0" alt="개인정보보호정책"></a></td>
					<td><a href="#"><img src="<?=$g4['path']?>/main/image/btm_menu03.gif" border="0" alt="이메일무단수집거부"></a></td>
					<td><a href="#"><img src="<?=$g4['path']?>/main/image/btm_menu04.gif" border="0" alt="사이트맵"></a></td>
					<td width="149"><a href="#"><img src="<?=$g4['path']?>/main/image/btm_menu05.gif" border="0" alt="오시는길"></a></td></tr>
				<tr>
					<td colspan="5"><img src="<?=$g4['path']?>/main/image/address.gif" border="0" usemap="#ImageMap1">
						<map name="ImageMap1" onfocus="this.blur()">
						<area shape="rect" coords="8, 15, 95, 30" href="http://iuniv.kr/board/privacy.php">
						</map>
					</td>
				</tr>
				
				<tr>
					<td style='padding-left:9px;padding-bottom:2px;color:666666;font-weight:600;' colspan=5>운영자 연락처:011-9808-4553 </td>
				</tr>
				<tr>
					<td colspan="5"><img src="<?=$g4['path']?>/main/image/copyright.gif" border="0"></td>
				</tr>
				</table>
				<!-- /하단메뉴 -->
			</td>
			<td width="227"><select style="width:200px;height:17px;#;font-family:Gulim;font-size:11px;color:#868484" name="select2" onChange="javascript:openURL(this);">
							<option>::::::::학과바로가기:::::::::</option>
							<option value="http://inmun.korea.ac.kr/">::: 인문대학 :::</option>
							<option value='http://kukl.korea.ac.kr/'>- 국어국문학과</option>
							<option value='http://ell.korea.ac.kr/'>- 영어영문학과</option>
							<option value='http://german.korea.ac.kr/'>- 독일문화정보학과</option>
							<option value='http://sociology.korea.ac.kr/'>- 사회학과</option>
							<option value='http://komisa.korea.ac.kr/'>- 고고미술사학과</option>
							<option value='http://nknology.korea.ac.kr/'>- 북한학과</option>
							<option value='http://kacw.korea.ac.kr/'>- 미디어문예창작학과</option>
							<option value='http://china.korea.ac.kr/'>- 중국학부</option>
							<option value="http://st.korea.ac.kr/">:::과학기술대학:::</option>
							<option value='http://imath.korea.ac.kr/'>- 정보수학과</option>
							<option value='http://kucs.korea.ac.kr/'>- 컴퓨터정보학과</option>
							<option value='http://contents.korea.ac.kr/user/infostat/index.html'>- 정보통계학과</option>
							<option value='http://eie.korea.ac.kr/'>- 전자 및 정보공학부</option>
							<option value='http://env.korea.ac.kr/'>- 환경시스템공학과</option>
							<option value='http://biotechnology.korea.ac.kr/'>- 생명정보학과</option>
							<option value='http://kfbt.korea.ac.kr/'>- 식품생명공학과</option>
							<option value='http://aphy.korea.ac.kr/'>- 디스플레이</option>
							<option value='http://aphy.korea.ac.kr/'> ㆍ반도체물리학과</option>
							<option value='http://newchem.korea.ac.kr/'>- 신소재화학과</option>
							<option value='http://kucie.korea.ac.kr/'>- 제어계측공학과</option>
							<option value='http://sfa.korea.ac.kr/'>- 사회체육학과</option>
							<option value="http://cec.korea.ac.kr/">:::경상대학:::</option>
							<option value='http://economics.korea.ac.kr/'>- 경제학과</option>
							<option value='http://ba.korea.ac.kr/'>- 경영학부</option>
							<option value='http://mis.korea.ac.kr/'>- 경영정보학과</option>
							<option value="-1">:::공공행정학부:::</option>
							<option value='http://spa.korea.ac.kr/'>- 공공행정학부</option>
						</select>
						<!-- SAVE THE DEVELOPERS --> <a target="_blank" href="http://resistan.com/savethedeveloper/" style="display:block; display:inline-block; position:relative; white-space:nowrap; width:auto; margin:5px 0; padding:7px; border:1px solid #ccc; line-height:normal; text-decoration:none; background:#FFF;"> <span style="display:block; font:18px/18px Arial; color:#000; margin:0; padding:0; letter-spacing:-1px">SAVE THE DEVELOPERS <span style="position:absolute; cursor:pointer; display:block; top:0; right:5px; font:40px/40px 'Arial Black'; color:#000; opacity:0.25; filter:alpha(opacity=25);">&lt;<span style="font:40px/40px 'Arial Black'; color:#F00">!</span>&gt;</span></span> <span style="display:block; font:10px/10px Verdana; color:#F00; margin:0; padding:0; letter-spacing:2px">Upgrade IE 6 Now!</span> </a> <!-- /SAVE THE DEVELOPERS --> 
					</td>
				</tr>
		</table>
	</td></tr>
</table>
<!-- /하단부분 -->
</center>
</body>
</html>

<?
include_once("$g4[path]/tail.sub.php");
?>
