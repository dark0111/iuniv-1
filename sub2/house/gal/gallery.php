<?
include_once("./_common.php");
include_once("$g4[path]/lib/latest.lib.php");


echo '<artworkinfo>';


// bo_table='free' and bo_table='또다른 겔러리 게시판 네임' 등으로 아래 수정해주시면 여러개의 
//겔러에서 불러와집니다.
$sql = " select I_id, I_classify, I_classify_id, I_filename from room_imageinfo where I_classify ='H'  ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 스킨은 입력하지 않을 경우 관리자 > 환경설정의 최신글 스킨경로를 기본 스킨으로 합니다.

    // 사용방법
    // latest(스킨, 게시판아이디, 출력라인, 글자수);
    echo latest("gxml", $row['I_title'], 12, 70);
  
}

?>

</artworkinfo>

