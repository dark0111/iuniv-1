<?
class mh_files {
	var $handle;
	// 디렉토리를 여닫기 위한 핸들러.
	var $listz=array();
	// 목록 배열
	var $file;
	// 파일 목록용
	var $fp;
	// 파일 포인트
	var $cont;
	// 파일 내용(content)


	/*

	디렉토리 내 파일 목록 출력 메쏘드 fl()

	작성 : 4340.01.13.
	예시 :

	파일은 1.php와 2.php 두 개, 디렉토리는 dir_1 하나가 있다고 한다.

	$file=new mh_files;
	$list=$file->fl();
	print_r($list);

	결과 :

	Array (
	[file] =>
	Array (
	[0] => 1.php [1] => 2.php
	)
	[dir] =>
	Array (
	[0] => dir_1
	)
	[file_cnt] => 2
	[dir_cnt] => 1
	)

	*/



	function fl($path=".") {
	// 경로를 매개변수로 입력받되 없으면 현재 디렉토리를 입력.

		$i=0;
		$j=0;
		$this->listz['file']=array();
		$this->listz['dir']=array();
		// 초기화

		$this->handle=opendir($path);
		// 경로를 열어 핸들러 변수에 저장
		while (false !== ($this->file = readdir($this->handle))) {
		// 핸들러 변수에 해당하는 경로의 데이터를 얻어 file 변수에 저장하고 끝까지 루프를 돈다
			if($this->file!="." && $this->file!="..") {
			// 자신과 상위 디렉토리를 나타내는 .과 ..를 뺀다.
				if(!is_dir($this->file)){
					// 읽어온 게 디렉토리가 아니라면
					array_push($this->listz['file'],$this->file);
					// listz 배열의 file 키에 읽어 온 순서대로 저장한다.
					$i++;
					// 파일 개수
				} else {
					// 디렉토리라면
					array_push($this->listz['dir'],$this->file);
					// listz 배열의 dir 키에 읽어 온 순서대로 저장한다.
					$j++;
					// 디렉토리 개수
				}
			}
		}
		closedir($this->handle);
		// 핸들러 변수 닫고.
		$this->listz['file_cnt']=$i;
		$this->listz['dir_cnt']=$j;
		// listz 배열의 file_cnt와 dir_cnt에 각기 파일과 디렉토리 개수를 넣는다.

		return $this->listz;
		// 마지막으로 listz 배열을 통째로 돌려준다.

	}


	/*

	파일 내용 읽기 메쏘드 fr()

	작성 : 4340.01.13.
	예시 :

	$file=new mh_files;
	$cont=$file->fr('1.txt');
	echo nl2br($cont);

	*/

	function fr($filename){
	// 파일명을 매개변수로 받는다.

		if(file_exists($filename)){
			// 파일이 있는가를 검사하여 있으면
			$this->fp=fopen($filename,"r");
			// 파일을 읽기모드로 읽는다.
			$this->cont=fread($this->fp,filesize($filename));
			// 파일의 크기만큼을 읽어서 cont 변수에 저장.
			fclose($this->fp);
			// 파일 닫기.
		} else {
			// 파일이 없으면
			$this->cont="파일 없음";
			// cont 변수에는 '파일 없음'이란 문자열을 넣는다.
		}

	return $this->cont;
	// cont 변수를 돌려준다.

	}


	/*

	파일 쓰기 메쏘드 fs()

	작성 : 4340.01.13.
	예시 :

	$file=new mh_files;
	$text="가
	나
	다
	라";
	$file->fs('1.txt',$text);

	결과 :
	가
	나
	다
	라
	*/

	function fs($filename,$cont,$mode="w") {
		// 파일명과 쓸 내용, 모드를 매개변수로 받는다. 모드는 기본적으로 쓰기 모드.

		$this->fp=fopen($filename, $mode);
		// 파일포인터 설정.
		if(flock($this->fp, LOCK_EX))
		// 파일 잠금 장치
		{
		fwrite($this->fp,$cont);
		// 내용물을 파일포인터에 쓴다.
		fclose($this->fp);
		// 파일 닫기
		}

	return true;

	}

}
?>