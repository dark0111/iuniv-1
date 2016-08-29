	<table border=0 cellpadding=0 cellspacing=0 width=960 height=600>
	<tr>
	
	<!-- 좌측 메뉴의 시작 -->
	<td width=160 valign=top align=center>
	
		<!-- 좌측 상단의 타이틀 시작 -->
		<table border=0 cellpadding=0 cellspacing=0 width=148>
		<tr><td height=10 bgcolor="#ffffff"></td></tr>
		
		<tr><td align=center height=36 background="../image/more/image2.gif">

			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td class="title" style="padding:3 0 0 0">관리자 메인(통합)</td></tr>
			</table>

		</td></tr>
		<tr><td height=10 bgcolor="#ffffff"></td></tr>
		</table>
		<!-- 좌측 상단의 타이틀 종료 -->
		
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
		<table border=0 cellpadding=0 cellspacing=0 width=800 height=100%>
		<tr><td colspan=2 height=10></td></tr>

		<tr>
		<td width=10></td>
		<td width=790 style="border:1 dashed;border-color:#c4c4c4;" valign=top>
		<iframe frameborder="0" marginheight="0" marginwidth="0" scrolling="No" name="DOCUMENTS" width="790" height="400"></iframe>
		</td>
		</tr>

		<tr><td colspan=2 height=10></td></tr>
		
		</table>
	
	</td>
	<!-- 우측 내용의 종료 -->
	
	</tr>
	</table>
