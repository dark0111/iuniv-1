<?
session_start();
include "../../../include/dbcon.php";
IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) {

$memberLoadQuery = "select * from $memberSQL where no='$no'";
$memberLoadSQL = mysql_query($memberLoadQuery, $connection) or die("memberLoadQuery error");
$memberLoadFetch = mysql_fetch_array($memberLoadSQL);
/*
// 고객 등록관리
drop table itp_member;
create table itp_member (
  no int not null auto_increment,
  id varchar(15) not null,
  pw varchar(50) not null,
  name varchar(10) not null,
  jumin varchar(14) not null,
  add_1 varchar(150) not null,
  add_2 varchar(150) not null,
  zip_1 int not null,
  zip_2 int not null,
  email varchar(100) not null,
  tel varchar(13) not null,
  fax varchar(13) not null,
  hp varchar(13) not null,
  pw_q varchar(100) not null,
  pw_a varchar(50) not null,
  member_class int default '1',
  ip varchar(15) not null,
  login_date datetime default '0000-00-00 00:00:00',
  date datetime,
  primary key(no)
);
*/

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<title>회원(고객)관리</title>
	<link rel="STYLESHEET" type="text/css" href="../../../style/style.css">

	<script language="javascript">
	function memberInsForm() {

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
		
		if(confirm("본 회원정보를 수정 하시겠습니까?       ")) {
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

	</script>
</head>

<body>

<table border=0 cellpadding=0 cellspacing=0 width=790>
<form name="MemberForm" method="post" onsubmit="return memberInsForm()">
<input type="hidden" name="result" value="modify">
<input type="hidden" name="no" value="<?=$no?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="limit" value="<?=$limit?>">
<input type="hidden" name="q" value="<?=$q?>">

<tr>
<td>

	<table border=0 cellpadding=0 cellspacing=0 bgcolor="#ffffff">
	<!-- HR -->
	<tr><td height=25>

		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">로그인 정보 입력</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->

	<!-- 아이디 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">아이디</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
			<?=$memberLoadFetch[id]?>
		</td><td width=20>
		</td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 아이디 -->
	
	<!-- HR -->
	<tr><td height=25>

		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">기본 정보 입력</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->

	<!-- 이름 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">이름</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
		<?=$memberLoadFetch[name]?>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 이름 -->
	
	<!-- 주민등록번호 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td style="padding:5 0 0 40" class="product">주민등록번호</td></tr>
		</table>
	</td>
	</tr>

	<tr><td height=5 bgcolor="#ffffff">
		<table border=0 cellpadding=0 cellspacing=0>
		<tr><td colspan=3 height=10></td></tr>
		<tr><td width=40></td><td width=730 class="bold_s_name">
		<?=substr($memberLoadFetch[jumin],0,6)?>-*******
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 주민등록번호 -->		

	<!-- HR -->
	<tr><td height=25>

		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">상세 정보 입력</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->
	
	
	<!-- 주소 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
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
			<td colspan=2><input type="text" name="add_1" value="<?=$memberLoadFetch[add_1]?>" size="50" maxlength="150" class="TextBox" readonly></td>
			</tr>
			
			<tr>
			<td><input type="text" name="add_2" value="<?=$memberLoadFetch[add_2]?>" size="30" maxlength="150" class="TextBox"></td>
			<td><a href="javascript:zipsearch('MemberForm')"><img src="../../image/more/zip_search.gif" width="96" height="21" border="0"></a></td>
			</tr>
			</table>
		
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 주소 -->		
	
	
	<!-- 우편번호 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
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
		<input type="text" name="zip_1" size="3" maxlength="3" value="<?=$memberLoadFetch[zip_1]?>" class="TextBox" readonly>
		-
		<input type="text" name="zip_2" size="3" maxlength="3" value="<?=$memberLoadFetch[zip_2]?>" class="TextBox" readonly>
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 우편번호 -->		


	<!-- HR -->
	<tr><td height=25>

		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">연락처 입력</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->
	
	
	<!-- 이메일 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
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
		<input type="text" name="email" size="40" value="<?=$memberLoadFetch[email]?>" maxlength="100" class="TextBox">
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 이메일 -->		
	
	<!-- 전화번호 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
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

		$tel = explode("-",$memberLoadFetch[tel]);
		?>
		
		<select name="tel_1" class="SelectBox">
		
		<?
		for($i=0;$i<16;$i++) {
		?>
		
		<option value=<?=$TelValueNum[$i]?> <?if(!strcmp($TelValueNum[$i], $tel[0])) { print "selected";}?>><?=$TelValue[$i]?></option>
		
		<?
		}
		?>
		
		</select>
		-
		<input type="text" name="tel_2" value="<?=$tel[1]?>" size="4" maxlength="4" class="TextBox" OnKeyUp="if(MemberForm.tel_2.value.length >= 4){ MemberForm.tel_3.focus();}" onblur="Num(this)">
		-
		<input type="text" name="tel_3" value="<?=$tel[2]?>" size="4" maxlength="4" class="TextBox" OnKeyUp="if(MemberForm.tel_3.value.length >= 4){ MemberForm.fax_2.focus();}" onblur="Num(this)">
		
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 전화번호 -->		
	
	<!-- 팩스번호 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
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
		<?
		$fax = explode("-",$memberLoadFetch[fax]);		
		?>

		<select name="fax_1" class="SelectBox">

		<?
		for($i=0;$i<16;$i++) {
		?>
		
		<option value=<?=$TelValueNum[$i]?> <?if(!strcmp($TelValueNum[$i], $fax[0])) { print "selected";}?>><?=$TelValue[$i]?></option>
		
		<?
		}
		?>

		</select>
		-
		<input type="text" name="fax_2" value="<?=$fax[1]?>" size="4" maxlength="4" class="TextBox" OnKeyUp="if(MemberForm.fax_2.value.length >= 4){ MemberForm.fax_3.focus();}" onblur="Num(this)">
		-
		<input type="text" name="fax_3" value="<?=$fax[2]?>" size="4" maxlength="4" class="TextBox" OnKeyUp="if(MemberForm.fax_3.value.length >= 4){ MemberForm.hp_2.focus();}" onblur="Num(this)">
		
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 팩스번호 -->		

	
	<!-- 휴대폰 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
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
		
		<?
		$hp = explode("-",$memberLoadFetch[hp]);		
		?>
		
		<select name="hp_1" class="SelectBox">
		<option value=10 <?if(!strcmp($hp[0], "10")) { print "selected";}?>>010</option>
		<option value=11 <?if(!strcmp($hp[0], "11")) { print "selected";}?>>011</option>
		<option value=16 <?if(!strcmp($hp[0], "16")) { print "selected";}?>>016</option>
		<option value=17 <?if(!strcmp($hp[0], "17")) { print "selected";}?>>017</option>
		<option value=18 <?if(!strcmp($hp[0], "18")) { print "selected";}?>>018</option>
		<option value=19 <?if(!strcmp($hp[0], "19")) { print "selected";}?>>019</option>
		</select>
		-
		<input type="text" name="hp_2" value="<?=$hp[1]?>" size="4" maxlength="4" class="TextBox" OnKeyUp="if(MemberForm.hp_2.value.length >= 4){ MemberForm.hp_3.focus();}" onblur="Num(this)">
		-
		<input type="text" name="hp_3" value="<?=$hp[2]?>" size="4" maxlength="4" class="TextBox" OnKeyUp="if(MemberForm.hp_3.value.length >= 4){ MemberForm.pw_a.focus();}" onblur="Num(this)">
		
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 휴대폰 -->		
	

	<!-- HR -->
	<tr><td height=25>

		<table border=0 cellpadding=0 cellspacing=0 width=790 height=37>
		<tr>
		<td align=center background="../../image/more/title_main.gif">
			<table border=0 cellpadding=0 cellspacing=0>
			<tr><td height=15></td></tr>
			<tr height=22>
			<td width=40></td>
			<td width=750 class="hr_text">비밀번호 분실 관련 정보 입력</td>
			</tr>
			</table>
		</td>
		</tr>
		<tr><td height=20></td></tr>
		</table>

	</td></tr>
	<!-- HR -->
	
	
	<!-- 비밀번호 분실시 질문 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
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
		<option value="가장 기억에 남는 장소는?" <?if(!strcmp($memberLoadFetch[pw_q],"가장 기억에 남는 장소는?")) { print "selected";}?>>가장 기억에 남는 장소는?
		<option value="나의 좌우명은?" <?if(!strcmp($memberLoadFetch[pw_q],"나의 좌우명은?")) { print "selected";}?>>나의 좌우명은?
		<option value="나의 보물 제1호는?" <?if(!strcmp($memberLoadFetch[pw_q],"나의 보물 제1호는?")) { print "selected";}?>>나의 보물 제1호는?
		<option value="내가 존경하는 인물은?" <?if(!strcmp($memberLoadFetch[pw_q],"내가 존경하는 인물은?")) { print "selected";}?>>내가 존경하는 인물은?
		<option value="내가 좋아하는 만화 캐릭터는?" <?if(!strcmp($memberLoadFetch[pw_q],"내가 좋아하는 만화 캐릭터는?")) { print "selected";}?>>내가 좋아하는 만화 캐릭터는?
		<option value="오래도록 기억하고 싶은 날짜는?" <?if(!strcmp($memberLoadFetch[pw_q],"오래도록 기억하고 싶은 날짜는?")) { print "selected";}?>>오래도록 기억하고 싶은 날짜는?
		<option value="받았던 선물 중 기억에 남는 독특한 선물은?" <?if(!strcmp($memberLoadFetch[pw_q],"받았던 선물 중 기억에 남는 독특한 선물은?")) { print "selected";}?>>받았던 선물 중 기억에 남는 독특한 선물은?
		<option value="나의 노래방 애창곡은?" <?if(!strcmp($memberLoadFetch[pw_q],"나의 노래방 애창곡은?")) { print "selected";}?>>나의 노래방 애창곡은?
		<option value="인상 깊게 읽은 책 이름은?" <?if(!strcmp($memberLoadFetch[pw_q],"인상 깊게 읽은 책 이름은?")) { print "selected";}?>>인상 깊게 읽은 책 이름은?
		<option value="나의 출신 초등학교는?" <?if(!strcmp($memberLoadFetch[pw_q],"나의 출신 초등학교는?")) { print "selected";}?>>나의 출신 초등학교는?
		</select>
		
		</td><td width=20></td></tr>
		<tr><td colspan=3 height=10></td></tr>
		</table>

	</td></tr>
	<!-- 비밀번호 분실시 질문 -->		

	<!-- 질문의 답 -->
	<tr height=24>
	<td background="../../image/more/title_sub.gif">
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

		<input type="text" name="pw_a" size="50" maxlength="50" class="TextBox" value="<?=$memberLoadFetch[pw_a]?>">

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
		<td><input type="image" src="../../image/more/member_save.gif" width="96" height="21" border="0"></td>
		<td width=5></td>
		<td><a href="javascript:addCancel()"><img src="../../image/more/member_add_cancel.gif" width="96" height="21" border="0"></a></td>
		</tr>
		</table>
	</td></tr>
	
	<tr><td height=50></td></tr>
	
	</table>

</td>
</tr>
</form>
</table>	


</body>
</html>
<script>
self.resizeTo(document.body.scrollWidth,document.body.scrollHeight); 
</script>

<?
} ELSE {
?>
	<script language="javascript">
	location.href="/admin/";
	</script>
<?
}
?>

<?
mysql_close($connection);
?>