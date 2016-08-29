<?
$g4_path='../../board';
include_once("$g4_path/common.php");
if(!$member[mb_id])$mb_id='guest';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<?
if($action_mode=='reg')
{
	$sql="
	insert into english_study set
	word_eng='$_POST[word_eng]',
	word_kor='$_POST[word_kor]',
	word_ex='$_POST[word_ex]',
	word_type='$_POST[word_type]',
	member_id='$mb_id'
	";
	sql_query($sql);
	?>

	<script type="text/javascript">
	<!--
	alert('등록완료');
	parent.location.reload();
	-->
	</script>
	<?
}	
elseif($action_mode=='delete')
{
	$sql="delete from english_study where w_id='$w_id'
	";
	sql_query($sql);
	?>

	<script type="text/javascript">
	<!--
	alert('삭제 완료');
	parent.location.reload();
	-->
	</script>
	<?
}	
	?>