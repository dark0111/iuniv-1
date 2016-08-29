<!-- 이미지 및 왼쪽메뉴 -->
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="2"><img src="<?=$g4['path']?>/main/image/sub_left_img.gif" border="0"></td>
		</tr>
		<tr>
			<td width="55"></td>
			<td width="215" valign="top">
			<?
			if(substr($mode,0,5)=='house' ||$mode=='house_password' || $read_file=='house.php' || $read_file=='house_view.php' || $read_file=='house_write.php' || $bo_table=='room_mate' || $bo_table=='house_deal')
			{
			?>
				<!-- 왼쪽메뉴플래시 적용 부분-->
				<script type="text/javascript">
					FlashObject("<?=$g4['path']?>/main/swf/left01.swf", 193, 248, "#ffffff", "");
				</script>
				<!-- /왼쪽메뉴플래시 적용 부분-->
			<?
			}
			elseif($bo_table=='restaurant' || $bo_table=='food_story')
			{
				?>
				<script type="text/javascript">
					FlashObject("<?=$g4['path']?>/main/swf/left02.swf", 193, 248, "#ffffff", "");
				</script>
				<?
			}
			elseif($mode=='community' || $bo_table=='board1'  || $bo_table=='notice'  || $bo_table=='gallery'  || $bo_table=='add'  || $bo_table=='market')
			{
				?>
				<script type="text/javascript">
					FlashObject("<?=$g4['path']?>/main/swf/left03.swf", 193, 248, "#ffffff", "");
				</script>
				<?
			}
			elseif($mode=='information'  || $bo_table=='life'  || $bo_table=='class'  || $bo_table=='class_data'  || $bo_table=='schedule'  || $bo_table=='study'  || $bo_table=='alba')
			{
				?>
				<script type="text/javascript">
					FlashObject("<?=$g4['path']?>/main/swf/left04.swf", 193, 248, "#ffffff", "");
				</script>
				<?
			}
			elseif($mode=='qna'  || $bo_table=='reg_room'  || $bo_table=='qna' || $bo_table=='reg_restaurant' )
			{
				?>
				<script type="text/javascript">
					FlashObject("<?=$g4['path']?>/main/swf/left05.swf", 193, 248, "#ffffff", "");
				</script>
				<?
			}
			elseif(substr($mode,0,4)=='mall')
			{
			
			?>
				<script>
					function cate_tr_show(tr_id)
					{
						if(document.getElementById(tr_id).style.display=='none')
						{
							document.getElementById(tr_id).style.display='';
						}
						else
						{
							document.getElementById(tr_id).style.display='none';
						}
					}
				</script>
				<table border=0 cellpadding=0 cellspacing=0 width=193>
				<!--카테고리 테두리 시작-->
					<tr height=50>
						<td><img src='<?=$dark_define['site_url']?>/sub/mall/dark_mall_image/left_menu_img/left_mall_cata_top.png' border=0></td>
					</tr>    
					<tr>
						<td style='padding-left:20;padding-right:10' background='<?=$dark_define['site_url']?>/sub/mall/dark_mall_image/left_menu_img/left_mall_cata_bg.png'>
						<?								
							$CategoryQuery = " where wcn='1' and use_yn='Y'";
							$CategoryCountQuery = "select count(no) as no from $categorySQL".$CategoryQuery;
							
							$CategoryCountSQL = mysql_query($CategoryCountQuery, $connection) or die("CategoryCountQuery error");
							$CategoryCountFetch = mysql_fetch_array($CategoryCountSQL);

							$RealCategoryQuery = "select no, scn, wcn, cate_name, cate_info from $categorySQL ".$CategoryQuery." order by no asc";
							$RealCategorySQL = mysql_query($RealCategoryQuery, $connection) or die("RealCategoryQuery error");
							
							$trSel = 0;
							for($i=0;$i<$CategoryCountFetch[0];$i++) 
							{
								$trSel++;
								$RealCategoryFetch = mysql_fetch_array($RealCategorySQL);
								
									$SubLoadQuery = "select no, scn, wcn, cate_name, cate_info from $categorySQL where scn='$RealCategoryFetch[no]'  and use_yn='Y'  order by no asc";
									$SubLoadSQL = mysql_Query($SubLoadQuery, $connection) or die("SubLoadQuery error");
									$SubLoadSQLCount=mysql_num_rows($SubLoadSQL);
									$cate_tr_id="cate_tr_".$RealCategoryFetch[no];
							?>	
								<table  border=0 cellpadding=0 cellspacing=0 width='100%'><!--카테고리 리스트 시작-->
									<tr onclick="cate_tr_show('<?=$cate_tr_id?>');">
										<td height="20" onMouseOver="this.style.cursor='hand'; this.style.backgroundColor='#eeeeee';" onMouseOut="this.style.backgroundColor='';">&nbsp;&nbsp;<?=trim($RealCategoryFetch[cate_name])?></td>
									</tr>
									<tr id=<?=$cate_tr_id?> style='display:none' >
										<td>
											<table border=0 height=0 width=100% cellpadding=0 cellspacing=0>
											
									<?
									for($w=0;$w<$SubLoadSQLCount;$w++) 
									{
										$SubLoadFetch = mysql_fetch_array($SubLoadSQL);
										?>

										
											<tr >
												<td height="20" onMouseOver="this.style.cursor='point'; this.style.backgroundColor='#eeeeee';" onMouseOut="this.style.backgroundColor='';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ㄴ&nbsp;&nbsp;<a href="<?=$g4['home_file']?>?mode=mall_goods_list&cate_no=<?=$SubLoadFetch[no]?>"><font color=333333><?=$SubLoadFetch[cate_name]?> </font></td>
											</tr>
										<?
									}
									?>
											</table>
										</td>
									</tr>
								<?
								}					
								if($cate_no){
									$cque = "select no, scn, wcn, cate_name, cate_info from $categorySQL where no='$cate_no'  and use_yn='Y'";
									$cres = mysql_Query($cque, $connection) or die("cque error");
									$crow=mysql_fetch_array($cres);
									
									$t_cate_tr_id="cate_tr_".$crow[scn];
									?>
									<script>
									document.getElementById("<?=$t_cate_tr_id?>").style.display='';	
									</script>
								<?
								}
								?>	
								<!--카테고리 리스트 끝-->
								</table>
							</td>
						</tr>
						<tr height=27>
							<td><img src='<?=$dark_define['site_url']?>/sub/mall/dark_mall_image/left_menu_img/left_mall_cata_bot.png' border=0></td>
						</tr>
					</table><!--카테고리 테두리 끝-->
			
		
			<?
			}//모드조건끝
			?>
				
			</td>
		</tr>
		<tr>
			<td width="55"></td>
			<td width="215" valign="top">
				<!-- 공간 -->
				<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="16"></td>
				</tr>
				</table>
				<!-- /공간 -->

				<!-- 왼쪽배너 -->
				<table border="0" cellpadding="0" cellspacing="0">
				<?
				if(substr($mode,0,5)=='house')
				{
				?>
				<tr>
					<td width="13"></td>
					<td height="62" valign="top" align=center><a href="<?=$IU[home_file]?>?mode=house_advice"><img src="<?=$IU['path']?>/image/house_left_banner01.gif" border="0" alt="주거 거래시 주의사항"></a></td>
				</tr>
				<?
				}		
				?>
			
				<tr>
					<td width="3"></td>
					<td valign="top">
						<table border="0" cellpadding="0" cellspacing="0" background="<?=$dark_define['site_url']?>/image/left_download_middle.gif" class="mt10">
						<tr>
							<td><img src="<?=$dark_define['site_url']?>/image/left_download_top.gif" /></td>
						</tr>
						<tr>
							<td valign="top">
								<table  border="0" cellpadding="0" cellspacing="0" style="margin-left:14px;">
								<tr>
									<td height="30" class="txt_over"><img src="<?=$dark_define['site_url']?>/image/icon_han.gif" border="0" align="absmiddle" /> <a href="http://haansoft.com/hnc/down/down_viewer.action?boardcode=TAEMB&amp;largecode=NVI&amp;svstate=Y" target="_blank">한글뷰어</a></td>
								</tr>
								<tr>
									<td><img src="<?=$dark_define['site_url']?>/image/left_outsourcing_line.gif" /></td>
								</tr>
								<tr>
									<td height="30" class="txt_over"><img src="<?=$dark_define['site_url']?>/image/icon_acrobat.gif" border="0" align="absmiddle" /> <a href="http://www.korea.adobe.com/products/acrobat/readstep2.html" target="_blank">아크로벳 리더</a></td>
								</tr>
								<tr>
									<td><img src="<?=$dark_define['site_url']?>/image/left_outsourcing_line.gif" /></td>
								</tr>
								<tr>
									<td height="30" class="txt_over"><img src="<?=$dark_define['site_url']?>/image/icon_ms_ppt.gif" border="0" align="absmiddle" /> <a href="http://download.microsoft.com/download/a/1/a/a1adc39b-9827-4c7a-890b-91396aed2b86/ppviewer.exe">MS 파워포인트</a></td>
								</tr>
								<tr>
									<td><img src="<?=$dark_define['site_url']?>/image/left_outsourcing_line.gif" /></td>
								</tr>
								<tr>
									<td height="30" class="txt_over"><img src="<?=$dark_define['site_url']?>/image/icon_word.gif" border="0" align="absmiddle" /> <a href="http://www.jungum.com/kr/html/download002_6.html?part=download&amp;sec=5" target="_blank">훈민정음 워드</a></td>
								</tr>
								<tr>
									<td><img src="<?=$dark_define['site_url']?>/image/left_outsourcing_line.gif" /></td>
								</tr>
								<tr>
									<td height="30" class="txt_over"><img src="<?=$dark_define['site_url']?>/image/icon_ms_word.gif" border="0" align="absmiddle" /> <a href="http://download.microsoft.com/download/4/0/0/40046a4e-1f0d-4d25-83d7-43f4177af47d/wdviewer.exe">MS 워드</a></td>
								</tr>
								<tr>
									<td><img src="<?=$dark_define['site_url']?>/image/left_outsourcing_line.gif" /></td>
								</tr>
								<tr>
									<td height="30" class="txt_over"><img src="<?=$dark_define['site_url']?>/image/icon_ms_excel.gif" border="0" align="absmiddle" /> <a href="http://download.microsoft.com/download/9/e/f/9ef13e5d-2116-40de-ab97-310811f0f3ca/xlviewer.exe">MS 엑셀</a></td>
								</tr>
								<tr>
									<td><img src="<?=$dark_define['site_url']?>/image/left_outsourcing_line.gif" /></td>
								</tr>
								<tr>
									<td height="30" class="txt_over"><img src="<?=$dark_define['site_url']?>/image/icon_ms_office.gif" border="0" align="absmiddle" /> <a href="http://www.microsoft.com/downloads/details.aspx?displaylang=ko&amp;FamilyID=941B3470-3AE9-4AEE-8F43-C6BB74CD1466" target="_blank">MS 오피스 2007 호환팩 </a></td>
								</tr>
								<tr>
									<td><img src="<?=$dark_define['site_url']?>/image/left_outsourcing_line.gif" /></td>
								</tr>
								<tr>
									<td height="28" class="txt_over"><img src="<?=$dark_define['site_url']?>/image/icon_ms_update.gif" border="0" align="absmiddle" /> <a href="http://www.microsoft.com/downloads/details.aspx?FamilyID=722c7a55-e541-44cc-97cb-572859346dee&amp;DisplayLang=ko" target="_blank">MS 오피스 2003 업데이트</a></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><img src="<?=$dark_define['site_url']?>/image/left_download_bottom.gif" /></td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		
		</table>


		<!-- /이미지 및 왼쪽메뉴 -->