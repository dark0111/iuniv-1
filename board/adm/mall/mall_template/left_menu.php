	<table border=0 cellpadding=0 cellspacing=0 width=960 height=600>
	<tr>
		
		<!-- 좌측 메뉴의 시작 -->
		<?//include"./mall_template/left_menu_hidden.php"?>
		<!-- 좌측 메뉴의 종료 -->

		<!-- 우측 내용의 시작 -->
		<td width=800>

			<?

			IF(!$loc) 
			{
			# 서브메뉴의 디렉토리 값이 들어오지 않을 경우 기본 디렉토리를 출력합니다.

			$f_loc = "./mall_admin_mn_".$mn."/";
			# 아래의 IFRAME 으로 적용합니다.

			}
			ELSE
			{
			# loc의 디렉토리의 값이 들어오는 경우

			$f_loc = "./mall_admin_mn_".$mn."/".$loc."/";
			# 아래의 IFRAME 으로 적용합니다.

			}
		
			?>

			<table border=0 cellpadding=0 cellspacing=0 width=800 height=100%>
			<tr><td colspan=2 height=10></td></tr>

			<tr>
				<td width=10></td>
				<td width=790 valign=top>

					<?
					// Query 값이 [?mn=1&sn=1&loc=category] 와 같이 넘어올때 (상품 카테고리 관리)
					if(!strcmp($mn,"1") and !strcmp($sn,"1")) {
					?>
					<table border=0 cellpadding=0 cellspacing=0 width=790>
					<tr>
						<td width=790 class="page">
							<img src="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/more/image11.gif" width="14" height="14" border="0" align=left> <strong>상품 카테고리 관리</strong> (상품의 분류를 만들고 수정합니다)
						</td>
					</tr>
					</table>
					<hr size=1 color="#d0d0d0">
					<table border=0 cellpadding=0 cellspacing=0>
					<tr>
						<td valign=top>
							<table border=0 cellpadding=0 cellspacing=0 width=230 height=400>
							<tr>
								<td valign=top bgcolor="#ffffff">
									<iframe src="<?=$f_loc?>category.php" name="category" frameborder="0" marginheight="0" marginwidth="0" scrolling="No" width="230" height="450"></iframe>
								</td>
							</tr>
							</table>
						</td>
						<td width=10></td>
						<td valign=top>
							<table border=0 cellpadding=0 cellspacing=0 width=550 height=400>
							<tr>
								<td valign=top bgcolor="#ffffff" valign=top>
									<iframe src="<?=$f_loc?>_blank.php" name="page" frameborder="0" marginheight="0" marginwidth="0" scrolling="No" width="550" height="450"></iframe>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
					<hr size=1 color="#d0d0d0">
					<table border=0 cellpadding=0 cellspacing=0 width=210>
					<tr>
						<td bgcolor="#ffffff">
							<table border=0 cellpadding=0 cellspacing=0>
							<tr><td align=center><a href="javascript:category.add_parent('<?=$mn?>','<?=$loc?>')"><img src="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/more/cate_a_add.gif" width="96" height="21" border="0"></a></td></tr>
							</table>
						</td>
					</tr>
					</table>

					<?
					// Query 값이 [?mn=1&sn=2&loc=product] 와 같이 넘어올때 (상품설정)
					}
					else if(!strcmp($mn,"1") and !strcmp($sn,"2")) {
					?>

					<script language="JavaScript" type="text/javascript">
					function CateView() {
					var wOpen = window.open('./mall_admin_mn_1/category/category_select.php','CategoryView','top=50, left=50, width=400,height=600,status=no,toolbar=no,menubar=no,resizable=no,scrollbars=yes');
					}
					</script>

					<table border=0 cellpadding=0 cellspacing=0 width=790>
					<tr>
						<td width=790 class="page">
							<img src="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/more/image11.gif" width="14" height="14" border="0" align=left> <strong>상품 설정</strong> (상품을 등록하고 수정하고 삭제할 수 있습니다)
						</td>
					</tr>
					</table>
					<hr size=1 color="#d0d0d0">
					<table border=0 cellpadding=0 cellspacing=0 width=790>
					<tr>
						<td bgcolor="#eeeeee" height=30>
							<table border=0 cellpadding=0 cellspacing=0>
							<form name="CateForm">
							<tr>
								<td class="title" align=center style="padding:0 0 0 10"><a href="javascript:CateView()"><img src="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/more/image19.gif" width="95" height="21" border="0"></a></td>
								<td style="padding:0 0 0 10">
									<input type="text" name="CateValue" size="80" readonly style="border:1 solid;background-color:#eeeeee;border-color:#eeeeee;padding:2 0 0 0;font-weight: bold;" value="카테고리를 선택하십시오">
								</td>
							</tr>
							</form>
							</table>
						</td>
					</tr>

					<tr><td height=20></td></tr>

					</table>

					<table border=0 cellpadding=0 cellspacing=0 width=790>
					<tr>
						<td><iframe src="<?=$f_loc?>_blank.php" name="page" frameborder="0" marginheight="0" marginwidth="0" scrolling="auto" width="790" height=600></iframe></td>
					</tr>

					<?
					// Query 값이 [?mn=1&sn=2&loc=product] 와 같이 넘어올때 (상품설정)
					}
					else if(!strcmp($mn,"1") and !strcmp($sn,"3")) {
					?>

					<table border=0 cellpadding=0 cellspacing=0 width=790>
					<tr>
						<td width=790 class="page">
							<img src="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/more/image11.gif" width="14" height="14" border="0" align=left> <strong>오픈마켓 등록대기 상품</strong> (판매자들이 등록한 상품 목록입니다)
						</td>
					</tr>
					</table>
					<hr size=1 color="#d0d0d0">
					<table border=0 cellpadding=0 cellspacing=0 width=790>
					<tr>
						<td><iframe src="<?=$f_loc?>" name="page" frameborder="0" marginheight="0" marginwidth="0" scrolling="auto" width="790" height=600></iframe></td>
					</tr>

					<?
					// Query 값이 [?mn=2&sn=1&loc=product] 와 같이 넘어올때 (상품설정)
					}
					else if(!strcmp($mn,"2") and !strcmp($sn,"1")) {
					?>

					<table border=0 cellpadding=0 cellspacing=0 width=790>
					<tr>
						<td width=790 class="page">
							<img src="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/more/3" width="14" height="14" border="0" align=left> <strong>회원(고객)관리</strong>
						</td>
					</tr>
					</table>
					<hr size=1 color="#d0d0d0">
					<table border=0 cellpadding=0 cellspacing=0 width=790>
					<tr>
						<td><iframe src="<?=$f_loc?>_list.php" name="page" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" width="790" height=600></iframe></td>
					</tr>

					<?
					}
					?>

				</td>
			</tr>

			<tr><td colspan=2 height=10></td></tr>

			</table>

		</td>
		<!-- 우측 내용의 종료 -->

	</tr>
	</table>
