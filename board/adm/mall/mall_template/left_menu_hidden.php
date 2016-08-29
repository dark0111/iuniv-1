<td width=160 valign=top align=center>

			<!-- 좌측 상단의 타이틀 시작 -->
			<table border=0 cellpadding=0 cellspacing=0 width=148>
			<tr><td height=10 bgcolor="#ffffff"></td></tr>

			<tr>
				<td align=center height=36 background="<?=$dark_define['site_url']?>/dark_admin/mall_admin_images/more/image2.gif">

					<?
					// 메인메뉴의 파일을 불러옵니다.
					$MenuLoad = @FILE("./mall_admin_include/main_menu_array.itps");
					?>

					<table border=0 cellpadding=0 cellspacing=0>
					<tr><td class="title" style="padding:3 0 0 0"><?=$MenuLoad[$mn]?></td></tr>
					</table>

				</td>
			</tr>
			<tr><td height=10 bgcolor="#ffffff"></td></tr>
			</table>
			<!-- 좌측 상단의 타이틀 종료 -->

			<!-- 좌측 메뉴의 시작 -->
			<table border=0 cellpadding=0 cellspacing=0>
			<?
			// 서브메뉴의 파일을 불러옵니다.(실제 서브메뉴의 이름들과 링크를 가져옵니다.)
			$SubMenuLoad = @file("./mall_admin_include/sub_menu_array.itps");
			$explode_array = explode(",",$SubMenuLoad[$mn]);
			for($i=1;$i<$explode_array[0]+1;$i++) {
			$menuParser = explode("|", $explode_array[$i]); // 2가지로 분류합니다. (이름과 링크)
			$menu_name = $menuParser[0];
			$menu_href = $menuParser[1];
			?>

			<tr>
				<td>

					<table border=0 cellpadding=0 cellspacing=1 width=150>
					<tr>
						<td <?if(!strcmp($i, $sn)) { ?>bgcolor="#ffffcc" style="border:1 dashed;border-color:#666666"<?} else { ?>bgcolor="#f7f7f7" style="border:1 dashed;border-color:#eeeeee"<?}?> style="padding:1 0 0 0" height=22>

							<table border=0 cellpadding=0 cellspacing=0>
							<tr>
								<td><img src="<?=$dark_define['site_url']?>/dark_admin/mall_admin_images/more/num_<?=$i?><?if(!strcmp($i, $sn)) {print "s";} ?>.gif" width="16" height="16" align=left></td>
								<td style="padding:3 0 0 0"><a href="javascript:CallMenu('<?=$mn?>', '<?=$i?>', '<?=$menu_href?>')" class="a_ex<?if(!strcmp($i, $sn)) { print "s";}?>"><?=$menu_name?></a></td>
							</tr>
							</table>

						</td>
					</tr>
					</table>

				</td>
			</tr>
			<tr><td height=3></td></tr>

			<?
			}
			?>
			<tr><td height=40></td></tr>
			</table>
			<!-- 좌측 메뉴의 종료 -->

			

		</td>
