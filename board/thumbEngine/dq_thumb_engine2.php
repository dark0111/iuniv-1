<?
/*--------------------------------------------------------------------------------------------------------------

 ■ DQ'Thumb Engine ver 2.0 R5.0306

	최종 수정: 2005-03-06
	제작     : 드림퀘스트(본명:안현우)
	Homepage : http://www.dqstyle.com
	E-Mail   : dwander@netian.com

 ■ 라이센스
	 1. 이 주석의 전체 또는 일부를 삭제하거나 수정하실 수 없습니다.
	 2. 제로보드용 스킨 제작에 사용할 수 있는 섬네일 관련 라이브러리 입니다.
	 3. 스킨제작 이외의 목적에 사용하실 수 있습니다.
	 4. 상업적 용도(영리목적의 홈페이지 포함)에 이용할 수 없습니다.
	 5. 제작된 프로그램의 특정위치에 "DQ'Engine Used" 문구를 삽입할수 있으며,
	    클릭시 엔진 제작자 홈페이지(http://www.dqstyle.com)로 연결되어야 합니다.
	 6. "DQ'Engine Used" 문구는 반드시 삽입해야 하는것은 아닙니다. 자유의사에 맏깁니다.
	 7. 소스 중간의 버전출력 부분을 삭제하실 수 없습니다.
	 8. 제작자는 유지보수와 업그레이드의 의무가 없으며 사용도중 발생한 문제와 손실에
	    대하여 어떠한 경우라도 책임을 지지 않습니다.
	 9. 이 소스의 단독 배포 권한은 www.dqstyle.com과 제작자가 지정한 사이트에만 있습니다.
	10. 제작한 스킨이나 프로그램의 일부요소로만 재배포 할 수 있습니다.
	11. 이 소스를 사용하여 제작한 프로그램의 저작권은 해당 프로그램의 제작자에게 있지만,
	    이 소스의 저작권은 제작한 프로그램과는 별개 이므로 어떠한 경우에도 원 저작자 이외의 
		인물이나 단체에 양도 또는 이전되지 않습니다.

--------------------------------------------------------------------------------------------------------------*/

	global $dqEngine;
	if(!is_array($_SERVER)) global $_SERVER;

// 중복 인클루드 검사
	if(defined("_DQ_THUMB_ENGINE_INCLUDE")) return;
    define("_DQ_THUMB_ENGINE_INCLUDE",true);


// 설정
	if(phpversion()<'4.3.5' && !@ini_get("allow_url_fopen")) set_URLOpen(1);
	if(!isset($dqEngine['using_urlenc'])) $dqEngine['using_urlenc'] = 1;
	$dqEngine['document_root']	= get_indexDir();
	$dqEngine['gd_version']		= isset($dqEngine['gd_version'])		? $dqEngine['gd_version']	: get_gdVersion();
	$dqEngine['using_socket']	= isset($dqEngine['using_socket'])		? 
		$dqEngine['using_socket']	: @ini_get("allow_url_fopen") ? 0 : 1;
	$dqEngine['using_urlImg']	= isset($dqEngine['using_urlImg'])		? 
		$dqEngine['using_urlImg'] : ($dqEngine['using_socket'] | @ini_get("allow_url_fopen"))? 1 : '0';
	$dqEngine['using_usm']		= isset($dqEngine['using_usm'])			? $dqEngine['using_usm']	: 1;
	$dqEngine['usm_option1']	= isset($dqEngine['usm_option1'])		? $dqEngine['usm_option1']	: 60;
	$dqEngine['usm_option2']	= isset($dqEngine['usm_option2'])		? $dqEngine['usm_option2']	: 0.5;
	$dqEngine['usm_option3']	= isset($dqEngine['usm_option3'])		? $dqEngine['usm_option3']	: 1;
	$dqEngine['thumb_resize']	= isset($dqEngine['thumb_resize'])		? $dqEngine['thumb_resize']	: 0;
	$dqEngine['thumb_cutpixel']	= isset($dqEngine['thumb_cutpixel'])	? $dqEngine['thumb_cutpixel'] : 5;
	$dqEngine['using_secretImg']= isset($dqEngine['using_secretImg'])	? $dqEngine['using_secretImg']: 1;
//	$dqEngine['']	= $skin_setup[''] ? $skin_setup[''] : '0';
	
// 버젼 출력(삭제하지 말것!, 삭제시 라이센스 위반)
	echo "\n\n\n<!-- ■ DQ'Thumb Engine ver 2.0 R5.0306 for developer - http://www.dqstyle.com -->\n\n";

// GD라이브러리 검사
	/*
	$_GD_VERSION = get_gdVersion();
	if(!$_GD_VERSION) die("<b>섬네일 엔진 오류</b><br><br>GD라이브러리가 없습니다.<br>서버관리자에게 문의하십시오.");
	*/

//제로보드 절대 경로 알아내기
	function get_zbPath() {
		global $_zb_path;

		if($_zb_path && file_exists($_zb_path."zboard.php")) return $_zb_path;
		else {
			if(@is_file("./zboard.php")) $_zb_path = realpath("./");
			elseif(@is_file("../zboard.php")) $_zb_path = realpath("../");
			elseif(@is_file("../../zboard.php")) $_zb_path = realpath("../../");
			elseif(@is_file("../../../zboard.php")) $_zb_path = realpath("../../../");
			elseif(@is_file("../../../../zboard.php")) $_zb_path = realpath("../../../../");

			if($_zb_path) $_zb_path .= "/";
		}
		if($_zb_path) return $_zb_path;
	}

// 제로보드 게시물에서 섬네일 추출
	function get_zbThumb($data,$thumb_x,$thumb_y,$target_file="") {
		global $id, $dqEngine, $is_vdel, $dqEngine;

	// 제로보드 데이타 디렉토리 생성
		if(!$target_file && $data && $id && !file_exists("data/$id")) { mkdir("data/$id"); chmod("data/$id", 0707); }

	// GD버전 알아내기
		$_GD_VERSION = $dqEngine[gd_version] ? $dqEngine[gd_version] : get_gdVersion();

	// 생성될 섬네일 파일
		if(!$target_file) $target_file = "data/$id/small_$data[no]".".thumb";

	// 업로드된 이미지 목록을 배열로 저장
		$tmp = get_uploadImages(&$data,1);
		$images = $tmp[0];
		$s_images = $tmp[1];
		$images_size = $tmp[2];

//		if($is_vdel) $del = '1';
//		if($dqEngine['thumb_source'] == 'member') $del = '0';
//		if(!$del) {
			if($images) {
			  $filename=make_thumb($thumb_x,$thumb_y,$images[0],$target_file);
			} elseif($dqEngine['using_urlImg']) {
			  $prtstr = @get_imgTag($data['memo'],$data[ismember],1);
			  $prtstr = get_urlPath($prtstr[0]);

			  if($prtstr && $_GD_VERSION) $filename = get_ThumbnailFromHTMLTag($thumb_x,$thumb_y,$prtstr,$target_file);
			  //if(!$filename) $filename=$prtstr;
			}
			return $filename;
//		}
	}

// 섬네일 태그 만들기
	function get_thumbTag($data, $x, $y, $dir, $target_file="") {
		global $id, $skin_setup, $dqEngine;

	// 이미지 없을때
		if(substr($dir,strlen($dir)-1,1) == '/') $dir = substr($dir,0,strlen($dir)-1);
		$no_image = $dir."/".$skin_setup['css_dir']."no_screenshot.jpg";

	// 생성될 섬네일 파일
		if(!$target_file) $target_file = "data/$id/small_$data[no]".".thumb";

	// 임시 파일이 있는지 검사
		if(file_exists($target_file.".work")) $ret=$no_image;
		else {
			if($dqEngine['using_secretImg'] && $data[is_secret]) {
				$ret = $dir."/".$skin_setup['css_dir']."is_secret.jpg";
			} 
			else {
				$ret = get_zbThumb(&$data, $x, $y, $target_file);
				if($ret && !eregi(".thumb",$ret)) $org = true;
				if(!$ret) $ret=$no_image;
			}
		} 

		//if(eregi('://',$ret)) $img_size = @getimagesize(get_url2realpath($ret));
		if(eregi('://',$ret)) $img_size = @getimagesize($ret);
		elseif(!$org) $img_size = @getimagesize($ret);
		else $img_size = cal_thumb_size($ret,$x,$y);

		$str_docroot = $dqEngine['document_root'];
		if(substr($ret,0,strlen($str_docroot)) == $str_docroot) $ret=str_replace($str_docroot,'',$ret);

		$ret_tag[0] = $img_size[0];
		$ret_tag[1] = $img_size[1];
		$ret_tag[2] = "<img src=\"$ret\" width=\"$img_size[0]\" height=\"$img_size[1]\" class=\"thumb_border\" onFocus=\"blur()\" border=\"0\">";
		$ret_tag[3] = $ret;

		return $ret_tag;
	}

//섬네일 생성
	function make_thumb($max_x,$max_y,$src_file,$target_file="") {
		global $dqEngine, $setup, $id;

	// 타겟파일 검사/지정
		$_fThumbnail = $target_file;
		if(!$_fThumbnail) {
			$tmp = pathinfo($src_file);
			$_fThumbnail = $tmp['extension'].".thumb";
		}

		if(file_exists($_fThumbnail)) $comp_file=$_fThumbnail; else $comp_file=$src_file;
		if(!chk_imgfile($comp_file,$max_x,$max_y) || !($max_x||$max_y)) return $comp_file;

		if (file_exists($src_file) && filesize($src_file)) {

			$_GD_VERSION = $dqEngine[gd_version];
			//if(!$_GD_VERSION) $_GD_VERSION = get_GDVersion();
			unset($_gd_support);

			$gd_info = get_gdinfo();
			
			$_GIF_Engine = dirname(realpath(__FILE__))."/phpthumb.gif.php";
			if($gd_info['JPG Support'] && @file_exists($_GIF_Engine)) $gd_info['GIF Read Support2'] = true;

			if($_GD_VERSION) {
				if($gd_info['GIF Read Support'])	$_gd_support .=".gif";
				if($gd_info['GIF Read Support2'])	$_gd_support .=".gif";
				if($gd_info['JPG Support'])			$_gd_support .=".jpg";
				if($gd_info['PNG Support'])			$_gd_support .=".png";
				if($_GD_VERSION >= 2)				$_gd_support .=".GD2"; else $_gd_support .=".GD1";
			}

			$srcimg_info = @getimagesize($src_file);
			switch($srcimg_info[2]) {
				case 1:	$file_type = "gif";	break;
				case 2:	$file_type = "jpg";	break;
				case 3:	$file_type = "png";	break;
				case 6:	$file_type = "bmp";	break;
				default: $file_type = "not support";
			}

			if (($gd_info['JPG Support']||$gd_info['PNG Support']||$gd_info['GIF Create Support']) && ereg($file_type,$_gd_support)) {

				$_fThumbWorkFile = $_fThumbnail.".work";
				if(!file_exists($_fThumbWorkFile)) {
					$fp = fopen($_fThumbWorkFile, "w");
					fwrite($fp, "Thumbnail image create works file");
					fclose($fp);
				}

				$cal_size = cal_thumb_size($src_file,$max_x,$max_y);

				switch($file_type) {
					case "jpg": $src_img=ImageCreateFromjpeg($src_file); break;
					case "gif": 
						if($gd_info['GIF Read Support']) $src_img=ImageCreateFromgif($src_file); 
						elseif($gd_info['GIF Read Support2']) {
							include_once $_GIF_Engine;
							$src_img=gif_loadFileToGDimageResource($src_file);
						} break;
					case "png": $src_img=ImageCreateFrompng($src_file); break;
					case "bmp": $src_img=ImageCreateFromwbmp($src_file); break;
				}

				if(ereg(".GD2",$_gd_support)) $dst_img=ImageCreateTrueColor($cal_size[0], $cal_size[1]);
				if(!$dst_img) $dst_img=ImageCreate($cal_size[0], $cal_size[1]);
				
				$color = imagecolorallocate($dst_img,255,255,255);
				imagefill($dst_img,1,1,$color);

				$x1 = $cal_size[4] ? 0 - ($cal_size[4] - $cal_size[0])/2 : 0;
				$y1 = $cal_size[5] ? 0 - ($cal_size[5] - $cal_size[1])/2 : 0;
				$x2 = $cal_size[4] ? $cal_size[4] : $cal_size[0];
				$y2 = $cal_size[5] ? $cal_size[5] : $cal_size[1];

					if($cal_size[4] || $cal_size[5]) {
						$cut_pixel = 0;
						$pixel_count = $srcimg_info[0] * $srcimg_info[1];
						if($pixel_count >= 1600) $cut_pixel = $dqEngine['thumb_cutpixel'];
						$sx1=$cut_pixel; $sy1=$cut_pixel;
						$sx2 = $cut_pixel ? ImageSX($src_img)-($cut_pixel*2) : ImageSX($src_img); 
						$sy2 = $cut_pixel ? ImageSY($src_img)-($cut_pixel*2) : ImageSY($src_img);
					} else {
						$sx1=0; $sy1=0;
						$sx2 = ImageSX($src_img);
						$sy2 = ImageSY($src_img);
					}

				if(ereg(".GD2",$_gd_support)) $thumb_img=imageCopyResampled(
					$dst_img,$src_img,$x1,$y1,$sx1,$sy1,$x2,$y2,$sx2,$sy2);
				if(!$thumb_img) $thumb_img = imageCopyResized(
					$dst_img,$src_img,$x1,$y1,$sx1,$sy1,$x2,$y2,$sx2,$sy2);

				if ($target_dir && !file_exists($target_dir)) {
					$_mkdir=substr($target_dir,0,strlen($target_dir)-1);
					if(!@mkdir ($_mkdir,0707)) error("디렉토리 만들기 실패<br>".$_mkdir);
					if(!@chmod ($_mkdir,0707)) error("퍼미션 에러<br>".$_mkdir);
				}

				if($_GD_VERSION >= 2  && $dqEngine[using_usm] && function_exists('UnsharpMask')) {
					//set_time_limit(20);
					$dst_img = UnsharpMask($dst_img,$dqEngine['usm_option1'],$dqEngine['usm_option2'],$dqEngine['usm_option3']);
				}

			// 이미지 품질
				$_thumbnail_quality = 85;

				if($gd_info['JPG Support']) ImageJpeg($dst_img,$_fThumbnail,$_thumbnail_quality);
				elseif($gd_info['PNG Support']) ImagePng($dst_img,$_fThumbnail,$_thumbnail_quality);
				elseif($gd_info['GIF Create Support']) ImageGif($dst_img,$_fThumbnail,$_thumbnail_quality);

				chmod($_fThumbnail,0706);
				ImageDestroy($dst_img);
				ImageDestroy($src_img);

				unlink($_fThumbWorkFile);
				if(file_exists($_fThumbnail)) return $_fThumbnail;
				else return $src_file;
			} 
			return $src_file;
		}
	}

// HTML 태그를 분석하여 섬네일 생성
	function get_ThumbnailFromHTMLTag($thumb_x,$thumb_y, $tag_str, $target_file) {
		global $_SERVER, $dqEngine;

		if(!$dqEngine['using_urlImg']) return '';

		if(chk_imgfile($target_file,$thumb_x,$thumb_y)) {

		  // 링크 이미지가 로컬서버 내에 존재할때
			if(substr($_SERVER[HTTP_HOST],0,4)=="www." && substr($_SERVER[REQUEST_URI],0,2)!="/~")
				$HH = substr($_SERVER[HTTP_HOST],4,strlen($_SERVER[HTTP_HOST])); else $HH = $_SERVER[HTTP_HOST];

			if ($tag_str && @eregi($HH, $tag_str)){
			  // 경로나 호스트에 www.가 포함되었을때의 처리
				if(!@eregi("www.",$_SERVER[HTTP_HOST]) && eregi("www.",$tag_str)) {
					$tag_str=str_replace("www.","",$tag_str);
					$tag_str=get_indexDir()."/".eregi_replace($HH."/","",eregi_replace("http://","",$tag_str));
				} elseif(eregi("www.",$_SERVER[HTTP_HOST]) && !eregi("www.",$tag_str)) {
					$tag_str=get_indexDir()."/".eregi_replace($HH."/","",eregi_replace("http://","",$tag_str)); 
				} else $tag_str=get_indexDir()."/".eregi_replace($_SERVER[HTTP_HOST]."/","",eregi_replace("http://","",$tag_str));

				if(file_exists($tag_str)) 
					 $filename = make_thumb($thumb_x,$thumb_y,$tag_str,$target_file);
				else $filename = "";
				if(file_exists($filename)) return($filename); else return("");
			}

			$_fThumbWorkFile = $target_file.".work";
			$fp = fopen($_fThumbWorkFile, "w");
			fwrite($fp, "Get remote image works file");
			fclose($fp);

			if($dqEngine['using_socket']) {
			  // 소켓 방식으로 시도
				$str_info = parse_url($tag_str);
				$str_info['port'] = $str_info['port'] ? $str_info['port'] : 80;
				$fp=@fsockopen($str_info['host'],$str_info['port']);
				if($fp) {
					fputs($fp,"GET $str_info[path] HTTP/1.1\r\n"); 
					fputs($fp,"Host: $str_info[host]\r\n"); 
					fputs($fp,"User-Agent: Mozilla/4.0\r\n\r\n");

					while(trim($buffer = fgets($fp,128)) != "") {
						if(eregi('Content-Type: ',$buffer)) $header = $buffer;
					}
					//set_time_limit(30);
					//socket_set_blocking($fp,false);
					$urlfile_is_image = '1';
					while(!feof($fp) && connection_status()==0) $urlFile .= fread($fp,1024);
				}
			} else {
			// url_fopen 으로 시도
				$fp=@fopen($tag_str, "r");
				$urlfile_is_image = '1';
				if($fp) {
					while(!feof($fp) && connection_status()==0) {
						$urlFile = $urlFile.fread($fp,1024);
					}
				}
			}
			if($fp) fclose($fp);
			unlink($_fThumbWorkFile);

		// 임시파일 저장
			if($fp && $urlfile_is_image) {
				$_thumb_temp = tempnam("./data", "thumb_temp_");

				$fp = fopen($_thumb_temp, "w");
				fwrite($fp, $urlFile);
				fclose($fp);

				$filename = make_thumb($thumb_x,$thumb_y,$_thumb_temp,$target_file);
				if (!file_exists($filename)) $filename="";
				$rt_str = $filename;
			}

			if(file_exists($_thumb_temp)) @unlink($_thumb_temp);
			return $rt_str;
		} else {
			if(file_exists($target_file)) return $target_file;
			else return;
		}
	}

// 생성될 섬네일 이미지의 크기계산
	function cal_thumb_size($src_file, $max_x,$max_y) {
		global $dqEngine;

		static $oldInfo = array();
		if($src_file == $oldInfo[3] && $max_x == $oldInfo[0] && $max_y == $oldInfo[1]) {
			$cal_size = $oldInfo;
			return $cal_size;
		}

		$img_info = @getimagesize ($src_file);
		$sx = $img_info[0];
		$sy = $img_info[1];

	// 원본 이미지에 문제가 있다면 중단
		if(!$src_file || !$sx || !$sy) return false;

		if(!$dqEngine['gd_version'] && $dqEngine['thumb_resize'] > 0) $dqEngine['thumb_resize'] = 0;

		switch($dqEngine['thumb_resize']) {
		case 0: // 원본의 비율대로 대칭 리사이즈
			if($max_x != 0 && $max_y != 0) {
				if($sx>$sy) {
						$cal_size[1]=ceil(($sy*$max_x)/$sx);
						$cal_size[0]=$max_x;
						if($cal_size[1] > $max_y) {
							$cal_size[0]=ceil($sx*$max_y/$sy);
							$cal_size[1]=$max_y;
						} 
				}else {
						$cal_size[0]=ceil($sx*$max_y/$sy);
						$cal_size[1]=$max_y;
						if($cal_size[0] > $max_x) {
							$cal_size[1]=ceil($sy*$max_x/$sx);
							$cal_size[0]=$max_x;
						} 
				}
			}

			if($max_x==0 || $max_y==0) {
				$tmp_y=ceil(($sy*$max_x)/$sx);
				$tmp_x=ceil(($sx*$max_y)/$sy);
				if($max_x>$max_y) {
					if($sy>$tmp_y) $cal_size[1]=$tmp_y; else $cal_size[1]=$sy;
					if($sx>$max_x) $cal_size[0]=$max_x; else $cal_size[0]=$sx;
				}else {
					if($sx>$tmp_x) $cal_size[0]=$tmp_x; else $cal_size[0]=$sx;
					if($sy>$max_y) $cal_size[1]=$max_y; else $cal_size[1]=$sy;
				}
			}
			break;

		case 1:  // 지정된 크기로 리사이즈 한다.
			$cal_size[0] = $max_x;
			$cal_size[1] = $max_y;
			break;

		case 2:  // 원본리사이즈를 하면서 지정한 사이즈에 꽉 차는 이미지를 만들고 나머지는 잘라낸다.
			$cal_size[0] = $max_x;
			$cal_size[1] = $max_y;
			if($sx == $sy) {
				if($max_x>$max_y) $cal_size[5] = $max_x; 
				else $cal_size[4] = $max_y;
			} else {
				if($sx>$sy && $max_x>$max_y) {$org_y=$max_y; $max_y = 0;}
				elseif($sx<$sy && $max_x<$max_y) {$org_x=$max_x; $max_x = 0;}
				else {
					if($sx>$sy) {$org_x=$max_x; $max_x = 0;}
					if($sx<$sy) {$org_y=$max_y; $max_y = 0;}
				}

				if($max_x==0 || $max_y==0) {
					$tmp_y=ceil(($sy*$max_x)/$sx);
					$tmp_x=ceil(($sx*$max_y)/$sy);

					if($tmp_y < $org_y) {
						$tmp_y = $org_y;
						$org_x=$max_x; $max_x = 0;
						$tmp_x=ceil(($sx*$org_y)/$sy);
					} elseif($tmp_x < $org_x) {
						$tmp_x = $org_x;
						$org_y=$max_y; $max_y = 0;
						$tmp_y=ceil(($sy*$org_x)/$sx);
					}
					if($max_x>$max_y) {
						if($sy>$tmp_y || $max_y<$tmp_y) $cal_size[5]=$tmp_y; else $cal_size[5]=$sy;
						if($sy<$tmp_y) $cal_size[5]=$tmp_y;
						if($sx<$max_x) $cal_size[4]=$tmp_x;
					}else {
						if($sx>$tmp_x || $max_x<$tmp_x) $cal_size[4]=$tmp_x; else $cal_size[4]=$sx;
						if($sx<$tmp_x) $cal_size[4]=$tmp_x;
						if($sy<$tmp_y) $cal_size[5]=$tmp_y;
					}
				}
				break;
			}
		}

		$cal_size[3]=$src_file;
		$oldInfo = $cal_size;
		return $cal_size;
	}

// 섬네일을 생성해야 할 파일인지 검사
	function chk_imgfile($src_file,$thumb_x,$thumb_y) {
		$new_file=true;
		if (file_exists($src_file)) {
			$old_img = @getimagesize($src_file);
			$cal_size = cal_thumb_size($src_file, $thumb_x, $thumb_y);
			if ($old_img[0]!=$cal_size[0]) $tmp++;
			if ($old_img[1]!=$cal_size[1]) $tmp++;
			if ($tmp>0) $new_file=true; else $new_file=false;

			if(!$old_img[0] || !$old_img[1]) $new_file=true;
		}
		$workFile = $src_file.".work";
		if(file_exists($workFile)) $new_file = false;
		return $new_file;
	}

// allow_url_open 켬
	function set_URLOpen($value) {
		if($value==1) @ini_set("allow_url_fopen","1");
		if($value==0) @ini_set("allow_url_fopen","0");
	}


// 업로드된 이미지 목록을 배열로 저장해서 반환
	function get_uploadImages($data, $max_no='99', $all='0') {
		global $id;

		$count=0;
		$max_upload = 99;

		if($all) $chk = '1';

		$m_data=@mysql_fetch_array(mysql_query("select * from dq_revolution where zb_id='$id' and zb_no='$data[no]'"));

		if($all) $chk = $data[file_name1] ? true : false; else $chk = (eregi("\.thumb|\.gif|\.jpg|\.jpeg|\.png|\.bmp|\.wmf",$data[s_file_name1]) ? true : false);
		if($chk && file_exists($data[file_name1])) {
			$images[$count] = $data[file_name1];
			$s_images[$count] = $data[s_file_name1];
			$images_size[$count] = GetFileSize(filesize($data[file_name1]));
			$images_count[$count] = 0;
			$count++;
			if($count==$max_no) $flag=1;
		}

		if($all) $chk = $data[file_name2] ? true : false; else $chk = (eregi("\.thumb|\.gif|\.jpg|\.jpeg|\.png|\.bmp|\.wmf",$data[s_file_name2]) ? true : false);
		if(!$flag && $chk && file_exists($data[file_name2])) {
			$images[$count] = $data[file_name2];
			$s_images[$count] = $data[s_file_name2];
			$images_size[$count] = GetFileSize(filesize($data[file_name2]));
			$images_count[$count] = 1;
			$count++;
			if($count==$max_no) $flag=1;
		}

		//업로드 확장기에 의한 파일목록 가져옴
		/*
		if(!$flag && $m_data[file_names]) {
			$tmp_files = explode(",",$m_data[file_names]);
			$tmp_sfiles = explode(",",$m_data[s_file_names]);

			for($i=0; $i<$max_upload; $i++) {
				if(eregi("\.gif|\.jpg|\.jpeg|\.png|\.bmp|\.wmf",$tmp_files[$i])) {
					$images[$count] = $tmp_files[$i];
					$s_images[$count] = $tmp_sfiles[$i];
					$images_size[$count] = GetFileSize(filesize($tmp_files[$i]));
					$images_count[$count] = $i+2;
					$count++;
					$max_files = $count;
				}
				if($count==$max_no) $flag=1;
				if($flag) break;
			}
		}
		*/

		$ret[0] = $images;
		$ret[1] = $s_images;
		$ret[2] = $images_size;
		$ret[3] = $images_count;
		//$ret[is_vdel] = $m_data[is_vdel];

		return $ret;
	}


//문서에서 제로보드 그림창고 태그 변환하기
	function convt_imagebox($tmp, $ismember) {
		global $_zb_url, $PHP_SELF, $_SERVER;

		if($_zb_url) $_zboard_url = $_zb_url;
		else $_zboard_url = "http://".$_SERVER[HTTP_HOST].str_replace(basename($PHP_SELF),"",$PHP_SELF);

		$imageBoxPattern = "/\[img\:(.+?)\.(jpg|gif)\,align\=([a-z]){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i";
		$tmp=preg_replace($imageBoxPattern,"<img src=$_zboard_url"."icon/member_image_box/$ismember/\\1>", stripslashes($tmp));
		$tmp=str_replace("src='icon/member_image_box/","src='$_zboard_url"."icon/member_image_box/",$tmp);

		return $tmp;
	}

// 문서에서 이미지태그 추출
	function get_imgTag($tmp, $ismember='0', $num='1') {

		$tmp=convt_imagebox($tmp, $ismember);

		for($i=0; $i<=$num; $i++) {
			for($j=$j; $j<=strlen($tmp); $j++){ 
				if($flag==0 && $tmp[$j] == '<' && strtolower(substr($tmp,$j+1,3)) == 'img') $flag=1; 
				if($flag==1 && $tmp[$j] != '>') $prtstr[$i] .= $tmp[$j]; 
				if($flag==1 && $tmp[$j] == '>') {$prtstr[$i] .= $tmp[$j]; $j++;	break;}
			}
			$flag=0;
		}
		if($prtstr) return $prtstr;
	}

// 문자열에서 url경로 추출
	function get_urlPath($str) {
		if(eregi("\.jpg",$str))  $_file_type = ".jpg";
		if(eregi("\.jpeg",$str)) $_file_type = ".jpeg";
		if(eregi("\.gif",$str))  $_file_type = ".gif";
		if(eregi("\.png",$str))  $_file_type = ".png";
		if(eregi("\.bmp",$str))  $_file_type = ".bmp";
		if(eregi("\.wmf",$str))  $_file_type = ".wmf";

		$old_autoResize_text   = " name=zb_target_resize style=\"cursor:hand\" onclick=window.open(this.src)";
		$str=str_replace($old_autoResize_text,'',$str);

		if(!eregi('\?',$str)) $str=str_replace(" ","_DQ_TEMP_STRING_",substr($str,0,strpos(strtolower($str),$_file_type)+(strlen($_file_type)+1)));
		$link_pattern = ";((http|https|ftp)://)?[/.?\xA1-\xFEa-zA-Z0-9:_\-]+[.][/?\xA1-\xFEa-zA-Z0-9,:\;&#=_~%()\[\]?\/.,+\*\-]+;i";
		preg_match($link_pattern,$str,$ret);

		//리눅스 시스템이라면 %20 문자를 공백으로 바꾼다.
		$server_os  = get_serverOS();
		if(eregi("linux", $server_os)) $ret[0] = str_replace("_DQ_TEMP_STRING_"," ",$ret[0]);
		else $ret[0] = str_replace("_DQ_TEMP_STRING_","%20",$ret[0]);

		return $ret[0];
	}

// url을 절대경로로 반환
	function get_url2realpath($str) {
		$_http_host_url = $_SERVER[HTTP_HOST];

		if(substr($_http_host_url,0,4)!="www.") {
			$_http_host1 = 'http://'.$_http_host_url;
			$_http_host2 = 'http://www.'.$_http_host_url;
		} else {
			$_http_host1 = 'http://'.substr($_http_host_url,4,strlen($_http_host_url));
			$_http_host2 = 'http://'.$_http_host_url;
		}

		$_getImageURL = str_replace($_http_host1,'',str_replace('www.','',$str));
		if(substr($_getImageURL,0,1)=='/') $str_chkImage = get_indexDir().$_getImageURL; else $str_chkImage = $_getImageURL;

		return $str_chkImage;
	}

// url엔코딩
	function dq_urlencode($url_path) {
		global $dqEngine;

		if(!$dqEngine['using_urlenc']) return $url_path;
		$url_temp=parse_url(trim($url_path));
		if($url_temp[query]) $url_q="?".$url_temp[query];
		$url=str_replace($url_q,"",trim($url_path));
		$url_temp=str_replace("%3A",":",str_replace("%2F","/",rawurlencode($url)));
		$url=$url_temp.$url_q;

		return $url;
	}

// 서버 OS 알아내기
	function get_serverOS () {
		if(function_exists("posix_uname")) {
			$server = posix_uname();
			return $server[sysname]." ".$server[release];
		}
		ob_start();
		phpinfo(1);
		$server_os=ob_get_contents();
		ob_end_clean();
		$server_os=strip_tags(stristr($server_os, 'System'));
		$server_os=explode("\n",$server_os);
		return substr($server_os[0],6,strlen($server_os[0]));
	}

// PHPThumb에서 가져온 소스들 (약간 수정)
	function phpinfo_array() {
		static $phpinfo_array = array();
		if (empty($phpinfo_array)) {
			ob_start();
			phpinfo();
			$phpinfo = ob_get_contents();
			ob_end_clean();
			$phpinfo_array = explode("\n", $phpinfo);
		}
		return $phpinfo_array;
	}

	function get_exif_info() {
		static $exif_info = array();
		if (empty($exif_info)) {
			$exif_info = array(
				'EXIF Support'           => '',
				'EXIF Version'           => '',
				'Supported EXIF Version' => '',
				'Supported filetypes'    => ''
			);
			$phpinfo_array = phpinfo_array();
			foreach ($phpinfo_array as $line) {
				$line = trim(strip_tags($line));
				foreach ($exif_info as $key => $value) {
					if (strpos($line, $key) === 0) {
						$newvalue = trim(str_replace($key, '', $line));
						$exif_info[$key] = $newvalue;
					}
				}
			}
		}
		return $exif_info;
	}

	function get_GDVersion($fullstring=0) {
		static $cache_gd_version = array();
		if (empty($cache_gd_version)) {
			$gd_info = get_GDInfo();
			if (substr($gd_info['GD Version'], 0, strlen('bundled (')) == 'bundled (') {
				$cache_gd_version[1] = $gd_info['GD Version'];
				$cache_gd_version[0] = (float) substr($gd_info['GD Version'], strlen('bundled ('), 3);
			} else {
				$cache_gd_version[1] = $gd_info['GD Version'];
				$cache_gd_version[0] = (float) substr($gd_info['GD Version'], 0, 3);
			}
		}
		return $cache_gd_version[intval($fullstring)];
	}

	function get_GDInfo() {
		if (function_exists('gd_info')) {
			return gd_info();
		}

		static $gd_info = array();
		if (empty($gd_info)) {
			$gd_info = array(
				'GD Version'         => '',
				'FreeType Support'   => false,
				'FreeType Linkage'   => '',
				'T1Lib Support'      => false,
				'GIF Read Support'   => false,
				'GIF Create Support' => false,
				'JPG Support'        => false,
				'PNG Support'        => false,
				'WBMP Support'       => false,
				'XBM Support'        => false
			);

			$phpinfo_array = phpinfo_array();
			foreach ($phpinfo_array as $line) {
				$line = trim(strip_tags($line));
				foreach ($gd_info as $key => $value) {
					if (strpos($line, $key) === 0) {
						$newvalue = trim(str_replace($key, '', $line));
						$gd_info[$key] = $newvalue;
					}
				}
			}

			if (empty($gd_info['GD Version'])) {
				if (function_exists('ImageTypes')) {
					$imagetypes = ImageTypes();
					if ($imagetypes & IMG_PNG) {
						$gd_info['PNG Support'] = true;
					}
					if ($imagetypes & IMG_GIF) {
						$gd_info['GIF Create Support'] = true;
					}
					if ($imagetypes & IMG_JPG) {
						$gd_info['JPG Support'] = true;
					}
					if ($imagetypes & IMG_WBMP) {
						$gd_info['WBMP Support'] = true;
					}
				}
				if (function_exists('ImageCreateFromGIF')) {
					if ($tempfilename = tempnam(null, '_thumb_')) {
						if ($fp_tempfile = @fopen($tempfilename, 'wb')) {
							fwrite($fp_tempfile, base64_decode('R0lGODlhAQABAIAAAH//AP///ywAAAAAAQABAAACAUQAOw=='));
							fclose($fp_tempfile);
							$gd_info['GIF Read Support'] = (bool) @ImageCreateFromGIF($tempfilename);
						}
						unlink($tempfilename);
					}
				}
				if (function_exists('ImageCreateTrueColor') && @ImageCreateTrueColor(1, 1)) {
					$gd_info['GD Version'] = '2.0.1 or higher (assumed)';
				} elseif (function_exists('ImageCreate') && @ImageCreate(1, 1)) {
					$gd_info['GD Version'] = '1.6.0 or higher (assumed)';
				}
			}
		}
		return $gd_info;
	}

// USM 필터(PHP 4.3.2 에서는 동작하지 않는다.)
	function UnsharpMask($img, $amount='60', $radius='0.5', $threshold='1') {

		////////////////////////////////////////////////////////////////////////////////////////////////
		////
		////                  p h p U n s h a r p M a s k
		////
		////	Unsharp mask algorithm by Torstein H?si 2003.
		////	         thoensi_at_netcom_dot_no.
		////	           Please leave this notice.
		////
		///////////////////////////////////////////////////////////////////////////////////////////////


		// $img is an image that is already created within php using
		// imgcreatetruecolor. No url! $img must be a truecolor image.

		// Attempt to calibrate the parameters to Photoshop:

		if(eregi('4.3.2',phpversion())) return $img;

		$amount = min($amount, 500);
		$amount = $amount * 0.016;

		$radius = min($radius, 50);
		$radius = $radius * 2;

		$threshold = min($threshold, 255);

		$radius = abs(round($radius)); 	// Only integers make sense.
		if ($radius == 0) {
			return $img;
			//ImageDestroy($img);
			//break;
		}
		$w = ImageSX($img);
		$h = ImageSY($img);
		$imgCanvas  = ImageCreateTrueColor($w, $h);
		$imgCanvas2 = ImageCreateTrueColor($w, $h);
		$imgBlur    = ImageCreateTrueColor($w, $h);
		$imgBlur2   = ImageCreateTrueColor($w, $h);
		ImageCopy($imgCanvas,  $img, 0, 0, 0, 0, $w, $h);
		ImageCopy($imgCanvas2, $img, 0, 0, 0, 0, $w, $h);


		// Gaussian blur matrix:
		//
		//	1	2	1
		//	2	4	2
		//	1	2	1
		//
		//////////////////////////////////////////////////

		// Move copies of the image around one pixel at the time and merge them with weight
		// according to the matrix. The same matrix is simply repeated for higher radii.
		for ($i = 0; $i < $radius; $i++)	{
			ImageCopy     ($imgBlur, $imgCanvas, 0, 0, 1, 1, $w - 1, $h - 1);            // up left
			ImageCopyMerge($imgBlur, $imgCanvas, 1, 1, 0, 0, $w,     $h,     50);        // down right
			ImageCopyMerge($imgBlur, $imgCanvas, 0, 1, 1, 0, $w - 1, $h,     33.33333);  // down left
			ImageCopyMerge($imgBlur, $imgCanvas, 1, 0, 0, 1, $w,     $h - 1, 25);        // up right
			ImageCopyMerge($imgBlur, $imgCanvas, 0, 0, 1, 0, $w - 1, $h,     33.33333);  // left
			ImageCopyMerge($imgBlur, $imgCanvas, 1, 0, 0, 0, $w,     $h,     25);        // right
			ImageCopyMerge($imgBlur, $imgCanvas, 0, 0, 0, 1, $w,     $h - 1, 20 );       // up
			ImageCopyMerge($imgBlur, $imgCanvas, 0, 1, 0, 0, $w,     $h,     16.666667); // down
			ImageCopyMerge($imgBlur, $imgCanvas, 0, 0, 0, 0, $w,     $h,     50);        // center
			ImageCopy     ($imgCanvas, $imgBlur, 0, 0, 0, 0, $w,     $h);

			// During the loop above the blurred copy darkens, possibly due to a roundoff
			// error. Therefore the sharp picture has to go through the same loop to
			// produce a similar image for comparison. This is not a good thing, as processing
			// time increases heavily.
			ImageCopy     ($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h);
			ImageCopyMerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 50);
			ImageCopyMerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 33.33333);
			ImageCopyMerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 25);
			ImageCopyMerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 33.33333);
			ImageCopyMerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 25);
			ImageCopyMerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 20 );
			ImageCopyMerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 16.666667);
			ImageCopyMerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 50);
			ImageCopy     ($imgCanvas2, $imgBlur2, 0, 0, 0, 0, $w, $h);
		}

		// Calculate the difference between the blurred pixels and the original
		// and set the pixels
		for ($x = 0; $x < $w; $x++)	{ // each row
			for ($y = 0; $y < $h; $y++)	{ // each pixel

				$rgbOrig = ImageColorAt($imgCanvas2, $x, $y);
				$rOrig = (($rgbOrig >> 16) & 0xFF);
				$gOrig = (($rgbOrig >>  8) & 0xFF);
				$bOrig =  ($rgbOrig        & 0xFF);

				$rgbBlur = ImageColorAt($imgCanvas, $x, $y);
				$rBlur = (($rgbBlur >> 16) & 0xFF);
				$gBlur = (($rgbBlur >>  8) & 0xFF);
				$bBlur =  ($rgbBlur        & 0xFF);

				// When the masked pixels differ less from the original
				// than the threshold specifies, they are set to their original value.
				$rNew = (abs($rOrig - $rBlur) >= $threshold) ? max(0, min(255, ($amount * ($rOrig - $rBlur)) + $rOrig)) : $rOrig;
				$gNew = (abs($gOrig - $gBlur) >= $threshold) ? max(0, min(255, ($amount * ($gOrig - $gBlur)) + $gOrig)) : $gOrig;
				$bNew = (abs($bOrig - $bBlur) >= $threshold) ? max(0, min(255, ($amount * ($bOrig - $bBlur)) + $bOrig)) : $bOrig;

				$pixCol = ImageColorAllocate($img, $rNew, $gNew, $bNew);
				ImageSetPixel($img, $x, $y, $pixCol);
			}
		}
		ImageDestroy($imgCanvas);
		ImageDestroy($imgCanvas2);
		ImageDestroy($imgBlur);
		ImageDestroy($imgBlur2);
		return $img;
		//ImageDestroy($img);
	}

// 정확한 document_root 값 찾아내기(서버에 따라 엉뚱하게 리턴하는 경우가 있어서 정밀한 검사가 필요하다)
	function get_indexDir() {
		global $_SERVER;
		$docroot = $_SERVER["DOCUMENT_ROOT"] ? $_SERVER["DOCUMENT_ROOT"] : '\$empty\$';
		$scriptfile = $_SERVER["SCRIPT_FILENAME"] ? $_SERVER["SCRIPT_FILENAME"] : $_SERVER["PATH_TRANSLATED"];
		$phpself = $_SERVER["PHP_SELF"];

		if(!$scriptfile) die("<div style='background-color:yellow;color:black'><b>스크립트 파일에 대한 정보가 없습니다.</b> ::이 서버에서는 실행할수 없습니다. ::</div>");

		if(!eregi($docroot,$scriptfile)) {
			$os = get_serveros();
			if(eregi("windows",$os)) $scriptfile = str_replace("\\","/",$scriptfile);
			if (substr($phpself,0,2)=='/~') {
				$pattern = ":/~+(/+):i";
				$scriptfile = str_replace($pattern,"\\1",$scriptfile);
			}
			
			$tmp = str_replace($phpself,'',$scriptfile).'/';
		} else $tmp = $docroot;
		return $tmp;
	}

?>