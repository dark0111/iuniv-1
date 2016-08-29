<?
sql_query("update room_house set back_gx=gx,back_gy=gy where gx is not null and gx!=''");
sql_query("update room_house set gx=back_gx,gy=back_gy");

?>

<script language="javascript">
function house_search(a){
	if(document.dfrm_search.search_str.value.substr(0,1)=="*"){
		document.dfrm_search.search_str.value="";
	}
	if(a=='d')
	{
		document.dfrm_search.submit();
	}
	else if(a=='s')
	{
		document.sfrm_search.submit();
	}
	else if(a=='a')
	{
		location.href='<?=$IU[home_file]?>?mode=house_list';
	}
}
</script>

<!-- 서브타이틀 -->
<table border="0" cellpadding="0" cellspacing="0" background="<?=$IU['url']?>/board/main/image/tit_bg.gif" style='background-repeat:repeat-x'>
<tr>
	<td><img src="<?=$IU['url']?>/board/main/image/tit_edge01.gif" border="0"></td>
	<td><img src="<?=$IU['sub_url']?>/house/image/tit_house_info.gif" border="0"></td>
	<td width="486" align="right" style="color:#aaabab;line-height:px"><img src="<?=$g4['path']?>/main/image/tit_icon.gif" border="0" align="absmiddle">&nbsp;Home > <b>주거정보</b></td>
	<td><img src="<?=$IU['url']?>/board/main/image/tit_edge02.gif" border="0"></td>
</tr>
</table>
<!-- /서브타이틀 -->

<!-- 공간 -->
<table border="0" cellpadding="0" cellspacing="0">
<tr><td height=10></td></tr>
<tr >
	<td align=center>
		<form name=dfrm_search method=get action='<?=$IU[home_file]?>'>
		<input type=hidden name=mode value='house_list'>
		<table width=660 cellspacing=0 cellpadding=0 border=0 >
		<tr height=27>
			
			<td style='font-weight:600'>집 이름</td>
			<td colspan=3><input type='text' name='search_str' value="*집이름을 입력후 검색" style='width:200;height=28;color=#545252;text-valign:middle;padding-top:4px;padding-left:3px;' onfocus="if (this.value == '*집이름을 입력후 검색') {this.value = '';}" onblur="if (this.value == '') {this.value = '*집이름을 입력후 검색';}">	</td>
			<td style='font-weight:600'>방 가격대</td>
			<td colspan=3><input type='text' name='price_1' style='width:83px'>&nbsp;&nbsp; ~ &nbsp;&nbsp;<input type='text' name='price_2' style='width:83px'></td>
			<td rowspan=2 >
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td width=3></td>
					<td style="cursor:hand;" onclick="javascrip:house_search('d');">
						<table border=1 bordercolor=666666 cellpadding=0 cellspacing=0 width=40 height=80>
						<tr>
							<td align=center valign=center>검색</td>
						</tr>
						</table>
					</td>
					<td width=10></td>
					<td style="cursor:hand;" onclick="javascrip:house_search('a');">
						<table border=1 bordercolor=666666 cellpadding=0 cellspacing=0 width=80 height=80>
						<tr>
							<td align=center valign=center>전체보기</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr height=27>
			<td style='font-weight:600'>전,월세	</td>
			<td>
				<select name="house_ym_type" style='width:83;'>
				<option value="">-전체-</option>
				<?=select_option('house_ym_type','');?>
				</select>
			</td>
			<td style='font-weight:600'>구조</td>
			<td>
				<select name="room_type" style='width:83'>
				<option value="">-전체-</option>
				<?=select_option('room_type','');?>
				</select>
			</td>
			<td style='font-weight:600'>거리</td>
			<td>
				<select name="fit_type" style='width:83'>
				<option value="">-전체-</option>
				<?=select_option('fit_type','');?>
				</select>
			</td>
			<td style='font-weight:600'>&nbsp;크기</td>
			<td>
				<select name="room_size" style='width:83'>
				<option value="">-전체-</option>
				<?=select_option('room_size','');?>
				</select>
			</td>
		</tr>
		</table>
		</form>
	</td>
</tr>
<tr><td height=10></td></tr>
</table>
<!-- /공간 -->

<!-- 게시판 -->
<table border="0" cellpadding="0" cellspacing="0">

<tr>
	<td colspan='3'><!-- 서브메인시작 -->
		<table width='660' cellspacing='0' cellpadding='0' border=0>
			<tr valign='top'>
			<td width='2'></td>	
			<td width='345' style='padding-top:17px'>	
				<!-- 방거래 -->				
				<table width='440' cellspacing='0' cellpadding='0'>
				<tr valign='top'>
					<td height='17' class='tit01'><img src="<?=$IU['sub_url']?>/house/image/stit_roommarket.gif" border="0" align="absmiddle"></td>
					<td align='right'><a href='<?=$IU[board]?>/bbs/board.php?bo_table=house_deal'><img src='<?=$IU['sub_url']?>/house/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				<tr><td height='1' colspan='2' bgcolor='#8FD7EC'></td></tr>
				</table>
				
				<table width='440' cellspacing='0' cellpadding='0'>
				<tr><td height='10'></td></tr>
				<tr>
					<td><?
					latest('basic',house_deal,10, 60,'none_title');
					?></td>
				</tr>
				<tr><td height='24'></td></tr>
				</table>
				<!-- //방거래 -->
				<!-- 룸메이트 -->				
				<table width='440' cellspacing='0' cellpadding='0'>
				<tr valign='top'>
				<td height='17' class='tit01'><img src="<?=$IU['sub_url']?>/house/image/stit_roommate.gif" border="0" align="absmiddle"></td>
				<td align='right'><a href='<?=$IU[board]?>/bbs/board.php?bo_table=room_mate'><img src='<?=$IU['sub_url']?>/house/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				<tr><td height='1' colspan='2' bgcolor='#8FD7EC'></td></tr>
				</table>
				
				<table width='440' cellspacing='0' cellpadding='0'>
				<tr><td height='10'></td></tr>
				<tr>
					<td><?
					latest('basic',room_mate,6, 60,'none_title');
					?></td>
				</tr>
				<tr><td height='24'></td></tr>
				</table>
				<!-- //룸메이트 -->				
			</td>
			<td width=15></td>
			<td width='198' align='center' bgcolor='#F3F2EE' style='padding:16px 0px 10px 10px'>

			
				<table width='188' cellspacing='0' cellpadding='0' border=0>
				<tr valing='top'>
					<td height='18' class='brn02 b2 dm'><img src="<?=$IU['sub_url']?>/house/image/stit_newcomment.gif" border="0" align="absmiddle"></td><td align='right'><a href='<?=$IU[url]?>/index.php?mode=house_list'><img src='<?=$IU['sub_url']?>/house/image/btn_more.gif' alt='더보기' width='37' height='10' style='margin:1px 5px 0 0'></a></td>
				</tr>
				</table>
				
				<table border='0' width='184' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' style='border:1px solid #DFDED9'>
				<?

				
				$cquery="
				select 
					H.phone,H.mphone,H.add1,H.add2,H.h_cd,H.h_nm  
				from 
					room_house as H,
					(select distinct h_id from h_comment order by id desc limit 4) as  C
				where 
					H.h_cd=C.h_id and
					H.open='yes'
				limit 4
				";
				
				$result = sql_query($cquery);
				for($i=0;$row = sql_fetch_array($result);$i++)
				{
					
					
					$tel_info="";
					if($row[phone])
					{
						$tel_info.=$row[phone];
					}
					if($row[mphone])
					{
						if($tel_info)$tel_info.="<br>";
						$tel_info.=$row[mphone];
					}

					$address_info=$row[add1].$row[add2];


					$img_sql = " select I_id, I_classify, I_classify_id, I_filename from room_imageinfo where I_classify ='H' and I_classify_id='$row[h_cd]' order by priority desc,I_id asc limit 1";
				
					$result_img_sql = sql_fetch($img_sql);
					//FILTER: alpha(opacity=300, style=3, finishopacity=30);
					$result_img_sql[I_filename]=str_replace('gif','jpg',$result_img_sql[I_filename]);
					if($result_img_sql[I_filename]!="")
					{
						$thm_image=$g4['house_img_path']."thumbOpen2/".$result_img_sql[I_filename];
					}
					else
					{
						$thm_image=$g4[path]."/img/no_img.gif";
					}
				?>
				<tr>
					<td align='center' style='padding:10px 0 2px 0'>
						<table width='175' cellspacing='0' cellpadding='0'>
						<tr>
							<td align='center'><a href='<?=$IU[home_file]?>?mode=house_view&h_cd=<?=$row[h_cd]?>'><img src='<?=$thm_image?>' width='80' height='80' style='border:1 #E7E7E7 solid' style=" CURSOR: pointer"></a>
							</td>
							<td align="center" style='word-break:break-all' width=100><a href='<?=$IU[home_file]?>?mode=house_view&h_cd=<?=$row[h_cd]?>'><?=cut_str($row[h_nm],48,'..')?><br><font color='orange'><b><?=$tel_info?></font></b><br><?=$address_info?></a></td>
						</tr>						
						</table>
					</td>
				</tr>
				<?}?>
				</table>				

			</td>
			</tr>
		</table><!--// 서브메인내용 -->
	</td>
</tr>
<!-- <tr>
	<td>
		<?
			include"./house_main_gallery1.php";
		?> 
	</td>
</tr> -->
<tr>
	<td colspan="3" width="630">
		<a name='recommendation'></a>
		<table border="0" cellpadding="0" cellspacing="0" width="630" cellpadding=5 cellspacing=5>
		<tr height='15'><td width='110'>&nbsp;</td><td width='280'>&nbsp;</td><td width='120'>&nbsp;</td><td width='40'>&nbsp;</td></tr>
		<tr valign='top'>
			<td height='17' class='tit01' colspan='3'><img src="<?=$IU['sub_url']?>/house/image/addtit_comm_house.gif" border="0" align="absmiddle"> 광고공간 - darkmong0111@gmail.com 으로 메일 주세요</td>
			<td align='right' valign='middle'></td>
		</tr>
		<tr><td height='1' bgcolor='#8FD7EC' colspan='4'></td></tr>
		 <tr>

			<td align='center' colspan=4 style='padding:10px 0 2px 0'>
			광고공간 - darkmong0111@gmail.com 으로 메일 주세요
			</td>
		</tr> 
	<!--
		<tr>
			<td align='center' style='padding:10px 0 2px 0'>
				<table width='650' cellspacing='0' cellpadding='0' border=0>
				<tr>
					<td align="center" width=250><a href='<?=$IU[home_file]?>?mode=house_view&h_cd=83'><h3>춘강하우스 &nbsp;&nbsp;:&nbsp;&nbsp;<font color='orange'><b> 010  5453  8533 </a></b></font></h3></td>
				</tr>
				<tr>
					<td align='center' colspan=2><a href='<?=$IU[home_file]?>?mode=house_view&h_cd=83'><img src='<?=$IU['sub2_url']?>/image/addchunggang.PNG'  style='border:1 #E7E7E7 solid' style=" CURSOR: pointer"></a>
					</td>
				</tr>
				<tr>
					
					<td  style='line-height:160%;padding-left:10px' width=550><a href='<?=$IU[home_file]?>?mode=house_view&h_cd=83'> 고려대정문에서 도보5분, 자전거1분 거리에 위치한 "춘강하우스" 입니다.

조치원역까지는 도보10분, 서울가는 고속버스정류장까지는 도보5분 거리입니다.
학생 생활에 필요한 모든 집기류가 준비되어 있읍니다.

특히, 세탁기는 각방에 한개씩 "드럼세탁기"가 설치되어 있읍니다.

(무료) 인터넷은  KT광랜이 설치되어 있습니다. 

겨울난방은 "심야전기"를 이용해서, 아주 저렴하게 따뜻하게 지내실수 있읍니다.

자전거를 이용해서, 다니실 분들을 위해서, 자전거 보관대도 설치되어 있읍니다.

다양한 휴식을 위해서, 넓은 정원과, 산뜻한 벤치도 준비되어 있읍니다.
</a></td>
				</tr>
				
				</table>
			</td>
		</tr>	-->
		<!-- 세영오피스텔 광고 시작: 2014-10-27일 -->
		<!-- 세영오피스텔 광고 삭제함: 2015-12-03일 -->
		<!-- <tr>
			<td align='center' style='padding:10px 0 2px 0'>
				<table width='650' cellspacing='0' cellpadding='0' border=0>
				<tr>
					<td align='center' width=130><a href='<?=$IU[home_file]?>?mode=house_view&h_cd=154'><img src='<?=$IU['sub_url']?>/house/image/seyoundadd.jpg' width='120' height='100' style='border:1 #E7E7E7 solid' style=" CURSOR: pointer"></a>
					</td>
					<td align="center" width=250><a href='<?=$IU[home_file]?>?mode=house_view&h_cd=154'>세영오피스텔<br><font color='orange'><b>010-5433-5745 </a></b></font><br>세종특별자치시 조치원읍 서창리 295-2</td>
					<td  style='line-height:160%;padding-left:10px' width=550><a href='<?=$IU[home_file]?>?mode=house_view&h_cd=154'>현직 건축가가 건축주로서 설계 및 시공에 참여했습니다. 건물 맞은편에 바로 육교가 있어 차량과 도로 모두 
이용이 용이 합니다. 세영오피스텔의 규모는 지상6층의 규모로 엘리베이터가 설치되어 있습니다. 
세영오피스텔의 출입구에는 방범용 현관도어시스템과 CCTV가 설치 되어있습니다. 또 건물 내에 오피스텔을 
관리하시는 아주머니가 상주하고 계시기 때문에 건물이 깨끗이 유지되고 건물 내의 사건사고 방지에 유리합니다. 
세영오피스텔은 다양한 타입의 방을 제공합니다. 혼자 지낼 수 있는 원룸형, 취침실이 
분리된 복층형, 두 사람이 이용할 수 있는 투룸형 등이 있습니다. 세영오피스텔에 두개의 계단과 소방시설을 
완비하여 대형 사고를 피할 수 있습니다.도시가스 인입으로 개별난방과 개별온수 공급에 문제가 없어, 
온수이용이 용이합니다.  </a></td>
				</tr>						
				</table>
			</td>
		</tr> 
		<tr>
			<td colspan="4"><img src="<?=$IU['sub_url']?>/community/image/dot_line.gif" border="0"></td>
		</tr> -->
		
		</table>
		
	</td>
</tr>
<tr>
	<td colspan="3" width="630">
		<!-- 이미지겔러리 --><a name='recommendation'></a>
		<table border="0" cellpadding="0" cellspacing="0" width="630" cellpadding=5 cellspacing=5>
		<tr height='15'><td width='110'>&nbsp;</td><td width='280'>&nbsp;</td><td width='120'>&nbsp;</td><td width='40'>&nbsp;</td></tr>
		<tr valign='top'>
			<td height='17' class='tit01' colspan='3'><img src="<?=$IU['sub_url']?>/house/image/stit_comm_house.gif" border="0" align="absmiddle"></td>
			<td align='right' valign='middle'></td>
		</tr>
		<tr><td height='1' bgcolor='#8FD7EC' colspan='4'></td></tr>
		<?
		$best_house_array=array();
		//$best_house_array[]='107';//이소예씨댁
		//$best_house_comment[107]="하숙하실 학생들에게 추천한는 집 입니다. 가격도 저렴한편이며, 식사주시고 다소 작은 방이긴 하나 혼사 쓰기엔 충분하다 봅니다.";
		//$best_house_array[]='13';//한솔하우스
		//$best_house_comment[13]="조여고쪽 육교 근처 학교 방향에 있는 한솔하우스는 직접 살아본 학생들의 평이 좋은 집입니다. 특히나 1층에서 한솔마트를 운영하시는 주인아저씨의 친절함은 소문이 자자 합니다.";
		//$best_house_array[]='14';//무지개하우스
		//$best_house_comment[14]="과학기술대학 바로 밑에 위치하고 있는 무지개 하우스는 하숙을 겸하고 있습니다. 경쟁이 치열한 방이기에 원하시는 분은 겨울 방학이 끝나기 전에 미리 계약 하시기 바랍니다.";
		$best_house_array[]='103';//스마일 하우스
		$best_house_comment[103]="주로 소음을 피해 고학번들이 즐겨 찾는 신안리에 위치하고 있는 스마일 하우스....집 앞으로 은하수 마트 가 있고 주차장이 따로 마련되어 있습니다. 가장 중요한 가격이 저렴하고 동일 건물 3층에 거주하고 있으시는 주인분들이 참 친절하십니다. 학생의 불편을 최소화 하고자 노력 하십니다.";
		
		
		
		//$best_house_array[]='116';//신동아
		//$best_house_comment[116]="2009년 신축 아파트 건물 입니다. 도난 이나 보안이 걱정 이시라면 주변 지역에서 가장 안전하지 않을까 생각합니다. 친절하신 주인 아주머니와 아주 잘 갖추어진 주방, 넓은 거실,쾌적한 화장실 등 시설면에서는 동급 최강(^^) 입니다. 시설에 비해 저렴한 가격또한 매력적입니다.";
		
		
		$best_house_array[]='97';//유니크하우스
		$best_house_comment[97]="최근 들어 하숙집들이 줄어 들었습니다. 유니크 하우스는  전세 찾기가 힘든 가운데 다른 곳에 비해 저렴한 가격으로 전세 방을 구할 수 있는 집입니다. 단, 전세시 공과금은 별도 입니다. 년세 방값 250 이고, 하숙시 밥값 월 25만원 입니다. 하숙시 공과금 일체 없습니다. 하숙집이지만 학생들 방과 주인댁과의 입구도 따로 있고 일반 원룸형태 입니다. 개인 생활하는데 불편함 없으리라 생각됩니다.";
		
		$best_house_array[]='36';//대원빌리지
		$best_house_comment[36]="쾌적한 환경에서 생활을 하고 싶으십니까? 안전이 걱정 되십니까? 학교 정문 옆의 대원빌리지를 추천 드립니다. 전문 관리자 분이 항시 상주하시며 입주자들의 불편함을 해결해 드립니다. 넓은 방과 깨끗한 가구, 시원한 에어콘,방과 분리되어 있는 부엌,자유롭게 사용가능한 공용 정수기와 세탁기 ,거기에 2인용 식탁까지 부족한게 없는 원룸 입니다. 또한 오토바이,자전거,자동차를 소지하신 분들은 넓은 전용주차장을 이용하실 수 있습니다. 요즘 여러 도난 사건이 많은데 이런 걱정을 한번에 떨쳐 버릴수 있는곳 바로 대원 빌리지 입니다.";
		
		$best_house_array[]='59';//유니빌
		$best_house_comment[59]="고대 홍대 주변지역 중 단연 최고의 시설을 자랑하는 곳입니다. 24시간 전문 경비 상주, 큰길가라서 안전하고 학생들을 위한 등,하교 셔틀 운행, 기타 풀옵션의 방 등등 머하나 부족하지 않은곳, 유니빌 입니다.  전세,임대,년월세 다양한 거래 기준이 있고 세대별 스프링쿨러 등 소방시설 완비된 전용 원룸 입니다.";
		
		//$best_house_array[]='43';//고대원룸
		//$best_house_comment[43]="주변에 넘처나는 원룸들이 있습니다. 신축도 많고 리모델링된 건물도 많죠. 하지만 그 화려함 만큼이나 가격이 부담되는 분들이 있으실 것입니다. 여기 저렴한 가격에 친절한 주인분까지 있는 집을 소개 드립니다. 바로 고대원룸 인데요 조여고에서 태주원룸 사이에 위치하고 있습니다. 빌딩형 원룸들에 비해 넓지도 않고 겉모습이 화려하지도 않지만 정말 실용적인 집을 찾으시는 분께 추천해 드리겠습니다. 타 빌딩형 원룸들의 반 가격이면 1년을 편안하게 생활 하실수 있습니다. 학교 주변 상권밀집 지역에서 조금 떨어져 있기에 조용합니다. 학생의 본분에 충실 하실분 구경한번 해보세요~";
		
		

		

		//$best_house_array[]='113';//대창아튼빌
		//$best_house_comment[113]="주소상 서창리 이고 침산리에 더 가까운 대창 아튼빌 입니다. 조여고 쪽 육교 에서 욱일아파트 방향에 있는 조용한 집입니다. 2007년 후반기에 완공된 깨끗한 건물,욱일 아파트 상권과 걸어서 5분거리라서 편의점,식당 등을 이용하기에 좋습니다. 총 5층으로 이루어진 건물에 학교 근처 건물에선 보기 드물에 엘리베이터가 있어 고층 거주도 불편함이 없습니다.";

		for($i=0;$i<count($best_house_array);$i++)
		{
			$que="select * from room_house where h_cd='$best_house_array[$i]'";
			
			$result = sql_query($que);
			$row = sql_fetch_array($result);
			$tel_info="";
			if($row[phone])
			{
				$tel_info.=$row[phone];
			}
			if($row[mphone])
			{
				if($tel_info)$tel_info.="<br>";
				$tel_info.=$row[mphone];
			}

			$address_info=$row[add1].$row[add2];


			$img_sql = " select I_id, I_classify, I_classify_id, I_filename from room_imageinfo where I_classify ='H' and I_classify_id='$row[h_cd]' order by priority desc,I_id asc limit 1";
		
			$result_img_sql = sql_fetch($img_sql);
		?>
		<tr>
			<td align='center' style='padding:10px 0 2px 0'>
				<table width='650' cellspacing='0' cellpadding='0' border=0>
				<tr>
					<td align='center' width=130><a href='<?=$IU[home_file]?>?mode=house_view&h_cd=<?=$row[h_cd]?>'><img src='<?if($result_img_sql[I_filename]!=""){echo$g4['house_img_path'].$result_img_sql[I_filename];}else{echo$g4[path]."/img/no_img.gif";}?>' width='120' height='100' style='border:1 #E7E7E7 solid' style=" CURSOR: pointer"></a>
					</td>
					<td align="center" width=250><a href='<?=$IU[home_file]?>?mode=house_view&h_cd=<?=$row[h_cd]?>'><?=cut_str($row[h_nm],48,'..')?><br><font color='orange'><b><?=$tel_info?></a></b></font><br><?=$address_info?></td>
					<td  style='line-height:160%;padding-left:10px' width=550><a href='<?=$IU[home_file]?>?mode=house_view&h_cd=<?=$row[h_cd]?>'><?=$best_house_comment[$best_house_array[$i]]?></a></td>
				</tr>						
				</table>
			</td>
		</tr>
		<?}?>
		<tr>
			<td colspan="4"><img src="<?=$IU['sub_url']?>/community/image/dot_line.gif" border="0"></td>
		</tr>

		</table>
		<!-- /이미지겔러리 -->
	</td>
</tr>
</table>
<!-- /게시판 -->
<Br><br>