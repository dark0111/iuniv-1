<?
session_start();
IF(!$HTTP_SESSION_VARS[ON_ID] AND !$HTTP_SESSION_VARS[ON_NAME] AND !$HTTP_SESSION_VARS[ON_EMAIL]) {
include "../../include/dbcon.php";
$CATEVALUE = "<a href=\"/\" class='user_category_value'>홈</a> > 회원가입 ";
$CATEVALUE .= "> 필수사항 기입";

$jumin = $jumin1."-".$jumin2;
$memberCheckQuery = "select count(no) as no from $memberSQL where name='$name' and jumin='$jumin'";
$memberCheckSQL = mysql_query($memberCheckQuery, $connection) or die("memberCheckQuery error");
$memberCheckFetch = mysql_fetch_array($memberCheckSQL);

if(!strcmp($memberCheckFetch[0],"0") and $name and $jumin) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>회원가입시 필수사항 기입</title>
	<link rel="STYLESHEET" type="text/css" href="../../style/style.css">

	<script language="javascript">
	function memberInsForm() {
		if(!MemberForm.id.value) {
			alert("아이디를 입력하십시오.        ");
			MemberForm.id.focus();
			return false;
		}

		if(MemberForm.id.value.length < 3) {
			alert('아이디는 3자리 이상이어야 합니다.       ');
			MemberForm.id.focus();
			return false;
		}

		idA = MemberForm.id.value;
		idB = MemberForm.idvalue.value;

		if(idA==idB) {} else {
			alert("'아이디 검색' 버튼을 클릭하여 사용여부를 확인하십시오.        ");
			MemberForm.id.focus();
			return false;
		}
		
		if(!MemberForm.passA.value) {
			alert("비밀번호를 입력하십시오.        ");
			MemberForm.passA.focus();
			return false;
		}

		if(!MemberForm.passB.value) {
			alert("비밀번호 확인을 입력하십시오.        ");
			MemberForm.passB.focus();
			return false;
		}
		
		var passA = MemberForm.passA.value;
		var passB = MemberForm.passB.value;

		if(passA==passB) {} else {
			alert("비밀번호를 확인하십시오.        ");
			MemberForm.passB.focus();
			return false;
		}

		if(!MemberForm.name.value) {
			alert("이름을 입력하십시오.        ");
			MemberForm.name.focus();
			return false;
		}		


		if(!MemberForm.jumin1.value || !MemberForm.jumin2.value) {
			alert("주민등록번호를 입력하십시오.        ");
			MemberForm.jumin1.focus();
			return false;
		}		
		
		str1=MemberForm.jumin1.value
		str2=MemberForm.jumin2.value
		a1 = parseInt(str1.charAt(0))*2
		a2 = parseInt(str1.charAt(1))*3
		a3 = parseInt(str1.charAt(2))*4
		a4 = parseInt(str1.charAt(3))*5
		a5 = parseInt(str1.charAt(4))*6
		a6 = parseInt(str1.charAt(5))*7
		a7 = parseInt(str2.charAt(0))*8
		a8 = parseInt(str2.charAt(1))*9
		a9 = parseInt(str2.charAt(2))*2
		a10 = parseInt(str2.charAt(3))*3
		a11 = parseInt(str2.charAt(4))*4
		a12 = parseInt(str2.charAt(5))*5
		tot=a1+a2+a3+a4+a5+a6+a7+a8+a9+a10+a11+a12
		
		na=tot%11
		ch=11-na
		
		if(ch==10)ch=0
		if(ch==11)ch=1
		
		if(ch==parseInt(str2.charAt(6))) {} else {
			alert('주민번호가 잘못되었습니다.       ');
			MemberForm.jumin1.focus();
			return false;
		}

		if(!MemberForm.add_1.value) {
			alert("주소를 입력하십시오.        ");
			zipsearch('MemberForm');
			return false;
		}
		
		if(!MemberForm.add_2.value) {
			alert("나머지 주소를 입력하십시오.        ");
			MemberForm.add_2.focus();
			return false;
		}
		
		if(!MemberForm.zip_1.value||!MemberForm.zip_2.value) {
			alert("우편번호를 입력하십시오.        ");
			zipsearch();
			return false;
		}		
			
		
		if(!MemberForm.email.value) {
			alert("이메일 주소를 입력하십시오.        ");
			MemberForm.email.focus();
			return false;
		}
		
		var str=MemberForm.email.value;
		var filter=/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		
		if (filter.test(str)) {

			testresults = true;

		} else { 

			alert("이메일 주소가 정확하지 않습니다.        ");
			MemberForm.email.focus();
			return false;

		}

		if(!MemberForm.tel_2.value||!MemberForm.tel_3.value) {
			alert("전화번호를 입력하십시오.        ");
			MemberForm.tel_2.focus();
			return false;
		}		

		if(!MemberForm.hp_2.value||!MemberForm.hp_3.value) {
			alert("휴대폰 번호를 입력하십시오.        ");
			MemberForm.hp_2.focus();
			return false;
		}							

		if(!MemberForm.pw_a.value) {
			alert("질문의 답을 입력하십시오.        ");
			MemberForm.pw_a.focus();
			return false;
		}
		
		if(confirm("회원등록을 하시겠습니까?       ")) {
			MemberForm.action = "_result.php";
		} else {
			return false;
		}
		
	}
	
	function Num(field) {
		var valid = "1234567890";
		var ok = "yes";
		var temp;
		for (var i=0; i<field.value.length; i++) {
			temp = "" + field.value.substring(i, i+1);
			if (valid.indexOf(temp) == "-1") ok = "no";
		}
		if (ok == "no") {
			alert("숫자만이 입력이 가능합니다.        ");
			field.focus();
			field.select();
		}
	}		

	function AlphaNum(field) {
		var valid = "abcdefghijklmnopqrstuvwxyz1234567890";
		var ok = "yes";
		var temp;
		for (var i=0; i<field.value.length; i++) {
			temp = "" + field.value.substring(i, i+1);
			if (valid.indexOf(temp) == "-1") ok = "no";
		}
		if (ok == "no") {
			alert("아이디는 앗파벳(소문자)과 숫자만 입력이 가능합니다.        ");
			field.focus();
			field.select();
		}
	}
	
	function idsearch() {
		if(!MemberForm.id.value) {

			alert('아이디를 입력하십시오.         ');
			MemberForm.id.focus();

		} else {

			if(MemberForm.id.value.length < 3) {

				alert('아이디는 3자리 이상이어야 합니다.       ');
				MemberForm.id.focus();

			} else {

				idValue = MemberForm.id.value;
				MemberID.location.href="_result.php?result=id&idValue="+idValue;

			}
		}
	}

	function zipsearch(FormName) {
		var wOpen = window.open('../../zipcode/__zipsearch.php?FormName='+FormName,'ZipSearch','top=300, left=260, width=500,height=300,status=no,toolbar=no,menubar=no,resizable=no,scrollbars=yes');
	}
	
	function MemberCancel() {
		location.href="./signMember.html";
	}
	
	</script>

</head>
<body>
<?
include "../../template/head.php";
?>
<table border=0 cellpadding=0 cellspacing=0 width=900 align=center>
<tr>
<td bgcolor="#ffffff">
	<table broder=0 cellpadding=0 cellspacing=0 width=100%>
	<tr>
	<td bgcolor="#ffffff" class="user_category_value"><?=$CATEVALUE;?></td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff"></td></tr>
	<tr><td height=1 bgcolor="#eeeeee"></td></tr>
	<tr><td height=5 bgcolor="#ffffff"></td></tr>

	<tr>
	<td bgcolor="#ffffff" width="900" align=center>
		
		<!-- 회원가입폼의 확인 <시작> -->
		
		<table border=0 cellpadding=0 cellspacing=0 width=790>
		<form name="MemberForm" method="post" onsubmit="return memberInsForm()">
		<input type="hidden" name="result" value="save">
		<tr>
		<td>
		
			<table border=0 cellpadding=0 cellspacing=0 bgcolor="#ffffff">
			<!-- HR -->
			<tr><td height=25>
		
				<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
				<tr>
				<td align=center>
					<table border=0 cellpadding=0 cellspacing=0>
					<tr><td height=15 colspan=2></td></tr>
					<tr height=22>
					<td width=20 align=center><img src="../../image/membership/image3.gif" width="12" height="12" border="0"></td>
					<td width=770 class="hr_text" style="padding:2 0 0 0">로그인 정보 입력</td>
					</tr>
					<tr><td height=1 bgcolor="#c4c4c4" colspan=2></td></tr>
					</table>
				</td>
				</tr>
				<tr><td height=20></td></tr>
				</table>
			
			</td></tr>
			<!-- HR -->
		
			<!-- 아이디 -->
			<tr height=24>
			<td background="../../image/membership/title_sub.gif">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td style="padding:5 0 0 40" class="product">아이디</td></tr>
				</table>
			</td>
			</tr>
		
			<tr><td height=5 bgcolor="#ffffff">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=3 height=10></td></tr>
				<tr><td width=40></td><td width=730>
				
					<table border=0 cellpadding=3 cellspacing=0>
					<tr>
					<td><input type="text" name="id" size="20" maxlength="15" class="TextBox" onblur="AlphaNum(this)"></td>
					<td><a href="javascript:idsearch()"><img src="../../image/membership/bt3.gif" width="96" height="21" border="0"></a></td>
					</tr>
					<input type="hidden" name="idvalue" value="">
					<tr>
					<td colspan=2>아이디 변경시 '아이디검색' 버튼을 클릭하십시오.</td>
					</tr>
					</table>			
		
				</td><td width=20>
				<!-- 아이디를 검색하는 프레임입니다. -->
				<iframe name="MemberID" frameborder="0" marginheight="0" marginwidth="0" scrolling="0" width=0 height=0></iframe>
				<!-- 아이디를 검색하는 프레임입니다. -->
				</td></tr>
				<tr><td colspan=3 height=10></td></tr>
				</table>
		
			</td></tr>
			<!-- 아이디 -->
			
			
			<!-- 비밀번호 -->
			<tr height=24>
			<td background="../../image/membership/title_sub.gif">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td style="padding:5 0 0 40" class="product">비밀번호</td></tr>
				</table>
			</td>
			</tr>
		
			<tr><td height=5 bgcolor="#ffffff">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=3 height=10></td></tr>
				<tr><td width=40></td><td width=730>
				<input type="password" name="passA" size="25" maxlength="12" class="TextBox">
				</td><td width=20></td></tr>
				<tr><td colspan=3 height=10></td></tr>
				</table>
		
			</td></tr>
			
			<tr height=24>
			<td background="../../image/membership/title_sub.gif">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td style="padding:5 0 0 40" class="product">비밀번호 확인</td></tr>
				</table>
			</td>
			</tr>
		
			<tr><td height=5 bgcolor="#ffffff">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=3 height=10></td></tr>
				<tr><td width=40></td><td width=730>
				<input type="password" name="passB" size="25" maxlength="12" class="TextBox">
				</td><td width=20></td></tr>
				<tr><td colspan=3 height=10></td></tr>
				</table>
		
			</td></tr>
			<!-- 비밀번호 -->
		
			<!-- HR -->
			<tr><td height=25>
		
				<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
				<tr>
				<td align=center>
					<table border=0 cellpadding=0 cellspacing=0>
					<tr><td height=15 colspan=2></td></tr>
					<tr height=22>
					<td width=20 align=center><img src="../../image/membership/image3.gif" width="12" height="12" border="0"></td>
					<td width=770 class="hr_text" style="padding:2 0 0 0">기본 정보 입력</td>
					</tr>
					<tr><td height=1 bgcolor="#c4c4c4" colspan=2></td></tr>
					</table>
				</td>
				</tr>
				<tr><td height=20></td></tr>
				</table>
		
			</td></tr>
			<!-- HR -->
		
			<!-- 이름 -->
			<tr height=24>
			<td background="../../image/membership/title_sub.gif">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td style="padding:5 0 0 40" class="product">이름</td></tr>
				</table>
			</td>
			</tr>
		
			<tr><td height=5 bgcolor="#ffffff">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=3 height=10></td></tr>
				<tr><td width=40></td><td width=730>
				<input type="text" name="name" size="15" maxlength="10" class="TextBox" readonly value="<?=$name?>">
				</td><td width=20></td></tr>
				<tr><td colspan=3 height=10></td></tr>
				</table>
		
			</td></tr>
			<!-- 이름 -->
			
			<!-- 주민등록번호 -->
			<tr height=24>
			<td background="../../image/membership/title_sub.gif">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td style="padding:5 0 0 40" class="product">주민등록번호</td></tr>
				</table>
			</td>
			</tr>
		
			<tr><td height=5 bgcolor="#ffffff">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=3 height=10></td></tr>
				<tr><td width=40></td><td width=730>
				<input type="text" readonly value="<?=$jumin1?>" name="jumin1" size="6" maxlength="6" class="TextBox" OnKeyUp="if(MemberForm.jumin1.value.length >= 6){ MemberForm.jumin2.focus();}" onblur="Num(this)">
				-
				<input type="password" readonly value="<?=$jumin2?>" name="jumin2" size="7" maxlength="7" class="TextBox" OnKeyUp="if(MemberForm.jumin2.value.length >= 7){ MemberForm.add_2.focus();}" onblur="Num(this)">
		
				</td><td width=20></td></tr>
				<tr><td colspan=3 height=10></td></tr>
				</table>
		
			</td></tr>
			<!-- 주민등록번호 -->		
		
			<!-- HR -->
			<tr><td height=25>
				<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
				<tr>
				<td align=center>
					<table border=0 cellpadding=0 cellspacing=0>
					<tr><td height=15 colspan=2></td></tr>
					<tr height=22>
					<td width=20 align=center><img src="../../image/membership/image3.gif" width="12" height="12" border="0"></td>
					<td width=770 class="hr_text" style="padding:2 0 0 0">상세 정보 입력</td>
					</tr>
					<tr><td height=1 bgcolor="#c4c4c4" colspan=2></td></tr>
					</table>
				</td>
				</tr>
				<tr><td height=20></td></tr>
				</table>
			</td></tr>
			<!-- HR -->
			
			
			<!-- 주소 -->
			<tr height=24>
			<td background="../../image/membership/title_sub.gif">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td style="padding:5 0 0 40" class="product">주소</td></tr>
				</table>
			</td>
			</tr>
		
			<tr><td height=5 bgcolor="#ffffff">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=3 height=10></td></tr>
				<tr><td width=40></td><td width=730>
		
					<table border=0 cellpadding=3 cellspacing=0>
					<tr>
					<td colspan=2><input type="text" name="add_1" size="50" maxlength="150" class="TextBox" readonly></td>
					</tr>
					
					<tr>
					<td><input type="text" name="add_2" size="30" maxlength="150" class="TextBox"></td>
					<td><a href="javascript:zipsearch('MemberForm')"><img src="../../image/membership/bt4.gif" width="96" height="21" border="0"></a></td>
					</tr>
					</table>
				
				</td><td width=20></td></tr>
				<tr><td colspan=3 height=10></td></tr>
				</table>
		
			</td></tr>
			<!-- 주소 -->		
			
			
			<!-- 우편번호 -->
			<tr height=24>
			<td background="../../image/membership/title_sub.gif">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td style="padding:5 0 0 40" class="product">우편번호</td></tr>
				</table>
			</td>
			</tr>
		
			<tr><td height=5 bgcolor="#ffffff">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=3 height=10></td></tr>
				<tr><td width=40></td><td width=730>
				<input type="text" name="zip_1" size="3" maxlength="3" class="TextBox" readonly>
				-
				<input type="text" name="zip_2" size="3" maxlength="3" class="TextBox" readonly>
				</td><td width=20></td></tr>
				<tr><td colspan=3 height=10></td></tr>
				</table>
		
			</td></tr>
			<!-- 우편번호 -->		
		
		
			<!-- HR -->
			<tr><td height=25>
				<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
				<tr>
				<td align=center>
					<table border=0 cellpadding=0 cellspacing=0>
					<tr><td height=15 colspan=2></td></tr>
					<tr height=22>
					<td width=20 align=center><img src="../../image/membership/image3.gif" width="12" height="12" border="0"></td>
					<td width=770 class="hr_text" style="padding:2 0 0 0">연락처 입력</td>
					</tr>
					<tr><td height=1 bgcolor="#c4c4c4" colspan=2></td></tr>
					</table>
				</td>
				</tr>
				<tr><td height=20></td></tr>
				</table>
			</td></tr>
			<!-- HR -->
			
			
			<!-- 이메일 -->
			<tr height=24>
			<td background="../../image/membership/title_sub.gif">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td style="padding:5 0 0 40" class="product">이메일</td></tr>
				</table>
			</td>
			</tr>
		
			<tr><td height=5 bgcolor="#ffffff">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=3 height=10></td></tr>
				<tr><td width=40></td><td width=730>
				<input type="text" name="email" size="40" maxlength="100" class="TextBox">
				</td><td width=20></td></tr>
				<tr><td colspan=3 height=10></td></tr>
				</table>
		
			</td></tr>
			<!-- 이메일 -->		
			
			<!-- 전화번호 -->
			<tr height=24>
			<td background="../../image/membership/title_sub.gif">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td style="padding:5 0 0 40" class="product">전화번호</td></tr>
				</table>
			</td>
			</tr>
		
			<tr><td height=5 bgcolor="#ffffff">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=3 height=10></td></tr>
				<tr><td width=40></td><td width=730>
				
				<?
				$TelValue = "서울,경기,인천,강원,충남,대전,충북,부산,울산,대구,경북,경남,전남,광주,전북,제주";
				$TelValue = explode(",", $TelValue);
				$TelValueNum = "02,031,032,033,041,042,043,051,052,053,054,055,061,062,063,064";
				$TelValueNum = explode(",", $TelValueNum);
				?>
				<select name="tel_1" class="SelectBox">
				
				<?
				for($i=0;$i<16;$i++) {
				?>
				
				<option value=<?=$TelValueNum[$i]?>><?=$TelValue[$i]?></option>
				
				<?
				}
				?>
				
				</select>
				-
				<input type="text" name="tel_2" size="4" maxlength="4" class="TextBox" OnKeyUp="if(MemberForm.tel_2.value.length >= 4){ MemberForm.tel_3.focus();}" onblur="Num(this)">
				-
				<input type="text" name="tel_3" size="4" maxlength="4" class="TextBox" OnKeyUp="if(MemberForm.tel_3.value.length >= 4){ MemberForm.fax_2.focus();}" onblur="Num(this)">
				
				</td><td width=20></td></tr>
				<tr><td colspan=3 height=10></td></tr>
				</table>
		
			</td></tr>
			<!-- 전화번호 -->		
			
			<!-- 팩스번호 -->
			<tr height=24>
			<td background="../../image/membership/title_sub.gif">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td style="padding:5 0 0 40" class="product">팩스번호</td></tr>
				</table>
			</td>
			</tr>
		
			<tr><td height=5 bgcolor="#ffffff">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=3 height=10></td></tr>
				<tr><td width=40></td><td width=730>
				
				<select name="fax_1" class="SelectBox">
				<?
				for($i=0;$i<16;$i++) {
				?>
				
				<option value=<?=$TelValueNum[$i]?>><?=$TelValue[$i]?></option>
				
				<?
				}
				?>
				</select>
				-
				<input type="text" name="fax_2" size="4" maxlength="4" class="TextBox" OnKeyUp="if(MemberForm.fax_2.value.length >= 4){ MemberForm.fax_3.focus();}" onblur="Num(this)">
				-
				<input type="text" name="fax_3" size="4" maxlength="4" class="TextBox" OnKeyUp="if(MemberForm.fax_3.value.length >= 4){ MemberForm.hp_2.focus();}" onblur="Num(this)">
				
				</td><td width=20></td></tr>
				<tr><td colspan=3 height=10></td></tr>
				</table>
		
			</td></tr>
			<!-- 팩스번호 -->		
		
			
			<!-- 휴대폰 -->
			<tr height=24>
			<td background="../../image/membership/title_sub.gif">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td style="padding:5 0 0 40" class="product">휴대폰</td></tr>
				</table>
			</td>
			</tr>
		
			<tr><td height=5 bgcolor="#ffffff">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=3 height=10></td></tr>
				<tr><td width=40></td><td width=730>
				
				<select name="hp_1" class="SelectBox">
				<option value=10>010</option>
				<option value=11>011</option>
				<option value=16>016</option>
				<option value=17>017</option>
				<option value=18>018</option>
				<option value=19>019</option>
				</select>
				-
				<input type="text" name="hp_2" size="4" maxlength="4" class="TextBox" OnKeyUp="if(MemberForm.hp_2.value.length >= 4){ MemberForm.hp_3.focus();}" onblur="Num(this)">
				-
				<input type="text" name="hp_3" size="4" maxlength="4" class="TextBox" OnKeyUp="if(MemberForm.hp_3.value.length >= 4){ MemberForm.pw_a.focus();}" onblur="Num(this)">
				
				</td><td width=20></td></tr>
				<tr><td colspan=3 height=10></td></tr>
				</table>
		
			</td></tr>
			<!-- 휴대폰 -->		
			
			<!-- HR -->
			<tr><td height=25>
				<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
				<tr>
				<td align=center>
					<table border=0 cellpadding=0 cellspacing=0>
					<tr><td height=15 colspan=2></td></tr>
					<tr height=22>
					<td width=20 align=center><img src="../../image/membership/image3.gif" width="12" height="12" border="0"></td>
					<td width=770 class="hr_text" style="padding:2 0 0 0">비밀번호 분실 관련 정보 입력</td>
					</tr>
					<tr><td height=1 bgcolor="#c4c4c4" colspan=2></td></tr>
					</table>
				</td>
				</tr>
				<tr><td height=20></td></tr>
				</table>
			</td></tr>
			<!-- HR -->		

			<!-- 비밀번호 분실시 질문 -->
			<tr height=24>
			<td background="../../image/membership/title_sub.gif">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td style="padding:5 0 0 40" class="product">비밀번호 분실시 질문</td></tr>
				</table>
			</td>
			</tr>
		
			<tr><td height=5 bgcolor="#ffffff">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=3 height=10></td></tr>
				<tr><td width=40></td><td width=730>
				
				<select name="pw_q" class="SelectBox" style="width:300">
				<option value="가장 기억에 남는 장소는?">가장 기억에 남는 장소는?
				<option value="나의 좌우명은?">나의 좌우명은?
				<option value="나의 보물 제1호는?">나의 보물 제1호는?
				<option value="내가 존경하는 인물은?">내가 존경하는 인물은?
				<option value="내가 좋아하는 만화 캐릭터는?">내가 좋아하는 만화 캐릭터는?
				<option value="오래도록 기억하고 싶은 날짜는?">오래도록 기억하고 싶은 날짜는?
				<option value="받았던 선물 중 기억에 남는 독특한 선물은?">받았던 선물 중 기억에 남는 독특한 선물은?
				<option value="나의 노래방 애창곡은?">나의 노래방 애창곡은?
				<option value="인상 깊게 읽은 책 이름은?">인상 깊게 읽은 책 이름은?
				<option value="나의 출신 초등학교는?">나의 출신 초등학교는?
				</select>
				
				</td><td width=20></td></tr>
				<tr><td colspan=3 height=10></td></tr>
				</table>
		
			</td></tr>
			<!-- 비밀번호 분실시 질문 -->		
		
			<!-- 질문의 답 -->
			<tr height=24>
			<td background="../../image/membership/title_sub.gif">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td style="padding:5 0 0 40" class="product">질문의 답</td></tr>
				</table>
			</td>
			</tr>
		
			<tr><td height=5 bgcolor="#ffffff">
				<table border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=3 height=10></td></tr>
				<tr><td width=40></td><td width=730>
		
				<input type="text" name="pw_a" size="50" maxlength="50" class="TextBox">
		
				</td><td width=20></td></tr>
				<tr><td colspan=3 height=10></td></tr>
				</table>
		
			</td></tr>
			<!-- 비밀번호 분실시 질문 -->		
		
			<!-- HR -->
			<tr><td height=25>
			<hr size=1 color="#666666">
			</td></tr>
			<!-- HR -->
			
			<tr><td align=center>
				<table border=0 cellpadding=0 cellspacing=0 align=center>
				<tr><td colspan=3 height=10></td></tr>
				<tr>
				<td><input type="image" src="../../image/membership/bt5.gif" width="96" height="21" border="0"></td>
				<td width=5></td>
				<td><a href="javascript:MemberCancel()"><img src="../../image/membership/bt6.gif" width="96" height="21" border="0"></a></td>
				</tr>
				</table>
			</td></tr>
			
			<tr><td height=50></td></tr>
			
			</table>
		
		</td>
		</tr>
		</form>
		</table>	

		<!-- 회원가입폼의 확인 <종료> -->

	</td>
	</tr>
	</table>

</td></tr>
</table>	

<?
include "../../template/footer.php";
?>
</body>
</html>

<?
} else {
?>

<script language="javascript">
alert("필요한 값이 넘어오지 않았습니다.            ");

</script>

<?
}
?>

<?
} ELSE {
?>
<script language="javascript">
parent.location.href="/";
</script>
<?
}
mysql_close($connection);
?>
