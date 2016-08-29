<?
function show_product_image($size,$product_code)
{
	global 	$dark_define;
	
	if(file_exists($dark_define[path]."/sub/mall/dark_mall_prt_img/".$size."/".$product_code."_1.jpg"))
	{
		$r="<img src='$dark_define[site_url]/sub/mall/dark_mall_prt_img/".$size."/".$product_code."_1.jpg' width='".$size."' height='".$size."' border='0'  style='border:1 solid;border-color:#c4c4c4;'>";
	}
	elseif(file_exists($dark_define[path]."/sub/mall/dark_mall_prt_img/".$size."/".$product_code."_1.gif"))
	{
		$r="<img src='$dark_define[site_url]/sub/mall/dark_mall_prt_img/".$size."/".$product_code."_1.gif' width='".$size."' height='".$size."' border='0'  style='border:1 solid;border-color:#c4c4c4;'>";
	}
	elseif(file_exists($dark_define[path]."/sub/mall/dark_mall_prt_img/".$size."/".$product_code."_1.png"))
	{
		$r="<img src='$dark_define[site_url]/sub/mall/dark_mall_prt_img/".$size."/".$product_code."_1.png' width='".$size."' height='".$size."' border='0'  style='border:1 solid;border-color:#c4c4c4;'>";
	}
	return $r;
}
/*
if(file_exists($dark_define[site_url]."/sub/mall/dark_mall_prt_img/75/".$product_code."_1.jpg"))
			{
			echo"
			<img src=$dark_define[site_url].'/sub/mall/dark_mall_prt_img/75/'.$product_code.'_1.jpg' width='75' height='75' border='0'  style='border:1 solid;border-color:#c4c4c4;'>";
			}
			elseif(file_exists($dark_define[site_url]."/sub/mall/dark_mall_prt_img/75/".$product_code."_1.gif"))
			{
			echo"
			<img src=$dark_define[site_url].'/sub/mall/dark_mall_prt_img/75/'.$product_code.'_1.gif' width='75' height='75' border='0'  style='border:1 solid;border-color:#c4c4c4;'>";
			}
			elseif(file_exists("$dark_define[site_url]/sub/mall/dark_mall_prt_img/75/".$product_code."_1.png"))
			{
			echo"
			<img src=$dark_define[site_url].'/sub/mall/dark_mall_prt_img/75/'.$product_code.'_1.png' width='75' height='75' border='0'  style='border:1 solid;border-color:#c4c4c4;'>";
			}
			else
			{}
*/

function category_print($tb, $cate_no){
	$category_printQuery = "select no, scn, wcn, cate_name, cate_info from $tb where no='$cate_no'";
	$category_print_ds = mysql_query($category_printQuery, $connection) or die("category_printQuery error");
	$category_print_row = mysql_fetch_array($category_print_ds);
	$category_Value = $category_print_row[cate_name];
}
?>