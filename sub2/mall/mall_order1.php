
<script>
	function order1_same()
	{
		document.order1_form.r_name.value=document.order1_form.o_name.value;
		document.order1_form.r_email.value=document.order1_form.o_email.value;
		document.order1_form.r_tel21.value=document.order1_form.o_tel21.value;
		document.order1_form.r_tel22.value=document.order1_form.o_tel22.value;
		document.order1_form.r_tel23.value=document.order1_form.o_tel23.value;
		document.order1_form.r_post1.value=document.order1_form.o_post1.value;
		document.order1_form.r_post2.value=document.order1_form.o_post2.value;
		document.order1_form.r_address1.value=document.order1_form.o_address1.value;
		document.order1_form.r_address2.value=document.order1_form.o_address2.value;
	}
</script>
<?


//echo "------>".$is_member;
$user_id = $_SESSION['ss_mb_id'];
if($user_id)
{	//ECHO "--->".$_SESSION['ss_mb_id'];
	$userInfoQuery = "select mb_no,  mb_id,  mb_name,  mb_nick, mb_email, mb_jumin,  mb_sex,  mb_birth,  mb_tel,  mb_hp,  mb_zip1,  mb_zip2,  mb_addr1,  mb_addr2 from g4_member where mb_id='$user_id'";
	$userInfo_ds = mysql_query($userInfoQuery, $connection) or die("userInfoQuery error");
	$userInfo_row = mysql_fetch_array($userInfo_ds);

	$data['o_name']			=$userInfo_row[mb_name];
	$data['o_email']		=$userInfo_row[mb_email];
	$data['o_tel21']		=@substr($userInfo_row[mb_hp],0,3);
	$data['o_tel22']		=@substr($userInfo_row[mb_hp],3,4);
	$data['o_tel23']		=@substr($userInfo_row[mb_hp],7,4);
	$data['o_address1']		=$userInfo_row[mb_addr1];
	$data['o_address2']		=$userInfo_row[mb_addr2];
	$data['o_post1']		=$userInfo_row[mb_zip1];
	$data['o_post2']		=$userInfo_row[mb_zip2];
	//echo "--->".$data['o_name']	;

}
?>
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
			<?
			include"../sub/mall/mall_basket_show.php";
			//include"./mall_basket_show.php";
			?>
			</td>
		</tr>
		<tr><td height=10></td></tr>
		<tr>
			<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td height="28" class=white1_bold_15>&nbsp;&nbsp;주문자 정보</td>
		</tr>
		<tr>
			<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
		</tr>
		</table>
		<form name="order1_form" method="post" onsubmit="return validate(this)" action="<?=$dark_define[site_url]?>/board/index.php?mode=mall_order2" >
	
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
		<tr>
			<td align="right"><strong>이름</strong></td>
			<td><input type="text" class="input" name="o_name" size="20" maxlength="20" minbyte="2"  hname="주문자 이름" value="<?=$data['o_name']?>" option="hanonly" required></td>
		</tr>
		<tr>
			<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td align="right"><strong>이메일</strong></td>
			<td><input type="text" class="input" name="o_email" size="40" maxlength="100" option="email" hname="주문자 이메일" value="<?=$data['o_email']?>" required></td>
		</tr>
		<tr>
			<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td align="right"><strong>연락처</strong></td>
			<td>
				<input type="text" class="input" name="o_tel21" size="4" maxlength="4" value="<?=$data['o_tel21']?>"  option="phone" span="3" hname="주문자 핸드폰번호" required> -
				<input type="text" class="input" name="o_tel22" size="4" maxlength="4" value="<?=$data['o_tel22']?>" /> -
				<input type="text" class="input" name="o_tel23" size="4" maxlength="4" value="<?=$data['o_tel23']?>" />
				
			</td>
		</tr>
		<tr>
			<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td align="right"><strong>우편번호</strong></td>
			<!-- <td>
				<input type="text" class="input" name="o_post1" size="3" maxlength="3" readonly value="<?=$data['o_post1']?>" span="2" hname="주문자 우편번호" required> -
				<input type="text" class="input" name="o_post2" size="3" maxlength="3" readonly value="<?=$data['o_post2']?>">
				<input name="button3" type="button" class="button" onClick="search_post('<?=$_url['member']?>','order1_form|o_post1|o_post2|o_address1|o_address2')" value='우편번호 검색'> 
			</td> -->
			<td>
				<input type="text" class="input" name="o_post1" size="3" maxlength="3"  value="<?=$data['o_post1']?>" span="2" hname="주문자 우편번호" required> -
				<input type="text" class="input" name="o_post2" size="3" maxlength="3"  value="<?=$data['o_post2']?>">
			
			</td>
		</tr>
		<tr>
			<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td align="right"><strong>주소</strong></td>
			<td>
				<input name="o_address1" type="text" class="input" id="o_address1" value="<?=$data['o_address1']?>" size="50"  hname="주문자 주소" required>
				<br><img width="1" height="5" /><br />
				<input name="o_address2" type="text" class="input" id="o_address2" value="<?=$data['o_address2']?>" size="35" hname="주문자 상세주소" >
				(상세주소)
			</td>
		</tr>
		</table>







		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td height="28" class=white1_bold_15>&nbsp;&nbsp;수신자 정보&nbsp;&nbsp; <input type='button' class='button' value='주문자 정보와 일치' onClick="order1_same()"></td>
		</tr>
		<tr>
			<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
		</tr>
		</table>
		
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
		<tr>
			<td align="right"><strong>이름</strong></td>
			<td><input type="text" class="input" name="r_name" size="20" maxlength="20" minbyte="2"  hname="수신자 이름" value="" option="hanonly" required></td>
		</tr>
		<tr>
			<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td align="right"><strong>이메일</strong></td>
			<td><input type="text" class="input" name="r_email" size="40" maxlength="100" option="email" hname="수신자 이메일" value="<?=$data['r_email']?>"></td>
		</tr>
		<tr>
			<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td align="right"><strong>연락처</strong></td>
			<td>
				<input type="text" class="input" name="r_tel21" size="4" maxlength="4" value="<?=$data['r_tel21']?>"  option="phone" span="3" hname="수신자 연락처" required> -
				<input type="text" class="input" name="r_tel22" size="4" maxlength="4" value="<?=$data['r_tel22']?>" /> -
				<input type="text" class="input" name="r_tel23" size="4" maxlength="4" value="<?=$data['r_tel23']?>" />
				
			</td>
		</tr>
		<tr>
			<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td align="right"><strong>우편번호</strong></td>
			<!-- <td>
				<input type="text" class="input" name="r_post1" size="3" maxlength="3" readonly value="<?=$data['r_post1']?>" span="2" hname="수신자 우편번호" required> -
				<input type="text" class="input" name="r_post2" size="3" maxlength="3" readonly value="<?=$data['r_post2']?>">
				<input name="button3" type="button" class="button" onClick="search_post('<?=$_url['member']?>','order1_form|r_post1|r_post2|r_address1|r_address2')" value='우편번호 검색'> 
			</td> -->
			<td>
				<input type="text" class="input" name="r_post1" size="3" maxlength="3"  value="<?=$data['r_post1']?>" span="2" hname="수신자 우편번호" required> -
				<input type="text" class="input" name="r_post2" size="3" maxlength="3"  value="<?=$data['r_post2']?>">
				
			</td>
		</tr>
		<tr>
			<td height="1" colspan="2" bgcolor="#ECECEC"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td align="right"><strong>주소</strong></td>
			<td>
				<input name="r_address1" type="text" class="input" id="r_address1" value="<?=$data['r_address1']?>" size="50" readonly hname="수신자 주소" required>
				<br><img width="1" height="5" /><br />
				<input name="r_address2" type="text" class="input" id="r_address2" value="<?=$data['r_address2']?>" size="35" hname="수신자 상세주소" \>
				(상세주소)
			</td>
		</tr>
		</table>


		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td height="3" bgcolor="#54A8BA"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td height="28" class=white1_bold_15>&nbsp;&nbsp;기타 </td>
		</tr>
		<tr>
			<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
		</tr>
		</table>
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="6">
	
		<tr>
			<td align="right"><strong>요청사항</strong></td>
			 <td><textarea name="r_demand" cols="50" rows="3" class="input" hname="요청사항" ><?=$data['r_demand']?></textarea></td>
		</tr>
		</table>



		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td height="1" bgcolor="#54A8BA"><img width="1" height="1"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="center"><input type="submit" value=" 다 음 >> " class="button"></td>
		</tr>
		</table>
		</form>
	</td>
</tr>
</table>
