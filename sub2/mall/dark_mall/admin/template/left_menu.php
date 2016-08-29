	<table border=0 cellpadding=0 cellspacing=0 width=960 height=600>
	<tr>
	
	<!-- 좌측 메뉴의 시작 -->
	<td width=160 valign=top align=center>
	
		<!-- 좌측 상단의 타이틀 시작 -->
		<table border=0 cellpadding=0 cellspacing=0 width=148>
		<tr><td height=10 bgcolor="#ffffff"></td></tr>
		
		<tr><td align=center height=36 background="../image/more/image2.gif">

			<?
			// 메인메뉴의 파일을 불러옵니다.
			$MenuLoad = @FILE("../include/main_menu_array.itps");
			?>

			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td class="title" style="padding:3 0 0 0"><?=$MenuLoad[$mn]?></td></tr>
			</table>

		</td></tr>
		<tr><td height=10 bgcolor="#ffffff"></td></tr>
		</table>
		<!-- 좌측 상단의 타이틀 종료 -->

		<!-- 좌측 메뉴의 시작 -->
		<table border=0 cellpadding=0 cellspacing=0>
		<?
		// 서브메뉴의 파일을 불러옵니다.(실제 서브메뉴의 이름들과 링크를 가져옵니다.)
		$SubMenuLoad = @file("../include/sub_menu_array.itps");
		$explode_array = explode(",",$SubMenuLoad[$mn]);
		for($i=1;$i<$explode_array[0]+1;$i++) {
			$menuParser = explode("|", $explode_array[$i]); // 2가지로 분류합니다. (이름과 링크)
			$menu_name = $menuParser[0];
			$menu_href = $menuParser[1];
			?>

		<tr><td>

			<table border=0 cellpadding=0 cellspacing=1 width=150>
			<tr><td <?if(!strcmp($i, $sn)) { ?>bgcolor="#ffffcc" style="border:1 dashed;border-color:#666666"<?} else { ?>bgcolor="#f7f7f7" style="border:1 dashed;border-color:#eeeeee"<?}?> style="padding:1 0 0 0" height=22>

				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td><img src="../image/more/num_<?=$i?><?if(!strcmp($i, $sn)) {print "s";} ?>.gif" width="16" height="16" align=left></td>
				<td style="padding:3 0 0 0"><a href="javascript:CallMenu('<?=$mn?>', '<?=$i?>', '<?=$menu_href?>')" class="a_ex<?if(!strcmp($i, $sn)) { print "s";}?>"><?=$menu_name?></a></td>
				</tr>
				</table>

			</td></tr>
			</table>

		</td></tr>
		<tr><td height=3></td></tr>

			<?
		}
		?>
		<tr><td height=40></td></tr>
		</table>
		<!-- 좌측 메뉴의 종료 -->
		
		<!-- 좌측 로그인 정보 부분의 시작 -->
			
		<table border=0 cellpadding=0 cellspacing=0 width=148 height=79 background="../image/more/image5.gif">
		<tr><td height=7></td></tr>
		<tr>
		<td height=40 align=center class="login">
		<strong><?=$HTTP_SESSION_VARS[OLD_NAME]?></strong>님<br>
		방문을 환영합니다
		</td>
		</tr>

		<tr>
		<td height=32 align=center valign=top>
			<table border=0 cellpadding=0 cellspacing=0>
			<tr>
			<td><a href="javascript:logout()"><img src="../image/more/image3.gif" width="57" height="20" border="0"></a></td>
			<td width=4></td>
			<td><img src="../image/more/image4.gif" width="54" height="20" border="0"></td>
			</tr>
			</table>
		</td>
		</tr>

		</table>
		
		<!-- 좌측 로그인 정보 부분의 종료 -->

	</td>
	<!-- 좌측 메뉴의 종료 -->

	<!-- 우측 내용의 시작 -->
	<td width=800>

		<?

		IF(!$loc) { 
		# 서브메뉴의 디렉토리 값이 들어오지 않을 경우 기본 디렉토리를 출력합니다.

			$f_loc = "../mn_".$mn."/"; 
			# 아래의 IFRAME 으로 적용합니다.

		} ELSE { 
		# loc의 디렉토리의 값이 들어오는 경우

			$f_loc = "../mn_".$mn."/".$loc."/"; 
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
			<img src="../image/more/image11.gif" width="14" height="14" border="0" align=left> <strong>상품 카테고리 관리</strong> (상품의 분류를 만들고 수정합니다)
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
				<tr><td align=center><a href="javascript:category.add_parent('<?=$mn?>','<?=$loc?>')"><img src="../image/more/cate_a_add.gif" width="96" height="21" border="0"></a></td></tr>
				</table>
			</td>
			</tr>
			</table>

		<?
		// Query 값이 [?mn=1&sn=2&loc=product] 와 같이 넘어올때 (상품설정)
		} else if(!strcmp($mn,"1") and !strcmp($sn,"2")) {
		?>
		
			<script language="JavaScript" type="text/javascript">
			function CateView() {
				var wOpen = window.open('../mn_1/category/category_select.php','CategoryView','top=50, left=50, width=400,height=600,status=no,toolbar=no,menubar=no,resizable=no,scrollbars=yes');
			}
			</script>	
			
			<table border=0 cellpadding=0 cellspacing=0 width=790>
			<tr>
			<td width=790 class="page">
			<img src="../image/more/image11.gif" width="14" height="14" border="0" align=left> <strong>상품 설정</strong> (상품을 등록하고 수정하고 삭제할 수 있습니다)
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
				<td class="title" align=center style="padding:0 0 0 10"><a href="javascript:CateView()"><img src="../image/more/image19.gif" width="95" height="21" border="0"></a></td>
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
		} else if(!strcmp($mn,"1") and !strcmp($sn,"3")) {
		?>

			<table border=0 cellpadding=0 cellspacing=0 width=790>
			<tr>
			<td width=790 class="page">
			<img src="../image/more/image11.gif" width="14" height="14" border="0" align=left> <strong>오픈마켓 등록대기 상품</strong> (판매자들이 등록한 상품 목록입니다)
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
		} else if(!strcmp($mn,"2") and !strcmp($sn,"1")) {
		?>

			<table border=0 cellpadding=0 cellspacing=0 width=790>
			<tr>
			<td width=790 class="page">
			<img src="../image/more/image11.gif" width="14" height="14" border="0" align=left> <strong>회원(고객)관리</strong>
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
