<?
$g4_path='../../board';
include_once("$g4_path/common.php");
$g4['title'] = "";

/*
$update_href="$g4[house_path]/house_edit.php";
$write_href="$g4[house_path]/house_write.php";
$delete_href="$g4[house_path]/house_delete.php";
*/

include_once("./house_config.php");
include_once("$g4[path]/lib/trackback.lib.php");
$upload_max_filesize = ini_get('upload_max_filesize');
$reserch_date=date("Y");
if (empty($_POST))
    alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\n\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=$upload_max_filesize\\n\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");

// 리퍼러 체크
//referer_check();

$w = $_POST["w"];

if ($w == "" || $w == "u") {
    // 김선용 1.00 : 글쓰기 권한과 수정은 별도로 처리되어야 함
    if($w =="u" && $member['mb_id'] && $wr['mb_id'] == $member['mb_id'])
        ;
	// 외부에서 글을 등록할 수 있는 버그가 존재하므로 공지는 관리자만 등록이 가능해야 함
	if (!$is_admin && $notice)
		alert("관리자만 공지할 수 있습니다.");
} 
else 
    alert("w 값이 제대로 넘어오지 않았습니다."); 


if (!$is_member) {
    if ($w=='' || $w=='r') {
        $key = get_session("captcha_keystring");
        if (!($key && $key == $_POST[wr_key])) {
            session_unregister("captcha_keystring");
            alert("정상적인 접근이 아닌것 같습니다.");
        }
    }
}

if (!isset($_POST[h_nm]) || !trim($_POST[h_nm])) 
    alert("제목을 입력하여 주십시오."); 

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir("../../imageData", 0707);
@chmod("../../imageData", 0707);

// "인터넷옵션 > 보안 > 사용자정의수준 > 스크립팅 > Action 스크립팅 > 사용 안 함" 일 경우의 오류 처리
// 이 옵션을 사용 안 함으로 설정할 경우 어떤 스크립트도 실행 되지 않습니다.
//if (!$_POST[wr_content]) die ("내용을 입력하여 주십시오.");

// 가변 파일 업로드
$file_upload_msg = "";
$upload = array();
$a=0;
for ($i=0; $i<count($_FILES[bf_file][name]); $i++) 
{
	
	// 삭제에 체크가 되어있다면 파일을 삭제합니다.
	if ($_POST[bf_file_del][$i]) 
	{
		$t2=$_POST[bf_file_del][$i];
		$row = sql_fetch(" select I_filename from room_imageinfo where I_classify = 'H' and I_classify_id = '$wr_id' and I_id='$t2'");
		
		@unlink("../../imageData/$row[I_filename]");
		 sql_fetch("delete from room_imageinfo where I_classify = 'H' and I_classify_id = '$wr_id' and I_id='$t2'");
	}
	if(!$_FILES[bf_file][name][$i])
	{
		continue;
	}
	$tmp_file  = $_FILES[bf_file][tmp_name][$i];
	$filename  = $_FILES[bf_file][name][$i];
	$filesize  = $_FILES[bf_file][size][$i];

	// 서버에 설정된 값보다 큰파일을 업로드 한다면
	if ($filename)
	{
		if ($_FILES[bf_file][error][$i] == 1)
		{
			$file_upload_msg .= "\'{$filename}\' 파일의 용량이 서버에 설정($upload_max_filesize)된 값보다 크므로 업로드 할 수 없습니다.\\n";
			continue;
		}
		else if ($_FILES[bf_file][error][$i] != 0)
		{
			$file_upload_msg .= "\'{$filename}\' 파일이 정상적으로 업로드 되지 않았습니다.\\n";
			continue;
		}
	}

	if (is_uploaded_file($tmp_file))
	{
		// 4.00.11 - 글답변에서 파일 업로드시 원글의 파일이 삭제되는 오류를 수정
		if ($w == 'u')
		{
			// 존재하는 파일이 있다면 삭제합니다.
			$t1=$_POST[bf_file_del][$i];
			$row = sql_fetch(" select I_filename from room_imageinfo where I_classify = 'H' and I_classify_id = '$wr_id' and I_id='$t1'");
			@unlink("../../imageData/$row[I_filename]");
			 sql_fetch("delete from room_imageinfo where I_classify = 'H' and I_classify_id = '$wr_id' and I_id='$t1'");
		}

		// 프로그램 원래 파일명
		$upload[$a][source] = $filename;
		$upload[$a][filesize] = $filesize;

		// 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
		$filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

		// 접미사를 붙인 파일명
		//$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.urlencode($filename);
		// 달빛온도님 수정 : 한글파일은 urlencode($filename) 처리를 할경우 '%'를 붙여주게 되는데 '%'표시는 미디어플레이어가 인식을 못하기 때문에 재생이 안됩니다. 그래서 변경한 파일명에서 '%'부분을 빼주면 해결됩니다. 
	
			$upload[$a][file] =str_replace('%', '', urlencode($filename)); 
			
			$dest_file = "../../imageData/" . $upload[$a][file];
			$di=1;
			while(file_exists($dest_file))
			{
				
				$ex_filename=explode('.',$filename);
				$ex_filename[count($ex_filename)-2]=$ex_filename[count($ex_filename)-2]."_".$di;
				$filename_t=implode('.',$ex_filename);
				$upload[$a][file] =str_replace('%', '', urlencode($filename_t));  
				
				$dest_file = "../../imageData/" . $upload[$a][file];
				$di++;
			}
		
		// 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
		$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES[bf_file][error][$i]);

		// 올라간 파일의 퍼미션을 변경합니다.
		chmod($dest_file, 0606);

		$upload[$a][image] = @getimagesize($dest_file);
		
	}
	$a++;
}

// 가변 파일 업로드 룸
$rm_file_upload_msg = "";
$rm_upload = array();

$a=0;
$b=0;
for ($i0=0; $i0<count($_FILES[rm_file][name]); $i0++) //13개, 한 방에 들어가는 최대 이미지 개수 이다.
{

	for($i=0;$i<count($_FILES[rm_file][name][$i0]);$i++)//방의 개수 이다.
	{
		//if(!$_FILES[rm_file][name][$i0][$i])continue;

		//삭제에 체크가 되어있다면 파일을 삭제합니다.
		$rm_del_name="rm_file_del_".$i;
		if ($_POST[$rm_del_name][$i0]) 
		{
			$t1=$_POST[$rm_del_name][$i0];
			$row = sql_fetch(" select I_filename from room_imageinfo where I_classify = 'R' and I_classify_id = '$wr_id' and I_id='$t1'");
			@unlink("../../imageData/$row[I_filename]");
			 sql_fetch("delete from room_imageinfo where I_classify = 'R' and I_classify_id = '$wr_id' and I_id='$t1'");
		}
		
		if(!$_FILES[rm_file][name][$i0][$i])
		{
			$a++;
			continue;
		}
		$tmp_file  = $_FILES[rm_file][tmp_name][$i0][$i];
		$filename  = $_FILES[rm_file][name][$i0][$i];
		$filesize  = $_FILES[rm_file][size][$i0][$i];
		
		// 서버에 설정된 값보다 큰파일을 업로드 한다면
		if ($filename)
		{
			if ($_FILES[rm_file][error][$i0][$i] == 1)
			{
				$rm_file_upload_msg .= "\'{$filename}\' 파일의 용량이 서버에 설정($upload_max_filesize)된 값보다 크므로 업로드 할 수 없습니다.\\n";
				$a++;
				continue;
			}
			else if ($_FILES[rm_file][error][$i0][$i] != 0)
			{
				$rm_file_upload_msg .= "\'{$filename}\' 파일이 정상적으로 업로드 되지 않았습니다.\\n";
				$a++;
				continue;
			}
		}
		
		if (is_uploaded_file($tmp_file))
		{
			// 4.00.11 - 글답변에서 파일 업로드시 원글의 파일이 삭제되는 오류를 수정
			if ($w == 'u')
			{
				// 존재하는 파일이 있다면 삭제합니다.
				$t3=$_POST[rm_file_del][$a];
				$row = sql_fetch(" select I_filename from room_imageinfo where I_classify = 'R' and I_classify_id = '$wr_id' and I_id='$t3'");
				@unlink("../../imageData/$row[I_filename]");
				 sql_fetch("delete from room_imageinfo where I_classify = 'R' and I_classify_id = '$wr_id' and I_id='$t3'");
			}

			// 프로그램 원래 파일명
			$rm_upload[$b][source] = $filename;
			$rm_upload[$b][filesize] = $filesize;
			$rm_upload[$b][room_count]=$i;
			
			// 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
			$filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

			// 접미사를 붙인 파일명
			//$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.urlencode($filename);
			// 달빛온도님 수정 : 한글파일은 urlencode($filename) 처리를 할경우 '%'를 붙여주게 되는데 '%'표시는 미디어플레이어가 인식을 못하기 때문에 재생이 안됩니다. 그래서 변경한 파일명에서 '%'부분을 빼주면 해결됩니다. 

			$rm_upload[$b][file] = str_replace('%', '', urlencode($filename)); 
			$dest_file = "../../imageData/" . $rm_upload[$b][file];
			$di=1;
			while(file_exists($dest_file))
			{
				$ex_filename=explode('.',$filename);
				$ex_filename[count($ex_filename)-2]=$ex_filename[count($ex_filename)-2]."_".$di;
				$filename_t=implode('.',$ex_filename);
				$rm_upload[$b][file] =str_replace('%', '', urlencode($filename_t));  
				$dest_file = "../../imageData/" . $rm_upload[$b][file];
				$di++;
			}

			

			// 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
			$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES[rm_file][error][$i0][$i]);

			// 올라간 파일의 퍼미션을 변경합니다.
			chmod($dest_file, 0606);

			$rm_upload[$b][image] = @getimagesize($dest_file);
			$b++;

		}
		$a++;
	}
}



if ($w == "" || $w == "r") 
{
    if ($member[mb_id]) 
    {
        $mb_id = $member[mb_id];
        $wr_name = $board[bo_use_name] ? $member[mb_name] : $member[mb_nick];
        $wr_password = $member[mb_password];
        $wr_email = $member[mb_email];
        $wr_homepage = $member[mb_homepage];
    } 
    else 
    {
        $mb_id = "";
        // 비회원의 경우 이름이 누락되는 경우가 있음
        if (!trim($wr_name))
            alert("이름은 필히 입력하셔야 합니다.");
        $wr_password = sql_password($wr_password);
    }

	$sql = " insert into room_house set
				add_div='$add_div',
				owner_cd='$owner_cd',
				h_nm='$h_nm',
				add1='$add1',
				add2='$add2',
				zipcode='$zipcode',
				build_year='$build_year',
				owner_stay_type='$owner_stay_type',
				exp='$exp',
				html='$html',
				phone='$phone',
				mphone='$mphone',
				owner_stay_exp='$owner_stay_exp',
				room_type='$room_type',
				content='$wr_content',
				fit='$fit',
				gx='$gx',
				open='$open',
				h_visit='$h_visit',
				reserch_date='$reserch_date',
				gy='$gy'";
	sql_query($sql);

    $wr_id = mysql_insert_id();
	
	for($r=0;$r < count($r_nm);$r++)
	{
		$rsql="
		insert into room_room set
			h_cd='$wr_id',
			r_nm='$r_nm[$r]',
			type='$type[$r]',
			charter_yn='$charter_yn[$r]',
			charter_price='$charter_price[$r]',
			c_credit_yn='$c_credit_yn[$r]',
			c_credit_price='$c_credit_price[$r]',
			monthly_yn='$monthly_yn[$r]',
			monthly_price='$monthly_price[$r]',
			m_credit_yn='$m_credit_yn[$r]',
			m_credit_price='$m_credit_price[$r]',
			price_ext='$price_ext[$r]',
			col_size='$col_size[$r]',
			row_size='$row_size[$r]',
			size1='$size1[$r]',
			size2='$size2[$r]',
			desk_yn='$desk_yn[$r]',
			aircon_yn='$aircon_yn[$r]',
			refri_yn='$refri_yn[$r]',
			option_info='$option_info[$r]',
			water_tax_type='$water_tax_type[$r]',
			elec_tax_type='$elec_tax_type[$r]',
			boiler_type='$boiler_type[$r]',
			boiler_control='$boiler_control[$r]',
			brightness='$brightness[$r]',
			shower='$shower[$r]',
			bathroom='$bathroom[$r]',
			kichen='$kichen[$r]',
			balcony='$balcony[$r]',
			reserch_date='$reserch_date',
			water_control='$water_control[$r]',
			boiler_control_exp='',
			elec_tax_exp='',
			bathroom_exp='',
			shower_exp='',
			kichen_exp='',
			balcony_exp='',
			water_control_exp='',
			boiler_exp=''
		";
		sql_query($rsql);

		 $tr=$room_id[$r] = mysql_insert_id();
	}
} 
else if ($w == "u") 
{
    if ($member[mb_id]) 
    {
        // 자신의 글이라면
        if ($member[mb_id] == $wr[mb_id]) 
        {
            $mb_id = $member[mb_id];
            $wr_name = $board[bo_use_name] ? $member[mb_name] : $member[mb_nick];
            $wr_email = $member[mb_email];
            $wr_homepage = $member[mb_homepage];
        } 
        else
        {
            $mb_id = $wr[mb_id];
            $wr_name = $wr[wr_name];
            $wr_email = $wr[wr_email];
            $wr_homepage = $wr[wr_homepage];
        }
    } 
    else 
    {
        $mb_id = "";
        // 비회원의 경우 이름이 누락되는 경우가 있음
        //if (!trim($wr_name)) alert("이름은 필히 입력하셔야 합니다.");
    }

    $sql_password = $wr_password ? " , wr_password = '".sql_password($wr_password)."' " : "";

    $sql_ip = "";
    if (!$is_admin)
        $sql_ip = " , wr_ip = '$_SERVER[REMOTE_ADDR]' ";

    $sql = " update room_house set
				add_div='$add_div',
				owner_cd='$owner_cd',
				h_nm='$h_nm',
				add1='$add1',
				add2='$add2',
				content='$wr_content',
				zipcode='$zipcode',
				build_year='$build_year',
				owner_stay_type='$owner_stay_type',
				exp='$exp',
				html='$html',
				phone='$phone',
				mphone='$mphone',
				open='$open',
				h_visit='$h_visit',
				owner_stay_exp='$owner_stay_exp',
				room_type='$room_type',
				fit='$fit'
               where h_cd = '$wr_id' ";
    sql_query($sql);

	for($r=0;$r < count($r_nm);$r++)
	{
		if($r_cd[$r])
		{
			$rsql="
			update room_room set
				r_nm='$r_nm[$r]',
				type='$type[$r]',
				charter_yn='$charter_yn[$r]',
				charter_price='$charter_price[$r]',
				c_credit_yn='$c_credit_yn[$r]',
				c_credit_price='$c_credit_price[$r]',
				monthly_yn='$monthly_yn[$r]',
				monthly_price='$monthly_price[$r]',
				m_credit_yn='$m_credit_yn[$r]',
				m_credit_price='$m_credit_price[$r]',
				price_ext='$price_ext[$r]',
				col_size='$col_size[$r]',
				row_size='$row_size[$r]',
				size1='$size1[$r]',
				size2='$size2[$r]',
				desk_yn='$desk_yn[$r]',
				aircon_yn='$aircon_yn[$r]',
				refri_yn='$refri_yn[$r]',
				option_info='$option_info[$r]',
				water_tax_type='$water_tax_type[$r]',
				elec_tax_type='$elec_tax_type[$r]',
				boiler_type='$boiler_type[$r]',
				boiler_control='$boiler_control[$r]',
				brightness='$brightness[$r]',
				shower='$shower[$r]',
				bathroom='$bathroom[$r]',
				kichen='$kichen[$r]',
				balcony='$balcony[$r]',
				reserch_date='$reserch_date',
				water_control='$water_control[$r]',
				boiler_control_exp='',
				elec_tax_exp='',
				bathroom_exp='',
				shower_exp='',
				kichen_exp='',
				balcony_exp='',
				water_control_exp='',
				boiler_exp=''
			where 
				h_cd = '$wr_id' and
				r_cd='$r_cd[$r]'
			";
			sql_query($rsql);
			$room_id[$r] = $r_cd[$r];
		}
		else
		{
			$rsql="
			insert into room_room set
				h_cd='$wr_id',
				r_nm='$r_nm[$r]',
				type='$type[$r]',
				charter_yn='$charter_yn[$r]',
				charter_price='$charter_price[$r]',
				c_credit_yn='$c_credit_yn[$r]',
				c_credit_price='$c_credit_price[$r]',
				monthly_yn='$monthly_yn[$r]',
				monthly_price='$monthly_price[$r]',
				m_credit_yn='$m_credit_yn[$r]',
				m_credit_price='$m_credit_price[$r]',
				price_ext='$price_ext[$r]',
				col_size='$col_size[$r]',
				row_size='$row_size[$r]',
				size1='$size1[$r]',
				size2='$size2[$r]',
				desk_yn='$desk_yn[$r]',
				aircon_yn='$aircon_yn[$r]',
				refri_yn='$refri_yn[$r]',
				option_info='$option_info[$r]',
				water_tax_type='$water_tax_type[$r]',
				elec_tax_type='$elec_tax_type[$r]',
				boiler_type='$boiler_type[$r]',
				boiler_control='$boiler_control[$r]',
				brightness='$brightness[$r]',
				shower='$shower[$r]',
				bathroom='$bathroom[$r]',
				kichen='$kichen[$r]',
				balcony='$balcony[$r]',
				reserch_date='$reserch_date',
				water_control='$water_control[$r]',
				boiler_control_exp='',
				elec_tax_exp='',
				bathroom_exp='',
				shower_exp='',
				kichen_exp='',
				balcony_exp='',
				water_control_exp='',
				boiler_exp=''
			";
			sql_query($rsql);
			$room_id[$r] = mysql_insert_id();
		}
		
	}
}
if(is_array($room_del))
{
	//for($i=0;$i<=count($room_del);$i++)
	$i=0;
	foreach($room_del as $value)
	{
		$i_2=$i+1;
		$te=$room_del[$i];
	
		if($value)
		{
			$r_cd=$value;

			$dsql="delete from room_room where r_cd='$r_cd' and h_cd='$wr_id'";
	
			$result=sql_query($dsql);
		}
		$i++;
	}
}
//------------------------------------------------------------------------------
// 가변 파일 업로드
// 나중에 테이블에 저장하는 이유는 $wr_id 값을 저장해야 하기 때문입니다.

for ($i=0; $i<count($upload); $i++) 
{

		$t5=$upload[$i][file];

		if($t5)
		{
			$sql = " 
			insert into room_imageinfo
				set I_classify = 'H',
					I_classify_id = '$wr_id',
					wdate=now(),
					reserch_date='$reserch_date',
					I_filename='$t5'
				";
			sql_query($sql);
		
		}   
}

// 가변 파일 업로드 룸
// 나중에 테이블에 저장하는 이유는 $wr_id 값을 저장해야 하기 때문입니다.
for ($i=0; $i<count($rm_upload); $i++) 
{
	
	//$room_id=$room_id[];
	$room_index=$rm_upload[$i][room_count];
	$t7=$rm_upload[$i][file];
	$room_id_v=$room_id[$room_index];
	if($t7)
	{
		$sql = " insert into room_imageinfo
					set I_classify = 'R',
						I_classify_id = '$wr_id',
						wdate=now(),
						I_room_id='$room_id_v',
						reserch_date='$reserch_date',
						I_filename='$t7'
					";
		sql_query($sql);
		
	}

    
}

// 업로드된 파일 내용에서 가장 큰 번호를 얻어 거꾸로 확인해 가면서
// 파일 정보가 없다면 테이블의 내용을 삭제합니다.
$row = sql_fetch(" select max(I_id) as max_i_no from room_imageinfo where I_classify = 'H' and I_classify_id = '$wr_id' ");
for ($i=(int)$row[max_i_no]; $i>=0; $i--) 
{
    $row2 = sql_fetch(" select I_filename from room_imageinfo where I_classify = 'H' and I_classify_id = '$wr_id'");

    // 정보가 있다면 빠집니다.
    if ($row2[I_filename]) break;

    // 그렇지 않다면 정보를 삭제합니다.
    sql_query(" delete from room_imageinfo where I_classify = 'H' and I_classify_id = '$wr_id'");
}
//exit;
//------------------------------------------------------------------------------
// 비밀글이라면 세션에 비밀글의 아이디를 저장한다. 자신의 글은 다시 패스워드를 묻지 않기 위함
if ($secret) 
    set_session("ss_secret_H_{$wr_num}", TRUE);

if ($file_upload_msg)
    alert($file_upload_msg, "{$g4[home_file]}?mode=house_list&page=$page&" . $qstr);
else
    goto_url("{$IU[url]}/index.php?mode=house_view&h_cd=$wr_id&" . $qstr);