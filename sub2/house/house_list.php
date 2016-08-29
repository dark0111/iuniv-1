<?

//////////////////////////////
$page			 = $_REQUEST["page"]; 
/////////검색조건/////////////
$search_str		 = $_REQUEST["search_str"]; 
$house_ym_type	 = $_REQUEST["house_ym_type"]; 
$room_type		 = $_REQUEST["room_type"]; 
$fit_type		 = $_REQUEST["fit_type"]; 
$room_size		 = $_REQUEST["room_size"]; 
$price_1		 = $_REQUEST["price_1"]; 
$price_2		 = $_REQUEST["price_2"]; 
$hasuk_yn		 = $_REQUEST["hasuk_yn"]; 
/*
echo "search_str==>".$search_str."<Br>";
echo "house_ym_type==>".$house_ym_type."<Br>";
echo "room_type==>".$room_type."<Br>";
echo "fit_type==>".$fit_type."<Br>";
echo "room_size==>".$room_size."<Br>";
echo "price_1==>".$price_1."<Br>";
echo "price_2==>".$price_2."<Br>";
*/
$search_str_e=urlencode($search_str);
////////////////////////////////////////////////////////
//$qstr = "search_str=$search_str_e&house_ym_type=$house_ym_type&room_type=$room_type&fit_type=$fit_type&room_size=$room_size&price_1=$price_1&price_2=$price_2&order=$order&add_div=$add_div";

$qstr_array=array();
$qstr_array[]="mode=$mode";
$qstr_array[]="search_str=$search_str_e";
$qstr_array[]="house_ym_type=$house_ym_type";
$qstr_array[]="room_type=$room_type";
$qstr_array[]="fit_type=$fit_type";
$qstr_array[]="room_size=$room_size";
$qstr_array[]="price_1=$price_1";
$qstr_array[]="price_2=$price_2";
$qstr_array[]="order=$order";
$qstr_array[]="add_div=$add_div";
$qstr_array[]="hasuk_yn=$hasuk_yn";
$qstr=implode('&',$qstr_array);

$qstr_array_temp=$qstr_array;
array_splice($qstr_array_temp,-2,1);
$qstr_order=implode('&',$qstr_array_temp);

$qstr_array_temp=$qstr_array;
array_splice($qstr_array_temp,-1,1);
$qstr_adddiv=implode('&',$qstr_array_temp);

//print($qstr_adddiv);echo"<br><br>";

$view_qstr = "search_str=$search_str_e&house_ym_type=$house_ym_type&room_type=$room_type&fit_type=$fit_type&room_size=$room_size&price_1=$price_1&price_2=$price_2&order=$order&page=$page&add_div=$add_div&hasuk_yn=$hasuk_yn";



if($search_str!='*집이름을 입력후 검색' && $search_str ){//집이름 검색어 검색 조건처리
	$where_str =" and h_nm like '%$search_str%' ";
}
if($room_type){//room_type 검색 조건처리
	
	$where_str .= " and room_type = '$room_type' ";
}
if($add_div){//add_div 지역 검색 조건처리
	
	$where_str .=" and add_div = '$add_div' ";
}
if($fit_type){//거리조건
	$where_str .=" and a.fit = '$fit_type' ";
}


if($house_ym_type!=""||$price_1!=""||$price_2!=""||$fit_type!=""||$room_size!=""){
	$where_str2 = " where ";
}else{
	$where_str2 = "";
}

if($house_ym_type!=""){
	if($house_ym_type=="A"){//room_type 검색 조건처리
		$where_str2 .=" charter_price > '0' ";
		if($price_1!=""){//전세 월세 타입선택 가격 조건 price_1 검색 조건처리
			$where_str2 .=" and charter_price >= '$price_1' ";
		}
		if($price_2!=""){//전세 월세 타입선택 가격 조건 price_2 검색 조건처리
			$where_str2 .=" and charter_price <= '$price_2' ";
		}
	}elseif($house_ym_type=="B"){
		$where_str2 .=" monthly_price > '0' ";
		
		if($price_1!=""){//전세 월세 타입선택 가격 조건 price_1 검색 조건처리
			$where_str2 .=" and monthly_price >= '$price_1' ";
		}

		if($price_2!=""){//전세 월세 타입선택 가격 조건 price_2 검색 조건처리
			$where_str2 .=" and monthly_price <= '$price_2' ";
		}
	}
	if($order=="cheap"){
		$where_str2 .=" and b.avg_mon_price > '1' ";
	}
}else{	//전세월세 조건 없이 가격 범위실행
	if($price_1!=""&&$price_2!=""){		
			$where_str2 .=" monthly_price >= '$price_1' ";
			$where_str2 .=" and monthly_price <= '$price_2' ";		
	}else{
		if($price_1!=""){//전세 월세 타입없이 우선순위월세 가격 조건 price_1 검색 조건처리
			$where_str2 .=" monthly_price = '$price_1' ";
		}
		if($price_2!=""){//전세 월세 타입없이 우선순위월세 가격 조건 price_2 검색 조건처리
			$where_str2 .=" monthly_price = '$price_2' ";
		}
	}
	
}

if($order=="cheap"){
	$where_str3 .="and b.avg_mon_price > 1 ";
}

if($hasuk_yn=="Y"){
	$where_str3 .="and a.hasuk_yn = 'Y' ";
}

//$where_str3 .="and a.open = 'yes' ";

if($room_size!=""){//방크기조건
	$rsize_div = explode("|",$room_size);
	if($house_ym_type!=""||$price_1!=""||$price_2!=""){
		$where_str2 .=" and (((row_size*col_size)/10000)/3.3)>=$rsize_div[0] ";
		if($rsize_div[1]!=""){
			$where_str2 .=" and (((row_size*col_size)/10000)/3.3)<$rsize_div[1] ";
		}
	}else{
		$where_str2 .=" (((row_size*col_size)/10000)/3.3)>=$rsize_div[0] ";
		if($rsize_div[1]!=""){
			$where_str2 .=" and (((row_size*col_size)/10000)/3.3)<$rsize_div[1] ";
		}
	}
}
if($order=='name'){
	$order_by="a.h_nm asc";
}elseif($order=='luxury'){
	$order_by="b.avg_mon_price desc";
}elseif($order=='cheap'){
	$order_by="b.avg_mon_price asc";
}elseif($order=='quiet'){
	$order_by="a.quiet_point desc";
}elseif($order=='good_point'){
	$order_by="a.good_point desc";
}else{
	$order_by="a.h_visit desc,a.h_nm asc";
	//$order_by="a.h_cd desc";	
}
////////////////////////////////////////////////////////

$sql_c = " 
	select 
		count(*) as cnt 
	from (
			SELECT 
				a.h_cd, 
				a.add_div, 
				a.owner_cd, 
				a.h_nm, 
				a.open, 
				a.add1, 
				a.add2, 
				a.zipcode, 
				a.build_year, 
				a.owner_stay_type, 
				a.exp, a.html, 
				a.phone, 
				a.mphone, 
				a.owner_stay_exp, 
				a.room_type, 
				a.gx, 
				a.gy, 
				b.h_cd as where_yn, 
				b.avg_mon_price, 
				a.recommend, 
				a.quiet_point, 
				a.hasuk_yn   
			FROM 
				room_house as a, 
				(
					select 
						h_cd, 
						(sum(monthly_price))/count(monthly_price) as avg_mon_price  
					from 
						room_room 
					$where_str2 
					group by h_cd 
				) as b 
				WHERE 
					a.h_cd = b.h_cd 
					$where_str3 
		) as room_house  ";

$sql_c = $sql_c." where open='yes' ".$where_str;



$result_c = sql_query($sql_c);
$row_c = sql_fetch_array($result_c);
$total_count=$row_c[cnt];
$page_rows=10;
$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함
$write_pages = get_paging($config[cf_write_pages], $page, $total_page, "$IU[home_file]?mode=house_list&".$qstr."&page=");



$sql = " select * from (SELECT a.h_cd, a.add_div, a.owner_cd, a.h_nm,a.open, a.add1, a.add2, a.zipcode, a.build_year, a.owner_stay_type, a.exp, a.html, a.phone, a.mphone, a.owner_stay_exp, a.room_type, a.gx, a.gy, b.h_cd as where_yn, b.avg_mon_price, a.recommend, a.quiet_point, a.hasuk_yn FROM room_house a, (select h_cd, (sum(monthly_price)+sum(m_credit_price))/count(monthly_price) as avg_mon_price  from room_room $where_str2 group by h_cd  ) b WHERE a.h_cd = b.h_cd $where_str3 order by $order_by) room_house ";
$sql = $sql."where open='yes' ".$where_str;

$sql = $sql." limit $from_record,$page_rows ";

$result = sql_query($sql);
$page_total_count = mysql_num_rows($result);


if($order=='name')
{
	$o_style2="";
	$o_style1="font-weight:600";
}
else
{
	$o_style1="";
	$o_style2="font-weight:600";
}

if($add_div=='sa')
{
	$o_style5=$o_style4="";
	$o_style3="font-weight:600";
}
elseif($add_div=='sc')
{
	$o_style5=$o_style3="";
	$o_style4="font-weight:600";
}
else
{
	$o_style4=$o_style3="";
	$o_style5="font-weight:600";
}
?>
<script language='javascript'>
	function search_div()
	{
		document.getElementById('s_search_tr').style.display='none';
		document.getElementById('d_search_tr').style.display='';
	}
</script>
<!-- 서브타이틀 -->
<table border="0" cellpadding="0" cellspacing="0" background="<?=$IU['board']?>/main/image/tit_bg.gif">
	<tr>
		<td><img src="<?=$IU['board']?>/main/image/tit_edge01.gif" border="0"></td>
		<td><img src="<?=$IU[sub_url]?>/house/image/stit_house_info.gif" border="0"></td>
		<td width="486" align="right" valign="middle"  style="color:#aaabab;"><img src="<?=$IU['board']?>/main/image/tit_icon.gif" border="0" align="middle">&nbsp;Home > 주거정보 > <b>자취/하숙정보</b></td>
		<td><img src="<?=$IU['board']?>/main/image/tit_edge02.gif" border="0"></td>
	</tr>
</table>
<br>
<!-- /서브타이틀 -->
<table width="100%" cellpadding=0 cellspacing=0>
<tr style='display:none' id='d_search_tr'>
	<td align=center>
		<form name=dfrm_search method=post action='<?=$IU['home_file']?>'>
		<input type=hidden name=mode value='house_list'>
		<table width=650 cellspacing=0 cellpadding=0 style='border:1px solid #cccccc;background-color:#eeeeee'>
		<tr height=27>
			<td width=10></td>
			<td style='font-weight:600'>집 이름</td>
			<td colspan=3><input type='text' name='search_str' value="*집이름을 입력후 검색" style='width:220;height=28;color=#545252;text-valign:middle;padding-top:4px;padding-left:3px;' onfocus="if (this.value == '*집이름을 입력후 검색') {this.value = '';}" onblur="if (this.value == '') {this.value = '*집이름을 입력후 검색';}">	</td>
			<td style='font-weight:600'>방 가격대</td>
			<td colspan=3><input type='text' name='price_1' style='width:83'>&nbsp;&nbsp; ~ &nbsp;&nbsp;<input type='text' name='price_2' style='width:83'></td>
			<td rowspan=2 style="cursor:hand;" onclick="javascrip:house_search('d');">
				<table border=1 bordercolor=666666 cellpadding=0 cellspacing=0 width=80 height=80>
				<tr>
					<td align=center valign=center>검색</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr height=27>
			<!-- <td style='font-weight:600'>전세/월세	</td>
			<td>
				<select name="house_ym_type" style='width:83;'>
				<option value="">-전체-</option>
				<?=select_option('house_ym_type','');?>
				</select>
			</td> -->
			<td width=10></td>
			<td style='font-weight:600'>지역	</td>
			<td>
				<select name="add_div" style='width:83;'>
				<option value="">-전체-</option>
				<?=select_option('add_div','');?>
				</select>
			</td>
			<td style='font-weight:600'>방구조</td>
			<td>
				<select name="room_type" style='width:83'>
				<option value="">-전체-</option>
				<?=select_option('room_type','');?>
				</select>
			</td>
			<td style='font-weight:600'>통학거리</td>
			<td>
				<select name="fit_type" style='width:83'>
				<option value="">-전체-</option>
				<?=select_option('fit_type','');?>
				</select>
			</td>
			<td style='font-weight:600'>&nbsp;방크기</td>
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
<tr style='display:' id='s_search_tr'>
	<td align=right>
		
		<form name=sfrm_search method=post action='<?=$IU[home_file]?>'>
		<input type=hidden name=mode value='<?=$mode?>'>
		<table  cellspacing=0 cellpadding=0 border=0 >
		<tr height=27>			
			
			<td colspan=3><input type='text' name='search_str' value="*집이름을 입력후 검색" style='width:170;height=28;color=#545252;text-valign:middle;padding-top:4px;padding-left:3px;' onfocus="if (this.value == '*집이름을 입력후 검색') {this.value = '';}" onblur="if (this.value == '') {this.value = '*집이름을 입력후 검색';}" tabindex="1">	</td>			
			<td align=center>&nbsp;<img src="<?=$g4[path]?>/img/search_btn.gif"' border=0 style="cursor:hand;" onclick="javascrip:house_search('s'); " tabindex="2"></td>
			<td width=10></td>
			<td><a style='cursor:pointer' onclick="search_div();"><b>상세검색</b></a></td>
			<td width=30></td>
			<td align=right>
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td style='font-weight:600'>정렬:</td>
					<td style='font-size:11pt;<?=$o_style1?>'><a href='<?=$IU[home_file]?>?order=name&<?=$qstr_order?>'  class="blue">이름순</a></td>
					<td width=10></td>
					<td style='font-size:11pt;<?=$o_style2?>' ><a href='<?=$IU[home_file]?>?order=visit&<?=$qstr_order?>'  class="blue">조회순</a></td>
					<td width=30 align=center><b>/</b></td>
					<td style='font-weight:600'>검색:</td>
					<td style='font-size:11pt;<?=$o_style3?>' ><a href='<?=$IU[home_file]?>?add_div=sa&<?=$qstr_adddiv?>'  class="blue">신안리</a></td>
					<td width=10></td>
					<td style='font-size:11pt;<?=$o_style4?>' ><a href='<?=$IU[home_file]?>?add_div=sc&<?=$qstr_adddiv?>'  class="blue">서창리</a></td>
					<td width=10></td>
					<td style='font-size:11pt;<?=$o_style5?>' ><a href='<?=$IU[home_file]?>?add_div=&<?=$qstr_adddiv?>'  class="blue">전체</a></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
		</form>
	</td>
</tr>
<iframe name=hidden_frame width=0 height=0></iframe>

<tr><td height=10></td></tr>
<tr>
	<td align=center>
		<table border=0 cellpadding=0 cellspacing=0 width=680>
		<tr>
		<?
	if($page_total_count>0){
		for($i=1;$i<=$page_total_count;$i++)
		{
			$row = sql_fetch_array($result);
			$tel_info="";
			if($row[phone])
			{
				$tel_info.=$row[phone]."<br>";
			}
			if($row[mphone])
			{
				$tel_info.=$row[mphone];
			}

			$address_info=$row[add1].$row[add2];


			$img_sql = " select I_id, I_classify, I_classify_id, I_filename from room_imageinfo where I_classify ='H' and I_classify_id='$row[h_cd]' order by priority desc ,I_id  limit 1";
			//	echo "img_sql====>".$img_sql."<br>";
			$result_img_sql = sql_fetch($img_sql);
			//echo "result_img_sql[filename]====>".$result_img_sql[I_filename]."<br>";

			$comment_sql = " select count(*) total from h_comment where h_id ='$row[h_cd]' ";
			//	echo "img_sql====>".$img_sql."<br>";
			$result_comment_sql = sql_fetch($comment_sql);
			
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
			<td width=50%>
				<table width=98% cellpadding=0 cellspacing=0 style="border:1 solid #dddddd;">
				<tr><td colspan="2" height=3 bgcolor=#CFCFCF></td></tr>
				<tr>
					<td height=28 width=100% colspan="2" bgcolor="#F3F3F3" style='padding-left:20px'>
						&nbsp;<a href='<?=$IU[home_file]?>?mode=house_view&h_cd=<?=$row[h_cd]?>&<?=$view_qstr?>' class='text'><b><span style='font-family:Tahoma;font-size:9pt;color:#555555;'><?=$row[h_nm]?></span></b></a>
						<?
						if($is_admin)
						{
						?>
						<a href='<?=$IU[sub_url]?>/house/house_hit_update.php?mode=down&h_cd=<?=$row[h_cd]?>' target='hidden_frame'>[↓]</a><a href='<?=$IU[sub_url]?>/house/house_hit_update.php?mode=up&h_cd=<?=$row[h_cd]?>'  target='hidden_frame'>[↑]</a>
						<?
						}
						?>
				</tr>
				<tr><td height=1 colspan=2 bgcolor=#CCCCCC></td></tr>
				<tr><td colspan=2 height=2></td></tr>

				<tr>
					<td width="130" height="110" align=center>

						<table cellpadding=0 cellspacing=0>
						<tr>
							<td style="padding:2px;">
								<a href='<?=$IU[home_file]?>?mode=house_view&h_cd=<?=$row[h_cd]?>&<?=$view_qstr?>'><img src='<?=$thm_image?>' width='120' height='100' style='border:1 #E7E7E7 solid'></a>					
							</td>
						</tr>
						</table>
					</td>

					<td align=left >
						<table width=100% cellpadding=2 cellspacing=0 border=0>
						<tr>
							<td align=right width=50>문의 :</td>
							<td align=left><font color=FF8000><strong> <?=$tel_info?></strong></font>
						</tr>
						<tr>
							<td align=right>건축일 :</td>
							<td align=left><?=$row[build_year]?>년</td>

						</tr>
						<tr>
							<td align=right>주소 :</td>
							<td><?=$address_info?></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" height=25 bgcolor=#F1F1F1 align=right style="padding:3px;"> (<?=$result_comment_sql[total]?>)개의 고객평가가 있습니다. </td>
				</tr>
				</table>
			</td>
		<?
			if($i%2!=0)
			{
			echo"<td width=10></td>";
			}
			else
			{
				echo"
				</tr>
				<tr><td height=15></td></tr>
				<tr>
				";
			}
		}
     }else{
	?>
		<td width=100%>
			<table width=100% cellpadding=0 cellspacing=0 style="border:1 solid #dddddd;">
				<tr><td  height=100 bgcolor=#CFCFCF align=center>자취/하숙 목록이 없습니다.</td></tr>
			</table>				
		</td>
		<?
	 }
		?>
		
			
		</tr>
		</table>
	</td>
</tr>
<tr><td height=15></td></tr>
<?
if($is_admin)
{
?>
<tr>
	<td align=right style='padding-right:20px'><a href='<?=$IU[home_file]?>?mode=house_write&<?=$view_qstr?>'><img id="btn_submit" src="<?=$IU[url]?>/sub/house/img/btn_write.gif" border=0 accesskey='s'></a></td>
</tr>
<?
}

$list_href = '';
$prev_part_href = '';
$next_part_href = '';
if ($sca || $stx)  
{
    $list_href = "$IU[home_file]?mode=house_list";

    //if ($prev_spt >= $min_spt) 
    $prev_spt = $spt - $config[cf_search_part];
    if (isset($min_spt) && $prev_spt >= $min_spt)
        $prev_part_href = $list_href.$qstr."&spt=$prev_spt";

    $next_spt = $spt + $config[cf_search_part];
    if ($next_spt < 0) 
        $next_part_href =$list_href.$qstr."&spt=$next_spt";
}



$nobr_begin = $nobr_end = "";
if (preg_match("/gecko|firefox/i", $_SERVER['HTTP_USER_AGENT'])) {
    $nobr_begin = "<nobr style='display:block; overflow:hidden;'>";
    $nobr_end   = "</nobr>";
}
?>
<tr>
	<td align=center>
		<!-- 페이지 -->
		<table width="100%" cellspacing="0" cellpadding="0">
		<tr> 
			<td width="100%" align="center" height=30 valign=bottom>
				<? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$g4[path]/img/btn_search_prev.gif' border=0 align=absmiddle title='이전검색'></a>"; } ?>
				<?
				// 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
				//echo $write_pages;
				$write_pages = str_replace("처음", "<img src='{$IU[board]}/img/page_begin.gif' border='0' title='처음'>", $write_pages);
				$write_pages = str_replace("이전", "<img src='{$IU[board]}/img/page_prev.gif' border='0' title='이전'>", $write_pages);
				$write_pages = str_replace("다음", "<img src='{$IU[board]}/img/page_next.gif' border='0' title='다음'>", $write_pages);
				$write_pages = str_replace("맨끝", "<img src='{$IU[board]}/img/page_end.gif' border='0' title='맨끝'>", $write_pages);
				$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<b><font class=\"s11 color_gray1\">$1</font></b>", $write_pages);
				$write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><font class=\"s11 color_pink1\">$1</font></b>", $write_pages);
				?>
				<?=$write_pages?>
				<? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$g4[path]/img/btn_search_next.gif' border=0 align=absmiddle title='다음검색'></a>"; } ?>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td align=center>
		<form name=fsearch method=get style="margin:0px;">
		<input type=hidden name='bo_table'		value="<?=$bo_table?>">
		<input type=hidden name='sca'			value="<?=$sca?>">
		<input type=hidden name='search_str'    value="<?=$search_str?>">
		<input type=hidden name='house_ym_type' value="<?=$house_ym_type?>">
		<input type=hidden name='room_type'     value="<?=$room_type?>">
		<input type=hidden name='fit_type'      value="<?=$fit_type?>">
		<input type=hidden name='price_1'       value="<?=$price_1?>">
		<input type=hidden name='price_2'       value="<?=$price_2?>">
		<input type=hidden name='page'       value="<?=$page?>">
		</form><br>
	</td>
</tr>
</table>

<script language="javascript">
function house_search(a){
	if(a=='d')
	{
		document.dfrm_search.submit();
	}
	else if(a=='s')
	{
		document.sfrm_search.submit();
	}
}
</script>
<?
//include_once("$g4_path/_tail.php");
?>
